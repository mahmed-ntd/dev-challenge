@extends('base')

@section('content')
    <h1 class="mt-5">Title Information</h1>
    <div class="mt-1"></div>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 input-group">
            <a href="{{ url('/') }}?search={{$search}}">Back To Search</a>
        </div>
    </div>
    <div class="mt-1"></div>
    <div class="row">
        <div class="col-lg-4">
            <img src="{{ $Poster }}">
        </div>
        <div class="col-lg-8">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Title</label>
                <div class="col-sm-10">
                    {!! $Title !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Year</label>
                <div class="col-sm-10">
                    {{ $Year }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Run Time</label>
                <div class="col-sm-10">
                    {{ $Runtime }}
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5"></div>
@endsection
