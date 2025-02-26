<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Détails du Contrat</h2>

        <p><strong>ID :</strong> {{ $contract->id }}</p>
        <p><strong>Nom :</strong> {{ $contract->name }}</p>

        <a href="{{ route('contracts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
    </div>
</x-app-layout>
