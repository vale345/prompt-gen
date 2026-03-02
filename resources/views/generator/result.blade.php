@extends('layouts.app')
@section('title', 'Tu prompt - PromptGen')

@section('content')
<section class="mx-auto max-w-2xl px-4 py-12 sm:px-6">
    <div class="text-center">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-accent-light">
            <svg class="h-7 w-7 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h1 class="font-heading text-2xl font-bold">Tu prompt esta listo</h1>
        <p class="mt-1 text-sm text-muted">Copia el texto y pegalo en tu herramienta de generacion de imagenes favorita.</p>
    </div>

    {{-- Prompt box --}}
    <div class="mt-8 rounded-2xl border border-[var(--clr-border)] bg-surface p-6">
        <div class="rounded-xl bg-[var(--clr-bg)] p-5">
            <p id="promptText" class="whitespace-pre-wrap text-sm leading-relaxed">{{ $prompt->content }}</p>
        </div>

        <p class="mt-3 text-right text-xs text-muted">{{ Str::wordCount($prompt->content) }} palabras</p>
    </div>

    {{-- Actions --}}
    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
        <button onclick="copyPrompt()"
            id="copyBtn"
            class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-brand py-3 text-sm font-semibold text-white shadow-lg shadow-brand/25 transition hover:bg-brand-dark">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            Copiar
        </button>

        <a href="{{ route('generator') }}"
           class="flex flex-1 items-center justify-center rounded-xl border border-[var(--clr-border)] py-3 text-sm font-medium transition hover:bg-[var(--clr-bg)]">
            Generar otro
        </a>

        <a href="{{ route('dashboard') }}"
           class="flex flex-1 items-center justify-center rounded-xl border border-[var(--clr-border)] py-3 text-sm font-medium transition hover:bg-[var(--clr-bg)]">
            Volver al inicio
        </a>
    </div>
</section>

@push('scripts')
<script>
    function copyPrompt() {
        const text = document.getElementById('promptText').textContent;
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('copyBtn');
            btn.innerHTML = `
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Copiado
            `;
            setTimeout(() => {
                btn.innerHTML = `
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Copiar
                `;
            }, 2000);
        });
    }
</script>
@endpush
@endsection
