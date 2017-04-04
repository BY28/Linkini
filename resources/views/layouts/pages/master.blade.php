<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/font-awesome/css/font-awesome.min.css') }}">
	@yield('styles')
</head>
<body id="page-top">


	
@yield('header')

@yield('banner')

@yield('content')

@yield('footer')



<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap.min.js') }}"></script>

@yield('scripts')

</body>
</html>