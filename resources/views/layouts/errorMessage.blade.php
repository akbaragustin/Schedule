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

@if (!empty(\Session::get('insertFailsInfantUndang')))
<script type="text/javascript">
 swal("Gagal Menyimpan","Nama Infant dan Nama pejabat yang di undang sama !")
</script>
@endif
@if (!empty(\Session::get('insertFailsdate')))
<script type="text/javascript">
 swal("Gagal Menyimpan","waktu mulai lebih besar dari waktu akhir !")
</script>
@endif
@if (!empty(\Session::get('insertFailsRuangan')))
<script type="text/javascript">
 swal("Gagal Menyimpan","Ruangan yang anda gunakan sudah terisi")
</script>
@endif
