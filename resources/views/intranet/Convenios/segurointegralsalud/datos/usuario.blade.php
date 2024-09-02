<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>


<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>

<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="../js/typeahead/bootstrap3-typeahead.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>

<link rel="stylesheet" href="../assets/plugins/datatables.net/css/buttons.dataTables.min.css">
<script src="../assets/plugins/datatables.net/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables.net/js/buttons.flash.min.js"></script>
<script src="../assets/plugins/datatables.net/js/jszip.min.js"></script>
<script src="../assets/plugins/datatables.net/js/pdfmake.min.js"></script>
<script src="../assets/plugins/datatables.net/js/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables.net/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables.net/js/buttons.print.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token()}}"/>
<style>
    req {
        color: red;
    }

</style>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<br>
<br>
<div id="response">

    <!-- final cabecera -->


    <div class="row">
        <!---------------------------------------- begin panel PERSONAL ------------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">Usuario
                <small>Aqui puedo agregar a los usuarios</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">REPORTAR USUARIO</h1>
                    <div class="panel-heading-btn">
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                                class="fa fa-redo"></i></a>
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                                class="fa fa-minus"></i></a>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-xl-12">
                        <!--<a href="/registrarusuarios" class="btn btn-blue btn-sm"
                           title="click para agregar un nuevo usuario" data-toggle="ajax">
                            <i class="fa fa-plus-circle"></i> Agregar usuario
                        </a>-->
                        <button id="addUsuario" class="btn btn-success " title="click para agregar Usuario"
                                data-toggle="modal" data-target="#modal_dialog_add_usuario">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Usuario
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_usuario"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            NOMBRES
                                        </th>
                                        <th>
                                            PERFIL
                                        </th>
                                        <th>
                                            USUARIO
                                        </th>
                                        <th>
                                            PERMISO
                                        </th>
                                        <th>
                                            CORREO
                                        </th>
                                        <th>
                                            ROL
                                        </th>
                                        <th>
                                            ESTADO
                                        </th>
                                        <th>
                                            OPCIONES
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!----------------------------------------End Panel PERSONAL---------------------------------------->

    </div>
</div>
<!----------------------------------------INICIO MODAL AGREGAR PERSONAL---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_usuario">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR USUARIO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS PERSONA
                        (
                        <req>*</req>
                        <small>Dato obligatorio</small>)
                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idperson"hidden/>
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="tipdoc">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="tipdoc" disabled>

                            </select>
                            <div id="valtipodoc"></div>
                        </div>

                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="dni">N&#35; DOC
                                <req>*</req>
                            </label>
                            <input id="dni" type="number" class="form-control form-control-sm" autocomplete="off"
                                   onchange="validDniUser()" />
                            <div class="hide " id="validDni"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4" id="hidappaternous">
                            <label for="appaterno">APPATERNO
                                <req>*</req>
                            </label>
                            <input id="appaterno" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onchange="generarUsuario()" disabled onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valappaterno"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4" id="hidapmaternous">
                            <label for="apmaterno">APMATERNO
                                <req>*</req>
                            </label>
                            <input id="apmaterno" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onchange="generarUsuario()" disabled onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valapmaterno"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4" id="hidnombresus">
                            <label for="nombres">NOMBRES
                                <req>*</req>
                            </label>
                            <input id="nombres" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onchange="generarUsuario()" disabled onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valnombres"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4" id="hidfecnacus">
                            <label for="fecnac">FECNAC
                                <req>*</req>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="fecnac" autocomplete="off">
                            <div class="hide " id="valfecnac"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="telefo">TELEFONO
                            </label>
                            <input id="telefo" type="number" class="form-control form-control-sm"
                                   onchange="validCelular('telefo','valtelefo','enviaruser')"
                                   autocomplete="off"/>
                            <div class="" id="valtelefo"></div>
                        </div>
                        <hr>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION DNI

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="depar">DEPARTAMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="depar">
                                <option selected>AMAZONAS</option>
                            </select>
                            <div class="hide " id="valdepar"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="prov">PROVINCIA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="prov" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valprov"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="dis">DISTRITO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="dis" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valdis"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="dir">DIRECCION
                                <req>*</req>
                            </label>
                            <input id="dir" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div id="valdir"></div>
                        </div>
                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS USUARIO</legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="nombrecu"> NOMBRE DE CUENTA
                                <req>*</req>
                            </label>
                            <input id="nombrecu" class="form-control " type="text" autocomplete="off"
                                   required disabled/>
                            <div id="valnombrecu"></div>
                        </div>

                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="emailcu"> EMAIL
                                <req>*</req>
                            </label>
                            <input id="emailcu" type="email" class="form-control"
                                   autocomplete="off" required/>
                            <div id="valemailcu"></div>
                        </div>
                        <div class="col-xl-4 col-sm-4 col-xs-4">
                            <label for="rocu"> ROL
                                <req>*</req>
                            </label>
                            <select id="rocu" name="rol" class="form-control">
                            </select>
                            <div id="valrocu"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviaruser" class="btn btn-success " title="click para agregar Usuario
                    " onclick="enviarUser()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR PERSONAL---------------------------------------->

