<!DOCTYPE html>
<html lang="ar">
	<head>
    @include('web._master.ar.header')
        @yield('header')
	</head>
	<body>
		<!-- navbar -->
        @include('web._master.ar.nav')
        @yield('header')
        
        @yield('content')



        @include('web._master.ar.footer')
        @yield('header')
        </body>
    </html>