@extends('layouts.app')
@section('title', 'Pago rechazado - PromptGen')

@section('content')
<section class="mx-auto max-w-2xl px-4 py-20 sm:px-6 text-center">
    <h1 class="font-heading text-3xl font-bold">No se pudo completar el pago</h1>
    <p class="mt-3 text-muted">Tu pago fue rechazado o cancelado. Podes intentar nuevamente cuando quieras.</p>
    <a href="{{ route('pricing') }}" class="mt-8 inline-block rounded-xl border border-[var(--clr-border)] px-6 py-3 text-sm font-semibold">Volver a planes</a>
</section>
@endsection
