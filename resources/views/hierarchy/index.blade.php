<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-10">Structure hiérarchique</h1>
        <div class="flex justify-center mb-8">
            <div class="bg-blue-100 border-2 border-blue-300 rounded-lg p-4 w-64 text-center">
                <h2 class="font-bold text-lg">Direction générale</h2>
                <p>{{ $admin->name ?? 'Aucun admin trouvé' }}</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="h-10 w-px bg-gray-400"></div>
        </div>
    
        <div class="relative flex justify-center mb-4">
            <div class="absolute w-3/4 h-px bg-gray-400"></div>
        </div>

        <div class="flex flex-wrap justify-center gap-8">
            @foreach($departments as $department)
                <div class="department-section flex flex-col items-center mb-12 w-80">
                    <div class="bg-blue-100 border-2 border-blue-300 rounded-lg p-4 w-full text-center mb-2">
                        <h2 class="font-bold">Direction {{ $department->nom }}</h2>
                    </div>
                    <div class="h-6 w-px bg-gray-400 mb-2"></div>
                    @php
                        $departmentUsers = $department->users->sortByDesc(function($user) {
                            return $user->grade->level;
                        });

                        $usersByLevel = $departmentUsers->groupBy(function($user) {
                            return $user->grade->level;
                        });
                    @endphp
                    
                    @foreach($usersByLevel as $level => $users)
                        <div class="level-group w-full mb-6">
                            <h3 class="text-sm font-medium text-gray-700 bg-gray-100 p-1 rounded text-center mb-2">
                                Niveau {{ $level }}
                            </h3>
    
                            <div class="flex flex-wrap justify-center gap-2">
                                @foreach($users as $user)
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 w-36 text-center">
                                        <p class="font-medium text-sm">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-600">{{ $user->grade->name ?? 'Sans grade' }}</p>
                                    </div>
                                @endforeach
                            </div>
                            @if(!$loop->last)
                                <div class="flex justify-center my-2">
                                    <div class="h-4 w-px bg-gray-400"></div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    
    <style>
        .department-section {
            min-height: 300px;
        }
        
        .level-group:empty {
            display: none;
        }
    </style>
</x-app-layout>
