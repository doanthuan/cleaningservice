@extends('layouts.public')

@section('content')

<div class="wrapper"> <!-- wrapper -->
<div class="crp-showcase">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center animated fadeInDown">Book a trusted cleaner in 60 seconds</h1>
                <h3 class="text-center animated fadeInDown">Because who doesn't like to come home to a clean home?</h3>
                <div class="text-center actions animated fadeInDown delay2">
                    <a class="btn btn-color" href="booking.php">Book Now</a>
                </div>
                <!--<a href="index-alt.html" class="alt-index hidden-xs">
                  <img src="img/browser.png" alt="...">
                </a>-->
            </div>
        </div>
    </div>
</div>
<div class="container spacer-margin">
    <!-- Description -->
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <h2 class="oswald">Choose your ideal cleaning, book online, relax</h2>
            <h4 class="oswald">No quotes, estimates or phone tag</h4>
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
            <a class="center btn btn-primary btn-lg" href="pricing.php">What We Clean</a>
        </div>
    </div>
</div>
<hr>
<div class="row zipcodeform">
    <div class="col-sm-12 text-center">
        <h2>Book a house cleaning in 60 seconds</h2>
    </div>
    <form class="form-inline" role="form" action="check_zip.php" method="post">
        <div class="col-sm-3 col-sm-offset-3">
            <div class="form-group" style="width:100%;">
                <label class="sr-only" for="zipcode">Zip Code</label>
                <input type="text" class="form-control" id="zipcode" name='zip' placeholder="Zip Code" maxlength="5" style="font-size:32px; height:60px;">
            </div>
        </div>
        <div class="col-sm-3">
            <button class="btn btn-success btn-large" style="font-size:32px; width:100%; height:60px;" type="submit">Check!</button>
        </div>
    </form>
