<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "DB Host: " . config('database.connections.mysql.host') . "\n";

$user = \App\Models\User::where('email', 'admin@medvroom.com')->first();

if ($user) {
    echo "FOUND user: " . $user->email . " | id: " . $user->id . "\n";
    print_r($user->toArray());
} else {
    echo "NOT FOUND — no user with that email.\n";
}
