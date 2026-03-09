<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use App\Services\PromptBuilder;

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

        return view('generator.summary', compact('fields', 'selection'));
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
     * Build a descriptive prompt string from the selection.
     */
private function buildPrompt(array $selection, array $fields): string
{
    $data = [
        'subject' => $this->findLabel($fields['personaje']['options'], $selection['personaje'] ?? ''),
        'style' => !empty($selection['estilo'])
            ? $this->findLabel($fields['estilo']['options'], $selection['estilo'])
            : '',

        'composition' => 'centered subject, clear focal point',

        'lighting' => 'soft studio lighting',

        'colors' => 'vibrant',

        'details' => !empty($selection['extras'])
            ? $this->findLabel($fields['extras']['options'], $selection['extras'])
            : '',
    ];

    $result = PromptBuilder::build($data);

    return $result['prompt'];
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
