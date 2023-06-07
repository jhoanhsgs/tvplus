@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Listado de canales de iptv</h1>
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
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Canales de iptv</h5>
              <a href="{{url('admin/iptvs/create')}}" class="btn btn-primary">Agregar nuevo</a>
              @if($message = Session::get('mensaje'))
                  <script>
                      /* Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Your work has been saved',
                      showConfirmButton: false,
                      timer: 1500
                      }) */

                      Swal.fire(
                        
                        'Registro exitoso!',
                        '{{$message}}',
                        'success'
                        )
                  </script>
              @endif
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                      <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre del canal</th>
                                <th>imagen</th>
                                <th>url</th>
                                <th>acciones</th>                                
                              </tr>
                      </thead>

                      <tbody>
                        <?php
                            $contador =1;
                        ?>
                        @foreach ($iptvs as $iptv)
                            <tr>
                                <td><?php echo $contador++;?></td>
                                <td>{{$iptv->nombre}}</td>
                                <td>
                                    <img src="{{asset('storage'.'/'.$iptv->imagen)}}" width="100px" alt="">
                                </td>
                                <td>{{$iptv->url}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('iptvs.show',$iptv->id) }}" class="btn btn-info btn-sm">Mostrar</a>  
                                        <a href="{{ route('iptvs.edit',$iptv->id) }}" class="btn btn-success btn-sm">Editar</a>  
                                        <form action="{{url('admin/iptvs',$iptv->id)}}" method="POST">
                                          @csrf
                                          {{method_field('DELETE')}}
                                            <input type="submit" onclick="return confirm('¿Esta seguro de eliminar el registro?')" class="btn btn-danger btn-sm" value="Eliminar">
                                        </form>
                                       </div>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      
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


