<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SmsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = SmsLog::query();

        // Search by recipient or body
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('recipient', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $smsLogs = $query->latest()->paginate(20);

        return view('admin.sms-logs.index', compact('smsLogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SmsLog $smsLog): View
    {
        return view('admin.sms-logs.show', compact('smsLog'));
    }
}
