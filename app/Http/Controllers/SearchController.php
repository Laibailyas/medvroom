<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
use App\Models\Specialty;
use Carbon\Carbon;
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
            ->whereHas('user')
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
            // Checks zip code, city, and state so a free-text city/state
            // search (e.g. "Brooklyn, NY") actually matches providers.
            $location = $request->location;
            $query->where(function ($sub) use ($location) {
                $sub->where('practice_zip_code', 'like', "%{$location}%")
                    ->orWhere('practice_city', 'like', "%{$location}%")
                    ->orWhere('practice_state', 'like', "%{$location}%");
            });
        }

        if ($request->filled('insurance')) {
            $insurance = $request->insurance;
            $query->whereHas('insurancePlans', function ($sub) use ($insurance) {
                $sub->where('name', 'like', "%{$insurance}%")
                    ->orWhereHas('provider', function ($p) use ($insurance) {
                        $p->where('name', 'like', "%{$insurance}%");
                    });
            });
        }

        // NEW: Date & Time quick filter — checks the doctor's real schedule
        // (doctor_schedules) rather than any static/hardcoded value.
        if ($request->filled('availability')) {
            $today = Carbon::now();

            if ($request->availability === 'today') {
                $dayOfWeek = $today->dayOfWeek;
                $query->whereHas('schedules', function ($s) use ($dayOfWeek) {
                    $s->where('day_of_week', $dayOfWeek)
                        ->whereNotNull('start_time')
                        ->whereNotNull('end_time');
                });
            } elseif ($request->availability === 'tomorrow') {
                $dayOfWeek = $today->copy()->addDay()->dayOfWeek;
                $query->whereHas('schedules', function ($s) use ($dayOfWeek) {
                    $s->where('day_of_week', $dayOfWeek)
                        ->whereNotNull('start_time')
                        ->whereNotNull('end_time');
                });
            } elseif ($request->availability === 'this_week') {
                $query->whereHas('schedules', function ($s) {
                    $s->whereNotNull('start_time')
                        ->whereNotNull('end_time');
                });
            }
        }

        // Specialty filter (top filter bar dropdown)
        if ($request->filled('specialty')) {
            $specialty = $request->specialty;
            $query->whereHas('specialties', function ($sub) use ($specialty) {
                $sub->where('name', $specialty);
            });
        }

        // NEW: Gender filter (top filter bar dropdown)
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // NEW: Visit type filter (top filter bar dropdown)
        // "virtual" -> providers who offer telehealth
        // "in_person" -> providers who are NOT virtual-only
        if ($request->filled('visit_type')) {
            if ($request->visit_type === 'virtual') {
                $query->where('telehealth_available', true);
            } elseif ($request->visit_type === 'in_person') {
                $query->where('virtual_only', false);
            }
        }

        // NEW: Minimum years of experience filter — real column on
        // doctor_profiles.experience_years, no static values.
        if ($request->filled('min_experience')) {
            $query->where('experience_years', '>=', (int) $request->min_experience);
        }

        // NEW: Minimum rating filter — based on the real average of the
        // doctor's actual reviews (reviews.rating), computed live, not a
        // hardcoded/static number.
        if ($request->filled('min_rating')) {
            $query->withAvg('reviews', 'rating')
                ->having('reviews_avg_rating', '>=', (float) $request->min_rating);
        }

        $doctors = $query->paginate(12);

        // Timezone and Date Range for Availability
        $userTimezone = auth()->user()?->timezone ?? $request->query('timezone', 'UTC');
        $startDate = Carbon::now($userTimezone);
        $endDate = $startDate->copy()->addDays(6);

        // Pre-calculate availability + real rating data for the search results.
        foreach ($doctors as $doctor) {
            $doctor->availability = $doctor->getAvailabilityForRange($startDate, $endDate, $userTimezone);
            $doctor->avg_rating = round($doctor->reviews->avg('rating') ?: 0, 1);
            $doctor->reviews_count = $doctor->reviews->count();
        }

        $specialties = Specialty::all();

        return view('search.index', compact('doctors', 'specialties', 'userTimezone', 'startDate', 'endDate'));
    }

    /**
     * Display a public doctor profile.
     */
    public function showDoctor(Request $request, DoctorProfile $doctor)
    {
        $doctor->load(['user', 'specialties', 'reviews.patientProfile.user', 'insurancePlans.provider', 'schedules', 'appointments']);

        $featuredReview = $doctor->reviews()
            ->where('rating', '>=', 4)
            ->whereNotNull('comment')
            ->latest()
            ->first();

        $insuranceGroups = $doctor->insurancePlans
            ->groupBy(function ($plan) {
                return $plan->provider->name;
            });

        // Compares the insurance the patient searched with against this
        // doctor's actual listed insurancePlans, and only shows the
        // "in-network" badge when we have something to compare against.
        $searchedInsurance = $request->query('insurance');
        $isInNetwork = null;

        if ($searchedInsurance) {
            $isInNetwork = $doctor->insurancePlans->contains(function ($plan) use ($searchedInsurance) {
                return stripos($plan->name, $searchedInsurance) !== false
                    || stripos($plan->provider->name, $searchedInsurance) !== false;
            });
        }

        // Timezone and Date Range for Availability
        $userTimezone = auth()->user()?->timezone ?? $request->query('timezone', 'UTC');
        $startDate = \Carbon\Carbon::now($userTimezone);
        $endDate = $startDate->copy()->addDays(6);

        // Calculate availability
        $doctor->availability = $doctor->getAvailabilityForRange($startDate, $endDate, $userTimezone);

        return view('doctors.show', compact(
            'doctor',
            'featuredReview',
            'insuranceGroups',
            'userTimezone',
            'startDate',
            'endDate',
            'searchedInsurance',
            'isInNetwork'
        ));
    }
}