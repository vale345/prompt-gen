@extends('layouts.app')
@section('title', 'Resumen - PromptGen')

@section('content')
<section class="mx-auto max-w-2xl px-4 py-12 sm:px-6">
    <a href="{{ route('generator') }}" class="inline-flex items-center gap-1 text-sm text-muted transition hover:text-[var(--clr-text)]">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Atras
    </a>

    <h1 class="mt-6 font-heading text-2xl font-bold">Resumen de tu seleccion</h1>
    <p class="mt-1 text-sm text-muted">Revisa tus opciones antes de generar el prompt.</p>

    <div class="mt-8 flex flex-col gap-3">
        @foreach ($fields as $key => $field)
            @php
                $value = $selection[$key] ?? null;
                $label = null;
                if ($value) {
                    foreach ($field['options'] as $opt) {
                        if ($opt['value'] === $value) {
                            $label = $opt['label'];
                            break;
                        }
                    }
                }
            @endphp

            <div class="flex items-center justify-between rounded-xl border border-[var(--clr-border)] bg-surface px-6 py-4">
                <div>
                    <p class="text-sm font-medium">{{ $field['label'] }}</p>
                    @if ($label)
                        <p class="mt-0.5 text-sm text-brand font-medium">{{ $label }}</p>
                    @else
                        <p class="mt-0.5 text-sm text-muted">Sin definir</p>
                    @endif
                </div>

                <a href="{{ route('generator.select', $key) }}"
                   class="rounded-lg border border-[var(--clr-border)] px-3 py-1.5 text-xs font-medium transition hover:bg-[var(--clr-bg)]">
                    Editar
                </a>
            </div>
        @endforeach
    </div>

    {{-- Actions --}}
    <div class="mt-8 flex items-center gap-3">
        <a href="{{ route('generator') }}"
           class="rounded-xl border border-[var(--clr-border)] px-6 py-3 text-sm font-medium transition hover:bg-[var(--clr-bg)]">
            Atras
        </a>

        <form method="POST" action="{{ route('generator.generate') }}" class="flex-1">
            @csrf
            <button type="submit"
                class="w-full rounded-xl bg-brand py-3 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
                Generar prompt
            </button>
        </form>
    </div>
</section>
@endsection
