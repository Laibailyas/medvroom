<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use App\Models\Specialty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = DoctorProfile::with('user', 'specialties');

        if ($request->has('verified')) {
            $query->where('is_verified', $request->verified);
        }

        if ($request->has('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }

        $doctors = $query->latest()->paginate(10);

        return view('admin.providers.index', compact('doctors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorProfile $doctor): View
    {
        $specialties = Specialty::all();

        return view('admin.providers.edit', compact('doctor', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorProfile $doctor): RedirectResponse
    {
        $validated = $request->validate([
            'is_verified' => 'boolean',
            'clinic_name' => 'nullable|string|max:255',
            'consultation_fee' => 'nullable|numeric|min:0',
            'experience_years' => 'nullable|integer|min:0',
            'specialties' => 'array',
            'specialties.*' => 'exists:specialties,id',
        ]);

        $doctor->update($validated);

        if ($request->has('specialties')) {
            $doctor->specialties()->sync($request->specialties);
        }

        return redirect()->route('admin.providers.index')->with('success', 'Provider profile updated successfully.');
    }

    /**
     * Toggle verification status.
     */
    public function toggleVerification(DoctorProfile $doctor): RedirectResponse
    {
        $doctor->update(['is_verified' => ! $doctor->is_verified]);

        $status = $doctor->is_verified ? 'verified' : 'unverified';

        return back()->with('success', "Provider marked as {$status} successfully.");
    }

    /**
     * 1-click verification decision: approve, reject, or request info.
     */
    public function decide(Request $request, DoctorProfile $doctor): RedirectResponse
    {
        $validated = $request->validate([
            'decision' => 'required|in:approve,reject,request_info',
            'note' => 'nullable|string|max:1000',
        ]);

        $messages = [
            'approve' => ['is_verified' => true,  'flash' => 'success', 'text' => "Provider {$doctor->user->name} has been approved and verified."],
            'reject' => ['is_verified' => false, 'flash' => 'error',   'text' => "Provider {$doctor->user->name} has been rejected."],
            'request_info' => ['is_verified' => false, 'flash' => 'info',    'text' => "Additional information has been requested from {$doctor->user->name}."],
        ];

        $outcome = $messages[$validated['decision']];

        // Update verification status (request_info keeps current state = unverified)
        if ($validated['decision'] !== 'request_info') {
            $doctor->update([
                'is_verified' => $outcome['is_verified'],
                'verification_decided_at' => now(),
            ]);
        }

        // Store the admin note on the profile if provided
        if (! empty($validated['note'])) {
            $doctor->update(['admin_note' => $validated['note']]);
        }

        return redirect()
            ->route('admin.providers.edit', $doctor)
            ->with($outcome['flash'], $outcome['text']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorProfile $doctor): RedirectResponse
    {
        $doctor->delete();

        return redirect()->route('admin.providers.index')->with('success', 'Provider profile removed successfully.');
    }
}
