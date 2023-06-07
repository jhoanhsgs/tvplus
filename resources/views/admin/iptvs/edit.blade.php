@extends('layouts.admin')

@section('content')
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Editar canal: {{$iptv->nombre}}</h1>
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
        <div class="col-md-10">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h5 class="m-0">Edite los datos con cuidado</h5>
            </div>
            <div class="card-body">
                 <form action="{{url('/admin/iptvs',$iptv->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre del canal</label>
                                <input type="text" class="form-control" name="nombre" value="{{$iptv->nombre}}">
                                @error('nombre')
                                  <small style="color: red ">{{$message}}</small>
                                @enderror  
                            </div>  
                            <div class="form-group">
                                <label for="">Url del canal</label>
                                <input type="text" class="form-control" name="url" value="{{$iptv->url}}}">
                                @error('url')
                                  <small style="color: red ">{{$message}}</small>
                                @enderror      
                            </div>    
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Imagen del canal</label>
                                <input type="file" id="file" class="form-control" name="imagen" value="{{$iptv->imagen}}}">
                                @error('imagen')
                                  <small style="color: red ">{{$message}}</small>
                                @enderror
                                  
                                <br>
                                <center> <output id="list" style="margin-top: 0px">
                                    <img src="{{asset('storage'.'/'.$iptv->imagen)}}" width="400px" alt=""> 
                                </output></center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files; //filelist object
                                        //obtenemos la imagen del campo "file"
                                        for (var i = 0, f; f = files[i]; i++){
                                        //solo admitimos imagenes
                                        if (!f.type.match('image.*')){
                                            continue;
                                        }
                                        var reader = new FileReader();
                                        reader.onload = (function (theFile){
                                            return function (e) {
                                            //insertamos la imagen
                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
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
                        <div class="form-group">
                            <a href="{{url('admin/iptvs')}}" class="btn btn-secondary">Cancelar</a>
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


