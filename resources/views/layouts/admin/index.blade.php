<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/footer.css') }}">

	@yield('styles')
</head>
<body>
@include('partials.header')

@yield('banner')

<div class="container">
	<div class="row">

		<div class="col-md-3">
			
			@include('partials.adminsidebar')

		</div>
	
		<div class="col-md-9">
	
			@include('partials.profileHeader')
			@yield('headerButtons')
			@yield('content')
	
		</div>

	</div>
</div>

@include('partials.footer')

<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('src/js/functions.js') }}"></script>
<script type="text/javascript"> 
$('.newsletter-send').click(function(event)
{
    var $this = $(this);
    $this.button('loading');
});
</script>
@yield('scripts')
</body>
</html>