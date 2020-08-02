@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Users</div>

                    <div class="card-body">

                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{implode(",",$user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>
                                        @can('edit-users'){{--only admin can view edit button--}}
                                        <a href="{{route('admin.users.edit', $user->id)}}"><button type="button" class="btn btn-primary">Edit</button></a></td>
{{--                                        <a href="{{route('admin.users.destroy', $user->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>--}}
{{--                                    --}}
                                    @endcan
                                    <td>
                                    @can('delete-users'){{--only admin can view delete button--}}
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\UserController@destroy',$user->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->


                                    <div class="form-group">

                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                    </div>


                                    {!! Form::close() !!}
                                        @endcan
                                    </td>

                                </tr>

                                @endforeach
                                </tbody>
                            </table>

                </div>
            </div>
        </div>
    </div>
@endsection
