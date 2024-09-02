
<x-stafflayout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Staff Dashboard') }}
            
        </h2>
    </x-slot>
    <style>
            .card:hover {
                transform: scale(1.05);
                transition: transform 0.3s ease-in-out;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }
        </style>
        
    <div
     class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 <h6 class="fw-bold m-0 font-weight-bold text-primary">USERS</h6>
    </div>
                                    <!-- Content Row -->
                    <div class="row">

                        

                        
                        <!-- STUDENTS Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Number of Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$student}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/account_circle.png" alt="booking" srcset="" width="50%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Registered Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Number of Registered Residents</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$resident}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/account_circle.png" alt="booking" srcset="" width="50%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
     class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 <h6 class="fw-bold m-0 font-weight-bold text-success">HALLS</h6>
    </div>
                                    <!-- Content Row -->
                    <div class="row">

                        

                        <!-- Hall Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Number of Halls</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hallCount}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="/icons/hall.png" alt="hall" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Capacity Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Capacity</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$capacity}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="/icons/hall.png" alt="hall" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                    <div
     class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 <h6 class="fw-bold m-0 font-weight-bold text-primary">ROOMS</h6>
    </div>
                                    <!-- Content Row -->
                    <div class="row">

                        

                        <!-- Available room Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Number of Rooms Available</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$available}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/booking.png" alt="room" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booked Rooms Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Number of Booked Rooms</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$booked}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/booking.png" alt="room" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div
     class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 <h6 class="fw-bold m-0 font-weight-bold text-primary">BOOKINGS</h6>
    </div>
                                    <!-- Content Row -->
                    <div class="row">

                        

                        <!-- HALL MANAGER Card Example -->
                        

                        <!-- HALL ASSISTANT Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Number of Booking</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bookingCount}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/room.png" alt="room" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- STUDENTS Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Number of Approved Booking</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$approved}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/room.png" alt="room" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Registered Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bolder text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Number of Pending Booking</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class=""><img src="icons/room.png" alt="room" srcset="" width="20%" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   

</x-app-layout>

</x-stafflayout>