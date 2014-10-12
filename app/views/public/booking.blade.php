@extends('layouts.public')

@section('head')
@parent

{{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.css') }}
{{ HTML::style('assets/bootstrap-validator/css/bootstrapValidator.min.css') }}
{{ HTML::style('css/style.css') }}
@stop

@section('content')


<div class="wrapper"> <!-- wrapper -->
    <div class="house-bg">
        <div class="house-bg-inside">
            <div class="container"> <!-- container -->
                <div class="col-sm-12">
                    <div class="row text-center text-white">
                        <h1>YOU’RE 60 SECONDS AWAY FROM AWESOME CLEANING!</h1>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-calendar fa-3x"></i>
                                    <h4>Choose Your Date &amp; Time</h4>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-lock fa-3x"></i>
                                    <h4>Pay securely online</h4>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-ban fa-3x"></i>
                                    <h4>No contracts, cancel anytime</h4>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-smile-o fa-3x"></i>
                                    <h4>No upsells or hidden pricing</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center">
            <h2>Our 200% Money Back Guarantee</h2>
            <p>If you’re not happy, we come back and re-clean and if you still don’t think we did a good enough job to recommend us we issue a full refund!</p>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="row text-center">
                    <?php if(!empty($_SESSION['error_zip'])) { echo "<p style='color: red;'>". $_SESSION['error_zip'] . "</p>"; }  ?>
                </div>

                @include('layouts.partials.message')

                <span class="payment-errors"></span>

                <div class="form-wrapper">
                {{ Form::open(array('method' => 'post', 'url' => 'job/booking', 'class' => 'form-horizontal', 'id' => 'book-form')) }}

                <div class="form-group">
                    <div class="col-sm-5"><h3>STEP 1: WHO YOU ARE</h3></div>
                    <div class="col-sm-7"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{ Form::label('fname', 'First name', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('first_name', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('last_name', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('email', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('phone', null, array('class' => 'form-control', 'required'))}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-5"><h3>STEP 2: YOUR HOME</h3></div>
                    <div class="col-sm-7"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{Form::label('address', 'Address', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('address', null, array('class' => 'form-control', 'required'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('city', 'City', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('city', null, array('class' => 'form-control','required'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('state', 'State', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('state', \Goxob\Core\Helper::stateList(), null, array('class' => 'form-control') ) }}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('zipcode', 'Zip Code', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('zipcode', null, array('class' => 'form-control', 'required', 'maxlength' => 5))}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-5"><h3>STEP 3: YOUR SERVICE</h3></div>
                    <div class="col-sm-7"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{Form::label('service_type', 'Type of Service', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('service_type', \App\Models\ServiceType::lists('st_name', 'st_id'),
                        null, array('class' => 'form-control'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('take_time', 'Date/Time', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8" id="datetimepicker">
                        <div class="input-group date">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            {{Form::text('take_time', null, array('class' => 'form-control', 'required'))}}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('service_frequency', 'Frequency of Service', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('service_frequency', \App\Models\ServiceFrequency::lists('sf_name', 'sf_id'),
                        null, array('class' => 'form-control'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('discount_code', 'Discount Code', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('discount_code', null, array('class' => 'form-control'))}}
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-5"><h3>STEP 4: EXTRAS</h3></div>
                    <div class="col-sm-7"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    @foreach(\App\Models\ServiceExtra::lists('se_name','se_id') as $key => $value)
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <?php
                                $serviceExtras = Input::old('service_extras', array());
                                if(in_array($key, $serviceExtras ) !== false){
                                    $checked = 'checked="checked"';
                                }else{
                                    $checked = '';
                                }?>
                                <input type="checkbox" name="service_extras[]" value="{{$key}}" {{$checked}}> {{$value}}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="form-group">
                    <div class="col-sm-5"><h3>STEP 5: SELECT PAYMENT</h3></div>
                    <div class="col-sm-7"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{Form::label('total', 'Total Amount', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        <div id="total-amount" style="margin-top: 5px; font-weight: bold"></div>
                        <input type="hidden" name="amount" id="amount">
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('card_number', 'Card Number', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('card_number', null, array('class' => 'form-control','required', 'data-stripe' => "number"))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('card_cvc', 'Card CVC', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('card_cvc', null, array('class' => 'form-control','required', 'data-stripe' => "cvc"))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('expires_on', 'Expires on', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-3">
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
                    <div class="col-sm-2">
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

                <div class="form-group">
                    <div class="col-sm-5"><h3>WHAT HAPPENS NEXT?</h3></div>
                    <div class="col-sm-7"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        Don't worry, you won't be billed until the day of service and you will receive an email receipt instantly. We no longer accept cash or checks.
                    </div>
                </div>

                <br/>
                <span class="payment-errors"></span>
                @include('layouts.partials.message')
                <br/>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-dark btn-xlarge" id="book-btn" value="BOOK APPOINTMENT">
                    </div>
                </div>
                {{ Form::close() }}

                </div>
            </div>
            <div class="col-sm-3">
                <div class="row text-center">
                    <div class="crp-ft">
                        <i class="text-color fa fa-check fa-3x"></i>
                        <h4>Insured Services</h4>
                        <p>You're in good company when you choose Maids in Black. Rest assured that we are fully insured.</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-smile-o fa-3x"></i>
                        <h4>Friendly Service</h4>
                        <p>Fast and friendly customer service folks. Our average response time for emails is now 14 minutes.</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-leaf fa-3x"></i>
                        <h4>We Provide Supplies</h4>
                        <p>We got this! Our team partners bring their own supplies and vacuum and honor special requests.</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-rocket fa-3x"></i>
                        <h4>Speedy Confirmation</h4>
                        <p>Book and receive a confirmation within 30 minutes during normal booking hours from 8:30am to midnight!</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-shopping-cart fa-3x"></i>
                        <h4>Safe Shopping Guarantee</h4>
                        <p>You'll pay nothing if unauthorized charges are made to your credit card as a result of booking with us.</p>
                    </div>


                </div>
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
{{ HTML::script('js/jquery.maskedinput.min.js') }}

<script>
    $(document).ready(function() {
        $("#phone").mask("(999) 999-9999");
        $('#card_number').mask("9999-9999-9999-9999");
        $('#card_cvc').mask("999");



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
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Phone is required and cannot be empty'
                        },
                        phone: {
                            country: 'US',
                            message: 'The input is not a valid phone'
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

        var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();

        $('#take_time').datetimepicker({
            minuteStepping:30,
            sideBySide: true,
            minDate: '{{date('m/d/Y')}}',
            defaultDate: month + '-' + day + '-' + year + ' 8:30'
        });

        $('#take_time').on('dp.change', function(e) {
            // Revalidate the date when user change it
//            if(!validateTakeTime()){
//                alert('Please select time from 8:30am to 5:30pm');
//                return false;
//            }

            $('#book-form').bootstrapValidator('revalidateField', 'take_time');
        });


        $('.required')              .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");
        $('[required="required"]')  .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");

        $('#service_type').change(function(){
            calTotalAmount();
        })

        $('#service_frequency').change(function(){
            calTotalAmount();
        })

        $('input:checkbox[name="service_extras[]"]').click(function(){
            calTotalAmount();
        });

        calTotalAmount();
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

    var serviceTypes = {{json_encode(\App\Models\ServiceType::lists('st_price', 'st_id'))}};
    var serviceFrequencies = {{json_encode(\App\Models\ServiceFrequency::lists('sf_discount', 'sf_id'))}};
    var serviceExtras = {{json_encode(\App\Models\ServiceExtra::lists('se_price', 'se_id'))}};
    function calTotalAmount()
    {
        var totalAmount = 0;

        var serviceType = $('#service_type').val();
        totalAmount = serviceTypes[serviceType];

        $('input:checkbox[name="service_extras[]"]:checked').each(function(){

            var se_id = $(this).val();
            totalAmount += serviceExtras[se_id];
        })

        var serviceFrequency = $('#service_frequency').val();
        var discountPer = serviceFrequencies[serviceFrequency];
        if(discountPer > 0){
            totalAmount = totalAmount - (totalAmount*discountPer/100);
        }
        totalAmount = totalAmount.toFixed(2);

        $('#total-amount').text('$'+totalAmount);
        $('#amount').val(totalAmount);

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
            submitted = false;
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

            // Disable the submit button to prevent repeated clicks
            $('#book-btn').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        });
    });
</script>
@stop