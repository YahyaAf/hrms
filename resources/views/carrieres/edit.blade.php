<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Modifier la Carrière de l'Utilisateur</h1>

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

        <!-- Formulaire de modification de carrière -->
        <form action="{{ route('carrieres.update', $carriere->user_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                <select id="grade" name="grade" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ $carriere->grade_id == $grade->id ? 'selected' : '' }}>
                            {{ $grade->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="number" id="salaire" name="salaire" value="{{ old('salaire', $carriere->salaire) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
