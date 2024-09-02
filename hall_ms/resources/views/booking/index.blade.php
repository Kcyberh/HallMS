<x-studentlayout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
<!--already booked -->
@if (session('errorss'))
    <script>
        Swal.fire({
            title: "Error!",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>
@endif
    <h1>Request Form</h1>
    

        <!-- index number -->
        <div class="row g-3">
        <form action="{{ route('booking.search')}}" method="POST">
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
        <form method="POST" action="{{ route('booking.store') }}">
        @csrf
        @if(isset($user))
        <div class="row g-2">
       <!-- Name -->
        <div class="col ">
            <label for="name" class="">Name</label>
            <input name="user_id" value="{{$user->id}}" id="name" type="text" class="form-control"  aria-label="Name"  hidden> 
        <input name="" value="{{$user->name}}" id="name" type="text" class="form-control"  aria-label="Name" disabled> 
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        
        </div>

        <!-- Email -->
        <div class="col">
        <label for="email" class="">Email</label>
        <input name="" id="email" type="email" class="form-control" value="{{$user->email}} " aria-label="Email" disabled>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        </div>

        <div class="row g-3 mt-0">

         <!-- Department -->
         <div class="col mt-4">
         <label for="department" class="">Department</label>
         <input name="" id="department" type="text" class="form-control" value="{{ $user->department}}" aria-label="Department" disabled>
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <!-- Level -->
        <div class="col mt-4">
        <label for="level" class="">Level</label>
        <input name="" id="level" type="number" min="0" class="form-control" value="{{ $user->level}}" aria-label="Level" disabled>
            <x-input-error :messages="$errors->get('level')" class="mt-2" />
        </div>
</div>
@endif
        <div class="row g-3 mt-0">
             <!-- Telephone -->
        <div class="col mt-4">
        <label for="telephone" class="">Contact</label>
        <input name="telephone" id="telephone" type="number" min="0" class="form-control" placeholder="+233..." aria-label="Telephone">
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>
        <!-- Age -->
        <div class="col mt-4">
        <label for="age" class="">Age</label>
        <input name="age" id="age" type="number" min="0" class="form-control" placeholder="" aria-label="Age">
           <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
        
        <!-- Gender -->
        <div class="col mt-4" >
        <label for="gender" class="">Gender</label>
        <select name="gender" id="gender" class="form-select" aria-label="gender">
      <option value="" disabled selected>Choose Your Gender...</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
        </select>
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
        </div>
        
        <!-- Hall Name and Block and Location-->
        
        <div class="mt-4">
    <h3>Hall and Room</h3>
    <p>Select the hall you are allocated to on your admission letter. 
      Select any of the available rooms</p>
    <label for="hallSelect">Select Hall:</label>
    <select name="hall_id"  id="hallSelect" class="form-select">
        <option value="">Select a Hall</option>
        @if(isset($user))
        @foreach($hall as $hall)
            <option value="{{ $hall->id }}">{{ $hall->name }} {{ $hall->block }}</option>
        @endforeach
        @endif
    </select>
    <x-input-error :messages="$errors->get('hall_id')" class="mt-2" />
</div>

        
        <!-- Type and Price -->
        <div class="mt-4" >
        <label for="roomSelect">Select Room:</label>
    <select name="room_id" id="roomSelect" class="form-select" disabled>
        <option value="">Select a Room</option>
        <!-- Rooms will be populated here -->
    </select>
            <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
        </div>
        
        <div class="row g-3 mt-1">
              <!-- Starting at -->
        <div class="col mt-1" >
        <label for="starting" class="">Starting at</label>
        <input name="started_at" id="starting" type="datetime-local"  class="form-control" placeholder="Starting Date" aria-label="Starting Date" hidden>
            <x-input-error :messages="$errors->get('started_at')" class="mt-2" />
        </div>
        <!-- Ending at -->
        <div class="col mt-1 mb-3" >
        <label for="ending" class="">Ending at</label>
        <input name="ending_at" id="ending" type="datetime-local"  class="form-control" placeholder="Ending Date" aria-label="Ending Date"  hidden>
            <x-input-error :messages="$errors->get('ending_at')" class="mt-2" />
        </div>
        </div>
        <h6 class="fw-bold">Kindly note that the booking and allocation room last for 10months and payment must be made within 72 hours.</h6>
     
        <!-- Status -->
        

        

        <div class="flex items-center justify-end mt-4" id="d_div"  >
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
               
            </a>

            <button type="submit" class="btn btn-primary ">Request</button>
        </div>
    </form>
   

  <!-- Add CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.getElementById('hallSelect').addEventListener('change', function() {
        loadRooms();
    });

    document.getElementById('gender').addEventListener('change', function() {
        loadRooms();
    });

    function loadRooms() {
        const hallId = document.getElementById('hallSelect').value;
        const gender = document.getElementById('gender').value;

        if (hallId && gender) {
            fetch(`/rooms/${hallId}/${gender}`)
                .then(response => response.json())
                .then(data => {
                    const roomSelect = document.getElementById('roomSelect');
                    roomSelect.innerHTML = '<option value="">Select a Room</option>';

                    data.rooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.id;
                        option.textContent = 'Room Number:'+room.number + ' - ' + ' Price: '+room.price + ' Type: '+room.type+' in 1' ;
                        roomSelect.appendChild(option);
                    });

                    roomSelect.disabled = false;
                });
        } else {
            document.getElementById('roomSelect').disabled = true;
        }
    }

    function setMinDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

    const startingInput = document.getElementById('starting');
    const endingInput = document.getElementById('ending');

    // Set the min attribute for both starting and ending inputs
    startingInput.setAttribute('min', minDateTime);
    endingInput.setAttribute('min', minDateTime);

    // Set the default value for the starting input
    startingInput.value = minDateTime;

    // Calculate the default ending date by adding 10 months to the starting date
    const endDate = new Date(now);
    endDate.setMonth(endDate.getMonth() + 10);

    const endYear = endDate.getFullYear();
    const endMonth = String(endDate.getMonth() + 1).padStart(2, '0');
    const endDay = String(endDate.getDate()).padStart(2, '0');
    const endHours = String(endDate.getHours()).padStart(2, '0');
    const endMinutes = String(endDate.getMinutes()).padStart(2, '0');

    const endDateTime = `${endYear}-${endMonth}-${endDay}T${endHours}:${endMinutes}`;

    // Set the default value for the ending input
    endingInput.value = endDateTime;
}

// Call the function on page load
window.onload = setMinDateTime;
</script>

</x-studentlayout>