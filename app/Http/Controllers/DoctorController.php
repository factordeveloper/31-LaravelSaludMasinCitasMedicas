<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Consultorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
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
        if(auth()->user()->rol != "Administrador" && auth()->user()->rol != "Secretaria"){
            return redirect('inicio');
        }
        $consultorios = Consultorio::all();

        $doctores = Doctor::all();

        //return view('modulos.doctores')->with('consultorios', $consultorios);
        return view('modulos.doctores', compact('consultorios', 'doctores'));
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

    public function VerDoctores($id)
    {
        $consultorio = Consultorio::find($id);

        $doctores = DB::select('select * from users where id_consultorio = '.$id);

        $horarios = DB::select('select * from horarios');

        return view("modulos.ver-doctores", compact('consultorio', 'doctores', 'horarios'));
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
         'sexo' => ['required'],   
         'id_consultorio' => ['required'],
         'password' => ['required', 'string', 'min:8'],
         'email' => ['required', 'string', 'email', 'unique:users']

        ]);

        Doctor::create([

          'name' => $datos['name'],
          'id_consultorio' => $datos['id_consultorio'],
          'email' => $datos['email'],
          'sexo' => $datos['sexo'],
          'documento' => '',
          'telefono' => '',
          'rol' => 'Doctor',
          'password' => Hash::make($datos['password'])

        ]);

        return redirect('doctores')->with('registrado', 'Si');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->whereId($id)->delete();

        return redirect('doctores');
    }
}
