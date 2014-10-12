@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/service-frequency/edit'))}}

<div class="form-group">
    {{ Form::label('sf_name', 'Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('sf_name', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('sf_discount', 'Discount', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('sf_discount', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

{{Form::hidden('sf_id')}}

{{ Form::close() }}

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
@stop
@stop