@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (Auth::user()->email_verified_at == null)
            <div class="card">
                <div class="card-header bg-danger text-white">Verification Needed</div>
                <div class="card-body">
                    You need to verify your email first before you can do anything
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
