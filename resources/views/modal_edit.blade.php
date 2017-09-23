<!-- MODAL EDIT -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <form class="formsiswa" action="{{url('/do_edit')}}/{{$siswa->id}}" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Siswa</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="{{ $siswa->id }}">
          <div class="row">
            <div class="col-xs-4">NIS</div>
            <div class="col-xs-4"><input type="number" name="nis" value="{{ $siswa->nis }}"></div>
          </div>
          <div class="row">
            <div class="col-xs-4">Nama</div>
            <div class="col-xs-4"><input type="text" name="nama" value="{{ $siswa->nama }}"></div>
          </div>
          <div class="row">
            <div class="col-xs-4">Tanggal Lahir</div>
            <div class="col-xs-4"><input type="date" name="tgl_lahir" value="{{ $siswa->tgl_lahir }}"></div>
          </div>
          <div class="row">
            <div class="col-xs-4">Jenis Kelamin</div>
            <div class="col-xs-4">
              @if($siswa->j_k=='Perempuan')
                  <input type="radio" name="j_k" value="Laki-Laki"> Laki-Laki<br>
                  <input type="radio" name="j_k" checked value="Perempuan"> Perempuan<br>
              @else
                  <input type="radio" name="j_k" checked value="Laki-Laki"> Laki-Laki<br>
                  <input type="radio" name="j_k" value="Perempuan"> Perempuan<br>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">Alamat</div>
            <div class="col-xs-4"><input type="text" name="alamat" value="{{ $siswa->alamat }}"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" class="btn btn-primary" value="Save changes">
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

   $('.formsiswa').submit(function(event){
      event.preventDefault();
      var data = $('.formsiswa').serializeArray();
      $.ajax({
        url : $('.formsiswa').attr('action'),
        method : 'POST',
        data : data,
        success : function(response) {
          // console.log(response);
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
            $('.alert-ajax').html(html_error);
            $('.alert-ajax').show();
          }else{
            window.location.replace('/datasiswa/public/');
          }
        }
      });
    });

  </script>