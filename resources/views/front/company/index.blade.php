@extends('layouts.app')

@section('content')
    <hr>
    <h1>
        @lang('Companies')
    </h1>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <form action="{{ url('companies') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" name="name" placeholder="Enter name">
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description" placeholder="Enter name"></textarea>
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
            <th scope="col">name</th>
            <th scope="col">description</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <th scope="row">{{ $company->id }}</th>
                <td><a href="{{ url('employes?company='.$company->id) }}"> {{ $company->name }}</a></td>
                <td>{{ $company->description }}</td>
                <td>
                    <a href="{{ url('companies/'.$company->id.'/edit') }}" class="btn btn-info pull-left"
                       style="float: left">@lang('Edit')</a>
                    <form action="{{ url('companies/'.$company->id) }}" method="post">
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
        {{ $companies->links() }}
    </div>
@endsection
