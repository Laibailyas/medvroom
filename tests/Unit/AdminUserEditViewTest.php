<?php

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

uses(TestCase::class);

test('doctor profile link in the admin user edit view points to provider management', function (): void {
    $viewContents = file_get_contents(base_path('resources/views/admin/users/edit.blade.php'));

    expect(Route::has('admin.providers.edit'))->toBeTrue()
        ->and($viewContents)->toContain("route('admin.providers.edit', \$user->doctorProfile)")
        ->and($viewContents)->not->toContain("route('admin.doctors.edit', \$user->doctorProfile)");
});
