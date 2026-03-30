<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DoctorController extends Controller
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
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $doctors = $query->latest()->paginate(10);

        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorProfile $doctor): View
    {
        $specialties = Specialty::all();
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
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

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor profile updated successfully.');
    }

    /**
     * Toggle verification status.
     */
    public function toggleVerification(DoctorProfile $doctor): RedirectResponse
    {
        $doctor->update(['is_verified' => !$doctor->is_verified]);

        $status = $doctor->is_verified ? 'verified' : 'unverified';
        return back()->with('success', "Doctor marked as {$status} successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorProfile $doctor): RedirectResponse
    {
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor profile removed successfully.');
    }
}
