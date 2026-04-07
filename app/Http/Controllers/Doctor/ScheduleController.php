<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display the settings for doctor's weekly schedules.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            return redirect()->route('dashboard')->with('error', 'Doctor profile not found.');
        }

        // Get schedules keyed by day of week
        $schedules = $doctorProfile->schedules->keyBy('day_of_week');

        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        return view('doctor.schedule.index', compact('schedules', 'days'));
    }

    /**
     * Store the updated schedules.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            return redirect()->route('dashboard')->with('error', 'Doctor profile not found.');
        }

        $validated = $request->validate([
            'consultation_fee' => 'nullable|numeric|min:0',
            'schedules' => 'array',
            'schedules.*.enabled' => 'nullable|boolean',
            'schedules.*.start_time' => 'nullable|date_format:H:i',
            'schedules.*.end_time' => 'nullable|date_format:H:i|after:schedules.*.start_time',
            'schedules.*.slot_duration_minutes' => 'nullable|integer|min:10|max:120',
        ]);

        DB::transaction(function () use ($doctorProfile, $validated) {
            if (isset($validated['consultation_fee'])) {
                $doctorProfile->update(['consultation_fee' => $validated['consultation_fee']]);
            }

            $inputSchedules = $validated['schedules'] ?? [];

            foreach ($inputSchedules as $day_of_week => $scheduleInput) {
                $enabled = !empty($scheduleInput['enabled']);

                if ($enabled) {
                    DoctorSchedule::updateOrCreate(
                        [
                            'doctor_profile_id' => $doctorProfile->id,
                            'day_of_week' => $day_of_week,
                        ],
                        [
                            'start_time' => $scheduleInput['start_time'] ?? '09:00',
                            'end_time' => $scheduleInput['end_time'] ?? '17:00',
                            'slot_duration_minutes' => $scheduleInput['slot_duration_minutes'] ?? 30,
                        ]
                    );
                } else {
                    DoctorSchedule::where('doctor_profile_id', $doctorProfile->id)
                        ->where('day_of_week', $day_of_week)
                        ->delete();
                }
            }
        });

        return back()->with('success', 'Schedule updated successfully.');
    }
}
