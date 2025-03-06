<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-2xl font-bold mb-4">Détails de la Demande de Congé</h2>

        <table class="min-w-full bg-white border border-gray-200 rounded">
            <tr>
                <td class="py-2 px-4 font-bold">Date de Début:</td>
                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold">Date de Fin:</td>
                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold">Type de Congé:</td>
                <td class="py-2 px-4">{{ $conge->type_conge }}</td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold">Statut:</td>
                <td class="py-2 px-4">{{ $conge->statut }}</td>
            </tr>
        </table>

        @if($conge->status === 'en attente')
            @if(auth()->user()->role === 'manager')
                <form action="{{ route('conges.validate.manager', $conge->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-green-500 text-white p-2 rounded">Valider par le Manager</button>
                </form>
            @elseif(auth()->user()->role === 'rh')
                <form action="{{ route('conges.validate.rh', $conge->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-green-500 text-white p-2 rounded">Valider par le Service RH</button>
                </form>
            @endif
        @endif
    </div>
</x-app-layout>
