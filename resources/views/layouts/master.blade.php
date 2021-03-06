<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/msg.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/sidebar.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/tags.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/footer.css') }}">


	@yield('styles')
</head>
<body>

<div id="wrapper">
	
@include('partials.header')

@yield('banner')
@yield('sidebar')

<div class="container">
	@yield('content')
</div>
@yield('addContent')

@include('partials.footer')

</div>

<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('src/js/jquery.jscroll.min.js') }}"></script>
<script src="{{ URL::to('src/js/functions.js') }}"></script>
<script src="{{ URL::to('src/js/tags.js') }}"></script>
<script type="text/javascript"> 
$('.newsletter-send').click(function(event)
{
    var $this = $(this);
    $this.button('loading');
});
</script>
@if($errors->has('email') OR $errors->has('password'))

<script type="text/javascript">
	$(document).ready(function(){
    	$("#connection-section").addClass('open');
    	$("#connection-dropdown").setAttribute('aria-expanded', 'true');
	});
</script>

@endif

@yield('scripts')

</body>
</html>