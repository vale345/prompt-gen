<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prompt generado</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Prompt generado</h1>
    <p class="text-gray-600 mb-8">IA seleccionada: <span class="font-semibold">{{ ucfirst($aiTarget) }}</span></p>

    <div class="rounded-lg bg-white p-6 shadow-sm space-y-4">
        <label for="generated_prompt" class="block text-sm font-medium text-gray-700">Tu prompt</label>
        <textarea id="generated_prompt" rows="8" readonly class="w-full rounded-md border-gray-300 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500">{{ $prompt }}</textarea>

        <div class="flex gap-3">
            <button type="button" onclick="navigator.clipboard.writeText(document.getElementById('generated_prompt').value)" class="inline-flex items-center rounded-md bg-indigo-600 px-5 py-2.5 text-white font-medium hover:bg-indigo-700">
                Copiar prompt
            </button>
            <a href="{{ route('prompt.form') }}" class="inline-flex items-center rounded-md border border-gray-300 px-5 py-2.5 text-gray-700 font-medium hover:bg-gray-50">
                Generar otro
            </a>
        </div>
    </div>
</div>
</body>
</html>
