<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\InsuranceProvider;
use App\Models\InsurancePlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InsuranceController extends Controller
{
    /**
     * One card per insurance (flattened), grouped by category for section
     * titles. Deliberately queries from InsuranceProvider->plans (the
     * relation the ORIGINAL controller already used successfully) instead
     * of a Plan->provider reverse relation, since that reverse relation's
     * name was never confirmed and was the likely cause of the 500.
     */
    public function index(Request $request): View
    {
        $doctor = $request->user()->doctorProfile;

        $providers = InsuranceProvider::with('plans')->orderBy('name')->get();

        $cards = collect();
        foreach ($providers as $provider) {
            foreach ($provider->plans as $plan) {
                $cards->push((object) [
                    'id'       => $plan->id,
                    'name'     => $plan->name,
                    'category' => $provider->category ?? 'Commercial',
                ]);
            }
        }

        $order = ['Commercial', 'Government', 'Medicaid Managed Care', 'Employer / Network', 'Self Pay', 'Other'];
        $grouped = $cards->groupBy('category');
        $groupedPlans = collect($order)
            ->filter(fn ($cat) => $grouped->has($cat))
            ->mapWithKeys(fn ($cat) => [$cat => $grouped->get($cat)])
            ->merge($grouped->except($order));

        $acceptedPlanIds = $doctor->insurancePlans->pluck('id')->toArray();

        return view('doctor.insurance.index', [
            'groupedPlans'    => $groupedPlans,
            'acceptedPlanIds' => $acceptedPlanIds,
        ]);
    }

    /**
     * Update the insurance plans accepted by the doctor. Accepts:
     *  - plans[]        existing insurance_plans ids (checked cards)
     *  - custom_plans[] free-text names typed into the "Other" box —
     *    each becomes its own provider+plan (category = Other) and is
     *    immediately selected for this doctor.
     */
    public function update(Request $request): RedirectResponse
    {
        $doctor = $request->user()->doctorProfile;

        $validated = $request->validate([
            'plans'             => 'array',
            'plans.*'           => 'exists:insurance_plans,id',
            'custom_plans'      => 'array',
            'custom_plans.*'    => 'string|max:150',
        ]);

        $planIds = $validated['plans'] ?? [];

        foreach ($validated['custom_plans'] ?? [] as $name) {
            $name = trim($name);
            if ($name === '') {
                continue;
            }

            $provider = InsuranceProvider::firstOrCreate(
                ['name' => $name],
                ['category' => 'Other', 'is_custom' => true]
            );

            $plan = InsurancePlan::firstOrCreate(
                ['provider_id' => $provider->id, 'name' => $name]
            );

            $planIds[] = $plan->id;
        }

        $doctor->insurancePlans()->sync(array_unique($planIds));

        return back()->with('success', 'Insurance network participation updated successfully.');
    }
}
