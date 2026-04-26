<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the About Us page.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display the Contact Us page.
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacy(): View
    {
        return view('privacy');
    }

    /**
     * Display the Terms & Conditions page.
     */
    public function terms(): View
    {
        return view('terms');
    }
}
