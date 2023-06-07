<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelicula;
use Illuminate\Support\Facades\Storage;

class peliculacontroller extends Controller
{
    public function index (){
        $peliculas = pelicula::all(); //lectura de todos los campos que hay en a base de datos
        return view('admin.peliculas.index',['peliculas'=>$peliculas]);
    }
    //vista del formulario para crear registro
    public function create(){
        return view('admin.peliculas.create');
    }
    //almacenar la informacion que mandamos desde el formulario
    public function store(Request $request){
        /*retorna los datos del request
        $datospeliculas = request()->all();
        return response()->json($datospeliculas);*/

        $request->validate([
            'titulo_p' => 'required|max:255',
            'categoria_p' => 'required|max:100',
            'trailer_p' => 'required|max:100',
            'duracion_p' => 'required|max:100',
            'link1_p' => 'required',
            'description_p' => 'required',
            'imagenes_p' => 'required'
        ]);

        $pelicula = new pelicula();
        $pelicula->titulo_p = $request->titulo_p;
        $pelicula->description_p = $request->description_p;
        $pelicula->categoria_p = $request->categoria_p;
        
        //$pelicula->imagenes_p = $request->imagenes_p;
        //1 linea para subir la imagen 
        $pelicula->imagenes_p = $request->file('imagenes_p')->store('portadas_uploads', 'public');

        $pelicula->trailer_p = $request->trailer_p;
        $pelicula->duracion_p = $request->duracion_p;
        $pelicula->link1_p = $request->link1_p;
        $pelicula->link2_p = $request->link2_p;
        $pelicula->save();

        //redirecionamos a la pagina
        return redirect() -> route('peliculas.index')-> with('mensaje','se registro la pelicula de la menera correcta');
    }
    //mostrar un registro especifico
    public function show($id){
        $pelicula = pelicula::findOrFail($id);
        return view('admin.peliculas.show',['pelicula'=>$pelicula]);
    }
    //vista y cargar los datos que se quieeren editar
    public function edit($id){ //recibimos el id que se va  aeditar
        $pelicula = pelicula::findOrFail($id); //buscamos en el modelo la informacion del registro
        return view('admin.peliculas.edit',['pelicula'=>$pelicula]); //retornamos en la vista para ver la info de la pelicula
    }
    //actualizar la inforamacion que esta en la vista editar
    public function update(Request $request, $id){
        /*retorna los datos del request
        $datospeliculas = request()->all();
        return response()->json($datospeliculas);*/

        $request->validate([
            'titulo_p' => 'required|max:255',
            'categoria_p' => 'required|max:100',
            'trailer_p' => 'required|max:100',
            'duracion_p' => 'required|max:100',
            'link1_p' => 'required',
            'description_p' => 'required'
            
        ]);

        $pelicula = pelicula::find($id);
        $pelicula->titulo_p = $request->titulo_p;
        $pelicula->description_p = $request->description_p;
        $pelicula->categoria_p = $request->categoria_p;
        
        //$pelicula->imagenes_p = $request->imagenes_p;
        //1 linea para subir la imagen 


        if($request->hasFile('imagenes_p')){//si existe una pelicula en el formulario
            Storage::delete('public/'.$pelicula->imagenes_p);//eliminamos la anterior imagen
            $pelicula->imagenes_p = $request->file('imagenes_p')->store('portadas_uploads', 'public');//subimos la nueva imagen
        }

        

        $pelicula->trailer_p = $request->trailer_p;
        $pelicula->duracion_p = $request->duracion_p;
        $pelicula->link1_p = $request->link1_p;
        $pelicula->link2_p = $request->link2_p;
        $pelicula->save();

        //redirecionamos a la pagina
        return redirect() -> route('peliculas.index')-> with('mensaje','se actualizo la pelicula de la menera correcta');
    }
    //elimina el registro especifico
    public function destroy($id){
        $pelicula = pelicula::findOrFail($id); //buscamos en el modelo la informacion del registro

        Storage::delete('public/'.$pelicula->imagenes_p);//eliminamos la anterior imagen
        pelicula::destroy($id);
        return redirect() -> route('peliculas.index')-> with('mensaje','se elimino la pelicula de la menera correcta');
        
    }
}
