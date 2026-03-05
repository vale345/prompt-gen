<?php

namespace App\Http\Controllers;

use App\Actions\Billing\ActivateProPlan;
use App\Models\PaymentTransaction;
use App\Models\User;
use App\Services\Payments\MercadoPagoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MercadoPagoWebhookController extends Controller
{
    public function handle(Request $request, MercadoPagoService $mercadoPagoService, ActivateProPlan $activateProPlan): JsonResponse
    {
        Log::info('Webhook de Mercado Pago recibido.', [
            'payload' => $request->all(),
        ]);

        if (! $mercadoPagoService->isValidWebhook($request)) {
            Log::warning('Webhook de Mercado Pago rechazado por firma inválida.');

            return response()->json(['ok' => false], 401);
        }

        $event = $mercadoPagoService->parseWebhook($request);

        if (! $event) {
            return response()->json(['ok' => true, 'ignored' => true]);
        }

        try {
            $payment = $mercadoPagoService->getPayment($event['resource_id']);
            $externalReference = (string) ($payment['external_reference'] ?? '');
            $user = User::query()->find($externalReference);

            DB::transaction(function () use ($payment, $user, $activateProPlan) {
                $transaction = PaymentTransaction::query()->updateOrCreate(
                    ['provider_payment_id' => (string) ($payment['id'] ?? '')],
                    [
                        'user_id' => $user?->id,
                        'provider' => 'mercadopago',
                        'provider_preference_id' => $payment['order']['id'] ?? null,
                        'status' => (string) ($payment['status'] ?? 'pending'),
                        'amount' => $payment['transaction_amount'] ?? null,
                        'currency' => $payment['currency_id'] ?? null,
                        'external_reference' => $payment['external_reference'] ?? null,
                        'processed_at' => now(),
                        'raw_payload' => $payment,
                    ]
                );

                if ($user && $transaction->status === 'approved') {
                    $activateProPlan->handle($user, [
                        'payment_id' => $transaction->provider_payment_id,
                        'provider_preference_id' => $transaction->provider_preference_id,
                    ]);
                }
            });

            return response()->json(['ok' => true]);
        } catch (\Throwable $e) {
            Log::error('Error procesando webhook de Mercado Pago.', [
                'error' => $e->getMessage(),
                'payload' => $request->all(),
            ]);

            return response()->json(['ok' => false], 500);
        }
    }
}
