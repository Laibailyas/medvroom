<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\Symptom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $specialties = Specialty::withCount(['doctorProfiles', 'symptoms'])
            ->latest()
            ->paginate(15);

        return view('admin.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $symptoms = Symptom::all();

        return view('admin.specialties.create', compact('symptoms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties',
            'icon' => 'nullable|string|max:255',
            'icon_file' => 'nullable|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
            'symptoms' => 'array',
            'symptoms.*' => 'exists:symptoms,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('icon_file')) {
            $path = $request->file('icon_file')->store('specialties/icons', 'public');
            $validated['icon'] = $path;
        }

        $specialty = Specialty::create($validated);

        if ($request->has('symptoms')) {
            $specialty->symptoms()->sync($request->symptoms);
        }

        return redirect()->route('admin.specialties.index')->with('success', 'Specialty created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty): View
    {
        $symptoms = Symptom::all();
        $specialty->load('symptoms');

        return view('admin.specialties.edit', compact('specialty', 'symptoms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name,'.$specialty->id,
            'icon' => 'nullable|string|max:255',
            'icon_file' => 'nullable|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
            'symptoms' => 'array',
            'symptoms.*' => 'exists:symptoms,id',
        ]);

        if ($request->name !== $specialty->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('icon_file')) {
            // Delete old icon if it was a file
            if ($specialty->icon && Storage::disk('public')->exists($specialty->icon)) {
                Storage::disk('public')->delete($specialty->icon);
            }

            $path = $request->file('icon_file')->store('specialties/icons', 'public');
            $validated['icon'] = $path;
        }

        $specialty->update($validated);

        if ($request->has('symptoms')) {
            $specialty->symptoms()->sync($request->symptoms);
        }

        return redirect()->route('admin.specialties.index')->with('success', 'Specialty updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty): RedirectResponse
    {
        $specialty->symptoms()->detach();
        $specialty->delete();

        return redirect()->route('admin.specialties.index')->with('success', 'Specialty deleted successfully.');
    }
}
