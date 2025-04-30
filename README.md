
JWT Package:
=>composer require tymon/jwt-auth
=>php artisan vendor:publish 
--provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
=>php artisan jwt:secret
====================================

Midified config\auth.php

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'jwt', // Ensure the driver is set to 'jwt'
        'provider' => 'users',
    ],
],

=====================================