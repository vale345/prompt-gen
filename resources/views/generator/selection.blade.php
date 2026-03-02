@extends('layouts.app')
@section('title', $fieldConfig['label'] . ' - PromptGen')

@section('content')
<section class="mx-auto max-w-3xl px-4 py-12 sm:px-6">
    {{-- Back --}}
    <a href="{{ route('generator') }}" class="inline-flex items-center gap-1 text-sm text-muted transition hover:text-[var(--clr-text)]">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Atras
    </a>

    <h1 class="mt-6 font-heading text-2xl font-bold">{{ $fieldConfig['label'] }}</h1>
    <p class="mt-1 text-sm text-muted">{{ $fieldConfig['description'] }}</p>

    {{-- Options grid --}}
    <form method="POST" action="{{ route('generator.store', $field) }}" id="selectionForm">
        @csrf
        <input type="hidden" name="value" id="selectedValue" value="{{ $current }}">

        <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($fieldConfig['options'] as $option)
                <button type="button"
                    data-value="{{ $option['value'] }}"
                    onclick="selectOption(this)"
                    class="option-btn flex flex-col items-center gap-2 rounded-xl border-2 p-5 text-center transition hover:border-brand/40 hover:shadow-sm
                        {{ $current === $option['value'] ? 'border-brand bg-brand-light' : 'border-[var(--clr-border)] bg-surface' }}">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[var(--clr-bg)] text-lg font-bold text-brand">
                        {{ mb_strtoupper(mb_substr($option['label'], 0, 1)) }}
                    </span>
                    <span class="text-sm font-medium">{{ $option['label'] }}</span>
                </button>
            @endforeach
        </div>

        {{-- Actions --}}
        <div class="mt-8 flex items-center gap-3">
            <a href="{{ route('generator') }}"
               class="rounded-xl border border-[var(--clr-border)] px-6 py-3 text-sm font-medium transition hover:bg-[var(--clr-bg)]">
                Atras
            </a>

            @if (!$fieldConfig['required'])
                <button type="button"
                    onclick="document.getElementById('selectedValue').value=''; document.getElementById('selectionForm').submit();"
                    class="rounded-xl border border-[var(--clr-border)] px-6 py-3 text-sm font-medium text-muted transition hover:bg-[var(--clr-bg)]">
                    Limpiar
                </button>
            @endif

            <button type="submit"
                class="flex-1 rounded-xl bg-brand py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                Confirmar
            </button>
        </div>
    </form>
</section>

@push('scripts')
<script>
    function selectOption(btn) {
        document.querySelectorAll('.option-btn').forEach(el => {
            el.classList.remove('border-brand', 'bg-brand-light');
            el.classList.add('border-[var(--clr-border)]', 'bg-surface');
        });
        btn.classList.remove('border-[var(--clr-border)]', 'bg-surface');
        btn.classList.add('border-brand', 'bg-brand-light');
        document.getElementById('selectedValue').value = btn.dataset.value;
    }
</script>
@endpush
@endsection
