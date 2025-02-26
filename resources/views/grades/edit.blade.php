<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Modifier le Grade</h2>

        <form action="{{ route('grades.update', $grade) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block">Nom du Grade</label>
                <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name', $grade->name) }}">
            </div>
            <div class="mb-4">
                <label class="block">Niveau</label>
                <input type="number" name="level" class="w-full p-2 border rounded" value="{{ old('level', $grade->level) }}">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Modifier</button>
        </form>
    </div>
</x-app-layout>
