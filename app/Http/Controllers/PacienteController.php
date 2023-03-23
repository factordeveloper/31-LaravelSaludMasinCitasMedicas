<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
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
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('inicio');
        }

        $pacientes = DB::select('select * from users where rol = "Paciente"');

        return view('modulos.pacientes')->with('pacientes', $pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('inicio');
        }

        return view('modulos.crear-paciente');
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

            'name' => ['required'],
            'documento' => ['required'],   
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'unique:users']
   
           ]);
   
           Paciente::create([
   
             'name' => $datos['name'],
             'id_consultorio' => 0,
             'email' => $datos['email'],
             'sexo' => '',
             'documento' => $datos['documento'],
             'telefono' => '',
             'rol' => 'Paciente',
             'password' => Hash::make($datos['password'])
   
           ]);
   
           return redirect('pacientes')->with('agregado', 'Si');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $id)
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('inicio');
        }
     
        $paciente = Paciente::find($id->id);

        return view('modulos.editar-paciente')->with('paciente', $paciente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {

       // dd($paciente['id']);
        if($paciente['email'] != request('email') && request('passwordN') != ""){
            $datos = request()->validate([
                'name' => ['required'],
                'documento' => ['required'],   
                'passwordN' => ['required', 'string', 'min:8'],
                'email' => ['required', 'string', 'email', 'unique:users']
            ]);

            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email'=> $datos["email"], 'documento'=> $datos["documento"], 'password'=>Hash::make($datos["passwordN"])]);
        }else if($paciente['email'] != request('email') && request('passwordN') != ""){
            $datos = request()->validate([
                'name' => ['required'],
                'documento' => ['required'],   
                'password' => ['required', 'string', 'min:8'],
                'email' => ['required', 'string', 'email', 'unique:users']
            ]);

            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email'=> $datos["email"], 'documento'=> $datos["documento"], 'password'=>Hash::make($datos["password"])]);
        }else if($paciente['email'] == request('email') && request('passwordN') != ""){
            $datos = request()->validate([
                'name' => ['required'],
                'documento' => ['required'],   
                'passwordN' => ['required', 'string', 'min:8'],
                'email' => ['required', 'string', 'email']
            ]);

            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email'=> $datos["email"], 'documento'=> $datos["documento"], 'password'=>Hash::make($datos["passwordN"])]);
        }else{
            $datos = request()->validate([
                'name' => ['required'],
                'documento' => ['required'],   
                'password' => ['required', 'string', 'min:8'],
                'email' => ['required', 'string', 'email']
            ]);

            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email'=> $datos["email"], 'documento'=> $datos["documento"], 'password'=>Hash::make($datos["password"])]);

        }

        return redirect('pacientes')->with('actualizadoP', 'Si');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Paciente::destroy($id);
        return redirect('pacientes');
    }
}
