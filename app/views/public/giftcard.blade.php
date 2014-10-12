@extends('layouts.public')

@section('head')
@parent

{{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.css') }}
{{ HTML::style('assets/bootstrap-validator/css/bootstrapValidator.min.css') }}
{{ HTML::style('css/style.css') }}
@stop

@section('content')

<div class="wrapper">
<div class="container">
<div class="col-sm-10">
<div class="form-wrapper">
    {{ Form::open(array('method' => 'post', 'url' => '/giftcard', 'class' => 'form-horizontal', 'id' => 'book-form')) }}

    @include('layouts.partials.message')
    <span class="payment-errors"></span>

    <div class="form-group">
        <div class="col-sm-3"><h3>GIFT CARD</h3></div>
        <div class="col-sm-6"><div class="form-step-heading"></div></div>
    </div>

    <div class="form-group">
        {{ Form::label('gift_amount', 'Gift Amount', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('gift_amount', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('to_name', 'To', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('to_name', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('to_email', 'Recipient Email', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('to_email', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('from_name', 'From', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('from_name', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('from_email', 'Your Email', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('from_email', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('message', 'Message', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::textarea('message', null, array('class' => 'form-control', 'required', 'rows' => 3 ))}}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3"><h3>CHECKOUT</h3></div>
        <div class="col-sm-6"><div class="form-step-heading"></div></div>
    </div>


    <div class="form-group">
        {{Form::label('card_number', 'Card Number', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('card_number', null, array('class' => 'form-control required', 'data-stripe' => "number"))}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('card_cvc', 'Card CVC', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('card_cvc', null, array('class' => 'form-control required', 'data-stripe' => "cvc"))}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('expires_on', 'Expires on', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-4">
            {{Form::select('card-expiry-month', array(
            '1' => '01 - January',
            '2' => '02 - February',
            '3' => '03 - March',
            '4' => '04 - April',
            '5' => '05 - May',
            '6' => '06 - Jun',
            '7' => '07 - Jul',
            '8' => '08 - Aug',
            '9' => '09 - Sep',
            '10' => '10 - Oct',
            '11' => '11 - Nov',
            '12' => '12 - Dec',
            ),
            null, array('class' => 'form-control required', 'data-stripe' => "exp-month"))}}
        </div>
        <div class="col-sm-3">
            {{Form::select('card-expiry-year', array(
            '2014' => '2014',
            '2015' => '2015',
            '2016' => '2016',
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020',
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
            '2024' => '2024',
            ),
            null, array('class' => 'form-control required', 'data-stripe' => "exp-year"))}}
        </div>
    </div>

    <br/><br/>
    <div class="form-group">
        <div class="col-sm-9 col-sm-offset-3">
            <input type="submit" class="btn btn-success btn-lg" value="PURCHASE GIFT CARD" id="book-btn">
        </div>
    </div>

    {{Form::close()}}
</div>
</div>
</div>
</div>
@stop


@section('footer')
@parent
{{ HTML::script('assets/bootstrap/js/moment.js') }}
{{ HTML::script('assets/bootstrap/js/bootstrap-datetimepicker.js') }}
{{ HTML::script('assets/bootstrap-validator/js/bootstrapValidator.min.js') }}
{{ HTML::script('https://js.stripe.com/v2/') }}

<script>
    $(document).ready(function() {
        $('#book-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                gift_amount: {
                    message: 'Gift amount is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Gift name is required and cannot be empty'
                        },
                        numeric:{
                            message: 'Gift amount is not valid'
                        }
                    }
                },
                recipient_name: {
                    message: 'Recipient name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Recipient name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'Recipient name must be more than 2 and less than 30 characters long'
                        }
                    }
                },
                recipient_email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                from_name: {
                    message: 'From name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'From name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'From name must be more than 2 and less than 30 characters long'
                        }
                    }
                },
                from_email: {
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
<script type="text/javascript">

    $(document).ready(function() {

        $('.required')              .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");
        $('[required="required"]')  .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");

    });
</script>

<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('{{\Config::get('maid.stripe_public_key')}}');

    var stripeResponseHandler = function(status, response) {
        var $form = $('#book-form');
        if (response.error) {
            // Show the errors on the form
            $('.payment-errors').html('<div class="alert alert-danger well-sm">'+response.error.message+'</div>');
            $('#book-btn').prop('disabled', false);
        } else {
            // token contains id, last4, and card type
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            // and re-submit
            $form.get(0).submit();
        }
    };

    jQuery(function($) {
        var submitted = false;
        $('#book-form').submit(function(e) {
            var bootstrapValidator = $('#book-form').data('bootstrapValidator');
            if(!bootstrapValidator.isValid()){
                return false;
            }
            if(submitted){
                return false;
            }
            submitted = true;

            var $form = $(this);

            if($('#card_number').val() != ''){
                Stripe.card.createToken($form, stripeResponseHandler);
                // Prevent the form from submitting with the default action
                return false;
            }
        });
    });
</script>

@stop