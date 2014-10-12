@extends('layouts.public')

@section('head')
@parent
{{ HTML::style('css/style.css') }}
@stop

@section('content')

<div class="wrapper"> <!-- wrapper -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Thank you for feedback!</h2>
                <hr>
                <!-- START PRIVACY POLICY CODE -->
                <strong>What information do we collect?</strong> <br />

                We collect information from you when you place an order or fill out a form.  <br /><br />

                When ordering or registering on our site, as appropriate, you may be asked to enter your: name, e-mail address, mailing address, phone number or credit card information. You may, however, visit our site anonymously.


            </div>
        </div>
    </div>
</div> <!-- / wrapper -->

@stop