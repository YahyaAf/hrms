<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-2xl font-bold mb-4">Faire une Demande de Congé</h2>

        <form action="{{ route('conges.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700">Date de Début</label>
                <input type="date" id="date_debut" name="date_debut" class="w-full p-2 border border-gray-300 rounded" required>
                @error('date_debut') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700">Date de Fin</label>
                <input type="date" id="date_fin" name="date_fin" class="w-full p-2 border border-gray-300 rounded" required>
                @error('date_fin') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="type_conge" class="block text-gray-700">Type de Congé</label>
                <select id="type_conge" name="type_conge" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="vacances">Vacances</option>
                    <option value="maladie">Maladie</option>
                    <option value="maternité">Maternité</option>
                    <option value="autre">Autre</option>
                </select>
                @error('type_conge') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="motif" class="block text-gray-700">Motif (facultatif)</label>
                <textarea id="motif" name="motif" class="w-full p-2 border border-gray-300 rounded"></textarea>
                @error('motif') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Soumettre la Demande</button>
        </form>
    </div>
</x-app-layout>
