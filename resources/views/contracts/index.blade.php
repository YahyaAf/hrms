<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Liste des Contrats</h2>

        <a href="{{ route('contracts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un Contrat</a>

        @if (session('success'))
            <div class="bg-green-200 text-green-700 p-2 my-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $contract)
                    <tr class="border">
                        <td class="p-2 border">{{ $contract->id }}</td>
                        <td class="p-2 border">{{ $contract->name }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('contracts.show', $contract) }}" class="text-blue-500">Voir</a> |
                            <a href="{{ route('contracts.edit', $contract) }}" class="text-yellow-500">Modifier</a> |
                            <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Supprimer ce contrat ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
