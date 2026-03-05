<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Services\Payments\MercadoPagoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
{
    public function createPreference(Request $request, MercadoPagoService $mercadoPagoService): RedirectResponse
    {
        $validated = $request->validate([
            'plan_code' => ['required', 'string', 'in:pro_monthly'],
        ]);

        $user = $request->user();

        if ($user->isPro()) {
            return redirect()->route('pricing')->with('success', 'Ya tenés el plan Pro activo.');
        }

        try {
            $preference = $mercadoPagoService->createPreference($user, $validated['plan_code']);

            PaymentTransaction::create([
                'user_id' => $user->id,
                'provider' => 'mercadopago',
                'provider_preference_id' => $preference['id'],
                'status' => 'pending',
                'external_reference' => (string) $user->id,
                'raw_payload' => $preference['raw'] ?? null,
            ]);

            $checkoutUrl = $preference['init_point'] ?? $preference['sandbox_init_point'] ?? null;
            if (! $checkoutUrl) {
                return redirect()->route('pricing')->with('error', 'No se pudo iniciar el checkout.');
            }

            return redirect()->away($checkoutUrl);
        } catch (\Throwable $e) {
            Log::error('No se pudo crear la preferencia de Mercado Pago.', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('pricing')->with('error', 'No se pudo iniciar el pago en este momento.');
        }
    }

    public function success(): \Illuminate\View\View
    {
        return view('billing.success');
    }

    public function failure(): \Illuminate\View\View
    {
        return view('billing.failure');
    }

    public function pending(): \Illuminate\View\View
    {
        return view('billing.pending');
    }
}
