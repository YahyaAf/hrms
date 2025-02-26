<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Liste des Emplois</h2>

        <a href="{{ route('emplois.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un Emploi</a>

        <table class="w-full border mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Département</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emplois as $emploi)
                    <tr class="border">
                        <td class="p-2 border">{{ $emploi->id }}</td>
                        <td class="p-2 border">{{ $emploi->name }}</td>
                        <td class="p-2 border">{{ $emploi->departement->nom }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('emplois.show', $emploi) }}" class="text-blue-500">Voir</a> |
                            <a href="{{ route('emplois.edit', $emploi) }}" class="text-yellow-500">Modifier</a> |
                            <form action="{{ route('emplois.destroy', $emploi) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Supprimer cet emploi ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
