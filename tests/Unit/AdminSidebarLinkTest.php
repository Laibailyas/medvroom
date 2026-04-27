<?php

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

uses(TestCase::class);

it('renders the expected svg for each admin sidebar icon', function (string $icon, string $expectedSnippet): void {
    $html = Blade::render(
        <<<'BLADE'
<x-admin.sidebar-link href="/admin/test" :icon="$icon">
    Menu Item
</x-admin.sidebar-link>
BLADE,
        ['icon' => $icon]
    );

    expect($html)->toContain($expectedSnippet);
})->with([
    'article' => ['article', 'M14 2v6h6'],
    'doctor' => ['doctor', 'M13 15v4a2 2 0 0 1-2 2H5'],
    'specialty' => ['specialty', 'M12 3v18'],
    'symptom' => ['symptom', 'M22 12h-4l-3 9L9 3l-3 9H2'],
    'appointment' => ['appointment', 'M8 14h.01'],
    'help' => ['help', 'M9.09 9a3 3 0 0 1 5.82 1'],
    'mail' => ['mail', 'm22 7-8.97 5.7'],
    'moderation' => ['moderation', 'M12 8v4'],
]);
