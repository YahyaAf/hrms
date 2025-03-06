<x-app-layout>
    <div class="container mx-auto px-4 py-6 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800">Détails de la Demande de Congé</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded p-4">
                        <p class="text-sm text-gray-500 mb-1">Date de Début</p>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded p-4">
                        <p class="text-sm text-gray-500 mb-1">Date de Fin</p>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded p-4">
                        <p class="text-sm text-gray-500 mb-1">Type de Congé</p>
                        <p class="font-semibold">{{ $conge->type_conge }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded p-4">
                        <p class="text-sm text-gray-500 mb-1">Statut</p>
                        <p class="font-semibold">
                            @if($conge->statut === 'en attente')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                            @elseif($conge->statut === 'validé')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Validé</span>
                            @elseif($conge->statut === 'refusé')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Refusé</span>
                            @else
                                {{ $conge->statut }}
                            @endif
                        </p>
                    </div>
                </div>
                
                @if($conge->commentaire)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Commentaire</h3>
                        <div class="bg-gray-50 p-4 rounded">
                            <p>{{ $conge->commentaire }}</p>
                        </div>
                    </div>
                @endif
                
                @if($conge->statut === 'en attente')
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="text-lg font-semibold mb-4">Actions</h3>
                        <div class="flex flex-wrap gap-3">
                            @if(auth()->user()->role === 'manager')
                                <form action="{{ route('conges.validate.manager', $conge->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                        Valider par le Manager
                                    </button>
                                </form>
                                <form action="{{ route('conges.reject.manager', $conge->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                        Refuser
                                    </button>
                                </form>
                            @elseif(auth()->user()->role === 'rh')
                                <form action="{{ route('conges.validate.rh', $conge->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                        Valider par le Service RH
                                    </button>
                                </form>
                                <form action="{{ route('conges.reject.rh', $conge->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                        Refuser
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('conges.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                Retour
                            </a>
                        </div>
                    </div>
                @else
                    <div class="mt-6">
                        <a href="{{ route('conges.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            Retour
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>