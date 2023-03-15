<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title')</title>
    @include('layouts.dashboard.header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">



        @include('layouts.dashboard.navbar')
        @include('layouts.dashboard.sidebar')
        @yield('content')
        <!-- ./wrapper -->
    </div>
    @yield('script')
    @include('layouts.dashboard.footer')
</body>

</html>
