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
            <h1 class="panel-title">ASIGNAR USUARIO </h1>
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
                <button id="addEncarg" class="btn btn-success " onclick="nuevoEncargado()"
                        title="click para agregar un nuevo encargado en el local"
                        data-toggle="modal" data-target="#nuevo_modal_encargado">
                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Encargado
                </button>
            </div>

            <br>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_encargado"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <thead>
                                <tr role="row">
                                    <th>
                                        LOCAL
                                    </th>
                                    <th>
                                        CODIGO EJECUTORA
                                    </th>
                                    <th>
                                        EJECUTORA
                                    </th>

                                    <th>
                                        DNI ENCARGADO
                                    </th>
                                    <th>
                                        ENCARGADO
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
</div>
<!------------------------------------------------INICIO DE MODAL AGREGAR ENCARGADO----------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="nuevo_modal_encargado">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR ENCARGADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body row">
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ENCARGADO</legend>
                    <div class="container">
                        <div class="row">
                            <input id="idencarg"hidden/>
                            <div class="col-xl-6">
                                <label for="ejecutora">EJECUTORA</label>
                                <select name="ejecutora" class="form-control form-control-sm" id="ejecutora"></select>
                                <div class="row">
                                    <input id="idlocal" hidden/>

                                    <div class="col-xl-12">
                                        <br>
                                        <label for="desclocal">lOCAL</label>
                                        <select class="form-control form-control-sm" name="" id="desclocal"
                                                name="desclocal"></select>
                                        <div class="hide" id="validarlocal"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <input id="iduser" hidden/>
                                <label for="usuario">USUARIO</label>
                                <input type="text" class="form-control form-control-sm typeahead" id="user" name="user"
                                       >
                                <div class="row">
                                    <div class="col-xl-4">
                                        <br>
                                        <label for="dni">DNI</label>
                                        <input id="dni"type="text" class="form-control form-control-sm" disabled/>
                                    </div>
                                    <div class="col-xl-8">
                                        <br>
                                        <label for="nomusu">NOMBRE DE USUARIO</label>
                                        <input id="nombcompl"type="text" class="form-control form-control-sm" disabled/>
                                        <div class="hide" id="validarusuario" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">PERMISOS</legend>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12" id="nueperm">

                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-xl-12 text-center">
                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
                        <button id="enviarencarg" class="btn btn-success " title="click para agregar encargado almacen
                    " onclick="enviarencarg()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------FIN DE MODAL DE AGREGAR ENCARGADO--------------------------------------->


<!------------------------------------------------INICIO MODAL EDITAR ENCARGADO ------------------------------------------>
<div class="col-xl-12 ">
    <div class="modal fade" id="modal-dialog_editencarg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR ENCARGADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <input id="idencargedit" type="text" class="form-control  " autocomplete="off" hidden/>
                <input id="idusuarioedit" hidden/>
                <div class="modal-body row">
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ENCARGADO</legend>
                    <div class="col-xl-6">
                        <label for="ejecutoraedit">EJECUTORA</label>
                        <select  class="form-control form-control-sm" id="ejecutoraedit"></select>
                        <div class="row">
                            <input id="idlocaledit" hidden/>
                            <div class="col-xl-12">
                                <br>
                                <label for="desclocaledit">LOCAL</label>
                                <select class="form-control form-control-sm" name="" id="desclocaledit"
                                        name="desclocal"></select>
                                <div class="hide" id="validarlocaledit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <input id="iduseredit" hidden/>
                        <label for="usuarioedit">USUARIO</label>
                        <input type="text" class="form-control form-control-sm typeahead" id="usuarioedit" name="usuarioedit"
                              >
                        <div class="row">
                            <div class="col-xl-4">
                                <br>
                                <label for="dniedit">DNI</label>
                                <input id="dniedit"type="text" class="form-control form-control-sm" disabled/>
                            </div>
                            <div class="col-xl-8">
                                <br>
                                <label for="nomusuedit">NOMBRE DE USUARIO</label>
                                <input id="nomusuedit"type="text" class="form-control form-control-sm" disabled/>
                                <div class="hide" id="validarusuarioedit" ></div>
                            </div>
                        </div>
                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">PERMISOS</legend>
                    <div class="container">
                        <div class="row">
                            <div class="col-12" id="nuepermedit">

                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="col-xl-12 text-center">
                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                    <button id="enviareditencarg" class="btn btn-success " title="click para editar pedido
                    " onclick="enviarEditEncarg()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
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
            $.getScript('../js/intranet/almacen/asignarusuario.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });
</script>
