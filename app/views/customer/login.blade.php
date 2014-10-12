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
                <h2 class="text-center">Account Login</h2>

                    <div class="form-white">
                        @include('layouts.partials.message')

                        {{ Form::open(array('url' => 'customer/login', 'id' => 'login-form')) }}

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', null, array('class' => 'form-control', 'required', 'placeholder' => 'Enter Email')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::input('password','password', null, array('class' => 'form-control required', 'placeholder' => 'Enter Password')) }}
                        </div>

                        <div class="form-group">
                            <a href="{{ url('password/remind') }}">{{trans('Forgotten Password')}}</a>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{trans('login')}}">
                        </div>

                        {{ Form::close(); }}
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
        $('#login-form').bootstrapValidator({
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
                        notEmpty: {
                            message: 'Password is required and cannot be empty'
                        }
                    }
                }
            }
        });
    });
</script>
@stop
@stop