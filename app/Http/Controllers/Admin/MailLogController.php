<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailLog;

class MailLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = MailLog::latest()->paginate(20);

        return view('admin.mail-logs.index', compact('logs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MailLog $mailLog)
    {
        return view('admin.mail-logs.show', compact('mailLog'));
    }
}
