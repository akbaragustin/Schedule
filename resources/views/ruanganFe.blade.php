@extends('layouts.indexFrontend')
@section('content')
@section('header')
	<link rel="stylesheet" href="{{ URL::asset('') }}assets/headerFe/demo.css">
	<link rel="stylesheet" href="{{ URL::asset('') }}assets/headerFe/header-basic-light.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
@endsection
</head>
<body style="background-color:#fff">
<header class="header-basic-light">

	<div class="header-limiter">

		<h1><a href="#">Puskim<span>PU</span></a></h1>

		<nav>
			<a href="{{url(route('frontend'))}}" >Internal</a>
			<a href="{{url(route('ruanganFe'))}}"class="selected">Jadwal Ruangan</a>
			<a href="{{url(route('eselon_kapus'))}}">Eselon & Kapus</a>
		</nav>
	</div>

</header>

<div class="row" style="padding-right:18px;padding-left:18px">
<div class="col-xs-12">
	<div class="pull-right" style="padding-right:20px;padding-top:15px">
	    <a href="#">
		 <button type="button" class="btn btn-info waves-effect edit-menu" data-toggle="modal" data-target="#filter">Filter</button>
	    </a>
	</div>
	<h3 class="header smaller lighter blue">Ruangan</h3>
	<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
	</div>
<table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
	<thead>
		<tr>
			<th>Ruangan</th>
			<th>Kapasitas</th>
			<th>Status</th>
			<th>Keterangan</th>
			<th>Waktu</th>
		</tr>
	</thead>

</table>

	</div>
</div>
<!-- Modal -->
 <div class="modal fade" id="filter" role="dialog">
   <div class="modal-dialog">

	 <!-- Modal content-->
	 <div class="modal-content">
	   <div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal">&times;</button>
		 <h4 class="modal-title">Modal Header</h4>
	   </div>
	   <div class="modal-body">
		   <form class="form-horizontal" role="form" method="POST" action="{{url(route('kapus.save'))}}">
   				<div class="form-group">
   				<label class="col-sm-3 control-label no-padding-right" for="form-field-1" id ="start_data">Waktu Mulai</label>

   				<div class="col-sm-9">
   					<input type="text" id="form-field-1" placeholder="waktu Mulai" class="col-xs-10 col-sm-5 datepicker" name="start_tgl_rapat" value="{{!empty($start_tgl_rapat) ? $start_tgl_rapat : date('d-m-Y H:i A')}}" />
   				</div>
   			</div>
   			<div class="form-group">
   				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu Akhir</label>

   				<div class="col-sm-9">
   					<input type="text" id="form-field-1" placeholder="Waktu Akhir" class="col-xs-10 col-sm-5 datepicker1" name="end_tgl_rapat" value="{{!empty($end_tgl_rapat) ? $end_tgl_rapat : date('d-m-Y H:i A') }}" />
   				</div>
   			</div>
	   </div>
	   <div class="modal-footer">
		   <button class="btn btn-info ajaxSearch" type="button">
			   <i class="ace-icon fa fa-check bigger-110"></i>
			   Search
		   </button>
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	   </div>
	 </div>

   </div>
 </div>
</body>

</html>
<style>
	.daterangepicker{
		z-index: 10000;
	}
	.header-basic-light {
		box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.15);
	}
	.header{
		border-bottom: none;
	}
	html{
		background-color:#fff;
	}
</style>

@section('js')
<script type="text/javascript">
var urlAjaxTable = "{{ URL::to(route('frontend.indexAjaxRuangan')) }}";
var listTable = $('.listTable').DataTable( {
	"processing": true,
	"bFilter": false,
	"bInfo": false,
	"bLengthChange": false,
	"serverSide": true,
	"ajax": {
		 "url": urlAjaxTable,
		 "type": "GET",
	 },
	 "columns": [
		{ "data": "ruangan" },
		{ "data": "kapasitas" },
		{ "data": "status" },
		{ "data": "keterangan" },
		{ "data": "waktu"  },
	],
	"buttons": [
	   {
		   extend: 'collection',
		   text: 'Export',
		   buttons: [
			   'copy',
			   'excel',
			   'csv',
			   'pdf',

		   ]
	   }
   ]
});
$('.datepicker').daterangepicker({
			locale :{
				format : 'DD-MM-YYYY HH:mm A'
			},
			timePicker :true,
			singleDatePicker :true,
			showDrodowns :true,
			ampm: true,

});
$('.datepicker1').daterangepicker({
			locale :{
				format : 'DD-MM-YYYY HH:mm A'
			},
			timePicker :true,
			singleDatePicker :true,
			showDrodowns :true,
			ampm: true,

});
$('.ajaxSearch').click(function () {
	$('#filter').modal('hide');
	var waktuM = $('.datepicker').val();
	var waktuA = $('.datepicker1').val();
	$('.listTable').DataTable( {
		"processing": true,
		"bFilter": false,
		"bInfo": false,
		"bLengthChange": false,
		"serverSide": true,
		"ajax": {
			 "url": urlAjaxTable,
			 "type": "GET",
			 "data" : {
				 waktuM : waktuM,
				 waktuA : waktuA
			 }
		 },
		 "columns": [
			{ "data": "ruangan" },
			{ "data": "kapasitas" },
			{ "data": "status" },
			{ "data": "keterangan" },
			{ "data": "waktu"  },
		],
		"buttons": [
		   {
			   extend: 'collection',
			   text: 'Export',
			   buttons: [
				   'copy',
				   'excel',
				   'csv',
				   'pdf',

			   ]
		   }
	   ],
	     "destroy" : true
	});
});
</script>
@endsection
@stop