</div>
<div class="purple-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-3">
                        <img src="img/trust.png" alt="Homejoy House Cleaning Happy Homes Guarantee" class="img-responsive">
                    </div>
                    <div class="col-xs-9">
                        <h2 class="text-center-xs">Full Service Guarantee</h2>
                        <p>We believe customer satisfaction is the foundation of any successful business. If you aren't satisfied with any part of your cleaning, we will provide a refund</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="faces-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5 text-center">
                <div class="white-padding">
                    <p>An honest clean</p>
                    <h3>Trusted Maids For Your Home</h3>
                    <p class="text-center-xs">At MaidSavvy we know that inviting someone into your home is a big deal.
                        All of our cleaners are carefully vetted before ever cleaning a clients home.
                    </p>
                    <p class="text-center-xs">We guarantee your maid will always be:</p>
                    <ul class="text-center-xs ul-none">
                        <li><i class="fa fa-check"></i> Experienced and professional</li>
                        <li><i class="fa fa-check"></i> Background checked</li>
                        <li><i class="fa fa-check"></i> English speaking</li>
                        <li><i class="fa fa-check"></i> Highly rated by other customers</li>
                    </ul>
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
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <br>
            <h2 class="oswald text-center">What Clients Say About Us</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="review">
                <img src="img/people-2.png" alt="...">
                <div class="review-text">
                    <h3 class="text-color">Excellent Work!</h3>
                    <p class="quote text-muted">
                        <em>Used MaidSavvy for the first time last week - our 2 bedroom apartment really needed a deep scrubbing, and my oven practically needed to be exorcised.<br>
                            I loved the online scheduling, and I ADORE the fact that they do cleanings on the weekends - it makes it so much easier for us, since we have to get our doggie out of the house during maid service (and it's better to take him for a long walk than to board him).<br>
                            Everything looked and smelled great when they were done, and the whole experience was seamless and easy.</em>
                    </p>
                    <p class="text-muted">
                        &#x2015; <strong>Lisa B.</strong>; South End, Charlotte
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="review">
                <img src="img/people-3.png" alt="...">
                <div class="review-text">
                    <h3 class="text-color">Amazing Experience</h3>
                    <p class="quote text-muted">
                        <em>I've been a maids in black user for more than a year and they've always done a great job, but after yesterday's cleaning with Jacqueline's team I just had to write a review.<br>
                            They went above and beyond, - every nook and cranny was cleaned, the towels were arranged throughout the house. They even remade the beds. On top of the very thorough cleaning, the team was very friendly and pleasant. They even played with my son!<br>
                            If you're looking for a cost-effective service that will give you the most for your money, this is it.</em>
                    </p>
                    <p class="text-muted">
                        &#x2015; <strong>Keri C.</strong>; Charlotte, NC
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="review">
                <img src="img/client-3.jpg" alt="...">
                <div class="review-text">
                    <h3 class="text-color">I Simply Love It</h3>
                    <p class="quote text-muted">
                        <em>We've been using this company to clean our place once a month for about the past six months.  The service has been consistently good -- on time and thorough.<br>
                            The best part is the ease of scheduling and payment.  We had another maid service that we used, but they were constantly trying to schedule us at THEIR convenience, rather than ours, and canceling or changing appointments, which drove us nuts.  And, they had no e-mail or text messaging.<br>
                            With MaidSavvy, everything is done very easily via e-mail, which is perfect.</em>
                    </p>
                    <p class="text-muted">
                        &#x2015; <strong>Graham C.</strong>; Matthews, NC
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- // Testimonials -->
    <hr>
    <div class="row zipcodeform">
        <div class="col-sm-12 text-center">
            <h2>Book a house cleaning in 60 seconds</h2>
        </div>
        <form class="form-inline" role="form" action="check_zip.php" method="post">
            <div class="col-sm-3 col-sm-offset-3">
                <div class="form-group" style="width:100%;">
                    <label class="sr-only" for="zipcode">Zip Code</label>
                    <input type="text" class="form-control" id="zipcode" name='zip' placeholder="Zip Code" maxlength="5" style="font-size:32px; height:60px;width: 100%;">
                </div>
            </div>
            <div class="col-sm-3">
                <button class="btn btn-success btn-large" style="font-size:32px; width:100%; height:60px;" type="submit">Check!</button>
            </div>
        </form>
    </div>

</div><!-- // Container -->

</div> <!-- / wrapper -->
<div class="purple-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-3">
                        <img src="img/trust.png" alt="Homejoy House Cleaning Happy Homes Guarantee" class="img-responsive">
                    </div>
                    <div class="col-xs-9">
                        <h2 class="text-center-xs">Full Service Guarantee</h2>
                        <p>We believe customer satisfaction is the foundation of any successful business. If you aren't satisfied with any part of your cleaning, we will provide a refund</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="basic-modal-content">
    <div class="row email_coupon">
        <div class="email_form_wrapper">
            <form class="form-inline" role="form" id="email_form">
                <div class="col-xs-8">
                    <div class="form-group" style="width:100%;">
                        <label class="sr-only" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name='email' placeholder="Best Email" style="font-size:32px; height:60px; ">
                    </div>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-success btn-large" style="font-size:32px; width:100%; height:60px;" type="submit" id="coupon_submit">Get $20 Credit</button>
                </div>
            </form>
        </div>
        <div class="email_form_wrapper2 text-center">
            <p style="font-size:32px; height:60px;">Great! Please use the code: <b>20OFFTODAY</b></p>
        </div>
    </div>
</div>


@section('footer')
@parent

<script async src="js/mCustomScrollbar.js"></script>
<script async type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script>
    var cookie_length = 1;

    function setCookie(c_name,value,exdays) {
        var exdate=new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value=escape(value) + ((exdays===null) ? "" : "; expires="+exdate.toUTCString());
        document.cookie=c_name + "=" + c_value;
    }

    function getCookie(c_name) {
        var i,x,y,ARRcookies=document.cookie.split(";");
        for (i=0;i<ARRcookies.length;i++) {
            x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
            y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
            x=x.replace(/^s+|s+$/g,"");
            if (x==c_name) {
                return unescape(y);
            }
        }
    }
    function showPop(){
        $('html').one("mouseleave", function() {
            $('.email_form_wrapper2').hide();
            $('#basic-modal-content').modal();
        });
    }

    var show = getCookie("diyrvcooke");

    if($( document ).width() >= 800) { //only load when over 800 px
        if(show===undefined) { //show will be undefined the first time before a cookie is set.
            setCookie('diyrvcooke','1',cookie_length);
            showPop(); //show popup here
        }
    };
    $( "#coupon_submit" ).click(function() {
        $('.email_form_wrapper').hide();
        $('.email_form_wrapper2').show();

    });
</script>
<script>//need to load custom sidebar so the modal won't fire when scrolling. Only load sidebar when width > 800px
    if($( document ).width() >= 800) {
        (function($){
            $(window).load(function(){
                $("body").mCustomScrollbar({
                    theme:"dark",
                    scrollInertia:350
                });

            });
        })(jQuery)
    };
</script>
@stop



@stop