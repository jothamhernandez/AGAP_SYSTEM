@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Agencies</h1>
        </div>
        <div class="col-md-12">
            <form action="{{route('agency.import')}}" method="POST" enctype="multipart/form-data">
                @csrf()
                <input type="file" name="agency-csv" id="">
                <button>Submit</button>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-fluid">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Department</th>
                        <th>Agency</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agencies as $agency)
                    <tr>
                        <td>{{$agency->id}}</td>
                        <td>{{$agency->department->display_name}}</td>
                        <td>{{$agency->name}}</td>
                        <td>{{$agency->bsgc_status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection