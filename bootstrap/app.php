<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // ✅ Đúng Middleware class
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function (): void {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'))
                ->name('api.');
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ✅ Dùng alias từng middleware một cách chính xác

        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Tuỳ chỉnh xử lý ngoại lệ ở đây nếu cần
    })
    ->withProviders([
        \App\Providers\AuthServiceProvider::class,
    ])
    ->create();
