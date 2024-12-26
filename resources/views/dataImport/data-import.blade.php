@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Import data')
@section('content_header_title', 'Import data')
@section('content_header_subtitle', 'Import data from external sources')

{{-- Content body: main page content --}}

@section('content_body')
    <form action="{{route('import.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <!-- select -->
            <div class="form-group">
                <label>Select</label>
                <select name="file_type" class="form-control">
                    <option value="">Select</option>
                    @foreach($types as $type)
                        <option value="{{$type}}">{{$type}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName">Import</label>
                <input type="file" name="data" class="form-control" >
            </div>

            <div class="results" style="color: grey"></div>
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
<script>
    $(document).on('change', 'select', function() {
        $.get('/get-data/', {
            _token: "{{ csrf_token() }}",
            type: $(this).val()
        }, function(data) {
            let dataString = '';
            $.each(data, function(key, value) {
                dataString += value.label + ', ';
            });

            $('.results').html('Required headers: '+dataString.replace(/, $/, ''));
        });
    });
</script>
@endpush
