<!DOCTYPE html>
<html lang="en">
<head>
	<title>Talkshow</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ mix('css/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ mix('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ mix('css/main.css') }}">
	<!-- Scripts -->
<!--===============================================================================================-->
</head>

<body>

@yield ('content')

<!--===============================================================================================-->
<script src="{{ mix('js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ mix('js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ mix('js/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ mix('js/tilt.jquery.min.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

</body>
</html>