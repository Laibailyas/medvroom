<?php
    $siteSettings = \App\Models\SystemSetting::where('key', 'site_settings')->first()?->value ?? [];
    $siteName = $siteSettings['site_name'] ?? config('app.name', 'MedVroom');
    $title = 'Book local providers who take your insurance';
    $description = 'Find and book top-rated providers, dentists, and specialists who take your insurance. Read verified patient reviews and book appointments online instantly with ' . $siteName . '.';
?>
<x-app-layout :title="$title" :description="$description">

  <!-- Hero Section -->
<section class="relative overflow-hidden" style="min-height: 420px; padding-left: 100px; padding-right: 100px;">
    <img src="{{ asset('build/assets/herobg-img.png') }}"
         alt=""
         class="absolute inset-0 w-full h-full object-cover object-center">

    <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(210,228,248,0.95) 0%, rgba(210,228,248,0.80) 42%, rgba(210,228,248,0.10) 68%, transparent 100%);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 py-8 flex flex-col justify-between gap-6" style="min-height: 420px;">

        <!-- TOP ROW: Text left, image right -->
        <div class="flex flex-row items-start justify-between gap-6">

            <!-- LEFT: Headline + Features + Insurance -->
            <div class="flex flex-col flex-1 max-w-[52%]" style="padding-top:30px;">
                <h1 style="font-family: 'Inter', sans-serif; font-size: clamp(22px, 2.4vw, 30px); font-weight: 700; color: #111827; line-height: 1.28; letter-spacing: -0.5px; margin-bottom: 18px;">
                    Book Medical Experts for<br>
                    Home, Virtual, or In-Clinic Care.<br>
                    Book in Minutes. <span style="color: #1d4ed8;">Feel Better, Faster.</span>
                </h1>

                <div class="flex flex-wrap gap-5 mb-5">
                    @foreach([
                        ['d' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'label' => "Find Top-Rated\nDoctors Near You"],
                        ['d' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => "Book Appointments\nin Real-Time"],
                        ['d' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'label' => "Trusted by Millions.\nFocused on You."],
                    ] as $f)
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['d'] }}"/>
                        </svg>
                        <span style="font-family:'Inter',sans-serif; font-size:11px; font-weight:700; color:#1f2937; line-height:1.35; white-space:pre-line;">{{ $f['label'] }}</span>
                    </div>
                    @endforeach
                </div>

                <!-- Insurance block -->
                <div style="background: rgba(255,255,255,0.62); backdrop-filter: blur(8px); border-radius: 16px; padding: 14px 16px; display: flex; align-items: flex-start; gap: 12px; max-width: 340px;">
                    <div style="width:38px; height:38px; background:#dbeafe; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <svg style="width:18px;height:18px;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p style="font-family:'Inter',sans-serif; font-size:12px; font-weight:800; color:#111827; margin-bottom:3px;">Search by your insurance</p>
                        <p style="font-family:'Inter',sans-serif; font-size:11px; color:#4b5563; line-height:1.4;">We'll show in-network doctors<br>so you can save more.</p>
                        <div class="flex flex-wrap items-center gap-3 mt-2">
                            <img src="https://siyanclinical.com/wp-content/uploads/2024/07/Aetna-Logo.png" alt="Aetna" style="height:13px;object-fit:contain;">
                            <img src="https://painchas.com/wp-content/uploads/2015/05/BlueCross_BlueShield-logo.png" alt="BCBS" style="height:15px;object-fit:contain;">
                            <img src="https://azcarenetwork.org/wp-content/uploads/2019/01/cigna-logo-vector.png" alt="Cigna" style="height:13px;object-fit:contain;">
                            <img src="https://www.uhcprovider.com/etc.clientlibs/provider/clientlibs/resources/img/uhc-logo__download.png" alt="UHC" style="height:11px;object-fit:contain;">
                            <span style="font-size:10px;color:#6b7280;">and more</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: hero image area (optional decorative space) -->
            <div class="flex-1"></div>
        </div>

        <!-- BOTTOM: Full-width horizontal search bar -->
        <div x-data="searchBar()" style="background: white; border-radius: 16px; box-shadow: 0 8px 40px rgba(0,0,0,0.14); padding: 16px 20px; margin-bottom: 28px;">
            <p style="font-family:'Inter',sans-serif; font-size:11px; font-weight:700; color:#374151; margin-bottom:10px;">Find Care Near You</p>
            <div style="display:flex; gap:10px; align-items:center;">

                {{-- Specialty --}}
                <div style="flex:2; position:relative;">
                    <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);width:13px;height:13px;color:#9ca3af;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/></svg>
                    <input type="text" name="q" x-model="query" @input="fetchSuggestions" @blur="setTimeout(() => closeSuggestions(), 150)"
                           placeholder="Search by name, specialty, or condition"
                           style="width:100%;padding:10px 10px 10px 30px;font-family:'Inter',sans-serif;font-size:11px;color:#374151;border:1px solid #e5e7eb;border-radius:10px;outline:none;background:white;"
                           autocomplete="off">
                    <div x-show="showSuggestions && suggestions.length" style="position:absolute;top:calc(100% + 4px);left:0;right:0;background:white;border:1px solid #e5e7eb;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,0.10);z-index:50;overflow:hidden;">
                        <template x-for="(s,i) in suggestions" :key="i">
                            <button type="button" @mousedown.prevent="query=s;closeSuggestions()" style="width:100%;text-align:left;padding:8px 12px;font-size:11px;font-family:'Inter',sans-serif;font-weight:600;color:#374151;border:none;background:white;cursor:pointer;" x-text="s"></button>
                        </template>
                    </div>
                </div>

                {{-- Location --}}
                <div style="flex:1.2; position:relative;">
                    <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);width:13px;height:13px;color:#9ca3af;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    <input type="text" name="location" x-model="location" placeholder="Current Location"
                           style="width:100%;padding:10px 28px 10px 30px;font-family:'Inter',sans-serif;font-size:11px;color:#374151;border:1px solid #e5e7eb;border-radius:10px;outline:none;background:white;">
                    <button type="button" @click="detectLocation" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;">
                        <svg style="width:13px;height:13px;color:#9ca3af;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path stroke-linecap="round" d="M12 2v2m0 16v2M2 12h2m16 0h2"/></svg>
                    </button>
                </div>

                {{-- Insurance --}}
                <div style="flex:1.2; position:relative;">
                    <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);width:13px;height:13px;color:#9ca3af;pointer-events:none;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <select name="insurance" x-model="insurance"
                            style="width:100%;padding:10px 28px 10px 30px;font-family:'Inter',sans-serif;font-size:11px;color:#374151;border:1px solid #e5e7eb;border-radius:10px;outline:none;background:white;appearance:none;-webkit-appearance:none;">
                        <option value="">Select your insurance</option>
                        <option>Aetna</option>
                        <option>BlueCross BlueShield</option>
                        <option>Cigna</option>
                        <option>United Healthcare</option>
                        <option>Medicare</option>
                    </select>
                    <svg style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:13px;height:13px;color:#9ca3af;pointer-events:none;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </div>

                {{-- Button --}}
                <button type="button" @click="submitSearch" :disabled="loading"
                        style="flex-shrink:0;background:#1d4ed8;color:white;border:none;border-radius:10px;padding:10px 24px;font-family:'Inter',sans-serif;font-size:13px;font-weight:700;cursor:pointer;white-space:nowrap;">
                    <span x-show="!loading">Find Doctors</span>
                    <span x-show="loading">Searching...</span>
                </button>
            </div>

            <!-- NEW: validation message shown when all fields are empty -->
            <p x-show="errorMessage" x-text="errorMessage"
               style="font-family:'Inter',sans-serif; font-size:11px; color:#dc2626; font-weight:600; margin-top:8px;"></p>
        </div>

    </div>
