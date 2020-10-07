@extends('layouts.app')

@section('content')


<div class="container">
    @if(session('message'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-{{session('class')}}" role="alert">
                {{session('message')}}
            </div>
        </div>
    </div>
    @endif
    <div class="row mb-5">
        <div class="col-md-12">
            <a href="{{route('page.events')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header agap-primary-color">Event Info</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{route('image.viewer',["event",encrypt($event->id)])}}" alt="" class="img img-fluid">
                </div>
                <div class="col-md-12 my-3">
                    <h3>{{$event->title}}</h3>
                    <p style="white-space:pre-line; word-wrap:break-word;">{{$event->description}}</p>

                    @if(Auth::user()->roles->contains('role','Admin') || Auth::user()->roles->contains('role','Super Admin'))
                    <a class="btn btn-primary" href="{{route('event.materials', encrypt($event->id))}}">Event Materials</a>
                    @endif
                    
                </div>
                @if($event->end < Carbon\Carbon::now())
                <div class="col-md-12">
                    
                    <h3>Event is Closed already</h3>
                </div>
                @elseif(!$registered)
                <div class="col-md-12">
                    <h3>Register</h3>

                    @foreach($fees as $fee)
                    <p>{{$fee->description}} - {{$fee->fee}} <a href="{{route('event.register', ['id'=>$event->id, 'fee'=>$fee->id])}}" class="btn btn-success">Register</a></p>
                    @endforeach
                </div>
                @else
                <div class="col-md-12">
                    <h3>Registered ({{$registered->status}})</h3>
                    <p>{{$registered->fee->description}} {{$registered->fee->fee}}</p>
                </div>
            </div>
           
        </div>
        @if(($registered->status == "Unpaid" || $registered->status == "Rejected") && $registered->supporting_doc == null)
        <form action="{{route('event.pay', ['id'=>$registered->event_id,'fee'=>$registered->fee_id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>Payments</h3>
                    <p>For payments, kindly deposit the amount of {{$registered->fee->fee}} to our <strong>Landbank</strong> account <br>
                        <br>
                        <strong>Account Name: </strong> AGAP INC. <br>
                        <strong>Branch: </strong> España Branch <br>
                        <strong>Account Number: </strong> 003722-1001-30
                    </p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="submit-docs" name="supporting_docs">
                        <label class="custom-file-label" for="submit-docs">Upload Deposit Slip</label>
                    </div>
                    <span class="small" style="color:red;">Please upload the image of your deposit slip for us to verify your payment</span>
                    <button href="" class="btn btn-primary btn-block mt-3 disabled" id="submit-button">
                        Upload
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <img src="" alt="" id="docs-preview" class="img img-fluid">
                    </div>
                </div>
            </div>
        </form>
        @else
        <div class="row">
            <div class="col-md-12">
            <h3>Payment Proof</h3>
            </div>
            <div class="col-md-8 offset-md-2">
                @if(strtolower(explode('.',$registered->supporting_doc)[1]) == "pdf")
                <iframe src="{{route('image.viewer',['slip',encrypt($registered->id)])}}" frameborder="0" width="100%" height="500"></iframe>
                @else
                <img src="{{route('image.viewer',['slip',encrypt($registered->id)])}}" alt="" class="img img-fluid">
                @endif
            </div>
        </div>
        @endif
        @endif
        <div class="row mt-5 text-right">
            <div class="col-md-12">
                <h3>Inquiries</h3>
            </div>
            <div class="col-md-12">
                For Inquiries, kindly contact <strong>Ms. Lani Salas</strong><br>
                <strong>(Smart): </strong> 0920-9776895 <br>
                <strong>(Globe): </strong> 0977-1817500 <br>
                <strong>Email: </strong> lsalas@dbm.gov.ph <br>
            </div>
        </div>
    </div>
</div>



</div>
@endsection

@section('scripts')

<script>
    window.onload = function() {
        var docs = $('#submit-docs');
        docs.on('change', function(e) {
            $('#docs-preview').attr('src', URL.createObjectURL(this.files[0]));
            $('[for=submit-docs]').text(this.files[0].name);
            $('#submit-button').removeClass('disabled');
        });
    }
</script>

@endsection