<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PromptGen - Generador de Prompts')</title>
    <meta name="description" content="Crea prompts optimizados para generar imagenes comerciales. Ahorra tiempo y vende mas.">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Tailwind via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --clr-primary: #4a6cf7;
            --clr-primary-dark: #3b5de7;
            --clr-accent: #22c997;
            --clr-bg: #f6f8fc;
            --clr-surface: #ffffff;
            --clr-text: #1e2a3a;
            --clr-muted: #6b7b93;
            --clr-border: #e2e8f0;
        }
    </style>
</head>
<body class="min-h-screen bg-[var(--clr-bg)] text-[var(--clr-text)] font-sans antialiased">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 border-b border-[var(--clr-border)] bg-[var(--clr-surface)]/95 backdrop-blur-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6">
            <!-- <a href="{{ route('landing') }}" class="flex items-center gap-2 text-lg font-bold tracking-tight" style="font-family:'DM Sans',sans-serif;">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--clr-primary)] text-sm font-bold text-white">P</span>
                PromptGen
            </a> -->
<a href="{{ route('landing') }}" class="flex items-center gap-2 text-lg font-bold tracking-tight" style="font-family:'DM Sans',sans-serif;">
    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-white">
        <!-- Icono varita mágica -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 4l5 5M4 15l5 5M14 5l5 5M5 14l5 5M9 9l6 6"/>
        </svg>
    </span>
    PromptGen
</a>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-[var(--clr-muted)] transition hover:text-[var(--clr-text)]">Dashboard</a>
                    <a href="{{ route('pricing') }}" class="text-sm font-medium text-[var(--clr-muted)] transition hover:text-[var(--clr-text)]">Planes</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-2 rounded-lg border border-[var(--clr-border)] px-3 py-1.5 text-sm font-medium transition hover:bg-[var(--clr-bg)]">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[var(--clr-muted)] transition hover:text-[var(--clr-text)]">Iniciar sesion</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-[var(--clr-primary)] px-4 py-2 text-sm font-medium text-white transition hover:bg-[var(--clr-primary-dark)]">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mx-auto mt-4 max-w-6xl px-4">
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-auto mt-4 max-w-6xl px-4">
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Page content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-16 border-t border-[var(--clr-border)] bg-[var(--clr-surface)]">
        <div class="mx-auto flex max-w-6xl flex-col items-center gap-2 px-4 py-8 text-sm text-[var(--clr-muted)] sm:flex-row sm:justify-between">
            <p>&copy; {{ date('Y') }} PromptGen. Todos los derechos reservados.</p>
            <div class="flex gap-4">
                <a href="{{ route('pricing') }}" class="transition hover:text-[var(--clr-text)]">Planes</a>
                <a href="#" class="transition hover:text-[var(--clr-text)]">Soporte</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
