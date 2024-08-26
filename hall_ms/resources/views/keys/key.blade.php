<x-stafflayout>

<h1>Key Management</h1>
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0" >
    <div class="card" >
      <div class="card-body bg-primary text-center">
      <a href="{{ route('key.create')}}" class="btn btn-primary">
      <img src="/icons/key.png" alt="" width="50px">
        <h5 class="card-title">Key Logs </h5>
        </a>
      </div>
    </div>
  </div>


@if($keys->isEmpty())
    <p>No keys found.</p>
@else
    <div class="table-responsive">
        <table id="keyTable" class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Key Code</th>
                    <th>Room ID</th>
                    
                    <th>Key Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keys as $key)
                    <tr>
                        <td>{{ $key->key_code }}</td>
                        <td>{{ $key->number }}</td>
                        <td>{{ $key->key_number }}</td>
                        <td>
                            <span class="badge {{ $key->status == 'active' ? 'badge-success' : ($key->status == 'returned' ? 'badge-secondary' : 'badge-danger') }}">
                                {{ ucfirst($key->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('key.update', $key->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="active" class="btn btn-success btn-sm">Active</button>
                                <button type="submit" name="status" value="returned" class="btn btn-secondary btn-sm">Return</button>
                                <button type="submit" name="status" value="lost" class="btn btn-danger btn-sm">Lost</button>
                            </form>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
</x-stafflayout> 