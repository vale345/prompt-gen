@extends('layouts.app')
@section('title', 'Configura tu prompt - PromptGen')

@section('content')
<section class="relative mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-x-0 -top-14 -z-10 mx-auto h-44 max-w-3xl rounded-full bg-brand/10 blur-3xl"></div>

    <div class="mb-10 flex items-center justify-between gap-4">
        <a href="{{ route('dashboard') }}"
           class="group inline-flex items-center gap-2 rounded-full border border-[var(--clr-border)] bg-surface/80 px-4 py-2 text-sm font-medium text-muted shadow-sm backdrop-blur transition duration-200 hover:-translate-y-0.5 hover:border-brand/40 hover:text-[var(--clr-text)] hover:shadow">
            <svg class="h-4 w-4 transition group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Dashboard
        </a>

        <div class="hidden items-center gap-2 rounded-full border border-brand/20 bg-brand/5 px-3 py-1.5 text-xs font-semibold text-brand sm:inline-flex">
            <span class="inline-flex h-2 w-2 rounded-full bg-brand"></span>
            Flujo guiado
        </div>
    </div>

    <header class="rounded-3xl border border-[var(--clr-border)] bg-surface/90 p-7 shadow-xl shadow-black/5 backdrop-blur sm:p-9">
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-brand/80">AI Prompt Builder</p>
        <h1 class="mt-3 font-heading text-3xl font-bold tracking-tight text-[var(--clr-text)] sm:text-4xl">Configura tu prompt</h1>
        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-muted sm:text-base">
            Diseña un prompt de alta calidad eligiendo cada bloque. Tu selección se guarda paso a paso para que construyas resultados más precisos, consistentes y profesionales.
        </p>
    </header>

    {{-- Cards --}}
    <div class="mt-8 grid gap-5">
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
               class="group relative overflow-hidden rounded-3xl border border-[var(--clr-border)] bg-surface/95 p-6 shadow-lg shadow-black/5 transition duration-300 hover:-translate-y-0.5 hover:border-brand/35 hover:shadow-xl hover:shadow-brand/10 sm:p-7">
                <div class="pointer-events-none absolute inset-y-0 right-0 w-28 bg-gradient-to-l from-brand/5 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h3 class="font-heading text-lg font-semibold tracking-tight text-[var(--clr-text)]">{{ $field['label'] }}</h3>
                            <span class="rounded-full px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider
                                {{ $field['required'] ? 'border border-red-100 bg-red-50 text-red-600' : ($field['badge'] === 'Recomendado' ? 'border border-amber-100 bg-amber-50 text-amber-700' : 'border border-[var(--clr-border)] bg-[var(--clr-bg)] text-muted') }}">
                                {{ $field['badge'] }}
                            </span>
                        </div>

                        <p class="mt-2 text-sm leading-relaxed text-muted sm:text-[15px]">{{ $field['description'] }}</p>

                        @if ($selectedLabel)
                            <p class="mt-4 inline-flex items-center gap-2 rounded-xl border border-brand/15 bg-brand/10 px-3.5 py-2 text-xs font-semibold text-brand sm:text-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Seleccionado: {{ $selectedLabel }}
                            </p>
                        @else
                            <p class="mt-4 inline-flex items-center gap-2 rounded-xl border border-dashed border-[var(--clr-border)] bg-[var(--clr-bg)]/70 px-3.5 py-2 text-xs font-medium text-muted sm:text-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                Sin definir
                            </p>
                        @endif
                    </div>

                    <div class="mt-1 inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[var(--clr-border)] bg-[var(--clr-bg)] text-muted transition duration-300 group-hover:border-brand/30 group-hover:bg-brand/10 group-hover:text-brand">
                        <svg class="h-5 w-5 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Generate button --}}
    <div class="mt-10 rounded-3xl border border-[var(--clr-border)] bg-surface p-4 shadow-lg shadow-black/5 sm:p-5">
        @if (! empty($selection['personaje']))
            <a href="{{ route('generator.summary') }}"
               class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-brand px-4 py-4 text-sm font-semibold text-white shadow-lg shadow-brand/30 transition duration-300 hover:-translate-y-0.5 hover:bg-brand-dark hover:shadow-xl hover:shadow-brand/35 sm:text-base">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Generar prompt
            </a>
        @else
            <button disabled
                class="flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-2xl border border-[var(--clr-border)] bg-[var(--clr-bg)] py-4 text-sm font-semibold text-muted sm:text-base">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2h-1V5a5 5 0 00-10 0v2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Selecciona un personaje para continuar
            </button>
        @endif
    </div>
</section>
@endsection
