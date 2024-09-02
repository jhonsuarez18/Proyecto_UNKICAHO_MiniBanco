<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>

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
<style>
    req {
        color: red;
    }
</style>
<br>
<br>
<div id="response">
    {{ csrf_field() }}
    <div class="col-xl-12">

        <!---------------------------------------- begin panel TIPO DE PEDIDO ------------------------------------->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">AGREGAR STOCK</h1>
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
                        <button id="addstock" class="btn btn-success " title="click para agregar material o insumo"
                                data-toggle="modal" data-target="#modal_dialog_add_stock">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar stock
                        </button>
                    </div>
                    <br>
                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="tabla_stock"
                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                           role="grid"
                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>O/C
                                            </th>
                                            <th class="text-center">PROGRAMA
                                            </th>
                                            <th>NRO META
                                            </th>
                                            <th>ITEM
                                            </th>
                                            <th>INGRESO/G
                                            </th>
                                            <th>ENTREGADO/G
                                            </th>
                                            <th>SALDO/G
                                            </th>
                                            <th>ESTADO
                                            </th>
                                            <th>OPCIONES
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="  col-sm-12 col-xs-12 col-md-12">
                        <dl class=" row dl-horizontal">
                            <div class="  col-sm-2 col-xs-2 col-md-2">
                                <dt class="text-inverse">Leyenda para Saldo/G:</dt>
                            </div>
                            <div class="  col-sm-10 col-xs-10 col-md-10 ">
                                <dd><i style="color: red;" class="fas fa-lg fa-fw m-r-10 fa-circle text-danger"></i>Poco
                                </dd>
                                <dd><i style="color: yellow;" class="fas fa-lg fa-fw m-r-10 fa-circle"> </i>
                                    Medianamente Suficiente
                                </dd>
                                <dd><i style="color: orange;" class="fas fa-lg fa-fw m-r-10 fa-circle text-success"> </i>Suficiente
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
        <!---------------------------------INICIO MODAL AGREGAR STOCK COMBUSTIBLE------------------------------------------>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_add_stock">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">AGREGAR STOCK COMBUSTIBLE</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>


                        <div class="modal-body row">
                            <input id="idincedit" hidden/>
                            <div class="col-xl-3 ">
                                <label for="numoc">O/C
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="numoc">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valnumoc"></div>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="itemcom">ITEM
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="itemcom">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valitemcom"></div>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="saldostk">SALDO
                                </label>
                                <div class="input-group m-b-10">
                                    <input type="text" id="saldostk" class="form-control" disabled/>
                                </div>
                                <div class="hide " id="valsaldostk"></div>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="meta">META
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="meta">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valmeta"></div>
                            </div>
                           <!-- <div class="col-xl-3">
                                <label for="esgastk">ESPECIFICA DE GASTO
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="esgastk">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valesgastk"></div>
                            </div>-->
                            <div class="col-xl-3 ">
                                <label for="cantidadstk">CANTIDAD
                                    <req>*</req>
                                </label>
                                    <input type="text" id="cantidadstk" class="form-control"
                                           onchange="validCant()"/>
                                <div class="hide " id="valcantidadstk"></div>
                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <button id="enviarstock" class="btn btn-success " title="click para guardar stock
                    " onclick="enviarStock()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                            </button>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------FIN MODAL AGREGAR STOCK COMBUSTIBLE------------------------------------------>


        <!---------------------------------INICIO MODAL EDITAR STOCK COMBUSTIBLE------------------------------------------>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_edit_stock">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR STOCK COMBUSTIBLE</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>


                        <div class="modal-body row">
                            <input id="idstkcomb" hidden/>
                            <input id="cantcedit" hidden/>
                            <input id="idcotedit" hidden/>
                            <div class="col-xl-3 ">
                                <label for="numocedit">O/C
                                    <req>*</req>
                                </label>
                                <select class="form-control form-control-sm" id="numocedit">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valnumocedit"></div>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="itemcomedit">ITEM
                                    <req>*</req>
                                </label>
                                <select class="form-control form-control-sm" id="itemcomedit">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valitemcomedit"></div>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="saldostkedit">SALDO
                                </label>
                                <div class="input-group m-b-10">
                                    <input type="text" id="saldostkedit" class="form-control" disabled/>
                                </div>
                                <div class="hide " id="valsaldostkedit"></div>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="metaedit">META
                                    <req>*</req>
                                </label>
                                <select class="form-control form-control-sm" id="metaedit">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide " id="valmetaedit"></div>
                            </div>
                            <!-- <div class="col-xl-3">
                                 <label for="esgastk">ESPECIFICA DE GASTO
                                     <req>*</req>
                                 </label>
                                 <select class="form-control" id="esgastk">
                                     <option selected value="0">SELECCIONE</option>
                                 </select>
                                 <div class="hide " id="valesgastk"></div>
                             </div>-->
                            <div class="col-xl-3 ">
                                <label for="cantidadstkedit">CANTIDAD
                                    <req>*</req>
                                </label>
                                <input type="text" id="cantidadstkedit" class="form-control form-control-sm"
                                       onchange="validCantEd()"/>
                                <div class="hide " id="valcantidadstkedit"></div>
                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <button id="enviareditstock" class="btn btn-success " title="click para guardar stock
                    " onclick="enviarEditStock()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                            </button>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------FIN MODAL EDITAR STOCK COMBUSTIBLE------------------------------------------>
        <!--------------------------------------- INICIO MODAL VER CONSUMO---------------------------------->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_vales_cons">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="m-b-15">MOSTRAR VALES DE CONSUMO
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xl-3 ">
                                <label for="numocv">ORDEN DE COMPRA Nº
                                </label>
                                <input type="text" id="numocv" class="form-control" disabled/>
                            </div>
                            <br>
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_vales"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <thead>
                                                <tr role="row">
                                                    <th>Nº
                                                    </th>
                                                    <th>FACT.
                                                    </th>
                                                    <th>ITEM
                                                    </th>
                                                    <th>ACTIVIDAD
                                                    </th>
                                                    <th>FECHA
                                                    </th>
                                                    <th>GALONES
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="5" class="text-right"><strong>TOTAL</strong></th>
                                                    <th colspan="1" class="text-center"></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------------------------- FIN MODAL VER CONSUMO------------------------------------->
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
             $.getScript('../js/intranet/combustible/agregarstock.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

</script>
