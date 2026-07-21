<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProviderApprovedMail;
use App\Mail\ProviderInfoRequestMail;
use App\Mail\ProviderRejectedMail;
use App\Models\DoctorProfile;
use App\Models\Specialty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ProviderController extends Controller
{
    public function index(Request $request): View
    {
        $query = DoctorProfile::with('user', 'specialties');

        if ($request->has('verified')) {
            $query->where('is_verified', $request->verified);
        }

        if ($request->has('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $doctors = $query->latest()->paginate(10);

        return view('admin.providers.index', compact('doctors'));
    }

    public function edit(DoctorProfile $doctor): View
    {
        $specialties = Specialty::all();

        return view('admin.providers.edit', compact('doctor', 'specialties'));
    }

    public function update(Request $request, DoctorProfile $doctor): RedirectResponse
    {
        $validated = $request->validate([
            'is_verified'      => 'boolean',
            'clinic_name'      => 'nullable|string|max:255',
            'consultation_fee' => 'nullable|numeric|min:0',
            'experience_years' => 'nullable|integer|min:0',
            'specialties'      => 'array',
            'specialties.*'    => 'exists:specialties,id',
        ]);

        $doctor->update($validated);

        if ($request->has('specialties')) {
            $doctor->specialties()->sync($request->specialties);
        }

        return redirect()->route('admin.providers.index')->with('success', 'Provider profile updated successfully.');
    }

    public function toggleVerification(DoctorProfile $doctor): RedirectResponse
    {
        $doctor->update(['is_verified' => ! $doctor->is_verified]);

        $status = $doctor->is_verified ? 'verified' : 'unverified';

        return back()->with('success', "Provider marked as {$status} successfully.");
    }

    /**
     * 1-click verification decision: approve, reject, or request_info.
     * Sends the appropriate email to the provider.
     */
    public function decide(Request $request, DoctorProfile $doctor): RedirectResponse
    {
        $validated = $request->validate([
            'decision' => 'required|in:approve,reject,request_info',
            'note'     => 'nullable|string|max:1000',
        ]);

        $decision = $validated['decision'];
        $note     = $validated['note'] ?? null;

        // Save admin note
        if ($note) {
            $doctor->update(['admin_note' => $note]);
        }

        // Update verification status
        if ($decision === 'approve') {
            $doctor->update([
                'is_verified'             => true,
                'verification_decided_at' => now(),
                'needs_info'              => false,
            ]);
        } elseif ($decision === 'reject') {
            $doctor->update([
                'is_verified'             => false,
                'verification_decided_at' => now(),
                'needs_info'              => false,
            ]);
        } elseif ($decision === 'request_info') {
            // Flag the application so the provider's status page can show
            // an "action required" banner with links back into the flow.
            $doctor->update([
                'needs_info'        => true,
                'info_requested_at' => now(),
            ]);
        }

        // Send email to provider
        $providerEmail = $doctor->user?->email;

        if ($providerEmail) {
            try {
                match ($decision) {
                    'approve'      => Mail::to($providerEmail)->send(new ProviderApprovedMail($doctor)),
                    'reject'       => Mail::to($providerEmail)->send(new ProviderRejectedMail($doctor, $note)),
                    'request_info' => Mail::to($providerEmail)->send(new ProviderInfoRequestMail($doctor, $note)),
                };
            } catch (\Throwable $e) {
                // Don't block the admin action if mail fails — log it
                \Log::error('Provider decision email failed', [
                    'doctor_id' => $doctor->id,
                    'decision'  => $decision,
                    'error'     => $e->getMessage(),
                ]);
            }
        }

        $flashMessages = [
            'approve'      => ['success', "Provider {$doctor->user?->name} approved. Confirmation email sent."],
            'reject'       => ['error',   "Provider {$doctor->user?->name} rejected. Notification email sent."],
            'request_info' => ['info',    "Information request sent to {$doctor->user?->name} via email."],
        ];

        [$flash, $text] = $flashMessages[$decision];

        return redirect()
            ->route('admin.providers.edit', $doctor)
            ->with($flash, $text);
    }

    public function destroy(DoctorProfile $doctor): RedirectResponse
    {
        $doctor->delete();

        return redirect()->route('admin.providers.index')->with('success', 'Provider profile removed successfully.');
    }
}
