@extends('layouts.app')
@section('title', 'Pago pendiente - PromptGen')

@section('content')
<section class="mx-auto max-w-2xl px-4 py-20 sm:px-6 text-center">
    <h1 class="font-heading text-3xl font-bold">Pago pendiente</h1>
    <p class="mt-3 text-muted">Tu pago está pendiente de confirmación. Te avisaremos cuando se apruebe.</p>
    <a href="{{ route('dashboard') }}" class="mt-8 inline-block rounded-xl border border-[var(--clr-border)] px-6 py-3 text-sm font-semibold">Volver al dashboard</a>
</section>
@endsection
