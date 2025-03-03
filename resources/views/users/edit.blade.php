<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Modifier l'Utilisateur</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Nom</label>
                <input type="text" class="form-input mt-1 block w-full" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" class="form-input mt-1 block w-full" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">Mot de passe</label>
                <input type="password" class="form-input mt-1 block w-full" id="password" name="password">
                @error('password') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirmer le mot de passe</label>
                <input type="password" class="form-input mt-1 block w-full" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date_de_recrutement" class="block text-gray-700 font-semibold">Date de recrutement</label>
                <input type="date" class="form-input mt-1 block w-full" id="date_de_recrutement" name="date_de_recrutement" value="{{ old('date_de_recrutement', $user->date_de_recrutement) }}">
                @error('date_de_recrutement') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 font-semibold">Téléphone</label>
                <input type="text" class="form-input mt-1 block w-full" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                @error('telephone') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="block text-gray-700 font-semibold">Date de naissance</label>
                <input type="date" class="form-input mt-1 block w-full" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance) }}">
                @error('date_naissance') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="adresse" class="block text-gray-700 font-semibold">Adresse</label>
                <input type="text" class="form-input mt-1 block w-full" id="adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}">
                @error('adresse') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salaire" class="block text-gray-700 font-semibold">Salaire</label>
                <input type="number" class="form-input mt-1 block w-full" id="salaire" name="salaire" value="{{ old('salaire', $user->salaire) }}">
                @error('salaire') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="statut" class="block text-gray-700 font-semibold">Statut</label>
                <input type="text" class="form-input mt-1 block w-full" id="statut" name="statut" value="{{ old('statut', $user->statut) }}">
                @error('statut') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contract_id" class="block text-gray-700 font-semibold">Contrat</label>
                <select class="form-input mt-1 block w-full" id="contract_id" name="contract_id">
                    @foreach($contracts as $contract)
                        <option value="{{ $contract->id }}" {{ $user->contract_id == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                    @endforeach
                </select>
                @error('contract_id') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="departement_id" class="block text-sm font-medium text-gray-700">Département</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                        id="departement_id" name="departement_id">
                    <option value="">Sélectionnez un département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}" 
                            {{ isset($user) && $user->departement_id == $departement->id ? 'selected' : '' }}>
                            {{ $departement->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="emploi_id" class="block text-sm font-medium text-gray-700">Emploi</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                        id="emploi_id" name="emploi_id">
                    <option value="">Sélectionnez un emploi</option>
                    @if(isset($emplois) && isset($user))
                        @foreach($emplois as $emploi)
                            <option value="{{ $emploi->id }}" 
                                {{ $user->emploi_id == $emploi->id ? 'selected' : '' }}>
                                {{ $emploi->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>


            <div class="mb-4">
                <label for="grade_id" class="block text-gray-700 font-semibold">Grade</label>
                <select class="form-input mt-1 block w-full" id="grade_id" name="grade_id">
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ $user->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id') 
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Sauvegarder les modifications</button>
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Annuler</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#departement_id').on('change', function() {
                var departementId = $(this).val();

                if (departementId) {
                    $.ajax({
                        url: '/get-emplois/' + departementId,
                        type: 'GET',
                        success: function(response) {
                            $('#emploi_id').empty().append('<option value="">Sélectionnez un emploi</option>');
                            $.each(response, function(key, emploi) {
                                $('#emploi_id').append('<option value="'+ emploi.id +'">'+ emploi.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#emploi_id').empty().append('<option value="">Sélectionnez un emploi</option>');
                }
            });
        });
    </script>
</x-app-layout>
