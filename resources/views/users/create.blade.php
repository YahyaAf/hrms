<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Créer un Utilisateur</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="name" name="name" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="email" name="email" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="password" name="password" required>
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="telephone" name="telephone">
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="date_naissance" name="date_naissance">
            </div>

            <div class="mb-4">
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="adresse" name="adresse">
            </div>

            <div class="mb-4">
                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="salaire" name="salaire">
            </div>

            <div class="mb-4">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="statut" name="statut">
            </div>

            <div class="mb-4">
                <label for="contract_id" class="block text-sm font-medium text-gray-700">Contrat</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="contract_id" name="contract_id">
                    @foreach($contracts as $contract)
                        <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Département Selection -->
            <div class="mb-4">
                <label for="departement_id" class="block text-sm font-medium text-gray-700">Département</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                        id="departement_id" name="departement_id">
                    <option value="">Sélectionnez un département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Emploi Selection (will be updated dynamically) -->
            <div class="mb-4">
                <label for="emploi_id" class="block text-sm font-medium text-gray-700">Emploi</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                        id="emploi_id" name="emploi_id">
                    <option value="">Sélectionnez un emploi</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="grade_id" name="grade_id">
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        id="role" name="role">
                    <option value="">Sélectionnez un rôle</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ isset($userRole) && $userRole === $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">Créer</button>
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
