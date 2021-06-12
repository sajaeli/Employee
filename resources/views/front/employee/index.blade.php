@extends('layouts.app')

@section('content')
    <hr>
    <h1>
        <a href="{{ url('companies') }}"> @lang('Companies')</a> --
        <a href="{{ url('employes') }}"> @lang('Employee')</a>
    </h1>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <form action="{{ url('employes') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="col-md-6">
                        <select name="company_id" class="form-control" required>
                            <option value="">@lang('-please choose-')</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
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
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('name')</th>
            <th scope="col">@lang('company')</th>
            <th scope="col">@lang('Action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td><a href="{{ url('employes?company='.$item->company->id) }}"> {{ $item->company? $item->company->name:'' }}</a></td>
                <td>
                    <a href="{{ url('employes/'.$item->id.'/edit') }}" class="btn btn-info pull-left"
                       style="float: left">@lang('Edit')</a>
                    <form action="{{ url('employes/'.$item->id) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger pull-right">@lang('delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $employees->links() }}
    </div>
@endsection
