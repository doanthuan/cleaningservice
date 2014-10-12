@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/user/edit', 'id' => 'user-form'))}}

<div class="form-group">
    {{ Form::label('username', 'User Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('username', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('email', null, array('class' => 'form-control email', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('fname', 'First name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
    </div>
</div>


<?php
$pswRequired = isset($item->user_id)?'':'required';
?>

<div class="form-group">
    {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::password('password', array('class' => 'form-control ', $pswRequired)) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('password_confirmation', 'Password Confirmation', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::password('password_confirmation', array('class' => 'form-control ', $pswRequired)) }}
    </div>
</div>


{{Form::hidden('role_id', 2)}}

<div class="form-group">
    {{ Form::label('team', 'Team', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{\Goxob\Core\Helper\Html::dropdown('team_id', $item->team_id, array('class' => 'form-control'),
        (new \App\Models\Teams())->getAll(), 'team_id','team_name'
        )}}
    </div>
</div>

<div class="form-group">
    {{ Form::label('bank_name', 'Bank Account Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('bank_name', null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('routing_number', 'Routing Number', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('routing_number', null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('account_number', 'Account Number', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('account_number', null, array('class' => 'form-control')) }}
    </div>
</div>


{{Form::hidden('user_id')}}

{{ Form::close();}}
@stop

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('form[name="adminForm"]').validate({
            rules : {
                password : {
                    minlength : 8
                },
                password_confirmation : {
                    minlength : 8,
                    equalTo : "#password"
                }
            }
        });
    });
</script>

{{ HTML::script('https://js.stripe.com/v2/') }}
<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('{{\Config::get('maid.stripe_public_key')}}');

    var stripeResponseHandler = function(status, response) {
        var $form = $('#user-form');

        if (response.error) {
            // Show the errors on the form
            alert(response.error.messag);
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
        $('#user-form').submit(function(e) {
            if(submitted){
                return false;
            }
            submitted = true;

            var $form = $(this);

            //Stripe.card.createToken($form, stripeResponseHandler);
            if($('#routing_number').val() != ''){
                Stripe.bankAccount.createToken({
                    country: 'US',
                    routingNumber: $('#routing_number').val(),
                    accountNumber: $('#account_number').val()
                }, stripeResponseHandler);

                // Prevent the form from submitting with the default action
                return false;
            }
        });
    });
</script>
@stop