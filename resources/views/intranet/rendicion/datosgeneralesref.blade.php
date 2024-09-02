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
        <!---------------------------------------- begin panel DOCUMENTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Documento
                <small>Aqui puedo agregar el documento</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">DOCUMENTO</h1>
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
                        <input id="iddoc" hidden/>
                        <div class="col-xl-12">
                            <label for="titdoc">TITULO
                                <req>*</req>
                            </label>
                            <input id="titdoc" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   />
                            <div class="hide" id="validartitdoc" ></div>
                        </div>
                        <div class="col-xl-12">
                            <br>
                            <label for="descdoc">DESCRIPCION DOC.
                                <req>*</req>
                            </label>
                            <input id="descdoc" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   />
                            <div class="hide" id="validardescdoc" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngdoc" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviardoc" class="btn btn-success" title="Haga clic para agregar Documento"
                                    onclick="enviarDoc()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnedoc" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarDocEdit" class="btn btn-success" title="Haga clic para editar Documento"
                                    onclick="enviarDocEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelardoc" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarDoc()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_documento"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            TITULO
                                        </th>
                                        <th>
                                            DESCRIPCION DOC.
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
        <!----------------------------------------End Panel DOCUMENTO---------------------------------------->
        <!---------------------------------------- begin panel TIPO DE SEGURO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Tipo Seguro
                <small>Aqui puedo agregar el tipo de seguro</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO DE SEGURO</h1>
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
                        <input id="idtips" hidden/>
                        <div class="col-xl-12">
                            <label for="desctips">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input id="desctips" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valdescriptips()"
                            />
                            <div class="hide" id="validardesctips" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngtips" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartips" class="btn btn-success" title="Haga clic para agregar Tipo de Seguro"
                                    onclick="enviarTipS()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnetips" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviartipsEdit" class="btn btn-success" title="Haga clic para editar Tipo de Seguro"
                                    onclick="enviarTipSEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartips" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarTipS()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_tipseguro"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION TIP. SEGURO
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
        <!----------------------------------------End Panel TIPO DE SEGURO---------------------------------------->
        <!---------------------------------------- begin panel PLAZO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Plazo
                <small>Aqui puedo agregar el plazo</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">PLAZO</h1>
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
                        <input id="idplazo" hidden/>
                        <div class="col-xl-12">
                            <label for="cantd">CANTIDAD DE DIAS
                                <req>*</req>
                            </label>
                            <input id="cantd" type="number" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valcantd()"
                            />
                            <div class="hide" id="validarcantd" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngplazo" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarplazo" class="btn btn-success" title="Haga clic para agregar Plazo"
                                    onclick="enviarPlazo()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneplazo" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarplazoEdit" class="btn btn-success" title="Haga clic para editar Plazo"
                                    onclick="enviarPlazoEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarplazo" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarPlazo()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_plazo"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CANTIDAD DIAS
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
        <!----------------------------------------End Panel PLAZO---------------------------------------->
        <!---------------------------------------- begin panel ESTADO PACIENTE ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Estado Paciente
                <small>Aqui puedo agregar el estado del paciente</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">ESTADO PACIENTE</h1>
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
                        <input id="idestpac" hidden/>
                        <div class="col-xl-12">
                            <label for="desestp">DESCRIPCION ESTADO PACIENTE
                                <req>*</req>
                            </label>
                            <input id="desestp" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valdesestp()"
                            />
                            <div class="hide" id="validardesestp" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngestp" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarestp" class="btn btn-success" title="Haga clic para agregar Estado del Paciente"
                                    onclick="enviarEstP()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneestp" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarestpEdit" class="btn btn-success" title="Haga clic para editar Estado del Paciente"
                                    onclick="enviarEstPEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarestp" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarEstP()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_estadop"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION ESTADO
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
        <!----------------------------------------End Panel ESTADO PACIENTE---------------------------------------->
        <!---------------------------------------- begin panel TIPO PERSONAL ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Tipo Personal
                <small>Aqui puedo agregar el tipo de personal</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO PERSONAL</h1>
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
                        <input id="idtipp" hidden/>
                        <div class="col-xl-12">
                            <label for="destipp">DESCRIPCION TIP. PERSONAL
                                <req>*</req>
                            </label>
                            <input id="destipp" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                            />
                            <div class="hide" id="validardestipp" ></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="abretipp">ABREVIATURA TIP. PERSONAL
                                <req>*</req>
                            </label>
                            <input id="abretipp" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valabretipp()"
                            />
                            <div class="hide" id="validarabretipp" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngtipp" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartipp" class="btn btn-success" title="Haga clic para agregar Tipo de Personal"
                                    onclick="enviarTipP()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnetipp" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviartippEdit" class="btn btn-success" title="Haga clic para editar Tipo de Personal"
                                    onclick="enviarTipPEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartipp" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarTipP()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_TipoP"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION TIPO
                                        </th>
                                        <th>
                                            ABREVIATURA
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
        <!----------------------------------------End Panel ESTADO PACIENTE---------------------------------------->
        <!---------------------------------------- begin panel OFICINA ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Oficina
                <small>Aqui puedo agregar la oficina</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">OFICINA</h1>
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
                        <input id="idofic" hidden/>
                        <div class="col-xl-9">
                            <label for="nomofic">NOMBRE OFICINA
                                <req>*</req>
                            </label>
                            <input id="nomofic" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valnomofic()"
                            />
                            <div class="hide" id="validarnomofic" ></div>
                        </div>
                        <div class="col-xl-3">
                            <label for="plazo">PLAZO
                                <req>*</req>
                            </label>
                            <select class="form-control" id="plazo"></select>
                            <div class="hide" id="validarplazo" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngofic" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarofic" class="btn btn-success" title="Haga clic para agregar Oficina"
                                    onclick="enviarOfic()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneofic" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviaroficEdit" class="btn btn-success" title="Haga clic para editar Oficina"
                                    onclick="enviarOficEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarofic" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarOfic()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_Oficina"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            NOMBRE OFIC.
                                        </th>
                                        <th>
                                            PLAZO
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <!--<th>
                                            USUARIO
                                        </th>-->
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
        <!----------------------------------------End Panel OFICINA---------------------------------------->
        <!---------------------------------------- begin panel ENTIDAD ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Entidad
                <small>Aqui puedo agregar otras entidades</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">ENTIDAD</h1>
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
                        <input id="identi" hidden/>
                        <div class="col-xl-12">
                            <label for="nomenti">NOMBRE ENTIDAD
                                <req>*</req>
                            </label>
                            <input id="nomenti" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valnomenti()"
                            />
                            <div class="hide" id="validnomenti" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngenti" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarenti" class="btn btn-success" title="Haga clic para agregar Entidad"
                                    onclick="enviarEnti()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btneenti" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarentiedit" class="btn btn-success" title="Haga clic para editar Entidad"
                                    onclick="enviarEntiEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarenti" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarEnti()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_entidad"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            NOMBRE ENTIDAD
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <!--<th>
                                            USUARIO
                                        </th>-->
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
        <!----------------------------------------End Panel ENTIDAD---------------------------------------->

        <!---------------------------------------- begin panel TIPO DE DOCUMENTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Tipo de Documento
                <small>Aqui puedo agregar los tipos de documentos</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO DOCUMENTO</h1>
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
                        <input id="idtipd" hidden/>
                        <div class="col-xl-12">
                            <label for="desctipd">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input id="desctipd" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valdesctipdoc()"
                            />
                            <div class="hide" id="valdesctipd" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngtipd" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartipdoc" class="btn btn-success" title="Haga clic para agregar Entidad"
                                    onclick="enviarTipDoc()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnetipd" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviartipdocedit" class="btn btn-success" title="Haga clic para editar Tipo Documento"
                                    onclick="enviarTipDocEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartipdoc" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarTipDoc()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_TipDoc"
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
                                        <!--<th>
                                            USUARIO
                                        </th>-->
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
        <!----------------------------------------End Panel TIPO DE DOCUMENTO---------------------------------------->
        <!---------------------------------------- begin panel TIPO DE GASTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Tipo de Gasto
                <small>Aqui puedo agregar los tipos de gastos</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO GASTO</h1>
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
                        <input id="idtipg" hidden/>
                        <div class="col-xl-12">
                            <label for="desctipg">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input id="desctipg" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valdesctipgas()"
                            />
                            <div class="hide" id="valdesctipg" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngtipg" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartipgas" class="btn btn-success" title="Haga clic para agregar Tipo Gasto"
                                    onclick="enviarTipGas()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnetipg" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviartipgasedit" class="btn btn-success" title="Haga clic para editar Tipo Gasto"
                                    onclick="enviarTipGasEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartipgas" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarTipGas()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_TipGas"
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
                                        <!--<th>
                                            USUARIO
                                        </th>-->
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
        <!----------------------------------------End Panel TIPO DE GASTO---------------------------------------->
        <!---------------------------------------- begin panel GASTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">Gasto
                <small>Aqui puedo agregar los gastos</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">GASTO</h1>
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
                        <input id="idgast" hidden/>
                        <div class="col-xl-12">
                            <label for="descgast">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input id="descgast" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valdescgast()"
                            />
                            <div class="hide" id="valdescgast" ></div>
                        </div>
                        <div class="col-xl-9">
                            <label for="tipgas">TIPO DE GASTO
                                <req>*</req>
                            </label>
                            <select id="tipgas" class="form-control form-control-sm"></select>
                            <div class="hide" id="valtipgas" ></div>
                        </div>
                        <div class="col-xl-3">
                            <label for="cosdia">COSTO POR DIA
                            </label>
                            <input class="form-control form-control-sm"type="number" id="cosdia" onkeypress="return filterFloat(event,this);"/>
                            <div class="hide" id="valcosdia" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btnggas" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviargas" class="btn btn-success" title="Haga clic para agregar Gasto"
                                    onclick="enviarGas()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnegas" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviargasedit" class="btn btn-success" title="Haga clic para editar Gasto"
                                    onclick="enviarGasEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelargas" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarGas()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_Gasto"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION
                                        </th>
                                        <th>
                                            TIPO GASTO
                                        </th>
                                        <th>
                                            COSTO DIA
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <!--<th>
                                            USUARIO
                                        </th>-->
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
        <!----------------------------------------End Panel GASTO---------------------------------------->

        <!---------------------------------------- begin panel CIE10 ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">CIE10
                <small>Aqui puedo agregar los Cie10</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">CIE10</h1>
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
                        <input id="idcie" hidden/>
                        <div class="col-xl-12">
                            <label for="codcie">CODIGO
                                <req>*</req>
                            </label>
                            <input class="form-control form-control-sm"type="text" id="codcie">
                            <div class="hide" id="valcodcie" ></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="desccie">DESCRIPCION
                                <req>*</req>
                            </label>
                            <input id="desccie" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valdesccie()"
                            />
                            <div class="hide" id="valdesccie" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngcie" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarcie" class="btn btn-success" title="Haga clic para agregar Cie10"
                                    onclick="enviarCie()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnecie" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarcieedit" class="btn btn-success" title="Haga clic para editar Cie10"
                                    onclick="enviarCieEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarcie" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarCie()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_cie10"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO
                                        </th>
                                        <th>
                                            DESCRIPCION
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <!--<th>
                                            USUARIO
                                        </th>-->
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
        <!----------------------------------------End Panel CIE10---------------------------------------->
        <!---------------------------------------- begin panel TIPO DOCUMENTO GASTO ------------------------------------->
        <div class="col-xl-6">
            <h1 class="page-header">TIPO DOCUMENTO GASTO
                <small>Aqui puedo agregar el tipo documento gasto</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO DOCUMENTO GASTO</h1>
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
                        <input id="idtipdg" hidden/>
                        <div class="col-xl-12">
                            <label for="tipdoc">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select id="tipdoc" class="form-control form-control-sm"></select>
                            <div class="hide" id="valtipdoc" ></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="gasto">GASTO
                                <req>*</req>
                            </label>
                            <select id="gasto" class="form-control form-control-sm"></select>
                            <div class="hide" id="valgasto" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngtipdg" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartipdg" class="btn btn-success" title="Haga clic para agregar Tipo Documento Gasto"
                                    onclick="enviarTipDG()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnetipdg" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviartipdgedit" class="btn btn-success" title="Haga clic para editar ipo Documento Gasto"
                                    onclick="enviarTipDGEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartipdg" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelarTipDG()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_tipdg"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            TIPO DOCUMENTO
                                        </th>
                                        <th>
                                            GASTO
                                        </th>
                                        <th>
                                            FECHA CREACION
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
        <!----------------------------------------End Panel TIPO DOCUMENTO GASTO---------------------------------------->
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
            $.getScript('../js/intranet/referencias/datosgeneralesref.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
