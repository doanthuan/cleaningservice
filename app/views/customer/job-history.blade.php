@extends('layouts.customer')

@section('content')

<div class="form-wrapper1">

    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
        <tr>

            <th class="col-sm-1">Time</th>
            <th>Address</th>
            <th>Assigned Team</th>
            <th>Status</th>
            <th>Frequency</th>
            <th>Comment</th>
            <th>Rating</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <!-- data rows-->
        @foreach($jobs as $job)
        <tr>
            <td>{{$job->take_time}}</td>
            <td>{{$job->address}}</td>
            <td>@if(isset($job->team))
                {{$job->team->team_name}}
                @endif
                </td>
            <td>{{\App\Models\Job::getStatusStringForCustomer($job->status)}}</td>
            <td>{{$job->serviceFrequency->sf_name}}</td>
            <td>{{$job->comment}}</td>
            <td><div class="job-rating" data-score="{{$job->rating}}"></div></td>
            <td>
                @if(empty($job->rating))
                <?php
                    $disabled = '';
                    if($job->status < \App\Models\Job::STATUS_COMPLETED ){
                        $disabled = 'disabled';
                    }
                ?>

                <button class="btn btn-success" onclick="return rateJob('{{$job->job_id}}')" {{$disabled}}>Rate Job</button>
                @endif
            </td>
        </tr>
        @endforeach
        <!-- data rows end-->
        </tbody>

    </table>

</div>

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
    function rateJob(jobId)
    {
        var url = '{{url('customer/user-feedback')}}'+'/'+jobId;
        window.location = url;
        return false;
    }
</script>
@stop