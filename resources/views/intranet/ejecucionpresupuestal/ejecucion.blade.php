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

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">EJECUCION PRESUPUESTAL </h1>
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
            <legend class="m-b-15">PEDIDO

            </legend>

            <!--INICIO BOTON AGREGAR PEDIDO-->
            <div class="col-xl-12  ">
                <button id="addPed" class="btn btn-success " title="click para agregar material o insumo"
                        data-toggle="modal" data-target="#modal_dialog_add_stock">
                    <i class="fas fa-lg fa-fw m-r-10 fa-handshake"></i>Agregar Pedido
                </button>
            </div>
            <!--FIN DE BOTON AGREGAR PEDIDO-->

            <br>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_pedidos"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
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
                                <td>
                                </td>
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th>
                                        PEDIDO
                                    </th>
                                    <th>
                                        META
                                    </th>
                                    <th>
                                        ESPECIFICA
                                    </th>

                                    <th>
                                        TRANS.
                                    </th>
                                    <th>
                                        MONTO
                                    </th>
                                    <th>
                                        FECHA
                                    </th>
                                    <th>
                                        O/C
                                    </th>
                                    <th>
                                        ESTADO SIGA
                                    </th>
                                    <th>
                                        TIPO
                                    </th>
                                    <th>
                                        ITEMS
                                    </th>
                                    <th>
                                        ESTADO
                                    </th>

                                    <th>
                                        USUARIO
                                    </th>
                                    <th>
                                        OPCIONES
                                    </th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right"><strong>TOTAL</strong></th>
                                    <th colspan="9" class="text-left"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<!----------------------------------INICIO DE MODAL  AGREGAR PEDIDO------------------------------------------------ -->
<div class="col-xl-12 ">
    <div class="modal fade" id="modal_dialog_add_Pedido">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR PEDIDO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="panel-body" id="messag" hidden>
                    <div class="alert alert-success alert-dismissible fade show mb-0">
                        <strong>Recuerda!</strong>
                        Para agrupar pedidos tienen que pertenecer a la misma meta, especifica y Rj.
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                    <label for="pegrupal">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;&nbsp;
                        &nbsp;&nbsp;</label>
                    <div class="form-check" title="Activar Agrupar pedidos">
                        <input class="form-check-input is-valid" type="checkbox" value="" id="pegrupal">
                        <label class="form-check-label" for="pegrupal">AGRUPAR</label>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="tip"> TIPO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="tip">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="validtip"></div>
                        </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6" id="nped" hidden>
                                <label for="nropedido">N&#35; DE PEDIDO
                                    <req>*</req>
                                </label>
                                <input id="nropedido" type="text" class="form-control  " autocomplete="off"
                                       onchange="valNroPedido('nropedido','validnropedido')"/>
                                <div class="hide " id="validnropedido"></div>
                            </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="estado"> ESTADO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="estado">
                                <option value="" selected>SELECCIONE</option>
                                <option value="0">PEDIDO</option>
                                <option value="1">CERTIFICADO</option>
                                <option value="2">COMPROMETIDO</option>
                                <option value="3">DEVENGADO</option>
                                <option value="4">GIRADO</option>
                            </select>
                            <div class="hide " id="validestado"></div>
                        </div>
                        <input id="idcenc"  hidden/>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6" id="centc" hidden>
                            <div class="form-group">
                                <label for="cencos">CENTRO DE COSTO</label>
                                <textarea class="form-control typeahead" rows="1" id="cencos"
                                          name="cencos"> </textarea>

                                <div class="hide " id="validcencos"></div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="fecpre">FEC PRESENTACION</label>
                            <input type="text" class="form-control" id="fecpre" autocomplete="off">
                            <div class="hide " id="valfecpre"></div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="nromet"> NRO META
                                <req>*</req>
                            </label>
                            <select class="form-control" id="nromet">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="validnromet"></div>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="espgas"> ESPECIFICA DE GASTO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="espgas">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="validespgas"></div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="npre"> TRANS/MODIF
                                <req>*</req>
                            </label>
                            <input id="idtransf" hidden>
                            <input id="idtrb" hidden>
                            <select class="form-control" id="npre">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valnpre"></div>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="sal">SALDO
                            </label>
                            <div class="input-group m-b-10">
                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                <input id="sal" type="text" class="form-control" disabled/>
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6" id="tipcam">
                            <label for="mont">MONTO
                                <req>*</req>
                            </label>
                            <div class="input-group m-b-10">
                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                <input id="mont" type="text" class="form-control" onkeypress="return filterFloat(event,this);"/>
                                <div class="hide " id="valmon"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" id="listesp" hidden>
                            <hr>
                            <label for="mont">LISTA ESPECIFICAS
                                <req>*</req>

                            </label>
                            <hr>
                        </div>
                        <hr>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6" id="totvi" hidden>
                            <label for="totv">TOTAL VIATICOS Y PASAJES
                            </label>
                            <div class="input-group m-b-10">
                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                <input id="totv" type="text" class="form-control" disabled/>

                            </div>
                            <div class="hide " id="valtotv"></div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="sus">SUSTENTO
                                <req>*</req>
                            </label>
                            <textarea class="form-control" rows="3" id="sus"  onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            <div class="hide " id="valsus"></div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row "id="grupalp" hidden>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <label for="nropedido1">N&#35; DE PEDIDO
                                <req>*</req>
                            </label>
                            <input id="nropedido1" type="text" class="form-control  " autocomplete="off"
                                   onchange="valNroPedido('nropedido1','validnropedido1')"/>
                            <div class="hide " id="validnropedido1"></div>
                        </div>
                        <input id="idcenc1"  hidden/>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="cencos1">CENTRO DE COSTO</label>
                                <textarea class="form-control typeahead" rows="1" id="cencos1"
                                          name="cencos"> </textarea>

                                <div class="hide " id="validcencos1"></div>
                            </div>
                        </div>
                        <div class="c">
                            <label for="addpedi">
                                &nbsp;&nbsp; &nbsp;&nbsp;
                            </label>
                            <div class="input-group m-b-10">
                                <button  id="addpedi" class="btn btn-primary" title="click para agregar pedido
                                            "><i class="fas fa-lg fa-fw m-r-10 fa-plus"></i>Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="data-table_list_pedi"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer" hidden>
                        <div class="col-xl-12 col-sm-12 col-xs-12 row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_pedi"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">

                                        <th>Nº PEDIDO.
                                        </th>
                                        <th>CENTRO COSTO
                                        </th>
                                        <th>OPCIONES
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                    </div>
                    <div class="col-xl-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviar" class="btn btn-success " title="click para agregar pedido
                    " onclick="enviar()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------FIN DE MODAL DE AGREGAR PEDIDO--------------------------------------->
