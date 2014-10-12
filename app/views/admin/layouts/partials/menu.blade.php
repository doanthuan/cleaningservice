<?php $user = \Goxob\Core\Helper\Auth::user()?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">MaidSavvy Admin</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if($user->role_id == 1)
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                @else
                <li><a href="{{url('admin/dashboard/team')}}">Dashboard</a></li>
                @endif
                <li class="dropdown">
                    <a href="{{url('admin/job')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('Jobs')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/job')}}">Manage Jobs</a></li>
                        @if($user->role_id == 1)
                        <li><a href="{{url('admin/job/charge')}}">Charge Customer Page</a></li>
                        @endif
                        <li><a href="{{url('admin/job/paid-team-jobs')}}">Completed Jobs</a></li>
                        <li><a href="{{url('admin/job/feedback')}}">Job Feedback</a></li>
                        @if($user->role_id == 1)
                        <li><a href="{{url('admin/job/frequency-jobs')}}">Frequency Jobs</a></li>
                        @endif
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="{{url('admin/team')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('Teams')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/team')}}">Manage Teams</a></li>
                        @if($user->role_id == 1)
                        <li><a href="{{url('admin/user')}}">Manage Members</a></li>
                        @endif
                    </ul>
                </li>
<!--                <li><a href="{{url('admin/customer')}}">Customers</a></li>-->
                @if($user->role_id == 1)
                <li class="dropdown">
                    <a href="{{url('admin/service-type')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('Services')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/service-type')}}">Manage Service Types</a></li>
<!--                        <li><a href="{{url('admin/service-frequency')}}">Manage Service Frequencies</a></li>-->
                        <li><a href="{{url('admin/service-extra')}}">Manage Service Extras</a></li>
                    </ul>
                </li>
                <li><a href="{{url('admin/zip-code')}}">Zip Codes</a></li>
                <li><a href="{{url('admin/gift-card')}}">Gift Cards</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('')}}" onclick="">Frontend</a></li>
                <li><a href="{{url('admin/logout')}}">Log Out</a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</div>

<script>
    $(document).ready(function(){
        var currentUrl = '{{{\Illuminate\Support\Facades\URL::current()}}}';
        if($('a[href="'+currentUrl+'"]').closest("li.dropdown").size() > 0 ){
            $('a[href="'+currentUrl+'"]').closest("li.dropdown").addClass('active');
        }
        else{
            $('a[href="'+currentUrl+'"]').closest("li").addClass('active');
        }
    });
</script>