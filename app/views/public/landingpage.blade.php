<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $city }}'s premier cleaning/maid service. Our online booking system and flat rate pricing takes the headache out of finding your trusted cleaning service.">
<meta name="author" content="">
<link rel="shortcut icon" href="{{url('img/favicon.html')}}">

<title>MaidSavvy: {{ $city }}'s Cleaning Services &amp; House Cleaning</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- Custom styles for this template -->
{{ HTML::style('assets/bootstrap/css/bootstrap.min.css') }}
{{ HTML::style('css/color-styles.css') }}
{{ HTML::style('css/ui-elements.css') }}
{{ HTML::style('css/custom.css') }}
{{ HTML::style('css/mCustomScrollbar.css') }}

<!-- Resources -->
{{ HTML::style('css/animate.css') }}
{{ HTML::style('css/font-awesome.min.css') }}
<link href='//fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<!--<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
{{ HTML::style('css/basic_ie.css') }}
<![endif]-->
</head>
<body class="body-green">
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="pull-left hidden-xs">
                    <h1>MaidSavvy: {{ $city }}'s Cleaning Services &amp; House Cleaning</h1>
                </div>
                <div class="pull-right">
                    <p>Customer Service  •  (800) 737-4802  •  hello@maidsavvy.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="{{url('')}}"><img id="logo" class="img-responsive" src="{{url('/img/MaidSavvy_Logo2.png')}}"/></a>
        </div>
        <div class="navbar-collapse collapse pull-right-sm">
            <ul class="nav navbar-nav">
                <li><a href="{{url('/faqs')}}">Help</a></li>
                <li><a href="{{url('/locations')}}">Locations</a></li>
                <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
            </ul>
            <div class="pull-right-sm">
                <a href="{{url('/booking')}}" class="btn btn-primary booking-btn">Book In 60 Secs <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>

<style>
.header-list {
margin-top:25px;
}
.header-ul li {
margin-top:10px;
font-size:16px;
font-weight:bold;
}
#book-btn {
padding: 20px 65px;
margin-top:15px;
width:70%;
}
#book-btn2 {
padding: 20px 65px;
margin-top:25px;
margin-top:25px;
}
.fa-check {
color:#428bca;
}
#white-bg {
background-color: rgba(255,255,255,0.68);
padding-bottom:50px;
}
.crp-showcase {
padding-bottom:0px;
}
</style>

<div class="wrapper"> <!-- wrapper -->
<div class="crp-showcase" style="background: url('https://s3-us-west-1.amazonaws.com/homejoy/img/lptest/homelife-top-k.jpg') no-repeat center center;">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5" id="white-bg">
            <div class="col-sm-11 col-sm-offset-1">
                <h1 class="oswald">Get Your Place Cleaned</h1>
                <h3>{{ $city }}'s Simple, Affordable, and Convenient Cleaners</h3>
                <a class="btn btn-color" id="book-btn" href="/booking/">Book Appointment&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
                <div class="header-list">
	                <ul class="text-center-xs ul-none large-text header-ul">
	                    <li><i class="fa fa-check"></i> Bonded and insured cleaners</li>
	                    <li><i class="fa fa-check"></i> Flat rate pricing</li>
	                    <li><i class="fa fa-check"></i> No contracts or hidden fees</li>
	                    <li><i class="fa fa-check"></i> Secure online payment</li>
	                    <li><i class="fa fa-check"></i> Immediate booking confirmation</li>
	                    <li><i class="fa fa-check"></i> 100% Satisfaction Guarantee</li>
	                    <li><i class="fa fa-check"></i> Customer service 7 days a week</li>
	                </ul>
                </div>
            </div>
            </div>
        </div>
