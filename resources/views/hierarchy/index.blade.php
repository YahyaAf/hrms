<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Hiérarchie de l'Entreprise</h1>

        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800">Premier Admin</h2>
            <p class="text-gray-600">{{ $admin->name ?? 'Aucun admin trouvé' }}</p>
        </div>

        @foreach($departments as $department)
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Département : {{ $department->nom }}</h2>
                @foreach($grades as $grade)
                    <h3 class="text-lg font-semibold text-gray-800 mt-4">Grade : {{ $grade->name }}</h3>

                    <ul class="list-none">
                        @foreach($department->users->where('grade_id', $grade->id) as $user)
                            <li class="text-gray-600">{{ $user->name }}</li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app-layout>
