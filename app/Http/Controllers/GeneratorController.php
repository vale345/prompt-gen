<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class GeneratorController extends Controller
{
    use AuthorizesRequests;
    /**
     * Main configurator screen with 5 cards.
     */
    public function index(Request $request)
    {
        $fields    = config('promptgen.fields');
        $selection = $request->session()->get('generator', []);

        return view('generator.index', compact('fields', 'selection'));
    }

    /**
     * Selection grid for a specific field.
     */
    public function select(Request $request, string $field)
    {
        $fields = config('promptgen.fields');

        if (! isset($fields[$field])) {
            abort(404);
        }

        $fieldConfig = $fields[$field];
        $current     = $request->session()->get("generator.{$field}");

        return view('generator.selection', compact('field', 'fieldConfig', 'current'));
    }

    /**
     * Store the selected value for a field in session.
     */
    public function store(Request $request, string $field)
    {
        $fields = config('promptgen.fields');

        if (! isset($fields[$field])) {
            abort(404);
        }

        $value = $request->input('value');

        if ($value) {
            $request->session()->put("generator.{$field}", $value);
        } else {
            $request->session()->forget("generator.{$field}");
        }

        return redirect()->route('generator');
    }

    /**
     * Summary of current selection.
     */
    public function summary(Request $request)
    {
        $fields    = config('promptgen.fields');
        $selection = $request->session()->get('generator', []);

        if (empty($selection['personaje'])) {
            return redirect()->route('generator')
                ->with('error', 'Debes seleccionar un personaje antes de continuar.');
        }

        $finalPrompt = $this->buildPrompt($selection, $fields);

        return view('generator.summary', compact('fields', 'selection', 'finalPrompt'));
    }

    /**
     * Generate the final prompt and save it.
     */
    public function generate(Request $request)
    {
        $selection = $request->session()->get('generator', []);

        if (empty($selection['personaje'])) {
            return redirect()->route('generator')
                ->with('error', 'Debes seleccionar un personaje.');
        }

        if (! $request->user()->canCreatePrompt()) {
            return redirect()->route('dashboard')
                ->with('error', 'Has alcanzado el límite de 5 prompts del plan gratuito.');
        }

        $fields = config('promptgen.fields');
        $content = $this->buildPrompt($selection, $fields);

        $prompt = DB::transaction(function () use ($request, $content, $selection) {
            $lockedUser = User::query()
                ->whereKey($request->user()->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (! $lockedUser->canCreatePrompt()) {
                return null;
            }

            return $lockedUser->prompts()->create([
                'content'   => $content,
                'selection' => $selection,
            ]);
        });

        if (! $prompt) {
            return redirect()->route('dashboard')
                ->with('error', 'Has alcanzado el límite de 5 prompts del plan gratuito.');
        }

        // Clear session
        $request->session()->forget('generator');

        return redirect()->route('generator.result', $prompt);
    }

    /**
     * Display the generated prompt.
     */
    public function result(Prompt $prompt)
    {
        $this->authorize('view', $prompt);

        return view('generator.result', compact('prompt'));
    }

    /**
     * Build base prompt and apply AI template.
     */
    private function buildPrompt(array $selection, array $fields): string
    {
        $basePrompt = $this->buildBasePrompt($selection, $fields);

        return $this->applyAiTemplate($basePrompt, $selection['ia'] ?? 'auto');
    }

    private function buildBasePrompt(array $selection, array $fields): string
    {
        $parts = [];

        $subject = $this->findLabel($fields['personaje']['options'], $selection['personaje'] ?? '');
        if ($subject !== '') {
            $parts[] = $subject;
        }

        foreach (['estilo', 'ambiente', 'uso', 'extras'] as $field) {
            if (! empty($selection[$field])) {
                $parts[] = $this->findLabel($fields[$field]['options'], $selection[$field]);
            }
        }

        return implode(', ', array_filter($parts));
    }

    private function applyAiTemplate(string $basePrompt, string $ia): string
    {
        $templates = config('prompt_templates', []);

        $selectedIa = strtolower($ia);
        if ($selectedIa === 'auto' || ! isset($templates[$selectedIa])) {
            $selectedIa = 'chatgpt';
        }

        return str_replace('{prompt}', $basePrompt, $templates[$selectedIa]);
    }

    private function findLabel(array $options, string $value): string
    {
        foreach ($options as $opt) {
            if ($opt['value'] === $value) {
                return strtolower($opt['label']);
            }
        }

        return $value;
    }
}
