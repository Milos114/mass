@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Permission creation')
@section('content_header_title', 'Permission creation')
@section('content_header_subtitle', 'Create a new permission')

{{-- Content body: main page content --}}

@section('content_body')
    <form action="{{route('permissions.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name">
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
