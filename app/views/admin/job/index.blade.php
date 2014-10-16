@extends('admin.layouts.admin')

@section('head')
@parent
{{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.css') }}
@stop

@section('content')

{{ (new \App\Blocks\Admin\Grid\Job())->toHtml() }}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{ Form::open(array('class' => 'form-horizontal', 'url' => 'admin/job/assign-team', 'id' => 'assign-form' ))}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Assign Team</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('team', 'Team', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-6">
                        {{\Goxob\Core\Helper\Html::dropdown('team_id', null, array('class' => 'form-control', 'id' => 'team_id'),
                        (new \App\Models\Teams())->getAll(), 'team_id','team_name'
                        )}}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('team_revenue', 'Team Revenue', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-6">
                        {{ Form::text('team_revenue', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
                <input type="hidden" name="job_id" id="job_id">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>


<div class="modal fade" id="modelRecuringJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{ Form::open(array('class' => 'form-horizontal', 'url' => 'admin/job/recurring-job', 'id' => 'recurring-form' ))}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Recurring Job</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('take_time', 'Date/Time', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8" id="datetimepicker">
                        <div class="input-group date">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            {{Form::text('take_time', null, array('class' => 'form-control', 'required'))}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('service_frequency', 'Frequency of Service', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('service_frequency', \App\Models\ServiceFrequency::lists('sf_name', 'sf_id'),
                        null, array('class' => 'form-control'))}}
                    </div>
                </div>
                <input type="hidden" name="job_id" id="job_id_recurring">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop

@section('footer')
@parent
{{ HTML::script('assets/bootstrap/js/moment.js') }}
{{ HTML::script('assets/bootstrap/js/bootstrap-datetimepicker.js') }}
<script>
    function showTeams(jobId, teamId, teamRevenue)
    {
        $('#job_id').val(jobId);
        $('#team_id').val(teamId);
        $('#team_revenue').val(teamRevenue);
        $('#myModal').modal();
    }
    function updateJobStatus(jobId, status)
    {
        $('#job_id').val(jobId);
        $('#params').val(status);
        submitbutton('updateJobStatus');
    }
    function showRecurringJob(jobId)
    {
        $('#job_id_recurring').val(jobId);
        $('#modelRecuringJob').modal();
    }

     $(document).ready(function() {

            var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();

            $('#take_time').datetimepicker({
                minuteStepping:30,
                sideBySide: true,
                minDate: '{{date('m/d/Y')}}',
                defaultDate: month + '-' + day + '-' + year + ' 8:30'
            });
    });

</script>

@stop