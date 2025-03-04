<x-app-layout>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Créer une Carrière pour {{ $user->name }}</h2>
        
        <form action="{{ route('carrieres.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="mb-4">
                <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                <select id="grade_id" name="grade_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Sélectionner un grade</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="augmentation" class="block text-sm font-medium text-gray-700">Augmentation</label>
                <input type="number" id="augmentation" name="augmentation" value="{{ old('augmentation') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('augmentation')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Créer Carrière
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
