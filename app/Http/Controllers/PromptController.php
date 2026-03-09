<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromptController extends Controller
{
    public function index(): View
    {
        return view('prompt.form');
    }

    public function generate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_target' => ['required', 'in:midjourney,chatgpt,leonardo'],
            'character' => ['required', 'string', 'max:120'],
            'background' => ['required', 'string', 'max:120'],
            'style' => ['required', 'string', 'max:120'],
            'colors' => ['required', 'string', 'max:120'],
        ]);

        $prompt = match ($validated['ai_target']) {
            'midjourney' => $this->generateMidJourneyPrompt($validated),
            'chatgpt' => $this->generateChatGptPrompt($validated),
            'leonardo' => $this->generateLeonardoPrompt($validated),
            default => throw new \InvalidArgumentException('IA no soportada.'),
        };

        return redirect()->route('prompt.result')->with([
            'generated_prompt' => $prompt,
            'ai_target' => $validated['ai_target'],
        ]);
    }

    public function result(Request $request): View|RedirectResponse
    {
        $prompt = $request->session()->get('generated_prompt');
        $aiTarget = $request->session()->get('ai_target');

        if (! $prompt || ! $aiTarget) {
            return redirect()->route('prompt.form')
                ->with('error', 'Primero debes generar un prompt.');
        }

        return view('prompt.result', compact('prompt', 'aiTarget'));
    }

    private function generateMidJourneyPrompt(array $data): string
    {
        return "/imagine prompt: {$data['character']}, {$data['background']}, {$data['style']} style, {$data['colors']} color palette, ultra detailed, cinematic lighting --ar 16:9 --v 6";
    }

    private function generateChatGptPrompt(array $data): string
    {
        return "Create an image of {$data['character']} in {$data['background']}. Visual style: {$data['style']}. Use a {$data['colors']} color palette. High detail, coherent composition, modern digital art quality.";
    }

    private function generateLeonardoPrompt(array $data): string
    {
        return "{$data['character']} | background: {$data['background']} | style: {$data['style']} | colors: {$data['colors']} | highly detailed | sharp focus | volumetric light | 8k";
    }
}
