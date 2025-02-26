<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Détails de l'Emploi</h2>

        <p><strong>ID :</strong> {{ $emploi->id }}</p>
        <p><strong>Nom :</strong> {{ $emploi->name }}</p>
        <p><strong>Département :</strong> {{ $emploi->departement->nom }}</p>

        <a href="{{ route('emplois.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
    </div>
</x-app-layout>
