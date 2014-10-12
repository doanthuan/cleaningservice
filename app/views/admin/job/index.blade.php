@extends('admin.layouts.admin')

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
@stop

@section('footer')
@parent
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

</script>
@stop