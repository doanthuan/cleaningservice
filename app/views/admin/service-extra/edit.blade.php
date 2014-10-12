@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/service-extra/edit'))}}

<div class="form-group">
    {{ Form::label('se_name', 'Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('se_name', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('se_price', 'Price', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('se_price', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

{{Form::hidden('se_id')}}

{{ Form::close() }}

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
@stop
@stop