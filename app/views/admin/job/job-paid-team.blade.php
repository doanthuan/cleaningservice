@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\JobPaidTeam())->toHtml() }}

@stop
