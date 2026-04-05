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
        $user = auth()->user();
        $query = DoctorProfile::query()
            ->with(['user', 'specialties', 'reviews', 'schedules'])
            ->with(['appointments' => function ($q) use ($user) {
                if ($user && $user->isPatient() && $user->patientProfile) {
                    $q->where('patient_profile_id', $user->patientProfile->id)
                        ->where('appointment_datetime', '>=', now());
                } else {
                    $q->whereRaw('1 = 0');
                }
            }]);

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
        
        // Timezone and Date Range for Availability
        $userTimezone = auth()->user()?->timezone ?? $request->query('timezone', 'UTC');
        $startDate = \Carbon\Carbon::now($userTimezone);
        $endDate = $startDate->copy()->addDays(6);

        // Pre-calculate availability for the search results
        foreach ($doctors as $doctor) {
            $doctor->availability = $doctor->getAvailabilityForRange($startDate, $endDate, $userTimezone);
        }

        $specialties = Specialty::all();

        return view('search.index', compact('doctors', 'specialties', 'userTimezone', 'startDate', 'endDate'));
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
