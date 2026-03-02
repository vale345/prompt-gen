@extends('layouts.app')
@section('title', 'Planes - PromptGen')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-20 sm:px-6">
    <div class="text-center">
        <h1 class="font-heading text-3xl font-bold sm:text-4xl">Planes simples, sin sorpresas</h1>
        <p class="mx-auto mt-3 max-w-lg text-muted">Empieza gratis y actualiza cuando necesites mas.</p>
    </div>

    <div class="mt-14 grid gap-6 sm:grid-cols-2">
        {{-- Free --}}
        <div class="flex flex-col rounded-2xl border border-[var(--clr-border)] bg-surface p-8">
            <span class="inline-block self-start rounded-full bg-[var(--clr-bg)] px-3 py-1 text-xs font-semibold uppercase tracking-wide text-muted">
                Free
            </span>
            <p class="mt-4 font-heading text-4xl font-bold">$0</p>
            <p class="mt-1 text-sm text-muted">Para siempre</p>

            <ul class="mt-8 flex flex-col gap-3 text-sm">
                @foreach ([
                    '5 prompts por dia',
                    '6 estilos basicos',
                    '6 ambientes basicos',
                    'Opciones de uso comercial',
                ] as $feature)
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-auto pt-8">
                @auth
                    @if (auth()->user()->plan === 'free')
                        <span class="flex w-full items-center justify-center rounded-xl border border-[var(--clr-border)] py-3 text-sm font-medium text-muted">
                            Tu plan actual
                        </span>
                    @else
                        <span class="flex w-full items-center justify-center rounded-xl border border-[var(--clr-border)] py-3 text-sm font-medium text-muted">
                            Plan Free
                        </span>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="flex w-full items-center justify-center rounded-xl border border-[var(--clr-border)] py-3 text-sm font-medium transition hover:bg-[var(--clr-bg)]">
                        Empezar gratis
                    </a>
                @endauth
            </div>
        </div>

        {{-- Pro --}}
        <div class="relative flex flex-col rounded-2xl border-2 border-brand bg-surface p-8 shadow-lg shadow-brand/10">
            <span class="absolute -top-3 right-6 rounded-full bg-brand px-3 py-1 text-xs font-semibold text-white">
                Popular
            </span>
            <span class="inline-block self-start rounded-full bg-brand-light px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand">
                Pro
            </span>
            <p class="mt-4 font-heading text-4xl font-bold">$9<span class="text-lg font-normal text-muted">/mes</span></p>
            <p class="mt-1 text-sm text-muted">Facturacion mensual</p>

            <ul class="mt-8 flex flex-col gap-3 text-sm">
                @foreach ([
                    'Prompts ilimitados',
                    'Todos los estilos y ambientes',
                    'Extras avanzados (luz, angulo, emocion)',
                    'Presets comerciales optimizados',
                    'Historial completo guardado',
                    'Soporte prioritario',
                ] as $feature)
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        {{ $feature }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-auto pt-8">
                @auth
                    @if (auth()->user()->plan === 'pro')
                        <span class="flex w-full items-center justify-center rounded-xl bg-brand/10 py-3 text-sm font-semibold text-brand">
                            Tu plan actual
                        </span>
                    @else
                        <button class="flex w-full items-center justify-center rounded-xl bg-brand py-3 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
                            Actualizar a Pro
                        </button>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="flex w-full items-center justify-center rounded-xl bg-brand py-3 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
                        Empezar con Pro
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- FAQ snippet --}}
    <div class="mt-16 text-center">
        <p class="text-sm text-muted">Tenes preguntas? <a href="#" class="font-medium text-brand hover:underline">Contactanos</a></p>
    </div>
</section>
@endsection
