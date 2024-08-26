<x-stafflayout>
<h1>Key Logs</h1>
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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
            <label for="key_number" class="">Key Number</label>
            <input id="key_number" type="text" class="form-control" aria-label="Key Number">
            <x-input-error :messages="$errors->get('key_number')" class="mt-2" />
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
        <!-- Action Selection -->
        <div class="col mt-3">
            <label for="action" class="">Action</label>
            <select name="action" id="action" class="form-control">
                <option value="active">Active</option>
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


<script>
    document.getElementById('hallSelect').addEventListener('change', function() {
        let hallId = this.value;
        let roomSelect = document.getElementById('roomSelect');

        roomSelect.innerHTML = '<option value="">Select a Room</option>'; // Reset room options

        if (hallId) {
            fetch(`/api/rooms/${hallId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(room => {
                        let option = document.createElement('option');
                        option.value = room.id;
                        option.text = room.number;
                        roomSelect.add(option);
                    });
                });
        }
    });
</script>
</x-stafflayout>