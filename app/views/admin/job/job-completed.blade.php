@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\JobCompleted())->toHtml() }}

@stop

@section('footer')
@parent
<script>
    function chargeJob(jobId)
    {
        jQuery('#params').val(jobId);
        submitbutton('chargeJob');
    }
</script>
@stop