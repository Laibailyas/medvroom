<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Specialty;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the doctor's profile editing form.
     */
    public function edit(Request $request): View
    {
        $doctor = $request->user()->doctorProfile;
        $doctor->load(['specialties', 'languages', 'educations', 'certifications']);

        $specialties = Specialty::all();
        $languages = Language::all();

        return view('doctor.profile.edit', compact('doctor', 'specialties', 'languages'));
    }

    /**
     * Update the doctor's profile details.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        $doctor = $user->doctorProfile;

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:2000',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'practice_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string|max:255',
            'specialties' => 'array',
            'specialties.*' => 'exists:specialties,id',
            'languages' => 'array',
            'languages.*' => 'exists:languages,id',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        // Update User info
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->update(['profile_photo_path' => $path]);
        }

        // Update Doctor Profile
        $doctor->update([
            'bio' => $validated['bio'],
            'experience_years' => $validated['experience_years'],
            'practice_name' => $validated['practice_name'],
            'clinic_address' => $validated['clinic_address'],
        ]);

        // Sync Relationships
        $doctor->specialties()->sync($validated['specialties'] ?? []);
        $doctor->languages()->sync($validated['languages'] ?? []);

        return back()->with('success', 'Professional profile updated successfully.');
    }
}
