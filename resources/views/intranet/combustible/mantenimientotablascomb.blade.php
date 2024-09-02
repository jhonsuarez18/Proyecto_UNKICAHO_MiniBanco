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
        <!---------------------------------------- begin panel MARCA ------------------------------------->
        <div class="col-xl-6">
            <!--<h1 class="page-header">Mantenimiento
                <small>Aqui puedo gestionar el mantenimiento de tablas</small>
            </h1>-->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">MARCA VEHICULO</h1>
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
                        <button id="addMarca" class="btn btn-success " title="click para agregar Marca"
                                data-toggle="modal" data-target="#modal_dialog_add_chofer">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Marca
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_Marca"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION
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
        <!----------------------------------------End Panel MARCA---------------------------------------->

        <!---------------------------------------- begin panel TIPO COMBUSTIBLE ------------------------------------->
        <div class="col-xl-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO COMBUSTIBLE</h1>
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
                        <button id="addTipComb" class="btn btn-success " title="click para agregar Tipo Combustible"
                                data-toggle="modal" data-target="#modal_dialog_add_tipcomb">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Tipo Combustible
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_TipCombustible"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION
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
        <!----------------------------------------End Panel TIPO COMBUSTIBLE---------------------------------------->

        <!---------------------------------------- begin panel TIPO VEHICULO ------------------------------------->
        <div class="col-xl-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO VEHICULO</h1>
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
                        <button id="addTipVehic" class="btn btn-success " title="click para agregar Tipo Vehiculo"
                                data-toggle="modal" data-target="#modal_dialog_add_tipvehic">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Tipo Vehiculo
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_TipVehiculo"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION
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
        <!----------------------------------------End Panel TIPO VEHICULO---------------------------------------->

        <!---------------------------------------- begin panel SUB MARCA ------------------------------------->
        <div class="col-xl-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">MODELO</h1>
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
                        <button id="addSubMarc" class="btn btn-success " title="click para agregar Sub Marca"
                                data-toggle="modal" data-target="#modal_dialog_add_submarc">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Modelo
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_SubMarca"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            MARCA
                                        </th>
                                        <th>
                                           MODELO
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
        <!----------------------------------------End Panel SUB MARCA---------------------------------------->

        <!---------------------------------------- begin panel MODELO------------------------------------->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">VERSION</h1>
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
                        <button id="addModelo" class="btn btn-success " title="click para agregar Modelo"
                                data-toggle="modal" data-target="#modal_dialog_add_modelo">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Version
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_Modelo"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            MODELO
                                        </th>
                                        <th>
                                            TIPO COMBUSTIBLE
                                        </th>
                                        <th>
                                            VERSION
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
        <!----------------------------------------End Panel MODELO---------------------------------------->

        <!---------------------------------------- begin panel MODELO TIPO VEHICULO------------------------------------->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">MODELO TIPO VEHICULO</h1>
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
                        <button id="addModeloTipV" class="btn btn-success " title="click para agregar Modelo Tipo Vehiculo"
                                data-toggle="modal" data-target="#modal_dialog_add_modelotipv">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Modelo Tipo Vehiculo
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_ModeloTipV"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            MARCA
                                        </th>
                                        <th>
                                           MODELO
                                        </th>
                                        <th>
                                            TIPO COMBUSTIBLE
                                        </th>
                                        <th>
                                            VERSION
                                        </th>
                                        <th>
                                            TIPO VEHICULO
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
        <!----------------------------------------End Panel MODELO TIPO VEHICULO---------------------------------------->
        <!---------------------------------------- begin panel GRIFO------------------------------------->
        <div class="col-xl-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">GRIFO</h1>
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
                        <button id="addgrifo" class="btn btn-success " title="click para aregar grifo"
                                data-toggle="modal" data-target="#modal_dialog_add_grifo">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar grifo
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_grifo"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            RUC
                                        </th>
                                        <th>
                                            DESCRIPCION
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
        <!----------------------------------------End Panel GRIFO---------------------------------------->

    </div>
</div>
<!----------------------------------------INICIO MODAL AGREGAR GRIFO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_grifo">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR GRIFO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-12 ">
                            <label for="ruc">RUC
                                <req>*</req>
                            </label>

                            <input class="form-control form-control-sm" type="text" id="ruc"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valruc"></div>
                            <label for="descgrif">NOMBRE GRIFO
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descgrif"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescgrif"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviargrifo" class="btn btn-success " title="click para agregar grifo
                    " onclick="enviarGrifo()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR GRIFO---------------------------------------->
<!----------------------------------------INICIO MODAL EDITAR GRIFO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_grifo">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR GRIFO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-12 ">
                            <input id="idedgrif" hidden>
                            <label for="edruc">RUC
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="edruc"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valedruc"></div>
                            <label for="eddescgrif">NOMBRE GRIFO
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="eddescgrif"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valeddescgrif"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviargrifoed" class="btn btn-success " title="click para agregar grifo
                    " onclick="enviarGrifdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR GRIFO---------------------------------------->

<!----------------------------------------INICIO MODAL AGREGAR CHOFER---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_marca">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR MARCA</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-12 ">
                            <label for="descmarc">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descmarc"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescmarc"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarmarca" class="btn btn-success " title="click para agregar Marca
                    " onclick="enviarMarca()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR CHOFER---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR CHOFER---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_marca">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR MARCA</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idmarcedit" hidden/>
                        <div class="col-xl-12 ">
                            <label for="descmarcedit">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descmarcedit"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescmarcedit"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarmarcaedit" class="btn btn-success " title="click para Editar Marca
                    " onclick="enviarMarcaEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR CHOFER---------------------------------------->

