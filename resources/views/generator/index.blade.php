@extends('layouts.app')
@section('title', 'Configura tu prompt - PromptGen')

@section('content')
<section class="mx-auto max-w-2xl px-4 py-12 sm:px-6">
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 text-sm text-muted transition hover:text-[var(--clr-text)]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Dashboard
        </a>
    </div>

    <h1 class="font-heading text-2xl font-bold sm:text-3xl">Configura tu prompt</h1>
    <p class="mt-2 text-sm text-muted">Selecciona opciones en cada tarjeta para armar tu prompt perfecto.</p>

    {{-- Cards --}}
    <div class="mt-8 flex flex-col gap-4">
        @foreach ($fields as $key => $field)
            @php
                $selected      = $selection[$key] ?? null;
                $selectedLabel = null;
                if ($selected) {
                    foreach ($field['options'] as $opt) {
                        if ($opt['value'] === $selected) {
                            $selectedLabel = $opt['label'];
                            break;
                        }
                    }
                }
            @endphp

            <a href="{{ route('generator.select', $key) }}"
               class="group flex items-center justify-between rounded-2xl border border-[var(--clr-border)] bg-surface p-6 transition hover:border-brand/40 hover:shadow-md">
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <h3 class="font-heading text-base font-semibold">{{ $field['label'] }}</h3>
                        <span class="rounded-full px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider
                            {{ $field['required'] ? 'bg-red-50 text-red-600' : ($field['badge'] === 'Recomendado' ? 'bg-amber-50 text-amber-700' : 'bg-[var(--clr-bg)] text-muted') }}">
                            {{ $field['badge'] }}
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-muted">{{ $field['description'] }}</p>

                    @if ($selectedLabel)
                        <p class="mt-2 inline-flex items-center gap-1.5 rounded-lg bg-brand-light px-3 py-1 text-xs font-medium text-brand">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $selectedLabel }}
                        </p>
                    @else
                        <p class="mt-2 text-xs text-muted">Sin definir</p>
                    @endif
                </div>

                <svg class="ml-4 h-5 w-5 shrink-0 text-muted transition group-hover:text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        @endforeach
    </div>

    {{-- Generate button --}}
    <div class="mt-8">
        @if (! empty($selection['personaje']))
            <a href="{{ route('generator.summary') }}"
               class="flex w-full items-center justify-center rounded-xl bg-brand py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
                Generar prompt
            </a>
        @else
            <button disabled
                class="flex w-full cursor-not-allowed items-center justify-center rounded-xl bg-[var(--clr-border)] py-3.5 text-sm font-semibold text-muted">
                Selecciona un personaje para continuar
            </button>
        @endif
    </div>
</section>
@endsection
