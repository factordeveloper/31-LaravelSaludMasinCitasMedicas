<header class="main-header">

<a href="{{url('inicio')}}" class="logo">
<div class="logo-mini bg bg-primary"><img src="http://localhost/SaludMasinCitasMedicas/public/images/logo_sm.jpeg" alt="" width="52"></div>    
<div class="logo-lg"><img src="http://localhost/SaludMasinCitasMedicas/public/images/logo_sm_lg.jpeg" alt="" width="200"></div>
</a>


<nav class="navbar navbar-static-top">
    <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle Navigator</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                    {{ auth()->user()->name }}
                 <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ url('mis-datos') }}" class="btn btn-primary btn-flat">Mis Datos</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">Salir</a>
                        </div>
                        <form action="{{ route('logout') }}" method="post" id="logout-form">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

</header> 