</section>

    <!-- ─── Insurance Coverage Banner (redesigned per June 30 update, item 3) ─── -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div style="background:#eef2fc; border-radius:20px; padding:26px 32px; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:20px;">

                <!-- Left: icon + copy -->
                <div style="display:flex; align-items:center; gap:14px;">
                    <div style="width:46px;height:46px;background:white;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 6px rgba(29,78,216,0.08);">
                        <svg style="width:22px;height:22px;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25 6-6m4.5 3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="font-family:'Inter',sans-serif; font-size:16px; font-weight:800; color:#111827; margin-bottom:2px;">Find Care Covered by Your Insurance</p>
                        <p style="font-family:'Inter',sans-serif; font-size:13px; color:#6b7280;">Search trusted providers who accept your plan.</p>
                    </div>
                </div>

                <!-- Right: visit type icons -->
                <div style="display:flex; align-items:center; gap:22px;">
                    @foreach([
                        ['d' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Home Visits'],
                        ['d' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13.5h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Virtual Appointments'],
                        ['d' => 'M3 21h18M5 21V7l8-4v18M19 21V11l-6-4m-2 6h.01M9 12h.01M9 16h.01M13 16h.01', 'label' => 'Office Visits'],
                    ] as $i => $v)
                    @if($i > 0)<div style="width:1px;height:28px;background:#c7d3ef;"></div>@endif
                    <div style="display:flex; align-items:center; gap:7px;">
                        <svg style="width:16px;height:16px;color:#1d4ed8;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $v['d'] }}"/>
                        </svg>
                        <span style="font-family:'Inter',sans-serif; font-size:12.5px; font-weight:600; color:#1f2937; white-space:nowrap;">{{ $v['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Insurance carrier logos -->
            <div class="flex flex-wrap items-center justify-center gap-4 mt-6">
                <div class="flex items-center justify-center px-6 py-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all h-20 w-44">
                    <img style="width: 100px; height: 100px; object-fit: contain;" src="https://siyanclinical.com/wp-content/uploads/2024/07/Aetna-Logo.png"
                         alt="Aetna" class="max-h-8 w-auto object-contain">
                </div>
                <div class="flex items-center justify-center px-6 py-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all h-20 w-44">
                    <img style="width: 100px; height: 100px; object-fit: contain;" src="https://azcarenetwork.org/wp-content/uploads/2019/01/cigna-logo-vector.png"
                         alt="Cigna" class="max-h-8 w-auto object-contain">
                </div>
                <div style="width: 100px; height: 100px; object-fit: contain;" class="flex items-center justify-center px-6 py-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all h-20 w-44">
                    <img src="https://www.uhcprovider.com/etc.clientlibs/provider/clientlibs/resources/img/uhc-logo__download.png"
                         alt="United Healthcare" class="max-h-8 w-auto object-contain">
                </div>
                <div style="width: 100px; height: 100px; object-fit: contain;" class="flex items-center justify-center px-6 py-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all h-20 w-44">
                    <img src="https://logos-world.net/wp-content/uploads/2021/02/Medicare-Logo.png"
                         alt="Medicare" class="max-h-9 w-auto object-contain">
                </div>
                <div style="width: 100px; height: 100px; object-fit: contain;" class="flex items-center justify-center px-6 py-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all h-20 w-44">
                    <img src="https://painchas.com/wp-content/uploads/2015/05/BlueCross_BlueShield-logo.png"
                         alt="BlueCross BlueShield" class="max-h-10 w-auto object-contain">
                </div>
            </div>

        </div>
    </section>

   <!-- ─── Healthcare That Comes To You ─── -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden" >

                <!-- Top row: text (constrained width) + image -->
                <div class="grid lg:grid-cols-[1.05fr_1fr] gap-0 items-stretch" style="display: flex;">

                    <!-- Left: copy + visit-type cards -->
                    <div class="p-8 lg:p-10 flex flex-col justify-center" style="width: 100%;">
                        <h2 style="font-family:'Inter',sans-serif; font-size:clamp(24px,2.4vw,30px) !important; font-weight:700 !important; color:#111827; line-height:1.25; margin-bottom:14px;">
                            Healthcare Doesn't Always Belong<br>
                            <span style="color:#1d4ed8;">
                                <span style="position:relative; display:inline-block;">
                                    Inside
                                    <span style="position:absolute; left:0; bottom:-4px; width:60%; height:2px; background:#1d4ed8;"></span>
                                </span>
                                a Waiting Room.
                            </span>
                        </h2>
                        <p style="font-family:'Inter',sans-serif; font-size:13.5px; color:#4b5563; line-height:1.6; margin-bottom:14px; max-width:400px;">
                            Whether you're recovering at home,<br>
                            working remotely, caring for your family,<br>
                            or simply prefer the convenience—
                        </p>
                        <p style="font-family:'Inter',sans-serif; font-size:13px; font-weight:800; color:#111827; margin-bottom:14px;">{{ $siteName }} helps you find providers offering:</p>

                        <div class="grid grid-cols-3 gap-3">
                            @foreach([
                                ['icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'title'=>'Home Visits', 'desc'=>"Care comes<br>to you."],
                                ['icon'=>'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13.5h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title'=>'Virtual Appointments', 'desc'=>"Quality care,<br>wherever you are."],
                                ['icon'=>'M3 21h18M5 21V7l8-4v18M19 21V11l-6-4m-2 6h.01M9 12h.01M9 16h.01M13 16h.01', 'title'=>'Office Visits', 'desc'=>"In-person care<br>when you<br> need it."],
                            ] as $v)
                            <div style="background:white !important; border-radius:14px !important; padding:16px 14px 20px 14px !important; border:1px solid #e8ecf7 !important; border-bottom:3px solid #1d4ed8 !important;">
                                <div style="width:48px !important;height:48px !important;background:#eef2fc !important;border-radius:12px !important;display:flex;align-items:center;justify-content:center;margin-bottom:10px !important;">
                                    <svg style="width:26px !important;height:26px !important;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $v['icon'] }}"/></svg>
                                </div>
                                <p style="font-family:'Inter',sans-serif; font-size:15px !important; font-weight:800; color:#111827; margin-bottom:4px !important; line-height:1.25 !important;">{{ $v['title'] }}</p>
                                <p style="font-family:'Inter',sans-serif; font-size:12px !important; color:#6b7280; line-height:1.4 !important;">{!! $v['desc'] !!}</p>
                            </div>
                            @endforeach
                        </div>

                       
                    </div>

                    <!-- Right: single collage image -->
                    <div class="hidden lg:block" style="position:relative !important; overflow:hidden !important; min-height:420px !important; width:100% !important; height:100% !important;">
                        <img src="{{ asset('build/assets/rightcolimg.png') }}"
                             alt="Home Visits, Virtual Appointments, Office Visits"
                             style="display:block !important; width:100% !important; height:100% !important; min-height:420px !important; object-fit:cover !important; object-position:center !important;"
                             onerror="this.style.display='none'">
                    </div>

                </div>
                
                 <!-- Search Now + Trust badges (constrained to left col, bigger) -->
                        <div class="flex flex-wrap items-center gap-6 mt-7" style="justify-content: space-between; padding-left: 32px;
    padding-right: 32px;
    padding-bottom: 50px;">
                            <div class="searchbtn">
                            <a href="{{ route('search') }}" style="flex-shrink:0; display:inline-flex;align-items:center;gap:10px;background:#1d4ed8;color:white;border-radius:12px !important;padding:16px 30px !important;font-family:'Inter',sans-serif;font-size:15px !important;font-weight:700;text-decoration:none;white-space:nowrap;">
                                Search Now
                                <svg style="width:17px !important;height:17px !important;" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
</div>





<div class="iconsss" style="display: flex; gap: 52px;">
    @foreach([
        ['icon'=>'M9 12.75l2.25 2.25 6-6m4.5 3a9 9 0 11-18 0 9 9 0 0118 0z', 'label'=>"Trusted\nProviders"], {{-- OLD, keep or remove --}}
        ['icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label'=>"Easy\nScheduling"],
        ['icon'=>'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z', 'label'=>"Insurance\nAccepted"], {{-- OLD, keep or remove --}}
        ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'label'=>"Care That\nFits Your Life"],
    ] as $t)
    <div class="flex items-center gap-2.5" style="flex-shrink:0;">
        <svg style="width:30px !important;height:30px !important;color:#1d4ed8;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $t['icon'] }}"/></svg>
        <span style="font-family:'Inter',sans-serif; font-size:15px !important; font-weight:700; color:#1f2937; line-height:1.28 !important; white-space:pre-line;">{{ $t['label'] }}</span>
    </div>
    @endforeach
</div>




                        </div>

            </div>
        </div>
    </section>



    <!-- ─── Top-Searched Specialties (heading text updated per item 5) ─── -->
<section class="py-16 bg-[#f5f7ff]" style="padding-left: 100px; padding-right: 100px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-10">
            <h2 style="font-family:'Inter',sans-serif; font-size:clamp(28px,3vw,38px); font-weight:700; color:#111827; line-height:1.2; margin-bottom:10px;">
                Find Care by <span style="color:#3b82f6;">Specialty</span>
            </h2>
            <p style="font-family:'Inter',sans-serif; font-size:14px; color:#6b7280; font-weight:500;">
                Find trusted providers and book care that fits <span style="color:#3b82f6; font-weight:700;">your life.</span>
            </p>
        </div>

        <!-- 3x2 Grid -->
        @php
        $specialtyData = [
            ['name'=>'Primary Care',      'desc'=>'General health for you and your family', 'bg'=>'#e8f0fe','icon_bg'=>'#c7d8fb','icon_color'=>'#4285f4','btn_color'=>'#4285f4',
             'img'=>'doc1.png',
             'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
            ['name'=>'Dentist',           'desc'=>'Dental care for a healthy smile',        'bg'=>'#e0f5ef','icon_bg'=>'#b3e8d8','icon_color'=>'#0ea5a0','btn_color'=>'#0ea5a0',
             'img'=>'doc2.png',
             'icon'=>'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['name'=>'Therapist',         'desc'=>'Mental health and wellness support',     'bg'=>'#f0e8ff','icon_bg'=>'#dcc9f8','icon_color'=>'#9333ea','btn_color'=>'#9333ea',
             'img'=>'doc3.png',
             'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ['name'=>'Cosmetic Injector', 'desc'=>'Enhance your natural beauty',           'bg'=>'#fde8f3','icon_bg'=>'#f8c4df','icon_color'=>'#ec4899','btn_color'=>'#ec4899',
             'img'=>'doc4.png',
             'icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            ['name'=>'Eye doctor',        'desc'=>'Vision care for a clear tomorrow',      'bg'=>'#e8f0fe','icon_bg'=>'#c7d8fb','icon_color'=>'#4285f4','btn_color'=>'#4285f4',
             'img'=>'doc5.png',
             'icon'=>'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
            ['name'=>'Dermatologist',     'desc'=>'Healthy skin, confident you',           'bg'=>'#fff0e0','icon_bg'=>'#ffd9a8','icon_color'=>'#f97316','btn_color'=>'#f97316',
             'img'=>'doc6.png',
             'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
        ];
        @endphp

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px;">
            @foreach($specialtyData as $sp)
            <a href="{{ route('search', ['q' => $sp['name']]) }}"
               style="border-radius:18px; overflow:hidden; display:flex; flex-direction:row; height:160px; text-decoration:none; background:{{ $sp['bg'] }}; transition: transform 0.2s, box-shadow 0.2s;"
               onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.12)'"
               onmouseout="this.style.transform='';this.style.boxShadow=''">

                <!-- Left: icon + text + button -->
                <div style="flex:0 0 54%; padding:14px 12px; display:flex; flex-direction:column; justify-content:space-between; padding-left: 30px !important;">
                    <div>
                        <div style="width:34px;height:34px;border-radius:9px;background:{{ $sp['icon_bg'] }};display:flex;align-items:center;justify-content:center;margin-bottom:7px;">
                            <svg style="width:19px;height:19px;color:{{ $sp['icon_color'] }};" fill="none" stroke="{{ $sp['icon_color'] }}" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $sp['icon'] }}"/>
                            </svg>
                        </div>
                        <div style="font-family:'Inter',sans-serif; font-size:14px; font-weight:800; color:#111827; line-height:1.2;">{{ $sp['name'] }}</div>
                        <div style="font-family:'Inter',sans-serif; font-size:10.5px; color:#4b5563; line-height:1.4; margin-top:4px; font-weight:500;">{{ $sp['desc'] }}</div>
                    </div>
                    <div style="width:28px;height:28px;border-radius:50%;background:{{ $sp['btn_color'] }};display:flex;align-items:center;justify-content:center;margin-top:8px;">
                        <svg style="width:12px;height:12px;" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>

                <!-- Right: doctor image -->
                <div style="flex:1; position:relative; overflow:hidden; ">
                    <img src="{{ asset('build/assets/' . $sp['img']) }}"
                         alt="{{ $sp['name'] }}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:top center;"
                         onerror="this.style.display='none'">
                </div>
            </a>
            @endforeach
        </div>

        <!-- Explore All -->
        <div style="text-align:center; margin-top:36px;">
            <a href="{{ route('search') }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border:2px solid #1e293b;border-radius:999px;font-family:'Inter',sans-serif;font-size:12px;font-weight:800;color:#1e293b;text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:all 0.2s;"
               onmouseover="this.style.background='#1e293b';this.style.color='white'"
               onmouseout="this.style.background='';this.style.color='#1e293b'">
                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Explore all specialties
            </a>
        </div>
    </div>
</section>


    <!-- ─── Care Section: MedVroom Helps You Get The Care You Need ─── -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-64 h-64 bg-[#012AE0]/5 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <h2 style="font-family:'Inter',sans-serif; font-size:clamp(28px,3vw,38px); font-weight:700; color:#111827; line-height:1.2; margin-bottom:10px;">
                <span style="color:#3b82f6;">Healthcare</span> That Comes <br>To You
            </h2>
            
             <p style="font-family:'Inter',sans-serif; font-size:14px; color:#6b7280; font-weight:500;">
                Find trusted providers, book instantly, and manage your care all in one place.
            </p>
            
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1: Find Providers -->
                <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-lg shadow-indigo-900/5 border border-slate-100 flex flex-col transition-all duration-500 hover:shadow-xl hover:shadow-indigo-900/10 hover:-translate-y-2">
                    <div class="h-64 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?q=80&w=800&auto=format&fit=crop"
                             alt="Find Providers"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-[#e8f5f0] flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-[#22a06b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-800 leading-tight">Find Providers</h3>
                                <p class="text-sm font-medium text-slate-500 mt-1 leading-relaxed">Search and compare trusted healthcare providers near you.</p>
                            </div>
                        </div>
                        <a href="{{ route('search') }}" class="mt-auto inline-flex flex-col items-start group/btn">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/btn:text-slate-900 transition-colors">Start searching</span>
                            <div class="h-1 w-12 bg-[#22a06b] mt-2 group-hover/btn:w-20 transition-all duration-500 rounded-full"></div>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Book Instantly -->
                <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-lg shadow-indigo-900/5 border border-slate-100 flex flex-col transition-all duration-500 hover:shadow-xl hover:shadow-indigo-900/10 hover:-translate-y-2">
                    <div class="h-64 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=800&auto=format&fit=crop"
                             alt="Book Instantly"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-[#eef2ff] flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-[#6366f1]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-800 leading-tight">Book Instantly</h3>
                                <p class="text-sm font-medium text-slate-500 mt-1 leading-relaxed">Schedule appointments quickly and securely online.</p>
                            </div>
                        </div>
                        <a href="{{ route('search', ['sort' => 'reviews']) }}" class="mt-auto inline-flex flex-col items-start group/btn">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/btn:text-slate-900 transition-colors">View providers</span>
                            <div class="h-1 w-12 bg-[#6366f1] mt-2 group-hover/btn:w-20 transition-all duration-500 rounded-full"></div>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Manage Your Care -->
                <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-lg shadow-indigo-900/5 border border-slate-100 flex flex-col transition-all duration-500 hover:shadow-xl hover:shadow-indigo-900/10 hover:-translate-y-2">
                    <!-- Abstract UI illustration -->
                    <div class="h-64 overflow-hidden relative bg-[#f0eeff] flex items-center justify-center">
                        <div class="absolute top-8 right-8 w-24 h-24 bg-[#012AE0]/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                        <div class="relative z-10 bg-white rounded-2xl shadow-xl p-6 mx-6 w-full max-w-[240px] transform group-hover:rotate-1 transition-transform duration-500">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-full bg-[#f0eeff] flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#012AE0]" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="h-2.5 w-20 bg-slate-200 rounded mb-1.5"></div>
                                    <div class="h-2 w-14 bg-slate-100 rounded"></div>
                                </div>
                                <div class="flex gap-0.5">
                                    @for($i=0;$i<5;$i++)<span class="text-yellow-400 text-xs">★</span>@endfor
                                </div>
                            </div>
                            <div class="h-3 w-full bg-[#012AE0]/20 rounded-full mb-3"></div>
                            <div class="h-3 w-3/4 bg-slate-100 rounded-full"></div>
                        </div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-[#f0eeff] flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-[#012AE0]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-800 leading-tight">Manage Your Care</h3>
                                <p class="text-sm font-medium text-slate-500 mt-1 leading-relaxed">Keep track of your health, appointments, and progress.</p>
                            </div>
                        </div>
                        <a href="{{ route('search', ['filters' => 'active']) }}" class="mt-auto inline-flex flex-col items-start group/btn">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/btn:text-slate-900 transition-colors">Get started</span>
                            <div class="h-1 w-12 bg-[#012AE0] mt-2 group-hover/btn:w-20 transition-all duration-500 rounded-full"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>




<!-- ─── Practice CTA: single combined image, full width ─── -->
<section style="padding:0; margin:0; line-height:0;">
    <img src="{{ asset('build/assets/combined-bg-img.png') }}"
         alt=""
         style="display:block; width:100%; height:auto;">
</section>

    <!-- Footer Grids -->
   

<!-- ─── Contact Section ─── -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-[2.5rem] overflow-hidden" style="background: linear-gradient(135deg, #e8f0fe 0%, #f0f4ff 50%, #dbeafe 100%); padding: 64px 80px;">
            
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/20 rounded-full -translate-y-1/3 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-1/4 w-40 h-40 bg-[#1d4ed8]/5 rounded-full translate-y-1/2"></div>
            

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
                <!-- Left: Text -->
                <div class="max-w-lg">
                    <div class="inline-flex items-center gap-2 mb-4">
                     
                        <span style="font-family:'Inter',sans-serif; font-size:11px; font-weight:800; color:#1d4ed8; text-transform:uppercase; letter-spacing:0.15em;">Support & Help</span>
                    </div>
                    <h2 style="font-family:'Inter',sans-serif; font-size:clamp(28px,3vw,40px); font-weight:700; color:#111827; line-height:1.15; margin-bottom:16px;">
                        We're here<br>to help you.
                    </h2>
                    <p style="font-family:'Inter',sans-serif; font-size:15px; color:#4b5563; line-height:1.7; font-weight:500; max-width:420px;">
                        Have a question about booking, insurance, or finding the right provider? Our support team is ready to assist you — quickly and kindly.
                    </p>

                    <!-- 3 mini trust points -->
                    <div class="flex flex-col gap-3 mt-6">
                        @foreach([
                            ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text'=>'Dedicated support for every patient'],
                            ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text'=>'Typical response within 24 hours'],
                            ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'text'=>'Your satisfaction is our priority'],
                        ] as $pt)
                        <div class="flex items-center gap-3">
                            <div style="width:30px;height:30px;background:rgba(29,78,216,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:15px;height:15px;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $pt['icon'] }}"/>
                                </svg>
                            </div>
                            <span style="font-family:'Inter',sans-serif; font-size:13px; font-weight:600; color:#374151;">{{ $pt['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right: CTA card -->
                <div style="background:white; border-radius:24px; padding:36px 32px; min-width:260px; text-align:center; box-shadow:0 12px 48px rgba(29,78,216,0.12);">
                    <div style="width:56px;height:56px;background:#e8f0fe;border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <svg style="width:26px;height:26px;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <p style="font-family:'Inter',sans-serif; font-size:18px; font-weight:800; color:#111827; margin-bottom:8px;">Get in Touch</p>
                    <p style="font-family:'Inter',sans-serif; font-size:12px; color:#6b7280; line-height:1.6; margin-bottom:24px;">Fill out our contact form and we'll get back to you as soon as possible.</p>
                    <a href="{{ route('contact') }}"
                       style="display:block;width:100%;background:#1d4ed8;color:white;border-radius:12px;padding:13px 24px;font-family:'Inter',sans-serif;font-size:13px;font-weight:700;text-decoration:none;text-align:center;letter-spacing:0.02em;transition:background 0.2s;"
                       onmouseover="this.style.background='#1e40af'"
                       onmouseout="this.style.background='#1d4ed8'">
                        Contact Us
                    </a>
                    <a href="mailto:Support@medvroom.com"
                       style="display:block;margin-top:12px;font-family:'Inter',sans-serif;font-size:12px;font-weight:600;color:#1d4ed8;text-decoration:none;">
                        Support@medvroom.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Alpine.js Search Logic -->
    <script>
        function searchBar() {
            return {
                query: '',
                location: '',
                insurance: '',
                suggestions: [],
                showSuggestions: false,
                activeIndex: -1,
                loading: false,
                errorMessage: '', // NEW: holds the "please fill a field" message

                allSpecialties: [
                    'Primary Care', 'OB-GYN', 'Dentist', 'Psychiatrist', 'Dermatologist',
                    'Therapist', 'Cosmetic Injector', 'Cardiologist', 'Pediatrician',
                    'Orthopedic Surgeon', 'Neurologist', 'Ophthalmologist', 'Eye Doctor',
                    'Urologist', 'Endocrinologist', 'Gastroenterologist', 'Allergist',
                    'Rheumatologist', 'Oncologist', 'Physical Therapist',
                    'Internal Medicine', 'Family Medicine', 'General Surgeon'
                ],

                fetchSuggestions() {
                    if (this.query.length < 2) {
                        this.suggestions = [];
                        this.showSuggestions = false;
                        return;
                    }
                    const q = this.query.toLowerCase();
                    this.suggestions = this.allSpecialties
                        .filter(s => s.toLowerCase().includes(q))
                        .slice(0, 6);
                    this.showSuggestions = this.suggestions.length > 0;
                    this.activeIndex = -1;
                },

                moveSuggestion(dir) {
                    if (!this.showSuggestions) return;
                    this.activeIndex = Math.max(-1, Math.min(this.suggestions.length - 1, this.activeIndex + dir));
                    if (this.activeIndex >= 0) this.query = this.suggestions[this.activeIndex];
                },

                selectSuggestion() {
                    if (this.activeIndex >= 0) {
                        this.query = this.suggestions[this.activeIndex];
                        this.closeSuggestions();
                    }
                    this.submitSearch();
                },

                closeSuggestions() {
                    this.showSuggestions = false;
                    this.activeIndex = -1;
                },

                detectLocation() {
                    if (!navigator.geolocation) return;
                    navigator.geolocation.getCurrentPosition(async (pos) => {
                        try {
                            const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${pos.coords.latitude}&lon=${pos.coords.longitude}&format=json`);
                            const data = await res.json();
                            this.location = data.address.city || data.address.town || data.address.village || data.address.postcode || '';
                        } catch {
                            this.location = `${pos.coords.latitude.toFixed(4)}, ${pos.coords.longitude.toFixed(4)}`;
                        }
                    });
                },

                submitSearch() {
                    // NEW: block navigation and show a message if every field is empty
                    if (!this.query.trim() && !this.location.trim() && !this.insurance.trim()) {
                        this.errorMessage = 'Please fill at least one field to search.';
                        return;
                    }
                    this.errorMessage = '';

                    const params = new URLSearchParams();
                    if (this.query.trim())     params.set('q', this.query.trim());
                    if (this.location.trim())  params.set('location', this.location.trim());
                    if (this.insurance.trim()) params.set('insurance', this.insurance.trim());
                    this.loading = true;
                    window.location.href = `{{ route('search') }}?${params.toString()}`;
                }
            }
        }
    </script>

</x-app-layout>