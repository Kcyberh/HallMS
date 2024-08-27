<x-stafflayout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->has('error'))
   <script>
      Swal.fire({
            title: "Error!",
            text: "{{ $errors->first('error') }}",
            icon: "warning",
            confirmButtonText: "OK"
    })
   </script>
@endif
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
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0" >
    <div class="card" >
      <div class="card-body bg-primary text-center">
      <a href="{{ route('resident.create')}}" class="btn btn-primary">
      <img src="/icons/reg.png" alt="" width="50px">
        <h5 class="card-title">Register </h5>
        </a>
      </div>
    </div>
  </div>
  <!-- <div class="col-sm-6">
    <div class="card">
    <div class="card-body bg-primary text-center">
        <a href="" class="btn btn-primary">
      <img src="/icons/upload_file.png" alt="" width="50px">
        <h5 class="card-title">Approved Booking</h5>
        </a>
      </div>
    </div>
  </div> -->
</div>

<div class="text-center">
<h3>List of Resident</h3>
</div>
        
                   @if ($resident->isEmpty())
        <p>No resident found.</p>
    @else
    <div class="table-responsive">
        <table id="myTable" class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Department</th>
                    <th>Hall Name</th>
                    <th>Room Number</th>
                    <th>Male</th>
                    <th>Guardian Name</th>
                    <th>Guardian Address</th>
                    
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($resident as $resident)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $resident->user->name }}</td>
                        <td>{{ $resident->user->department }}</td>
                        <td>{{ $resident->booking->hall->name }}</td>
                        <td>{{ $resident->booking->room->number }}</td>
                        <td>{{ $resident->booking->gender }}</td>
                        <td>{{ $resident->guardian_name }}</td>
                        <td>{{ $resident->guardian_address}}</td>
                        <!-- <td><img src="{{ asset('storage/' . $resident->image) }}" class="img-fluid m-1" alt="payment reciept" style="width: 70px;" >
                      </td> -->
                        <td>
                        <a href="{{route('resident.show', $resident)}}" class="btn btn-primary btn-sm">Show</a>
                      
                        <a href="{{ route('resident.edit', $resident) }}" class="btn btn-primary btn-sm">Edit</a>
                     
                        <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" style="display:inline;">
                         @csrf 
                         @method('DELETE')
                        <button class="btn btn-danger btn-sm mt-1">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @endif

</x-stafflayout>