@extends('plantilla')

@section('content')

<div class="content-wrapper">

<section class="content-header">

<h1>Mis Datos Personales</h1>

</section>
<section class="content">
    <div class="box">

    <div class="box-body">

<form action="" method="POST">

@csrf
@method('put')

<div class="row">

<div class="col-md-6 col-xs-12">


<h2>Nombre y Apellido</h2>
<input type="text" name="name" class="form-control input-lg" value="{{ auth() ->user()->name }}">

<h2>Email</h2>
<input type="email" name="email" class="form-control input-lg" value="{{ auth() ->user()->email }}">

@error('email')

<p class="alert alert-danger">El Email ya existe !!!</p>


@enderror

<h2>Nueva Contraseña</h2>
<input type="text" name="passwordN" class="form-control input-lg" value="">

</div>

<div class="col-md-6 col-xs-12">


<h2>Documento</h2>
<input type="text" name="documento" class="form-control input-lg" value="{{ auth() ->user()->documento }}">



<h2>Teléfono</h2>
<input type="text" name="telefono" class="form-control input-lg" value="{{ auth() ->user()->telefono }}">

<br>
<br>
<br>

<button type="submit" class="btn btn-success">Guardar</button>

</div>



</div>


</form>
    
    </div>


    </div>
</section>
</div>

@endsection
