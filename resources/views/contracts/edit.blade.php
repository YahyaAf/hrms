<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Modifier le Contrat</h2>

        <form action="{{ route('contracts.update', $contract) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block">Nom du Contrat</label>
                <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name', $contract->name) }}">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Modifier</button>
        </form>
    </div>
</x-app-layout>
