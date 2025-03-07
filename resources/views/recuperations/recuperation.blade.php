<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Gestion des demandes de récupération</h2>
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Nom de l'utilisateur</th>
                        <th class="px-4 py-2 text-left">Date de début</th>
                        <th class="px-4 py-2 text-left">Date de fin</th>
                        <th class="px-4 py-2 text-left">Nombre de jours</th>
                        <th class="px-4 py-2 text-left">Statut</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recuperations as $recuperation)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $recuperation->user->name }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($recuperation->date_debut)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($recuperation->date_fin)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $recuperation->nombre_jours }}</td>
                            <td class="px-4 py-2">{{ $recuperation->statut }}</td>
                            <td class="px-4 py-2">
                                @if(auth()->user()->hasRole('RH') && auth()->user()->departement_id == $recuperation->user->departement_id)
                                    <form action="{{ route('recuperations.validateRh', $recuperation->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-500 text-white py-1 px-4 rounded-md hover:bg-green-600">Accepter</button>
                                    </form>
                            
                                    <form action="{{ route('recuperations.rejectRh', $recuperation->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded-md hover:bg-red-600">Refuser</button>
                                    </form>
                                @endif
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
