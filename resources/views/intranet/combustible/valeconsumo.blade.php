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
    <input id="idvi" value="{{$vi}}" hidden>
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">

            <h1 class="panel-title">CONTROL DE COMBUSTIBLE</h1>
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
                <button id="addva" class="btn btn-success " title="click para agregar vale de combustible"
                        data-toggle="#modal_dialog_add_va"
                >
                    <i class="fas fa-lg fa-fw m-r-10 fa-ticket-alt"></i>Generar Vale
                </button>
            </div>

            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_vale"
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
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th>N°</th>
                                    <th>O/C</th>
                                    <th>PROGRAMA</th>
                                    <th>FACT</th>
                                    <th>GRIFO</th>
                                    <th>PLACA</th>
                                    <th>CONDUCTOR</th>
                                    <th>ACTIVIDAD</th>
                                    <th>ITEM</th>
                                    <th>GALONES</th>


                                    <th>FECHA</th>
                                    <th>ESTADO</th>
                                    <th> OPCIONES</th>
                                </tr>
                                </thead>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_add_va">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="m-b-15">AGREGAR VALE(
                                <req>*</req>
                                <small>Dato obligatorio</small>)
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                DATOS META
                            </legend>
                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <input type="text" id="idcombus" hidden/>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="ordcvale">O/C
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="ordcvale">
                                    </select>
                                    <div class="hide" id="valordcvale"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="nfact">N° FACTURA
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nfact"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valnfact"></div>
                                </div>
                                <div class="col-xl-6 col-sm-6 col-xs-6">
                                    <label for="grifo">GRIFO
                                    </label>
                                    <input class="form-control form-control-sm" id="grifo" disabled>
                                    <div class="hide " id="valgrifo"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="item">ITEM
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="item">
                                        <option selected value="0">SELECCIONE</option>
                                    </select>
                                    <div class="hide" id="valitem"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="meta">META
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="meta">
                                        <option selected value="0">SELECCIONE</option>
                                    </select>
                                    <div class="hide" id="valmeta" ></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="stock">STOCK
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="stock"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valstock"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="progp">PROGRAMA
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="progp"
                                    disabled>
                                    <div class="hide" id="valprogp"></div>
                                </div>
                            </div>
                            <hr>
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                DATOS VEHICULO
                            </legend>
                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <input type="text" value="0" id="idvehi" hidden/>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="placa">N° PLACA
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="placa"
                                           onchange="valVehiPlaca()"  autocomplete="off" >
                                    <div class="hide " id="valplaca"></div>
                                </div>

                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <label for="esspert">ENTIDAD

                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="esspert"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valesspert"></div>
                                </div>

                                <div class="col-xl-6 col-sm-6 col-xs-6">
                                    <label for="det">DETALLE

                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="det"
                                           autocomplete="off" disabled>
                                </div>

                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="consum">COMSUMO/KM

                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="consum"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valconsum"></div>
                                </div>

                            </div>
                            <hr>
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                DATOS CHOFER
                            </legend>
                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <input type="text" value="0" id="idchof" hidden/>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="dnic">DNI
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="dnic"
                                           onchange="valChofDni()"   autocomplete="off">
                                    <div class="hide " id="valdnic"></div>
                                </div>

                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="nombresc">NOMBRES
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nombresc"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valnombresc"></div>
                                </div>

                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="apellidosc">APELLIDOS
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="apellidosc"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valapellidosc"></div>
                                </div>

                                <div class="col-xl-4 col-sm-4 col-xs-4">
                                    <label for="eess">ENTIDAD
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="eess"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valeess"></div>
                                </div>
                            </div>
                            <hr>
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                                DATOS VALE COMBUSTIBLE
                            </legend>
                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="dauto">DOC AUTORIZACION
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="dauto"
                                           autocomplete="off">
                                    <div class="hide " id="valdauto"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3  ">
                                    <label for="fecent">FECHA DE ENTREGA
                                        <req>*</req></label>
                                    <input type="text" class="form-control" id="fecent" autocomplete="off">
                                    <div class="hide " id="valfecent"></div>

                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="cntkm">CANT KM
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="cntkm"
                                           onchange="valCantKm()"  autocomplete="off">
                                    <div class="hide " id="valcntkm"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2" hidden>
                                    <label for="galmin">GALONES MIN
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="galmin"
                                           autocomplete="off" disabled>
                                    <div class="hide " id="valgalmin"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="cntgal">CANT GALONES
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="cntgal"
                                        onchange="validCant()"   autocomplete="off">
                                    <div class="hide " id="valcntgal"></div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="activ">ACTIVIDAD
                                        <req>*</req>
                                    </label>
                                    <textarea class="form-control typeahead" rows="1" id="activ"
                                              onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"> </textarea>
                                    <div class="hide " id="valactiv"></div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="col-xl-12 text-center">
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                            <button id="enviarvale" class="btn btn-success " title="click para guardar vale consumo">
                                <i
                                    class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                            </button>
                        </div>
                      <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 ">
        <div class="modal fade" id="modal_dialog_edit_va">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="m-b-15">EDITAR VALE(
                            <req>*</req>
                            <small>Dato obligatorio</small>)
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idvalconsedit" hidden/>
                        <input type="text" id="cantgedit" hidden/>
                        <input type="text" id="idcomedit" hidden/>
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                            DATOS META
                        </legend>
                        <div class="col-xl-12 col-sm-12 col-xs-12  row">
                            <input type="text" id="idcombusedit" hidden/>
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="ordcvaleedit">O/C
                                    <req>*</req>
                                </label>
                                <select class="form-control form-control-sm" id="ordcvaleedit">
                                </select>
                                <div class="hide" id="valordcvaleedit"></div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="nfactedit">N° FACTURA
                                </label>
                                <input type="text" class="form-control form-control-sm" id="nfactedit"
                                       autocomplete="off" disabled>
                                <div class="hide " id="valnfactedit"></div>
                            </div>
                            <div class="col-xl-6 col-sm-6 col-xs-6">
                                <label for="grifoedit">GRIFO
                                </label>
                                <input class="form-control form-control-sm" id="grifoedit" disabled>
                                <div class="hide " id="valgrifoedit"></div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="itemedit">ITEM
                                    <req>*</req>
                                </label>
                                <select class="form-control form-control-sm" id="itemedit">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide" id="valitemedit"></div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="metaedit">META
                                    <req>*</req>
                                </label>
                                <select class="form-control form-control-sm" id="metaedit">
                                    <option selected value="0">SELECCIONE</option>
                                </select>
                                <div class="hide" id="valmetaedit"></div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="stockedit">STOCK
                                </label>
                                <input type="text" class="form-control form-control-sm" id="stockedit"
                                       autocomplete="off" disabled>
                                <div class="hide " id="valstockedit"></div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="progpedit">PROGRAMA
                                </label>
                                <input type="text" class="form-control form-control-sm" id="progpedit"
                                       disabled>
                                <div class="hide" id="valprogpedit"></div>
                            </div>
                        </div>
                        <hr>
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                            DATOS VEHICULO
                        </legend>
                        <div class="col-xl-12 col-sm-12 col-xs-12  row">
                            <input type="text" value="0" id="idvehiedit" hidden/>
                            <div class="col-xl-2 col-sm-2 col-xs-2">
                                <label for="placaedit">N° PLACA
                                    <req>*</req>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="placaedit"
                                       onchange="valVehiPlacaEdit()"  autocomplete="off" >
                                <div class="hide " id="valplacaedit"></div>
                            </div>

                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="esspertedit">ENTIDAD
                                </label>
                                <input type="text" class="form-control form-control-sm" id="esspertedit"
                                       autocomplete="off" disabled>
                            </div>

                            <div class="col-xl-6 col-sm-6 col-xs-6">
                                <label for="infoedit">DETALLE
                                </label>
                                <input type="text" class="form-control form-control-sm" id="infoedit"
                                       autocomplete="off" disabled>
                            </div>

                            <div class="col-xl-2 col-sm-2 col-xs-2">
                                <label for="consumedit">COMSUMO/KM
                                </label>
                                <input type="text" class="form-control form-control-sm" id="consumedit"
                                       autocomplete="off" disabled>
                            </div>

                        </div>
                        <hr>
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                            DATOS CHOFER
                        </legend>
                        <div class="col-xl-12 col-sm-12 col-xs-12  row">
                            <input type="text" value="0" id="idchofedit" hidden/>
                            <div class="col-xl-2 col-sm-2 col-xs-2">
                                <label for="dnicedit">DNI
                                    <req>*</req>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="dnicedit"
                                       onchange="valChofDniEdit()"   autocomplete="off">
                                <div class="hide " id="valdnicedit"></div>
                            </div>

                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="nombrescedit">NOMBRES
                                </label>
                                <input type="text" class="form-control form-control-sm" id="nombrescedit"
                                       autocomplete="off" disabled>
                            </div>

                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="apellidoscedit">APELLIDOS
                                </label>
                                <input type="text" class="form-control form-control-sm" id="apellidoscedit"
                                       autocomplete="off" disabled>
                            </div>

                            <div class="col-xl-4 col-sm-4 col-xs-4">
                                <label for="eessedit">ENTIDAD
                                </label>
                                <input type="text" class="form-control form-control-sm" id="eessedit"
                                       autocomplete="off" disabled>
                            </div>

                        </div>
                        <hr>
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">
                            DATOS VALE COMBUSTIBLE
                        </legend>
                        <div class="col-xl-12 col-sm-12 col-xs-12  row">
                            <div class="col-xl-3 col-sm-3 col-xs-3">
                                <label for="dautoedit">DOC AUTORIZACION
                                    <req>*</req>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="dautoedit"
                                       autocomplete="off">
                                <div class="hide " id="valdautoedit"></div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-xs-3  ">
                                <label for="fecentedit">FECHA DE ENTREGA
                                    <req>*</req></label>
                                <input type="text" class="form-control form-control-sm" id="fecentedit" autocomplete="off">
                                <div class="hide " id="valfecentedit"></div>

                            </div>
                            <div class="col-xl-2 col-sm-2 col-xs-2">
                                <label for="cntkmedit">CANT KM
                                    <req>*</req>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="cntkmedit"
                                       onchange="valCantKmEdit()"  autocomplete="off">
                                <div class="hide " id="valcntkmedit"></div>
                            </div>
                            <div class="col-xl-2 col-sm-2 col-xs-2">
                                <label for="galminedit">GALONES MIN
                                </label>
                                <input type="text" class="form-control form-control-sm" id="galminedit"
                                       autocomplete="off" disabled>
                            </div>
                            <div class="col-xl-2 col-sm-2 col-xs-2">
                                <label for="cntgaledit">CANT GALONES
                                    <req>*</req>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="cntgaledit"
                                       onchange="validCantEdit()"   autocomplete="off">
                                <div class="hide " id="valcntgaledit"></div>
                            </div>

                            <div class="col-xl-12 col-sm-12 col-xs-12">
                                <label for="activedit">ACTIVIDAD
                                    <req>*</req>
                                </label>
                                <textarea class="form-control typeahead" rows="1" id="activedit"
                                          onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"> </textarea>
                                <div class="hide " id="valactivedit"></div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 text-center">
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviareditvale" class="btn btn-success " title="click para Editar vale consumo">
                            <i
                                class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------------------- FIN MODAL OBSERVACION------------------------------------->
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
            $.getScript('../js/intranet/combustible/valeconsumo.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
