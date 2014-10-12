@section('header')
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="pull-left hidden-xs">
                    <h1>MaidSavvy: Charlotte's Cleaning Services &amp; House Cleaning</h1>
                </div>
                <div class="pull-right">
                    <p>
                        @if(!Auth::check())
                        <a href="{{url('customer/login')}}">Login</a>
                        @else
                        <a href="{{url('customer/profile')}}">My Account</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{url('customer/logout')}}">Logout</a>
                        @endif
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{url('giftcard')}}">GiftCard</a>
                        &nbsp;&nbsp;&nbsp; Customer Service  •  (800) 737-4802  •  hello@maidsavvy.com</p>
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
            <a class="navbar-brand logo" href="{{url('')}}"><img id="logo" class="img-responsive" src="{{url('img/MaidSavvy_Logo2.png')}}"/></a>
        </div>
        <div class="navbar-collapse collapse pull-right-sm">
            <ul class="nav navbar-nav">
                <li><a href="{{url('faqs')}}">Help</a></li>
                <li><a href="{{url('locations')}}">Locations</a></li>
                <li class="hidden-sm"><a href="{{url('pricing')}}">Our Services</a></li>
                <li><a href="{{url('contact-us')}}">Contact Us</a></li>
            </ul>
            <div class="pull-right-sm">
                <a href="{{url('booking')}}" class="btn btn-primary booking-btn">Book In 60 Secs <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>

@show