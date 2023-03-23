<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }




    public function index()
    {
        $inicio = Inicio::find(1);
        return view('modulos.inicio')->with('inicio', $inicio);
    }

    public function DatosCreate()
    {
        return view('modulos.mis-datos');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function DatosUpdate(Request $request)
    {
       
        if(auth()->user()->email != request('email')){
          
            if(isset($datos["passwordN"])){

                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'telefono' => ['string', 'max:255'],
                    'documento' => ['string', 'max:255'],
                    'email' => ['required', 'email', 'string', 'unique:users'],
                    'passwordN' => ['required', 'min:5', 'string']
                ]);
            }else{
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'telefono' => ['string', 'max:255'],
                    'documento' => ['string', 'max:255'],
                    'email' => ['required', 'email', 'string', 'unique:users']
                 
                ]);
            }
        }else{
            if(isset($datos["passwordN"])){

                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'telefono' => ['string', 'max:255'],
                    'documento' => ['string', 'max:255'],
                    'email' => ['required', 'email', 'string'],
                    'passwordN' => ['required', 'min:5', 'string']
                ]);
            }else{
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'telefono' => ['string', 'max:255'],
                    'documento' => ['string', 'max:255'],
                    'email' => ['required', 'email', 'string']
                 
                ]);
            }
        }

        if(isset($datos["passwordN"])){
            DB::table('users')->where('id', auth()->user()->id)->update(['name'=>$datos['name'], 'email'=>$datos["email"], 'telefono'=>$datos["telefono"], 'documento'=>$datos["documento"]]);
        }else{
            DB::table('users')->where('id', auth()->user()->id)->update(['name'=>$datos['name'], 'email'=>$datos["email"], 'telefono'=>$datos["telefono"], 'documento'=>$datos["documento"]]);
        }

        return redirect('mis-datos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inicio  $inicio
     * @return \Illuminate\Http\Response
     */
    public function show(Inicio $inicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inicio  $inicio
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $inicio = Inicio::find(1);
        return view('modulos.editar-inicio')->with('inicio', $inicio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inicio  $inicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos = request();
        $inicio = Inicio::find(1);
        $inicio->dias = $datos["dias"];
        $inicio->horaInicio = $datos["horaInicio"];
        $inicio->horaFin = $datos["horaFin"];
        $inicio->direccion = $datos["direccion"];
        $inicio->telefono = $datos["telefono"];
        $inicio->email = $datos["email"];


        if(request('logoN')){

        Storage::delete('public/'.$inicio->logo);


            $rutaImg = $request['logoN']->store('inicio', 'public');

            $inicio->logo = $rutaImg;
        }

        $inicio->save();

        return redirect('inicio-editar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inicio  $inicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inicio $inicio)
    {
        //
    }
}
