<div>
    <div class="mb-4">
        <label for="departement_id" class="block text-sm font-medium text-gray-700">Département</label>
        <select wire:model="departement_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="departement_id" name="departement_id">
            <option value="">Sélectionner un département</option>
            @foreach($departements as $departement)
                <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="emploi_id" class="block text-sm font-medium text-gray-700">Emploi</label>
        <select wire:model="emploi_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="emploi_id" name="emploi_id">
            <option value="">Sélectionner un emploi</option>
            @foreach($emplois as $emploi)
                <option value="{{ $emploi->id }}">{{ $emploi->name }}</option>
            @endforeach
        </select>
    </div>
</div>
