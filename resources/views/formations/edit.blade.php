<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Modifier la Formation</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('formations.update', $formation->id) }}" method="POST">
            @csrf
            @method('PUT')  

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom de la formation</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('name', $formation->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type de formation</label>
                <select id="type" name="type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="distance" {{ old('type', $formation->type) == 'distance' ? 'selected' : '' }}>A Distance</option>
                    <option value="presentiel" {{ old('type', $formation->type) == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="competence" class="block text-sm font-medium text-gray-700">Compétences</label>
                <textarea id="competence" name="competence" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('competence', $formation->competence) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="users" class="block text-sm font-medium text-gray-700">Sélectionner les utilisateurs</label>
                <select id="users" name="users[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" multiple required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" 
                            @if(in_array($user->id, $formation->users->pluck('id')->toArray())) 
                                selected 
                            @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">Mettre à jour la formation</button>
        </form>
    </div>
</x-app-layout>
