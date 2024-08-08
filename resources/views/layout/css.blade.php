<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta name="Description" content="Jop Plus">
		<meta name="Author" content="University AlSham">
		<meta name="Keywords" content="Admin Dashboard,Jop Plus"/>

		<!-- Title -->
		<title>  dashboard Jop Plus </title>

		<!-- Favicon -->
		<link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>

		<!-- Icons css -->
		<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">

		<!--  Owl-carousel css-->
		<link href="{{asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />

		<!--  Custom Scroll bar-->
		<link href="../../assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>

		<!--  Right-sidemenu css -->
		<link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

		
		<!-- Maps css -->
		<link href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">

		
		{{-- <link href="{{asset('assets/css/style-dark.css')}}" rel="stylesheet"> --}}

		
		<!-- Internal Data table css -->
		<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

		<!--- Animations css-->
		<link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
		<!-- ********************************************************************-->

		@if (App::getLocale() == 'ar')
		
			<!-- Sidemenu css -->
			<link rel="stylesheet" href="{{asset('assets/css-rtl/sidemenu.css')}}">
			<!--- Style css --->
			<link href="{{asset('assets/css-rtl/style.css')}}" rel="stylesheet">
			<!---Skinmodes css-->
			<link href="{{asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />

		@else

			<!-- Sidemenu css -->
			<link rel="stylesheet" href="{{asset('assets/css/sidemenu.css')}}">
			<!-- style css -->
			<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
			<!---Skinmodes css-->
			<link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />


		@endif
		
		

		<!--- Dark-mode css --->
		{{-- <link href="../../assets/css-rtl/style-dark.css" rel="stylesheet"> --}}