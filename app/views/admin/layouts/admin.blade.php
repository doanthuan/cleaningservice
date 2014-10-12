<!DOCTYPE html>
<head>
    @include('admin.layouts.partials.head')
</head>
<body>
@include('admin.layouts.partials.header')

    <div id="content">
        <div class="container">
            @include('admin.layouts.partials.message')
            {{$toolbar}}
            @yield('content')
        </div>
    </div>

@include('admin.layouts.partials.footer')
</body>
</html>
