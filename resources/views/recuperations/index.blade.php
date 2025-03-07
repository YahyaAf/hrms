<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Liste des demandes de récupération</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($recuperations->isEmpty())
            <p class="text-gray-600">Aucune demande de récupération trouvée.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3 border">Date de début</th>
                            <th class="p-3 border">Date de fin</th>
                            <th class="p-3 border">Nombre de jours</th>
                            <th class="p-3 border">Statut</th>
                            <th class="p-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recuperations as $recuperation)
                            <tr class="text-center border">
                                <td class="p-3 border">{{ $recuperation->date_debut }}</td>
                                <td class="p-3 border">{{ $recuperation->date_fin }}</td>
                                <td class="p-3 border">{{ $recuperation->nombre_jours }}</td>
                                <td class="p-3 border">
                                    <span class="px-2 py-1 text-sm font-semibold rounded-lg 
                                        {{ $recuperation->statut == 'En attente' ? 'bg-yellow-100 text-yellow-700' : 
                                           ($recuperation->statut == 'Approuvé' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $recuperation->statut }}
                                    </span>
                                </td>
                                <td class="p-3 border">
                                    <a href="{{ route('recuperations.show', $recuperation->id) }}" class="text-indigo-600 hover:underline">Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('recuperations.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Nouvelle demande
            </a>
        </div>
    </div>
</x-app-layout>
