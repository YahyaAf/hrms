<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-2xl font-bold mb-4">Gestion des Congés</h2>

        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4">Nom de l'Employé</th>
                    <th class="py-2 px-4">Date Début</th>
                    <th class="py-2 px-4">Date Fin</th>
                    <th class="py-2 px-4">Jours Demandés</th>
                    <th class="py-2 px-4">Statut</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conges as $conge)
                    <tr>
                        <td class="py-2 px-4">{{ $conge->user->name }}</td>
                        <td class="py-2 px-4">{{ $conge->date_debut }}</td>
                        <td class="py-2 px-4">{{ $conge->date_fin }}</td>
                        <td class="py-2 px-4">{{ $conge->jours_demandes }}</td>
                        <td class="py-2 px-4">
                            @if ($conge->statut == 'En attente')
                                <span class="text-yellow-500">{{ $conge->statut }}</span>
                            @elseif ($conge->statut == 'Approuvé')
                                <span class="text-green-500">{{ $conge->statut }}</span>
                            @else
                                <span class="text-red-500">{{ $conge->statut }}</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">
                            <!-- Actions buttons for manager or RH -->
                            @if ($conge->validation_manager == false)
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Approuver Manager</button>
                                </form>
                            @elseif ($conge->validation_rh == false)
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Approuver RH</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
