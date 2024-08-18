<x-adminlayout>
@if ($errors->has('type'))
    <div class="alert alert-danger">
        {{ $errors->first('type') }}
    </div>
@endif
<div class="">
    <h3>Add Room</h3>
    <p></p>
  </div>
  <div class="m-3">
    <form action="{{ route('room.store')}}" method="POST" class="room">
      @csrf
<div class="row ">
  <div class="col">
    <input name="number" type="number" class="form-control" placeholder="Room Number" aria-label="number" min="0" required>
  </div>
  <div class="col">
  <select name="gender" class="form-control" aria-label="Gender">
    <option value="" disabled selected>Select Gender</option>
    <option value="Female">Female</option>
    <option value="Male">Male</option>
    <!-- Add more options as needed -->
  </select>
</div>
</div>
<div class="row mt-3">
  <div class="col">
  <select name="type" class="form-control" aria-label="type">
    <option value="" disabled selected>Select Type</option>
    <option value="4">4-in-1</option>
    <option value="3">3-in-1</option>
    <option value="2">2-in-1</option>
    <option value="1">1-in-1</option>
    <!-- Add more options as needed -->
  </select>
</div>
  <div class="col">
    <input name="price" type="number" class="form-control" placeholder="Price" aria-label="Price" min="0" required>
  </div>
  <div class="col">
  <select name="hall_id" class="form-control" aria-label="hall">
    <option value="" disabled selected>Select Hall</option>
    @foreach($hall as $hall)
    <option value="{{$hall->id}}">{{$hall->name}} 
      {{$hall->block}}
    ({{$hall->capacity-$hall->room->count()}}
    / {{$hall->capacity}})
    </option>
    <!-- Add more options as needed -->
    @endforeach
  </select>
  @error('hall_id')
    <div class="text-danger mt-1">
  <strong>{{$message}}</strong>
    </div>
    @enderror
  </div>
</div>
<div class="row mt-3">
  <div class="col">
  <button class="room-submit-button btn btn-primary">Submit</button>
  </div>
  
</div>
</form>
</div>
<!--Part to display the Halls -->
<div class="row">

<div class="table-responsive">
  <table id="myTable" class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Room Number</th>
        <th>Gender</th>
        <th>Price</th>
        <th>Type</th>
        <th>Hall</th>
        <th>Block</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($room as $room)
        <tr>
          <td>{{ $room->number }}</td>
          <td>{{ $room->gender }}</td>
          <td>{{ $room->price }}</td>
          <td>{{ $room->type }} IN 1</td>
          <td>{{ $room->hall->name }}</td>
          <td>{{ $room->hall->block }}</td>
          <td>{{ $room->status }}</td>
          <td>
            <a href="{{ route('room.edit', $room) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="#" class="btn btn-primary btn-sm">Show</a>
            <form action="{{ route('room.destroy', $room)}}" method="POST" style="display:inline;">
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
  <div>
    
  </div>

</x-adminlayout>