@extends('plantilla')

@section('content')

<div class="content-wrapper">

<section class="content-header">

<h1>Inicio</h1>

</section>
<section class="content">
    <div class="box">

    <div class="box-body">

<div class="col-md-6 bg-primary">

<h1>Bienvenidos</h1>
<hr>
<h2>Días:</h2>
<h3>{{$inicio->dias}}</h3>
<hr>
<h2>Horarios:</h2>
<h3>Desde: {{$inicio->horaInicio}}</h3>
<h3>Hasta: {{$inicio->horaFin}}</h3>

<hr>

<h2>Dirección:</h2>
<h3>{{$inicio->direccion}}</h3>

<hr>
<h2>Contactos:</h2>
<h3>Teléfono: {{$inicio->telefono}}</h3>
<h3>Correo: {{$inicio->email}}</h3>


</div>

<div class="col-md-6">

<img src="http://localhost/SaludMasinCitasMedicas/public/storage/{{$inicio->logo}}" alt="" class="img-responsive">


</div>


    </div>
@if( auth()->user()->rol == "Administrador" )
    <div class="box-footer">

      <a href="{{url('inicio-editar')}}">
        <button class="btn btn-success btn-lg">Editar</button>
      </a>

    </div>
@endif

    </div>
</section>
</div>

@endsection
