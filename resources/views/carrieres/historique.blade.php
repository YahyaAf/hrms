<x-app-layout>
    <div class="container mx-auto py-6">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6">
                <h2 class="text-3xl font-bold text-white text-center flex items-center justify-center">
                    <i class="fas fa-history mr-4 text-white"></i>
                    Mon Historique de Carrière
                </h2>
            </div>

            <div class="p-8">
                @if($carrieres->isEmpty())
                    <div class="text-center py-12 bg-gray-100 rounded-xl">
                        <i class="fas fa-folder-open text-6xl text-gray-400 mb-4"></i>
                        <p class="text-xl text-gray-600">Aucun historique de carrière enregistré</p>
                    </div>
                @else
                    <div class="relative py-8">
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-gradient-to-b from-blue-400 to-purple-600 h-full"></div>

                        <div class="space-y-12 relative">
                            @foreach($carrieres as $index => $carriere)
                                <div class="flex items-center w-full {{ $index % 2 == 0 ? '' : 'flex-row-reverse' }}">
                                    <div class="w-1/2 {{ $index % 2 == 0 ? 'pr-8' : 'pl-8' }}">
                                        <div class="timeline-card relative bg-white p-6 rounded-xl shadow-lg border-l-4 
                                            {{ $index % 4 == 0 ? 'border-blue-500' : 
                                               ($index % 4 == 1 ? 'border-green-500' : 
                                               ($index % 4 == 2 ? 'border-purple-500' : 'border-yellow-500')) }}
                                            hover:scale-105 transition-transform">
                                            
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                                                    <i class="fas fa-briefcase mr-3 self-start mt-1
                                                        {{ $index % 4 == 0 ? 'text-blue-500' : 
                                                           ($index % 4 == 1 ? 'text-green-500' : 
                                                           ($index % 4 == 2 ? 'text-purple-500' : 'text-yellow-500')) }}"></i>
                                                    Étape #{{ $index + 1 }}
                                                </h3>
                                                <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded flex items-center">
                                                    <i class="fas fa-calendar-alt mr-2"></i>
                                                    {{ $carriere->created_at->format('d/m/Y') }}
                                                </span>
                                            </div>

                                            <div class="space-y-3 pl-8 relative">
                                                @php
                                                    $details = [
                                                        'Grade' => $carriere->grade->name ?? 'Non défini',
                                                        'Salaire' => $carriere->augmentation ? $carriere->augmentation . ' €' : 'Non défini',
                                                        'Contrat' => $carriere->contract->name ?? 'Non défini',
                                                        'Formation' => $carriere->formation->name ?? 'Non défini'
                                                    ];
                                                @endphp

                                                @foreach($details as $label => $value)
                                                    <p class="flex items-center relative">
                                                        <span class="absolute left-[-2rem] top-1 w-8 flex justify-center">
                                                            <i class="fas 
                                                                {{ $label == 'Grade' ? 'fa-star' : 
                                                                   ($label == 'Augmentation' ? 'fa-chart-line' : 
                                                                   ($label == 'Contrat' ? 'fa-file-contract' : 'fa-graduation-cap')) }} 
                                                                opacity-50"></i>
                                                        </span>
                                                        <span class="font-medium text-gray-600 mr-2 w-24">
                                                            {{ $label }}:
                                                        </span>
                                                        <span class="{{ $value == 'Non défini' ? 'text-gray-400 italic' : 'text-gray-800' }}">
                                                            {{ $value }}
                                                        </span>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="absolute left-1/2 transform -translate-x-1/2 
                                        {{ $index % 4 == 0 ? 'bg-blue-600' : 
                                           ($index % 4 == 1 ? 'bg-green-600' : 
                                           ($index % 4 == 2 ? 'bg-purple-600' : 'bg-yellow-600')) }}
                                        w-8 h-8 rounded-full z-10 
                                        animate-pulse"></div>

                                    @if($index % 2 == 1)
                                        <div class="w-1/2"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
