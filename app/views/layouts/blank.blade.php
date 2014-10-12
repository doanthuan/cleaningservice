<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('partial.head')
</head>
<body>
    @include('partial.header')

    <div id="content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @include('partial.footer')
</body>
</html>
