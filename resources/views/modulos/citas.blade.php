@extends('plantilla')

@section('content')

<div class="content-wrapper">

<section class="content-header">

@if($doctor->sexo == "Femenino")

<h2>Doctora: {{ $doctor->name }}</h2>

@else

<h2>Doctor: {{ $doctor->name }}</h2>

@endif

<h1>Horarios</h1>

@if($horarios == null)

@if(auth()->user()->rol == "Doctor")


<form action="{{ url('horario') }}" method="POST">

@csrf


<div class="row">

<div class="col-md-2">
Desde <input type="time" name="horaInicio" class="form-control" id="">
</div>

<div class="col-md-2">
Hasta <input type="time" name="horaFin" class="form-control" id="">
</div>

<br>

<div class="col-md-1">

<button type="submit" class="btn btn-success">Guardar</button>


</div>


</div>


</form>

@endif

@else

@foreach($horarios as $hora)

@if(auth()->user()->rol == "Doctor")

<form action="{{ url('editar-horario/'.$hora->id) }}" method="POST">

@csrf
@method('put')
<div class="row">

<div class="col-md-2">
Desde <input type="time" name="horaInicioE" class="form-control" value="{{$hora->horaInicio}}">
</div>

<div class="col-md-2">
Hasta <input type="time" name="horaFinE" class="form-control" value="{{$hora->horaFin}}">
</div>

<br>

<div class="col-md-1">

<button type="submit" class="btn btn-success">Editar</button>


</div>


</div>


</form>

@elseif(auth()->user()->rol == "Paciente")

<h2>{{ $hora->horaInicio }} - {{ $hora->horaFin }}</h2>

@endif

@endforeach



@endif


</section>
<section class="content">
    <div class="box">

        <div class="box-body">

        <div id="calendario"></div>

        </div>


    </div>
</section>
</div>


<div class="modal fade" id="CitaModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="POST">
               @csrf
                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                        <h2>Seleccionar Paciente</h2>

                        <input type="hidden" name="id_doctor" value="{{ auth()->user()->id }}">

                        <select name="id_paciente" id="select2" style="width: 100%" required>

                            <option value="">Paciente ....</option>

                            @foreach($pacientes as $paciente)

                            @if($paciente->rol == "Paciente")


                            <option value="{{ $paciente->id }}">{{ $paciente->name }} - {{ $paciente->documento }}</option>

                            @endif

                            @endforeach

                        </select>

                        </div>

                        <div class="form-group">

                        <h2>Fecha</h2>
                        <input type="text" class="form-control input-lg" id="Fecha" readonly>

                        </div>

                        <div class="form-group">

                        <h2>Hora</h2>
                        <input type="text" class="form-control input-lg" id="Hora" readonly>

                        <input type="hidden" name="FyHinicio" class="form-control input-lg" id="FyHinicio" readonly>
                        <input type="hidden" name="FyHfinal" class="form-control input-lg" id="FyHfinal" readonly>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pedir Cita</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

            </form>

        </div>

    </div>

</div>

<div class="modal fade" id="EventoModal">

   <div class="modal-dialog">
        <div class="modal-content">
                
          <form action="{{ url('borrar-cita') }}" method="POST">
@csrf
@method('delete')
            <div class="modal-body">


                <div class="form-group">
                     <h2>Paciente:</h2>
                     <h4 id="paciente"></h4>
                     <input type="hidden" name="idCita" id="idCita">

                    <?php
                       $exp = explode("/", $_SERVER["REQUEST_URI"]);

                       echo ' <input type="hidden" name="idDoctor" value="'.$exp[4].'">';
                    ?>

                    
                </div>
            
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Cancelar Cita</button>
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
            </div>

          </form>


        </div>
   </div>

</div>


<div class="modal fade" id="Cita">


<div class="modal-dialog">


<div class="modal-content">

<form action="" method="POST">

@csrf

<div class="modal-body">

<div class="box-body">


<div class="form-group">

<?php

$exp = explode("/", $_SERVER["REQUEST_URI"]);

echo '<input type="hidden" name="id_doctor" id="" value="'.$exp[4].'">';

?>



<input type="hidden" name="id_paciente" id="" value="{{ auth()->user()->id }}">


</div>


<div>

<div class="form-group">

<h2>Fecha:</h2>

<input type="text" class="form-control input-lg" id="FechaP" readonly>

</div>

<div class="form-group">

<h2>Hora:</h2>

<input type="text" class="form-control input-lg" id="HoraP" readonly>

</div>

<div class="form-group">


<input type="hidden" class="form-control input-lg" id="FyHinicioP" name="FyHinicio" readonly>

<input type="hidden" class="form-control input-lg" id="FyHfinalP" name="FyHfinal" readonly>

</div>

</div>

</div>


</div>

<div class="modal-footer">

<button class="btn btn-primary" type="submit">Pedir Cita</button>

<button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>

</div>

</form>



</div>


</div>


</div>


@endsection
