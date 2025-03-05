<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-2xl font-bold mb-4">Solde des Congés</h2>

        <table class="min-w-full bg-white border border-gray-200 rounded">
            <tr>
                <td class="py-2 px-4 font-bold">Nom:</td>
                <td class="py-2 px-4">{{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold">Solde de Congés:</td>
                <td class="py-2 px-4">{{ auth()->user()->solde_conges }} jours</td>
            </tr>
        </table>
    </div>
</x-app-layout>
