<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\LegalAcceptance;
use App\Models\SystemSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PricingTermsController extends Controller
{
    private const SLUG = 'pricing-terms';
    private const VERSION = '1.0';
    private const SETTING_KEY = 'pricing_terms';

    public function index(Request $request): View
    {
        $profile = $request->user()->doctorProfile;

        $record = LegalAcceptance::where('doctor_profile_id', $profile->id)
            ->where('document_slug', self::SLUG)
            ->first();

        $pricingTerms = (object) [
            'version'     => $record->version ?? self::VERSION,
            'accepted_at' => $record?->accepted_at,
            'ip_address'  => $record?->ip_address,
        ];

        $content = $this->content();

        return view('doctor.pricing-terms.index', compact('pricingTerms', 'content'));
    }

    public function show(Request $request)
    {
        return redirect()->route('pricing');
    }

    /**
     * Clean PDF with just the pricing content — sourced from system_settings
     * (key: pricing_terms, populated by LegalContentSeeder), not scraped
     * from a public page.
     */
    public function download(Request $request)
    {
        $pdfHtml = view('doctor.legal.pdf', [
            'title'   => 'Pricing & Fee Terms',
            'version' => self::VERSION,
            'content' => $this->content(),
        ])->render();

        $pdf = Pdf::loadHTML($pdfHtml)->setPaper('letter');

        return $pdf->download('pricing-fee-terms.pdf');
    }

    private function content(): string
    {
        $value = SystemSetting::where('key', self::SETTING_KEY)->first()?->value;

        return $value['content'] ?? '<p>Please check back later.</p>';
    }
}
