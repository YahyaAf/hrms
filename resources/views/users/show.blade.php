<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Détails de l'Utilisateur</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <strong class="text-gray-700">Nom:</strong> <span class="text-gray-600">{{ $user->name }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Email:</strong> <span class="text-gray-600">{{ $user->email }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Téléphone:</strong> <span class="text-gray-600">{{ $user->telephone }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Date de naissance:</strong> <span class="text-gray-600">{{ $user->date_naissance }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Adresse:</strong> <span class="text-gray-600">{{ $user->adresse }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Salaire:</strong> <span class="text-gray-600">{{ $user->salaire }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Statut:</strong> <span class="text-gray-600">{{ $user->statut }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Contrat:</strong> <span class="text-gray-600">{{ $user->contract->name ?? 'N/A' }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Département:</strong> <span class="text-gray-600">{{ $user->departement->nom ?? 'N/A' }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Emploi:</strong> <span class="text-gray-600">{{ $user->emploi->name ?? 'N/A' }}</span>
            </div>

            <div class="mb-4">
                <strong class="text-gray-700">Grade:</strong> <span class="text-gray-600">{{ $user->grade->name ?? 'N/A' }}</span>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600">Modifier</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                </form>
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
