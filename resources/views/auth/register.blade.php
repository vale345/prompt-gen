@extends('layouts.app')
@section('title', 'Registrarse - PromptGen')

@section('content')
<section class="mx-auto max-w-md px-4 py-20">
    <div class="rounded-2xl border border-[var(--clr-border)] bg-surface p-8 shadow-sm">
        <h1 class="text-center font-heading text-2xl font-bold">Crear cuenta</h1>
        <p class="mt-2 text-center text-sm text-muted">Empieza a crear prompts profesionales gratis.</p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 flex flex-col gap-5">
            @csrf

            {{-- Name --}}
            <div class="flex flex-col gap-1.5">
                <label for="name" class="text-sm font-medium">Nombre</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="rounded-lg border border-[var(--clr-border)] bg-[var(--clr-bg)] px-4 py-2.5 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/20"
                    placeholder="Tu nombre"
                >
                @error('name')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="flex flex-col gap-1.5">
                <label for="email" class="text-sm font-medium">Correo electronico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    class="rounded-lg border border-[var(--clr-border)] bg-[var(--clr-bg)] px-4 py-2.5 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/20"
                    placeholder="tu@email.com"
                >
                @error('email')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col gap-1.5">
                <label for="password" class="text-sm font-medium">Contrasena</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="rounded-lg border border-[var(--clr-border)] bg-[var(--clr-bg)] px-4 py-2.5 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/20"
                    placeholder="Minimo 8 caracteres"
                >
                @error('password')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm --}}
            <div class="flex flex-col gap-1.5">
                <label for="password_confirmation" class="text-sm font-medium">Confirmar contrasena</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    class="rounded-lg border border-[var(--clr-border)] bg-[var(--clr-bg)] px-4 py-2.5 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/20"
                    placeholder="Repeti la contrasena"
                >
            </div>

            <button type="submit"
                class="rounded-xl bg-brand py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                Crear cuenta
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-muted">
            Ya tenes cuenta?
            <a href="{{ route('login') }}" class="font-medium text-brand hover:underline">Inicia sesion</a>
        </p>
    </div>
</section>
@endsection
