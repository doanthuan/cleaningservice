@extends('layouts.customer')

@section('content')

<div class="form-wrapper1">
    {{ Form::open(array('url' => 'customer/job-recurring', 'id' => 'recurring-form')) }}
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
        <tr>
            <th class="col-sm-1">Time</th>
            <th>Address</th>
            <th>Assigned Team</th>
            <th>Status</th>
            <th>Frequency</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <!-- data rows-->
        @foreach($jobs as $job)
        <tr>
        <?php
        $text = empty($job->recurring_pause)?'Stop':'Start';
        $button_text = empty($job->recurring_pause)?'danger':'success';
        $value = empty($job->recurring_pause)?'1':'0';
        $recurringStatus = empty($job->recurring_pause)?'Running':'Stopped';
        ?>

            <td>{{$job->take_time}}</td>
            <td>{{$job->address}}</td>
            <td>@if(isset($job->team))
                {{$job->team->team_name}}
                @endif
                </td>
            <td>{{\App\Models\Job::getStatusStringForCustomer($job->status)}}</td>
            <td>{{$job->serviceFrequency->sf_name}}</td>
            <td>
                <button class="btn btn-{{ $button_text }}" onclick="return pauseOrResumeJob('{{$job->job_id}}', '{{$value}}')">{{$text}}</button>
            </td>
        </tr>
        @endforeach
        <!-- data rows end-->
        </tbody>

    </table>
    <input type="hidden" id="job_id" name="job_id">
    <input type="hidden" id="pause" name="pause">
    {{ Form::close(); }}
</div>

@stop

@section('footer')
@parent
<script>
    function pauseOrResumeJob(jobId, pause){
        $('#job_id').val(jobId);
        $('#pause').val(pause);
        $('#recurring-form').submit();
    }
</script>
@stop