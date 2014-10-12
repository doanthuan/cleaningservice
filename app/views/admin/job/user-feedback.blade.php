@extends('admin.layouts.admin')

@section('content')
{{ Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/job/user-feedback', 'id' => 'feedback-form' ))}}

<div class="form-group">
    {{ Form::label('team_name', 'Team Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{$item->team->team_name}}
    </div>
</div>

<div class="form-group">
    {{ Form::label('rating', 'Rating', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        <div id="job-rating" data-score="{{$item->rating}}"></div>
        <input type="hidden" name="rating" id="rating">
    </div>
</div>


<div class="form-group">
    {{ Form::label('comment', 'Comment', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-6">
        {{ Form::textarea('comment', null, array('class' => 'form-control', 'required')) }}
    </div>
</div>

{{Form::hidden('job_id')}}

{{ Form::close() }}

@stop

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
<script src="{{url('js/jquery.raty.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#job-rating').raty({
            score: function() {
                return $(this).attr('data-score');
            },
            starOff     : '{{url('img/star-off.png')}}',
            starOn      : '{{url('img/star-on.png')}}'
    });

    $('#feedback-form').submit(function(e) {
        var score = $('#job-rating').raty('score');
        $('#rating').val(score);
    });

    });
</script>
@stop