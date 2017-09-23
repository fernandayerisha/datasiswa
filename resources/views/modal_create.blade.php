<!-- MODAL CREATE -->
<div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <form class="formsiswa" action="/datasiswa" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Siswa</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="row">
          <div class="col-xs-4">NIS</div>
          <div class="col-xs-4"><input type="number" name="nis" placeholder="Nomor Induk Siswa"></div>
        </div>
        <div class="row">
          <div class="col-xs-4">Nama</div>
          <div class="col-xs-4"><input type="text" name="nama" placeholder="Nama Lengkap"></div>
        </div>
        <div class="row">
          <div class="col-xs-4">Tanggal Lahir</div>
          <div class="col-xs-4"><input type="date" name="tgl_lahir" placeholder="Tanggal Lahir Siswa"></div>
        </div>
        <div class="row">
          <div class="col-xs-4">Jenis Kelamin</div>
          <div class="col-xs-4">
            <input type="radio" name="j_k" value="Perempuan"> Perempuan<br>
            <input type="radio" name="j_k" value="Laki-Laki"> Laki-Laki<br>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-4">Alamat</div>
          <div class="col-xs-4"><input type="text" name="alamat" placeholder="Jl. Contoh No 1"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-primary" value="Tambahkan">
      </div>
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
 $.ajaxSetup({
  headers: {
   'X-CSRF-TOKEN': $('input[name="_token"]').val()
  }
 });

$(document).ready(function(){
 $('.formsiswa').submit(function(event){
      event.preventDefault();
      var data = $('.formsiswa').serializeArray();
        $.ajax({
        url : "{{url('/do_create')}}",
        method : 'POST',
        data : data,
        success : function(response) {
              if (response.status == 'error') {
              var html_error = '';
              html_error += '<ul>';
              $.each(response.message, function (error_key, error_message){
                html_error += error_key;
                $.each(error_message, function (message){
                  html_error += '<li>'+ this +'</li>';
                });
              });
              html_error += '</ul>';
              $('.alert-danger').html(html_error);
              $('.alert-danger').show();
              } else {
                  window.location.replace('/datasiswa/public/');
              }

        }
      });
  });
});
</script>