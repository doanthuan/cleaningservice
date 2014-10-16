@extends('admin.layouts.admin')

@section('head')
@parent

{{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.css') }}
{{ HTML::style('assets/bootstrap-validator/css/bootstrapValidator.min.css') }}
@stop

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/job/edit', 'id' => 'book-form' ))}}


<div class="form-group">
    <div class="col-sm-2"><h3>Customer</h3></div>
    <div class="col-sm-6"><div class="form-step-heading"></div></div>
</div>

<div class="form-group">
    {{ Form::label('fname', 'First name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('first_name', $customer->first_name, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('last_name', $customer->last_name, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('email', $customer->email, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{Form::label('phone', 'Phone', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('phone', $customer->phone, array('class' => 'form-control', 'required'))}}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-2"><h3>Address</h3></div>
    <div class="col-sm-6"><div class="form-step-heading"></div></div>
</div>

<div class="form-group">
    {{Form::label('address', 'Address', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('address', null, array('class' => 'form-control', 'required'))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('city', 'City', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('city', null, array('class' => 'form-control','required'))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('state', 'State', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::select('state', \Goxob\Core\Helper::stateList(), null, array('class' => 'form-control') ) }}
    </div>
</div>

<div class="form-group">
    {{Form::label('zipcode', 'Zip Code', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('zipcode', null, array('class' => 'form-control', 'required', 'maxlength' => 5))}}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2"><h3>Service</h3></div>
    <div class="col-sm-6"><div class="form-step-heading"></div></div>
</div>

<div class="form-group">
    {{Form::label('service_type', 'Type of Service', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::select('service_type', \App\Models\ServiceType::select('st_id',\DB::raw('CONCAT(st_name, ": $", st_price, " Flat Rate") as full_name'))->lists('full_name', 'st_id'),
        null, array('class' => 'form-control'))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('take_time', 'Date/Time', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6" id="datetimepicker">
        <div class="input-group date">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            {{Form::text('take_time', null, array('class' => 'form-control', 'required'))}}
        </div>
    </div>
</div>

<div class="form-group">
    {{Form::label('service_frequency', 'Frequency of Service', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::select('service_frequency', \App\Models\ServiceFrequency::lists('sf_name', 'sf_id'),
        null, array('class' => 'form-control'))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('discount_code', 'Discount Code', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('discount_code', null, array('class' => 'form-control'))}}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-2"><h3>Extras</h3></div>
    <div class="col-sm-6"><div class="form-step-heading"></div></div>
</div>

<div class="form-group">

                    
    <?php $seList = \App\Models\ServiceExtra::select('se_id',\DB::raw('CONCAT(se_name, " +$", se_price) as full_name'))->lists('full_name','se_id'); ?>
    @foreach( $seList as $key => $value)
    <div class="col-sm-offset-2 col-sm-6">
        <div class="checkbox">
            <label>
                <?php
                //$serviceExtras = Input::old('service_extras', array());
                $serviceExtras = explode(',',$customer->service_extras);
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
    <div class="col-sm-2"><h3>Payment</h3></div>
    <div class="col-sm-6"><div class="form-step-heading"></div></div>
</div>


<div class="form-group">
    {{Form::label('card_number', 'Card Number', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('card_number', null, array('class' => 'form-control','data-stripe' => "number"))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('card_cvc', 'Card CVC', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        {{Form::text('card_cvc', null, array('class' => 'form-control', 'data-stripe' => "cvc"))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('expires_on', 'Expires on', array('class' => 'col-sm-2 control-label'))}}
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
        2015, array('class' => 'form-control', 'data-stripe' => "exp-year"))}}
    </div>
</div>


</br>
<div class="form-group">
    {{Form::label('total', 'Total Amount', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-6">
        <div id="total-amount" style="margin-top: 5px;"></div>
        <input type="hidden" name="amount" id="amount">
    </div>
</div>
{{Form::hidden('job_id', $item->job_id)}}
{{Form::hidden('customer_id', $customer->customer_id)}}
{{ Form::close() }}

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
        $('#card_cvc').mask("999?9");

        $('#book-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
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
            minuteStepping:15,
            sideBySide: true
        });

        $('#take_time').on('dp.change', function(e) {
            // Revalidate the date when user change it
            $('#book-form').bootstrapValidator('revalidateField', 'take_time');
        });

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
        //totalAmount = totalAmount.toFixed(2);

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
            //$('#book-btn').prop('disabled', false);
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
            //$('#book-btn').prop('disabled', true);

            if($('#card_number').val() != ''){
                Stripe.card.createToken($form, stripeResponseHandler);
                // Prevent the form from submitting with the default action
                return false;
            }
            else{
                $form.get(0).submit();
            }
        });
    });
</script>


@stop

@stop