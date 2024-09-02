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
        <h1 class="page-header">Material
            <small>Aqui puedo agregar material</small>
        </h1>
        <!----------------------------------- begin panel MATERIAL --------------------------------->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">MATERIAL</h1>
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
                        <input id="idmate" hidden/>
                        <div class="col-xl-4">
                            <label for="codmate">CODIGO MEDICAMENTO
                            </label>
                            <input id="codmate" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide" id="validarcodmate" ></div>
                        </div>
                        <div class="col-xl-8">
                            <label for="descmate">DESCRIPCION MATERIAL
                                <req>*</req>
                            </label>
                            <input id="descmate" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valDescMate()"/>
                            <div class="hide" id="validardescmate" ></div>
                        </div>
                        <br>
                        <div class="col-xl-4">
                            <br>
                            <label for="desctipm">TIPO DE MATERIAL
                                <req>*</req>
                            </label>
                            <select id="desctipm" class="form-control"></select>
                            <div class="hide" id="validardesctipm" ></div>
                        </div>
                        <br>
                        <div class="col-xl-4">
                            <br>
                            <label for="descconc">CONCENTRACION
                            </label>
                            <input id="descconc" type="text" class="form-control"/>
                        </div>
                        <br>
                        <div class="col-xl-4">
                            <br>
                            <label for="descpres">PRESENTACION
                            </label>
                            <input id="descpres" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngmate" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviarmate" class="btn btn-success" title="Haga clic para agregar Material"
                                    onclick="enviarMate()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnemate" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarmateEdit" class="btn btn-success" title="Haga clic para editar Material"
                                    onclick="enviarMateEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelarmate" class="btn btn-danger" title="Haga clic cancelar"
                                    onclick="cancelarMate()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_Material"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            CODIGO
                                        </th>
                                        <th>
                                            DESCRIPCION MATERIAL
                                        </th>
                                        <th>
                                            TIPO MAT.
                                        </th>
                                        <th>
                                            CONCENTRACION
                                        </th>
                                        <th>
                                            PRESENTACION
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
        <!--------------------------------------End Panel MATERIAL----------------------------------->
        <!---------------------------------------- begin panel TIPO DE MATERIAL ------------------------------------->
        <div class="col-xl-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">TIPO DE MATERIAL</h1>
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
                        <input id="idtipm" hidden/>
                        <div class="col-xl-12">
                            <label for="desctipom">DESCRIPCION TIPO MATERIAL
                                <req>*</req>
                            </label>
                            <input id="desctipom" type="text" class="form-control"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                   onchange="valTipMaterial()"/>
                            <div class="hide" id="validartipom" ></div>
                        </div>
                        <br>

                    </div>
                    <hr>
                    <div id="btngtm" class="container">
                        <div class="col-xl-12 text-center">
                            <button id="enviartipom" class="btn btn-success" title="Haga clic para agregar tipo de Material"
                                    onclick="enviarTipm()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar

                            </button>
                        </div>
                    </div>
                    <div id="btnetm" class="container" hidden>
                        <div class="col-xl-12 text-center">
                            <button id="enviarTipmEdit" class="btn btn-success" title="Haga clic para editar Tipo de Material"
                                    onclick="enviarTipMEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>editar

                            </button>
                            <button id="cancelartipm" class="btn btn-danger" title="Haga clic para cancelar"
                                    onclick="cancelartipm()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Cancelar

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
                                <table id="tabla_tipom"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            DESCRIPCION TIPO MATERIAL
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
        <!----------------------------------------End Panel TIPO DE MATERIAL---------------------------------------->

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
            $.getScript('../js/intranet/almacen/datosgenerales.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
