<x-adminlayout>

    
  <div class="">
    <h3>Add Hall</h3>
    <p></p>
  </div>
  <div class="m-3">
    <form action="{{ route('hall.store')}}" method="POST" class="hall">
      @csrf
<div class="row ">
  <div class="col">
    <input name="name" type="text" class="form-control" placeholder="Name of Hall" aria-label="Name of Hall" required>
  </div>
  <div class="col">
    <input name="block" type="text" class="form-control" placeholder="Block" aria-label="Block">
  </div>
</div>
<div class="row mt-3">
  <div class="col">
    <input name="location" type="text" class="form-control" placeholder="Location" aria-label="Location">
  </div>
  <div class="col">
    <input name="capacity" type="text" class="form-control" placeholder="Capacity" aria-label="Capacity" min="0" required>
  </div>
</div>
<div class="row mt-3">
  <div class="col">
  <button class="hall-submit-button btn btn-primary">Submit</button>
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
                    <th scope="col">Name</th>
                    <th scope="col">Block</th>
                    <th scope="col">Location</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hall as $hall)
                <tr>
                    <td>{{ $hall->name }}</td>
                    <td>{{ $hall->block }}</td>
                    <td>{{ $hall->location }}</td>
                    <td>{{ $hall->capacity }}</td>
                    <td>
                        <a href="{{ route('hall.edit', $hall) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{route('hall.show', $hall)}}" class="btn btn-primary btn-sm">Show</a>
                        <form action="{{ route('hall.destroy', $hall)}}" method="POST" class="d-inline">
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
