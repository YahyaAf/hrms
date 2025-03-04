<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier la Carrière de {{ $carriere->user->name }}</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('carrieres.update', $carriere->user_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                <div class="relative">
                    <select id="grade_id" name="grade_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ $carriere->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="number" id="augmentation" name="augmentation" value="{{ old('augmentation', $carriere->augmentation) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200" min="0" required>
            </div>


            <div class="mb-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">Mettre à jour</button>
            </div>
        </form>

        {{-- <a href="{{ route('carrieres.index') }}" class="text-blue-600 hover:text-blue-800">Retour à la liste des carrières</a> --}}
    </div>
</x-app-layout>
