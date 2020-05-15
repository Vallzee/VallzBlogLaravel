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
                    <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
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

                    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store'])!!}
                        {{--NAME--}}
                        <div class="form-group">{{--text input field--}}
                            {!! Form::label('name','Name:') !!}
                            {!! Form::text('name',null,['class'=>'form-control col-sm-8']) !!}
                            {{csrf_field()}}
                        </div>

                    {{--EMAIL--}}
                        <div class="form-group">{{--text input field--}}
                            {!! Form::label('email','Email:') !!}
                            {!! Form::text('email',null,['class'=>'form-control col-sm-8']) !!}
                            {{csrf_field()}}
                        </div>

                    {{--Role--}}
                    <div class="form-group ">{{--dropdown--}}
                        {!! Form::label('role_id','Role:') !!} &nbsp;
                        {!! Form::select('role_id',$roles,3,['class'=>'form-control col-sm-8']) !!}
                        {{csrf_field()}}
                    </div>

                    {{--STATUS--}}
                        <div class="form-group ">{{--dropdown--}}
                            {!! Form::label('Active_status_id','Status:') !!} &nbsp;
                            {!! Form::select('active_status_id',array(1=>'active',2=>'not active',3=>'suspended'),2,['class'=>'form-control col-sm-8']) !!}
                            {{csrf_field()}}
                        </div>

                        <div class="form-group">{{--submit button--}}
                            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                    {{--<div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>--}}
                </div>
            </div>
        </div>

    @stop

</div>
