<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the public search.
     */
    public function index(Request $request)
    {
        $query = DoctorProfile::query()->with(['user', 'specialties']);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($query) use ($q) {
                $query->whereHas('user', function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%");
                })->orWhereHas('specialties', function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%");
                });
            });
        }

        if ($request->filled('location')) {
            // Basic location search using zip code for now
            $query->where('practice_zip_code', 'like', "%{$request->location}%");
        }

        $doctors = $query->paginate(12);
        $specialties = Specialty::all();

        return view('search.index', compact('doctors', 'specialties'));
    }

    /**
     * Display a public doctor profile.
     */
    public function showDoctor(DoctorProfile $doctor)
    {
        $doctor->load(['user', 'specialties', 'reviews.patientProfile.user', 'insurancePlans.provider']);

        $featuredReview = $doctor->reviews()
            ->where('rating', '>=', 4)
            ->whereNotNull('comment')
            ->latest()
            ->first();

        $insuranceGroups = $doctor->insurancePlans
            ->groupBy(function ($plan) {
                return $plan->provider->name;
            });

        return view('doctors.show', compact('doctor', 'featuredReview', 'insuranceGroups'));
    }
}
