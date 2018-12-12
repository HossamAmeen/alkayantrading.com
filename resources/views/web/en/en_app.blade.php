<!DOCTYPE html>
<html lang="ar">
	<head>
        @include('web._master.en.header')
        @yield('header')
	</head>
	<body>
		<!-- navbar -->
        @include('web._master.en.nav')
        @yield('header')
        
        @yield('content')


        @include('web._master.en.footer')
        @yield('header')
    </body>
</html>