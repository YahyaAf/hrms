{{-- <x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Liste des Carrières</h1>

        <!-- Success message (if any) -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Utilisateur</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Promotion</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Augmentation</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Formation</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrieres as $carriere)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $carriere->user->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            {{ $carriere->grade ? $carriere->grade->name : 'Aucun' }}
                        </td>                        
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $carriere->augmentation }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $carriere->formation->name ?? 'Aucune' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('carrieres.show', $carriere->id) }}" class="text-blue-600 hover:text-blue-800">Voir</a> |
                            <a href="{{ route('carrieres.edit', $carriere->user_id) }}" class="text-yellow-600 hover:text-yellow-800">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="mt-6">
            {{ $carrieres->links() }}
        </div>
    </div>
</x-app-layout> --}}
