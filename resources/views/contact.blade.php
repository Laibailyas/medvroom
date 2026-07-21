<?php
    $siteSettings = \App\Models\SystemSetting::where('key', 'site_settings')->first()?->value ?? [];
    $siteName = $siteSettings['site_name'] ?? config('app.name', 'MedVroom');
?>
<x-app-layout title="Contact Us" description="Get in touch with the {{ $siteName }} support team.">

<style>
    .contact-input {
        width: 100%;
        padding: 11px 14px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        outline: none;
        background: white;
        transition: border-color 0.2s;
    }
    .contact-input:focus { border-color: #1d4ed8; }
    .contact-input::placeholder { color: #9ca3af; }
</style>

<!-- Hero -->
<section style="background: linear-gradient(135deg, #e8f0fe 0%, #f0f4ff 60%, #dbeafe 100%); padding: 72px 24px 80px; text-align:center; position:relative; overflow:hidden;">
    <div style="position:absolute;top:0;right:0;width:320px;height:320px;background:white;border-radius:50%;opacity:0.2;transform:translate(30%,-30%);"></div>
    <div style="position:absolute;bottom:0;left:10%;width:200px;height:200px;background:#1d4ed8;border-radius:50%;opacity:0.05;transform:translateY(40%);"></div>
    <div style="position:relative;z-index:1;">
        <div style="display:inline-flex;align-items:center;gap:8px;background:white;border-radius:999px;padding:6px 16px;margin-bottom:20px;box-shadow:0 2px 12px rgba(29,78,216,0.1);">
            <span style="width:6px;height:6px;background:#1d4ed8;border-radius:50%;display:inline-block;"></span>
            <span style="font-family:'Inter',sans-serif;font-size:10px;font-weight:800;color:#1d4ed8;text-transform:uppercase;letter-spacing:0.15em;">Support</span>
        </div>
        <h1 style="font-family:'Inter',sans-serif;font-size:clamp(32px,4vw,52px);font-weight:900;color:#111827;line-height:1.1;margin-bottom:16px;">
            We're here to help
        </h1>
        <p style="font-family:'Inter',sans-serif;font-size:16px;color:#4b5563;font-weight:500;max-width:480px;margin:0 auto;line-height:1.7;">
            Questions about booking, insurance, or your account? Send us a message and our team will get back to you within 24 hours.
        </p>
    </div>
</section>

<!-- Main content -->
<section style="background:#f5f7ff;padding:64px 24px;">
    <div style="max-width:1000px;margin:0 auto;display:grid;grid-template-columns:1fr 1.4fr;gap:32px;align-items:start;">

        <!-- Left: info cards -->
        <div style="display:flex;flex-direction:column;gap:16px;">

            <!-- Email -->
            <div style="background:white;border-radius:20px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,0.05);display:flex;align-items:flex-start;gap:16px;">
                <div style="width:44px;height:44px;background:#e8f0fe;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg style="width:20px;height:20px;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p style="font-family:'Inter',sans-serif;font-size:10px;font-weight:800;color:#1d4ed8;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:4px;">Email Us</p>
                    <a href="mailto:Support@medvroom.com" style="font-family:'Inter',sans-serif;font-size:15px;font-weight:700;color:#111827;text-decoration:none;">Support@medvroom.com</a>
                    <p style="font-family:'Inter',sans-serif;font-size:12px;color:#9ca3af;margin-top:3px;">Response within 24 hours</p>
                </div>
            </div>

            <!-- For Providers -->
            <div style="background:white;border-radius:20px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,0.05);display:flex;align-items:flex-start;gap:16px;">
                <div style="width:44px;height:44px;background:#e8f0fe;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg style="width:20px;height:20px;color:#1d4ed8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <p style="font-family:'Inter',sans-serif;font-size:10px;font-weight:800;color:#1d4ed8;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:4px;">For Providers</p>
                    <p style="font-family:'Inter',sans-serif;font-size:14px;font-weight:700;color:#111827;">Want to list your practice?</p>
                    <a href="{{ route('register.doctor') }}" style="font-family:'Inter',sans-serif;font-size:12px;font-weight:600;color:#1d4ed8;text-decoration:none;">Get started here →</a>
                </div>
            </div>

            <!-- Trust block -->
            <div style="background:#1d4ed8;border-radius:20px;padding:28px 24px;color:white;position:relative;overflow:hidden;">
                <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;background:white;border-radius:50%;opacity:0.05;"></div>
                <p style="font-family:'Inter',sans-serif;font-size:16px;font-weight:800;margin-bottom:8px;">{{ $siteName }} Support</p>
                <p style="font-family:'Inter',sans-serif;font-size:12px;opacity:0.8;line-height:1.6;margin-bottom:20px;">We're committed to making your healthcare booking experience seamless and stress-free.</p>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    @foreach(['Available for patients & providers','Friendly, knowledgeable team','Fast, helpful responses'] as $item)
                    <div style="display:flex;align-items:center;gap:8px;">
                        <svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span style="font-family:'Inter',sans-serif;font-size:12px;font-weight:600;opacity:0.9;">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div style="background:white;border-radius:24px;padding:40px 36px;box-shadow:0 8px 40px rgba(0,0,0,0.08);">
            <h2 style="font-family:'Inter',sans-serif;font-size:22px;font-weight:800;color:#111827;margin-bottom:6px;">Send us a message</h2>
            <p style="font-family:'Inter',sans-serif;font-size:13px;color:#6b7280;margin-bottom:28px;">Fill in the details below and we'll get back to you shortly.</p>

            <form action="{{ route('contact.submit') }}" method="POST" style="display:flex;flex-direction:column;gap:16px;">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-family:'Inter',sans-serif;font-size:11px;font-weight:700;color:#374151;display:block;margin-bottom:6px;">First Name</label>
                        <input type="text" name="first_name" class="contact-input" placeholder="John" required>
                    </div>
                    <div>
                        <label style="font-family:'Inter',sans-serif;font-size:11px;font-weight:700;color:#374151;display:block;margin-bottom:6px;">Last Name</label>
                        <input type="text" name="last_name" class="contact-input" placeholder="Doe" required>
                    </div>
                </div>

                <div>
                    <label style="font-family:'Inter',sans-serif;font-size:11px;font-weight:700;color:#374151;display:block;margin-bottom:6px;">Email Address</label>
                    <input type="email" name="email" class="contact-input" placeholder="you@email.com" required>
                </div>

                <div>
                    <label style="font-family:'Inter',sans-serif;font-size:11px;font-weight:700;color:#374151;display:block;margin-bottom:6px;">I am a...</label>
                    <select name="role" class="contact-input" style="appearance:none;-webkit-appearance:none;cursor:pointer;">
                        <option value="">Select one</option>
                        <option value="patient">Patient looking for care</option>
                        <option value="provider">Healthcare provider</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label style="font-family:'Inter',sans-serif;font-size:11px;font-weight:700;color:#374151;display:block;margin-bottom:6px;">Subject</label>
                    <input type="text" name="subject" class="contact-input" placeholder="How can we help?" required>
                </div>

                <div>
                    <label style="font-family:'Inter',sans-serif;font-size:11px;font-weight:700;color:#374151;display:block;margin-bottom:6px;">Message</label>
                    <textarea name="message" class="contact-input" rows="5" placeholder="Tell us more about your question or concern..." required style="resize:vertical;"></textarea>
                </div>

                @if(session('success'))
                <div style="background:#e8f5e9;border-radius:10px;padding:12px 16px;font-family:'Inter',sans-serif;font-size:13px;font-weight:600;color:#1b5e20;">
                    ✓ {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div style="background:#fce8e8;border-radius:10px;padding:12px 16px;font-family:'Inter',sans-serif;font-size:13px;font-weight:600;color:#991b1b;">
                    Please fill in all required fields correctly.
                </div>
                @endif

                <button type="submit"
                        style="width:100%;background:#1d4ed8;color:white;border:none;border-radius:12px;padding:14px;font-family:'Inter',sans-serif;font-size:14px;font-weight:700;cursor:pointer;letter-spacing:0.02em;transition:background 0.2s;"
                        onmouseover="this.style.background='#1e40af'"
                        onmouseout="this.style.background='#1d4ed8'">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

</x-app-layout>