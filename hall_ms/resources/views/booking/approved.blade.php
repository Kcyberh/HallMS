<x-adminlayout>
<div class="text-center">
<h3>List of Approved Bookings</h3>
</div>
        
                   @if ($payment->isEmpty())
        <p><strong>No Approved bookings found.</strong></p>
    @else
    <div class="table-responsive">
        <table id="myTable" class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Room Number</th>
                    <th>Hall Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Telephone</th>
                    <th>Starting At</th>
                    <th>Ending At</th>
                    
                    
                    
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->booking->room->number }}</td>
                        <td>{{ $payment->booking->hall->name }}</td>
                        <td>{{ $payment->booking->gender }}</td>
                        <td>{{ $payment->booking->age }}</td>
                        <td>{{ $payment->booking->telephone }}</td>
                        <td>{{ $payment->booking->started_at }}</td>
                        <td>{{ $payment->booking->ending_at }}</td>
                        
                        
                        
                        <td>{{ $payment->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @endif
</x-adminlayout>