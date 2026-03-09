<?php

namespace Tests\Feature;

use Tests\TestCase;

class PromptControllerTest extends TestCase
{
    public function test_prompt_form_page_is_accessible(): void
    {
        $response = $this->get(route('prompt.form'));

        $response->assertOk();
    }

    public function test_it_generates_midjourney_prompt_and_redirects_to_result(): void
    {
        $payload = [
            'ai_target' => 'midjourney',
            'character' => 'samurai',
            'background' => 'ancient temple',
            'style' => 'cinematic',
            'colors' => 'warm tones',
        ];

        $response = $this->post(route('prompt.generate'), $payload);

        $response->assertRedirect(route('prompt.result'));
        $response->assertSessionHas('generated_prompt', fn (string $prompt): bool => str_contains($prompt, '/imagine prompt:'));
    }

    public function test_it_generates_chatgpt_prompt_and_redirects_to_result(): void
    {
        $payload = [
            'ai_target' => 'chatgpt',
            'character' => 'pilot',
            'background' => 'desert',
            'style' => 'watercolor',
            'colors' => 'pastel',
        ];

        $response = $this->post(route('prompt.generate'), $payload);

        $response->assertRedirect(route('prompt.result'));
        $response->assertSessionHas('generated_prompt', fn (string $prompt): bool => str_contains($prompt, 'Create an image of'));
    }

    public function test_it_generates_leonardo_prompt_and_redirects_to_result(): void
    {
        $payload = [
            'ai_target' => 'leonardo',
            'character' => 'cyborg',
            'background' => 'space station',
            'style' => 'sci-fi',
            'colors' => 'blue and silver',
        ];

        $response = $this->post(route('prompt.generate'), $payload);

        $response->assertRedirect(route('prompt.result'));
        $response->assertSessionHas('generated_prompt', fn (string $prompt): bool => str_contains($prompt, 'highly detailed'));
    }
}
