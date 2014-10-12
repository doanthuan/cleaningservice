@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/customer/edit'))}}

<div class="form-group">
    {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('first_name', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('last_name', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('email', null, array('class' => 'form-control email', 'required')) }}
    </div>
</div>

<?php
$pswRequired = isset($item->customer_id)?'':'required';
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
        {{Form::text('zipcode', null, array('class' => 'form-control', 'required'))}}
    </div>
</div>

<div class="form-group">
    {{Form::label('status', 'Enable', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-2">
        {{Form::select('status', array(
            '1' => 'Enabled',
            '0' => 'Disabled'
            ),
            null, array('class' => 'form-control'))}}
    </div>
</div>

{{Form::hidden('customer_id')}}

{{ Form::close();}}
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

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
@stop
@stop