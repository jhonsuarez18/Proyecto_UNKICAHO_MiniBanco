<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet"/>
<link href="../assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
      rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>
<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="../assets/plugins/datatables-checkboxes/css/dataTables.checkboxes.css" rel="stylesheet"/>
<script type="text/javascript" src="../assets/plugins/datatables-checkboxes/js/dataTables.checkboxes.min.js"></script>
<script src="../js/typeahead/bootstrap3-typeahead.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<script src="../assets/plugins/DataTables/media/js/dataTables.fixedHeader.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}"/>
<style>
    req {
        color: red;
    }
</style>
<br>
<br>
<div id="response">

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">

            <h1 class="panel-title">REFERENCIAS</h1>
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
            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                <div class="col-xl-2 col-sm-2 col-xs-2">
                    <label for="idessref">CODIGO RENAES</label>
                    <input class="form-control typeahead" id="idessref" name="idessref"
                           DISABLED/>
                </div>

                <div class="col-xl-8 col-sm-8 col-xs-8">
                    <label for="nombessref">ESTABLECIMIENTO</label>
                    <input class="form-control typeahead" id="nombessref" name="nombessref"
                           DISABLED/>
                </div>


            </div>
            <hr>
            <div class="col-xl-12  ">
                <button id="addref" class="btn btn-success " title="click para agregar referencias"
                >
                    <i class="fas fa-lg fa-fw m-r-10 fa-ambulance "></i>Agregar Referencias
                </button>
            </div>

            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_referencias"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <tbody>
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th>CODIGO</th>
                                    <th>IPRESS ORIGEN</th>
                                    <th>IPRESS DESTINO</th>
                                    <th>FECHA REFERENCIA</th>
                                    <th>PLAZO</th>
                                    <th>UBICACION DOCUMENTO</th>
                                    <th>FECHA REVISION</th>
                                    <th>RENDICION</th>
                                    <th>ESTADO</th>
                                    <th>OPCIONES</th>
                                </tr>
                                </thead>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_edit_ref">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR REFERENCIA (
                                <req>*</req>
                                <small>Dato obligatorio</small>)
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <input id="idrefedit" hidden>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS PACIENTE
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <input id="pidedit" hidden>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="dniedit">DNI
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="dniedit"
                                               autocomplete="off">
                                        <div class="hide " id="valdniedit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="appatredit">APPATERNO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="appatredit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valappatredit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="apmatredit">APMATERNO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="apmatredit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valapmatredit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="nombresedit">NOMBRES
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="nombresedit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valnombresedit"></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3 col-xs-3">
                                        <label for="fecnacedit">FECHA NACIMIENTO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="fecnacedit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnacedit"></div>
                                    </div>
                                    <div class="col-xl-1 col-sm-1 col-xs-1">
                                        <label for="edadedit">EDAD
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="edadedit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valedadedit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="tipsegedit">TIPO DE SEGURO</label>
                                        <input type="text" class="form-control form-control-sm" id="tipsegedit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valtipsegedit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="estpredit">ESTADO PACIENTE
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="estpredit">
                                        </select>
                                        <div class="hide " id="valestpredit"></div>
                                    </div>
                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS REFERENCIA
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="nrofuaedit">Nº FORMATO UNICO DE ATENCION
                                            <req>*</req>
                                        </label>
                                        <input class="form-control form-control-sm" id="nrofuaedit"
                                               placeholder="010-19-0698792" type="text">
                                        <div class="hide " id="valnrofuaedit"></div>
                                    </div>
                                    <input id="estabedorid" hidden/>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="estabedor">IPRESS ORIGEN</label>
                                        <input type="text" class="form-control form-control-sm" id="estabedor"
                                               autocomplete="off" >
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <input id="estabeddesid" hidden/>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="estabeddes">IPRESS DESTINO</label>
                                        <input type="text" class="form-control form-control-sm" id="estabeddes"
                                               autocomplete="off" >
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="motrefedit">MOTIVO DE REFERENCIA</label>
                                        <textarea class="form-control form-control-sm" rows="1" id="motrefedit"
                                                  name="motrefedit"
                                                  onkeyup="javascript:this.value=this.value.toUpperCase();"> </textarea>
                                        <div class="hide " id="valmotrefedit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="fecrefredtxt">FECHA Y HORA DE SALIDA
                                            <req>*</req>
                                        </label>
                                        <div class="input-group date " id="fecrefred">
                                            <input id="fecrefredtxt" type="text" class=" form-control form-control-sm" autocomplete="off"/>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="hide " id="valfecrefr"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="fecretedtxt">FECHA Y HORA DE RETORNO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group date " id="fecreted">
                                            <input id="fecretedtxt" type="text" class=" form-control form-control-sm" autocomplete="off"/>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="hide " id="valfecrefr"></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="cie10red">LISTA DE DIAGNOTICOS
                                        <req>*</req>
                                    </label>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <input class="form-control form-control-sm typeahead" id="cie10red"
                                           name="cie10r" autocomplete="off" placeholder="Escriba codigo o nombre de CIED10">
                                    <div class="hide " id="valcie10red"></div>

                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12  ">

                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_cie10_edit"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <tbody>
                                                    </tbody>
                                                    <thead>
                                                    <tr role="row">
                                                        <th>CIE10</th>
                                                        <th>DESCRIPCION</th>
                                                        <th>OPCIONES</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS MOVILIDAD
                                </legend>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12">
                                    <div class="form-check" title="Activar para especificar movilidad particular">
                                        <input class="form-check-input is-valid" type="checkbox" value=""
                                               id="moviledit">
                                        <label class="form-check-label" for="ejecutval">PARTICULAR</label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row" id="npartedit">
                                    <input type="text" value="0" id="idvehirefedit" hidden/>
                                    <div class="col-xl-2 col-sm-2 col-xs-2">
                                        <label for="placaredit">N° PLACA
                                            <req>*</req>
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="placaredit"
                                               onchange="valVehiPlac('placaredit','idvehirefedit','detredit','esspertredit')"
                                               autocomplete="off">
                                        <div class="hide " id="valplacaredit"></div>
                                    </div>

                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="esspertredit">ENTIDAD

                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="esspertredit"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valesspertredit"></div>
                                    </div>

                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="detredit">DETALLE

                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="detredit"
                                               autocomplete="off" disabled>
                                    </div>

                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS PERSONAL
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <input id="idperderefed" hidden>
                                    <div class="col-xl-6 ">
                                        <label for="perderefed">PERSONAL QUE REFIERE
                                        </label>
                                        <input  type="text" class="form-control form-control-sm" id="perderefed"
                                                autocomplete="off" >
                                    </div>
                                    <input id="idperdereced" hidden>
                                    <div class="col-xl-6 ">
                                        <label for="perrec">PERSONAL QUE RECIBE LA REFERENCIA
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="perdereced"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <input placeholder="Escriba nombre o dni del personal a asignar" type="text" class="form-control form-control-sm typeahead"
                                               id="personaled" name="personaled" autocomplete="off"/>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="personaled" class="text-center">LISTA DE PERSONAL QUE ACOMPAÑA EL
                                            TRASLADO
                                        </label>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                        <br>
                                        <div id="data-table-fixed-header_wrapper"
                                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-12 table-responsive">
                                                    <table id="tabla_personal_edit"
                                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                           role="grid"
                                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                                        <tbody>
                                                        </tbody>
                                                        <thead>
                                                        <tr role="row">
                                                            <th>NOMBRE</th>
                                                            <th>TIPO PERSONAL</th>
                                                            <th>OPCIONES</th>
                                                        </tr>
                                                        </thead>

                                                    </table>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="col-xl-12 text-center">
                                    <hr>
                                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                    <button id="envrefedit" class="btn btn-success " title="click para guardar entrega">
                                        <i
                                            class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_ver_ref">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">VER DETALLE</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS PACIENTE
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="dnidetref">DNI
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="dnidetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valdni"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="appatrdetref">APPATERNO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="appatrdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnac"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="apmatrdetref">APMATERNO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="apmatrdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnac"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="nombresdetref">NOMBRES
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="nombresdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnac"></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3 col-xs-3">
                                        <label for="fecnacdetref">FECHA NACIMIENTO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="fecnacdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnac"></div>
                                    </div>
                                    <div class="col-xl-1 col-sm-1 col-xs-1">
                                        <label for="edaddetref">EDAD
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="edaddetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnac"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="tipsegdetref">TIPO DE SEGURO</label>
                                        <input type="text" class="form-control form-control-sm" id="tipsegdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="estpdetref">ESTADO PACIENTE</label>
                                        <input type="text" class="form-control form-control-sm" id="estpdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valestpdetref"></div>
                                    </div>
                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS REFERENCIA
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="nrofuadet">Nº FORMATO UNICO DE ATENCION
                                        </label>
                                        <input class="form-control form-control-sm" id="nrofuadet"
                                               placeholder="010-19-0698792" type="text" disabled>
                                        <div class="hide " id="valnrofuadet"></div>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="estabdetor">IPRESS ORIGEN</label>
                                        <input type="text" class="form-control form-control-sm" id="estabdetor"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="estabdetref">IPRESS DESTINO</label>
                                        <input type="text" class="form-control form-control-sm" id="estabdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>

                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="motdetref">MOTIVO DE REFERENCIA</label>
                                        <input type="text" class="form-control form-control-sm" id="motdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="fecrefr">FECHA Y HORA DE SALIDA
                                        </label>
                                        <div class="input-group date "  >
                                            <input id="dfecrefr" type="text" class=" form-control form-control-sm" disabled>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="dfecret">FECHA Y HORA DE RETORNO
                                        </label>
                                        <div class="input-group date "  >
                                            <input id="dfecret" type="text" class=" form-control form-control-sm" disabled>
                                            <div class="input-group-addon" >
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="cie10r">LISTA DE DIAGNOTICOS
                                        <req>*</req>
                                    </label>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12  ">

                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_cie10_det"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <tbody>
                                                    </tbody>
                                                    <thead>
                                                    <tr role="row">
                                                        <th>CIE10</th>
                                                        <th>DESCRIPCION</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS MOVILIDAD
                                </legend>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12">
                                    <div class="form-check" title="Activar para especificar movilidad particular">
                                        <input class="form-check-input is-valid" type="checkbox" value="" id="movildet"
                                               disabled>
                                        <label class="form-check-label" for="ejecutval">PARTICULAR</label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row" id="npartdet">
                                    <input type="text" value="0" id="idvehirefdet" hidden/>
                                    <div class="col-xl-2 col-sm-2 col-xs-2">
                                        <label for="placardet">N° PLACA
                                            <req>*</req>
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="placardet"
                                               onchange="valVehiPlac('placaredit','idvehirefedit','detredit','esspertredit')"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valplacardet"></div>
                                    </div>

                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="esspertrdet">ENTIDAD

                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="esspertrdet"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valesspertrdet"></div>
                                    </div>

                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="detrdet">DETALLE

                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="detrdet"
                                               autocomplete="off" disabled>
                                    </div>

                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS PERSONAL
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">

                                    <div class="col-xl-6 ">
                                        <label for="perref">PERSONAL QUE REFIERE
                                        </label>
                                        <input  type="text" class="form-control form-control-sm" id="perderef"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-6 ">
                                        <label for="perrec">PERSONAL QUE RECIBE LA REFERENCIA
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="perderec" disabled
                                               autocomplete="off">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">

                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="personalre" class="text-center">LISTA DE PERSONAL QUE ACOMPAÑA EL
                                            TRASLADO
                                        </label>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                        <br>
                                        <div id="data-table-fixed-header_wrapper"
                                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-12 table-responsive">
                                                    <table id="tabla_personal_verdet"
                                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                           role="grid"
                                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                                        <tbody>
                                                        </tbody>
                                                        <thead>
                                                        <tr role="row">
                                                            <th>NOMBRE</th>
                                                            <th>TIPO PERSONAL</th>
                                                        </tr>
                                                        </thead>

                                                    </table>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-xl-12 text-center">
                                    <hr>
                                    <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_add_ref">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="m-b-15">AGREGAR REFERENCIA (
                                <req>*</req>
                                <small>Dato obligatorio</small>)
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS PACIENTE
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <input id="pid" hidden>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="dnir">DNI
                                            <req>*</req>
                                        </label>
                                        <input type="text" placeholder="Digite dni" class="form-control form-control-sm" id="dnir"
                                               autocomplete="off">
                                        <div class="hide " id="valdnir"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="appatr">APPATERNO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="appatr"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="apmatr">APMATERNO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="apmatr"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="nomr">NOMBRES
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="nomr"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-3 col-sm-3 col-xs-3">
                                        <label for="fcnacr">FECHA NACIMIENTO
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="fcnacr"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-1 col-sm-1 col-xs-1">
                                        <label for="eddr">EDAD
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="eddr"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="tsr">TIPO DE SEGURO(S)</label>
                                        <textarea class="form-control form-control-sm" rows="1" id="tsr" name="tsr"
                                                  disabled
                                        > </textarea>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="estpr">ESTADO PACIENTE
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="estpr">
                                        </select>
                                        <div class="hide " id="valestpr"></div>
                                    </div>
                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS REFERENCIA
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="nrofua">Nº FORMATO UNICO DE ATENCION
                                            <req>*</req>
                                        </label>
                                        <input class="form-control form-control-sm" id="nrofua"
                                               placeholder="010-19-0698792" type="text" autocomplete="off">
                                        <div class="hide " id="valnrofua"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12">
                                        <div class="form-check" title="Activar para especificar movilidad particular">
                                            <input title="Click para hacer la referencia de otra ipress"
                                                   class="form-check-input is-valid" type="checkbox" value="" id="otip">
                                            <label class="form-check-label" for="otip">OTRA IPRESS REFERENCIA</label>
                                        </div>
                                    </div>
                                    <div id="otrip" class="col-xl-12 col-sm-12 col-xs-12" hidden>
                                        <label for="essor">IPRESS ORIGEN
                                            <req>*</req>
                                        </label>
                                        <input id="idessor" value="0" name="idessor" hidden>
                                        <textarea class="form-control form-control-sm" rows="1" id="essor"
                                                  name="essor" autocomplete="off"> </textarea>
                                        <div class="hide " id="valessor"></div>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="essrr">IPRESS DESTINO
                                            <req>*</req>
                                        </label>
                                        <input id="idessrr" name="idessrr" hidden>
                                        <textarea class="form-control form-control-sm" rows="1" id="essrr"
                                                  name="essrr" autocomplete="off"> </textarea>
                                        <div class="hide " id="valessrr"></div>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="motr">MOTIVO DE REFERENCIA
                                            <req>*</req>
                                        </label>
                                        <textarea class="form-control form-control-sm" rows="1" id="motr" name="motr"
                                                  autocomplete="off"
                                                  onkeyup="javascript:this.value=this.value.toUpperCase();"> </textarea>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="fecrefr">FECHA Y HORA DE SALIDA
                                            <req>*</req>
                                        </label>
                                        <div class="input-group date " id="fecrefr">
                                            <input id="vfecrefr" type="text" class=" form-control form-control-sm"  autocomplete="off">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="hide " id="valfecrefr"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="fecret">FECHA Y HORA DE RETORNO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group date " id="fecret">
                                            <input id="vfecret" type="text" class=" form-control form-control-sm"  autocomplete="off">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="hide " id="valfecrefr"></div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="cie10r">LISTA DE DIAGNOTICOS
                                        <req>*</req>
                                    </label>
                                </div>

                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <input class="form-control form-control-sm typeahead" id="cie10r"
                                           name="cie10r" autocomplete="off" placeholder="Escriba codigo o nombre de CIED10">
                                    <div class="hide " id="valcie10r"></div>

                                </div>

                                <div class="col-xl-12 col-sm-12 col-xs-12  ">

                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_cie10"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <tbody>
                                                    </tbody>
                                                    <thead>
                                                    <tr role="row">
                                                        <th>CIE10</th>
                                                        <th>DESCRIPCION</th>
                                                        <th>OPCIONES</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS MOVILIDAD
                                </legend>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12">
                                    <div class="form-check" title="Activar para especificar movilidad particular">
                                        <input class="form-check-input is-valid" type="checkbox" value="" id="movil">
                                        <label class="form-check-label" for="ejecutval">PARTICULAR</label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row" id="npart">
                                    <input type="text" value="0" id="idvehiref" hidden/>
                                    <div class="col-xl-2 col-sm-2 col-xs-2">
                                        <label for="placar">N° PLACA
                                            <req>*</req>
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="placar"
                                               onchange="valVehiPlac('placar','idvehiref','detr','esspertr')"
                                               autocomplete="off">
                                        <div class="hide " id="valplacar"></div>
                                    </div>

                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="esspertr">ENTIDAD

                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="esspertr"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valesspertr"></div>
                                    </div>

                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="detr">DETALLE

                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="detr"
                                               autocomplete="off" disabled>
                                    </div>

                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS PERSONAL
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">

                                    <div class="col-xl-6 ">
                                        <label for="perref">PERSONAL QUE REFIERE
                                            <req>*</req>
                                        </label>
                                        <input id="idperref" HIDDEN>
                                        <input placeholder="Escriba nombre o dni del personal" type="text" class="form-control form-control-sm" id="perref"
                                               autocomplete="off">
                                        <div class="hide " id="valperref"></div>
                                    </div>
                                    <div class="col-xl-6 ">
                                        <label for="perrec">PERSONAL QUE RECIBE LA REFERENCIA
                                            <req>*</req>
                                        </label>
                                        <input id="idperrec" HIDDEN>
                                        <input placeholder="Escriba nombre o dni del personal"type="text" class="form-control form-control-sm" id="perrec"
                                               autocomplete="off">
                                        <div class="hide " id="valperrec"></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">

                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="personalre" class="text-center">LISTA DE PERSONAL QUE ACOMPAÑA EL
                                            TRASLADO
                                            <req>*</req>
                                        </label>
                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <input placeholder="Escriba nombre o dni del personal a asignar" type="text" class="form-control form-control-sm typeahead"
                                               id="personalre" name="personalre" autocomplete="off"/>

                                    </div>
                                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                        <div id="data-table-fixed-header_wrapper"
                                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-12 table-responsive">
                                                    <table id="tabla_personalre"
                                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                           role="grid"
                                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                                        <tbody>
                                                        </tbody>
                                                        <thead>
                                                        <tr role="row">
                                                            <th>APELLIDOS Y NOMBRES</th>
                                                            <th>FUNCION</th>
                                                            <th>OPCIONES</th>
                                                        </tr>
                                                        </thead>

                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <hr>

                                <div class="col-xl-12 text-center">
                                    <hr>
                                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                    <button id="envref" class="btn btn-success " title="click para guardar entrega">
                                        <i
                                            class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                    </button>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------- INICIO MODAL UBICACION DEL DOCUMENTO---------------------------------->
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_ubic_ref">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="m-b-15">UBICACION DOCUMENTO
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idrefub" hidden>
                        <ul class="timeline" id="timeline">

                        </ul>
                        <hr>
                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------- FIN MODAL UBICACION DEL DOCUMENTO------------------------------------->
    <!--------------------------------------- INICIO MODAL OBSERVACION---------------------------------->
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_observacion">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">OBSERVACION</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-sm-12 col-xs-12 row">
                            <input id="orid" hidden>
                            <input id="ooid" hidden>
                            <input id="orevid" hidden>

                            <div class="col-xl-4 col-sm-4 col-xs-4 ">
                                <label for="ocodref">CODIGO REFEENCIA</label>
                                <input type="text" class="form-control form-control-sm" id="ocodref"
                                       autocomplete="off" disabled>
                            </div>
                            <div class="col-xl-8 col-sm-8 col-xs-8 ">
                                <label for="odoc">DOCUMENTO</label>
                                <input type="text" class="form-control form-control-sm" id="odoc"
                                       autocomplete="off" disabled>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-xs-12">
                            <label for="oobs">OBSERVACION</label>
                            <textarea class="form-control form-control-sm" id="oobs"
                                      autocomplete="off" disabled></textarea>
                        </div>
                        <div class="col-xl-12 text-center">
                            <hr>
                            <a href="javascript:;" class="btn btn-primary" data-dismiss="modal"
                               id="cmodalobschec"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                            <a href="javascript:;" class="btn btn-success" data-dismiss="modal" id="subsanar"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-plus"></i>Subsanar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------- FIN MODAL OBSERVACION------------------------------------->

    <!--------------------------------------- INICIO MODAL OBSERVACION HISTORIAL---------------------------------->
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_observacion_hist">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">OBSERVACION</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-sm-12 col-xs-12 row">
                            <input id="idrefob" hidden>
                            <!--<input id="ooidh" hidden>
                            <input id="orevidh" hidden>-->

                            <div class="col-xl-4 col-sm-4 col-xs-4 ">
                                <label for="ocodrefh">CODIGO REFEENCIA</label>
                                <input type="text" class="form-control form-control-sm" id="ocodrefh"
                                       autocomplete="off" disabled>
                            </div>
                            <div class="col-xl-8 col-sm-8 col-xs-8 ">
                                <label for="odoch">DOCUMENTO</label>
                                <input type="text" class="form-control form-control-sm" id="odoch"
                                       autocomplete="off" disabled>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-xs-12">
                            <label for="oobsh">OBSERVACION</label>
                            <textarea class="form-control form-control-sm" id="oobsh"
                                      autocomplete="off" disabled></textarea>
                        </div>
                        <div class="col-xl-12 text-center">
                            <hr>
                            <a href="javascript:;" class="btn btn-primary" data-dismiss="modal" id="cmodalobsh"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------- FIN MODAL OBSERVACION HISTORIAL------------------------------------->
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_checkList">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">CHECK LIST</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_checklist"
                                               class="table table-striped  table-bordered dataTable no-footer dtr-inline display"
                                               cellspacing="0"
                                               aria-describedby="data-table-fixed-header_info" width="100%">
                                            <tbody>
                                            </tbody>
                                            <thead>
                                            <tr role="row">
                                                <th title="Clic para seleccionar todo" class="text-center"><input
                                                        type="checkbox" name="select_all"
                                                        value="1" id="example-select-all">
                                                </th>
                                                <th>DOCUMENTO</th>
                                                <th>ESTADO</th>
                                                <!--  <th>ADJUNTAR</th> -->
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <a id="button" href="javascript:;" class="btn btn-primary"
                               title="Click para atender seleccionados">
                                <i class="fas fa-lg fa-fw m-r-10 fa-check-circle"></i>Atender</a>
                        </div>
                        <br>
                        <div class="  col-sm-12 col-xs-12 col-md-12">
                            <dl class=" row dl-horizontal">
                                <div class="  col-sm-2 col-xs-2 col-md-2">
                                    <dt class="text-inverse">Leyenda para estado:</dt>
                                </div>
                                <div class="  col-sm-3 col-xs-3 col-md-3">
                                    <dd><i style="color: red;"
                                           class="fas fa-lg fa-fw m-r-10 fa-minus-circle text-secondary"> </i>Por
                                        atender
                                    </dd>
                                    <dd><i style="color: orange;"
                                           class="fas fa-lg fa-fw m-r-10 fa-archive text-success"> </i>Atendido
                                    </dd>
                                    <dd><i style="color: green;"
                                           class="fas fa-lg fa-fw m-r-10 fa-check-circle text-primary"> </i>Aprobado
                                    </dd>
                                    <dd><i style="color: green;"
                                           class="fas fa-lg fa-fw m-r-10 fa-times-circle text-danger"> </i>Observado
                                    </dd>
                                    <dd><i style="color: green" class="fas fa-lg fa-fw m-r-10 fa-plus-circle"> </i>Subsanado
                                    </dd>
                                </div>
                                <div class="  col-sm-3 col-xs-3 col-md-3">
                                    <dd><i style="color: red;"
                                           class="fas fa-lg fa-fw m-r-10 fa-clipboard text-purple"> </i>Viático por
                                        tramitar
                                    </dd>
                                    <dd><i style="color: orange;"
                                           class="fas fa-lg fa-fw m-r-10 fa-clipboard text-success"> </i>Viático
                                        tramitado
                                    </dd>
                                    <dd><i style="color: orange;"
                                           class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i>Descargar
                                        formato
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div class="col-xl-12 text-center">
                            <hr>
                            <a href="javascript:;" class="btn btn-success" data-dismiss="modal"
                               title="Click para cerrar"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-xl-12 ">
         <div class="modal fade " id="modal_dialog_rec_ref">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title">ENTREGAR PACIENTE</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     </div>
                     <div class="modal-body">
                         <div class="col-xl-12 ">
                             <label for="entpac">PERSONAL QUE RECIBE</label>
                             <input id="idrefentp" hidden>
                             <input id="identpac" hidden>
                             <input id="idve" hidden>
                             <input type="text" class="form-control form-control-sm" id="entpac" autocomplete="off">
                             <div class="hide " id="valentpac"></div>
                         </div>
                         <div class="col-xl-12 text-center">
                             <hr>
                             <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                     class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                             <button id="entpacg" class="btn btn-success " title="click para entregar paciente"><i
                                     class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>-->
</div>


<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js')}}"></script>
<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/moment/min/moment.min.js'),
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'),
            $.getScript('../assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/referencias/verreferenciaess.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
