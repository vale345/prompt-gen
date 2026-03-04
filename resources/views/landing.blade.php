@extends('layouts.app')
@section('title', 'PromptGen - Generador Magico de Prompts')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-20 sm:px-6">
    {{-- Hero --}}
    <div class="flex flex-col items-center text-center">
        <!-- <span class="mb-4 inline-block rounded-full bg-brand-light px-4 py-1.5 text-xs font-semibold tracking-wide text-brand">
            NUEVO
        </span> -->
<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-sky-100 text-sky-700 text-sm font-medium mb-6">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-4 h-4" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2"
              d="M5 3v4M3 5h4M19 3v4M17 5h4M12 8v4M10 10h4M5 17v4M3 19h4M19 17v4M17 19h4" />
    </svg>
    Generador inteligente de prompts
</div>

        <h1 class="max-w-3xl text-balance font-heading text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
            Generador Magico de Prompts
        </h1>

        <p class="mt-6 max-w-2xl text-pretty text-lg leading-relaxed text-muted">
            Crea prompts optimizados para generar imagenes comerciales, ahorra tiempo
            y vende mas en tu negocio digital.
        </p>

        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('register') }}"
               class="rounded-xl bg-brand px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
                Crear prompt gratis
            </a>
            <a href="{{ route('login') }}"
               class="rounded-xl border border-[var(--clr-border)] bg-surface px-8 py-3.5 text-sm font-semibold transition hover:bg-[var(--clr-bg)]">
                Iniciar sesion
            </a>
        </div>
    </div>

    {{-- Benefits --}}
    <div class="mt-24 grid gap-6 sm:grid-cols-3">
        @php
            $benefits = [
                ['icon' => '&#9201;', 'title' => 'Ahorra tiempo', 'desc' => 'Genera prompts profesionales en segundos sin pensar que escribir.'],
                ['icon' => '&#9997;', 'title' => 'Sin conocimiento previo', 'desc' => 'No necesitas saber de prompts ni de IA. Solo elegi opciones.'],
                ['icon' => '&#128176;', 'title' => 'Uso comercial', 'desc' => 'Prompts pensados para crear imagenes que puedas vender.'],
            ];
        @endphp

        @foreach ($benefits as $b)
            <div class="rounded-2xl border border-[var(--clr-border)] bg-surface p-8 text-center transition hover:shadow-md">
                <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-brand-light text-xl">
                    {!! $b['icon'] !!}
                </div>
                <h3 class="font-heading text-lg font-semibold">{{ $b['title'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-muted">{{ $b['desc'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- How it works --}}
    <div class="mt-24 text-center">
        <h2 class="font-heading text-2xl font-bold sm:text-3xl">Como funciona</h2>
        <p class="mx-auto mt-3 max-w-lg text-muted">En 3 simples pasos tenes tu prompt listo para usar.</p>
    </div>

    <div class="mt-12 grid gap-6 sm:grid-cols-3">
        @php
            $steps = [
                ['num' => '1', 'title' => 'Configura', 'desc' => 'Elegi personaje, estilo, ambiente y mas usando tarjetas interactivas.'],
                ['num' => '2', 'title' => 'Revisa', 'desc' => 'Ve un resumen de tu seleccion antes de generar.'],
                ['num' => '3', 'title' => 'Copia y usa', 'desc' => 'Obtene tu prompt optimizado y pegalo en cualquier IA de imagenes.'],
            ];
        @endphp

        @foreach ($steps as $s)
            <div class="flex flex-col items-center rounded-2xl border border-[var(--clr-border)] bg-surface p-8 text-center">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand text-sm font-bold text-white">{{ $s['num'] }}</span>
                <h3 class="mt-4 font-heading text-lg font-semibold">{{ $s['title'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-muted">{{ $s['desc'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- CTA bottom --}}
    <div class="mt-24 rounded-2xl bg-brand p-12 text-center text-white">
        <h2 class="font-heading text-2xl font-bold sm:text-3xl">Empieza gratis ahora</h2>
        <p class="mx-auto mt-3 max-w-lg text-white/80">Crea tu primer prompt en menos de un minuto. Sin tarjeta de credito.</p>
        <a href="{{ route('register') }}"
           class="mt-8 inline-block rounded-xl bg-white px-8 py-3.5 text-sm font-semibold text-brand transition hover:bg-white/90">
            Crear cuenta gratis
        </a>
    </div>
</section>
@endsection
