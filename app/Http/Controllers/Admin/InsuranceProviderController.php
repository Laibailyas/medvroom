<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsuranceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InsuranceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = InsuranceProvider::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $providers = $query->withCount('plans')->latest()->paginate(10);

        return view('admin.insurance.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.insurance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:insurance_providers',
            'logo' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('insurance-logos', 'public');
        }

        InsuranceProvider::create($validated);

        return redirect()->route('admin.insurance-providers.index')
            ->with('success', 'Insurance Provider created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InsuranceProvider $insuranceProvider): View
    {
        return view('admin.insurance.edit', compact('insuranceProvider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InsuranceProvider $insuranceProvider): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:insurance_providers,name,' . $insuranceProvider->id,
            'logo' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($insuranceProvider->logo) {
                Storage::disk('public')->delete($insuranceProvider->logo);
            }
            $validated['logo'] = $request->file('logo')->store('insurance-logos', 'public');
        }

        $insuranceProvider->update($validated);

        return redirect()->route('admin.insurance-providers.index')
            ->with('success', 'Insurance Provider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InsuranceProvider $insuranceProvider): RedirectResponse
    {
        if ($insuranceProvider->logo) {
            Storage::disk('public')->delete($insuranceProvider->logo);
        }

        $insuranceProvider->delete();

        return redirect()->route('admin.insurance-providers.index')
            ->with('success', 'Insurance Provider deleted successfully.');
    }
}
