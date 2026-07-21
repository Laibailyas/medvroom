<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the doctor's clinical profile form.
     */
    public function edit(Request $request): View
    {
        $doctor = $request->user()->doctorProfile;

        $specialties = Specialty::orderBy('name')->get();
        $languages   = Language::orderBy('name')->get();

        return view('doctor.profile.edit', compact('doctor', 'specialties', 'languages'));
    }

    /**
     * Update the doctor's clinical profile, including the profile photo.
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $doctor = $user->doctorProfile;

        $validated = $request->validate([
            'first_name'       => 'nullable|string|max:100',
            'last_name'        => 'nullable|string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:80',
            'bio'              => 'nullable|string|max:2000',
            'practice_name'    => 'nullable|string|max:255',
            'clinic_address'   => 'nullable|string|max:255',
            'specialties'      => 'nullable|array',
            'specialties.*'    => 'exists:specialties,id',
            'languages'        => 'nullable|array',
            'languages.*'      => 'exists:languages,id',
            'profile_photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $doctorUpdates = [
            'experience_years' => $validated['experience_years'] ?? $doctor->experience_years,
            'bio'              => $validated['bio'] ?? null,
            'practice_name'    => $validated['practice_name'] ?? null,
            'clinic_address'   => $validated['clinic_address'] ?? null,
        ];

        // IMPORTANT: profile_photo_path is a column on `doctor_profiles`
        // (see DoctorProfile::$fillable — this is also where the Step 8
        // onboarding "profile builder" saves the photo), NOT on `users`.
        // Saving it to $user here was the bug — User::getProfilePhotoUrl()
        // needs to read it from the doctor profile relation instead (see
        // the User model patch that ships alongside this file).
        if ($request->hasFile('profile_photo')) {
            if ($doctor->profile_photo_path) {
                Storage::disk('public')->delete($doctor->profile_photo_path);
            }

            $doctorUpdates['profile_photo_path'] = $request->file('profile_photo')
                ->store('provider-photos', 'public');
        }

        $doctor->update($doctorUpdates);

        $user->first_name = $validated['first_name'] ?? $user->first_name;
        $user->last_name  = $validated['last_name'] ?? $user->last_name;
        $user->save();

        $doctor->specialties()->sync($validated['specialties'] ?? []);
        $doctor->languages()->sync($validated['languages'] ?? []);

        return back()->with('success', 'Profile updated successfully.');
    }
}