</div>
<div class="container spacer-margin">
    <!-- Description -->
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <h2 class="oswald">Choose your ideal cleaning, book online, relax</h2>
            <h4 class="oswald">Book in 60 seconds; No quotes, estimates or phone tag</h4>
            <hr class="small">
        </div>
    </div>
    <div class="row spacer-margin">
        <div class="col-sm-4">
            <div class="crp-ft">
                <span class="how-image how1"></span>
                <h4>Book</h4>
                <p class="text-muted lh">
                    Choose the best time for your cleaner to arrive and select your cleaning frequency (monthly, bi-weekly, or weekly).
                </p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="crp-ft">
                <span class="how-image how2"></span>
                <h4>Confirm</h4>
                <p class="text-muted lh">
                    Add any specific cleaning instructions and pay securely online by credit or debt card. Receive instant confirmation of your cleaning.
                </p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="crp-ft">
                <span class="how-image how3"></span>
                <h4>Clean</h4>
                <p class="text-muted lh">
                    Sit back and relax, our cleaners will arrive at your scheduled time to clean your home to spotless perfection!
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  		What We Clean
	    </button>
        </div>
    </div>
</div>

@include('public.partials.guarantee-row')

<div class="faces-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5 text-center">
                <div class="white-padding">
                    <p>An honest clean</p>
                    <h3>Trusted Maids For Your Home</h3>
                    <p class="text-center-xs">At MaidSavvy we know that inviting someone into your home is a big deal.
                        All of our cleaners are carefully vetted before ever cleaning your home.
                    </p>
                    <p class="text-center-xs">We guarantee your maid will always be:</p>
                    <ul class="text-center-xs ul-none">
                        <li><i class="fa fa-check"></i> Experienced and professional</li>
                        <li><i class="fa fa-check"></i> Background checked</li>
                        <li><i class="fa fa-check"></i> English speaking</li>
                        <li><i class="fa fa-check"></i> Highly rated by other customers</li>
                    </ul>
                    <a class="btn btn-color" id="book-btn2" href="/booking/">Book Appointment&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ltgrey-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-1 col-sm-6">
                <h2 class="text-center-xs">Why MaidSavvy?</h2>
                <ul class="text-center-xs ul-none large-text">
                    <li><i class="fa fa-check"></i> Bonded and insured cleaners</li>
                    <li><i class="fa fa-check"></i> Flat rate cleaning</li>
                    <li><i class="fa fa-check"></i> No contracts or hidden fees</li>
                    <li><i class="fa fa-check"></i> Secure online payment</li>
                    <li><i class="fa fa-check"></i> Immediate booking confirmation</li>
                    <li><i class="fa fa-check"></i> 100% Satisfaction Guarantee</li>
                    <li><i class="fa fa-check"></i> Customer service 7 days a week</li>
                </ul>
            </div>
            <div class="col-md-5 col-sm-6 text-center">
                <h3>What customers have to say</h3>
                <div class="responsive-video">
                    <iframe src="http://player.vimeo.com/video/104265503?title=0&byline=0&portrait=0&color=ffffff&amp;wmode=transparent" width="538" height="303" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen
                        ></iframe>
                </div><!--//video-container-->
            </div>
        </div>
    </div>
</div>
<div class="container">
 
    <!-- Testimonials -->
    @include('public.partials.testimonials')
    
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn btn-color" id="book-btn2" style="margin-bottom:35px;" href="/booking/">Book Appointment&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>
<div class="purple-bg">
    <div class="container" style="color:#202020;">
	<div class="row">
        <div class="col-sm-10 col-sm-offset-1 well">
            <h3 class="oswald text-center">Some Of The Other Lovely Cities We Serve</h3>
            <hr>
            <div class="text-center"><strong>
            <div class="row">
                <div class="col-sm-3">
                    <p>Charlotte</p>
                </div>
                <div class="col-sm-3">
                    <p>Concord</p>
                </div>
                <div class="col-sm-3">
                    <p>Huntersville</p>
                </div>
                <div class="col-sm-3">
                    <p>Matthews</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p>Cornelius</p>
                </div>
                <div class="col-sm-3">
                    <p>Gastonia</p>
                </div>
                <div class="col-sm-3">
                    <p>Kannapolis</p>
                </div>
                <div class="col-sm-3">
                    <p>Ballantyne</p>
                </div>
            </div></strong>
            <div class="row">
                <br>
                <p>If you are looking for {{ $city }} NC maid service or a home or apartment cleaning service in {{ $city }} NC, you've come to the right spot. Our {{ $city }} residential cleaning, or our other cleaning services in and around {{ $city }} have been recognized for outstanding service. If you have any questions, you can chat with us live on the site, or use the contact for to contact us.</p>
            </div>
            </div>
        </div>
    </div>
    </div>
