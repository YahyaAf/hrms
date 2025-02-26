<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold">Modifier le Département</h1>
                        
                        <div class="flex space-x-2">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                <span class="block text-2xl font-bold">{{ $departement->id }}</span>
                                <span class="text-xs">ID</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Bar -->
                <div class="px-6 py-4 bg-white border-b flex items-center">
                    <a href="{{ route('departements.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition-all duration-200 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à la liste
                    </a>
                    
                    <a href="{{ route('departements.show', $departement) }}" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center transition-all duration-200 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Voir le département
                    </a>
                </div>
                
                <!-- Form Validation Errors -->
                @if ($errors->any())
                    <div class="mx-6 mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-md">
                        <p class="font-bold">Veuillez corriger les erreurs suivantes :</p>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mx-6 mt-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Edit Form -->
                <div class="px-8 py-6">
                    <div class="bg-gray-50 rounded-lg p-6 shadow-inner">
                        <div class="flex items-center mb-6">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center mr-4 text-xl font-bold">
                                {{ substr($departement->nom, 0, 1) }}
                            </div>
                            <p class="text-gray-500">Modification du département <span class="font-medium text-gray-800">{{ $departement->nom }}</span></p>
                        </div>

                        <form action="{{ route('departements.update', $departement) }}" method="POST">
                            @method('PUT')
                            @csrf
                            
                            <div class="mb-6">
                                <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nom" name="nom" value="{{ old('nom', $departement->nom) }}" 
                                        class="w-full pl-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                                        placeholder="Nom du département">
                                </div>
                                @error('nom') 
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <textarea id="description" name="description" rows="5"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                                    placeholder="Description détaillée du département">{{ old('description', $departement->description) }}</textarea>
                                @error('description') 
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="button" onclick="window.location='{{ route('departements.show', $departement) }}'" class="mr-4 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    Annuler
                                </button>
                                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>