<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\MercadoPagoWebhookController;

use App\Http\Controllers\PromptController;

// ── Landing ──────────────────────────────────────────────
Route::get('/', fn () => view('landing'))->name('landing');

// ── Pricing ──────────────────────────────────────────────
Route::get('/pricing', fn () => view('pricing'))->name('pricing');

// ── Auth ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Protected ────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Generator flow
    Route::get('/generator',               [GeneratorController::class, 'index'])->name('generator');
    Route::get('/generator/select/{field}', [GeneratorController::class, 'select'])->name('generator.select');
    Route::post('/generator/store/{field}', [GeneratorController::class, 'store'])->name('generator.store');
    Route::get('/generator/summary',       [GeneratorController::class, 'summary'])->name('generator.summary');
    Route::post('/generator/generate',     [GeneratorController::class, 'generate'])->middleware('prompt.quota')->name('generator.generate');
    Route::get('/generator/result/{prompt}',[GeneratorController::class, 'result'])->name('generator.result');

    // Billing
    Route::post('/billing/checkout', [BillingController::class, 'createPreference'])->name('billing.checkout');
    Route::get('/billing/success', [BillingController::class, 'success'])->name('billing.success');
    Route::get('/billing/failure', [BillingController::class, 'failure'])->name('billing.failure');
    Route::get('/billing/pending', [BillingController::class, 'pending'])->name('billing.pending');
});


// ── Prompt generator (public) ──────────────────────────
Route::get('/prompt-generator', [PromptController::class, 'index'])->name('prompt.form');
Route::post('/prompt-generator', [PromptController::class, 'generate'])->name('prompt.generate');
Route::get('/prompt-generator/result', [PromptController::class, 'result'])->name('prompt.result');

Route::post('/webhooks/mercadopago', [MercadoPagoWebhookController::class, 'handle'])->name('webhooks.mercadopago');
