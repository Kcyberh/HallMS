<x-adminlayout>
@if (session('success'))
    <div class="alert alert-success">
       <strong> {{ session('success') }} </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               
    </div>
@endif
<h1>Pending Booking</h1>
<div>
<h4>List of Pending Bookings with payments made at the bank</h4>
</div>

                   @if ($payment->isEmpty())
        <p><strong>No bookings found.</strong></p>
    @else
    <div class="table-responsive">
        <table id="myTable" class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Hall Name</th>
                    <th>Room Number</th>
                    <th>Payment</th>
                   
                    <th>Upload Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($payment as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->user->name}}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->booking->hall->name }}</td>
                        <td>{{ $payment->booking->room->number }}</td>
                        <td>{{ $payment->status }}</td>
                        
                        <td>{{ $payment->created_at}}</td>
                        
                        

                        <td>
                       
                        
                        <button type="button" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal" 
                        data-bs-target="#bookingModal{{ $payment->id }}" >
                            View
                         </button>
                         <form action="{{ route('approve', $payment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm mt-1">Approve</button>
                        </form>
                        <form action="" method="POST" style="display:inline;">
                         @csrf 
                         @method('DELETE')
                        <button class="btn btn-danger btn-sm mt-1">Delete</button>
                        </form>
                        </td>
                    </tr>
                    
<!-- Modal Structure -->
<!-- Modal Structure -->
 
<div class="modal fade" id="bookingModal{{ $payment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bookingModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="bookingModalLabel{{ $payment->id }}">Payment & Booking Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
           <p> <strong>Payment Date:</strong> {{ $payment->created_at }} <br></p>
           <p> <strong>User Name:</strong> {{ $payment->user->name }} <br></p>
           <p> <strong>Hall Name:</strong> {{ $payment->booking->hall->name }} {{ $payment->booking->hall->block }}<br></p>
           <p> <strong>Room Number:</strong> {{ $payment->booking->room->number }}<br></p>
           <p> <strong>Room Type:</strong> {{ $payment->booking->room->type }} in 1<br></p>
           <p> <strong>Starting Date:</strong> {{ $payment->booking->started_at }} <br></p>
           <p> <strong>Ending Date:</strong> {{ $payment->booking->ending_at }} <br></p>
           <p> <strong>Amount:</strong> ${{ $payment->amount }} <br></p>
            <img src="{{ asset('storage/' . $payment->image) }}" class="img-fluid m-1" alt="payment reciept" >
            <a href="{{ asset('storage/' . $payment->image) }}" download="Payment_{{ $payment->id. $payment->user->name }}.jpg" class="btn btn-success mt-2">Download Image</a>
            <a href="{{ asset('storage/' . $payment->image) }}" target="_blank" class="btn btn-primary mt-2">View Image</a>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
            </tbody>
        </table>
        </div>
   
        @endif
    
<script>

</script>
   
</x-adminlayout>