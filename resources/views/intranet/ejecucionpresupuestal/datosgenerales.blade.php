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
<br>
<br>
<div id="response">

    <!-- final cabecera -->


    <div class="row">
        <!---------------------------------------- begin panel TIPO DE PEDIDO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Tipo Pedido
                <small>Aqui puedo agregar el tipo de pedido</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO DE PEDIDO</h1>
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
                    <div class="row">
                        <input id="idtip" hidden/>
                        <div class="col-xl-12">
                            <label for="desctipo">DESCRIPCION TIPO
                                <req>*</req>
                            </label>
                            <input id="desctipo" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valTipPedido()"/>
                            <div class="hide" id="validartipo" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btng" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartipo" class="btn btn-success" title="Haga clic para agregar tipo de Pedido"
                                    onclick="enviarTip()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btne" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarTipEdit" class="btn btn-success" title="Haga clic para editar tipo de Pedido"
                                    onclick="enviarTipEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartip" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelartip()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

                            </button>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_tipo"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO
                                        </th>
                                        <th>
                                            DESCRIPCION TIPO
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO
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
        <!----------------------------------------End Panel TIPO DE PEDIDO---------------------------------------->

        <!---------------------------------------- begin panel FUENTE DE FINANCIAMIENTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Fuente Financiamiento
                <small>Aqui puedo agregar la fuente de financiamieto</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">FUENTE DE FINANCIAMIENTO</h1>
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
                    <div class="row">
                        <input id="idfuen" hidden/>
                        <div class="col-xl-12">
                            <label for="descfuen">DESCRIPCION FUENTE
                                <req>*</req>
                            </label>
                            <input id="descfuen" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valfuen()"/>
                            <div class="hide" id="validarfuen" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngff" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarfuen" class="btn btn-success" title="Haga clic para agregar Fuente de Financiamiento"
                                    onclick="enviarFuen()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneff" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarFuenEdit" class="btn btn-success" title="Haga clic para editar Fuente de finaciamiento"
                                    onclick="enviarFuenEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarfuen" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarfuen()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

                            </button>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_fuente"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO
                                        </th>
                                        <th>
                                            DESCRIPCION FUENTE
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO
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
        <!----------------------------------------End Panel  FUENTE DE FINANCIAMIENTO---------------------------------------->
        <!---------------------------------------- begin panel CONCEPTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Concepto
                <small>Aqui puedo agregar concepto</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">CONCEPTO</h1>
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
                    <div class="row">
                        <input id="idconcep" hidden/>
                        <div class="col-xl-12">
                            <label for="descconcep">DESCRIPCION CONCEPTO
                                <req>*</req>
                            </label>
                            <input id="descconcep" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valconcep()"/>
                            <div class="hide" id="validarconcep" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngc" class="container">
                        <div class="col-xl-12 text-center">
                            <br>
                            <button id="enviarconcep" class="btn btn-success" title="Haga clic para agregar Concepto"
                                    onclick="enviarConcep()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnec" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarConcepEdit" class="btn btn-success" title="Haga clic para editar Concep"
                                    onclick="enviarConcepEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarconcep" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarconcep()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

                            </button>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_concepto"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <!--<th>
                                            CODIGO
                                        </th>-->
                                        <th>
                                            DESCRIPCION CONCEPTO
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO
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
        <!----------------------------------------End Panel  CONCEPTO---------------------------------------->


        <!----------------------------------- begin panel PROGRAMA PRESUPUESTAL --------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Programa Presupuestal
                <small>Aqui puedo agregar el programa presupuestal</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">PROGRAMA PRESUPUESTAL</h1>
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
                    <div class="row">
                        <input id="idprog" hidden/>
                        <div class="col-xl-4">
                            <label for="codprog">CODIGO PROGRAMA
                                <req>*</req>
                            </label>
                            <input id="codprog" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide" id="validarcodprog" ></div>
                        </div>
                        <div class="col-xl-8">
                            <label for="descprog">DESCRIPCION PROGRAMA
                                <req>*</req>
                            </label>
                            <input id="descprog" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valProgramaPres()"/>
                            <div class="hide" id="validardescprog" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngprog" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarprogpres" class="btn btn-success" title="Haga clic para agregar Programa Presupuestal"
                                    onclick="enviarProgPres()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneprog" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarProgPEdit" class="btn btn-success" title="Haga clic para editar Programa Presupuestal"
                                    onclick="enviarProgPEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarprog" class="btn btn-danger" title="Haga clic cancelar"
                                    onclick="cancelarprog()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

                            </button>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_PrograPres"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO
                                        </th>
                                        <th>
                                            DESCRIPCION PROG. PRES.
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO
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
        <!--------------------------------------End Panel PROGRAMA PRESUPUESTAL----------------------------------->
        <!----------------------------------- begin panel ESPECIFICA DE GASTO --------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">Especifica Gasto
                <small>Aqui puedo agregar la especifica de gasto</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">ESPECIFICA DE GASTO</h1>
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
                    <div class="row">
                        <input id="idespg" hidden/>
                        <div class="col-xl-4">
                            <label for="codespg">CODIGO ESPECIFICA GASTO
                                <req>*</req>
                            </label>
                            <input id="codespg" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide" id="validarcodespg" ></div>
                        </div>
                        <div class="col-xl-8">
                            <label for="descespg">DESCRIPCION ESPECIFICA GASTO
                                <req>*</req>
                            </label>
                            <input id="descespg" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valEspeG()"/>
                            <div class="hide" id="validardescespg" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngespg" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarespg" class="btn btn-success" title="Haga clic para agregar Especifica de Gasto"
                                    onclick="enviarEspG()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneespg" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarEspGEdit" class="btn btn-success" title="Haga clic para editar Especifica de Gasto"
                                    onclick="enviarEspGEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarespg" class="btn btn-danger" title="Haga clic cancelar"
                                    onclick="cancelarespg()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

                            </button>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_EspecificaG"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO
                                        </th>
                                        <th>
                                            DESCRIPCION ESPEC. GASTO
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO
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
        <!--------------------------------------End Panel ESPECIFICA DE GASTO----------------------------------->
        <!----------------------------------- begin panel FINALIDAD --------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">Finalidad
                <small>Aqui puedo agregar la finalidad</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">FINALIDAD</h1>
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
                    <div class="row">
                        <input id="idfin" hidden/>
                        <div class="col-xl-4">
                            <label for="codpro">CODIGO PRODUCTO
                                <req>*</req>
                            </label>
                            <input id="codpro" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide" id="validarcodpro" ></div>
                        </div>
                        <div class="col-xl-8">
                            <label for="descpro">DESCRIPCION PRODUCTO
                                <req>*</req>
                            </label>
                            <input id="descpro" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                  />
                            <div class="hide" id="validardescpro" ></div>
                        </div>
                        <br>
                        <div class="col-xl-4">
                            <label for="codact">CODIGO ACTIVIDAD
                                <req>*</req>
                            </label>
                            <input id="codact" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide" id="validarcodact" ></div>
                        </div>
                        <div class="col-xl-8">
                            <label for="descact">DESCRIPCION ACTIVIDAD
                                <req>*</req>
                            </label>
                            <input id="descact" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                            />
                            <div class="hide" id="validardescact" ></div>
                        </div>
                        <br>
                        <div class="col-xl-4">
                            <label for="codfin">CODIGO FINALIDAD
                                <req>*</req>
                            </label>
                            <input id="codfin" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"
                                   onchange="valCodFin()"/>
                            <div class="hide" id="validarcodfin" ></div>
                        </div>
                        <div class="col-xl-8">
                            <label for="descfin">DESCRIPCION FINALIDAD
                                <req>*</req>
                            </label>
                            <input id="descfin" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                            />
                            <div class="hide" id="validardescfin" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngfin" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarfin" class="btn btn-success" title="Haga clic para agregar Finalidad"
                                    onclick="enviarFin()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnefin" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarfindit" class="btn btn-success" title="Haga clic para editar Finalidad"
                                    onclick="enviarFinEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarfin" class="btn btn-danger" title="Haga clic cancelar"
                                    onclick="cancelarfin()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

                            </button>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_Finalidad"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO PRO.
                                        </th>
                                        <th>
                                            DESCRIPCION PRO.
                                        </th>
                                        <th>
                                            CODIGO ACT.
                                        </th>
                                        <th>
                                            DESCRIPCION ACT.
                                        </th>
                                        <th>
                                            CODIGO FIN.
                                        </th>
                                        <th>
                                            DESCRIPCION FIN.
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO
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
        <!--------------------------------------End Panel FINALIDAD----------------------------------->
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
            $.getScript('../js/intranet/presupuesto/agregardatosgenerales.js'),
                $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
