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
            <h1 class="panel-title">REPORTE PRESUPUESTAL</h1>
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
                <label for="report"> RESUMEN PRESUPUESTAL
                </label>
                <select class="form-control form-control-sm" id="report" name="">
                    <option selected value="1">GENERAL</option>
                    <option value="2">POR TRANSFERENCIA</option>
                    <option value="3">POR PROGRAMA</option>
                    <option value="4">POR PROGRAMA Y RESOLUCION JEFATURIAL</option>
                    <option value="5">POR META Y ESPECIFICA DE GASTO</option>
                    <option value="6">POR ESPECIFICA DE GASTO</option>
                    <option value="7">REPORTE CEPLAN</option>
                    <option value="8">REPORTE POR TRAMA</option>
                    <option value="9">REPORTE POR PEDIDO</option>
                </select>
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
                                <table id="tabla_resu_pres"
                                       class="table table-striped  table-bordered dataTable  dtr-inline "
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">PROGRAMA PRESUPUESTAL</th>
                                        <th class="text-center">META</th>
                                        <th class="text-center">ESPECIFICA DE GASTO</th>
                                        <th class="text-center">TRAN</th>
                                        <th class="text-center">PIM</th>
                                        <th class="text-center">EJEC</th>
                                        <th class="text-center">SALDO</th>
                                        <th class="text-center">PEDI</th>
                                        <th class="text-center">CERT</th>
                                        <th class="text-center">COMP</th>
                                        <th class="text-center">DEVE</th>
                                        <th class="text-center">GIRA</th>
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
                                    <td class="text-center"></td>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right"><strong>TOTAL</strong></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
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

<div class="modal fade" id="modal-dialog_mosped">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <br>
            <div class="modal-header">
                <h4 class="modal-title">MOSTRAR PEDIDOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <br>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <br>
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabpedrep"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <tbody>
                                </tbody>
                                <thead>
                                <tr>
                                    <th class="text-center">COD PED</th>
                                    <th class="text-center">CENCOS</th>
                                    <th class="text-center">MONTO</th>
                                    <th class="text-center">FEC</th>
                                    <th class="text-center">MOTIVO</th>
                                    <th class="text-center">O/C</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">ITEMS</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right"><strong>TOTAL</strong></th>
                                    <th colspan="6" class="text-left"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

            <br>
            <div class="col-xl-12 text-center">
                <hr>
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
            </div>
            <br>
        </div>
    </div>
</div>

<!----------------------------------INICIO DE MODAL  VER ITEMS PEDIDO------------------------------------------------ -->
<div class="col-xl-12 ">
    <div class="modal fade" id="modal_dialog_ver_Items_Pedido">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">VER ITEMS </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12  ">
                        <div id="data-table-fixed-header_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 ">
                        <div class="col-xl-3">
                            <label for="numpedi">NÚMERO DE PEDIDO
                            </label>
                            <input id="numpedi" type="text" class="form-control  " autocomplete="off"
                                   disabled/>
                        </div>

                        <br>

                        <div class="col-xl-12 col-sm-12 col-xs-12  ">
                            <div id="data-table-fixed-header_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla_detalle_pedidos"
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
                                                    DESC. ITEM
                                                </th>
                                                <th>
                                                    TIPO
                                                </th>
                                                <th>
                                                    CANT.
                                                </th>
                                                <th>
                                                    PRECIO X UNID.
                                                </th>
                                                <th>
                                                    SUB TOTAL
                                                </th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-right"><strong>TOTAL</strong></th>
                                                <th colspan="1" class="text-left"></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-success" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------FIN DE MODAL VER ITEMS PEDIDO--------------------------------------->

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
            $.getScript('../js/intranet/presupuesto/reporte.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

    $(function () {
        $('#tabla_resu_pres thead tr').clone(true).appendTo('#tabla_resu_pres thead');
        $('#tabla_resu_pres thead tr:eq(1) th').each(function (i) {

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

        var table = $('#tabla_resu_pres').DataTable({

                ajax: '/presupuesto/reporteejecucion',
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
                    var ped = 0;
                    var cer = 0;
                    var comp = 0;
                    var dev = 0;
                    var gir = 0;
                    var toteje = 0;
                    var sineje = 0;
                    const formatter = new Intl.NumberFormat('es-ES', {
                        minimumFractionDigits: 2
                    });
                    for (var i = 0; i < data.length; i++) {
                        montoini += parseFloat(data[i]['mont']);
                        ped += parseFloat(data[i]['est0']);
                        cer += parseFloat(data[i]['est1']);
                        comp += parseFloat(data[i]['est2']);
                        dev += parseFloat(data[i]['est3']);
                        gir += parseFloat(data[i]['est4']);
                        toteje += parseFloat(data[i]['totejec']);
                        sineje += parseFloat(data[i]['sobr']);
                    }
                    montoini = formatter.format(montoini);
                    ped = formatter.format(ped);
                    cer = formatter.format(cer);
                    comp = formatter.format(comp);
                    dev = formatter.format(dev);
                    gir = formatter.format(gir);
                    toteje = formatter.format(toteje);
                    sineje = formatter.format(sineje);
                    $(this.api().column(4).footer()).html(montoini);
                    $(this.api().column(5).footer()).html(toteje);
                    $(this.api().column(6).footer()).html(sineje);
                    $(this.api().column(7).footer()).html(ped);
                    $(this.api().column(8).footer()).html(cer);
                    $(this.api().column(9).footer()).html(comp);
                    $(this.api().column(10).footer()).html(dev);
                    $(this.api().column(11).footer()).html(gir);
                },
                columnDefs: [
                    {"targets": 0, "width": "50%", "className": "text-left"},
                    {"targets": 1, "width": "2%", "className": "text-center"},
                    {"targets": 3, "width": "2%", "className": "text-center"},
                    {"targets": 4, "width": "2%", "className": "text-center"},
                    {"targets": 5, "width": "2%", "className": "text-center"},
                    {"targets": 6, "width": "2%", "className": "text-center"},
                    {"targets": 7, "width": "2%", "className": "text-center"},
                    {"targets": 8, "width": "2%", "className": "text-center"},
                    {"targets": 9, "width": "2%", "className": "text-center"},
                    {"targets": 10, "width": "2%", "className": "text-center"},
                ],
                columns: [
                    {data: 'pPDesc', name: 'pPDesc'},
                    {data: 'mCod', name: 'mCod'},
                    {data: 'eGDesc', name: 'eGDesc'},
                    {data: 'trNumRj', name: 'trNumRj'},
                    {data: 'mont', name: 'mont'},
                    {
                        "data": "totejec", "name": "totejec",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",9)'>" + oData.totejec + "</a>");
                        }
                    },
                    {
                        data: 'sobr',
                        render: $.fn.dataTable.render.number('.', ',', 2)
                    },

                    {
                        "data": "est0", "name": "est0",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",0)'>" + oData.est0 + "</a>");
                        }
                    },
                    {
                        "data": "est1", "name": "est1",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",1)'>" + oData.est1 + "</a>");
                        }
                    },
                    {
                        "data": "est2", "name": "est2",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",2)'>" + oData.est2 + "</a>");
                        }
                    },
                    {
                        "data": "est3", "name": "est3",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",3)'>" + oData.est3 + "</a>");
                        }
                    },
                    {
                        "data": "est4", "name": "est4",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",4)'>" + oData.est4 + "</a>");
                        }
                    }

                ]
            }
        );

    });
</script>