<!----------------------------------------INICIO MODAL AGREGAR TIPO COMBUSTIBLE---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_tipcomb">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR TIPO COMBUSTIBLE</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-12 ">
                            <label for="desctipcomb">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="desctipcomb"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdesctipcomb"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviartipcomb" class="btn btn-success " title="click para agregar Tipo Combustible
                    " onclick="enviarTipComb()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR TIPO COMBUSTIBLE---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR TIPO COMBUSTIBLE---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_tipcomb">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR TIPO COMBUSTIBLE</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idtipcombedit" hidden/>
                        <div class="col-xl-12 ">
                            <label for="desctipcombedit">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="desctipcombedit"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdesctipcombedit"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviartipcombedit" class="btn btn-success " title="click para Editar Tipo Combustible
                    " onclick="enviarTipCombEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR TIPO COMBUSTIBLE---------------------------------------->

<!----------------------------------------INICIO MODAL AGREGAR TIPO VEHICULO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_tipvehic">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR TIPO VEHICULO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-12 ">
                            <label for="desctipvehic">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="desctipvehic"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdesctipvehic"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviartipvehic" class="btn btn-success " title="click para agregar Tipo Vehiculo
                    " onclick="enviarTipVehic()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR TIPO VEHICULO---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR TIPO VEHICULO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_tipvehic">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR TIPO VEHICULO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idtipvehicedit" hidden/>
                        <div class="col-xl-12 ">
                            <label for="desctipvehicedit">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="desctipvehicedit"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdesctipvehicedit"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviartipvehicedit" class="btn btn-success " title="click para Editar Tipo Vehiculo
                    " onclick="enviarTipVehicEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR TIPO VEHICULO---------------------------------------->
<!----------------------------------------INICIO MODAL AGREGAR SUB MARCA---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_submarc">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR MODELO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <label for="marc">MARCA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="marc">

                            </select>
                            <div class="hide " id="valmarc"></div>
                        </div>
                        <div class="col-xl-6">
                            <label for="descsubmarc">MODELO
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descsubmarc"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescsubmarc"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarsubmarc" class="btn btn-success " title="click para agregar Sub Marca
                    " onclick="enviarSubMarc()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR  SUB MARCA---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR  SUB MARCA---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_submarc">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR MODELO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idsubmarcedit" hidden/>
                        <div class="col-xl-6 ">
                            <label for="marcedit">MARCA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="marcedit">

                            </select>
                            <div class="hide " id="valmarcedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="descsubmarcedit">MODELO
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descsubmarcedit"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescsubmarcedit"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarsubmarcedit" class="btn btn-success " title="click para Editar Sub Marca
                    " onclick="enviarSubMarcEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR  SUB MARCA---------------------------------------->

<!----------------------------------------INICIO MODAL AGREGAR MODELO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_modelo">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR VERSION</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <label for="submarc">MODELO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="submarc">

                            </select>
                            <div class="hide " id="valsubmarc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="tipcomb">TIPO DE COMBUSTIBLE
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="tipcomb">

                            </select>
                            <div class="hide " id="valtipcomb"></div>
                        </div>
                        <div class="col-xl-6">
                            <label for="descmodel">VERSION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descmodel"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescmodel"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarmodelo" class="btn btn-success " title="click para agregar Modelo
                    " onclick="enviarModelo()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR  MODELO---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR  MODELO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_modelo">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR VERSION</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idmodeledit" hidden/>
                        <div class="col-xl-6 ">
                            <label for="submarcedit">MODELO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="submarcedit">

                            </select>
                            <div class="hide " id="valsubmarcedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="tipcombedit">TIPO DE COMBUSTIBLE
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="tipcombedit">

                            </select>
                            <div class="hide " id="valtipcombedit"></div>
                        </div>
                        <div class="col-xl-6">
                            <label for="descmodeledit">VERSION
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm" type="text" id="descmodeledit"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="hide " id="valdescmodeledit"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarmodeloedit" class="btn btn-success " title="click para editar Modelo
                    " onclick="enviarModeloEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR  MODELO---------------------------------------->

<!----------------------------------------INICIO MODAL AGREGAR MODELO TIPO VEHICULO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_modeltipv">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR MODELO TIPO VEHICULO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-12 ">
                            <label for="modelo">MODELO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="modelo">

                            </select>
                            <div class="hide " id="valmodelo"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="tipvehic">TIPO DE VEHICULO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="tipvehic">

                            </select>
                            <div class="hide " id="valtipvehic"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarmodelotipv" class="btn btn-success " title="click para agregar Modelo Tipo Vehiculo
                    " onclick="enviarModeloTipV()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR  MODELO TIPO VEHICULO---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR  MODELO TIPO VEHICULO---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_modeltipv">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR MODELO TIPO VEHICULO</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idmodeltvedit" hidden/>
                        <div class="col-xl-12 ">
                            <label for="modeloedit">MODELO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="modeloedit">

                            </select>
                            <div class="hide " id="valmodeloedit"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="tipvehicedit">TIPO DE VEHICULO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm "id="tipvehicedit">

                            </select>
                            <div class="hide " id="valtipvehicedit"></div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarmodelotipvedit" class="btn btn-success " title="click para editar Modelo Tipo Vehiculo
                    " onclick="enviarModeloTipVEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR  MODELO TIPO VEHICULO---------------------------------------->


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
            $.getScript('../js/intranet/combustible/mantenimientotablas.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
