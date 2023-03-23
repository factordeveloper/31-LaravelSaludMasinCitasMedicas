@extends('plantilla')


@section('contenido')
<style>
        #logo_masin{
            margin-bottom:20px;
            margin-top:20px;
        }
       
    </style>
<div class="login-box">
    <div class="login-logo">
       
    </div>
   
    <div class="login-box-body">

     <center>
    <img src="images/logo_sm_lg.jpeg" alt="" width="100%" id="logo_masin">
    </center>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" required="" value="" placeholder="Ingresa Usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            @error('email')
            <br>
            <div class="alert alert-danger">Error en el email o la contraseña</div>

            @enderror

            <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" required="" placeholder="Ingresa Password" value="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
            </div>


        </form>

    </div>


</div>



@endsection