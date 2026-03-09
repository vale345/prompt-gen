@extends('layouts.app')
@section('title', $fieldConfig['label'] . ' - PromptGen')

@section('content')

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6">

    {{-- Back --}}
    <a href="{{ route('generator') }}"
       class="inline-flex items-center gap-1 text-sm text-muted transition hover:text-[var(--clr-text)]">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 19l-7-7 7-7"/>
        </svg>
        Atrás
    </a>

    {{-- Title --}}
    <h1 class="mt-6 font-heading text-2xl font-bold sm:text-3xl">
        {{ $fieldConfig['label'] }}
    </h1>

    <p class="mt-2 text-sm text-muted max-w-xl">
        {{ $fieldConfig['description'] }}
    </p>


    {{-- FORM --}}
    <form method="POST"
          action="{{ route('generator.store', $field) }}"
          id="selectionForm">

        @csrf

        <input type="hidden"
               name="value"
               id="selectedValue"
               value="{{ $current }}">


        {{-- GRID DE OPCIONES --}}
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @foreach ($fieldConfig['options'] as $option)


<button
    type="button"
    data-value="{{ $option['value'] }}"
    onclick="selectOption(this)"
    class="option-btn group relative h-64 overflow-hidden rounded-2xl border
    {{ $current === $option['value']
        ? 'border-brand ring-2 ring-brand/30'
        : 'border-[var(--clr-border)]' }}
    transition duration-300 hover:-translate-y-1 hover:shadow-xl">

    {{-- IMAGEN --}}
    <img
        src="{{ $option['image'] ?? '/img/placeholder.jpg' }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

    {{-- BADGE --}}
    @if(isset($option['pro']) && $option['pro'])
        <span class="absolute left-3 top-3 rounded-full bg-purple-600 px-2 py-1 text-xs font-semibold text-white">
            PRO
        </span>
    @else
        <span class="absolute left-3 top-3 rounded-full bg-green-500 px-2 py-1 text-xs font-semibold text-white">
            FREE
        </span>
    @endif


    {{-- TEXTO ABAJO --}}
    <div class="absolute bottom-0 left-0 w-full">

        <div class="bg-gradient-to-t from-black/70 via-black/40 to-transparent p-4">

            <h3 class="text-white font-semibold text-lg">
                {{ $option['label'] }}
            </h3>

            <p class="text-xs text-gray-200">
                Estilo de personaje
            </p>

        </div>

    </div>


    {{-- CHECK --}}
    @if ($current === $option['value'])
        <div class="absolute right-3 top-3 flex h-7 w-7 items-center justify-center rounded-full bg-brand text-white shadow-lg">
            ✓
        </div>
    @endif

</button>











            @endforeach

        </div>


        {{-- ACTIONS --}}
        <div class="mt-10 flex flex-wrap items-center gap-4">

            <a href="{{ route('generator') }}"
               class="rounded-xl border border-[var(--clr-border)]
               px-6 py-3 text-sm font-medium
               transition hover:bg-[var(--clr-bg)]">

                Atrás

            </a>


            @if (!$fieldConfig['required'])

                <button
                    type="button"
                    onclick="clearSelection()"
                    class="rounded-xl border border-[var(--clr-border)]
                    px-6 py-3 text-sm font-medium text-muted
                    transition hover:bg-[var(--clr-bg)]">

                    Limpiar

                </button>

            @endif


            <button
                type="submit"
                class="flex-1 rounded-xl bg-brand py-3
                text-sm font-semibold text-white
                transition hover:bg-brand-dark shadow-lg shadow-brand/30">

                Confirmar

            </button>

        </div>

    </form>

</section>


@push('scripts')

<script>

function selectOption(btn){

    document.querySelectorAll('.option-btn').forEach(el => {
        el.classList.remove('border-brand','ring-2','ring-brand/30')
        el.classList.add('border-[var(--clr-border)]')
    })

    btn.classList.remove('border-[var(--clr-border)]')
    btn.classList.add('border-brand','ring-2','ring-brand/30')

    document.getElementById('selectedValue').value = btn.dataset.value

    // guarda automáticamente
    document.getElementById('selectionForm').submit()

}


function clearSelection(){

    document.getElementById('selectedValue').value = ''
    document.getElementById('selectionForm').submit()

}

</script>

@endpush

@endsection