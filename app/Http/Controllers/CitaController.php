<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id)
    {
        if(auth()->user()->rol == "Doctor" && $id != auth()->user()->id){

            return redirect('inicio');
        }

        $horarios = DB::select('select * from horarios where id_doctor = '.$id);

        $pacientes = Paciente::all();

        $citas = Cita::all()->where('id_doctor', $id);

        $doctor = Doctor::find($id);

        return view('modulos.citas', compact('horarios', 'pacientes', 'citas', 'doctor'));
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

    public function HorarioDoctor(Request $request)
    {
        $datos = request();

        DB::table('horarios')->insert(['id_doctor' => auth()->user()->id, 'horaInicio' => $datos["horaInicio"], 'horaFin' => $datos["horaFin"]]);

        return redirect('citas/'.auth()->user()->id);
    }

    public function EditarHorario(Request $request)
    {
        $datos = request();

        DB::table('horarios')->where('id', $datos['id'])->update(['horaInicio' => $datos["horaInicioE"], 'horaFin' => $datos["horaFinE"]]);

        return redirect('citas/'.auth()->user()->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
   

    public function  CrearCita(Request $id_doctor)
    {
        Cita::create(['id_doctor' => request('id_doctor'), 'id_paciente' => request('id_paciente'), 'FyHinicio' => request('FyHinicio'), 'FyHfinal' => request('FyHfinal')]);

        return redirect('citas/'.request('id_doctor'));
    }
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {

        DB::table('citas')->whereId(request('idCita'))->delete();
        return redirect('citas/'.request('idDoctor'));
    }


    public function historial(Request $request, Cita $cita)
    {
        
        if(auth()->user()->rol != "Paciente"){
            return view('modulos.inicio');
        }else{
            $citas = Cita::all()->where('id_paciente', auth()->user()->id);

            $doctores = User::all()->where('rol', 'Doctor');

            $consultorios = Consultorio::all();

            return view('modulos.historial', compact('citas', 'doctores', 'consultorios'));
        }
       
    }

}
