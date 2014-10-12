@extends('admin.layouts.empty')

@section('content')
<?php echo Form::open(array('name' => 'adminForm', 'class' => 'form-horizontal form-signin', 'url' => 'admin/login'))?>

<div class="panel panel-default login-panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('Log in to Admin Panel')}}</h3>
    </div>
    <div class="panel-body">
        @include('admin.layouts.partials.message')

        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">User Name</label>
            <div class="col-sm-8"><?php echo Form::text('username', null, array('class' => 'form-control', 'required' => 'required'))?></div>
        </div>

        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-8"><?php echo Form::input('password','password', null, array('class' => 'form-control', 'required' => 'required'))?></div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </div>
    </div>
</div>


<?php echo Form::close();?>



@stop