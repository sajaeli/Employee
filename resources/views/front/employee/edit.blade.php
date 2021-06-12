@extends('layouts.app')

@section('content')
    <h1><a href="{{ url('employes') }}">@lang('Employee')</a></h1>
    <h1>
        {{ $employee->name }}
    </h1>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <form action="{{ url('employes/'.$employee->id) }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" name="name" placeholder="Enter name"
                               value="{{ old('name') ? old('name') : $employee->name }}">
                    </div>
                    <div class="col-md-6">
                        <select name="company_id" class="form-control" required>
                            <option value="">@lang('-please choose-')</option>
                            @foreach($companies as $company)
                                <option
                                    value="{{ $company->id }}" {{ $company->id == $employee->company_id?'selected':'' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
            <hr>
        </tr>
@endsection
