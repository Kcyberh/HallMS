<x-studentlayout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<h1>Make Complain</h1>
 <!-- Check for success message -->
 @if (session('success'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            title: "Deleted!",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>
@endif


<div class="">
    <h3></h3>
    <p></p>
  </div>
  <div class="m-3">
    <form action="{{ route('complain.store') }}" method="POST" class="hall">
      @csrf
      <div class="row">
            <!-- Name -->
        <div class="col">
            <label for="name" class="">Name</label>
            <input name="user_id" value="{{ $user->id }}" id="name" type="text" class="form-control" aria-label="Name" hidden >
            <input name="" value="{{ $user->name }}" id="name" type="text" class="form-control" aria-label="Name" disabled>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Room Number -->
        <div class="col">
            <label for="Roomnumber" class="">Room Number</label>
            <input name="resident_id" value="{{ $resident_id }}" id="resident_id" type="text" class="form-control" aria-label="Roomnumber" hidden>
            <input  value="{{ $booking->room->number }}" id="room_number" type="text" class="form-control" aria-label="Roomnumber" disabled>
            <x-input-error :messages="$errors->get('Roomnumber')" class="mt-2" />
        </div>
        </div>
        <!-- time_date -->
        <div class="col">
    <label for="time" class="">Time and Date</label>
    <input name="time_date"  id="time" type="datetime-local" class="form-control" aria-label="Roomnumber" max="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
   
    <x-input-error :messages="$errors->get('time')" class="mt-2" />
    </div>
        <!-- Statement -->
        <div class="col">
    <label for="statement" class="">Statement</label>
    <textarea name="statement" id="statement" rows="4" class="form-control" aria-label="Statement"></textarea>
    <x-input-error :messages="$errors->get('statement')" class="mt-2" />
    </div>
        
    <div class="col mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
        </div>
</form>


<!-- Complaints Section -->

@if($complaints->isEmpty())
    <p>You have not made any complaints yet.</p>
@else
<h2>Your Complaints</h2>
<div class="table-responsive">
        <table id="myTable" class="table table-bordered table-hover">
            <thead class="table-dark">
            <tr>
                <th>Time and Date</th>
                <th>Statement</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
                <tr>
                <td>{{ \Carbon\Carbon::parse($complaint->time_date)->format('Y-m-d H:i') }}</td>
                    <td>{{ $complaint->statement }}</td>
                    <td><span class="badge {{ $complaint->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                    {{ ucfirst($complaint->status) }}
                </span></td>
                    <td>
            <a href="" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('complain.show', $complaint) }}" class="btn btn-primary btn-sm">Show</a>
            <form action="" method="POST" style="display:inline;">
              @csrf 
              @method('DELETE')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
</div>
</x-studentlayout>