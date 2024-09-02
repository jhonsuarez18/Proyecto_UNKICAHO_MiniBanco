<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<link href="{{asset('assets/css/material/parpadeo.css')}}" rel="stylesheet" id="theme"/>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>


<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>

<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet"/>

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
<!--<style>
    .animated {
        -webkit-animation-duration: 700s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }
    @-webkit-keyframes flash {
        0%, 50%, 100% {
            opacity: 1;
        }
        25%, 75% {
            opacity: 0;
        }
    }
    @keyframes flash {
        0%, 50%, 100% {
            opacity: 1;
        }
        25%, 75% {
            opacity: 0;
        }
    }
    .flash {
        -webkit-animation-name: flash;
        animation-name: flash;
    }
</style>-->
<br>
<br>
<div id="response">

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">MEDICAMENTOS Y DISPOSITIVOS MEDICOS</h1>
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
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row ">
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 ">
                        <button id="addmatin" class="btn btn-success btn-block form-group" title="click para agregar material o insumo"
                                data-toggle="modal" data-target="#modal_dialog_add_stock">
                            <i class="fas fa-lg fa-fw m-r-10 fa-cart-plus"></i>Agregar stock
                        </button>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 ">
                        <button id="movmat" class="btn btn-success btn-block form-group"  title="click para mover material o insumo"
                                data-toggle="modal" data-target="#modal_dialog_mov_stock">
                            <i class="fas fa-lg fa-fw m-r-10 fa-truck"></i>Mover
                        </button>
                    </div>
                   <!-- <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 ">
                        <button id="recmat" class="btn btn-success btn-block form-group" title="click para mover material o insumo"
                                data-toggle="modal" >
                            <i class="fas fa-lg fa-fw m-r-10 fa-tasks"></i>Ver transferencias

                        </button>
                    </div>-->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 ">
                        <button id="recmat" class="btn btn-success btn-block form-group" title="click para mover material o insumo"
                                data-toggle="modal" >

                        </button>
                    </div>

                </div>
            </div>
            <br>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                <input id="idloc" hidden/>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <label for="nomal">NOMBRE ALMACEN
                        <req>*</req>
                    </label>
                    <input id="nomal" type="text" class="form-control"
                           disabled/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <label for="diral">DIRECCION ALMACEN
                        <req>*</req>
                    </label>
                    <input id="diral" type="text" class="form-control"
                           disabled/>
                </div>
            </div>
            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_stock_loc"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <tbody>
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th>
                                        NOMBRE
                                    </th>
                                    <th>
                                        TIPO
                                    </th>
                                    <th>
                                        CANT
                                    </th>
                                    <th>
                                        FEC INGRESO
                                    </th>
                                    <th>
                                        ORIGEN
                                    </th>
                                    <th>
                                        ESTADO
                                    </th>
                                    <th>
                                        OPC
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_add_stock">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">AGREGAR STOCK</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body ">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <input id="tipmed" hidden>
                                <input id="addidmed" hidden>
                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                    <label for="adddecm">NOMBRE MEDICAMENTO
                                        <req>*</req>
                                    </label>
                                    <input id="adddescm" type="text" class="form-control" autocomplete="off"
                                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    <div class="hide " id="valadddescm"></div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-11">
                                    <label for="addcant">CANTIDAD
                                        <req>*</req>
                                    </label>
                                    <input id="addcant" type="number" class="form-control  " autocomplete="off"
                                           value="0" min="0" max="100"/>
                                    <div class="hide " id="validDni"></div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1  btn-group-justified">
                                    <label for="adddes">
                                        &nbsp;&nbsp; &nbsp;&nbsp;
                                    </label>
                                    <button id="adddes" class="btn btn-primary btn-icon btn-circle btn-lg "
                                            title="click para agregar stock">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_addstock"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <tbody>
                                                </tbody>
                                                <thead>
                                                <tr role="row">
                                                    <th>
                                                        NOMBRE
                                                    </th>
                                                    <th>
                                                        TIPO
                                                    </th>
                                                    <th>
                                                        CANT
                                                    </th>
                                                    <th>
                                                        OPC
                                                    </th>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-3 row">
                                <label for="ori"> ORIGEN
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="ori">
                                    <option selected value="-1">SELECCIONE</option>
                                    <option  value="0">DONACION</option>
                                    <option  value="2">DEMID</option>
                                    <option  value="3">COMPRA DIRECTA</option>
                                    <option  value="4">CENARES</option>
                                </select>
                                <div class="hide " id="validpropre"></div>
                            </div>
                            <div class="col-xl-12 row">
                                <label for="mot">MOTIVO
                                    <req>*</req>
                                </label>
                                <textarea id="mot" class="form-control" rows="1"
                                          onkeyup="javascript:this.value=this.value.toUpperCase();"
                                ></textarea>
                            </div>

                            <div class="col-xl-12 text-center">
                                <br>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="guardarstock" class="btn btn-success " title="click para agregar stock
                    "><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_mov_stock">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">MOVER STOCK</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">


                        <hr>
                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_mov_stock"
                                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                               role="grid"
                                               aria-describedby="data-table-fixed-header_info" width="100%">
                                            <tbody>
                                            </tbody>
                                            <thead>
                                            <tr role="row">
                                                <th>
                                                    CODIGO
                                                </th>
                                                <th>
                                                    NOMBRE
                                                </th>

                                                <th>FECING
                                                </th>
                                                <th>
                                                    CANTIDAD
                                                </th>
                                                <th>
                                                    MOVER
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-xs-12  row">
                            <div class="col-xl-12 ">
                                <label for="ejec"> EJECUTORA
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="ejec">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="validejec"></div>
                            </div>
                            <div class="col-xl-12 ">
                                <label for="almac"> ALMACEN
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="almac">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="validalmac"></div>
                            </div>
                            <div class="col-xl-12 ">
                                <label for="motr">MOTIVO</label>
                                <textarea class="form-control typeahead" rows="1" id="motr" name="motr" onkeyup="javascript:this.value=this.value.toUpperCase();"> </textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <hr>
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <button id="enviarMov" class="btn btn-success " title="click para guardar movimiento" ><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_rec_stock">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">VER TRANSFERENCIAS</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_verenviostock"
                                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                               role="grid"
                                               aria-describedby="data-table-fixed-header_info" width="100%">
                                            <tbody>
                                            </tbody>
                                            <thead>
                                            <tr role="row">
                                                <th>
                                                    EJECUTORA
                                                </th>
                                                <th>
                                                    MOTIVO
                                                </th>
                                                <th>
                                                    FEC ROTACION
                                                </th>
                                                <th>
                                                    CANT ITMS
                                                </th>
                                                <th class="text-center">
                                                    OPC
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <br>
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_edit_stock">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar stock</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-xs-12 col-sm-12 row">
                            <input id="idstock" hidden>
                            <div class="col-xl-8 col-xs-8 col-sm-8">
                                <label for="mededit">DESCRIPCION MEDICAMENTO
                                    <req>*</req>
                                </label>
                                <textarea id="mededit" class="form-control" rows="1"
                                          onkeyup="javascript:this.value=this.value.toUpperCase();"
                                          disabled></textarea>
                            </div>
                            <div class="col-xl-2 col-xs-2 col-sm-2">
                                <label for="tipedit">TIPO
                                    <req>*</req>
                                </label>
                                <input id="tipedit" type="text" class="form-control  " autocomplete="off"
                                       disabled/>
                            </div>
                            <div class="col-xl-2 col-xs-2 col-sm-2">
                                <label for="cantedit">N&#35; CANT
                                    <req>*</req>
                                </label>
                                <input id="cantedit" type="number" class="form-control text-center " autocomplete="off"
                                       value="0" min="0" max="100"/>

                            </div>
                        </div>

                        <div class="col-xl-12 text-center">
                            <br>
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <button id="editstock" class="btn btn-success " title="click para editar stock
                    "><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_ver_itms_stock">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">VER ITEMS TRANSFERENCIA</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input id="idrot" hidden/>
                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_recstockimt"
                                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                               role="grid"
                                               aria-describedby="data-table-fixed-header_info" width="100%">
                                            <tbody>
                                            </tbody>
                                            <thead>
                                            <tr role="row">
                                                <th>
                                                    MEDICAMENTO
                                                </th>
                                                <th>
                                                    TIPO
                                                </th>
                                                <th>
                                                    CANTIDAD
                                                </th>
                                                <th>
                                                    OPC
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <br>
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <button id="reittr" class="btn btn-success " title="click para editar stock
                            "><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Aceptar
                            </button>
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
        $.getScript('../assets/plugins/gritter/js/jquery.gritter.js'),
        $.when(
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/almacen/material.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
