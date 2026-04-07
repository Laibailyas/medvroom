<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InsuranceProvider;
use App\Models\InsurancePlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InsuranceController extends Controller
{
    /**
     * Display a list of all insurance plans and the ones the doctor accepts.
     */
    public function index(Request $request): View
    {
        $doctor = $request->user()->doctorProfile;
        
        $providers = InsuranceProvider::with('plans')->orderBy('name')->get();
        $acceptedPlanIds = $doctor->insurancePlans->pluck('id')->toArray();

        return view('doctor.insurance.index', compact('providers', 'acceptedPlanIds'));
    }

    /**
     * Update the insurance plans accepted by the doctor.
     */
    public function update(Request $request): RedirectResponse
    {
        $doctor = $request->user()->doctorProfile;

        $validated = $request->validate([
            'plans' => 'array',
            'plans.*' => 'exists:insurance_plans,id',
        ]);

        $doctor->insurancePlans()->sync($validated['plans'] ?? []);

        return back()->with('success', 'Insurance network participation updated successfully.');
    }
}
