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
<style>
    .modal.modal-fullscreen .modal-dialog {
        width:100vw;
        height:90vh;
        margin:5vh;
        padding-right: 9vh;
        padding-left: 0vh;
        max-width:none;
    }
    .modal.modal-fullscreen .modal-content {
        height:auto;
        height:90vh;
        border-radius:1vh;
        border:none;
    }
    .modal.modal-fullscreen .modal-body {
        overflow-y:auto;

    }
    .modal-headerf{padding:9px 15px;border-bottom:1px solid #eee;}.modal-headerf .close{margin-top:2px;}
</style>
<br>
<br>
<div id="response">
    {{ csrf_field() }}
    <div class="col-xl-12">
        <!-- begin nav-tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                    <span class="d-sm-none">Tab 1</span>
                    <span class="d-sm-block d-none">Incorporacion presupuestal</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2" data-toggle="tab" class="nav-link" id="mod_pres">
                    <span class="d-sm-none">Tab 2</span>
                    <span class="d-sm-block d-none">Modificacion presupuestal</span>
                </a>
            </li>
        </ul>
        <!-- end nav-tabs -->
        <!-- begin tab-content -->


        <!-- ---------------------------------INICIO MODAL INCORPORACION PRESUPUESTAL--------------------------------------->

        <div class="col-xl-12 ">
            <div class="modal modal-fullscreen fade" id="modal-dialog_incor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-headerf">
                            <h4 class="modal-title">AGREGAR INCORPORACION</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                        <div class="col-xl-12 col-sm-12 col-xs-12 row">
                            <div class="col-xl-6 col-sm-6 col-xs-6">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS
                                    TRANSFERENCIA
                                </legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="nrrj">NRO RJ
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="nrrj">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validarnrrj"></div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="fecin">FECHA DE INGRESO
                                        </label>
                                        <input id="fecin" type="text" class="form-control  " autocomplete="off" disabled/>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="fufi">FUENTE DE FINANC.
                                        </label>
                                        <input id="fufi" type="text" class="form-control  " autocomplete="off" disabled
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="montoin">MONTO INICIAL
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input type="text" id="montoin" class="form-control" disabled/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_tecpresu"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">

                                                        <th>PROGRAMA
                                                        </th>
                                                        <th>CONCEPTO
                                                        </th>
                                                        <th>MONTO
                                                        </th>
                                                        <th>SALDO
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
                            </div>
                            <div class="col-xl-6 col-sm-6 col-xs-6">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DESTINO</legend>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row ">

                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="meta">META
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="meta" disabled>
                                        </select>
                                        <div class="hide " id="validmeta"></div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="salp">SALDO PRESUPUESTAL
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input type="text" id="salp" class="form-control" disabled/>
                                            <div class="hide" id="validsalp" ></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="pro">PROGRAMA
                                        </label>
                                        <input type="text" id="pro" class="form-control" disabled/>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="prod">PRODUCTO
                                        </label>
                                        <textarea id="prod" class="form-control" rows="1" disabled></textarea>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="act">ACTIVIDAD
                                        </label>
                                        <textarea id="act" class="form-control" rows="1" disabled></textarea>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="fin">FINALIDAD
                                        </label>
                                        <textarea id="fin" class="form-control" rows="1" disabled></textarea>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-xs-6">
                                        <label for="esga">ESPECIFICA DE GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="esga">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validaresga"></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3 col-xs-3">
                                        <label for="monme">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input type="text" id="monme" onkeypress="return filterFloat(event,this);" onchange="validMonto()"  class="form-control"/>
                                            <div class="hide" id="validmonme"></div>
                                        </div>
                                    </div>
                                    <div class="c">
                                        <label for="addpres">
                                            &nbsp;&nbsp; &nbsp;&nbsp;
                                        </label>
                                        <div class="input-group m-b-10">
                                            <button  id="addpres" class="btn btn-primary" title="click para agregar presupuesto
                                            "><i class="fas fa-lg fa-fw m-r-10 fa-plus"></i>Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_pres"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">

                                                        <th>PROG.
                                                        </th>
                                                        <th>META
                                                        </th>
                                                        <th>ESPECIFICA
                                                        </th>
                                                        <th>MONTO
                                                        </th>
                                                        <th>OPCIONES
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-right"><strong>TOTAL</strong></th>
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
                        </div>
                        <div class="modal-footer">
                            <div class="col-xl-12 text-center">
                                 <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                         class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                 <button  id="enviar" class="btn btn-success " title="click para agregar incorporacion
                         " onclick="enviarPres()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                 </button>
                             </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------------------ FIN MODAL INCORPORACION PRESUPUESTAL---------------------------------------->

        <!-- ---------------------------------INICIO MODAL MODIFICACION PRESUPUESTAL----------------------------------------->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-dialog_modif">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">AGREGAR MODIFICACION</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body row">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">NOTA MODIFICATORIA</legend>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="nnota">NRONOTA
                                            <req>*</req>
                                        </label>
                                        <input id="nnota" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"autocomplete="off"
                                               onchange="valnota()"/>
                                        <div class="hide" id="validarnnota" ></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ndoc">NRO DOCUMENTO
                                            <req>*</req>
                                        </label>
                                        <input id="ndoc" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="tipmod">TIPO MODIFICACION
                                            <req>*</req>
                                        </label>
                                        <input id="tipmod" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="sustn">SUSTENTO
                                            <req>*</req>
                                        </label>
                                        <textarea class="form-control form-comtrol-sm" id="sustn" rows="1"
                                                  onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="fecpre">FEC PRESENTACION</label>
                                        <input type="text" class="form-control form-control-sm" id="fecpre">
                                        <div class="hide " id="valfecdiag"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="nrrjmod">NRO RJ
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="nrrjmod">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ejecutval">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            &nbsp;&nbsp;</label>
                                        <div class="form-check" title="Activar para enviar presupuesto a ejecutora">
                                            <input class="form-check-input is-valid" type="checkbox" value="" id="ejecutval">
                                            <label class="form-check-label" for="ejecutval">PARA EJECUTORA</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <!--------------------------------------ORIGEN------------------------------------------->
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ORIGEN</legend>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="meo">META
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="meo">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ego">ESPECIFICA DE GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="ego">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="montnm">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input id="montnm" type="text" class="form-control form-control-sm" autocomplete="off" onkeypress="return filterFloat(event,this);"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 align-self-center">
                                        <!--<label for="addor">
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                        </label>-->
                                        <button id="addor" class="btn btn-circle btn-primary  " title="click para agregar meta origen">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <!---------------------------------------FIN ORIGEN---------------------------------------->
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <input id="totalmonorig" hidden/>
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_meor"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <thead>
                                                <tr role="row">

                                                    <th>NRO META
                                                    </th>
                                                    <th>ESPECIFICA
                                                    </th>
                                                    <th>MONTO
                                                    </th>
                                                    <th>OPCIONES
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right"><strong>TOTAL ANULA</strong></th>
                                                    <th colspan="2" class="text-left"></th>
                                                </tr>
                                                </tfoot>


                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-----------------------------------INICIO DESTINO--------------------------------------->
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DESTINO</legend>
                            <div id="metdes" class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="med">META
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="med">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 ">
                                        <label for="egd">ESPECIFICA DE GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="egd">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 ">
                                        <label for="montd">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input id="montd" type="text" class="form-control form-control-sm" onkeypress="return filterFloat(event,this);"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 align-self-center">
                                        <!-- <label for="adddes">
                                             &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                             &nbsp;&nbsp;
                                         </label>-->
                                        <button id="adddes" class="btn btn-primary btn-icon btn-circle btn-lg "
                                                title="click para agregar Mesta destino">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <input id="totalmondest" hidden/>
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_medes"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">

                                                        <th>NRO META
                                                        </th>
                                                        <th>ESPECIFICA
                                                        </th>
                                                        <th>MONTO
                                                        </th>
                                                        <th>OPCIONES
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-right"><strong>TOTAL CREDITO</strong></th>
                                                        <th colspan="2" class="text-left"></th>
                                                    </tr>
                                                    </tfoot>


                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-----------------------------------FIN DESTINO--------------------------------------->

                            <div class="col-xl-5 " id="ejecutora" hidden>
                                <!--<div class="col-xl-5 ">-->
                                <label for="ejec">EJECUTORA
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="ejec">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <!--</div>-->
                            </div>
                        </div>

                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <!-- <button id="enviar" class="btn btn-success " title="click para agregar usuario
                     " onclick="enviarPres()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                             </button>-->
                            <button id="enviarnot" class="btn btn-success " title="click para guardar nota modificatoria
                    " onclick="enviarNot()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                            </button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>



        <!-- ----------------------------------------FIN MODAL MODIFICACION PRESUPUESTAL------------------------------------------>
        <div class="modal fade modal-fullscreen" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


        <!-- ---------------------------------INICIO MODAL EDITAR MODIFICACION PRESUPUESTAL----------------------------------------->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_edit_modif">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR MODIFICACION</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body row">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">NOTA MODIFICATORIA</legend>
                            <div class="container">
                                <div class="row">
                                    <input id="idmodedit" hidden/>
                                    <input id="ejetrue" hidden/>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="nnotaedit">NRONOTA
                                            <req>*</req>
                                        </label>
                                        <input id="nnotaedit" type="text" class="form-control" autocomplete="off"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ndocedit">NRO DOCUMENTO
                                            <req>*</req>
                                        </label>
                                        <input id="ndocedit" type="text" class="form-control" autocomplete="off"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="tipmodedit">TIPO MODIFICACION
                                            <req>*</req>
                                        </label>
                                        <input id="tipmodedit" type="text" class="form-control" autocomplete="off"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="sustnedit">SUSTENTO
                                            <req>*</req>
                                        </label>
                                        <textarea class="form-control" id="sustnedit" rows="1"
                                                  onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="fecpreedit">FEC PRESENTACION</label>
                                        <input type="text" data-date-format="dd-mm-yyyy" class="form-control" id="fecpreedit">
                                        <div class="hide " id="valfecdiag"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="nrrjmodedit">NRO RJ
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="nrrjmodedit">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ejecutval">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            &nbsp;&nbsp;</label>
                                        <div class="form-check" title="Activar para enviar prespuesto a ejecutora">
                                            <input class="form-check-input is-valid" type="checkbox" value="" id="ejecutvaledit">
                                            <label class="form-check-label" for="ejecutvaledit">PARA EJECUTORA</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <!--------------------------------------ORIGEN------------------------------------------->
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ORIGEN</legend>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="metamodedit">META
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="metamodedit">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="egoedit">ESPECIFICA DE GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="egoedit">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="montnmedit">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input id="montnmedit" type="text" class="form-control" autocomplete="off" onkeypress="return filterFloat(event,this);"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 align-self-center">
                                        <!--<label for="addor">
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                        </label>-->
                                        <a href="javascript:;"  id="addoredit" class="btn btn-circle btn-primary  " title="click para agregar meta origen">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <!---------------------------------------FIN ORIGEN---------------------------------------->
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <input id="totalmonorigedit" hidden/>
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_meoredit"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <thead>
                                                <tr role="row">

                                                    <th>NRO META
                                                    </th>
                                                    <th>ESPECIFICA
                                                    </th>
                                                    <th>MONTO
                                                    </th>
                                                    <th>ESTADO
                                                    </th>
                                                    <th>OPCIONES
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right"><strong>TOTAL ANULA</strong></th>
                                                    <th colspan="3" class="text-left"></th>
                                                </tr>
                                                </tfoot>


                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-----------------------------------INICIO DESTINO--------------------------------------->
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DESTINO</legend>
                            <div id="metdesedit" class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="mededit">META
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="mededit">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 ">
                                        <label for="egdedit">ESPECIFICA DE GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="egdedit">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 ">
                                        <label for="montdedit">MONTO
                                            <req>*</req>
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                            <input id="montdedit" type="text" class="form-control" onkeypress="return filterFloat(event,this);"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 align-self-center">
                                        <!-- <label for="adddes">
                                             &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                             &nbsp;&nbsp;
                                         </label>-->
                                        <a href="javascript:;"  id="adddesedit" class="btn btn-primary btn-icon btn-circle btn-lg "
                                                title="click para agregar Meta destino">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <input id="totalmondestedit" hidden/>
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_medesedit"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">

                                                        <th>NRO META
                                                        </th>
                                                        <th>ESPECIFICA
                                                        </th>
                                                        <th>MONTO
                                                        </th>
                                                        <th>ESTADO
                                                        </th>
                                                        <th>OPCIONES
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-right"><strong>TOTAL CREDITO</strong></th>
                                                        <th colspan="3" class="text-left"></th>
                                                    </tr>
                                                    </tfoot>


                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-----------------------------------FIN DESTINO--------------------------------------->

                            <div class="col-xl-5 " id="ejecutoraedit" hidden>
                                <!--<div class="col-xl-5 ">-->
                                <label for="ejecedit">EJECUTORA
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="ejecedit">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <!--</div>-->
                            </div>
                        </div>

                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" id="canceledit" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <!-- <button id="enviar" class="btn btn-success " title="click para agregar usuario
                     " onclick="enviarPres()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                             </button>-->
                            <button id="enviarnotedit" class="btn btn-success " title="click para guardar nota modificatoria
                    " onclick="enviarNotEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                            </button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>



        <!-- ----------------------------------------FIN MODAL EDITAR MODIFICACION PRESUPUESTAL------------------------------------------>



        <!-- ---------------------------------INICIO MODAL VER MODIFICACION PRESUPUESTAL----------------------------------------->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_ver_modif">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">VER MODIFICACION PRESUPUESTAL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body row">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">NOTA MODIFICATORIA</legend>
                            <div class="container">
                                <div class="row">

                                    <input id="ejetrue" hidden/>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="nnotaver">NRONOTA
                                            <req>*</req>
                                        </label>
                                        <input id="nnotaver" type="text" class="form-control" autocomplete="off" disabled
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ndocver">NRO DOCUMENTO
                                            <req>*</req>
                                        </label>
                                        <input id="ndocver" type="text" class="form-control" autocomplete="off" disabled
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="tipmodver">TIPO MODIFICACION
                                            <req>*</req>
                                        </label>
                                        <input id="tipmodver" type="text" class="form-control" autocomplete="off" disabled
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="sustnver">SUSTENTO
                                            <req>*</req>
                                        </label>
                                        <textarea class="form-control" id="sustnver" rows="1" disabled
                                                  onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="fecprever">FEC PRESENTACION</label>
                                        <input type="text" data-date-format="dd-mm-yyyy" class="form-control" id="fecprever" disabled>
                                        <div class="hide " id="valfecdiag"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="nrrjmodver">NRO RJ
                                            <req>*</req>
                                        </label>
                                        <select class="form-control" id="nrrjmodver" disabled>
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                        <label for="ejecutval">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            &nbsp;&nbsp;</label>
                                        <div class="form-check" title="Activar para enviar prespuesto a ejecutora">
                                            <input class="form-check-input is-valid" type="checkbox" value="" id="ejecutvalver"disabled>
                                            <label class="form-check-label" for="ejecutvaledit">PARA EJECUTORA</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <!--------------------------------------ORIGEN------------------------------------------->
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ORIGEN</legend>


                            <!---------------------------------------FIN ORIGEN---------------------------------------->
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_meorver"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <thead>
                                                <tr role="row">

                                                    <th>NRO META
                                                    </th>
                                                    <th>ESPECIFICA
                                                    </th>
                                                    <th>MONTO
                                                    </th>
                                                    <th>ESTADO
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right"><strong>TOTAL ANULA</strong></th>
                                                    <th colspan="2" class="text-left"></th>
                                                </tr>
                                                </tfoot>


                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-----------------------------------INICIO DESTINO--------------------------------------->
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DESTINO</legend>
                            <div id="metdesver" class="container">

                                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                    <div id="data-table-fixed-header_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="tabla_medesver"
                                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                       role="grid"
                                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                                    <thead>
                                                    <tr role="row">

                                                        <th>NRO META
                                                        </th>
                                                        <th>ESPECIFICA
                                                        </th>
                                                        <th>MONTO
                                                        </th>
                                                        <th>ESTADO
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-right"><strong>TOTAL CREDITO</strong></th>
                                                        <th colspan="2" class="text-left"></th>
                                                    </tr>
                                                    </tfoot>


                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-----------------------------------FIN DESTINO--------------------------------------->

                            <div class="col-xl-5 " id="ejecutoraver" hidden>
                                <!--<div class="col-xl-5 ">-->
                                <label for="ejecver">EJECUTORA
                                    <req>*</req>
                                </label>
                                <select class="form-control" id="ejecver" disabled>
                                    <option selected value="0" disabled>SELECCIONE</option>
                                </select>
                                <!--</div>-->
                            </div>
                        </div>

                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" id="cerrarmod" class="btn btn-success" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>



        <!-- ----------------------------------------FIN MODAL VER MODIFICACION PRESUPUESTAL------------------------------------------>




        <div class="tab-content">

            <!-- ------------------   begin tab1-pane-Incorporacion presupuestal ------------------------------------->

            <div class="tab-pane fade active show" id="default-tab-1">
                <div class="col-xl-12  ">
                    <button id="addincor" class="btn btn-success " title="click para agregar material o insumo"
                            data-toggle="modal" data-target="#modal_dialog_add_stock">
                        <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar incorporacion
                    </button>
                </div>
                <br>
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
                                        <th>NRO META
                                        </th>
                                        <th>ESPECIFICA
                                        </th>
                                        <th>MONTO
                                        </th>
                                        <th>FEC CREACION
                                        </th>
                                        <th>ESTADO
                                        </th>
                                        <th>OPCIONES
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right"><strong>TOTAL</strong></th>
                                        <th colspan="4" class="text-left"></th>
                                    </tr>
                                    </tfoot>


                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-------------------------------- end tab1-panel Incorporacion presupuestal ----------------------------->


            <!------------------------------ begin tab2-panel- Modificacion Presupuestal -------------------------- -->

            <div class="tab-pane fade" id="default-tab-2">
                <!--INICIO BOTON AGREGAR MODIFICACION-->
                <div class="col-xl-12">
                    <button id="addnmod" class="btn btn-success" data-toggle="modal" title="Clic para agregar Nota Modificatoria"
                            data-target="#modal_dialog_add_stock">
                        <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Modificacion
                    </button>
                </div>
                <!--FIN BOTON AGREGAR MODIFICACION-->
                <br>

                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_modi"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            NRO NOTA
                                        </th>
                                        <th>TIPO MODIFICACION
                                        </th>
                                        <th>NRO RJ
                                        </th>
                                        <th>DESTINO
                                        </th>
                                        <th>MONTO
                                        </th>
                                        <th>ESTADO
                                        </th>
                                        <th>OPCIONES
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right"><strong>TOTAL</strong></th>
                                        <th colspan="3" class="text-left"></th>
                                    </tr>
                                    </tfoot>


                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!----------------------------- end tab-panel- Modificacion Presupuestal------------------------------- -->

        </div>
        <!-- end tab-content -->

    </div>

    <!---------------------------------INICIO MODAL EDITAR INCORPORACION ------------------------------------------>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal-dialog_edit_inc">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">EDITAR INCORPORACION</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>


                    <div class="modal-body row">
                        <input id="idincedit" hidden/>
                        <div class="col-xl-3 ">
                            <label for="nrrjincedt">NRO RJ
                                <req>*</req>
                            </label>
                            <select class="form-control" id="nrrjincedt">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="metaincedit">META
                                <req>*</req>
                            </label>
                            <select class="form-control" id="metaincedit">
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label for="esgaincedit">ESPECIFICA DE GASTO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="esgaincedit">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                        </div>
                        <div class="col-xl-3 ">
                            <label for="monmeincedit">MONTO
                                <req>*</req>
                            </label>
                            <div class="input-group m-b-10">
                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                <input type="text" id="monmeincedit" class="form-control" />
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 text-center">
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviareditincedit" class="btn btn-success " title="click para editar pedido
                    " onclick="enviareditincEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------------------------FIN MODAL EDITAR INCORPORACION ------------------------------------->
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal-dialog_add_tech">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">TECHO PRESUPUESTAL</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <br>
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
            $.getScript('../js/intranet/presupuesto/gestion.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

</script>
