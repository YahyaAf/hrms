<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Créer un Grade</h2>

        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block">Nom du Grade</label>
                <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name') }}">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block">Niveau</label>
                <input type="number" name="level" class="w-full p-2 border rounded" value="{{ old('level') }}">
                @error('level') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
        </form>
    </div>
</x-app-layout>
