@extends('layouts.app')
@section('title', 'Dashboard - PromptGen')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12 sm:px-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="font-heading text-2xl font-bold sm:text-3xl">Hola, {{ $user->name }}</h1>
            <p class="mt-1 text-sm text-muted">Gestiona y crea tus prompts desde aca.</p>
        </div>

        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 rounded-full {{ $user->plan === 'pro' ? 'bg-accent-light text-accent-dark' : 'bg-brand-light text-brand' }} px-3 py-1 text-xs font-semibold uppercase tracking-wide">
                Plan {{ ucfirst($user->plan) }}
            </span>
            <a href="{{ route('generator') }}"
               class="rounded-xl bg-brand px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
                Nuevo prompt
            </a>
        </div>
    </div>

    {{-- Stats cards --}}
    <div class="mt-10 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-[var(--clr-border)] bg-surface p-6">
            <p class="text-sm text-muted">Prompts creados</p>
            <p class="mt-1 font-heading text-2xl font-bold">{{ $prompts->count() }}</p>
        </div>
        <div class="rounded-2xl border border-[var(--clr-border)] bg-surface p-6">
            <p class="text-sm text-muted">Plan actual</p>
            <p class="mt-1 font-heading text-2xl font-bold">{{ ucfirst($user->plan) }}</p>
        </div>
        <div class="rounded-2xl border border-[var(--clr-border)] bg-surface p-6">
            <p class="text-sm text-muted">Limite diario</p>
            <p class="mt-1 font-heading text-2xl font-bold">{{ $user->plan === 'pro' ? 'Ilimitado' : '5 / dia' }}</p>
        </div>
    </div>

    {{-- Recent prompts --}}
    <div class="mt-10">
        <h2 class="font-heading text-lg font-semibold">Prompts recientes</h2>

        @if ($prompts->isEmpty())
            <div class="mt-6 rounded-2xl border border-dashed border-[var(--clr-border)] bg-surface p-12 text-center">
                <p class="text-muted">Todavia no creaste ningun prompt.</p>
                <a href="{{ route('generator') }}" class="mt-4 inline-block text-sm font-medium text-brand hover:underline">
                    Crear mi primer prompt
                </a>
            </div>
        @else
            <div class="mt-4 flex flex-col gap-3">
                @foreach ($prompts as $prompt)
                    <div class="flex items-start justify-between gap-4 rounded-xl border border-[var(--clr-border)] bg-surface p-5 transition hover:shadow-sm">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium">{{ Str::limit($prompt->content, 120) }}</p>
                            <p class="mt-1 text-xs text-muted">{{ $prompt->created_at->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('generator.result', $prompt) }}"
                           class="shrink-0 rounded-lg border border-[var(--clr-border)] px-3 py-1.5 text-xs font-medium transition hover:bg-[var(--clr-bg)]">
                            Ver
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
