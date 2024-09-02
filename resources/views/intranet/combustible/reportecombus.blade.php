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
            <h1 class="panel-title">REPORTE COMBUSTIBLE</h1>
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
                <label for="report"> RESUMEN DE VALES
                </label>
                <select class="form-control form-control-sm" id="report" name="">
                    <option selected value="1">GENERAL</option>
                </select>
            </div>
            <br>
            <div id="reporte">
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="text-center col-sm-12"><b><u><h3>RESUMEN GENERAL VALES
                                            <a href="/excel/obtenerresumenvales" class="btn btn-green   btn-sm"
                                               title="Click para imprimir resumen general vales">
                                                <i class="fa fa-file-excel">
                                                </i>
                                            </a>
                                        </h3></u></b>
                            </div>

                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_resu_vales"
                                       class="table table-striped  table-bordered dataTable  dtr-inline "
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nº</th>
                                        <th class="text-center">O/C</th>
                                        <th class="text-center">PROGRAMA</th>
                                        <th class="text-center">META</th>
                                        <th class="text-center">FACT</th>
                                        <th class="text-center">GRIFO</th>
                                        <th class="text-center">PLACA</th>
                                        <th class="text-center">CONDUCTOR</th>
                                        <th class="text-center">ITEM</th>
                                        <th class="text-center">FECHA</th>
                                        <th class="text-center">GALONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="10" class="text-right"><strong>TOTAL</strong></th>
                                        <th colspan="1" class="text-left"></th>
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
<script src="{{asset('assets/js/apps.js')}}"></script>
<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../js/intranet/combustible/reportecombus.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

    $(function () {
        $('#tabla_resu_vales thead tr').clone(true).appendTo('#tabla_resu_vales thead');
        $('#tabla_resu_vales thead tr:eq(1) th').each(function (i) {

            if (i === 0 || i === 1 || i === 2 || i === 3) {
                $(this).html('<input  type="text" placeholder=" " />');
            }
            else
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

        var table = $('#tabla_resu_vales').DataTable({

                ajax: '/combustible/reportegenval',
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                processing: true,
                serverSide: true,
                ordering: false,
                select: true,
                destroy: true,
                responsive: true,
                bAutoWidth: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel'
                ],
            footerCallback: function (row, data, start, end, display) {
                var montoini = 0;

                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    montoini += parseFloat(data[i]['cCantGal']);
                }
                montoini = formatter.format(montoini);
                $(this.api().column(10).footer()).html(montoini);
            },
                columnDefs: [
                    {"targets": 0, "width": "5%", "className": "text-left"},
                    {"targets": 1, "width": "5%", "className": "text-center"},
                    {"targets": 2, "width": "5%", "className": "text-center"},
                    {"targets": 3, "width": "5%", "className": "text-center"},
                    {"targets": 4, "width": "5%", "className": "text-center"},
                    {"targets": 5, "width": "20%", "className": "text-left"},
                    {"targets": 6, "width": "2%", "className": "text-center"},
                    {"targets": 7, "width": "20%", "className": "text-left"},
                    {"targets": 8, "width": "2%", "className": "text-center"},
                    {"targets": 9, "width": "20%", "className": "text-center"},
                    {"targets": 10, "width": "2%", "className": "text-center"},
                ],
                columns: [
                    {data: 'codcons', name: 'codcons'},
                    {data: 'oNumOC', name: 'oNumOC'},
                    {data: 'pPDesc', name: 'pPDesc'},
                    {data: 'mCod', name: 'mCod'},
                    {data: 'oCNumFact', name: 'oCNumFact'},
                    {data: 'gDesc', name: 'gDesc'},
                    {data: 'vPlaca', name: 'vPlaca'},
                    {data: 'chofer', name: 'chofer'},
                    {data: 'tCDesc', name: 'tCDesc'},
                    {data: 'cFecEnt', name: 'cFecEnt'},
                    {data: 'cCantGal', name: 'cCantGal'},

                ]
            }
        );

    });
</script>
