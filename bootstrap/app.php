<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust semua proxy (termasuk Cloudflare) agar Laravel
        // membaca X-Forwarded-Proto dengan benar → URL jadi https://
        $middleware->trustProxies(at: '*');

        // Kecualikan route approve/reject dari CSRF verification
        // karena route ini juga diakses oleh n8n/Telegram (external service)
        $middleware->validateCsrfTokens(except: [
            'admin/order/approve/*',
            'admin/order/reject/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
