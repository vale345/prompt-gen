@extends('layouts.app')
@section('title', 'Configura tu prompt - PromptGen')

@section('content')

<section class="relative overflow-hidden px-6 py-16">

    {{-- background decorativo --}}
    <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="absolute left-1/2 top-0 h-[500px] w-[900px] -translate-x-1/2 rounded-full bg-brand/10 blur-3xl"></div>
    </div>

    <div class="mx-auto max-w-5xl">

        {{-- Back --}}
        <div class="mb-10">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 text-sm text-muted transition hover:text-brand">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al dashboard
            </a>
        </div>

        {{-- Header --}}
        <div class="mb-12">
            <h1 class="font-heading text-4xl font-bold tracking-tight">
                Diseña tu prompt
            </h1>

            <p class="mt-3 max-w-xl text-muted">
                Combina estilo, técnica y personaje para generar prompts listos para usar en IA.
            </p>

            {{-- progreso --}}
            <div class="mt-5 text-xs text-muted">
                {{ count(array_filter($selection)) }} / {{ count($fields) }} opciones configuradas
            </div>
        </div>


        {{-- Cards --}}
        <div class="grid gap-5">

            @foreach ($fields as $key => $field)

                @php
                    $selected = $selection[$key] ?? null;
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
                   class="group relative flex items-center justify-between rounded-3xl border
                   {{ $selectedLabel ? 'border-brand/50 bg-brand/5' : 'border-[var(--clr-border)] bg-surface' }}
                   p-7 transition-all duration-200
                   hover:-translate-y-1 hover:shadow-xl hover:border-brand/40">

                    {{-- contenido --}}
                    <div class="flex-1">

                        <div class="flex items-center gap-3">

                            <h3 class="font-heading text-lg font-semibold">
                                {{ $field['label'] }}
                            </h3>

                            <span class="rounded-full px-2.5 py-0.5 text-[11px] font-medium
                            {{ $field['required']
                                ? 'bg-red-50 text-red-600'
                                : ($field['badge'] === 'Recomendado'
                                    ? 'bg-amber-50 text-amber-700'
                                    : 'bg-[var(--clr-bg)] text-muted') }}">
                                {{ $field['badge'] }}
                            </span>

                        </div>

                        <p class="mt-2 text-sm text-muted">
                            {{ $field['description'] }}
                        </p>

                        {{-- seleccionado --}}
                        @if ($selectedLabel)

                            <div class="mt-3 inline-flex items-center gap-2 rounded-lg
                                        bg-brand-light px-3 py-1.5 text-xs font-medium text-brand">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M5 13l4 4L19 7"/>
                                </svg>

                                {{ $selectedLabel }}

                            </div>

                        @else

                            <div class="mt-3 text-xs text-muted">
                                Sin seleccionar
                            </div>

                        @endif

                    </div>


                    {{-- arrow --}}
                    <div class="ml-6 flex items-center">

                        <svg class="h-6 w-6 text-muted transition-all
                        group-hover:translate-x-1 group-hover:text-brand"
                             fill="none" stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7"/>

                        </svg>

                    </div>

                </a>

            @endforeach

        </div>


        {{-- Generate button --}}
        <div class="mt-12">

            @if (! empty($selection['personaje']))

                <a href="{{ route('generator.summary') }}"
                   class="flex w-full items-center justify-center rounded-2xl
                   bg-gradient-to-r from-brand to-brand-dark
                   py-4 text-sm font-semibold text-white
                   shadow-lg transition-all
                   hover:scale-[1.02] hover:shadow-xl">

                    Generar prompt

                </a>

            @else

                <button disabled
                        class="flex w-full cursor-not-allowed items-center justify-center
                        rounded-2xl bg-[var(--clr-border)] py-4 text-sm font-semibold text-muted">

                    Selecciona un personaje para continuar

                </button>

            @endif

        </div>

    </div>

</section>

@endsection