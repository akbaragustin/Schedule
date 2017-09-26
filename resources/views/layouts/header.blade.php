<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Admin</title>
		 <link rel="icon" href="{{ URL::asset('') }}assets/images/favicon/k.png" type="image/x-icon">

		<meta name="description" content="with draggable and editable events" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}plugins/select2/css/select2.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/fullcalendar.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ URL::asset('') }}assets/js/ace-extra.min.js"></script>

 	    <link rel="stylesheet" href="{{ URL::asset('') }}plugins/swall/sweetalert.css">

    <!-- Google Fonts -->
    <link href="{{ URL::asset('') }}plugins/fonts/fonts.googleapis.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('') }}plugins/fonts/icon.css" rel="stylesheet" type="text/css">


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		@yield('header')
	</head>
