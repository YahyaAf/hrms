<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Détails de la Formation</h1>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Détails de la formation -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold">Nom de la Formation</h2>
            <p class="text-gray-700">{{ $formation->name }}</p>

            <h2 class="text-xl font-semibold mt-4">Type de Formation</h2>
            <p class="text-gray-700">{{ $formation->type == 'distance' ? 'A Distance' : 'Présentiel' }}</p>

            <h2 class="text-xl font-semibold mt-4">Compétences</h2>
            <p class="text-gray-700">{{ $formation->competence }}</p>

            <h2 class="text-xl font-semibold mt-4">Utilisateurs Assignés</h2>
            <ul class="list-disc pl-5">
                @foreach($formation->users as $user)
                    <li class="text-gray-700">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6">
            <a href="{{ route('formations.edit', $formation->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Modifier la Formation</a>
            <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Supprimer la Formation</button>
            </form>
        </div>
    </div>
</x-app-layout>
