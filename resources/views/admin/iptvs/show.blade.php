@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <a href="{{url('admin/iptvs')}}" class="btn btn-secondary">Volver atras</a> <br><br>

          <h1 class="m-0">Canal: {{$iptv->nombre}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

      <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Datos del canal de iptv</h5>
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <tr>
                                <td><b>Nombre</b></td>
                                <td>{{$iptv->nombre}}</td>
                            </tr>
                            
                            <tr>
                                <td><b>Imagen del canal</b></td>
                                <td>
                                    <img src="{{asset('storage').'/'.$iptv->imagen}}" width="300px" alt="">    
                                </td>
                            </tr>
                            <tr>
                                <td><b>Url</b></td>
                                <td>{{$iptv->url}}</td>
                            </tr>
                            
                        </table>
                  </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection


