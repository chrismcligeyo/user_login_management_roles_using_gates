@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Edit User : {{$user->name}}</div>

                    <div class="card-body">

                        {!! Form::model($user,['method'=>'PUT', 'action'=>['Admin\UserController@update',$user->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

                            @foreach($roles as $role)
                        <div class="form-group">

                            {!! Form::checkbox('roles[]', $role->id ,['class'=>'form-control']

)!!}

                            {!! Form::label('title', $role->name) !!}


                        </div>
                            @endforeach



                        <div class="form-group">

                            {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                        </div>


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection
