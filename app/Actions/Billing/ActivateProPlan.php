<?php

namespace App\Actions\Billing;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ActivateProPlan
{
    public function handle(User $user, array $metadata = []): void
    {
        DB::transaction(function () use ($user, $metadata) {
            $lockedUser = User::query()->whereKey($user->id)->lockForUpdate()->firstOrFail();

            $lockedUser->forceFill(['plan' => 'pro'])->save();

            $lockedUser->subscription()->updateOrCreate(
                ['provider' => 'mercadopago'],
                [
                    'status' => 'active',
                    'metadata' => $metadata,
                ]
            );
        });
    }
}
