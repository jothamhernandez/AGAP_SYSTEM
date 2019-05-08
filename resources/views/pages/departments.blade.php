@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Departments</h1>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-fluid">
                    <thead>
                        <tr>
                            <th>Department ID</th>
                            <th>Department Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{$department->id}}</td>
                            <td>{{$department->display_name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection