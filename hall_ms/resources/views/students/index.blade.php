<x-studentlayout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Student Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <h2 class="fw-bold text-center"> Booking </h2>
                   @if ($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Room Number</th>
                    <th>Price</th>
                    <th>Hall Name</th>
                    <th>Starting At</th>
                    <th>Ending At</th>
                    <th>Gender</th>
                    <th>Telephone</th>
                    <th>Age</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->room->number }}</td>
                        <td>{{ $booking->room->price }}</td>
                        <td>{{ $booking->hall->name }}</td>
                        <td>{{ $booking->started_at }}</td>
                        <td>{{ $booking->ending_at }}</td>
                        <td>{{ $booking->gender }}</td>
                        <td>{{ $booking->telephone }}</td>
                        <td>{{ $booking->age }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
    @if($booking->status === 'approved')
        <p><strong>Your payment has been sent and approved successfully. View your Room details below:</strong></p>
        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-success">View Room</a> 
    @else
        <p><strong>Kindly make payment within the next 72 hours to secure your booking</strong></p>
        <a href="{{ route('payment.index')}}" class="btn btn-primary">Make Payment</a>
    @endif
</div>
<!--  -->
        </div>
    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h2 class="text-center mb-4 fw-bold">Room Mate</h2>

<div class="row">
    
@if ($relatedBookings->isNotEmpty())
    @foreach ($relatedBookings as $booking)
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm booking-card">
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                    <p><strong>Room Number:</strong> {{ $booking->room->number }}</p>
                    <p><strong>Room Type:</strong> {{ $booking->room->type }} in 1</p>
                    <p><strong>Hall:</strong> {{ $booking->room->hall->name }}</p>
                    <p><strong>Block:</strong> {{ $booking->room->hall->block }}</p>
                    <p><strong>Gender:</strong> {{ $booking->gender }}</p>
                    <!-- <p><strong>Status:</strong> <span class="badge @if($booking->status == 'approved') bg-success @elseif($booking->status == 'pending') bg-warning @endif">{{ ucfirst($booking->status) }}</span></p> -->
                    <p><strong>Contact:</strong> {{ $booking->telephone }}</p>
                    <p><strong>Key Details:</strong></p>
                    <ul class="list-group">
                        @if(isset($keys[$booking->room->id]) && count($keys[$booking->room->id]) > 0)
                            @foreach($keys[$booking->room->id] as $key)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Key Code:</strong> <span class="badge bg-primary">{{ $key->key_code }}</span>
                                    <strong>Key Number:</strong> <span class="badge bg-secondary">{{ $key->key_number }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item list-group-item-warning">No key associated</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
@else
    <p>No Roommate found.</p>
@endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .booking-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.booking-card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
    </style>
</x-app-layout>
</x-studentlayout>