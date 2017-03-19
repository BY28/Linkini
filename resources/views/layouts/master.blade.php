<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/sidebar.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/tags.css') }}">

	@yield('styles')
</head>
<body>
@include('partials.header')

@yield('banner')
@yield('sidebar')

<div class="container">
	@yield('content')
</div>

<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('src/js/functions.js') }}"></script>
<script src="{{ URL::to('src/js/tags.js') }}"></script>
@yield('scripts')
</body>
</html>