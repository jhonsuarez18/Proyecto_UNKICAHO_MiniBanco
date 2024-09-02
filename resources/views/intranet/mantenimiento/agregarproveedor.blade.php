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
    <input id="idvi" value="{{$vi}}" hidden>
    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">PROVEEDOR</h1>
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
                <button id="addproveedor" class="btn btn-success " title="click para agregar proveedor"
                        data-toggle="modal" data-target="#modal_dialog_add_proveedor">
                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar proveedor
                </button>
            </div>


        </div>


        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-dialog_add_proveedor">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">AGREGAR PROVEEDOR</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS PROVEEDOR

                            </legend>
                            <hr>
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <input type="text" value="3" id="tipdoc"hidden/>
                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <div class="form-group-lg">
                                        <label for="ruc">RUC
                                            <req>*</req>

                                        </label>
                                        <input id="ruc" type="number" class="form-control form-control-sm" autocomplete="off"
                                               onchange="valRuc()" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        />
                                        <div class="hide " id="valruc"></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <div class="form-group-lg">
                                        <label for="razons">RAZON SOCIAL
                                            <req>*</req>
                                        </label>
                                        <input id="razons" type="text" class="form-control form-control-sm" autocomplete="off"
                                               disabled onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        />
                                        <div class="hide " id="valrazons"></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <div class="form-group-lg">
                                        <label for="telefono">TELEFONO
                                            <req>*</req>

                                        </label>
                                        <input id="telefono" type="number" class="form-control form-control-sm" autocomplete="off"
                                               onchange="validCelular('telefono','validtelefono','enviar')"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        />
                                        <div class="hide " id="valtelefono"></div>
                                    </div>
                                </div>
                            </div>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION

                                </legend>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="deparpro">DEPARTAMENTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="deparpro">
                                            <option selected>AMAZONAS</option>
                                        </select>
                                        <div class="hide " id="valdeparpro"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="provpro">PROVINCIA
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="provpro" disabled>
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="valprovpro"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="dispro">DISTRITO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="dispro" disabled>
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="valdispro"></div>
                                    </div>
                                    <div class="col-xl-8 col-sm-8 col-xs-8">
                                        <label for="direccion">DIRECCION
                                        </label>
                                        <input id="direccion" type="text" class="form-control form-control-sm"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        <div id="valdireccion"></div>
                                    </div>
                                </div>

                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enviarprov" class="btn btn-success " title="click para agregar proveedor
                    " onclick="enviarProv()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-sm-12 col-xs-12  ">
            <div id="data-table-fixed-header_wrapper"
                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="tabla_proveedor"
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
                                    RUC
                                </th>
                                <th>
                                    RAZON SOCIAL
                                </th>
                                <th>
                                    TELEFONO
                                </th>
                                <th>
                                    DIRECCION
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
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-dialog-edit_proveedor">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR PROVEEDOR</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS PROVEEDOR

                            </legend>
                            <hr>
                            <input id="idproveedor" hidden>
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <div class="form-group-lg">
                                        <label for="rucedit">RUC
                                            <req>*</req>

                                        </label>
                                        <input id="rucedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onchange="valNumMeta()" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        />
                                        <div class="hide " id="valrucedit"></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <div class="form-group-lg">
                                        <label for="razonsedit">RAZON SOCIAL
                                            <req>*</req>
                                        </label>
                                        <input id="razonsedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onchange="valNumMeta()" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        />
                                        <div class="hide " id="valrazonsedit"></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <div class="form-group-lg">
                                        <label for="telefonoedit">TELEFONO
                                            <req>*</req>

                                        </label>
                                        <input id="telefonoedit" type="text" class="form-control form-control-sm" autocomplete="off"
                                               onchange="valNumMeta()" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        />
                                        <div class="hide " id="valtelefonoedit"></div>
                                    </div>
                                </div>
                            </div>
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION

                                </legend>
                                <hr>
                                <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="deparproedit">DEPARTAMENTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="deparproedit">
                                            <option selected>AMAZONAS</option>
                                        </select>
                                        <div class="hide " id="valdeparproedit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="provproedit">PROVINCIA
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="provproedit" disabled>
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="valprovproedit"></div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 col-xs-4">
                                        <label for="disproedit">DISTRITO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="disproedit" disabled>
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="valdisproedit"></div>
                                    </div>
                                    <div class="col-xl-8 col-sm-8 col-xs-8">
                                        <label for="direccionedit">DIRECCION
                                        </label>
                                        <input id="direccionedit" type="text" class="form-control form-control-sm"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                        <div id="valdireccionedit"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center">
                                    <hr>
                                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                    <button id="enviarprovedit" class="btn btn-success " title="click para editar proveedor
                                " onclick="enviarProvEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                                    </button>
                                </div>
                        </div>
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
        $.when(
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/mantenimiento/agregarproveedor.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>

