<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<div class="wrapper">

    <!-- Header -->
    @include('header')

    <!-- Sidebar -->
    @include('sidebar')

     <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
            <div class="row">
                @foreach ($laki as $data)
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-male"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Laki-Laki</span>
                            <span class="info-box-number">{{ $data->laki_count }}</span>
                            <!-- The progress section is optional -->
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- ./col -->
                @foreach ($total as $data)
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-male"></i><i class="fa fa-female"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Jumlah Siswa</span>
                          <span class="info-box-number">{{ $data->total }}</span>
                          <!-- The progress section is optional -->
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- ./col -->
                @foreach ($perempuan as $data)
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="fa fa-female"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Perempuan</span>
                          <span class="info-box-number">{{ $data->perempuan_count }}</span>
                          <!-- The progress section is optional -->
                        </div>
                    </div>
                </div>
               @endforeach
                <!-- ./col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-2">
                                  <span><i class="fa fa-graduation-cap"></i></span>
                                  <h3 class="box-title">Tabel Siswa</h3>
                                </div>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-2">
                                    <a href="#" class="modalCreateTrigger" data-toggle="modal" data-target="#modalCreateTrigger"><button class="btn btn-success"><i class="fa fa-plus">Tambahkan Siswa</i></button></a>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th>NIS</th>
                                      <th>Nama</th>
                                      <th>Tanggal lahir</th>
                                      <th>Jenis Kelamin</th>
                                      <th>Alamat</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $data)
                                    <tr>
                                      <td>{{ $data->nis }} </td>
                                      <td>{{ $data->nama }} </td>
                                      <td>{{ $data->tgl_lahir }} </td>
                                      <td>{{ $data->j_k }} </td>
                                      <td>{{ $data->alamat }} </td>
                                      <td>
                                        <a onClick="modalEditTriger({{$data->id}})" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                        <a onClick="modalDeleteTrigger({{$data->id}})" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>NIS</th>
                                      <th>Nama</th>
                                      <th>Tanggal lahir</th>
                                      <th>Jenis Kelamin</th>
                                      <th>Alamat</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('footer')
<div class="modalKu"></div>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jQuery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
<!-- DataTables -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->

<!-- page script -->
<script type="text/javascript">
 $.ajaxSetup({
  headers: {
   'X-CSRF-TOKEN': $('input[name="_token"]').val()
  }
 });

// modal create
    $('.modalCreateTrigger').click(function(event){
    event.preventDefault();
        $.ajax({
            url     : "{{url('modal_create')}}",
            method  : 'POST',
            success : function(response){
                $('.modalKu').html(response);
                $('#myModal').modal('show');
            }
        });
  });

// MODAL EDIT
    function modalEditTriger(id){
      $.ajax({
        url     : "{{url('modal_edit')}}",
        method  : 'POST',
        data    : {
          'id' : id
        },
        success : function(response){
          // console.log(response);
          $('.modalKu').html(response);
          $('#myModal').modal('show');
        }
      });
    }

// MODAL DELETE
    function modalDeleteTrigger(id){
      // var r = confirm("Apa anda yakin akan menghapus data?");
      // if (r == true){
        $.ajax({
        url     : "{{url('/modal_delete')}}",
        method  : 'POST',
        data    : {
          'id' : id
        },
        success : function(response){
          console.log(response);
          $('.modalKu').html(response);
          $('#myModal').modal('show');
          // if (response.status == 'error'){
          //   alert('Delete Error');
          // }else{
          //   alert('Delete Success!!');
          //   window.location.replace('/datasiswa/public/home');
          // }
        }
      });
      // }else{
      //   alert('Delete Canceled!');
      // }
    }
</script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

</script>
</body>
</html>