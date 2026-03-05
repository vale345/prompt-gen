<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    public const FREE_PROMPT_LIMIT = 5;

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'plan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Get the user's prompts.
     */
    public function prompts()
    {
        return $this->hasMany(Prompt::class);
    }


    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function upgradeToPro(): void
    {
        DB::transaction(function () {
            $this->forceFill(['plan' => 'pro'])->save();

            $this->subscription()->updateOrCreate(
                ['provider' => 'mercadopago'],
                ['status' => 'active']
            );
        });
    }

    /**
     * Check if user has pro plan.
     */
    public function isPro(): bool
    {
        return $this->plan === 'pro';
    }

    /**
     * Check if user can generate one more prompt under their plan.
     */
    public function canCreatePrompt(): bool
    {
        if ($this->isPro()) {
            return true;
        }

        return $this->prompts()->count() < self::FREE_PROMPT_LIMIT;
    }
}
