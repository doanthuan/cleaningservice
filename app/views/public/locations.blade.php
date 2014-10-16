@extends('layouts.public')

@section('content')

<div class="wrapper"> <!-- wrapper -->
    <div class="container">
       <div class="col-sm-10 col-sm-offset-1">
        <div class="row">
            <div class="col-sm-12">
                <h3>Where We Serve</h3>
                <p>We serve all homes and apartments within a 25 mile radius of Charlotte, NC. If you aren't sure if your home is covered please call or email us!</p>
                <div style="overflow:hidden;height:300px;width:100%;">
                    <div id="gmap_canvas" style="height:300px;width:100%;"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center animated fadeInDown">Because who doesn't like to come home to a clean home?</h2>
                <p>Give us a call or book online, we serve all of the Charlotte area. Enter your zip code below to find out if we can make your home beautiful.</p>
                @include('public.partials.zip-row')
                
            </div>
        </div>
        </div>
    </div><!-- // Container -->

</div> <!-- / wrapper -->

@section('footer')
@parent
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript"> function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(35.19960100000001,-80.86806200000001),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(35.19960100000001, -80.86806200000001)});infowindow = new google.maps.InfoWindow({content:"<b>Charlotte Maids</b><br/>2820 South Blvd<br/>28209 Charlotte, NC" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
@stop
@stop