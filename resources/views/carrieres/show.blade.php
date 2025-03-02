<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Détails de la Carrière</h1>

        <div class="mb-4">
            <a href="{{ route('carrieres.index') }}" class="text-blue-500 hover:underline">Retour à la liste des carrières</a>
        </div>

        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-2">Utilisateur : {{ $carriere->user->name }}</h2>
            <p class="text-gray-600 mb-2"><strong>Grade :</strong> {{ $carriere->grade->name }}</p>
            <p class="text-gray-600 mb-2"><strong>Salaire :</strong> {{ $carriere->salaire }} €</p>
            <p class="text-gray-600 mb-2"><strong>Formation associée :</strong> {{ $carriere->formation->name }}</p>
        </div>
    </div>
</x-app-layout>
