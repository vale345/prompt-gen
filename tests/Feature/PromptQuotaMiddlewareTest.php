<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PromptQuotaMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_free_user_cannot_generate_more_than_five_prompts(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['plan' => 'free']);

        $user->prompts()->createMany(array_fill(0, 5, [
            'content' => 'existing prompt',
            'selection' => ['personaje' => 'perro'],
        ]));

        $response = $this->actingAs($user)
            ->withSession(['generator' => ['personaje' => 'perro']])
            ->post(route('generator.generate'));

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error');
        $this->assertSame(5, $user->fresh()->prompts()->count());
    }

    public function test_pro_user_can_generate_after_five_prompts(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['plan' => 'pro']);

        $user->prompts()->createMany(array_fill(0, 5, [
            'content' => 'existing prompt',
            'selection' => ['personaje' => 'perro'],
        ]));

        $response = $this->actingAs($user)
            ->withSession(['generator' => ['personaje' => 'perro']])
            ->post(route('generator.generate'));

        $response->assertRedirect();
        $this->assertSame(6, $user->fresh()->prompts()->count());
    }
}
