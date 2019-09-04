<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event Validation</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        #detail {
            display:none;
        }
        .show {
            display:block !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">
                    {{$event->title}} <br>
                    Attendee Validator
                </h1>
            </div>
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Enter Event Code
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="eg. ff231" id="code">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block" id="submitBtn">Submit</button>
                            </div>
                            <div class="form-group text-center" id="status">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-3 mt-4 hidden" id="detail">
                <div class="card">
                    <div class="card-header">
                        Attendee Details
                    </div>
                    <div class="card-body">
                        <dl class="dl-vertical">
                            <dt>Firstname</dt>
                            <dd id="attendee_firstname">Juan</dd>
                            <dt>Lastname</dt>
                            <dd id="attendee_lastname">Dela Cruz</dd>
                            <dt>Gender</dt>
                            <dd id="attendee_gender">Male</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(e){
            
            $('#submitBtn').click(function(){
                let code = $('#code').val();

                if(code.length == 0){
                    $('#status').html("please enter a code");
                }
                $(this).attr('disabled', true);
                axios(window.location + `/${code}`).then(e => {
                    $('#code').val('');
                    $('#status').html(e.data.message);
                    if(e.data.user){
                        $("#detail").toggleClass('show');
                        $("#attendee_firstname").html(e.data.user.first_name);
                        $("#attendee_lastname").html(e.data.user.last_name);
                        $("#attendee_gender").html(e.data.user.gender);
                    }
                    setTimeout(function(){
                        $('#status').html('');
                        $('#submitBtn').removeAttr('disabled');
                        if($('#detail').hasClass('show')){
                            $("#detail").toggleClass('show');
                        }
                        $("#attendee_firstname").html('');
                        $("#attendee_lastname").html('');
                        $("#attendee_gender").html('');
                    }, 3000)
                });
            });
            
        });
    </script>
</body>
</html>