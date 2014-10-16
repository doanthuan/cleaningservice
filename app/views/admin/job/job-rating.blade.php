@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\JobRating())->toHtml() }}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Comment Details</h4>
            </div>
            <div class="modal-body">

                <div id="comment-content"></div>

            </div>

        </div>
    </div>
</div>

@stop

@section('footer')
@parent
<script src="{{url('js/jquery.raty.js')}}"></script>
<script>

var jobs = {{json_encode(\App\Models\Job::lists('comment', 'job_id'))}};

$(document).ready(function(){
   $('.job-rating').raty({
       score: function() {
           return $(this).attr('data-score');
       },
       starOff     : '{{url('img/star-off.png')}}',
       starOn      : '{{url('img/star-on.png')}}',
       readOnly : true
});

});

function popupComment(jobId)
{
    var content = jobs[jobId];
    $('#comment-content').html(content);
    $('#myModal').modal();
}
</script>
@stop