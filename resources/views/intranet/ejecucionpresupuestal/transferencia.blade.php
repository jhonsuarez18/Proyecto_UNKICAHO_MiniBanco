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
<style>
    req {
        color: red;
    }
</style>
<br>
<br>

<div id="response">

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">INGRESAR TRANSFERENCIA </h1>
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
            <div class="col-xl-12  ">
                <button id="addtransf" class="btn btn-success " title="click para agregar material o insumo"
                        data-toggle="modal" data-target="#modal_dialog_add_stock">
                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar  transferencia
                </button>
            </div>
            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_trans"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <thead>
                                <tr role="row">

                                    <th>
                                        NRO RJ
                                    </th>
                                    <th>COD TRANS
                                    </th>
                                    <th>
                                        MONTO
                                    </th>
                                    <th>
                                        CREACION
                                    </th>
                                    <th>
                                        FUENTE FINANCIAMIENTO
                                    </th>
                                    <th>
                                        OPCIONES
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="2"><strong>TOTAL</strong></th>
                                    <th colspan="4" class="text-left"></th>
                                </tr>
                                </tfoot>


                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal-dialog_add_trans">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ">AGREGAR TRANSFERENCIA</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="ajaxform">
                            <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS
                                    TRANSFERENCIA
                                </legend>

                                <div class="col-xl-4">

                                    <label for="numrj">NUMERO DE RJ
                                        <req>*</req>
                                    </label>
                                    <input id="numrj" type="text" class="form-control form-control-sm" autocomplete="off"
                                           onchange="valNumrj()"
                                    />
                                    <div class="hide " id="validnumrj"></div>

                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="codtra">CODIGO DE TRANSFERENCIA
                                            <req>*</req>
                                        </label>
                                        <input id="codtra" type="text" class="form-control form-control-sm" autocomplete="off"
                                        />
                                        <div class="hide " id="validcodtra"></div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="monto">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span>
                                            </div>
                                            <input type="number" id="monto" class="form-control form-control-sm"
                                                   onchange="validarMoneda('monto')"/>
                                        </div>
                                        <div class="hide " id="validmont"></div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="fufi"> FUENTE DE FINANCIAMIENTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="fufi">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validfufi"></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">TECHO
                                        PRESUPUESTAL
                                    </legend>
                                    <div class="col-xl-4">
                                        <label for="propre"> PROG PRES
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="propre">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validpropre"></div>
                                    </div>
                                    <div class="col-xl-4">
                                        <label for="con">CONCEPTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="con">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validcon"></div>
                                    </div>

                                    <div class="col-xl-3 ">
                                        <label for="montot">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span>
                                            </div>
                                            <input type="number" id="montot" class="form-control form-control-sm"
                                                   onchange="validarMoneda('montot')"/>
                                        </div>
                                        <div class="hide " id="validmont"></div>
                                    </div>
                                    <div class="col-xl-1 col-xs-1 col-sm-1  btn-group-justified">
                                        <label for="addt">
                                            &nbsp;&nbsp; &nbsp;&nbsp;
                                        </label>
                                        <button id="addt" class="btn btn-primary btn-icon btn-circle btn-lg "
                                                title="click para agregar techo">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-xl-12 center-block">
                                        <div id="data-table-fixed-header_wrapper"
                                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-12 table-responsive ">
                                                    <table id="tab_tec"
                                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                           role="grid"
                                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                                        <thead>
                                                        <tr role="row">

                                                            <th>
                                                                PROGRAMA
                                                            </th>
                                                            <th>
                                                                CONCEPTO
                                                            </th>
                                                            <th>
                                                                MONTO
                                                            </th>
                                                            <th>
                                                                OPC
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="2" class="text-right"><strong>TOTAL</strong>
                                                            </th>
                                                            <th colspan="2" class="text-left"></th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

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
                                <button id="enviar" class="btn btn-success " title="click para agregar usuario
                    "><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-dialog_ver_tec">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ">VER TECHO PRESUPUESTAL</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="tabla_tec_pre"
                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                           role="grid"
                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                        <thead>
                                        <tr role="row">

                                            <th class="text-center">
                                                PROGRAMA PRESUPUESTAL
                                            </th>
                                            <th class="text-center">CAPITA
                                            </th>
                                            <th class="text-center">
                                                PAG SER
                                            </th>
                                            <th class="text-center">
                                                TRAS EMER
                                            </th>
                                            <th class="text-center">
                                                    SAL BAL
                                            </th>
                                            <th class="text-center">
                                                TOT
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="1"><strong>TOTAL</strong></th>
                                            <th colspan="1" class="text-center"></th>
                                            <th colspan="1" class="text-center"></th>
                                            <th colspan="1" class="text-center"></th>
                                            <th colspan="1" class="text-center"></th>
                                            <th colspan="1" class="text-center"></th>

                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
            <div class="modal fade" id="modal-dialog_edit">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR TRANSFERENCIA</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body row">

                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS
                                    TRANSFERENCIA
                                </legend>

                                <input id="idtrans" hidden
                                />
                                <div class="col-xl-4 ">
                                    <label for="numrjedt">NUMERO DE RJ
                                        <req>*</req>
                                    </label>
                                    <input id="numrjedt" type="text" class="form-control form-control-sm" autocomplete="off"
                                           onchange="valNumrj()"
                                    />
                                </div>
                                <div class="col-xl-4 ">
                                    <label for="codtraedt">CODIGO DE TRANSFERENCIA
                                        <req>*</req>
                                    </label>
                                    <input id="codtraedt" type="text" class="form-control form-control-sm" autocomplete="off"
                                    />
                                </div>
                                <div class="col-xl-4 ">
                                    <label for="montoedt">MONTO
                                        <req>*</req>
                                    </label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                        <input type="number" id="montoedt" class="form-control form-control-sm"
                                               onchange="validarMoneda('monto')"/>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label for="fufiedit"> FUENTE DE FINANCIAMIENTO
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="fufiedit">
                                        <option selected value="0">SELECCIONE</option>
                                    </select>
                                    <div class="hide " id="validfufiedit"></div>
                                </div>

                            </div>

                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">TECHO
                                    PRESUPUESTAL
                                </legend>
                                <div class="col-xl-4">
                                    <label for="propreed"> PROG PRES
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="propreed">
                                        <option selected value="0">SELECCIONE</option>
                                    </select>
                                    <div class="hide " id="validpropreed"></div>
                                </div>
                                <div class="col-xl-4">
                                    <label for="coned">CONCEPTO
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="coned">
                                        <option selected value="0">SELECCIONE</option>
                                    </select>
                                    <div class="hide " id="validconed"></div>
                                </div>

                                <div class="col-xl-3 ">
                                    <label for="montoted">MONTO
                                        <req>*</req>
                                    </label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">S/.</span>
                                        </div>
                                        <input type="number" id="montoted" class="form-control form-control-sm"
                                               onchange="validarMoneda('montoted')"/>
                                    </div>
                                    <div class="hide " id="validmontoted"></div>
                                </div>
                                <div class="col-xl-1 col-xs-1 col-sm-1  btn-group-justified">
                                    <label for="addt">
                                        &nbsp;&nbsp; &nbsp;&nbsp;
                                    </label>
                                    <button id="addtedi" class="btn btn-primary btn-icon btn-circle btn-lg "
                                            title="click para agregar techo">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-xl-12 center-block">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive ">
                                                <table id="tab_tec_edit"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">

                                                        <th>
                                                            PROGRAMA
                                                        </th>
                                                        <th>
                                                            CONCEPTO
                                                        </th>
                                                        <th>
                                                            MONTO
                                                        </th>
                                                        <th>
                                                            OPC
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-right"><strong>TOTAL</strong>
                                                        </th>
                                                        <th colspan="2" class="text-left"></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="col-xl-12 text-center">
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enviaredit" class="btn btn-success " title="click para editar pedido
                    " onclick="enviarEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                                </button>
                            </div>
                            <br>
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
                $.getScript('../js/intranet/util.js'),
                $.getScript('../js/intranet/presupuesto/transferencia.js'),
                $.Deferred(function (deferred) {
                    $(deferred.resolve);
                })
            )
        });


    </script>
