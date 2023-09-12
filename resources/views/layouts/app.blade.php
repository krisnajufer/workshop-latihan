<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
    <title>Admin | @yield('title')</title>
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('includes.navbar')

        @include('includes.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('includes.footer')
    </div>
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
</body>

</html>
