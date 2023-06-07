@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Listado de peliculas</h1>
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
              <h5 class="m-0">Peliculas</h5>
              <a href="{{url('admin/peliculas/create')}}" class="btn btn-primary">Agregar nuevo</a>
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
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Imagen</th>
                                <th>Trailler</th>
                                <th>Duracion</th>
                                <th>Servidor 1</th>
                                <th>Servidor 2</th>
                                <th>Acciones</th>

                              </tr>
                      </thead>
                      <tbody>     
                        <?php $contador = 0;?>            
                            @foreach ($peliculas as $pelicula)
                                <tr>
                                    <td> <?php echo $contador = $contador+1;?></td>
                                    <td>{{$pelicula->titulo_p}}</td>
                                    <td>{!!$pelicula->description_p!!}</td>
                                    <td>{{$pelicula->categoria_p}}</td>
                                    <td>
                                      <img src="{{asset('storage').'/'.$pelicula->imagenes_p}}" width="100px" alt="">
                                    </td>
                                    <td>
                                        <a href="https://www.youtube.com/watch?v={{$pelicula->trailer_p}}" target="_blank">
                                          Ver Trailer
                                        </a>
                                    </td>
                                    <td>{{$pelicula->duracion_p}}</td>
                                    <td>
                                        <a href="{{$pelicula->link1_p}}" target="_blank">Ver servidor</a>
                                    </td>
                                    <td>
                                        <a href="{{$pelicula->link2_p}}" target="_blank">Ver servidor</a>  
                                    </td>                                                                   
                                    <td>
                                       <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('peliculas.show',$pelicula->id) }}" class="btn btn-info btn-sm">Mostrar</a>  
                                        <a href="{{ route('peliculas.edit',$pelicula->id) }}" class="btn btn-success btn-sm">Editar</a>  
                                        <form action="{{url('admin/peliculas',$pelicula->id)}}" method="POST">
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


