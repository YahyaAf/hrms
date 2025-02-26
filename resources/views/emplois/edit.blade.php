<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Modifier l'Emploi</h2>

        <form action="{{ route('emplois.update', $emploi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Nom de l'emploi</label>
                <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name', $emploi->name) }}">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Département</label>
                <select name="departement_id" class="w-full p-2 border rounded">
                    @foreach ($departements as $departement)
                        <option value="{{ $departement->id }}" {{ $emploi->departement_id == $departement->id ? 'selected' : '' }}>
                            {{ $departement->nom }}
                        </option>
                    @endforeach
                </select>
                @error('departement_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Modifier</button>
        </form>
    </div>
</x-app-layout>
