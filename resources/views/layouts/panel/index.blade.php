<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/msg.css') }}">

	@yield('styles')
</head>
<body>
@include('partials.header')

@yield('banner')

<div class="container">
	<div class="row">

		<div class="col-md-3">
			
			@include('partials.sidebar')

		</div>
	
		<div class="col-md-9">
	
			@include('partials.profileHeader')
			@yield('headerButtons')
			@yield('content')
	
		</div>

	</div>
</div>

<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('src/bootstrap/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::to('src/js/functions.js') }}"></script>
<script src="{{ URL::to('src/js/jquery.jscroll.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
    	$(".clickable-row").click(function() {
        	window.location = $(this).data("href");
    	});
	});
</script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="{{URL::to('images/gifs')}}/loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@yield('scripts')
</body>
</html>