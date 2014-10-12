@extends('layouts.customer')

@section('content')

<div class="form-wrapper1">
    {{ Form::model($customer, array('method' => 'post', 'url' => 'customer/update-info', 'class' => 'form-horizontal', 'id' => 'book-form')) }}

    @include('layouts.partials.message')
    <span class="payment-errors"></span>

    <div class="form-group">
        <div class="col-sm-4"><h3>Personal Information</h3></div>
        <div class="col-sm-6"><div class="form-step-heading"></div></div>
    </div>

    <div class="form-group">
        {{ Form::label('fname', 'First name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('first_name', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">
            {{ Form::text('last_name', null, array('class' => 'form-control', 'required')) }}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('address', 'Address', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('address', null, array('class' => 'form-control', 'required'))}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('city', 'City', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('city', null, array('class' => 'form-control','required'))}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('state', 'State', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::select('state', \Goxob\Core\Helper::stateList(), null, array('class' => 'form-control') ) }}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('zipcode', 'Zip Code', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('zipcode', null, array('class' => 'form-control', 'required', 'maxlength' => 5))}}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-4"><h3>Payment Information</h3></div>
        <div class="col-sm-6"><div class="form-step-heading"></div></div>
    </div>


    <div class="form-group">
        {{Form::label('card_number', 'Card Number', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('card_number', null, array('class' => 'form-control', 'data-stripe' => "number"))}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('card_cvc', 'Card CVC', array('class' => 'col-sm-3 control-label'))}}
        <div class="col-sm-9">
            {{Form::text('card_cvc', null, array('class' => 'form-control', 'data-stripe' => "cvc"))}}
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
            null, array('class' => 'form-control', 'data-stripe' => "exp-month"))}}
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
            null, array('class' => 'form-control', 'data-stripe' => "exp-year"))}}
        </div>
    </div>

    <br/><br/>
    <div class="form-group">
        <div class="col-sm-9 col-sm-offset-3">
            <input type="submit" class="btn btn-primary" value="Update" id="book-btn">
        </div>
    </div>

    {{Form::hidden('customer_id', $customer->customer_id)}}
    {{Form::close()}}
</div>

@stop

@section('footer')
@parent
{{ HTML::script('assets/bootstrap/js/moment.js') }}
{{ HTML::script('assets/bootstrap/js/bootstrap-datetimepicker.js') }}
{{ HTML::script('assets/bootstrap-validator/js/bootstrapValidator.min.js') }}
{{ HTML::script('https://js.stripe.com/v2/') }}
{{ HTML::script('js/jquery.maskedinput.min.js') }}

<script>
    $(document).ready(function() {

        $('#card_number').mask("9999-9999-9999-9999");
        $('#card_cvc').mask("999?9");

        $('#book-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    message: 'First name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'First name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'First name must be more than 2 and less than 30 characters long'
                        }
//                        regexp: {
//                            regexp: /^[a-zA-Z0-9_]+$/,
//                            message: 'Last name can only consist of alphabetical, number and underscore'
//                        }
                    }
                },
                last_name: {
                    message: 'Last name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Last name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'Last name must be more than 2 and less than 30 characters long'
                        }
                    }
                },
                zipcode: {
                    validators: {
                        notEmpty: {
                            message: 'The zip code is required and cannot be empty'
                        },
                        zipCode: {
                            country: 'US',
                            message: 'The input is not a valid zip code'
                        },
                        remote: {
                            message: 'The zip code is not approved',
                            url: '{{url('check-zip-code')}}'
                        }
                    }
                },
                take_time: {
                    validators: {
                        notEmpty: {
                            message: 'The date is required and cannot be empty'
                        }
                    }
                }
            }
        });
    });
</script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#take_time').datetimepicker({
            minuteStepping:30,
            sideBySide: true
        });

        $('#take_time').on('dp.change', function(e) {
            if(!validateTakeTime()){
                alert('Please select time from 8:30am to 5:30pm');
                return false;
            }

            // Revalidate the date when user change it
            $('#book-form').bootstrapValidator('revalidateField', 'take_time');
        });


        $('.required')              .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");
        $('[required="required"]')  .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");

    });

    function validateTakeTime()
    {
        var datetime = $('#take_time').val();
        var datetimeSegments = datetime.split(":");
        var hourSegments = datetimeSegments[0].split(" ");
        var hour = hourSegments[1];
        var minSegments = datetimeSegments[1].split(" ");
        var min = minSegments[0];
        var midday = minSegments[1];
        if(midday == 'AM')
        {
            if(hour < 8){
                return false;
            }
            else if(hour == 8 && min < 30){
                return false;
            }

        }
        else if(midday == 'PM'){
            if(hour > 5){
                return false;
            }
            else if(hour == 5 && min > 30){
                return false;
            }
        }
        return true;
    }
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