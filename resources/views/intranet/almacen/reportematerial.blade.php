

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
<div id="response" >

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="col-xl-12 row" >



        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="chart-js-5">
                <div class="panel-heading">
                    <h4 class="panel-title">REPORTE DE MEDICAMENTOS Y DISPOSITIVOS MEDICOS</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="mb-0">
                        Reporte de cada medicamento vs ejecutora
                    </p>
                </div>
                <div class="panel-body p-0">
                    <div class="col-xl-12">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="tabla_reporte_tot"
                                           class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                           role="grid"
                                           aria-describedby="data-table-fixed-header_info" width="100%">
                                        <tbody>
                                        </tbody>
                                        <thead>
                                        <tr role="row">
                                            <th>
                                                MEDICAMENTO O INSUMO
                                            </th>
                                            <th>
                                                CHACHAPOYAS
                                            </th>
                                            <th>
                                                CONDORCANQUI
                                            </th>
                                            <th>
                                                BAGUA
                                            </th>
                                            <th>
                                                UCTUBAMBA
                                            </th>
                                            <th>
                                                HOSP-BAGUA
                                            </th>
                                            <th>
                                                HOSP-CHACHAPOYAS
                                            </th>
                                            <th>
                                                TOTAL REGIONAL
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
            <!-- end panel -->
        </div>
        <div class="col-xl-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="chart-js-5">
                <div class="panel-heading">
                    <h4 class="panel-title">STOCK DE MEDICAMENTO, EGRESOS VS INGRESOS</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="mb-0">
                        El grafico refleja egresos e ingresos de medicamentos por ejecutoras en el mes
                    </p>
                </div>
                <div class="panel-body row">
                    <input id="tipmed" hidden>
                    <input id="addidmed" hidden>
                    <div class="col-xl-9 col-xs-9 col-sm-9">
                        <label for="adddecm">NOMBRE MEDICAMENTO
                            <req>*</req>
                        </label>
                        <input id="adddescm" type="text" class="form-control" autocomplete="off"
                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                        <div class="hidden" id="valadddescm"></div>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="tipm">MES
                            <req>*</req>
                        </label>
                        <select class="form-control" id="tipm">
                            <option selected value="0">SELECCIONE</option>
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>

                        </select>
                        <div id="validtipodoc"></div>
                    </div>

                </div>
                <div class="panel-body p-0">
                    <div id="apex-mixed-chart1"></div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <div class="col-xl-6" hidden>
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="chart-js-5">
                <div class="panel-heading">
                    <h4 class="panel-title">Mixed Chart</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="mb-0">
                        A JavaScript Mixed Chart or a Combo Chart is a visualization that allows the combination of two
                        or more distinct graphs.
                    </p>
                </div>
                <div class="panel-body p-0">
                    <div id="apex-mixed-chart2"></div>
                </div>
            </div>
            <!-- end panel -->
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
            $.getScript('../assets/plugins/apexcharts/dist/apexcharts.min.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        ).done(function() {
            $.getScript('../js/intranet/almacen/reporte.js'),
                $.Deferred(function( deferred ){
                    $(deferred.resolve);
                })
        });
    });
</script>
