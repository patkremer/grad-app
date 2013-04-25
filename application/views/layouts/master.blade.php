<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MSU-Denver Grad App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Online graduation application prototype. Final project for a class.">
	<meta name="content" content="">
	<meta name="author" content="Patrick Kremer">
	  {{ HTML::style('css/bootstrap.css') }}
	  {{ HTML::style('css/style.css') }}
	<!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="span12 subhead">
					<h1>MSU-Denver Graduation Application</h1>
				</div>
			</div>
		</div>
	</header>
	
	<div class="container">
		<div class="row info">
			<div class="span12">
				@if(Session::has('message'))
	                <div class="alert alert-success">
	                    <button type="button" class="close" data-dismiss="alert">&times;</button>
	                    <p class="text-center">{{ Session::get('message') }}</p>
	                </div>
	            @endif
	            @if(Session::has('error'))
	                <div class="alert alert-error">
	                    <button type="button" class="close" data-dismiss="alert">&times;</button>
	                    <p class="text-center">{{ Session::get('error') }}</p>
	                </div>
	            @endif
            </div>
        </div>

		@yield('content')
	</div>
	{{ HTML::script('js/jquery.js') }}  
 	{{ HTML::script('js/bootstrap.js') }}
 	@yield('scripts')
</body>
</html>