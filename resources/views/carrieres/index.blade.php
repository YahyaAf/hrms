<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Liste des Carrières</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Utilisateur</th>
                    <th class="px-4 py-2 border">Grade</th>
                    <th class="px-4 py-2 border">Salaire</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrieres as $carriere)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $carriere->user->name }}</td>
                        <td class="px-4 py-2 border">{{ $carriere->grade->name }}</td>
                        <td class="px-4 py-2 border">{{ $carriere->salaire }} €</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('carrieres.edit', $carriere->user_id) }}" class="text-blue-500 hover:underline">Éditer</a>
                            <form action="{{ route('carrieres.destroy', $carriere->user_id) }}" method="POST" class="inline-block ml-4">
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
            {{ $carrieres->links() }} <!-- Pagination -->
        </div>
    </div>
</x-app-layout>
