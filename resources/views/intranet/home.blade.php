0<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>UNKICAHO | INTRANET MINI BANCO</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="DACS"/>
    <meta content="" name="jhon suarez"/>
    <link rel="shortcut icon" href="../assets/img/UNKICAHO/LOGO_UNKICAHO.png">
    <link href="{{asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="../assets/css/default/app.min.css" rel="stylesheet"/>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar-default">
        <!-- begin navbar-header -->
        <div class="navbar-header">
            <!--   <a href="/" class="navbar-brand" title="Click para ir a la pagina informativa"> -->
            <img rel="shortcut icon"
                 height="40px"
                 width="40px"
                 src="../assets/img/UNKICAHO/LOGO_UNKICAHO.png"><b>
                &nbsp;UNKICAHO</b>&nbsp;&nbsp;&nbsp;MINI BANCO
            <!--  </a> -->
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <ul class="navbar-nav navbar-right">

            <li class="dropdown navbar-user ">


                <a href="{{ route('logout') }}" title="click para salir"

                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-lg fa-fw m-r-10 fa-sign-out-alt" style="color: red"></i>
                    {{ __('Salir') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </li>
        </ul>
        <!-- end header-nav -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <input type="text" id="iduser" value="{{ Auth::user()->id }}" hidden>
            <ul class="nav">
                <li class="nav-profile has-sub">
                    <a href="javascript:">
                        <div class="cover with-shadow"></div>
                        <div class="image">
                            <img src="storage{{ Session::get('perfil')}}" title="imagen de perfil"/>
                        </div>
                        <div class="info">
                            <small>BIENVENIDO </small>
                            {{ Auth::user()->name }}
                        </div>
                    </a>
                    <ul class="sub-menu ">
                        <li><a id="actper" href="#modal-dialog-perfil" data-toggle="modal"><i class="fa fa-pencil-alt"></i>Actualizar
                                perfil</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav" id="panel">


            </ul>


            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>

    <!-- end #sidebar -->

    <!-- begin #content -->
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content"></div>
    <!-- end #content -->

    <div class="modal fade" id="modal-dialog-perfil">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar perfil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <form role="form" method="POST" action="{{route('subir')}}" accept-charset="UTF-8"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12 row ">
                                <input id="id" name="id" type="text" value="{{ Auth::user()->id }}" hidden>
                                <div class="form-group col-md-6">
                                    Nombre de cuenta
                                    <input id="nombre" name="nombre" class="form-control " type="text"
                                           autocomplete="off"
                                           value="{{ Auth::user()->name }}" required
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    Email <input id="email" type="email" name="email" class="form-control"
                                                 placeholder="Enter email"
                                                 autocomplete="off" value="{{ Auth::user()->email }}" required/>
                                </div>
                                <div class="col-md-6 form-group">
                                    Imagen de perfil
                                    <input id="archivo" type="file" name="archivo" accept=".png,.jpg"
                                    />
                                </div>
                            </div>
                            <hr style="color: #0056b2;"/>

                            <div class="col-md-12 row">
                                <div class="form-group col-md-12 text-center">
                                    CONTRASEÑA:cambiar si lo concidera necesario
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contra1">Nueva contraseña
                                    </label>
                                    <div class="input-group m-b-10">
                                        <input id="contra1" class="form-control " name="contra1" type="password"
                                               autocomplete="off"/>
                                        <button tabindex="100" id="eye" title="Haga clic aquí para mostrar / ocultar la contraseña" class="btn btn-outline-secondary" type="button"hidden>
                                            <i class="fa icon-eye-open fa-eye">
                                            </i></button>
                                        <button tabindex="100" id="eyes"title="Haga clic aquí para mostrar / ocultar la contraseña" class="btn btn-outline-secondary" type="button"hidden>
                                            <i class="fa icon-eye-close fa-eye-slash">
                                            </i></button>
                                        <div class="hide " id="valcontra1"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contra2">Repita contraseña
                                    </label>
                                    <div class="input-group m-b-10">
                                        <input id="contra2" name="contra2" type="password"
                                               class="form-control typeahead"
                                               autocomplete="off" value=""/>
                                        <button tabindex="100" id="eye1" title="Haga clic aquí para mostrar / ocultar la contraseña" class="btn btn-outline-secondary" type="button"hidden>
                                            <i class="fa icon-eye-open fa-eye">
                                            </i></button>
                                        <button tabindex="100" id="eyes1"title="Haga clic aquí para mostrar / ocultar la contraseña" class="btn btn-outline-secondary" type="button"hidden>
                                            <i class="fa icon-eye-close fa-eye-slash">
                                            </i></button>
                                        <div class="hide " id="valcontra2"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-12 text-center">
                                <a href="javascript:" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>
                                    Cerrar</a>
                                <button name="enviar" id="enviar" class="btn btn-success" type="submit">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-paper-plane"></i>editar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- begin scroll to top btn -->
<a href="javascript:" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i
        class="fa fa-angle-up"></i></a>


<!-- ================== BEGIN BASE JS ================== -->
<!--<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>-->
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/js/theme/default.min.js"></script>
<script>

    App.settings({
        ajaxMode: true,
        ajaxDefaultUrl: '/inicio',
        ajaxType: 'GET',
        ajaxDataType: 'html'
    });
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/gritter/js/jquery.gritter.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/panel.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });
</script>
<!-- ================== END BASE JS ================== -->
</body>
</html>
