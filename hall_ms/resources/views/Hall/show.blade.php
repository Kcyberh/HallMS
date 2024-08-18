<x-adminlayout>
<div>
  <h1>{{$hall->name}}</h1>
  <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded text-center">
                <p><strong>{{ $hall->block }}</strong></p>
                <p><strong>{{ $hall->location }}</strong></p>
                <p><strong> Capacity : <p><strong>{{ $hall->capacity }}</strong></p>
           {{ $bookedRoomsCount }} Rooms / {{ $hall->capacity }} 
    - {{ $hall->capacity - $bookedRoomsCount }} available
</strong></p>
                </div>
             

                <h2>Rooms</h2>
                <p>Blue indicator : Available</p>
                <P>Red Indicatoe: Booked</P>
    @if ($room->isEmpty())
        <p>No rooms available for this hall.</p>
    @else
    <div class="container">
    <div class="row">
            @foreach ($room as $room)    
                <div class="col-md-4 mb-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Room Number: {{$room->number}}</h5>
                    <h6 class="card-title">Room Price: {{$room->price}}</h6>
                    <p class="card-text">Room Type: {{ $room->type }} in 1</p>
                    <p class="card-text">Gender: {{ $room->gender }}</p>
                    <p class="card-text"><strong>Status: {{$room->status}}</strong>
                    <span class="status-indicator" data-status="{{$room->status}}"></span>
                </p>
                    
                    <a href="#" class="btn btn-primary">View</a>
                </div>
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusIndicators = document.querySelectorAll('.status-indicator');

        statusIndicators.forEach(function(indicator) {
            const status = indicator.getAttribute('data-status').toLowerCase();

            if (status === 'available') {
                indicator.style.backgroundColor = 'blue';
            } else if (status === 'booked') {
                indicator.style.backgroundColor = 'red';
            }
        });
    });



    
</script>
</div>


</x-adminlayout>