</div>
    
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h2 class="oswald text-center">Frequently Asked Questions</h2>
            <hr>
            @include('public.partials.faq')
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-color" id="book-btn2" style="margin-bottom:35px;" href="/booking/">Book Appointment&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>
    

</div><!-- // Container -->

</div> <!-- / wrapper -->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">What We Clean</h4>
      </div>
      <div class="modal-body">
                <h3>Kitchen</h3>
                <ul>
                    <li>Dust and wipe all surfaces</li>
                    <li>Clean the sink and wash the dishes</li>
                    <li>Clean the microwave and all appliances</li>
                    <li>Vacuum and/or mop floors</li>
                    <li>Removal of trash from bins and replace bin liners</li>
                    <li>Wipe kitchen surfaces, oven tops and knobs.</li>
                    <li>Clean outside of the fridge and oven</li>
                </ul>
                <h3>Bathrooms</h3>
                <ul>
                    <li>Dust and wipe surfaces</li>
                    <li>Clean the toilets</li>
                    <li>Clean showers and baths inside and out</li>
                    <li>Wipe inside of sinks to shining finish</li>
                    <li>Clean all mirrors and fixtures</li>
                    <li>Vacuum or mop floors</li>
                    <li>Removal of trash from bins and replace bin liners</li>
                    <li>Towels neatly hung</li>
                </ul>
                <h3>Bedrooms and General Areas</h3>
                <ul>
                    <li>Dust and wipe surfaces</li>
                    <li>Clean mirrors and fixtures</li>
                    <li>Vacuum or mop floors</li>
                    <li>Removal of trash</li>
                    <li>Make the bed and change the sheets</li>
                    <li>Neatly fold any lose clothes</li>
                    <li>Wiping chairs and tables</li>
                </ul>
                <h3>What we can't do*</h3>
                <ul>
                    <li>Cleaning of exterior windows</li>
                    <li>Changing/wiping lightbulbs</li>
                    <li>Carpet cleaning</li>
                    <li>Animal waste removal</li>
                    <li>Gardening and garden shed cleaning</li>
                    <li>Patio cleaning</li>
                    <li>Mold removal</li>
                    <li>Industrial cleaning</li>
                    <li>The lifting of heavy furniture</li>
                    <li>Cleaning surfaces above arms reach</li>
                    <li>Inside oven or fridge unless explicitly requested</li>
                </ul>
                <p><b>*Due to safety, insurance and other reasons.</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="footer-wrapper"> <!-- footer wrapper -->
    <div class="container">
        <footer class="footer-main">
            <ul class="list-inline pull-left">
                <li><a href="{{url('faqs')}}">About Us</a></li>
                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                <li><a href="{{url('terms')}}">Terms and Conditions</a></li>
                <li><a href="{{url('contact-us')}}">Contact Us</a></li>
            </ul>
            <span class="pull-right-xs text-muted">&copy; 2014 MaidSavvy</span>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Cities We Serve</h3>
                    <p>Charlotte, NC; Fort Mill, SC; Concord, NC; Indian Trail, NC; Huntersville, NC; Mount Holly, NC; Matthews, NC;
                        Cornelius, NC; Davidson, NC; Gastonia, NC; Kannapolis, NC </p>
                    <p>Uptown; Myers Park; Ballantyne; South End; Dilworth; NoDa; Plaza-Midwood; Sherwood Forest; Eastland; Marvin, Stonecrest, Blakeney, and Waxhaw,
                    </p>
                </div>
            </div>
        </footer>
    </div> <!-- /container -->
</div> <!-- / footer wrapper -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('assets/bootstrap/js/jquery.min.js') }}
{{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('js/custom.js') }}
{{ HTML::script('js/scrolltopcontrol.js') }}

</body>
</html>