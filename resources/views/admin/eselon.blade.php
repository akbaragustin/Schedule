	@extends('layouts.index')
	@section('content')
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-header">
                            <h1>
                                Form Rapat Eselon
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@if(!empty($id_rapat))
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('eselon.update'))}}">@else
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('eselon.save'))}}">
								@endif	
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agenda </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Aganda" class="col-xs-10 col-sm-5" name="agenda_rapat" value="{{!empty($agenda_rapat) ? $agenda_rapat : ''}}" />
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name</label>

									<div class="col-sm-9">
									<select class="col-xs-10 col-sm-5" id="products" name="name_pic[]" data-tags="false" data-placeholder="Select an option">
					  				<?php 
					  				foreach ($name_pic as $key => $value) {
					  					echo "<option value = ".$value['id_user'].">".$value['name_pic']."</option>";	
					  				}


					  				 ?>
                     			 </select>
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
											<input type="text" id="form-field-1" placeholder="Waktu Akhir" class="col-xs-10 col-sm-5 datepicker" name="end_tgl_rapat" value="{{!empty($end_tgl_rapat) ? $end_tgl_rapat : ''}}" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

										<div class="col-sm-9">
											<select name="status_ruangan_rapat"  class="status col-xs-10 col-sm-5">
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
									<div class="form-group hidden block-tempat">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Tempat" class="col-xs-10 col-sm-5" name="tempat_rapat" value="{{!empty($tempat_rapat) ? $tempat_rapat : ''}}" />
										</div>
									</div>	
									<div class="form-group hidden block-ruangan">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ruangan </label>

										<div class="col-sm-9">
										<select name="ruangan_rapat" class="col-xs-10 col-sm-5">
											<?php 
											foreach ($allRuangan as $key => $value) {
												$selected ="";
													if (!empty ($id_ruangan)) {
														if ($id_ruangan) {
															$selected ="selected";
														}
													}
												echo "<option value=".$value['id_ruangan']." ".$selected.">".$value['name_ruangan']."<small> (".$value['max_ruangan'].")</small></option>";
											}

											 ?>

										</select>
									  </div>	
									</div>	
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Infant </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Infant" class="col-xs-10 col-sm-5" name="infant_rapat" value="{{!empty($infant_rapat) ? $infant_rapat : ''}}" />
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
										<h3 class="header smaller lighter blue">Data Ruangan</h3>

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
		                                <th>Detail</th>
		                                <th>action</th>
		                            </tr>
		                        </thead>

		                    </table>
						</div>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->	
	</div>
	<!-- /.main-content -->
	@section('js')
		<script>


	var urlAjaxTable = "{{ URL::to(route('eselon.indexAjax')) }}";
	var  urlEdit = "{{url('/admin/eselon-edit')}}";
	var urlSelect2 = "{{url(route('eselon.searchAjax'))}}";
    var  urlAjaxShow = "{{url('/admin/eselon-show')}}";
    var  urlDelete = "{{url('/admin/eselon-delete')}}";
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
		$('#products').select2({
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
            { "data": "status_ruangan_rapat" },          
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
   		jQuery.ajax({
	            url: urlAjaxShow,
	            type: 'GET',
	            dataType: 'json',
	            data: {
	            		id : id_rapat,
	                _token : token
	            },
	             success: function(doc) {
	             	var disposisi_rapat ="";
	             	 	$.each(doc.disposisi_rapat, function( index, value ) {
	             	 		$.each(value, function( i, v ) {
						  	disposisi_rapat +=v.name_pic+" ";

							});	
						});	
	             	 swal({	
						  title: '<i>'+doc.agenda_rapat+'</i>',
						  text: 
						  'Mulai Rapat :'+doc.start_tgl_rapat+'\
						   <br>Akhir Rapat :'+doc.end_tgl_rapat+'\
						  <br>status_ruangan_rapat :'+doc.status_ruangan_rapat+'\
						  <br>Tempat :'+doc.tempat_rapat+'\
						  <br>ruangan_rapat :'+doc.ruangan_rapat+'\
						  <br>infant_rapat :'+doc.infant_rapat+'\
						  <br>Name :'+disposisi_rapat+'',
						  html:true, 
						  showCloseButton: true, 
					});
	             }
    	});
	}

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
					format : 'DD-MM-YYYY h:mm:ss'
				},
				timePicker :true,
				singleDatePicker :true,
			    showDrodowns :true,

			});

</script>
			<style type="text/css">

.daterangepicker{
	z-index:9999 !important;
}

		</style>


		@endsection
@stop