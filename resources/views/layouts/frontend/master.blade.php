<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.header')
</head>

<body>
    @include('layouts.frontend.navbar ')
    @yield('content')
    @include('layouts.frontend.footer')
    @yield('script')
</body>

</html>
