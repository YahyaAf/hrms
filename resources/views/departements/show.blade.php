<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold">Détails du Département</h1>
                        
                        <div class="flex space-x-2">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                <span class="block text-2xl font-bold">{{ $departement->id }}</span>
                                <span class="text-xs">ID</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Bar -->
                <div class="px-6 py-4 bg-white border-b flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('departements.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition-all duration-200 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour à la liste
                        </a>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('departements.edit', $departement) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier
                            </a>
                            
                            <form action="{{ route('departements.destroy', $departement) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer ce département ?')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Department Details -->
                <div class="px-8 py-6">
                    <div class="bg-gray-50 rounded-lg p-6 shadow-inner">
                        <div class="flex items-center mb-6">
                            <div class="h-16 w-16 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center mr-4 text-2xl font-bold">
                                {{ substr($departement->nom, 0, 1) }}
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ $departement->nom }}</h2>
                                <p class="text-sm text-gray-500">Département #{{ $departement->id }}</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                            <div class="bg-white p-4 rounded-md border border-gray-200">
                                <p class="text-gray-700">{{ $departement->description }}</p>
                            </div>
                        </div>
                        
                        <!-- Additional Information (if available) -->
                        @if(isset($departement->created_at) || isset($departement->updated_at))
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if(isset($departement->created_at))
                                    <div class="bg-white p-4 rounded-md border border-gray-200">
                                        <p class="text-sm text-gray-500">Date de création</p>
                                        <p class="font-medium">{{ $departement->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                @endif
                                
                                @if(isset($departement->updated_at))
                                    <div class="bg-white p-4 rounded-md border border-gray-200">
                                        <p class="text-sm text-gray-500">Dernière modification</p>
                                        <p class="font-medium">{{ $departement->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>