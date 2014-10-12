@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\Team())->toHtml() }}

@stop

@section('footer')
@parent
<script>
    function sendSchedule()
    {
        if(isItemChecked())
        {
            submitbutton('sendSchedule');
        }
    }
</script>
<script src="{{url('js/jquery.raty.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.job-rating').raty({
            score: function() {
                return $(this).attr('data-score');
            },
            starOff     : '{{url('img/star-off.png')}}',
            starOn      : '{{url('img/star-on.png')}}',
            starHalf      : '{{url('img/star-half.png')}}',
            readOnly : true
    });
    });
</script>
@stop
