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
<script src="../assets/plugins/DataTables/media/js/dataTables.fixedHeader.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}"/>
<style>
    req {
        color: red;
    }


</style>
<br>
<div id="response">

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">RENDICIONES</h1>
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
                <div class="col-xl-5 col-sm-5 col-xs-5">
                    <label for="indent">ENTIDAD</label>
                    <input class="form-control typeahead" id="indent" name="indent"
                           disabled>
                </div>

            </div>
            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_rendicion"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <tbody>
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th>COD</th>
                                    <th>IPRESS ORIGEN</th>
                                    <th>IPRESS DESTINO</th>
                                    <th>FECHA REFERENCIA</th>
                                    <th>UBI DOC</th>
                                    <th>PLAZO REVISION</th>
                                    <th>FECHA REVISION</th>
                                    <th>RENDICION</th>
                                    <th>ESTADO</th>
                                    <th>OPCIONES</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                     <!--   <div class="  col-sm-12 col-xs-12 col-md-12">
                            <dl class=" row dl-horizontal">
                                <div class="  col-sm-2 col-xs-2 col-md-2">
                                    <dt class="text-inverse">Leyenda para opciones:</dt>
                                </div>
                                <div class="  col-sm-10 col-xs-10 col-md-10 ">
                                    <dd><i style="color: red;" class="fas fa-lg fa-fw m-r-10 fa-minus-circle text-secondary"></i>Por Preparar
                                    </dd>
                                    <dd><i style="color: orange;" class="fas fa-lg fa-fw m-r-10 fa-archive text-success"> </i>Preparado
                                    </dd>
                                    <dd><i style="color: yellow;" class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i>
                                        No Revisado
                                    </dd>
                                    <dd><i style="color: green;" class="fas fa-lg fa-fw m-r-10 fa-check-circle text-primary"> </i>Correcto
                                    </dd>
                                    <dd><i style="color: green;" class="fas fa-lg fa-fw m-r-10 fa-times-circle text-danger"> </i>Observado
                                    </dd>
                                    <dd><i style="color: green" class="fas fa-lg fa-fw m-r-10 fa-plus-circle" > </i>Subsanado
                                    </dd>
                                </div>
                            </dl>
                        </div>-->

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
        <!-- <div class="col-xl-12 ">
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
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="tipsegdetref">TIPO DE SEGURO</label>
                                        <input type="text" class="form-control form-control-sm" id="tipsegdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                </div>
                                <hr>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                    DATOS REFERENCIA
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                    <div class="col-xl-12 col-sm-12 col-xs-12">
                                        <label for="nrofuadet">Nº FORMATO UNICO DE ATENCION<req>*</req></label>
                                        <input class="form-control form-control-sm" id="nrofuadet"
                                               placeholder="010-19-0698792"type="text" disabled>
                                        <div class="hide " id="valnrofuadet"></div>
                                    </div>
                                    <div class="col-xl-8 col-sm-8 col-xs-8">
                                        <label for="estabdetref">IPRESS DESTINO</label>
                                        <input type="text" class="form-control form-control-sm" id="estabdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="fecdetref">FECHA REFERENCIA
                                        </label>
                                        <input type="text" class="form-control form-control-sm" id="fecdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valfecnac"></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3 col-xs-3">
                                        <label for="cie10detref">CIE10</label>
                                        <input type="text" class="form-control form-control-sm" id="cie10detref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-19 col-sm-9 col-xs-9">
                                        <label for="motdetref">MOTIVO DE REFERENCIA</label>
                                        <input type="text" class="form-control form-control-sm" id="motdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3 col-xs-3">
                                        <label for="estpdetref">ESTADO PACIENTE</label>
                                        <input type="text" class="form-control form-control-sm" id="estpdetref"
                                               autocomplete="off" disabled>
                                    </div>
                                    <div class="col-xl-9 col-sm-9 col-xs-9">
                                        <label for="perdetref">PERSONAL RECEPCIONA</label>
                                        <input type="text" class="form-control form-control-sm" id="perdetref"
                                               autocomplete="off" disabled>
                                        <div class="hide " id="valmotr"></div>
                                    </div>
                                </div>
                                <hr>
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
        </div>-->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_checkList">
                <div class="modal-dialog modal-xl">
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
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <tbody>
                                                </tbody>
                                                <thead>
                                                <tr role="row">
                                                    <th>DOCUMENTO</th>
                                                    <th>ESTADO</th>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-success" data-dismiss="modal" title="Click para cerrar"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                            </div>
                            <div class="  col-sm-12 col-xs-12 col-md-12">
                                <dl class=" row dl-horizontal">
                                    <div class="  col-sm-2 col-xs-2 col-md-2">
                                        <dt class="text-inverse">Leyenda para estado:</dt>
                                    </div>
                                    <div class="  col-sm-8 col-xs-8 col-md-8">
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
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_checkList1">
                <div class="modal-dialog modal-xl">
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
                                            <table id="tabla_checklist1"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <tbody>
                                                </tbody>
                                                <thead>
                                                <tr role="row">
                                                    <th  id="che" title="Clic para seleccionar todo" class="text-center">
                                                        <input  type="checkbox" name="select_all"
                                                                value="1" id="example-select-all">
                                                    </th>
                                                    <th>DOCUMENTO</th>
                                                    <th>ESTADO</th>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <hr>
                                <a id="button" href="javascript:;" class="btn btn-primary"
                                   title="Click para corregir seleccionados">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-check-circle"></i>Correcto</a>
                                <a href="javascript:;" class="btn btn-success" data-dismiss="modal" title="Click para cerrar"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                            </div>
                            <div class="  col-sm-12 col-xs-12 col-md-12">
                                <dl class=" row dl-horizontal">
                                    <div class="  col-sm-2 col-xs-2 col-md-2">
                                        <dt class="text-inverse">Leyenda para estado:</dt>
                                    </div>
                                    <div class="  col-sm-8 col-xs-8 col-md-8">
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
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                <a href="javascript:;" class="btn btn-primary" data-dismiss="modal" id="obsb"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/referencias/rerendicionsur.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
