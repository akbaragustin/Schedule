	@extends('layouts.index')
	@section('content')
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-header">
                            <h1>
                                Form Ruangan
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@if(!empty($id_ruangan))
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('ruangan.update'))}}">@else
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('ruangan.save'))}}">
								@endif	
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama ruangan </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Ruangan" class="col-xs-10 col-sm-5" name="name_ruangan" value="{{!empty($name_ruangan) ? $name_ruangan : ''}}" />
										</div>
									</div>
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kapasitas Ruangan</label>

										<div class="col-sm-9">
											<input type="number" id="form-field-1" placeholder="Kapasitas" class="col-xs-10 col-sm-5" name="max_ruangan" value="{{!empty($max_ruangan) ? $max_ruangan : ''}}" />
										</div>
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
									</div>
									<!-- <input type="submit" name="simpan"> -->

									<div class="clearfix form-actions">
										@if(!empty($id_ruangan))
										<input type="hidden" name="update" value="{{$id_ruangan}}">
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
		                                <th>Ruangan</th>
		                                <th>Kapasitas Ruangan</th>
		                                <th>Creator</th>
		                                <th>Created</th>
		                                <th>action</th>
		                            </tr>
		                        </thead>

		                    </table>
						</div>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->	
	</div><!-- /.main-content -->
	@section('js')
		<script>
	var urlAjaxTable = "{{ URL::to(route('ruangan.indexAjax')) }}";
    var  urlEdit = "{{url('/admin/ruangan-edit')}}";
    var  urlDelete = "{{url('/admin/ruangan-delete')}}";
    
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
            { "data": "name_ruangan" },    
            { "data": "max_ruangan" },    
            { "data": "creator" },    
            { "data": "created" },
            { "render": function (data, type, row, meta) {
                    
                        var edit = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('href',urlEdit+'/'+row.id_ruangan)
                                    .text('Edit')
                                    .wrap('<div></div>')
                                    .parent()
                                    .html();
                    var del = $('<button>')
                        .attr('class', "btn btn-danger waves-effect delete-menu")
                        .attr('onclick', "deletProcess('"+row.id_ruangan+"')")
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

    function deletProcess(id_ruangan){
    swal({
        title: "Apakah anda yakin ?",
        text: "Anda akan menghapus data.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete ",
        closeOnConfirm: true,
    }, function () {
         window.location.href = urlDelete+'/'+id_ruangan;
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


</script>
		@endsection
@stop