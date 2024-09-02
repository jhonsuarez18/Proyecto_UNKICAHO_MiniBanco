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
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<style>
    req {
        color: red;
    }

</style>
<br>
<br>
<div id="response">

    <!-- final cabecera -->


    <div class="row">
        <!---------------------------------------- begin panel PACIENTE ------------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">Paciente
                <small>Aqui puedo agregar al paciente de referencia</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">PACIENTE</h1>
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
                        <button id="addPacref" class="btn btn-success " title="click para agregar Usuario a Oficina"
                                data-toggle="modal" data-target="#modal_dialog_add_persref">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Paciente
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_Pacref"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            NOMBRES COMPLETOS
                                        </th>
                                        <th>
                                            DNI
                                        </th>
                                        <th>
                                            CODIGO UBIGEO
                                        </th>
                                        <th>
                                            TIPO SEGURO
                                        </th>
                                        <th>
                                            TELEFONO
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO REG.
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
        <!----------------------------------------End Panel PACIENTE---------------------------------------->

    </div>
</div>
<!----------------------------------------INICIO MODAL AGREGAR PACIENTE---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_pacref">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR PACIENTE</h4>
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
                        <div class="col-xl-6 ">
                            <label for="tipdoc">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="tipdoc">
                                <option selected value="0">SELECCIONE</option>
                                <option value="1">DNI</option>
                                <option value="2">CARNET EXTRANJERIA</option>
                                <option value="3">OTROS</option>
                            </select>
                            <div id="validtipodoc"></div>
                        </div>

                        <div class="col-xl-6 ">
                            <label for="dni">N&#35; DOC
                                <req>*</req>
                            </label>
                           <input id="dni" type="number" class="form-control form-control-sm" autocomplete="off"
                                   onchange="validarDni()" disabled/>
                            <div class="hide " id="validDni"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="appaterno">APPATERNO
                                <req>*</req>
                            </label>
                            <input id="appaterno" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valappaterno"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="apmaterno">APMATERNO
                                <req>*</req>
                            </label>
                            <input id="apmaterno" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valapmaterno"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="pnombre">PNOMBRE
                                <req>*</req>
                            </label>
                            <input id="pnombre" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valpnombre"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="snombre">SNOMBRE</label>
                            <input id="snombre" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valsnombre"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="fecnac">FECNAC
                                <req>*</req>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="fecnac" autocomplete="off">
                            <div class="hide " id="valfecnac"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="telefo">TELEFONO
                                <req>*</req>
                            </label>
                            <input id="telefo" type="number" class="form-control form-control-sm"
                                   onchange="validCelular('telefo','valtelefo','enviarpac')"
                                   autocomplete="off"/>
                            <div class="" id="valtelefo"></div>
                        </div>
                        <hr>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION DNI

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <label for="depar">DEPARTAMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="depar">
                                <option selected>AMAZONAS</option>
                            </select>
                            <div class="hide " id="valdepar"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="prov">PROVINCIA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="prov" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valprov"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="dis">DISTRITO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="dis" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valdis"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <input type="text" id="idcentp" value="0" hidden/>
                            <label for="cenpo">CENTRO POBLADO</label>
                            <input type="text" class="form-control form-control-sm typeahead" id="cenpo"
                                   name="cenpo" autocomplete="off">
                            <div id="cenpoval"></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="ref">REFERENCIA DE UBICACION</label>
                            <input id="ref" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="dir">DIRECCION
                            </label>
                            <input id="dir" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div id="dirval"></div>
                        </div>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">TIPO DE SEGURO

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <label for="tipseg">TIPO SEGURO</label>
                            <req>*</req>
                            <select class="form-control form-control-sm" id="tipseg"></select>
                            <div id="valtipseg"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarpac" class="btn btn-success " title="click para agregar paciente
                    " onclick="enviarPac()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR PACIENTE---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR PACIENTE---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_pacref">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR PACIENTE</h4>
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
                        <input type="text" id="idpersonedit"hidden/>
                        <div class="col-xl-6 ">
                            <label for="tipdocedit">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="tipdocedit">
                                <option selected value="0">SELECCIONE</option>
                                <option value="1">DNI</option>
                                <option value="2">CARNET EXTRANJERIA</option>
                                <option value="3">OTROS</option>
                            </select>
                            <div id="validtipodocedit"></div>
                        </div>

                        <div class="col-xl-6 ">
                            <label for="dniedit">N&#35; DOC
                                <req>*</req>
                            </label>
                            <input id="dniedit" type="number" class="form-control form-control-sm" autocomplete="off"
                                   onchange="validarDni()" disabled/>
                            <div class="hide " id="validDniedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="appaternoedit">APPATERNO
                                <req>*</req>
                            </label>
                            <input id="appaternoedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valappaternoedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="apmaternoedit">APMATERNO
                                <req>*</req>
                            </label>
                            <input id="apmaternoedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valapmaternoedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="pnombreedit">PNOMBRE
                                <req>*</req>
                            </label>
                            <input id="pnombreedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valpnombreedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="snombreedit">SNOMBRE</label>
                            <input id="snombreedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valsnombreedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="fecnacedit">FECNAC
                                <req>*</req>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="fecnacedit" autocomplete="off">
                            <div class="hide " id="valfecnacedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="telefoedit">TELEFONO
                                <req>*</req>
                            </label>
                            <input id="telefoedit" type="number" class="form-control form-control-sm" onchange="validarCelular()"
                                   autocomplete="off"/>
                            <div class="" id="valtelefoedit"></div>
                        </div>
                        <hr>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION DNI

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="siti"hidden/>
                        <div class="col-xl-6 ">
                            <label for="deparedit">DEPARTAMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="deparedit">
                                <option selected>AMAZONAS</option>
                            </select>
                            <div class="hide " id="valdeparedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="provedit">PROVINCIA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="provedit">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valprovedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="disedit">DISTRITO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="disedit" >
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valdisedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <input type="text" id="idcentpedit"hidden/>
                            <label for="cenpoedit">CENTRO POBLADO</label>
                            <input type="text" class="form-control form-control-sm typeahead" id="cenpoedit"
                                   name="cenpo" autocomplete="off">
                            <div id="cenpovaledit"></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="refedit">REFERENCIA DE UBICACION</label>
                            <input id="refedit" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="diredit">DIRECCION
                            </label>
                            <input id="diredit" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div id="dirvaledit"></div>
                        </div>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">TIPO DE SEGURO

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <input type="text" id="idpacienedit"hidden/>
                            <input type="text" id="idpactipsedit"hidden/>
                            <label for="tipsegedit">TIPO SEGURO</label>
                            <req>*</req>
                            <select class="form-control form-control-sm" id="tipsegedit"></select>
                            <div id="valtipsegedit"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarpacedit" class="btn btn-success " title="click para agregar personal
                    " onclick="enviarPacEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR PACIENTE---------------------------------------->



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
            $.getScript('../js/intranet/referencias/agregarpacienteref.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
