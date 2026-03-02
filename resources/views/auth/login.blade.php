@extends('layouts.app')
@section('title', 'Iniciar sesion - PromptGen')

@section('content')
<section class="mx-auto max-w-md px-4 py-20">
    <div class="rounded-2xl border border-[var(--clr-border)] bg-surface p-8 shadow-sm">
        <h1 class="text-center font-heading text-2xl font-bold">Iniciar sesion</h1>
        <p class="mt-2 text-center text-sm text-muted">Ingresa a tu cuenta para crear prompts.</p>

        <form method="POST" action="{{ route('login') }}" class="mt-8 flex flex-col gap-5">
            @csrf

            {{-- Email --}}
            <div class="flex flex-col gap-1.5">
                <label for="email" class="text-sm font-medium">Correo electronico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    placeholder="********"
                >
                @error('password')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember --}}
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded border-[var(--clr-border)] text-brand focus:ring-brand/20">
                <span class="text-sm text-muted">Recordarme</span>
            </label>

            <button type="submit"
                class="rounded-xl bg-brand py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                Ingresar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-muted">
            No tenes cuenta?
            <a href="{{ route('register') }}" class="font-medium text-brand hover:underline">Registrate</a>
        </p>
    </div>
</section>
@endsection
