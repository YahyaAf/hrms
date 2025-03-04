<x-app-layout>
    <div class="container mx-auto py-6">
        <!-- User Career Details -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-semibold mb-4">Carrières de l'Utilisateur</h2>

            @if($carrieres->isEmpty())
                <p class="text-gray-600">Aucune carrière enregistrée pour cet utilisateur.</p>
            @else
                <div class="mt-4">
                    <h3 class="text-xl font-semibold mb-2">Historique des Carrières</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Grade</th>
                                <th class="border border-gray-300 px-4 py-2">Augmentation</th>
                                <th class="border border-gray-300 px-4 py-2">Formation ID</th>
                                <th class="border border-gray-300 px-4 py-2">Date de Création</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carrieres as $carriere)
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $carriere->grade_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $carriere->augmentation }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $carriere->formation_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $carriere->created_at->format('d/m/Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('carrieres.edit', $carriere->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                            Modifier
                                        </a>
                                        <form action="{{ route('carrieres.update', $carriere->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Voulez-vous vraiment supprimer cette carrière ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('users.edit', $user_id) }}" class="inline-block bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700">
                    Modifier l'Utilisateur
                </a>
                <a href="{{ route('carrieres.create', ['user_id' => $user_id]) }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Ajouter une Carrière
                </a>
                <a href="{{ route('users.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Retour à la Liste des Utilisateurs
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
