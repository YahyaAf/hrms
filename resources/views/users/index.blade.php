<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Liste des Utilisateurs</h1>

        <a href="{{ route('users.create') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md mb-4 hover:bg-blue-600">Ajouter un utilisateur</a>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">ID</th>
                        <th class="px-4 py-2 border border-gray-300">Nom</th>
                        <th class="px-4 py-2 border border-gray-300">Email</th>
                        <th class="px-4 py-2 border border-gray-300">Téléphone</th>
                        <th class="px-4 py-2 border border-gray-300">Date de naissance</th>
                        <th class="px-4 py-2 border border-gray-300">Adresse</th>
                        <th class="px-4 py-2 border border-gray-300">Salaire</th>
                        <th class="px-4 py-2 border border-gray-300">Statut</th>
                        <th class="px-4 py-2 border border-gray-300">Contrat</th>
                        <th class="px-4 py-2 border border-gray-300">Département</th>
                        <th class="px-4 py-2 border border-gray-300">Emploi</th>
                        <th class="px-4 py-2 border border-gray-300">Grade</th>
                        <th class="px-4 py-2 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $user->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->name }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->email }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->telephone }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->date_naissance }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->adresse }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->salaire }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->statut }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->contract->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->departement->nom ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->emploi->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->grade->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                <a href="{{ route('users.show', $user->id) }}" class="inline-block bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600">Voir</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="inline-block bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600">Modifier</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
