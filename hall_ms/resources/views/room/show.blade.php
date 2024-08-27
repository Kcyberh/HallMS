<x-studentlayout>
<h1 class="text-center display-4 mb-4">Room Details</h1>

<div class="room-details p-3 mb-4">
    <p><strong>Student Name:</strong> {{$booking->user->name}}</p>
    <p><strong>Hall Name:</strong> {{$booking->hall->name}}</p>
    <p><strong>Hall Block:</strong> {{$booking->hall->block}}</p>
    <p><strong>Room Number:</strong> {{$booking->room->number}}</p>
    <p><strong>Room Type:</strong> {{$booking->room->type}} in 1</p>
    <p><strong>Gender:</strong> {{$booking->gender}}</p>
    <p><strong>Contact:</strong> {{$booking->telephone}}</p>
    <ul class="list-group">
    @if ($key)
    <li class="list-group-item d-flex justify-content-between align-items-center">
                   <strong>Key Code:</strong> <span class="badge bg-primary">{{ $key->key_code }}</span>
                    <strong>Key Number:</strong> <span class="badge bg-secondary">{{ $key->key_number }}</span>
                                        </li>
    @else
    <li class="list-group-item list-group-item-warning">No key associated</li>
    @endif
    </ul>
</div>


<style>
    .room-details {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    background-color: #f9f9f9;
}

.room-details:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    
}

.key-detail {
    background-color: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: bold;
}
</style>
</x-studentlayout>