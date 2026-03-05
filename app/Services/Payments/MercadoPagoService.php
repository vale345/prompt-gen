<?php

namespace App\Services\Payments;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class MercadoPagoService
{
    public function createPreference(User $user, string $planCode): array
    {
        $plan = config("billing.plans.{$planCode}");

        if (! $plan) {
            throw new RuntimeException('Plan de pago inválido.');
        }

        $accessToken = (string) Config::get('services.mercadopago.access_token');
        if ($accessToken === '') {
            throw new RuntimeException('Mercado Pago no está configurado. Definí MERCADOPAGO_ACCESS_TOKEN.');
        }

        $payload = [
            'items' => [[
                'title' => $plan['title'],
                'quantity' => 1,
                'unit_price' => (float) $plan['amount'],
                'currency_id' => $plan['currency'],
            ]],
            'external_reference' => (string) $user->id,
            'metadata' => [
                'user_id' => $user->id,
                'plan_code' => $planCode,
            ],
            'back_urls' => [
                'success' => route('billing.success'),
                'failure' => route('billing.failure'),
                'pending' => route('billing.pending'),
            ],
            'auto_return' => 'approved',
            'notification_url' => route('webhooks.mercadopago'),
        ];

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post('https://api.mercadopago.com/checkout/preferences', $payload)
            ->throw()
            ->json();

        return [
            'id' => $response['id'] ?? null,
            'init_point' => $response['init_point'] ?? null,
            'sandbox_init_point' => $response['sandbox_init_point'] ?? null,
            'raw' => $response,
        ];
    }


    public function isValidWebhook(Request $request): bool
    {
        $secret = (string) Config::get('services.mercadopago.webhook_secret');

        if ($secret === '') {
            return true;
        }

        $signature = (string) $request->header('x-signature', '');

        return $signature !== '';
    }

    public function parseWebhook(Request $request): ?array
    {
        $topic = $request->input('type') ?? $request->input('topic');
        $resourceId = $request->input('data.id') ?? $request->input('id');

        if ($topic !== 'payment' || ! $resourceId) {
            return null;
        }

        return [
            'topic' => $topic,
            'resource_id' => (string) $resourceId,
        ];
    }

    public function getPayment(string $paymentId): array
    {
        $accessToken = (string) Config::get('services.mercadopago.access_token');
        if ($accessToken === '') {
            throw new RuntimeException('Mercado Pago no está configurado. Definí MERCADOPAGO_ACCESS_TOKEN.');
        }

        return Http::withToken($accessToken)
            ->acceptJson()
            ->get("https://api.mercadopago.com/v1/payments/{$paymentId}")
            ->throw()
            ->json();
    }

    public function isApproved(array $payment): bool
    {
        return ($payment['status'] ?? null) === 'approved';
    }
}
