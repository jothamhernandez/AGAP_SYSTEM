@extends('layouts.mail')

@section('content')

    <div class="container" style="max-width: 500px; margin:auto; background-color: white; padding: 15px; box-shadow: 0px 0px 5px gray; border-radius: 5px;">
        <div class="row">
            <div class="col-md-12" style="font-family:Arial, Helvetica, sans-serif;">
                <h3>Hi @if($content->user->info->gender == "male") Mr. @else Ms. @endif {{$content->user->info->fullname()}},</h3>
                <p style="line-height: 1.2em;">Your payment for the upcoming event "{{$content->event->title}}" with the amount of Php @convert($content->fee->fee) has been accepted and we recognize you as a paid member.</p>
                <p>Thank you for your unwavering support.<br><br> AGAP System</p>

                <hr>
                <p style="font-size: .9em; ">Do not reply on this email for this e-mail is system generated.<br> For inquiry and clarification, kindly contact <a href="mailto:dapostol@dbm.gov.ph" style="font-weight: bold; text-decoration: none; color:#005eff;">Ms. Diana O. Apostol</a>,<a href="mailto:lsalas@dbm.gov.ph" style="font-weight: bold; text-decoration: none; color:#005eff;">Ms. Lani V. Salas</a> or <a href="mailto:lsalud@dbm.gov.ph" style="font-weight: bold; text-decoration: none; color:#005eff;">Ms. Laurice D. Salud</a> at 735-19-87 or 657-3300 local 2647</p>
            </div>
        </div>
    </div>
@endsection