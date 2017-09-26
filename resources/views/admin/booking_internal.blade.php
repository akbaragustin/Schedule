	@extends('layouts.index')
	@section('content')
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-header">
                            <h1>
                                Form Booking Rapat Internal
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@if(!empty($id_rapat))
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('booking_internal.update'))}}">@else
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('booking_internal.save'))}}">
								@endif
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Agenda Rapat</label>

									<div class="col-sm-9">
										<input type="text" id="form-field-1" placeholder="Agenda Rapat" class="col-xs-10 col-sm-5" name="agenda_rapat" value="{{!empty($agenda_rapat) ? $agenda_rapat : ''}}" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">PIC/Pelaksana</label>

									<div class="col-sm-9">
										<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5" name="pj_rapat" value="{{!empty($pj_rapat) ? $pj_rapat : ''}}" />
									</div>
								</div>

									<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu Mulai</label>

									<div class="col-sm-9">
										<input type="text" id="form-field-1" placeholder="waktu Mulai" class="col-xs-10 col-sm-5 datepicker" name="start_tgl_rapat" value="{{!empty($start_tgl_rapat) ? $start_tgl_rapat : ''}}" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu Akhir</label>

									<div class="col-sm-9">
										<input type="text" id="form-field-1" placeholder="Waktu Akhir" class="col-xs-10 col-sm-5 datepicker1" name="end_tgl_rapat" value="{{!empty($end_tgl_rapat) ? $end_tgl_rapat : ''}}" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Status </label>

									<div class="col-sm-9">
										<select name="status_ruangan_rapat" class="col-xs-10 col-sm-5 status" >
											<option value="" >Masukan Status</option>
											<?php
											$internal ="";
											$external ="";
											if (!empty($status_ruangan_rapat)) {
												if ($status_ruangan_rapat == 'internal') {
													$internal = 'selected';
												}else{
													$external = 'selected';
												}
											}


											 ?>
											<option value="internal" <?php echo $internal; ?> >Intenal</option>
											<option value="external" <?php echo $external; ?> >External</option>
										</select>
									</div>

								</div>
								<?php
								$hidden ="";
								$hiddenT ="";
								if (empty ($id_ruangan)){
									$hidden ="hidden";

								}

								if (empty ($tempat_rapat)){
									$hiddenT ="hidden";

								}


								 ?>
								<div class="form-group {{$hiddenT}} block-tempat">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tempat</label>
									<div class="col-sm-9">
										<input type="text" id="form-field-1" placeholder="Tempat" class="col-xs-10 col-sm-5" name="tempat_rapat" value="{{!empty($tempat_rapat) ? $tempat_rapat : ''}}" />
									</div>
								</div>

								<div class="form-group {{$hidden}} block-ruangan">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ruangan</label>
									<div class="col-sm-9">
									<select name="ruangan_rapat" class="col-xs-10 col-sm-5">
										<option value="">Masukan Ruangan</option>
									<?php

										foreach ($allRuangan as $key => $value) {
												$selected ="";
												if (!empty ($id_ruangan)) {
													if ($id_ruangan == $value['id_ruangan']) {
														$selected ="selected";
													}
												}
											echo "<option value=".$value['id_ruangan']." ".$selected.">".$value['name_ruangan']."<small> (".$value['max_ruangan'].")</option>";
										}

										 ?>


									</select>
									<a href="#" id="showRuangan" >
										<i class="material-icons">remove_red_eye</i>
										<small>lihat data ruangan</small>
									</a>
								  </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Infant</label>

									<div class="col-sm-9">

									<select name="name_infant[]" class ="js-example-tokenizer form-control select2-hidden-accessible col-xs-10 col-sm-5 infant" style="width:400px"  multiple="multiple">
										<?php
											if (!empty($name_infant)) {
											foreach ($name_infant as $key => $value) {
												foreach ($value as $k => $v) {
												echo  "<option value ='".$v->disposisi_rapat."' selected='selected'>".$v->disposisi_rapat."</option>";
													}
												}
											}
										 ?>

									</select>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Infant Eselon</label>

								<div class="col-sm-9">
								<select class="col-xs-10 col-sm-5 products" name="infant_eselon[]" data-tags="false" data-placeholder="Select an option">
								<?php
								echo "<option value=''></option>";
								foreach ($name_pic as $key => $value) {
									$selected ="";
										if (!empty($infant_eselon)) {
										foreach ($infant_eselon as $keys => $values) {
											foreach ($values as $k => $v) {
												if ($v->id_user == $value['id_user']) {
													$selected ="selected";
												}

										}
									}

									}

									echo "<option value = ".$value['id_user']." ".$selected.">".$value['name_pic']."</option>";
								}


								 ?>
							 </select>
							 </div>
							</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pejabata Yang Diundang </label>

									<div class="col-sm-9">

									<select name="disposisi_rapat[]" class ="js-example-tokenizer form-control select2-hidden-accessible col-xs-10 col-sm-5" style="width:400px"  multiple="multiple">
										<?php
											if (!empty($disposisi_rapat)) {

											foreach ($disposisi_rapat as $key => $value) {
												foreach ($value as $k => $v) {

												echo  "<option value ='".$v->disposisi_rapat."' selected='selected'>".$v->disposisi_rapat."</option>";
													}
												}

											}


										 ?>

									</select>
								</div>
							</div>
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pejabat Yang Diundang Eselon</label>

							<div class="col-sm-9">

							<select class="col-xs-10 col-sm-5 products1" id="" name="undang_eselon[]" data-tags="false" data-placeholder="Select an option">
							<?php
							echo "<option value=''></option>";
							foreach ($name_pic as $key => $value) {
								$selectedU ="";
										if (!empty($undang_eselon)) {

										foreach ($undang_eselon as $keys => $values) {
											foreach ($values as $k => $v) {
												if ($v->id_user == $value['id_user']) {
													$selectedU ="selected";
												}

										}
									}

									}

								echo "<option value = ".$value['id_user']." ".$selectedU.">".$value['name_pic']."</option>";
							}


							 ?>
						 </select>
						 </div>
						</div>

									<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<!-- <input type="submit" name="simpan"> -->

								<div class="clearfix form-actions">
									@if(!empty($id_rapat))
									<input type="hidden" name="update" value="{{$id_rapat}}">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Edit
										</button>
									@else
										<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Submit
										</button>
									@endif
										&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											Reset
										</button>
									</div>
								</div>



								</form>


						<div class="row">
									<div class="col-xs-12">
										<div class="pull-right" style="padding-right:20px;padding-top:5px">
											<a href="#">
											 <button type="button" class="btn btn-info waves-effect edit-menu modalFilterKapus">Filter</button>
											</a>
										</div>
										<h3 class="header smaller lighter blue">Data Rapat Booking internal</h3>

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
		                        <thead>
		                            <tr>
		                                <th>Agenda</th>
		                                <th>Waktu Mulai</th>
		                                <th>Waktu Akhir</th>
		                                <th>Status</th>
		                                <th>Tempat</th>
		                                <th>Detail</th>
		                                <th>Action</th>
		                            </tr>
		                        </thead>

		                    </table>
						</div>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>

	<!-- Modal -->
     <div class="modal fade filterKapus" role="dialog">
       <div class="modal-dialog">
    	 <!-- Modal content-->
    	 <div class="modal-content">
    	   <div class="modal-header">
    		 <button type="button" class="close" data-dismiss="modal">&times;</button>
    		 <h4 class="modal-title">Modal Header</h4>
    	   </div>
    	   <div class="modal-body">
    		   <form class="form-horizontal" role="form" method="POST" action="">
       			<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agenda </label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Agenda" class="col-xs-10 col-sm-5 agenda_rapatKapus" name="agenda_rapat" value="" />
       				</div>
       			</div>
       			<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> PIC/Pelaksana </label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5 pj_rapatKapus" name="pj_rapat" value="" />
       				</div>
       			</div>

       				<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1" id ="start_data">Waktu Mulai</label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="waktu Mulai" class="col-xs-10 col-sm-5 datepicker2" name="start_tgl_rapat" value="" />
       				</div>
       			</div>
       			<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu Akhir</label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Waktu Akhir" class="col-xs-10 col-sm-5 datepicker3" name="end_tgl_rapat" value />
       				</div>
       			</div>
    	   </div>
    	   <div class="modal-footer">
    		   <button class="btn btn-info ajaxSearchKapus" type="button">
    			   <i class="ace-icon fa fa-check bigger-110"></i>
    			   Search
    		   </button>
    		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	   </div>
    	 </div>
   	 	</form>
       </div>
     </div>
	<!-- /.main-content -->
	<?php
	$data_eselon = !empty ($infant_eselon) ? $infant_eselon : [];
	$data_eselon_undang = !empty ($undang_eselon) ? $undang_eselon : [];
	 ?>
	@section('js')
		<script>

	var dataSelected = <?php echo json_encode($data_eselon) ?>;
	var dataSelectedUndang = <?php echo json_encode($data_eselon_undang) ?>;
	var urlAjaxTable = "{{ URL::to(route('booking_internal.indexAjax')) }}";
    var  urlAjaxShow = "{{url('/admin/booking_internal-show')}}";
	var urlView ="{{url('/admin/booking_internal-show-ruangan')}}";
	var urlSelect2 = "{{url(route('booking_internal.searchAjax'))}}";
	var  urlEdit = "{{url('/admin/booking_internal-edit')}}";
	var  urlDelete = "{{url('/admin/booking_internal-delete')}}";
    var token = "{{ csrf_token() }}";
    	$('.status').change(function(){
    		var status = $(this).val();
    		if (status == "internal") {
    			$(".block-tempat").addClass('hidden');
    			$(".block-ruangan").removeClass('hidden');
    		}else{
    			$(".block-ruangan").addClass('hidden');
    			$(".block-tempat").removeClass('hidden');

    		}
    	});
    	$(".js-example-tokenizer").select2({
		  tags: true,
		  multiple :true
		});
    var listTable = $('.listTable').DataTable( {
        "processing": false,
        "bFilter": false,
        "bInfo": false,
        "bLengthChange": false,
        "serverSide": true,
        "ajax": {
             "url": urlAjaxTable,
             "type": "GET"
         },
         "columns": [
            { "data": "agenda_rapat" },
            { "data": "start_tgl_rapat" },
            { "data": "end_tgl_rapat" },
            { "data": "status_active" },
            { "data": "tempat_rapat" },
            { "render": function (data, type, row, meta) {

                        var show = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('onclick', "showProcess('"+row.id_rapat+"')")
                                    .text('Show')
                                    .wrap('<div></div>')
                                    .parent()
                                  .html();


                        return show ;
           					 }
            },
			{ "render": function (data, type, row, meta) {

					   var edit = $('<a><button>')
								   .attr('class', "btn bg-blue-grey waves-effect edit-menu")
								   .attr('href',urlEdit+'/'+row.id_rapat)
								   .text('Edit')
								   .wrap('<div></div>')
								   .parent()
								   .html();
				   var del = $('<button>')
					   .attr('class', "btn btn-danger waves-effect delete-menu")
					   .attr('onclick', "deletProcess('"+row.id_rapat+"')")
					   .text('Delete')
					   .wrap('<div></div>')
					   .parent()
					   .html();

					   return edit+" | "+del;
								   }
		   },
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

    function showProcess(id_rapat){
		window.open(urlAjaxShow+"?id_rapat="+id_rapat,"width=800px, height=500px");
	}


    function popupIMage(e) {
        var modal = document.getElementById('myModal');
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = e.src;
        captionText.innerHTML = e.alt;
    }
    $('.datepicker').daterangepicker({
				locale :{
					format : 'DD-MM-YYYY HH:mm A'
				},
				timePicker :true,
				singleDatePicker :true,
			    showDrodowns :true,

			});
			function deletProcess(id_rapat){
		    swal({
		        title: "Apakah anda yakin ?",
		        text: "Anda akan menghapus data.",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#DD6B55",
		        confirmButtonText: "Yes, delete ",
		        closeOnConfirm: true,
		    }, function () {
		         window.location.href = urlDelete+'/'+id_rapat;
		     });
		    }
    $('.datepicker1').daterangepicker({
				locale :{
					format : 'DD-MM-YYYY HH:mm A'
				},
				timePicker :true,
				singleDatePicker :true,
			    showDrodowns :true,

			});
			$('#showRuangan').click(function(){

				var waktuM = $('.datepicker').val();
				var waktuA = $('.datepicker1').val();
				 window.open(urlView+"?waktuM="+waktuM+"&waktuA="+waktuA,"width=800px, height=500px");
			});
					$('.products').select2({
							tags :false,
							tokeSeparators :[","," "],
							multiple :true,
							 ajax: {
								url : urlSelect2,
								type : "GET",
								dataType :"JSON",

								data: function(term, page) {
								  return {
									q: term
								  };
								},
								processResults: function(data, page) {
										return { results: data };
								 }

							  }
							});
							var ds = [];
							 $(dataSelected).each(function(index,value){
								$(value).each(function(i,v){
								 	ds.push(v.id_user);
							 	});
							});
							$('.products').val(ds).trigger("change");

								$('.products1').select2({
										tags :false,
										tokeSeparators :[","," "],
										multiple :true,
										 ajax: {
											url : urlSelect2,
											type : "GET",
											dataType :"JSON",

											data: function(term, page) {
											  return {
												q: term
											  };
											},
											processResults: function(data, page) {
													return { results: data };
											 }

										  }
										});
							var dsUndang = [];
							 $(dataSelectedUndang).each(function(index,value){
								$(value).each(function(i,v){
								 	dsUndang.push(v.id_user);
							 	});
							});
							$('.products1').val(dsUndang).trigger("change");

							$('.datepicker2').daterangepicker({
										locale :{
											format : 'DD-MM-YYYY HH:mm A'
										},
										timePicker :true,
										singleDatePicker :true,
									    showDrodowns :true,
										ampm: true,

						    });
						    $('.datepicker3').daterangepicker({
										locale :{
											format : 'DD-MM-YYYY HH:mm A'
										},
										timePicker :true,
										singleDatePicker :true,
									    showDrodowns :true,
										ampm: true,

						    });
							$('.modalFilterKapus').click(function(){
								$("html, body").animate({ scrollTop: $(document).height() }, 1000);
								$('.datepicker2').val("");
								$('.datepicker3').val("");
								 $('.filterKapus').modal('show');

							});
							$('.ajaxSearchKapus').click(function () {
								var waktuM = $('.datepicker2').val();
								var waktuA = $('.datepicker3').val();
								if (waktuM != '' && waktuA == '') {
										swal("GAGAL!!",'Waktu Akhir harap Di isi!')
									return false;
								}
								if (waktuM == '' && waktuA != '') {
									swal("GAGAL!!",'Waktu Mulai harap Di isi!')
									return false;
								}
								$('.filterKapus').modal('hide');
								var agenda_rapat = $('.agenda_rapatKapus').val();
								var pj_rapat = $('.pj_rapatKapus').val();
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
										 waktuA : waktuA,
										 agenda_rapat : agenda_rapat,
										 pj_rapat : pj_rapat
									 }
								 },
								 "columns": [
									{ "data": "agenda_rapat" },
									{ "data": "start_tgl_rapat" },
									{ "data": "end_tgl_rapat" },
									{ "data": "status_active" },
									{ "data": "tempat_rapat"  },
									{ "render": function (data, type, row, meta) {

						                        var show = $('<a><button>')
						                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
						                                    .attr('onclick', "showProcess('"+row.id_rapat+"')")
						                                    .text('Show')
						                                    .wrap('<div></div>')
						                                    .parent()
						                                  .html();


						                        return show ;
						           					 }
						            },
						            { "render": function (data, type, row, meta) {

						                        var edit = $('<a><button>')
						                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
						                                    .attr('href',urlEdit+'/'+row.id_rapat)
						                                    .text('Edit')
						                                    .wrap('<div></div>')
						                                    .parent()
						                                    .html();
						                    var del = $('<button>')
						                        .attr('class', "btn btn-danger waves-effect delete-menu")
						                        .attr('onclick', "deletProcess('"+row.id_rapat+"')")
						                        .text('Delete')
						                        .wrap('<div></div>')
						                        .parent()
						                        .html();

						                        return edit+" | "+del;
						                                    }
						            },
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
			<style type="text/css">

.daterangepicker{
	z-index:9999 !important;
}

		</style>


		@endsection
@stop
