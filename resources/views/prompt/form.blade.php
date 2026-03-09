<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Prompts</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-2xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Generador de prompts de imágenes</h1>
    <p class="text-gray-600 mb-8">Completa los campos y genera un prompt optimizado según la IA seleccionada.</p>

    @if(session('error'))
        <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('prompt.generate') }}" method="POST" class="space-y-6 rounded-lg bg-white p-6 shadow-sm">
        @csrf

        <div>
            <label for="ai_target" class="block text-sm font-medium text-gray-700 mb-1">IA destino</label>
            <select id="ai_target" name="ai_target" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecciona una IA</option>
                <option value="midjourney" @selected(old('ai_target') === 'midjourney')>MidJourney</option>
                <option value="chatgpt" @selected(old('ai_target') === 'chatgpt')>ChatGPT</option>
                <option value="leonardo" @selected(old('ai_target') === 'leonardo')>Leonardo.ai</option>
            </select>
            @error('ai_target')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="character" class="block text-sm font-medium text-gray-700 mb-1">Personaje</label>
            <input id="character" name="character" type="text" value="{{ old('character') }}" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: astronauta futurista" required>
            @error('character')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="background" class="block text-sm font-medium text-gray-700 mb-1">Fondo</label>
            <input id="background" name="background" type="text" value="{{ old('background') }}" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: ciudad cyberpunk nocturna" required>
            @error('background')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="style" class="block text-sm font-medium text-gray-700 mb-1">Estilo</label>
            <input id="style" name="style" type="text" value="{{ old('style') }}" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: realista cinematográfico" required>
            @error('style')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="colors" class="block text-sm font-medium text-gray-700 mb-1">Colores</label>
            <input id="colors" name="colors" type="text" value="{{ old('colors') }}" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: neón azul y magenta" required>
            @error('colors')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-5 py-2.5 text-white font-medium hover:bg-indigo-700">
            Generar prompt
        </button>
    </form>
</div>
</body>
</html>
