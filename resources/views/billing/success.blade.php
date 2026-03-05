@extends('layouts.app')
@section('title', 'Pago exitoso - PromptGen')

@section('content')
<section class="mx-auto max-w-2xl px-4 py-20 sm:px-6 text-center">
    <h1 class="font-heading text-3xl font-bold">Pago recibido</h1>
    <p class="mt-3 text-muted">Estamos confirmando tu pago con Mercado Pago. En breve veras tu plan Pro activo.</p>
    <a href="{{ route('dashboard') }}" class="mt-8 inline-block rounded-xl bg-brand px-6 py-3 text-sm font-semibold text-white">Volver al dashboard</a>
</section>
@endsection
