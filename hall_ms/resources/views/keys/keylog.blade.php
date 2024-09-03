<x-stafflayout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h1>Key Logs</h1>
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
<div class="m-3">
    <form action="{{ route('key.store') }}" method="POST" class="hall">
        @csrf
        <div class="row">
            <!-- User ID (hidden) -->
            <input name="user_id" value="{{ $user->id }}" type="hidden" class="form-control" aria-label="User ID">

            <!-- Room Number (hidden) -->
            <input name="key_room_id" value="" type="hidden" class="form-control" aria-label="Key Room ID">

            <!-- User Name -->
            <div class="col">
    <label for="studentName" class="">Name of Student</label>
    <input name="student_name" id="studentName" type="text" class="form-control" aria-label="Name of Student" required>
    <x-input-error :messages="$errors->get('student_name')" class="mt-2" />
</div>
        
    <div class="col">
    <label for="hallSelect">Select Hall:</label>
    <select  id="hallSelect" class="form-select">
        <option value="">Select a Hall</option>
        @if(isset($user))
        @foreach($hall as $hall)
            <option value="{{ $hall->id }}">{{ $hall->name }} {{ $hall->block }}</option>
        @endforeach
        @endif
    </select>
    <x-input-error :messages="$errors->get('hall_id')" class="mt-2" />
</div>
</div>
            <!-- Room Number -->
            <div class="col ">
    <label for="roomSelect" class="">Room Number</label>
    <select name="room_id" id="roomSelect" class="form-select">
        <option value="">Select a Room</option>
        <!-- Options will be populated by JavaScript -->
    </select>
    <x-input-error :messages="$errors->get('room_id')" class="mt-2" />

        </div>
        <!-- Action Selection -->
        <div class="col mt-3">
            <label for="action" class="">Action</label>
            <select name="action" id="action" class="form-control">
                <option value="issued">Issued</option>
                <option value="returned">Returned</option>
                <option value="lost">Lost</option>
            </select>
            <x-input-error :messages="$errors->get('action')" class="mt-2" />
        </div>

        <!-- Additional Details -->
        <div class="col mt-3">
            <label for="details" class="">Details</label>
            <textarea name="details" id="details" rows="4" class="form-control" aria-label="Details"></textarea>
            <x-input-error :messages="$errors->get('details')" class="mt-2" />
        </div>
        
        <!-- Submit Button -->
        <div class="col mt-3">
            <button type="submit" class="btn btn-primary">Log Action</button>
        </div>
    </form>
</div>

<div class="border border-dark rounded p-2 shadow-sm">
    <h3 class="fw-bold text-center">Key Keeping</h3>
</div>
@if($keyLogs->isset())
<div class="table-responsive mt-3">
        <table id="myTable" class="table  table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Room Number</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Time Issued</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keyLogs as $keyLog)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keyLog->user->name }}</td>
                        <td>{{ $keyLog->room->number }}</td>
                        <td>{{ ucfirst($keyLog->action) }}</td>
                        <td>{{ $keyLog->details }}</td>
                        <td>{{ $keyLog->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
<div class="text-center mt-3">
    <p>No key logs found.</p>
</div>
<script>
   document.getElementById('hallSelect').addEventListener('change', function() {
    let hallId = this.value;
    let roomSelect = document.getElementById('roomSelect');

    roomSelect.innerHTML = '<option value="">Select a Room</option>'; // Reset room options

    if (hallId) {
        fetch(`/api/rooms/${hallId}`)
            .then(response => response.json())
            .then(data => {
                let uniqueRooms = new Set(); // Create a Set to store unique room numbers

                data.forEach(room => {
                    if (!uniqueRooms.has(room.number)) { // Check if the room number is not in the Set
                        uniqueRooms.add(room.number); // Add the room number to the Set
                        let option = document.createElement('option');
                        option.value = room.id;
                        option.text = room.number;
                        roomSelect.add(option);
                    }
                });
            });
    }
});
</script>
</x-stafflayout>