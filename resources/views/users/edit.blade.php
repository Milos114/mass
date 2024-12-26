@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'User edit')
@section('content_header_title', 'User edit')
@section('content_header_subtitle', 'Edit user')

{{-- Content body: main page content --}}

@section('content_body')
    <form action="{{route('users.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" id="exampleInputName" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" value="{{$user->password}}" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Confirm password</label>
                <input type="password" name="password_confirmation" value="{{$user->password}}" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush
