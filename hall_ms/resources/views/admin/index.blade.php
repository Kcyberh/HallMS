
<x-adminlayout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Admin Dashboard') }}
            
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">
                            Total Hall: {{ $hallCount }}
                        </h3>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">
                            Total Rooms: {{ $roomCount }}  
                        </h3>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">
                            Total Booking: {{ $bookingCount }}  
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!--Card -->
    <div class="row mt-3">
  <div class="col-sm-6 mb-3 mb-sm-0" >
  <div class="card bg-warning">
      <div class="card-body ">
      <img src="icons/account_circle.png" alt="booking" srcset="" width="20%" >
      <span></span>
        <h5 class="card-title">{{ $user }} <strong>Users </strong></h5>
        <p class="card-text">Admins: {{$admin}}</p>
        <p class="card-text">Hall Assistant: {{$staff}}</p>
        <p class="card-text">Student: {{ $student}}</p>
        <a href="{{ route('registerUser.index') }}" class="btn btn-primary">View Details</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6" >
    <div class="card">
      <div class="card-body">
      <img src="icons/booking.png" alt="room" srcset="" width="20%" >
        <h4 class="card-title">{{ $bookingCount }} <strong>Bookings </strong></h4>
        <p class="card-text">Approved: {{ $approved}}</p>
        <p class="card-text">Pending: {{ $pending}}</p>
        <p class="card-text">Payment: {{ $payment}}</p>
        <a href="{{ route('booking.managebooking')}}" class="btn btn-primary">View Details</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 mt-2">
    <div class="card">
      <div class="card-body">
      <img src="icons/room.png" alt="room" srcset="" width="20%" >
      <span></span>
        <h5 class="card-title">{{ $roomCount }} <strong>Rooms  </strong></h5>
        <p class="card-text">Available: {{$available}}</p>
        <p class="card-text">Booked: {{$booked}}</p>
        <a href="{{ route('room.index')}}" class="btn btn-primary">View Details</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 mt-2">
  <div class="card">
      <div class="card-body">
        <img src="/icons/hall.png" alt="hall" srcset="" width="20%" >
        <h5 class="card-title">Halls</h5>
        <p class="card-text">Available: {{ $hallCount }}</p>
        <p class="card-text">Capacity: {{ $capacity}}</p>
        <a href="{{ route('hall.index')}}" class="btn btn-primary">View Details</a>
      </div>
    </div>
  </div>
</div> 

</x-app-layout>

</x-adminlayout>