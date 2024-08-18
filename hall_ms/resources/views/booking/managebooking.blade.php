<x-adminlayout>
    <h1>Manage booking</h1>

    <div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0" >
    <div class="card" >
      <div class="card-body bg-primary text-center">
      <a href="{{ route('booking.approved')}}" class="btn btn-primary">
      <img src="/icons/bedA.png" alt="" width="50px">
        <h5 class="card-title">Approved Booking</h5>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
    <div class="card-body bg-primary text-center">
      <a href="{{ route('booking.pending')}}" class="btn btn-primary">
      <img src="/icons/bedA.png" alt="" width="50px">
        <h5 class="card-title">Pending Booking</h5>
        </a>
      </div>
    </div>
  </div>
</div>

<hr>
<div class="text-center">
<h3>List of Bookings</h3>
</div>
        
                   @if ($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
    <div class="table-responsive">
        <table id="myTable" class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Room Number</th>
                    <th>Hall Name</th>
                    <th>Price</th>
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
                        <td>{{ $booking->hall->name }}</td>
                        <td>{{ $booking->room->price }}</td>
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
        </div>
    @endif
</x-adminlayout>