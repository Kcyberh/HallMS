<x-adminlayout>
  
  <div class="m-3">
    <form action="{{ route('hall.update', $hall)}}" method="POST" class="hall">
        @csrf
        @method('PUT')
<div class="row ">
  <div class="col">
    <input name="name" type="text" class="form-control" placeholder="" value="{{ $hall->name}}" aria-label="Name of Hall" disabled>
    
  </div>
  <div class="col">
    <input name="block" type="text" class="form-control" value="{{ $hall->block}} " aria-label="Block">
   
</div>
</div>
<div class="row mt-3">
  <div class="col">
    <input name="location" type="text" class="form-control" value="{{ $hall->location}}" aria-label="Location">
      
</div>
  <div class="col">
    <input name="capacity" type="text" class="form-control" value="{{ $hall->capacity}}" aria-label="Capacity">
      
</div>
</div>
<div class="row mt-3">
  <div class="col">
  <button class="hall-submit-button btn btn-primary">Update</button>
  </div>
  <div class="col">
  <a herf="{{ route('hall.index')}}" class="btn btn-danger">Cancel </a>
  </div>
</div>
</form>
</div>
</x-adminlayout>
