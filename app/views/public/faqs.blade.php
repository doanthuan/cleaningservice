@extends('layouts.public')

@section('content')
<div class="wrapper"> <!-- wrapper -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <br />
                <h4>Frequently Asked Questions</h4>
                <hr>
                @include('public.partials.faq')
            </div>
            @include('public.partials.zip-sidebar')
        </div>
    </div>
</div> <!-- / wrapper -->



@stop