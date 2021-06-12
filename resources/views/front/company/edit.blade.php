@extends('layouts.app')

@section('content')
    <h1><a href="{{ url('companies') }}">@lang('Employee')</a></h1>
    <h1>
        {{ $company->name }}
    </h1>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <form action="{{ url('companies/'.$company->id) }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" name="name" placeholder="Enter name"
                               value="{{ old('name') ? old('name') : $company->name }}">
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description"
                                  placeholder="Enter description">{{ old('description') ? old('description') : $company->description }}</textarea>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
            <hr>
        </tr>
@endsection
