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
            <h1 class="panel-title"> ORDEN DE COMPRA </h1>
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
                <button id="addordenc" class="btn btn-success " title="click para agregar material o insumo"
                        data-toggle="modal" data-target="#modal-dialog_add_trans">
                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar  orden de compra
                </button>
            </div>
            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_oc"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <thead>
                                <tr role="row">
                                    <th>
                                       NRO O/C
                                    </th>
                                    <th>
                                        FUENTE FINANCIAMIENTO
                                    </th>
                                    <th>
                                        N° FACT.
                                    </th>
                                    <th>
                                        GRIFO
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
                                <tfoot>
                                </tfoot>


                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal-dialog_add_oc">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ">AGREGAR ORDEN DE COMPRA</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="ajaxform">
                            <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS ORDEN DE COMPRA
                                </legend>
                                <div class="col-xl-4">

                                    <label for="oca">NUMERO DE O/C
                                        <req>*</req>
                                    </label>
                                    <input id="oca" type="text" class="form-control form-control-sm" autocomplete="off"
                                           onchange="valNumOC()"
                                    />
                                    <div class="hide " id="validoca"></div>

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
                                <div class="col-xl-4">
                                    <label for="numfact">N° FACTURA
                                        <req>*</req>
                                    </label>
                                    <input id="numfact" type="text" class="form-control form-control-sm" autocomplete="off"/>
                                    <div class="hide " id="valnumfact"></div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="grifo"> GRIFO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="grifo">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="valgrigo"></div>
                                    </div>
                                </div>
                                <hr>

                            </div>
                            <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ITEM
                                </legend>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="ticom"> TIPO COMBUSTIBLE
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="ticom">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validticom"></div>
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <label for="cant">CANTIDAD /G
                                        <req>*</req>
                                    </label>
                                    <input id="cant" type="text" class="form-control form-control-sm" autocomplete="off"
                                    />
                                    <div class="hide " id="validcant"></div>
                                </div>
                                <hr>
                                <div class="col-xl-1 col-xs-1 col-sm-1  btn-group-justified">
                                    <label for="addcom">
                                        &nbsp;&nbsp; &nbsp;&nbsp;
                                    </label>
                                    <button id="addcom" class="btn btn-primary btn-icon btn-circle btn-lg "
                                            title="click para agregar combustible">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-12 center-block">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive ">
                                            <table id="tab_combu"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <thead>
                                                <tr role="row">
                                                    <th>
                                                        TIPO COMBUSTIBLE
                                                    </th>
                                                    <th>
                                                        CANTIDAD GALONES
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
                                                    <th colspan="1" class="text-right"><strong>TOTAL</strong></th>
                                                    <th colspan="2" class="text-left"></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-12 text-center">
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enviaroc" class="btn btn-success " title="click para agregar una orden de compra
                    "><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-dialog_edit_oc">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR ORDEN DE COMPRA</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body row">
                            <form id="ajaxform">
                                <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS ORDEN DE COMPRA
                                    </legend>
                                    <input type="text" id="idordcedit" hidden/>
                                    <input type="text" id="numocedit" hidden/>
                                    <div class="col-xl-4">

                                        <label for="ocaedit">NUMERO DE O/C
                                            <req>*</req>
                                        </label>
                                        <input id="ocaedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onchange="valNumOCEdit()"
                                        />
                                        <div class="hide " id="validocaedit"></div>

                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="fufiedit"> FUENTE DE FINANCIAMIENTO
                                                <req>*</req>
                                            </label>
                                            <select class="form-control form-control-sm" id="fufiedit">

                                            </select>
                                            <div class="hide " id="validfufiedit"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <label for="numfactedit">N° FACTURA
                                            <req>*</req>
                                        </label>
                                        <input id="numfactedit" type="text" class="form-control form-control-sm" autocomplete="off"/>
                                        <div class="hide " id="valnumfactedit"></div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="grifoedit"> GRIFO
                                                <req>*</req>
                                            </label>
                                            <select class="form-control form-control-sm" id="grifoedit">
                                                <option selected value="0">SELECCIONE</option>
                                            </select>
                                            <div class="hide " id="valgrigoedit"></div>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ITEM
                                    </legend>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="ticomedit"> TIPO COMBUSTIBLE
                                                <req>*</req>
                                            </label>
                                            <select class="form-control form-control-sm" id="ticomedit">
                                                <option selected value="0">SELECCIONE</option>
                                            </select>
                                            <div class="hide " id="validticomedit"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <label for="cantedit">CANTIDAD /G
                                            <req>*</req>
                                        </label>
                                        <input id="cantedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                        />
                                        <div class="hide " id="validcantedit"></div>
                                    </div>
                                    <hr>
                                    <div class="col-xl-1 col-xs-1 col-sm-1  btn-group-justified">
                                        <label for="addcomedit">
                                            &nbsp;&nbsp; &nbsp;&nbsp;
                                        </label>
                                        <button id="addcomedit" class="btn btn-primary btn-icon btn-circle btn-lg "
                                                title="click para agregar combustible">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xl-12 center-block">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive ">
                                                <table id="tab_combu_edit"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>
                                                            TIPO COMBUSTIBLE
                                                        </th>
                                                        <th>
                                                            CANTIDAD GALONES
                                                        </th>
                                                        <th>
                                                            OPCIONES
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="1" class="text-right"><strong>TOTAL</strong></th>
                                                        <th colspan="2" class="text-left"></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-12 text-center">
                                    <hr>
                                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                    <button id="enviarocedit" class="btn btn-success " title="click para editar orden de compra
                    "><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-dialog_ver_oc">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">VER ORDEN DE COMPRA</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body row">
                            <form id="ajaxform">
                                <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS ORDEN DE COMPRA
                                    </legend>
                                    <input type="text" id="idordcver" hidden/>
                                    <div class="col-xl-4">

                                        <label for="ocaver">NUMERO DE O/C
                                            <req>*</req>
                                        </label>
                                        <input id="ocaver" type="text" class="form-control form-control-sm" autocomplete="off"
                                            disabled
                                        />
                                        <div class="hide " id="validocaver"></div>

                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="fufiver"> FUENTE DE FINANCIAMIENTO
                                                <req>*</req>
                                            </label>
                                            <select class="form-control form-control-sm" id="fufiver"
                                                    disabled>
                                            </select>
                                            <div class="hide " id="validfufiver"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <label for="numfactver">N° FACTURA
                                            <req>*</req>
                                        </label>
                                        <input id="numfactver" type="text" class="form-control form-control-sm" autocomplete="off"
                                        disabled/>
                                        <div class="hide " id="valnumfactver"></div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="grifover"> GRIFO
                                                <req>*</req>
                                            </label>
                                            <select class="form-control form-control-sm" id="grifover" disabled>
                                                <option selected value="0">SELECCIONE</option>
                                            </select>
                                            <div class="hide " id="valgrigover"></div>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ITEM
                                    </legend>
                                    <hr>
                                </div>
                                <div class="col-xl-12 center-block">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive ">
                                                <table id="tab_combu_ver"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>
                                                            TIPO COMBUSTIBLE
                                                        </th>
                                                        <th>
                                                            CANTIDAD GALONES
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="1" class="text-right"><strong>TOTAL</strong></th>
                                                        <th colspan="1" class="text-center"></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
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
                            </form>
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
                $.getScript('../js/intranet/combustible/ordencompra.js'),
                $.Deferred(function (deferred) {
                    $(deferred.resolve);
                })
            )
        });


    </script>
