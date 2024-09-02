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

            <h1 class="panel-title">VEHICULOS</h1>
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
                <button id="addve" class="btn btn-success " title="click para agregar referencias"
                >
                    <i class="fas fa-lg fa-fw m-r-10 fa-car "></i>Agregar vehiculo
                </button>
            </div>
            <hr>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_vehiculos"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <tbody>
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th class="text-center">PLACA</th>
                                    <th class="text-center">MARCA</th>
                                    <th class="text-center">MODELO</th>
                                    <th class="text-center">VERSION</th>
                                    <th class="text-center">USO</th>
                                    <th class="text-center">CC</th>
                                    <th class="text-center">ARO</th>
                                    <th class="text-center">AÑO</th>
                                    <th class="text-center"> K/G</th>
                                    <th class="text-center">IPRESS/ENTIDAD</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center"> OPCIONES</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_add_veh">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="m-b-15">AGREGAR VEHICULO (
                                <req>*</req>
                                <small>Obligatorio</small>)
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">
                                    DATOS VEHICULO
                                </legend>
                                <input id="pid" hidden>

                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="placva">PLACA
                                        <req>*</req>
                                    </label>
                                    <input type="text" onchange="valPlaca()" class="form-control form-control-sm" id="placva"
                                           autocomplete="off">
                                    <div class="hide " id="valplacva"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="marcva">MARCA
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="marcva">

                                    </select>
                                    <div class="hide" id="validmarcv"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="smarcva">MODELO
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="smarcva" DISABLED>
                                        <option value="0" selected="">SELECCIONE</option>
                                        '
                                    </select>
                                    <div class="hide" id="validsmarcva"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="modva">VERSION
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="modva" DISABLED>
                                        <option value="0" selected="">SELECCIONE</option>
                                        '
                                    </select>
                                    <div class="hide" id="validmodva"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="tipva">TIPO VEH
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="tipva" DISABLED>
                                        <option value="0" selected="">SELECCIONE</option>
                                        '
                                    </select>
                                    <div class="hide" id="validtipva"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="codp">COD PATR
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="codp"
                                           autocomplete="off">
                                    <div class="hide " id="valcodp"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="conka">CONSUMO /KM
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="conka"
                                           autocomplete="off">
                                    <div class="hide " id="valconka"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="nchasis">N° CHASIS
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nchasis"
                                           autocomplete="off">
                                    <div class="hide " id="valnchasis"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="nmotor">N° MOTOR
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nmotor"
                                           autocomplete="off">
                                    <div class="hide " id="valnmotor"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="color">COLOR
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="color"
                                           autocomplete="off">
                                    <div class="hide " id="valcolor"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="anfab">AÑO FAB
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="anfab"
                                           autocomplete="off">
                                    <div class="hide " id="valanfab"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="nrar">n° ARO
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nrar"
                                           autocomplete="off">
                                    <div class="hide " id="valnrar"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-12 container">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">
                                    OFICINA
                                </legend>
                                <div class="row">
                                    <div class="col-xl-4" id="nueperm">
                                    </div>
                                    <input id="idoficent" hidden/>
                                    <div class="col-xl-8">
                                        <label for="descent">ENTIDAD
                                            <req>*</req>
                                        </label>
                                        <input id="descent" type="text" class="form-control typeahead" disabled
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"
                                               autocomplete="off"
                                        />
                                        <div class="hide" id="validardescent"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-12 text-center">
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="envv" class="btn btn-success " title="click para guardar entrega">
                                    <i
                                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_ed_veh">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="m-b-15">EDITAR VEHICULO (
                                <req>*</req>
                                <small>Obligatorio</small>)
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">
                                    DATOS VEHICULO
                                </legend>
                                <input id="pid" hidden>
                                <input id="veid"  hidden>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="placve">PLACA
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="placve"
                                           autocomplete="off">
                                    <div class="hide " id="valplacve"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="marcve">MARCA
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="marcve">

                                    </select>
                                    <div class="hide" id="validmarcve"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="smarcve">SUBMARCA
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="smarcve" >
                                        <option value="0" selected="">SELECCIONE</option>
                                        '
                                    </select>
                                    <div class="hide" id="validsmarcve"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="modve">MODELO
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="modve" >
                                        <option value="0" selected="">SELECCIONE</option>
                                        '
                                    </select>
                                    <div class="hide" id="validmodve"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="tipve">TIPO VEH
                                        <req>*</req>
                                    </label>
                                    <select class="form-control form-control-sm" id="tipve" >
                                        <option value="0" selected="">SELECCIONE</option>
                                        '
                                    </select>
                                    <div class="hide" id="validtipve"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="codpe">COD PATR
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="codpe"
                                           autocomplete="off">
                                    <div class="hide " id="valcodpe"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="conke">CONSUMO /KM
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="conke"
                                           autocomplete="off">
                                    <div class="hide " id="valconke"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="nchasisedit">Nª CHASIS
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nchasisedit"
                                           autocomplete="off">
                                    <div class="hide " id="valnchasisedit"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="nmotoredit">Nª MOTOR
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nmotoredit"
                                           autocomplete="off">
                                    <div class="hide " id="valnmotoredit"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="coloredit">COLOR
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="coloredit"
                                           autocomplete="off">
                                    <div class="hide " id="valcoloredit"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="anfabed">AÑO FAB
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="anfabed"
                                           autocomplete="off">
                                    <div class="hide " id="valanfabe"></div>
                                </div>
                                <div class="col-xl-2 col-sm-2 col-xs-2">
                                    <label for="nrared">n° ARO
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nrared"
                                           autocomplete="off">
                                    <div class="hide " id="valnrared"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-12 container">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">
                                    OFICINA
                                </legend>
                                <div class="row">
                                    <div class="col-xl-4" id="nueperme">
                                    </div>
                                    <input id="idoficente" hidden/>
                                    <div class="col-xl-8">
                                        <label for="descente">ENTIDAD
                                            <req>*</req>
                                        </label>
                                        <input id="descente" type="text" class="form-control typeahead"
                                               onkeyup="javascript:this.value=this.value.toUpperCase();"
                                               autocomplete="off"
                                        />
                                        <div class="hide" id="validardescente"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-12 text-center">
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="envve" class="btn btn-success " title="click para editar vehiculo">
                                    <i
                                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>

                            </div>
                        </div>
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
            $.getScript('../js/intranet/combustible/vehiculo.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
