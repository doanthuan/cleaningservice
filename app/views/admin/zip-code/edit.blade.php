@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/zip-code/edit'))}}

<div class="form-group">
    {{ Form::label('zipcode', 'Zip Code', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::text('zipcode', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>


{{Form::hidden('zipcode_id')}}

{{ Form::close() }}

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
@stop
@stop