<!----------------------------------INICIO DE MODAL  AGREGAR PEDIDO------------------------------------------------ -->
<div class="col-xl-12 ">
    <div class="modal fade" id="modal_dialog_ver_Pedido">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">VER DETALLES </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-2 ">
                            <label for="nropedidod">N&#35; DE PEDIDO
                            </label>
                            <input id="nropedidod" type="text" class="form-control  " autocomplete="off"
                                  disabled/>
                        </div>
                        <div class="col-xl-2 ">
                            <label for="usured">USU REG
                            </label>
                            <input id="usured" type="text" class="form-control  " autocomplete="off" disabled
                            />
                        </div>
                        <div class="col-xl-2 ">
                            <label for="nmd">N&#35; META
                            </label>
                            <input id="nmd" type="text" class="form-control  " autocomplete="off" disabled
                            />
                        </div>
                        <div class="col-xl-2 ">
                            <label for="tipd">TIPO
                            </label>
                            <input id="tipd" type="text" class="form-control  " autocomplete="off" disabled
                            />
                        </div>
                        <div class="col-xl-4 ">
                            <label for="esd">ESPECIFICA GASTO
                            </label>
                            <input id="esd" type="text" class="form-control  " autocomplete="off" disabled
                            />
                        </div>
                        <div class="col-xl-3 ">
                            <label for="transd">TRANSFERENCIA
                            </label>
                            <input disabled id="transd" type="text" class="form-control  " autocomplete="off"
                            />
                        </div>

                        <div class="col-xl-3 ">
                            <label for="montd">MONTO
                            </label>
                            <input id="montd" type="text" class="form-control  " autocomplete="off" disabled
                            />
                        </div>
                        <div class="col-xl-2 ">
                            <label for="fecd">FECHA
                            </label>
                            <input id="fecd" type="text" class="form-control  " autocomplete="off" disabled
                            />
                        </div>
                        <div class="col-xl-5 ">
                            <label for="ccd">CENTRO DE COSTO
                            </label>
                            <textarea class="form-control " rows="2" id="ccd"
                                      name="ccd" disabled> </textarea>

                        </div>
                        <div class="col-xl-6 ">
                            <label for="susd">SUSTENTO
                            </label>
                            <textarea class="form-control " rows="2" id="susd"
                                      name="susd" disabled> </textarea>

                        </div>
                    </div>
                    <div class="col-xl-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------FIN DE MODAL DE AGREGAR PEDIDO--------------------------------------->
