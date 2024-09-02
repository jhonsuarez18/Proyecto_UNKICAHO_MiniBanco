<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->


<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>

<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- ================== END PAGE LEVEL STYLE ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<div id="response">
    <!-- begin row -->
    <div class="row">
        <!-- begin col-10 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">CONTROL TRABAJADORES</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i
                                class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->

                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="col-sm-12">
                        <a href="#" class="btn btn-blue btn-sm" onclick="nuevaEntregaEpp()"
                           title="click para agregar una nueva entrega de equipo de proteccion personal">
                            <i class="fa fa-plus-circle"></i> Agregar nueva entrega Epp
                        </a>
                    </div>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <legend class="m-b-15">BUSQUEDA</legend>
                        <div class="col-xl-3 ">
                            <label for="fecbusq">FECHA DE BUSQUEDA</label>
                            <input type="text" class="form-control" id="fecbusq" autocomplete="off">
                        </div>
                    </div>
                    <hr>

                    <div class="col-xl-12 text-center">
                        <a class="btn btn-success   btn-sm" title="Click para buscar"
                           id="recargarpant" onclick="buscar()">
                            <i class="fa fa-search"> Buscar
                            </i></a>
                        <a class="btn btn-success   btn-sm" title="Click para limpiar"
                           id="recargarpant" onclick="limpiar()">
                            <i class="fa fa-recycle"> Limpiar
                            </i></a>
                        <a href="#" class="btn btn-orange   btn-sm" title="Click para imprimir reporte diario"
                           onclick="imprimir()"
                        >
                            <i class="fa fa-print"> Imprimir
                            </i></a>

                    </div>
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_atencion"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <tbody>

                                    </tbody>
                                    <thead>
                                    <tr role="row">

                                        <th class="text-center">
                                            NOMBRE COMPLETO
                                        </th>
                                        <th class="text-center">
                                            DNI
                                        </th>

                                        <th class="text-center">
                                            OFICINA
                                        </th>
                                        <th class="text-center">
                                            FECHA

                                        <th class="text-center">
                                            EPP
                                        </th>
                                        <th class="text-center">
                                            ASISTENCIA
                                        </th>
                                        <th class="text-center">
                                            OPCIONES
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>

                    </div>
                    <!-- fin boton agregar -->
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->
</div>
<div class="modal fade" id="nuevaEntregaEpp">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">LISTA DE EPPS A ENTREGAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <label class="col-md-12 col-form-label">ESCOJA EPPS PARA ENTREGA</label>
            <div class="col-md-12" id="nuevepps">
            </div>
            <br>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
                <button id="enviarnuepps" class="btn btn-success " title="Click para guardar" onclick="enviar()"><i
                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ver_epp_entregado">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EppEntregado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="col-sm-12 table-responsive">
                <table id="tabla_epp"
                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                       role="grid"
                       aria-describedby="data-table-fixed-header_info" width="100%">
                    <tbody>

                    </tbody>
                    <thead>
                    <tr role="row">
                        <th>FECHA ENTREGA PLANIFICADA</th>
                        <th>ESTADO</th>
                        <th>FECHA RECIBIDA</th>
                        <th>DESCRIPCION EPP</th>
                        <th>CANTIDAD</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-success" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ATENCION SINTOMAS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input id="idpacientemodal" hidden>
                <label class="col-md-3 col-form-label">EPPS </label>
                <div class="col-md-9 row" id="epps" hidden>

                </div>
                <hr>
                <label class="col-md-3 col-form-label">SINTOMAS </label>
                <div class="col-md-12" id="sintomas">
                </div>

                <hr>
                <label class="col-md-12 col-form-label">OBERVACION </label>
                <div class="col-md-12">
                    <textarea class="form-control" rows="1" id="obs"
                              onkeyup="javascript:this.value=this.value.toUpperCase();">

                   </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
                <button id="enviar" class="btn btn-success " title="Click para guardar" onclick="enviar()"><i
                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- begin vertical-box -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>

    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/covid/seguimientocovid.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });
</script>




