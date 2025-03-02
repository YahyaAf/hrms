<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Liste des Formations</h1>
    
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif
    
        <div class="mb-4">
            <a href="{{ route('formations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Créer une formation</a>
        </div>
    
        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nom</th>
                    <th class="px-4 py-2 border">Type</th>
                    <th class="px-4 py-2 border">Compétence</th>
                    <th class="px-4 py-2 border">Utilisateurs</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formations as $formation)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $formation->name }}</td>
                        <td class="px-4 py-2 border">{{ $formation->type }}</td>
                        <td class="px-4 py-2 border">{{ $formation->competence }}</td>
                        <td class="px-4 py-2 border">
                            @foreach ($formation->users as $user)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $user->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('formations.show', $formation->id) }}" class="text-green-500 hover:underline">Voir</a>
                            <a href="{{ route('formations.edit', $formation->id) }}" class="text-blue-500 hover:underline ml-4">Éditer</a>
                            <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="mt-4">
            {{ $formations->links() }} 
        </div>
    </div>
    </x-app-layout>
    