<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todo App</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	
</head>
<body>
	<!-- Header -->
	<header></header>

	<!-- content -->
	<div class="content">
		
		@yield('content')

	</div>

	<!-- footer -->
	<footer></footer>
</body>
</html>