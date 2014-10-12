<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('layouts.partials.head')
    {{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.css') }}
    {{ HTML::style('assets/bootstrap-validator/css/bootstrapValidator.min.css') }}
    {{ HTML::style('css/style.css') }}
</head>
<body class="body-green">
@include('layouts.partials.header')

<div class="wrapper">
    <div class="container">
        <div class="col-sm-2">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{url('customer/profile')}}">My Account</a>
                </li>
                <li class="list-group-item">
                    <a href="{{url('customer/job-history')}}">Job History</a>
                </li>
                <li class="list-group-item">
                    <a href="{{url('customer/job-recurring')}}">Job Management</a>
                </li>
            </ul>

        </div>
        <div class="col-sm-10">
            @yield('content')
        </div>
    </div>
</div>

@include('layouts.partials.footer')
</body>
</html>
