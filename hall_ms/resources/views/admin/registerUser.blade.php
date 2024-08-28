<x-adminlayout>
<x-guests>
    
    <form method="POST" action="{{ route('registerUser.store') }}">
        @csrf
        <div class="row g-3">
        <!-- Name -->
        <div class="col">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
<!-- Usertype -->
<div class="col">
    <x-input-label for="usertype" :value="__('User Type')" />
    <select id="usertype" name="usertype" class="block mt-1 w-full form-control" required autocomplete="usertype">
        <option value="" disabled selected>Select a user Role</option>
        <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ old('usertype') == 'staff' ? 'selected' : '' }}>Staff</option>
        <option value="student" {{ old('usertype') == 'student' ? 'selected' : '' }}>Student</option>
    </select>
    <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
    </div>
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

        
        <div class="row">
         <!-- Index Number -->
         <div class="col mt-4" id="index_number_div" style="display:none;">
            <x-input-label for="index_number" :value="__('Index number')" />
            <x-text-input id="usertype" class="block mt-1 w-full" type="number" min="0"  name="index_number" :value="old('index_number')"  autocomplete="index_number" />
            <x-input-error :messages="$errors->get('index_number')" class="mt-2" />
        </div>
        
        <!-- Level -->
        <div class="col mt-4" id="level_div" style="display:none;">
            <x-input-label for="level" :value="__('Level')" />
            <x-text-input id="level" class="block mt-1 w-full" type="number" min="0" name="level" :value="old('level')"  autocomplete="level" />
            <x-input-error :messages="$errors->get('level')" class="mt-2" />
        </div>
        </div>
     <!-- Department -->
        <div class="mt-4" id="department_div" style="display:none;">
        <select id="department" name="department" class="form-select" aria-label="Default select example">
        <option value="" disabled selected>Select a department</option>
        <option value="Centre For African Studies">Centre For African Studies</option>
        <option value="Centre For Conflict, Human Rights and Peace Studies">Centre For Conflict, Human Rights and Peace Studies</option>
        <option value="Department of Economics Education">Department of Economics Education</option>
        <option value="Department of Geography Education">Department of Geography Education</option>
        <option value="Department of History Education">Department of History Education</option>
        <option value="Department of Political Science Education">Department of Political Science Education</option>
        <option value="Department of Social Studies Education">Department of Social Studies Education</option>
        <option value="Department Agricultural Science Education and Environmental Science">Department Agricultural Science Education and Environmental Science</option>
        <option value="Department of Biology Education">Department of Biology Education</option>
        <option value="Department of Chemistry Education">Department of Chemistry Education</option>
        <option value="Department of Environmental Science Education">Department of Environmental Science Education</option>
        <option value="Department of Information and Communication Technology">Department of Information and Communication Technology</option>
        <option value="Department of Integrated Science Education">Department of Integrated Science Education</option>
        <option value="Department of Mathematics Education">Department of Mathematics Education</option>
        <option value="Department of Physics Education">Department of Physics Education</option>
        <option value="Department of Accounting">Department of Accounting</option>
        <option value="Department of Applied Finance and Policy Management">Department of Applied Finance and Policy Management</option>
        <option value="Department of Management Sciences">Department of Management Sciences</option>
        <option value="Department of Marketing and Entrepreneurship">Department of Marketing and Entrepreneurship</option>
        <option value="Department of Procurement and Supply Chain Management">Department of Procurement and Supply Chain Management</option>
        <option value="Department of Akan-Nzema Education">Department of Akan-Nzema Education</option>
        <option value="Department of Ewe Education">Department of Ewe Education</option>
        <option value="Department of Ga-Dangme Education">Department of Ga-Dangme Education</option>
        <option value="Department of Gur-Gonja Education">Department of Gur-Gonja Education</option>
        <option value="Department of Applied Linguistics">Department of Applied Linguistics</option>
        <option value="Department of English Education">Department of English Education</option>
        <option value="Department of French Education">Department of French Education</option>
        <option value="Department of Art Education">Department of Art Education</option>
        <option value="Department of Graphic Design">Department of Graphic Design</option>
        <option value="Department of Music Education">Department of Music Education</option>
        <option value="Department of Textiles and Fashion Education">Department of Textiles and Fashion Education</option>
        <option value="Department of Theatre Arts">Department of Theatre Arts</option>
        <option value="Department of Basic Education">Department of Basic Education</option>
        <option value="Department of Educational Foundations">Department of Educational Foundations</option>
        <option value="Department of Educational Management and Administration Education">Department of Educational Management and Administration Education</option>
        <option value="Department of Clothing and Textiles Education">Department of Clothing and Textiles Education</option>
        <option value="Department of Environmental Health and Sanitation Education">Department of Environmental Health and Sanitation Education</option>
        <option value="Department of Family Life Management Education">Department of Family Life Management Education</option>
        <option value="Department of Food and Nutrition Education">Department of Food and Nutrition Education</option>
        <option value="Department of Health Administration Education">Department of Health Administration Education</option>
        <option value="Department of Health, Physical Education, Recreation and Sports">Department of Health, Physical Education, Recreation and Sports</option>
        <option value="Department of Integrated Home Economics Education">Department of Integrated Home Economics Education</option>
        <option value="Department of Communication Instruction">Department of Communication Instruction</option>
        <option value="Department of Development Communication">Department of Development Communication</option>
        <option value="Department of Journalism and Media Studies">Department of Journalism and Media Studies</option>
        <option value="Department of Strategic Communication">Department of Strategic Communication</option>
        <option value="Department of Counselling Psychology">Department of Counselling Psychology</option>
        <option value="Department of Early Grade Education">Department of Early Grade Education</option>
        <option value="Department of Special Education">Department of Special Education</option>
        
        </select>
        <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>
<div>
            <x-primary-button class="flex items-center justify-end mt-4">
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
                
                

                function toggleFields() {
                    if (usertypeInput.value.toLowerCase() === 'student') {
                        indexNumberDiv.style.display = 'block';
                        levelDiv.style.display = 'block';
                        departmentDiv.style.display = 'block';
                        
                        
                    } 
                     else {
                        indexNumberDiv.style.display = 'none';
                        levelDiv.style.display = 'none';
                        departmentDiv.style.display = 'none';
                        
                        
                    }
                }

                usertypeInput.addEventListener('change', toggleFields);

                // Initial call to set the correct state
                toggleFields();
                
            });
        </script>
</x-guests>
</x-adminlayout>