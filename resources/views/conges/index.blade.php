<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-2xl font-bold mb-4">Mes Demandes de Congé</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('conges.create') }}" class="bg-blue-500 text-white p-2 rounded mb-4 inline-block">Faire une Demande de Congé</a>

        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2 px-4">Date de Début</th>
                    <th class="py-2 px-4">Date de Fin</th>
                    <th class="py-2 px-4">Type de Congé</th>
                    <th class="py-2 px-4">Statut</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conges as $conge)
                    <tr>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}</td>
                        <td class="py-2 px-4">{{ $conge->type_conge }}</td>
                        <td class="py-2 px-4">{{ $conge->statut }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('conges.show', $conge->id) }}" class="text-blue-500">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
