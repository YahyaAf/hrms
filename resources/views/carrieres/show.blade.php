<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Détails de la Carrière de {{ $carriere->user->name }}</h1>

        <!-- Success message (if any) -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Carrière Details -->
        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <div class="mb-4">
                <strong class="text-lg text-gray-700">Utilisateur :</strong>
                <p class="text-gray-600">{{ $carriere->user->name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg text-gray-700">Grade :</strong>
                <!-- Display grade name -->
                <p class="text-gray-600">{{ $carriere->grade->name ?? 'Non défini' }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg text-gray-700">Salaire :</strong>
                <p class="text-gray-600">{{ $carriere->salaire ?? 'Non défini' }} €</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg text-gray-700">Augmentation :</strong>
                <p class="text-gray-600">{{ $carriere->augmentation ?? 'Non défini' }} €</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg text-gray-700">Formation :</strong>
                <!-- Display formation name -->
                <p class="text-gray-600">{{ $carriere->formation->name ?? 'Aucune formation assignée' }}</p>
            </div>
        </div>

        <a href="{{ route('carrieres.index') }}" class="text-blue-600 hover:text-blue-800">Retour à la liste des carrières</a>
    </div>
</x-app-layout>
