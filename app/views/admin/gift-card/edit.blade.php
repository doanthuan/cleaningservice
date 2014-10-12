@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/gift-card/edit'))}}

<div class="form-group">
    {{ Form::label('gift_amount', 'Amount', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('gift_amount', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('discount_code', 'Code', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('discount_code', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
            <label>
                {{Form::checkbox('unlimited', 1, array('checked' => 'checked'))}} Unlimited
            </label>
        </div>
    </div>
</div>

{{ Form::close() }}

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
@stop
@stop