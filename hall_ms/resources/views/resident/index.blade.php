<x-stafflayout>
@if ($errors->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $errors->first('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0" >
    <div class="card" >
      <div class="card-body bg-primary text-center">
      <a href="" class="btn btn-primary">
      <img src="/icons/bedA.png" alt="" width="50px">
        <h5 class="card-title">Approved Booking</h5>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
    <div class="card-body bg-primary text-center">
      <a href="{{ route('resident.create')}}" class="btn btn-primary">
      <img src="/icons/reg.png" alt="" width="50px">
        <h5 class="card-title">Register </h5>
        </a>
      </div>
    </div>
  </div>
</div>

</x-stafflayout>