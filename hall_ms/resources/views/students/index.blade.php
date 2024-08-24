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
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   Booking Status
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
                    Room Mate: 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</x-studentlayout>