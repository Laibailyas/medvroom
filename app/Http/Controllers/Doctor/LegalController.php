<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\LegalAcceptance;
use App\Models\SystemSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalController extends Controller
{
    private const DOCUMENTS = [
        'provider-agreement' => [
            'title'         => 'Provider Agreement',
            'version'       => '1.0',
            'route'         => 'provider-agreement',
            'setting_key'   => 'provider_agreement',
        ],
        'baa' => [
            'title'         => 'Business Associate Agreement (BAA)',
            'version'       => '1.0',
            'route'         => 'baa',
            // Now sourced from system_settings (key: baa) via LegalContentSeeder,
            // same as the other documents — no more page-scraping fallback.
            'setting_key'   => 'baa',
        ],
        'insurance-accuracy' => [
            'title'         => 'Insurance Accuracy Attestation',
            'version'       => '1.0',
            'route'         => 'acceptable-use-policy',
            // Not provided yet — will show "Please check back later."
            // until a system_settings row with key `acceptable_use_policy` exists.
            'setting_key'   => 'acceptable_use_policy',
        ],
        'payment-authorization' => [
            'title'         => 'Payment Authorization',
            'version'       => '1.0',
            'route'         => 'terms',
            // Not provided yet — will show "Please check back later."
            // until a system_settings row with key `terms_conditions` exists.
            'setting_key'   => 'terms_conditions',
        ],
    ];

    public function index(Request $request): View
    {
        $profile = $request->user()->doctorProfile;

        $records = LegalAcceptance::where('doctor_profile_id', $profile->id)
            ->get()
            ->keyBy('document_slug');

        $documents = collect(self::DOCUMENTS)->map(function ($doc, $slug) use ($records) {
            $record = $records->get($slug);

            return (object) [
                'slug'        => $slug,
                'title'       => $doc['title'],
                'version'     => $record->version ?? $doc['version'],
                'accepted_at' => $record?->accepted_at,
                'ip_address'  => $record?->ip_address,
            ];
        })->values();

        return view('doctor.legal.index', compact('documents'));
    }

    public function show(Request $request, string $document)
    {
        $doc = self::DOCUMENTS[$document] ?? abort(404);

        return redirect()->route($doc['route']);
    }

    /**
     * Streams a clean PDF containing ONLY the agreement's title + body
     * text — never the site's nav/header/footer chrome.
     *
     * Requires: composer require barryvdh/laravel-dompdf
     */
    public function download(Request $request, string $document)
    {
        $doc = self::DOCUMENTS[$document] ?? abort(404);

        $content = $this->contentFromSetting($doc['setting_key'], $doc['title']);

        $html = view('doctor.legal.pdf', [
            'title'   => $doc['title'],
            'version' => $doc['version'],
            'content' => $content,
        ])->render();

        $pdf = Pdf::loadHTML($html)->setPaper('letter');

        return $pdf->download(str_replace(' ', '-', strtolower($doc['title'])).'.pdf');
    }

    /**
     * Content stored in system_settings (same source PageController uses).
     * Populated by database/seeders/LegalContentSeeder.php for
     * `provider_agreement` and `baa`. `acceptable_use_policy` and
     * `terms_conditions` don't have content yet, so those two documents
     * show "Please check back later." until they're added.
     */
    private function contentFromSetting(string $key, string $fallbackTitle): string
    {
        $value = SystemSetting::where('key', $key)->first()?->value;

        return $value['content'] ?? '<p>Please check back later.</p>';
    }
}
