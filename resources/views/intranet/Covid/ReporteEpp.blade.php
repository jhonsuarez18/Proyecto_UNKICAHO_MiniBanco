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

<div id="response">

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">REPORTE ENTREGA EPPS</h1>
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
            <div class="col-xl-4 col-sm-4 col-xs-4 row ">
                <label for="report"> FILTROS
                </label>
                <select class="form-control form-control-sm" id="report" name="">
                    <option selected value="1">GENERAL</option>
                    <option value="2">POR FECHA ENTREGA</option>
                </select>
            </div>
            <br>
            <div class="col-xl-8 col-sm-8 col-xs-8 row " id="panelfech" hidden>
                <div class="col-xl-4 col-sm-4 col-xs-4">
                    <label for="report"> BURCAR MEDIANTE FECHA ENTREGA
                    </label>
                    <div class="input-group m-b-10">
                        <input id="fecentrega" type="text" class="form-control"/>
                        <div class="input-group-prepend">
                            <a class="btn btn-success   btn-sm" title="Click para buscar" id="recargarpant" onclick="buscar()">
                                <i class="fa fa-search"> Buscar</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div id="reporte">
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="text-center col-sm-12"><b><u><h3>RESUMEN GENERAL
                                            <a href="/excel/obtenerresumenpresupuestal" class="btn btn-green   btn-sm"
                                               title="Click para imprimir resumen presupuestal">
                                                <i class="fa fa-file-excel">
                                                </i>
                                            </a></h3></u></b>
                            </div>

                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_resu_general"
                                       class="table table-striped  table-bordered dataTable  dtr-inline "
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">PACIENTE</th>
                                        <th class="text-center">FECHA ENTREGA</th>
                                        <th class="text-center">EPP</th>
                                        <th class="text-center">CANTIDAD</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right"><strong>TOTAL</strong></th>
                                        <th class="text-center"></th>
                                    </tr>
                                    </tfoot>


                                </table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/covid/ReporteEpp.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

    $(function () {
        $('#tabla_resu_general thead tr').clone(true).appendTo('#tabla_resu_general thead');
        $('#tabla_resu_general thead tr:eq(1) th').each(function (i) {
            if (i === 0 || i === 1|| i === 2) {
                $(this).html('<input  type="text" placeholder=" " />');
            } else
                $(this).html('');

            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#tabla_resu_general').DataTable({
                ajax: '/covid/getreportentreeppgeneral',
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },

                processing: true,
                serverSide: true,
                ordering: false,
                select: true,
                destroy: true,
                decimal: ",",
                thousands: ".",
                responsive: true,
                bAutoWidth: true,
                dom: 'lBfrtip',
                footerCallback: function (row, data, start, end, display) {
                    var cantidad = 0;
                    const formatter = new Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 2
                    });
                    for (var i = 0; i < data.length; i++) {
                        cantidad += parseFloat(data[i]['Cantidad']);

                    }
                    cantidad = formatter.format(cantidad);
                    $(this.api().column(3).footer()).html(cantidad);
                },
                columnDefs: [
                    {"targets": 0, "width": "5%", "className": "text-left"},
                    {"targets": 1, "width": "5%", "className": "text-center"},
                    {"targets": 2, "width": "5%", "className": "text-left"},
                    {"targets": 3, "width": "5%", "className": "text-right"},
                ],
                columns: [
                    {data: 'paciente', name: 'paciente'},
                    {data: 'fecentregar', name: 'fecentregar'},
                    {data: 'descripcion', name: 'descripcion'},
                    {data: 'Cantidad', name: 'Cantidad'},
                ]
            }
        );

    });
</script>
