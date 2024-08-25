<x-adminlayout>

<div>
    <div class="mb-3">
        <a href="{{ route('hall.index') }}" class="btn btn-secondary btn-sm">
            &larr; Back
        </a>
    </div>
  
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded text-center">
        <h1>{{ $hall->name }}</h1>
        <p><strong>{{ $hall->block }}</strong></p>
        <p><strong>{{ $hall->location }}</strong></p>
        <p><strong>Capacity: {{ $hall->capacity }}</strong></p>
        <p><strong>{{ $bookedRoomsCount }} Rooms / {{ $hall->capacity }} - {{ $hall->capacity - $bookedRoomsCount }} available</strong></p>
    </div>

    <h2 class="text-center">Rooms</h2>
    
    <p><span class="status-indicator" data-status="available"></span> : Available</p>
    <p><span class="status-indicator" data-status="booked"></span> : Booked</p>
    
    @if ($groupedRooms->isEmpty())
        <p>No rooms available for this hall.</p>
    @else
        <div class="container">
            <div class="row">
                @foreach ($groupedRooms as $key => $group)
                    <div class="col-md-12 mb-4">
                        <div class="card colorful-card">
                            <div class=" d-flex card-body">
                                <!-- <h4 class="card-title">Room Number: {{ $key[0] }} | Type: {{ $key[1] }}</h4> -->
                                 
                                @foreach ($group as $room)
                                
                                    <div class=" room-box m-1 ">
                                    <h5 class="card-title">Room Number: {{ $room->number }}</h5>
                                    <p class="card-text"><strong>Status:</strong>
                                        <span class="status-indicator" data-status="{{ $room->status }}"></span></p>
                                        <h5 class="card-title">Room Price: {{ $room->price }}</h5>
                                        <p class="card-text">Gender: {{ $room->gender }}</p>
                                        <p class="card-text">Type: {{ $room->type }}</p>
                                        <p><strong>Key Details:</strong></p>
                                        <ul class="list-group">
                                            @if(isset($keys[$room->id]) && count($keys[$room->id]) > 0)
                                                @foreach($keys[$room->id] as $key)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                       <strong> Key Code:</strong> <span class="badge bg-primary">{{ $key->key_code }}</span>
                                                       <strong> Key Number:</strong> <span class="badge bg-secondary">{{ $key->key_number }}</span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item list-group-item-warning">No key associated</li>
                                            @endif
                                        </ul>
                                        </p>
                                        
                                    </div>
                                
                                @endforeach
                                
                            </div>
                            <a href="{{route('hall.members', $hall)}}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
    @endif

    <style>
        .status-indicator {
            display: inline-block;
            width: 25px;
            height: 15px;
            margin-left: 10px;
            border-radius: 0%; /* Makes the box circular */
            vertical-align: middle; 
        }


.room-box {
    
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 10px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    /* overflow: scroll; */
    font-size: smaller;
}
.room-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.colorful-card {
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
    </style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusIndicators = document.querySelectorAll('.status-indicator');

        statusIndicators.forEach(function(indicator) {
            const status = indicator.getAttribute('data-status').toLowerCase();

            if (status === 'available') {
                indicator.style.backgroundColor = '#28a745';
            } else if (status === 'booked') {
                indicator.style.backgroundColor = '#ffc107';
            }
        });
    });



    
</script>
</div>


</x-adminlayout>