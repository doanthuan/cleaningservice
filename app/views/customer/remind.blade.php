@extends('layouts.public')

@section('head')
@parent
{{ HTML::style('assets/bootstrap-validator/css/bootstrapValidator.min.css') }}
@stop

@section('content')
<div class="wrapper body-inverse">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center">Password Reminders</h2>
                <div class="form-white">
                    @include('layouts.partials.message')

                    {{ Form::open(array('class' => 'form-reminder', 'url' => 'password/remind', 'id' => 'remind-form'))}}
                        <div class="form-group">
                            {{ Form::label('email', 'Email Address') }}
                            {{ Form::text('email', null, array('class' => 'form-control email', 'required', 'placeholder' => 'Enter Email')) }}
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer')
@parent
{{ HTML::script('assets/bootstrap-validator/js/bootstrapValidator.min.js') }}
<script>
    $(document).ready(function() {
        $('#remind-form').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                }
            }
        });
    });
</script>
@stop
@stop