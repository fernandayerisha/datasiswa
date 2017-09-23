
<!-- MODAL DELETE -->
  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    <form class="formsiswa" action="" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="nis" value="">
          <p>Apakah anda yakin untuk menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"></i></button>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a onClick="deleteData({{$siswa->id}})" class="btn btn-success"><i class="fa fa-check"></i></a>
          <input type="hidden" name="deletedata" value="{{$siswa->id}}">
        </div>
      </div><!-- /.modal-content -->
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
<script type="text/javascript">
 $.ajaxSetup({
  headers: {
   'X-CSRF-TOKEN': $('input[name="_token"]').val()
  }
 });
// ajax untuk delete data
function deleteData(id){
      $.ajax({
        url     : "{{url('/do_delete')}}",
        method  : 'POST',
        data    : {
          'id' : id
        },
        success : function(response){
          window.location.replace('/datasiswa/public/');
        }
      });
}
// function deleteData(id_delete){
//       $.ajax({
//         url     : "{{url('do_delete')}}",
//         method  : 'POST',
//         data    : {
//           'id_delete' : id_delete
//         },
//         success : function(response){
//           // console.log(response);
//           if (response.status == 'error'){
//             alert('Delete Error');
//           }else{
//             alert('Delete Success!!');
//           }
//         }
//       });
//     }
</script>
