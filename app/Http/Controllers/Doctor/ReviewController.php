<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Review;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Display the doctor's reviews and reputation analytics.
     */
    public function index(Request $request): View
    {
        $doctor = $request->user()->doctorProfile;
        
        $reviews = $doctor->reviews()
            ->with('appointment.patientProfile.user')
            ->latest()
            ->paginate(10);

        // Reputation Analytics
        $totalReviews = $doctor->reviews()->count();
        $averageRating = $doctor->reviews()->avg('rating') ?? 0;
        
        $ratingBreakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $doctor->reviews()->where('rating', $i)->count();
            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            $ratingBreakdown[$i] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        return view('doctor.reviews.index', compact('reviews', 'totalReviews', 'averageRating', 'ratingBreakdown'));
    }
}
