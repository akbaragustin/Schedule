@if (!empty (\Session::get('messageError')))
<script type="text/javascript">

 swal("{{\Session::get('messageError')}}")
	
</script>

@endif
@if (!empty (\Session::get('insertError')))
<script type="text/javascript">

 swal("{{\Session::get('insertError')}}",'Isi Semua Data!')
	
</script>

@endif
@if (!empty (\Session::get('insertSuccess')))
<script type="text/javascript">

 swal("{{\Session::get('insertSuccess')}}", "You clicked the button!", "success")
	
</script>

@endif