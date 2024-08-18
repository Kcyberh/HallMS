<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Usertype -->
        <div class="mt-4">
            <x-input-label for="usertype" :value="__('Usertype')" />
            <x-text-input id="usertype" class="block mt-1 w-full" type="text" name="usertype" :value="old('usertype')" required autocomplete="usertype" />
            <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
        </div>

        <!-- Telephone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Telephone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="number" min="0" name="telephone" :value="old('telephone')" required autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Age 
        <div class="mt-4" id="age_div" style="display:none;">
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" class="block mt-1 w-full" type="number" min="0" max="100" name="age" :value="old('age')" required autocomplete="age" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div> -->

         <!-- Index Number -->
         <div class="mt-4" id="index_number_div" style="display:none;">
            <x-input-label for="index_number" :value="__('Index number')" />
            <x-text-input id="usertype" class="block mt-1 w-full" type="number" min="0"  name="index_number" :value="old('index_number')" required autocomplete="index_number" />
            <x-input-error :messages="$errors->get('index_number')" class="mt-2" />
        </div>
        <!-- Level -->
        <div class="mt-4" id="level_div" style="display:none;">
            <x-input-label for="level" :value="__('Level')" />
            <x-text-input id="level" class="block mt-1 w-full" type="number" min="0" name="level" :value="old('level')" required autocomplete="level" />
            <x-input-error :messages="$errors->get('level')" class="mt-2" />

     <!-- Department -->
     <div class="mt-4" id="department_div" style="display:none;">
            <x-input-label for="department" :value="__('Department')" />
            <x-text-input id="department" class="block mt-1 w-full" type="text"   name="department" :value="old('department')" required autocomplete="department" />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4" id="d_div"  >
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
            document.addEventListener('DOMContentLoaded', function () {
                const usertypeInput = document.getElementById('usertype');
                const indexNumberDiv = document.getElementById('index_number_div');
                const levelDiv = document.getElementById('level_div');
                const departmentDiv = document.getElementById('department_div');
                const ageDiv = document.getElementById('age_div');
                

                function toggleFields() {
                    if (usertypeInput.value.toLowerCase() === 'student') {
                        indexNumberDiv.style.display = 'block';
                        levelDiv.style.display = 'block';
                        departmentDiv.style.display = 'block';
                        ageDiv.style.display = 'block';
                        
                    } else {
                        indexNumberDiv.style.display = 'none';
                        levelDiv.style.display = 'none';
                        departmentDiv.style.display = 'none';
                        ageDiv.style.display = 'none';
                        
                    }
                }

                usertypeInput.addEventListener('change', toggleFields);

                // Initial call to set the correct state
                toggleFields();
                
            });
        </script>
</x-guest-layout>
