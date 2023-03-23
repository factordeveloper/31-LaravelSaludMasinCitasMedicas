<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SecretariaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->rol != "Administrador"){
            return redirect('inicio');
        }


        $secretarias = Secretaria::all()->where('rol', 'Secretaria');

        return view('modulos.secretarias')->with('secretarias', $secretarias);

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
        $datos = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
        ]);
     

        $secretarias = Secretaria::create([
             'name'=>$datos["name"],
             'id_consultorio'=>0,
             'email'=>$datos["email"],
             'password'=>Hash::make($datos["password"]),
             'sexo'=>'',
             'telefono'=>'',
             'documento'=>'',
             'rol'=>'Secretaria',
        ]);

        return redirect('secretarias')->with('SecretariaCreada', 'Si');

    }

    public function destroy($id)
    {
     
        Secretaria::destroy($id);

        return redirect('secretarias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->rol != "Administrador"){
            return redirect('inicio');
        }

        $secretarias = Secretaria::all()->where('rol', 'Secretaria');
        $secretaria = Secretaria::find($id);

        return view('modulos.secretarias', compact('secretarias', 'secretaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function edit(Secretaria $secretaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secretaria $id)
    {
        if($id['email'] != request('email') && request('passwordN') != ""){
            $datos = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'passwordN' => ['required', 'string', 'min:5']
            ]);

            DB::table('users')->where('id', $id["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'password'=> Hash::make($datos["passwordN"])]);
        }
        
        else if($id['email'] != request('email') && request('passwordN') == ""){
            $datos = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:5']
                ]);
    
                DB::table('users')->where('id', $id["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'password'=> Hash::make($datos["password"])]);
        }
        
        else if($id['email'] == request('email') && request('passwordN') != ""){
            $datos = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'passwordN' => ['required', 'string', 'min:5']
                ]);
    
                DB::table('users')->where('id', $id["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'password'=> Hash::make($datos["passwordN"])]);
        }
        
        else{
            $datos = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'passwordN' => ['required', 'string', 'min:5']
                ]);
    
                DB::table('users')->where('id', $id["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'password'=> Hash::make($datos["password"])]);
        }

        return redirect('secretarias');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    
}
