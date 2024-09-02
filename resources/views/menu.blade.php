@php
    try{
     $usuario= Auth::user()->name;
     $roll=Session::get('rol');
    }catch (Exception $e)
    {
     $usuario= null;
    }
@endphp
<div id="header" class="header">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN header-container -->
        <div class="header-container">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="header-logo">
                <a href="/">
                    <img src="../assets/img/DO/LogoDO.png" alt="logo" width="80px" height="70px">

                    <span class="brand-text">
                        <small class="text-primary">DITRIBUIDORA ORTIZ</small>
							</span>
                </a>
            </div>
            <div class="header-nav">
                <div class=" collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav">
                        <li class="active dropdown dropdown-hover">
                            <a data-toggle="dropdown"><i class="fas fa-lg fa-fw me-10px fa-home"></i>
                                <small>Inicio</small>
                                <b class="caret"></b>
                                <span class="arrow top"></span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/.#noticias">
                                    <small>Noticas</small>
                                </a>
                                <a class="dropdown-item" href="/.#footer">
                                    <small>Enlaces</small>
                                </a>
                            </div>
                        </li>
                        <li class="dropdown dropdown-hover">
                            <a data-toggle="dropdown">
                                <small> Reporte de convenios</small>
                                <b class="caret"></b>
                                <span class="arrow top"></span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/convenio_sis" id="convenio_sis">
                                    <small>Goresa sis fisal 2019</small>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="header-nav">
                <ul class="nav pull-right">
                    <li class="divider"></li>
                    @if($usuario===null)
                        <li>
                            <a href="/login" TITLE="Intranet">
                                <img src="storage/necesarias/intranet.png" class="user-img" alt="Intranet"/>
                                <span class="d-none d-xl-inline">INTRANET</span>
                            </a>
                        </li>
                    @else
                        <li class="dropdown dropdown-hover">
                            <a href="#" data-toggle="dropdown">
                                <img style="width: 30px"
                                src="storage{{ Session::get('perfil')}}" alt=""
                                class="user-img">
                                <small>
                                    <span class="d-none d-xl-inline"> Bienvenido: {{Auth::user()->name}} </span>
                                    <b class="caret"></b>
                                    <span class="arrow top"></span>
                                    <div class="dropdown-menu">
                                        @if($roll==='INTRANET')
                                            <a class="dropdown-item" href="home">INTRANET <i
                                                    class="fas fa-lg fa-fw m-r-10 fa-sign-in-alt text-primary"></i></a>
                                        @endif
                                        <a class="dropdown-item" href="#modal-dialog-perfil" data-toggle="modal">Actualizar
                                            perfil <i class="fa fa-pencil-alt text-success"></i></a>
                                        <a href="{{ route('logout') }}" title="click para salir" class="dropdown-item"

                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Salir') }}

                                            <i class="fas fa-lg fa-fw m-r-10 fa-sign-out-alt text-danger"></i>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </small>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>


            <!-- END header-nav -->
        </div>
        <!-- END header-container -->
    </div>
    <!-- END container -->
</div>








