<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $symptoms = Symptom::withCount('specialties')
            ->latest()
            ->paginate(15);

        return view('admin.symptoms.index', compact('symptoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $specialties = Specialty::all();
        return view('admin.symptoms.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:symptoms',
            'specialties' => 'array',
            'specialties.*' => 'exists:specialties,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $symptom = Symptom::create($validated);

        if ($request->has('specialties')) {
            $symptom->specialties()->sync($request->specialties);
        }

        return redirect()->route('admin.symptoms.index')->with('success', 'Symptom created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom): View
    {
        $specialties = Specialty::all();
        $symptom->load('specialties');
        return view('admin.symptoms.edit', compact('symptom', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:symptoms,name,' . $symptom->id,
            'specialties' => 'array',
            'specialties.*' => 'exists:specialties,id',
        ]);

        if ($request->name !== $symptom->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $symptom->update($validated);

        if ($request->has('specialties')) {
            $symptom->specialties()->sync($request->specialties);
        }

        return redirect()->route('admin.symptoms.index')->with('success', 'Symptom updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom): RedirectResponse
    {
        $symptom->specialties()->detach();
        $symptom->delete();

        return redirect()->route('admin.symptoms.index')->with('success', 'Symptom deleted successfully.');
    }
}
