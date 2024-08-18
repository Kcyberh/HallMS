<x-adminlayout>
    
<H1>List of Users</H1>

<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0" >
    <div class="card" >
      <div class="card-body bg-primary text-center">
      <a href="{{route('admin.registerUser' )}}" class="btn btn-primary">
      <img src="/icons/person_added.png" alt="addUser" width="50px">
        <h5 class="card-title">Add New User</h5>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
    <div class="card-body bg-primary text-center">
      <a href="{{route('admin.upload' )}}" class="btn btn-primary">
      <img src="/icons/upload_file.png" alt="upload" width="50px">
        <h5 class="card-title">Upload Users</h5>
        </a>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="table-responsive">
  <table id="myTable" class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Index Number</th>
        <th>Name</th>
        <th>Email</th>
        <!-- <th>Password</th> -->
        <th>Role</th>
        <th>Departmet</th>
        <th>Level</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->index_number }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <!-- <td>{{ $user->password }}</td> -->
          <td>{{ $user->usertype}}</td>
          <td>{{ $user->department }}</td>
          <td>{{ $user->level }}</td>
          <td>
            <a href="" class="btn btn-primary btn-sm">Edit</a>
            <a href="#" class="btn btn-primary btn-sm">Show</a>
            <form action="{{ route('registerUser.destroy', $user->id)}}" method="POST" style="display:inline;">
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

 
</x-adminlayout>
