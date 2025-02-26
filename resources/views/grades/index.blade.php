<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Liste des Grades</h2>

        <a href="{{ route('grades.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un Grade</a>
        <table class="w-full border mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Niveau</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr class="border">
                        <td class="p-2 border">{{ $grade->id }}</td>
                        <td class="p-2 border">{{ $grade->name }}</td>
                        <td class="p-2 border">{{ $grade->level }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('grades.show', $grade) }}" class="text-blue-500">Voir</a> |
                            <a href="{{ route('grades.edit', $grade) }}" class="text-yellow-500">Modifier</a> |
                            <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Supprimer ce grade ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
