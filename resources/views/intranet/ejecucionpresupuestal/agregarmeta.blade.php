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

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">META</h1>
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
                <button id="addmeta" class="btn btn-success " title="click para agregar material o insumo"
                        data-toggle="modal" data-target="#modal_dialog_add_stock">
                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar meta
                </button>
            </div>


        </div>


        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-dialog_add_meta">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">AGREGAR META</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">

                                <div class="col-xl-4 ">
                                    <div class="form-group">
                                        <label for="nummeta">NUMERO DE META
                                            <req>*</req>
                                        </label>
                                        <input id="nummeta" type="number" class="form-control form-control-sm" autocomplete="off"
                                               onchange="valNumMeta()"
                                        />
                                        <div class="hide " id="validnummeta"></div>
                                    </div>
                                </div>

                                <div class="col-xl-8 ">
                                    <div class="form-group">
                                        <label for="propre"> PROGRAMA PRESPUESTAL
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="propre">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validpropre"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <input id="idfin" hidden />
                                <div class="col-xl-4 ">
                                    <div class="form-group">
                                        <label for="act">ACTIVIDAD</label>
                                        <textarea class="form-control typeahead" rows="3" id="act"
                                                  name="act"> </textarea>
                                        <div class="hide " id="validact"></div>
                                    </div>
                                </div>

                                <div class="col-xl-4 ">
                                    <div class="form-group">
                                        <label for="pro">PRODUCTO</label>
                                        <textarea class="form-control typeahead" rows="3" id="pro" name="pro"
                                                  disabled> </textarea>
                                    </div>
                                </div>
                                <div class="col-xl-4 ">
                                    <div class="form-group">
                                        <label for="fin">FINALIDAD</label>
                                        <textarea class="form-control typeahead" rows="3" id="fin" name="fin"
                                                  disabled> </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 ">
                                <div class="form-group">
                                    <label for="espgas"> ESPECIFICA DE GASTO
                                        <req>*</req>
                                    </label>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm" id="espgas">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <span class="input-group-append">
											<!--<a href="" onclick="" class="input-group-text" style="text-decoration:none"
                                               title="Agregar especifica de gasto" id="addespe"><i
                                                    class="fa fa-plus"></i></a>-->
                                            <button id="addespe" class="input-group-text"
                                                    title="click para agregar especifica de gasto" style="text-decoration:none">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                    </div>
                                    <div class="hide " id="validmorbilidad"></div>
                                </div>
                            </div>

                            <div class="col-xl-12 ">
                                <div class="form-group">
                                    <label for="morbilidad">LISTA DE ESPECIFICAS DE GASTO</label>
                                    <div class="input-group">
                                        <ol id="lista">
                                        </ol>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enviar" class="btn btn-success " title="click para agregar usuario
                    " onclick="enviar()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-dialog_ver_tec">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">VER TECHO PRESUPUESTAL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_tec_pre"
                                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                               role="grid"
                                               aria-describedby="data-table-fixed-header_info" width="100%">
                                            <thead>
                                            <tr role="row">

                                                <th class="text-center">
                                                    PROGRAMA PRESUPUESTAL
                                                </th>
                                                <th class="text-center">CAPITA
                                                </th>
                                                <th class="text-center">
                                                    PAG SER
                                                </th>
                                                <th class="text-center">
                                                    TRAS EMER
                                                </th>
                                                <th class="text-center">
                                                    SAL BAL
                                                </th>
                                                <th class="text-center">
                                                    TOT
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="1"><strong>TOTAL</strong></th>
                                                <th colspan="1" class="text-center"></th>
                                                <th colspan="1" class="text-center"></th>
                                                <th colspan="1" class="text-center"></th>
                                                <th colspan="1" class="text-center"></th>
                                                <th colspan="1" class="text-center"></th>

                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-xl-12 text-center">
                                        <hr>
                                        <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                                    </div>

                                </div>

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
                        <table id="tabla_meta"
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
                            </tbody>
                            <thead>
                            <tr role="row">
                                <th>
                                    META
                                </th>
                                <th>
                                    ESPECIFICAS DE GASTO
                                </th>
                                <th>
                                    PROGRAMA PRESUPUSTAL
                                </th>
                                <th>
                                    FINALIDAD
                                </th>
                                <th>
                                    ACTIVIDAD
                                </th>
                                <th>
                                    PRODUCTO
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
            <div class="modal fade" id="modal-dialog-edit_meta">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR META</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <input id="idmeta" hidden>
                            <div class="row ">
                                <div class="col-xl-4 ">
                                    <label for="ednummeta">NUMERO DE META
                                        <req>*</req>
                                    </label>
                                    <input id="ednummeta" type="number" class="form-control form-control-sm" autocomplete="off"
                                    />
                                    <div class="hide " id="validDni"></div>
                                </div>
                                <div class="col-xl-12 ">
                                    <label for="edpropre"> PROGRAMA PRESPUESTAL
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="edpropre">
                                        <option selected value="0">SELECCIONE</option>
                                    </select>
                                </div>
                                <input id="edidfin" hidden/>
                                <div class="col-xl-4 ">
                                    <label for="edact">ACTIVIDAD</label>
                                    <textarea class="form-control typeahead" rows="3" id="edact"
                                              name="act"> </textarea>
                                </div>
                                <div class="col-xl-4 ">
                                    <label for="edpro">PRODUCTO</label>
                                    <textarea class="form-control typeahead" rows="3" id="edpro" name="edpro"
                                              disabled> </textarea>
                                </div>
                                <div class="col-xl-4 ">
                                    <label for="edfin">FINALIDAD</label>
                                    <textarea class="form-control typeahead" rows="3" id="edfin" name="edfin"
                                              disabled> </textarea>
                                </div>

                                <div class="col-xl-8 ">
                                    <label for="edespgased"> ESPECIFICA DE GASTO
                                        <req>*</req>
                                    </label>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm" id="edespgased">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <span class="input-group-append">
											<!--<a href="#" onclick="" class="input-group-text" style="text-decoration:none"
                                               title="Agregar especifica de gasto" id="edaddespeed"><i
                                                    class="fa fa-plus"></i></a>-->
                                            <button id="edaddespeed" class="input-group-text"
                                                    title="click para agregar especifica de gasto" style="text-decoration:none">
                                            <i class="fa fa-plus"></i>
                                    </span>
                                    </div>
                                </div>

                                <div class="col-xl-12 ">
                                    <label for="edlista">LISTA DE ESPECIFICAS DE GASTO</label>
                                    <div class="input-group">
                                        <ol id="edlista">
                                        </ol>

                                    </div>
                                </div>
                                <div class="col-xl-12 text-center">
                                    <hr>
                                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                    <button id="enviared" class="btn btn-success " title="click para editar meta
                                " onclick="enviarEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
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
            $.getScript('../js/intranet/presupuesto/agregarmeta.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