<!----------------------------------INICIO DE MODAL  VER ITEMS PEDIDO------------------------------------------------ -->
<div class="col-xl-12 ">
    <div class="modal fade" id="modal_dialog_ver_Items_Pedido">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">VER ITEMS </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 ">
                        <div class="col-xl-3">
                            <label for="numpedi">NÚMERO DE PEDIDO
                            </label>
                            <input id="numpedi" type="text" class="form-control  " autocomplete="off"
                                   disabled/>
                        </div>

                        <br>

                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_detalle_pedidos"
                                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                               role="grid"
                                               aria-describedby="data-table-fixed-header_info" width="100%">
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
                                            </tbody>
                                            <thead>
                                            <tr role="row">
                                                <th>
                                                    DESC. ITEM
                                                </th>
                                                <th>
                                                    TIPO
                                                </th>
                                                <th>
                                                    CANT.
                                                </th>
                                                <th>
                                                    PRECIO X UNID.
                                                </th>
                                                <th>
                                                    SUB TOTAL
                                                </th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-right"><strong>TOTAL</strong></th>
                                                <th colspan="1" class="text-left"></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------FIN DE MODAL VER ITEMS PEDIDO--------------------------------------->


<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CAMBIAR ESTADO</h4>
            </div>
            <input id="idpedido" HIDDEN>
            <div id="estpedcan">
                <select class="form-control" id="estadocan">
                    <option value="0">PEDIDO</option>
                    <option value="1">CERTIFICADO</option>
                    <option value="2">COMPROMETIDO</option>
                    <option value="3">DEVENGADO</option>
                    <option value="4">GIRADO</option>
                </select>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
                <button id="enviar" onclick="cambiarEstado()" class="btn btn-success "
                        title="click para agregar una visita"
                ><i
                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------INICIO MODAL EDITAR PEDIDO------------------------------------------>
<div class="col-xl-12 ">
    <div class="modal fade" id="modal-dialog_edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR PEDIDO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <input id="idpedidoedit" type="text" class="form-control  " autocomplete="off" hidden/>
                <div class="modal-body row">
                    <div class="col-xl-6 ">
                        <label for="nropedidoedit">N&#35; DE PEDIDO
                            <req>*</req>
                        </label>
                        <input id="nropedidoedit" type="text" class="form-control  " autocomplete="off"/>
                    </div>

                    <div class="col-xl-6 ">
                        <label for="estadoedit"> ESTADO
                            <req>*</req>
                        </label>
                        <div id="estped">
                            <select class="form-control" id="estadoedit">
                                <option value="0">PEDIDO</option>
                                <option value="1">CERTIFICADO</option>
                                <option value="2">COMPROMETIDO</option>
                                <option value="3">DEVENGADO</option>
                                <option value="4">GIRADO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 ">
                        <label for="nrometedit"> NRO META
                            <req>*</req>
                        </label>
                        <select class="form-control" id="nrometedit">
                            <option selected value="0">SELECCIONE</option>
                        </select>
                    </div>

                    <div class="col-xl-6 ">
                        <label for="tipedit"> TIPO
                            <req>*</req>
                        </label>
                        <select class="form-control" id="tipedit">
                            <option selected value="0">SELECCIONE</option>
                        </select>
                    </div>
                    <div class="col-xl-6 ">
                        <label for="espgasedit"> ESPECIFICA DE GASTO
                            <req>*</req>
                        </label>
                        <select class="form-control" id="espgasedit">
                            <option selected value="0">SELECCIONE</option>
                        </select>
                    </div>

                    <div class="col-xl-6 ">
                        <input id="idtransfedit" hidden>
                        <input id="idtrbedit" hidden>
                        <label for="npreedit"> TRANS/MODIF
                            <req>*</req>
                        </label>
                        <select class="form-control" id="npreedit">
                            <option selected value="0">SELECCIONE</option>
                        </select>
                    </div>
                    <input id="idcenced"  hidden/>
                    <div class="col-xl-6 ">
                        <div class="form-group">
                            <label for="cencosed">CENTRO DE COSTO
                                <req>*</req>
                            </label>
                            <textarea class="form-control typeahead" rows="1" id="cencosed"
                                      name="cencosed"> </textarea>

                            <div class="hide " id="validcencosed"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3 col-xs-3">
                        <label for="saledit">SALDO
                        </label>
                        <div class="input-group m-b-10">
                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                            <input id="saledit" type="text" class="form-control" disabled/>
                        </div>
                    </div>
                    <div class="col-xl-3 " id="tipcam">
                        <input type="text" id="saldedit" hidden>
                        <label for="montedit">MONTO
                            <req>*</req>
                        </label>
                        <div class="input-group m-b-10">
                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                            <input id="montedit" type="text" class="form-control" onkeypress="return filterFloat(event,this);"/>
                            <div class="hide " id="valmontedit"></div>
                        </div>
                    </div>

                    <div class="col-xl-2 ">
                        <label for="fecpreedit">FEC PRES</label>
                        <input type="text" class="form-control" id="fecpreedit" autocomplete="off">
                        <div class="hide " id="valfecpre"></div>
                    </div>
                    <div class="col-xl-6 ">
                        <label for="susedit">SUSTENTO
                            <req>*</req>
                        </label>
                        <textarea class="form-control" rows="3" id="susedit"></textarea>
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
            $.getScript('../js/intranet/presupuesto/ejecucion.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });



</script>
