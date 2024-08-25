<x-adminlayout>

    <div class="mb-3">
    <a href="{{ route('room.index') }}" class="btn btn-secondary btn-sm">
        &larr; Back
    </a>
</div>
<h1 class="text-center display-4">Members of the Room</h1>

<div class="row">

    @if ($bookings->isEmpty())
        <div class="col-12">
            <div class="alert alert-warning text-center">
                No members found.
            </div>
        </div>
    @else
    @foreach ($bookings as $booking)
    <div class="col-md-3">
        <div class="booking-box @if($booking->status == 'approved') approved @elseif($booking->status == 'pending') pending @endif">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <!-- Display booking details -->
                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                    <p><strong>Room Number:</strong> {{ $booking->room->number }}</p>
                    <p><strong>Room Type:</strong> {{ $booking->room->type }} in 1</p>
                    <p><strong>Hall:</strong> {{ $booking->room->hall->name }}</p>
                    <p><strong>Block:</strong> {{ $booking->room->hall->block }}</p>
                    <p><strong>Gender:</strong> {{ $booking->gender }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                   <!-- Display key details -->
                   <p><strong>Key Details:</strong></p>
                            <ul class="list-group">
                                @if(isset($keys[$booking->room_id]) && count($keys[$booking->room_id]) > 0)
                                    @foreach($keys[$booking->room_id] as $key)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Key Code:</strong> <span class="badge bg-primary">{{ $key->key_code }}</span>
                                            <strong>Key Number:</strong> <span class="badge bg-secondary">{{ $key->key_number }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item list-group-item-warning">No key associated</li>
                                @endif
                            </ul>
                                        </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<style>
    h1.text-center {
    font-size: 3rem; /* Adjust the size as needed */
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}
.booking-box {
    margin-bottom: 20px;
    transition: transform 0.2s ease-in-out;
    border-radius: 5px;
}

.booking-box:hover {
    transform: scale(1.05);
}

.booking-box .card {
    border: 1px solid #ddd;
    border-radius: 5px;
}

.booking-box.approved .card {
    border-left: 5px solid #28a745; /* Green for approved */
}

.booking-box.pending .card {
    border-left: 5px solid #ffc107; /* Yellow for pending */
}

.booking-box .card-body {
    padding: 15px;
}

.booking-box p {
    margin-bottom: 10px;
}

.booking-box p strong {
    color: #333;
}

</style>
</x-adminlayout>