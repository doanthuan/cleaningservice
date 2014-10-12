@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\JobRating())->toHtml() }}

@stop

@section('footer')
@parent
<script src="{{url('js/jquery.raty.js')}}"></script>
<script>
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
</script>
@stop