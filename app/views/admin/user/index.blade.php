@extends('admin.layouts.admin')

@section('content')

{{ (new \App\Blocks\Admin\Grid\User())->toHtml() }}

@stop