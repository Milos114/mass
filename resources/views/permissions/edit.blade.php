@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Permission edit')
@section('content_header_title', 'Permission edit')
@section('content_header_subtitle', 'Edit a new permission')

{{-- Content body: main page content --}}

@section('content_body')
    <form action="{{route('permissions.update', $permission->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" value="{{$permission->name}}" class="form-control" id="exampleInputName" placeholder="Enter name">
            </div>
        </div>
        <div class="card-body">
            <label >Users</label>
            <select class="js-example-basic-multiple form-control" name="users[]" multiple="multiple">
                @foreach($users as $user)
                    <option value="{{$user->id}}" @if($permission->users->contains($user->id)) selected @endif>
                        {{$user->email}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@stop

{{-- Push extra CSS --}}

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