<!----------------------------------INICIO DE MODAL  EDITAR USUARIO------------------------------------------------ -->
<div class="col-xl-12 ">
    <div class="modal fade" id="modal_dialog_edit_Usuario">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR USUARIO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input id="idpersedit" type="text" class="form-control" hidden/>
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                            DATOS PERSONA
                        </legend>
                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="tipdocedit"> TIPO DOCUMENTO
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="tipdocedit">
n>
                                </select>
                                <div class="hide " id="valtipodocedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="dniedit">N° DOC
                                    <req>*</req>
                                </label>
                                <input id="dniedit" type="number" class="form-control " autocomplete="off"
                                       onchange="validarDniExpress()"/>
                                <div class="hide " id="valdniedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="appaternoedit">APPATERNO
                                    <req>*</req>
                                </label>
                                <input id="appaternoedit" type="text" class="form-control" autocomplete="off"
                                       onchange="generarUsuarioEdit()"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <div class="hide " id="valappaternoedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="apmaternoedit">APMATERNO
                                    <req>*</req>
                                </label>
                                <input id="apmaternoedit" type="text" class="form-control" autocomplete="off"
                                       onchange="generarUsuarioEdit()"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <div class="hide " id="valapmaternoedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="nombresedit">NOMBRES
                                    <req>*</req>
                                </label>
                                <input id="nombresedit" type="text" class="form-control " autocomplete="off"
                                       onchange="generarUsuarioEdit()"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <div class="hide " id="valpnombreedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="fecnacedit">FECNAC
                                    <req>*</req>
                                </label>
                                <input type="text" class="form-control" id="fecnacedit" autocomplete="off">
                                <div class="hide " id="valfecnacedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="telefoedit">TELEFONO
                                </label>
                                <input id="telefoedit" type="number" class="form-control"
                                       onchange="validCelular('telefoedit','valtelefoedit','enviaredituser')" autocomplete="off"/>
                                <div class="hide" id="valtelefoedit"></div>
                            </div>
                        </div>
                        <br>
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">
                            DATOS UBICACION DNI
                        </legend>
                        <hr>
                        <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="deparu">DEPARTAMENTO
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="deparu">
                                </select>
                                <div class="hide " id="valdeparuedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="provu">PROVINCIA
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="provu">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valprovuedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="disu">DISTRITO
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="disu">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valdisuedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="diredit">DIRECCION
                                    <req>*</req>
                                </label>
                                <input id="diredit" type="text" class="form-control "
                                       onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <div id="valdiredit"></div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                            <input id="iduseredit" type="text" class="form-control" hidden/>
                            <input id="idrolusedit" type="text" class="form-control" hidden/>
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS USUARIO
                            </legend>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="nombrecuedit"> NOMBRE DE CUENTA
                                    <req>*</req>
                                </label>
                                <input id="nombrecuedit" class="form-control " type="text" autocomplete="off"
                                       required disabled/>
                                <div id="valnombrecuedit"></div>
                            </div>

                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="emailcuedit"> EMAIL
                                    <req>*</req>
                                </label>
                                <input id="emailcuedit" type="email" class="form-control"
                                       autocomplete="off" required/>
                                <div id="valemailcuedit"></div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="rocuedit"> ROL
                                    <req>*</req>
                                </label>
                                <select id="rocuedit" name="rol" class="form-control">
                                </select>
                                <div id="valrocuedit"></div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviaredituser" class="btn btn-success " title="click para editar usuario
                    " onclick="enviarEditUser()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------FIN DE MODAL DE EDITAR USUARIO--------------------------------------->
<!-- #INICIO MODAL PERMISOS -->
<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Permisos usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <hr>
                <div>
                    <table id="tabla_permisos" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th width="1%" class="text-center">Modulo</th>
                            <th class="text-nowrap text-center">DescModulo</th>
                            <th class="text-nowrap text-center">SubMenu</th>
                            <th width="1%" class="text-center">Estado</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-success" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>
<!-- #FIN MODAL PERMISOS -->

<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/datos/usuario.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>

