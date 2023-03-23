@extends('plantilla')

@section('contenido')

<section class="content">
    <style>
        #logo_masin{
            margin-bottom:30px;
            margin-top:30px;
        }
        #logins{
            margin-top:30px;
            
        }
    </style>
<center>
    <img src="images/logo_sm_lg.jpeg" alt="" width="50%" id="logo_masin">
    <h1 class="m-3">Selecciona tu rol para ingresar...</h1>
    
</center>

<div class="row" id="logins">
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="small-box" style="background-color: #F781D8; color: white;">

            <div class="inner">
            <h3>Secretaria</h3>
            <p>Iniciar Sesión</p>
            </div>
            <div class="icon">
            <i class="fa fa-female"></i>
            </div>
            <a href="ingresar" class="small-box-footer">
            Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
       </div>
    </div>



    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="small-box" style="background-color: #BDBDBD; color: white;">

            <div class="inner">
            <h3>Doctor</h3>
            <p>Iniciar Sesión</p>
            </div>
            <div class="icon">
            <i class="fa fa-user-md"></i>
            </div>
            <a href="ingresar" class="small-box-footer">
            Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="small-box bg-yellow">

            <div class="inner">
            <h3>Paciente</h3>
            <p>Iniciar Sesión</p>
            </div>
            <div class="icon">
            <i class="fa fa-users"></i>
            </div>
            <a href="ingresar" class="small-box-footer">
            Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>



    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class="small-box bg-red">

            <div class="inner">
            <h3>Administrador</h3>
            <p>Iniciar Sesión</p>
            </div>
            <div class="icon">
            <i class="fa fa-male"></i>
            </div>
            <a href="ingresar" class="small-box-footer">
            Ingresar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


</div>








</section>

@endsection