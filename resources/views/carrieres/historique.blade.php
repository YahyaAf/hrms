<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Mon historique de carrière</h1>

        @if ($historique->isEmpty())
            <p class="text-gray-500">Vous n'avez pas d'historique de carrière pour le moment.</p>
        @else
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full table-auto text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-3">Nom</th>
                            <th class="px-6 py-3">Grade</th>
                            <th class="px-6 py-3">Augmentation</th>
                            <th class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historique as $carriere)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $carriere->formation ? $carriere->formation->name : 'Formation non disponible' }}</td>
                                <td class="px-6 py-4">{{ $carriere->grade ? $carriere->grade->name : 'Grade non disponible' }}</td>
                                <td class="px-6 py-4">{{ $carriere->augmentation ? $carriere->augmentation : 'Aucune augmentation' }}</td>
                                <td class="px-6 py-4">{{ $carriere->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
