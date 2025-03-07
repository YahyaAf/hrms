<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Détails de la demande de récupération</h2>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Date de début :</strong> {{ $recuperation->date_debut }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Date de fin :</strong> {{ $recuperation->date_fin }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Nombre de jours :</strong> {{ $recuperation->nombre_jours }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Statut :</strong> 
                <span class="px-2 py-1 text-sm font-semibold rounded-lg 
                    {{ $recuperation->statut == 'En attente' ? 'bg-yellow-100 text-yellow-700' : 
                       ($recuperation->statut == 'Approuvé' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                    {{ $recuperation->statut }}
                </span>
            </p>
        </div>

        <div class="mt-6">
            <a href="{{ route('recuperations.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                Retour à la liste
            </a>
        </div>
    </div>
</x-app-layout>
