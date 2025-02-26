<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Détails du Grade</h2>

        <div class="bg-white p-4 rounded shadow-md">
            <p><strong>ID :</strong> {{ $grade->id }}</p>
            <p><strong>Nom :</strong> {{ $grade->name }}</p>
            <p><strong>Niveau :</strong> {{ $grade->level }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('grades.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
            <a href="{{ route('grades.edit', $grade) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
        </div>
    </div>
</x-app-layout>
