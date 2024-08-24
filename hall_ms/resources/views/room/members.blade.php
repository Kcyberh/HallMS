<x-adminlayout>
    <h1>Members</h1>
    @foreach ($rooms as $room)
    <div>
        <!-- Display room details here -->
        <p>Room Number: {{ $room->number }}</p>
        <p>Hall ID: {{ $room->hall_id }}</p>
        <!-- Add other room details as needed -->
    </div>
@endforeach
</x-adminlayout>