<x-adminlayout>
<div class="">
    <h3>Add Room</h3>
    <p></p>
  </div>
  <div class="m-3">
    <form action="{{ route('room.update', $room)}}" method="POST" class="room">
      @csrf
      @method('PUT')
<div class="row ">
  <div class="col">
    <input name="number" type="number" class="form-control" value="{{$room->number}}" aria-label="Number" min="0" required>
  </div>
  <div class="col">
  <select name="gender" class="form-control" aria-label="Gender">
    <option value="{{$room->gender}}"  selected>{{$room->gender}}</option>
    <option value="Female">Female</option>
    <option value="Male">Male</option>
    <!-- Add more options as needed -->
  </select>
</div>
</div>
<div class="row mt-3">
  <div class="col">
  <select name="type" class="form-control" aria-label="type">
    <option value="{{$room->type}}"  selected>{{$room->type}} IN 1</option>
    <option value="4">4-in-1</option>
    <option value="3">3-in-1</option>
    <option value="2">2-in-1</option>
    <option value="1">1-in-1</option>
    <!-- Add more options as needed -->
  </select>
</div>
  <div class="col">
    <input name="price" type="number" class="form-control" value="{{$room->price}}" aria-label="price" min="0" required>
  </div>
  <div class="col">
  <select name="hall_id" class="form-control" aria-label="hall">
    <option value="{{$room->hall_id}}"  selected>{{$room->hall->name}} {{$room->hall->block}}</option>
    @foreach($hall as $hall)
    <option value="{{$hall->id}}">{{$hall->name}} {{$hall->block}}
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
  <button class="hall-submit-button btn btn-primary">Submit</button>
  </div>
  <div class="col">
  <a herf="{{ route('room.index')}}" class="btn btn-danger">Cancel </a>
  </div>
  
</div>
</form>
</div>

</x-adminlayout>