@extends('layouts.public')

@section('content')

<div class="wrapper body-inverse">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="text-center">Job Feedback</h2>

                <div class="form-white">
                    @include('layouts.partials.message')

                    {{ Form::model($item, array('class' => 'form-horizontal', 'url' => 'customer/user-feedback', 'id' => 'feedback-form' ))}}

                    <div class="form-group">
                        {{ Form::label('team_name', 'Team Name', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            @if(isset($item->team->team_name))
                            {{$item->team->team_name}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('rating', 'Rating', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            <div id="job-rating" data-score="{{$item->rating}}"></div>
                            <input type="hidden" name="rating" id="rating">
                        </div>
                    </div>


                    <div class="form-group">
                        {{ Form::label('comment', 'Comment', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('comment', null, array('class' => 'form-control', 'required')) }}
                        </div>
                    </div>

                    @if(!\Auth::check())
                    <div class="form-group">
                        {{ Form::label('feedback_phone', 'Phone', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::text('feedback_phone', null, array('class' => 'form-control', 'required')) }}
                        </div>
                    </div>
                    @else
                        <input type="hidden" name="feedback_phone" value="{{$item->customer_phone}}">
                    @endif

                    @if(!\Auth::check())
                    <div class="form-group">
                        {{ Form::label('feedback_email', 'Email', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::text('feedback_email', null, array('class' => 'form-control', 'required')) }}
                        </div>
                    </div>
                    @else
                        <input type="hidden" name="feedback_email" value="{{$item->customer_email}}">
                    @endif


                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="submit" class="btn btn-primary" value="{{trans('Submit')}}">
                        </div>
                    </div>
                    <input type="hidden" id="yelp_confirm" name="yelp_confirm">

                    {{Form::hidden('job_id')}}

                    {{ Form::close() }}

                </div>

            </div>
        </div>
    </div>
</div>
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

        if(score == 5){
            $('#yelp_confirm').val(1);
        }
    });

    });
</script>
@stop