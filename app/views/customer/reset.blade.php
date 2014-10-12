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
                <h2 class="text-center">Password Reset</h2>
                <div class="form-white">
                    @include('layouts.partials.message')

                    {{ Form::open(array('class' => 'form-reset', 'url' => 'password/reset', 'id' => 'reset-form')) }}

                    <h3>Password Reset</h3>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', null, array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Password Confirmation') }}
                        {{ Form::password('password_confirmation', array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>

                    <input type="hidden" name="token" value="{{ $token }}">

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
        $('#reset-form').bootstrapValidator({
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
                },
                password: {
                    validators: {
                        identical: {
                            field: 'confirmPassword',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        });
    });
</script>
@stop
@stop