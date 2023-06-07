<?php

namespace App\Http\Controllers;

use App\Models\Iptv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IptvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $iptvs = Iptv::all();
        return view('admin.iptvs.index',['iptvs'=>$iptvs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.iptvs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //nos sirve para mirar que enviamos por json (probrar)
        /* $iptvs = request()->all();
        return response()->json($iptvs); */

        $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'imagen' => 'required'
        ]);

        $iptv = new Iptv();
        $iptv->nombre = $request->nombre;
        /* $iptv->imagen = $request->imagen; */

        $iptv->imagen = $request->file('imagen')->store('canales_uploads', 'public');

        $iptv->url = $request->url;

        $iptv->save();

        //redirecionamos a la pagina
        return redirect() -> route('iptvs.index')-> with('mensaje','se registro el canal de iptv de menera correcta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Iptv  $iptv
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $iptv = Iptv::findOrFail($id);

        return view('admin.iptvs.show',['iptv'=>$iptv]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Iptv  $iptv
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $iptv = Iptv::findOrFail($id);

        return view('admin.iptvs.edit',['iptv'=>$iptv]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Iptv  $iptv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            
        ]);

        $iptv = Iptv::find($id);
        $iptv->nombre = $request->nombre;
        /* $iptv->imagen = $request->imagen; */

        
        if($request->hasFile('imagen')){//si existe una pelicula en el formulario
            Storage::delete('public/'.$iptv->imagen);//eliminamos la anterior imagen
            $iptv->imagen = $request->file('imagen')->store('canales_uploads', 'public');//subimos la nueva imagen
        }

        $iptv->url = $request->url;

        $iptv->save();

        //redirecionamos a la pagina
        return redirect() -> route('iptvs.index')-> with('mensaje','se actualizo el canal de iptv de menera correcta');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Iptv  $iptv
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $iptv = Iptv::findOrFail($id); //buscamos en el modelo la informacion del registro

        Storage::delete('public/'.$iptv->imagen);//eliminamos la anterior imagen
        Iptv::destroy($id);
        return redirect() -> route('iptvs.index')-> with('mensaje','se elimino el canal de la menera correcta');
        
    }
}
