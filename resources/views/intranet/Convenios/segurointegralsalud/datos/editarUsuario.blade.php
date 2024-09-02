<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<script src="../js/intranet/datos/editarUsuario.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- ================== END BASE CSS STYLE ================== -->
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<div id="response">
    <h1 class="page-header">Editar Usuario
        <small>Aqui puedo editar usuarios</small>
    </h1>
    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>

            </div>
            <h4 class="panel-title">Usuarios</h4>
        </div>

        <div class="panel-body">
            <div class="panel-body">

                <div class="row justify-content-center">
                    <input id="iduser" type="text" class="form-control " value="{{$usuario->id}}" hidden/>
                    <legend class="m-b-15">DATOS PERSONA <a href="#" class="btn btn-success btn-icon btn-circle btn-sm"
                                                            title="Recagar pantalla" id="recargarpant">
                            <i class="fa fa-redo"></i>
                        </a></legend>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-3 ">
                            <label for="tipdoc">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="tipdoc">
                                <option selected value="0">SELECCIONE</option>
                                <option value="1">DNI</option>
                                <option value="2">CARNET EXTRANJERIA</option>
                                <option value="3">OTROS</option>
                            </select>
                            <div id="validtipodoc"></div>
                        </div>

                        <div class="col-xl-3 ">
                            <label for="dni">N° DOC
                                <req>*</req>
                            </label>
                            <input id="dni" type="number" class="form-control " autocomplete="off"
                                   onchange="validarDniExpress()"/>
                            <div class="hide " id="validDni"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="appaterno">APPATERNO
                                <req>*</req>
                            </label>
                            <input id="appaterno" type="text" class="form-control" autocomplete="off"
                                   onchange="generarUsuario()"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valappaterno"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="apmaterno">APMATERNO
                                <req>*</req>
                            </label>
                            <input id="apmaterno" type="text" class="form-control" autocomplete="off"
                                   onchange="generarUsuario()"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valapmaterno"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="pnombre">PNOMBRE
                                <req>*</req>
                            </label>
                            <input id="pnombre" type="text" class="form-control " autocomplete="off"
                                   onchange="generarUsuario()"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valpnombre"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="snombre">SNOMBRE</label>
                            <input id="snombre" type="text" class="form-control" autocomplete="off"
                                   onchange="generarUsuario()"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valsnombre"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="fecnac">FECNAC
                                <req>*</req>
                            </label>
                            <input type="text" class="form-control" id="fecnac" autocomplete="off">
                            <div class="hide " id="valfecnac"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="telefo">TELEFONO
                                <req>*</req>
                            </label>
                            <input id="telefo" type="number" class="form-control" onchange="validarCelular()"
                                   autocomplete="off"/>
                            <div class="" id="telefovalid"></div>
                        </div>
                        <hr>

                    </div>

                    <legend class="m-b-15">UBICACION</legend>

                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS UBICACION DNI
                        </legend>
                        <div class="col-xl-3 ">
                            <label for="depar">DEPARTAMENTO</label>
                            <select class="form-control" id="depar">
                            </select>
                            <div class="hide " id="valdepar"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="prov">PROVINCIA
                                <req>*</req>
                            </label>
                            <select class="form-control" id="prov">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valprov"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="dis">DISTRITO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="dis">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valdis"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="dir">DIRECCION
                                <req>*</req>
                            </label>
                            <input id="dir" type="text" class="form-control "
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div id="dirval"></div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row">
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ESTABLECIMIENTO DONDE
                            ATIENDE
                        </legend>
                        <div class="col-xl-3 ">
                            <label for="depar">DEPARTAMENTO</label>
                            <select class="form-control" id="depar" disabled>
                                <option selected>AMAZONAS</option>
                            </select>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="provacte">PROVINCIA
                                <req>*</req>
                            </label>
                            <select id="provacte" class="form-control">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div id="valprovacte"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="disacte">DISTRITO
                                <req>*</req>
                            </label>
                            <select id="disacte" class="form-control" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div id="valdisacte"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="estate">ESTABLECIMIENTO
                                <req>*</req>
                            </label>
                            <select id="estate" class="form-control" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div id="valestate"></div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS USUARIO
                        </legend>
                        <div class="col-xl-3 ">
                            <label for="nombrecu"> NOMBRE DE CUENTA
                                <req>*</req>
                            </label>
                            <input id="nombrecu" class="form-control " type="text" autocomplete="off"
                                   required disabled/>
                            <div id="valnombrecu"></div>
                        </div>

                        <div class="col-xl-3 ">
                            <label for="emailcu"> EMAIL
                                <req>*</req>
                            </label>
                            <input id="emailcu" type="email" class="form-control"
                                   autocomplete="off" required/>
                            <div id="valemailcu"></div>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="rocu"> ROL
                                <req>*</req>
                            </label>
                            <select id="rocu" name="rol" class="form-control">
                            </select>
                            <div id="valrocu"></div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-xl-12 text-center">
                <hr>
                <button class="btn btn-danger" title="click para cancelar
                    " href="/usuario" data-toggle="ajax"><i class="fas fa-lg fa-fw m-r-10  fa-times"></i>Cancelar
                </button>
                <button id="editar" class="btn btn-success" title="click para agregar usuario
                    "><i class="fas fa-lg fa-fw m-r-10 fa-paper-plane"></i>editar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/datos/editarUsuario.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });
</script>
