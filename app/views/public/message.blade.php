@extends('layouts.public')

@section('head')
@parent
{{ HTML::style('css/style.css') }}
@stop

@section('content')

<div class="container">
    <div class="message-container">
        @include('layouts.partials.message')
    </div>
</div>

<script>
    window.setTimeout(function() {
        location.href = '{{url('/')}}';
    }, 5000);
</script>
@stop