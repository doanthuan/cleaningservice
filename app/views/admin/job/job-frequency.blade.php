@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\JobFrequency())->toHtml() }}

@stop

@section('footer')
@parent
<script>
    function pauseOrResumeJob(jobId, pause){
        jQuery('#params').val(jobId + ':' + pause);
        submitbutton('postFrequencyJobs');
    }
</script>
@stop