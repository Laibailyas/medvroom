<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::create([
    'name' => 'Admin',
    'email' => 'admin@medvroom.com',
    'password' => Hash::make('Admin@123456'),
    'role' => 'admin',
]);

echo "Admin created successfully.\n";
echo "ID: {$user->id}\n";
