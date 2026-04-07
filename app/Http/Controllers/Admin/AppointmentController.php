<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Appointment::with(['doctorProfile.user', 'patientProfile.user', 'latestStatusHistory']);

        if ($request->has('status')) {
            $query->whereHas('latestStatusHistory', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        if ($request->has('date')) {
            $query->whereDate('appointment_datetime', $request->date);
        }

        $appointments = $query->latest('appointment_datetime')->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment): View
    {
        $appointment->load(['doctorProfile.user', 'patientProfile.user', 'statusHistories.changedBy', 'review']);

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Update the status of the appointment.
     */
    public function transition(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'comment' => 'nullable|string|max:500',
        ]);

        $appointment->transitionStatus(
            $validated['status'],
            ($validated['comment'] ?? 'Admin action'),
            Auth::id()
        );

        return back()->with('success', "Appointment marked as {$validated['status']} successfully.");
    }

    /**
     * Remove the specified resource (Administrative Cancellation).
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->transitionStatus('cancelled', 'Administrative cancellation', Auth::id());
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment cancelled and removed successfully.');
    }
}
