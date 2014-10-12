@extends('layouts.public')

@section('head')
@parent
{{ HTML::style('css/style.css') }}
@stop

@section('content')

<div class="wrapper body-inverse"> <!-- wrapper -->
    <div class="container">
        <div class="row">
            <!-- Contact Us form -->
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center">Contact Us</h2>
                <p class="text-muted text-center">
                    Please fill out the form below to send us your comments.
                </p>
<!--                <p class="text-center text-muted" id="signed-in"><i class="fa fa-circle-o text-color"></i> Show as seen by signed in users.</p>-->
                <div class="form-white form-contact">
                    {{ Form::open(array('method' => 'post', 'url' => 'contact-us', 'class' => 'form-horizontal', 'id' => 'contact-form')) }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name-1">First name</label>
                                    <input type="text" class="form-control show" id="name-1" placeholder="Enter first name" required="required" name="first_name" value="{{{ $customer->first_name or '' }}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="name-2" class="pull-right-xs">Last name</label>
                                    <input type="text" class="form-control show" id="name-2" placeholder="Enter last name" required="required" name="last_name" value="{{$customer->last_name or ''}}">
                                    <input type="text" class="form-control hidden" id="name-2-disabled" placeholder="Enter last name" value="Smith" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email-contact">Email address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control show email" id="email-contact" placeholder="Enter email" name="email" value="{{$customer->email or ''}}">
                            <input type="email" class="form-control hidden" id="email-contact-disabled" placeholder="Enter email" value="user@mysite.com" disabled>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea id="message" name="message" class="form-control" rows="3" placeholder="Enter your message here" required="required"></textarea>
                        </div>
<!--                        <div class="checkbox">-->
<!--                            <label>-->
<!--                                <input type="checkbox"> Send a copy to myself-->
<!--                            </label>-->
<!--                        </div>-->
                        <button type="submit" class="btn btn-block btn-color btn-xxl">Submit</button>
                    {{ Form::close() }}
                    <hr>
                    <p class="text-muted">
                        All fields marked with an asterisk (<span class="text-danger">*</span>) are required.
                    </p>
                    <div class="form-avatar contact-avatar">
				<span class="fa-stack fa-3x show animated flipInX">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-user fa-stack-1x"></i>
				</span>
<!--                        <img src="img/client-1.jpg" alt="..." class="hidden">-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- / wrapper -->

@stop

@section('footer')
@parent
<script src="{{url('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#contact-form').validate();
    });
</script>
@stop