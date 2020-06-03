@extends('admin.theme.adminTheme')

@section('heading')
    Edit User
@stop
<div class="row">

    @section('content')

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-lg-5">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
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
                <div class="card-body justify-content-center row">
                    <div class="col-7">
                        {!! Form::model($user,['method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id],'files'=>true])!!}
                        {{--NAME--}}
                        <div class="form-group justify-content-center">{{--text input field--}}
                            {!! Form::label('name','Name:') !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                            {{csrf_field()}}
                        </div>

                        {{--EMAIL--}}
                        <div class="form-group">{{--text input field--}}
                            {!! Form::label('email','Email:') !!}
                            {!! Form::email('email',null,['class'=>'form-control']) !!}
                            {{csrf_field()}}
                        </div>

                        {{--Role--}}
                        <div class="form-group ">{{--dropdown--}}
                            {!! Form::label('role_id','Role:') !!} &nbsp;
                            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
                            {{csrf_field()}}
                        </div>


                        {{--STATUS--}}
                        <div class="form-group ">{{--dropdown--}}
                            {!! Form::label('active_status_id','Status:') !!} &nbsp;
                            {!! Form::select('active_status_id',array(1=>'active',2=>'not active',3=>'suspended'),null,['class'=>'form-control']) !!}
                            {{csrf_field()}}
                        </div>


                        {{--PASSWORDFIELD--}}
                        <div class="form-group">{{--text input field--}}
                            {!! Form::label('password','Password:') !!}
                            {!! Form::password('password',['class'=>'form-control']) !!}
                            {{csrf_field()}}
                        </div>

                        {{--FILE UPLOAD--}}
                        <div class="form-group">{{--text input field--}}
                            {!! Form::label('photo_id','Upload photo:') !!}
                            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                            {{csrf_field()}}
                        </div>

                        <div class="form-group">{{--submit button--}}
                            {!! Form::submit('Update User',['class'=>'btn btn-success']) !!}
                        </div>

                        {!! Form::close() !!}

                        {{--delete button--}}
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id]])!!}

                            <div class="form-group">{{--delete button--}}
                                {!! Form::submit('Delete User',['class'=>'btn btn-danger','onclick'=>'return confirm("Are u sure you want to delete?")']) !!}
                            </div>

                        {!! Form::close() !!}


                    </div>
                    <div class="col-sm-5">
                        <div class=" text-center row card-body  ">
                            <img height="200" width="200" src="{{asset($user->photo ? $user->photo->file:'https://placehold.it/400x400')}}" class="rounded-circle img-thumbnail p-0 mx-auto">
                        </div>
                        <div class="row">
                            <div class="mx-auto">
                                @include('includes.form_errors')
                            </div>
                        </div>
                    </div>

                    {{--<div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>--}}
                </div>
            </div>
        </div>

    @stop

</div>
