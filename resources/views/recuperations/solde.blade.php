<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Solde des Recuperations</h2>

        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <div class="flex justify-between py-2 border-b border-gray-300">
                <span class="font-semibold text-gray-700">Nom :</span>
                <span class="text-gray-900">{{ $user->name }}</span>
            </div>

            <div class="flex justify-between py-2">
                <span class="font-semibold text-gray-700">Solde de Congés :</span>
                <span class="text-green-600 font-bold">{{ $user->solde_recuperation }} jours</span>
            </div>
        </div>
    </div>
</x-app-layout>
