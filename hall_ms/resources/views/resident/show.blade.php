<x-stafflayout>

<div class="container mt-5">
<div class="mb-3">
        <a href="{{ route('resident.index')}}" class="btn btn-secondary btn-sm">
            &larr; Back
        </a>
    </div>
    <h1 class="text-center">Student Details</h1>
    <div class="card border-primary">
        <div class="card-body">
            <!-- Resident Image -->
            <div class="text-center mb-3">
                <img src="{{ asset('storage/' . $resident->image) }}" class="img-fluid rounded-circle border" alt="Resident Image" style="width: 150px;">
            </div>

            <!-- Resident Name -->
            <h2 class="text-center">{{ $resident->user->name }}</h2>
            <h3 class="text-center">{{ $resident->user->index_number }}</h3>
            <div class="row">
                <div class="col">
            <h5 class="text-center">{{ $resident->user->department }}</h5>
            <p class="text-center"><strong>Level:</strong> {{ $resident->user->level }}</p>
            <p class="text-center"><strong>Gender:</strong> {{ $resident->booking->gender }}</p>
            </div>
            <div class="col">
            <p class="text-center"><strong>Age:</strong> {{ $resident->booking->age }}</p>
            <p class="text-center"><strong>Telephone:</strong> {{ $resident->booking->telephone }}</p>
            <p class="text-center"><strong>Email:</strong> {{ $resident->user->email }}</p>
            </div>    
        </div>
            <hr>

            <!-- Hall and Room Details Section -->
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-primary">Hall Details</h4>
                    <p><strong>Hall Name:</strong> {{ $resident->booking->hall->name }}</p>
                    <p><strong>Block:</strong> {{ $resident->booking->hall->block }}</p>
                    <p><strong>Location:</strong> {{ $resident->booking->hall->location }}</p>    
                </div>

                <!-- GRoom Details Details Section -->
                <div class="col-md-6">
                    <h4 class="text-primary">Room  Details</h4>
                    <p><strong>Room Number:</strong> {{ $resident->booking->room->number }}</p>
                    <p><strong>Room Type:</strong> {{ $resident->booking->room->type }} in 1</p>
                    <p><strong>Room Price:</strong> {{ $resident->booking->room->price }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                  <!-- Guardian Details Section -->
                  <div class="col-md-6">
                    <h4 class="text-primary">Guardian Details</h4>
                    <p><strong>Guardian Name:</strong> {{ $resident->guardian_name }}</p>
                    <p><strong>Guardian Telephone:</strong> {{ $resident->guardian_phone }}</p>
                    <p><strong>Guardian Address:</strong> {{ $resident->guardian_address }}</p>
                    <p><strong>Guardian Occupation:</strong> {{ $resident->occupation }}</p>
                </div>

                <div class="col-md-6">
                    <h4 class="text-primary">Status</h4>
                    <p><strong>Booking Start Date:</strong> {{ $resident->booking->started_at }}</p>
                    <p><strong>Booking End Date:</strong> {{ $resident->booking->ending_at }}</p>
                    <p><strong>Payment Date:</strong> {{ $resident->payment->created_at }}</p>
                    <p><strong>Room Type:</strong> {{ $resident->payment->status }}</p>
                </div>

              
            </div>
        </div>
    </div>
</div>
</x-stafflayout>