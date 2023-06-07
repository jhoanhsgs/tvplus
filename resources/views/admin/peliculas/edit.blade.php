@extends('layouts.admin')

@section('content')
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Editar pelicula: <b>{{$pelicula->titulo_p}}</b></h1>
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
          <div class="card card-success card-outline">
            <div class="card-header">
              <h5 class="m-0">Edite los datos con cuidado</h5>
            </div>
            <div class="card-body">
                 <form action="{{url('/admin/peliculas',$pelicula->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Titulo de la pelicula <span style="color: red"><b>*</b></span></label>
                                        <input type="text" name="titulo_p" class="form-control" value="{{$pelicula->titulo_p}}" required>
                                        @error('titulo_p')
                                            <small style="color: red ">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categoria <span style="color: red"><b>*</b></span></label>
                                        {{-- <input type="text" name="categoria_p" class="form-control" value="{{$pelicula->categoria_p}}"" required> --}}
                                        <select name="categoria_p" id="" class="form-control">
                                            <option value="Acción" {{ old('categoria_p') }} == 'Acción' ? 'selected' : ''>Acción</option>
                                            <option value="animación" {{ old('categoria_p') }} == 'animación' ? 'selected' : ''>animación</option>
                                            <option value="Animes" {{ old('categoria_p') }} == 'Animes' ? 'selected' : ''>Animes</option>
                                            <option value="Aventuras" {{ old('categoria_p') }} == 'Aventuras' ? 'selected' : ''>Aventuras</option>
                                            <option value="Ciencia Ficción" {{ old('categoria_p') }} == 'Ciencia Ficción' ? 'selected' : ''>Ciencia Ficción</option>
                                            <option value="Musica" {{ old('categoria_p') }} == 'Musica' ? 'selected' : ''>Musica</option>
                                            
                                        </select>
                                        @error('categoria_p')
                                            <small style="color: red ">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Trailler <span style="color: red"><b>*</b></span></label>
                                        <input type="text" name="trailer_p" class="form-control" value="{{$pelicula->trailer_p}}" required>
                                        @error('trailer_p')
                                            <small style="color: red ">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Duracion de la pelicula <span style="color: red"><b>*</b></span></label>
                                        <input type="text" name="duracion_p" class="form-control" value="{{$pelicula->duracion_p}}" required>
                                        @error('duracion_p')
                                            <small style="color: red ">{{$message}}</small>
                                        @enderror
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Servidor 1 <span style="color: red"><b>*</b></span></label>
                                <input type="text" name="link1_p" class="form-control" value="{{$pelicula->link1_p}}" required>
                                @error('link1_p')
                                            <small style="color: red ">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Servidor 2</label>
                                <input type="text" name="link2_p" class="form-control" value="{{$pelicula->link2_p}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Description de la pelicula <span style="color: red"><b>*</b></span></label>
                                <textarea name="description_p" id="" cols="30" rows="5" class="form-control"  required>{{$pelicula->description_p}}</textarea>
                                @error('description_p')
                                            <small style="color: red ">{{$message}}</small>
                                @enderror
                                <script>
                                CKEDITOR.replace( 'description_p' );
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="">portada de la pelicula <span style="color: red"><b>*</b></span></label>
                                <input type="file" name="imagenes_p" id="file" class="form-control" value="{{ old('imagenes_p') }}">
                                @error('imagenes_p')
                                  <small style="color: red ">{{$message}}</small>
                                @enderror
                              <center> <output id="list" style="margin-top: 0px">
                                <img src="{{asset('storage').'/'.$pelicula->imagenes_p}}" width="100px" alt="">
                                </output></center>
                              <script>
                                function archivo(evt) {
                                  var files = evt.target.files; //filelist object
                                  //obtenemos la imagen del campo "file"
                                  for (var i = 0, f; f = files[i]; i++){
                                    //solo adminitos imagenes
                                    if (!f.type.match('image.*')){
                                      continue;
                                    }
                                    var reader = new FileReader();
                                    reader.onload = (function (theFile){
                                      return function (e) {
                                        //insertamos la imagen
                                        document.getElementById("list").innerHTM = ['<img class="thumb thumbnail" src="',e.target.result, '" width="200px" title="", escape(theFile.name), '"/>'].join('');
                                      };
                                    })(f);
                                    reader.readAsDataURL(f);
                                  }
                                  
                                }
                                document.getElementById('file').addEventListener('change', archivo, false);
                              </script>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="md-6">
                            <a href="" class="btn btn-secondary">Cancelar</a>
                            <input type="submit" class="btn btn-success" value="Actualizar">
                        </div>
                    </div>
                 </form>
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


