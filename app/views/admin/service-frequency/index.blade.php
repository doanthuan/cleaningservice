@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\ServiceFrequency())->toHtml() }}

@stop
