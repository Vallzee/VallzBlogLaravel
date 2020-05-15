@extends('admin/index')

@section('heading')
    Users
    @stop
<div class="row">

    @section('content')

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-lg-5">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-responsive">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Role</th>
                          <th scope="col">Created</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if($users)
                          @foreach($users as $user)
                        <tr>
                          <th scope="row">{{$user->id}}</th>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->role->name}}</td>
                          <td>{{$user->created_at->diffForHumans()}}</td>
                          <td>{{$user->activeStatus->name}}</td>
                        </tr>
                            @endforeach
                          @endif
                      </tbody>
                    </table>
                    {{--<div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>--}}
                </div>
            </div>
        </div>

    @stop

</div>
