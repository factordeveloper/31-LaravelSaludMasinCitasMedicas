@extends('plantilla')

@section('content')

<div class="content-wrapper">

<section class="content-header">

<h1>Gestor de consultorios</h1>

</section>
<section class="content">
    <div class="box">

<br>
<form action="" method="POST">
@csrf
<div class="col-xs-6 col-md-6">
<input type="text" class="form-control" name="consultorio" placeholder="Ingrese Nuevo Consultorio" required>

</div>

<button class="btn btn-primary" type="submit">Agregar Consultorio</button>

</form>

<br>

<div class="box-body">

    @foreach($consultorios as $consultorio)



    <div class="row">

     <form action="{{ url('consultorio/'.$consultorio->id) }}" method="POST">

        @csrf
        @method('put')
        <div class="col-md-6 col-xs-6">
            <input type="text" name="consultorioEditar" class="form-control" value="{{ $consultorio->consultorio }}">
            <br>
        </div>

        <div class="col-md-3 col-xs-3">
            <button class="btn btn-success col-md-12 col-xs-12" type="submit">Guardar</button>
        </div>


     </form>

     <div class="col-md-3 col-xs-3">
        <form action="{{ url('borrar-consultorio/'.$consultorio->id) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger col-md-12 col-xs-12" onclick="return confirm('¿ Eliminar Consultorio ?')">Borrar</button>
        </form>
     </div>
     </div>
     @endforeach
</div>

    </div>
</section>
</div>

@endsection
