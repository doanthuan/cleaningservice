@extends('layouts.public')

@section('head')
@parent
{{ HTML::style('css/style.css') }}
@stop

@section('content')

<div class="wrapper"> <!-- wrapper -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2>Thank you for feedback!</h2>
                <hr>
                <p>We take reviews very seriously at MaidSavvy because it is the best way for us to ensure amazing service to all of our customers. If there is anything we can do to improve your cleaning, please let us know through our <a href="http://maidsavvy.com/contact-us">contact page</a></p>
                
                <p>Our mission is to provide you the best cleaning and amazing customer service. Unfortunately there are many companies who don't share our philosophy. Online reviews help let others know how we put you first. </p>
                
                <p>We would love if you would let others know about MaidSavvy by writing a quick review on yelp! <a href="http://yelp.com"><b>Please Click Here</b></a></p>

		<p>Thanks,<br>MaidSavvy Team</p>
            </div>
        </div>
    </div>
</div> <!-- / wrapper -->

@stop