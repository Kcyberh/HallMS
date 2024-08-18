<x-stafflayout>
<style>
        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px solid #dddddd;
            display: inline-block;
            margin-left: 10px;
        }
        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
<h1>Register</h1>
@if ($errors->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $errors->first('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
 <!-- index number -->
 <div class="row g-3">
        <form action="{{ route('resident.search')}}" method="POST">
        @csrf
        <div class="col">
        
        <input name="index_number" id="index" type="number" min="0" class="form-control" placeholder="Index Number" aria-label="Index Number">
            <x-input-error :messages="$errors->get('index_number')" class="mt-2" />   
        </div>
        <!--Search -->
        <div class="col">
        <button type="submit" class="btn btn-primary ">Search</button>
        </div>
        @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>{{ session('error') }}</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>      
        </div>
    @endif
        </form>
        <form method="POST" action="{{route('resident.store')}}" enctype="multipart/form-data">
        @csrf
        @if(isset($user))
        <div class="row g-2">
       <!-- Name -->
        <div class="col ">
            <label for="name" class="">Name</label>
            <input name="user_id" value="{{$user->id}}" id="name" type="text" class="form-control"  aria-label="Name"  hidden> 

        <input  value="{{$user->name}}" id="name" type="text" class="form-control"  aria-label="Name" disabled> 
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        
        </div>

        <!-- Email -->
        <div class="col">
        <label for="email" class="">Email</label>
        <input  id="email" type="email" class="form-control" value="{{$user->email}} " aria-label="Email" disabled>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        </div>

        <div class="row g-3 mt-0">

         <!-- Department -->
         <div class="col mt-4">
         <label for="department" class="">Department</label>
         <input  id="department" type="text" class="form-control" value="{{$user->department}}" aria-label="Department" disabled>
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <!-- Level -->
        <div class="col mt-4">
        <label for="level" class="">Level</label>
        <input  id="level" type="number" min="0" class="form-control" value="{{$user->level}}" aria-label="Level" disabled>
            <x-input-error :messages="$errors->get('level')" class="mt-2" />
        </div>
        </div>
        @foreach($payment as $payment)
        <input name="booking_id" value="{{$payment->booking->id}}" id="" type="text" class="form-control"  aria-label="Name"  hidden> 
        <input name="payment_id" value="{{$payment->id}}" id="" type="text" class="form-control"  aria-label="Name"  hidden> 
        <div class="row g-3 mt-0">
             <!-- Telephone -->
             
        <div class="col mt-4">
        <label for="telephone" class="">Contact</label>
        <input  id="telephone" type="number" min="0" class="form-control" value="{{$payment->booking->telephone}}" aria-label="Telephone" disabled>
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>
        
        <!-- Age -->
        <div class="col mt-4">
        <label for="age" class="">Age</label>
        <input  id="age" type="number" min="0" class="form-control" value="{{$payment->booking->age}}" aria-label="Age" disabled>
           <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
        
        <!-- Gender -->
        <div class="col mt-4" >
        <label for="gender" class="">Gender</label>
        <input  id="gender" type="text"  class="form-control" value="{{$payment->booking->gender}}" aria-label="Gender" disabled>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>
        </div>
        
        <!-- Hall Name and Block and Location-->
        
        <div class="mt-4">
    <h3>Hall and Room</h3>
    <p></p>
    <label for="hallSelect">Hall Name and Block</label>
    <input id="hallselect" type="text"  class="form-control" value="{{$payment->booking->hall->name}} {{$payment->booking->hall->block}}" aria-label="Gender" disabled>
    <x-input-error :messages="$errors->get('hall_id')" class="mt-2" />
</div>

        <div class="row">
        <!-- Type and Price -->
        <div class=" col mt-4" >
        <label for="room">Room Number</label>
        <input id="room" type="text"  class="form-control" value="{{$payment->booking->room->number}}" aria-label="room" disabled>
            <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
        </div>
        <div class="col mt-4" >
        <label for="roomtype">Room Type</label>
        <input id="roomtype" type="text" class="form-control" value="{{$payment->booking->room->type}} in 1" aria-label="roomtype" disabled>
            <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
        </div>
        </div>
        <div class="row">
        <!-- Price -->
        <div class=" col mt-4" >
        <label for="amount">Amount Paid</label>
        <input  id="amount" type="text"  class="form-control" value="{{$payment->amount}}" aria-label="amount" disabled>
            <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
        </div>
        <div class="col mt-4" >
        <label for="payment">Payment Date</label>
        <input id="date" type="datetime-local" class="form-control" value="{{$payment->created_at}}" aria-label="payment" disabled>
            <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
        </div>
        </div>

        <div class="row g-3 mt-0">
        <!-- Starting at -->
        <div class="col mt-4" >
        <label for="starting" class="">Starting at</label>
        <input  id="starting" type="datetime-local"  class="form-control" value="{{$payment->booking->started_at}}" aria-label="Starting Date" disabled>
            <x-input-error :messages="$errors->get('started_at')" class="mt-2" />
        </div>
        <!-- Ending at -->
        <div class="col mt-4" >
        <label for="ending" class="">Ending at</label>
        <input  id="ending" type="datetime-local"  class="form-control" value="{{$payment->booking->ending_at}}" aria-label="Ending Date" disabled>
            <x-input-error :messages="$errors->get('ending_at')" class="mt-2" />
        </div>
        </div>
        @endforeach
        @endif
        <!-- Upload Picture -->
        <label>Upload a Passport Picture</label>
         <div class="input-group mb-3 mt-2">
        
        <div class="image-preview" id="imagePreview">
            <img src="" alt="Image Preview" style="display:none;">
            <label class="input-group-text" for="image">Upload</label>
        </div>
        </div>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <x-input-error :messages="$errors->get('image')" class="mt-2" />

        <!--  -->
        <div class="row g-3 mt-0">
             <!-- Guardian -->
        <div class="col mt-4">
        <label for="guardian" class="">Guardian Name</label>
        <input name="guardian_name" id="guardian" type="text"  class="form-control"  aria-label="guardian_name">
            <x-input-error :messages="$errors->get('guardian_name')" class="mt-2" />
        </div>
        <!-- Guardian Phone -->
        <div class="col mt-4">
        <label for="guardian_phone" class="">Guardian Phone Number</label>
        <input name="guardian_phone" id="guardian_phone" type="number" min="0" class="form-control"  aria-label="guardian_phone">
           <x-input-error :messages="$errors->get('guardian_phone')" class="mt-2" />
        </div>
        </div>
        <!-- Guardian Address -->
         <div class="row">
        <div class="col mt-4">
        <label for="guardian_address" class="">Guardian Address</label>
        <textarea name="guardian_address" id="guardian_address" type="text"  class="form-control"  aria-label="guardian_address"></textarea>
           <x-input-error :messages="$errors->get('guardian_address')" class="mt-2" />
        </div>
        <div class="col mt-4">
        <label for="occupation" class="">Occupation</label>
        <input name="occupation" id="occupation" type="text"  class="form-control" value="" aria-label="occupation">
           <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
        </div>
        </div>


        <div class="flex items-center justify-end mt-4" id="d_div"  >
            <button type="submit" class="btn btn-primary ">Register</button>
            
        </div>
        
    </form>
       

    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview').querySelector('img');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                imagePreview.style.display = 'block';

                reader.addEventListener('load', function() {
                    imagePreview.setAttribute('src', this.result);
                });

                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
                imagePreview.setAttribute('src', '');
            }
        });
    </script>
</x-stafflayout>