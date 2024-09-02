$("#report").change(function () {
    switch (this.value) {
        case '1':
            tab_res_pres();
            break;
        case '2':
            tab_res_trans();
            break;
        case '3':
            tab_resu_propre();
            break;
        case '4':
            tab_resu_propre_rj();
            break;
        case '5':
            tab_resu_me_es();
            break;
        case '6':
            tab_resu_es();
            break;
        case '7':
            tab_res_ceplan();
            break;
        case '8':
            tab_res_trama();
            break;
        case '9':
            tab_res_pedido();
            break;


    }
});

function abrilModalVerPed(idpr, trid, est) {
    window.event.preventDefault();
    $('#modal-dialog_mosped').modal('show');
    $('#tabpedrep').DataTable({
            ajax: '/presupuesto/obtenerPedidosTrCodp/' + idpr + '/' + trid + '/' + est,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },

            processing: false,
            serverSide: false,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            searching: true,
            dom: 'lBfrtip',
            footerCallback: function (row, data, start, end, display) {
                var peMonto = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    peMonto += parseFloat(data[i]['peMonto']);
                }
                peMonto = formatter.format(peMonto);
                $(this.api().column(3).footer()).html(peMonto);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "11%", "className": "left-center"},
                {"targets": 2, "width": "11%", "className": "text-center"},
                {"targets": 3, "width": "10%", "className": "text-center"},
                {"targets": 4, "width": "40%", "className": "text-left"},
                {"targets": 5, "width": "10%", "className": "text-center"},
                {"targets": 6, "width": "10%", "className": "text-center"},
                {"targets": 7, "width": "5%", "className": "text-center"},
            ],
            columns: [
                {data: 'peCodPed', name: 'peCodPed'},
                {data: 'cCNombre', name: 'cCNombre'},
                {
                    data: 'peMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {data: 'peFecPre', name: 'peFecPre'},
                {data: 'peDesc', name: 'peDesc'},
                {
                    data: function (row) {
                        return row.peFecAcOc === null ? '<span class="text-danger">NO</span>' : '<span class="text-success">SI</span>'

                    }
                },
                {
                    data: function (row) {
                        var estp = parseInt(row.peEstPed);
                        if (estp === 0) {
                            return 'PEDIDO'
                        } else {
                            if (estp === 1) {
                                return 'CERTIFICADO'
                            } else {
                                if (estp === 2) {
                                    return 'COMPROMETIDO';
                                } else {
                                    if (estp === 3) {
                                        return 'DEVENGADO';
                                    } else {
                                        return 'GIRADO';
                                    }
                                }
                            }

                        }
                    }
                },
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="verItems(' + row.peId +','+row.peCodPed+ ')" TITLE="ver detalles" >\n' +
                            '<i class="text-purple far fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n';

                    }
                },

            ]
        }
    );

}
function verItems(id,cod) {
    window.event.preventDefault();
    $('#modal_dialog_ver_Items_Pedido').modal({show: true, backdrop: 'static', keyboard: false});
    $('#numpedi').val(("00000" + cod).slice(-5));
    DetallePedido(id);
}
function DetallePedido(idp) {
    var table = $('#tabla_detalle_pedidos').DataTable({
        ajax: '/presupuesto/getDetPedido/'+idp,
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        orderCellsTop: true,
        processing: false,
        serverSide: false,
        ordering: false,
        select: true,
        destroy: true,
        responsive: true,
        bAutoWidth: true,
        dom: 'lBfrtip',
        buttons: [
            'excel', 'pdf'
        ],
        columnDefs: [
            {"targets": 0, "width": "20%", "className": "text-left"},
            {"targets": 1, "width": "8%", "className": "text-left"},
            {"targets": 2, "width": "8%", "className": "text-right"},
            {"targets": 3, "width": "8%", "className": "text-right"},
            {"targets": 4, "width": "8%", "className": "text-right"},
        ],
        footerCallback: function (row, data, start, end, display) {
            var totalAmount = 0;
            const formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2
            });
            for (var i = 0; i < data.length; i++) {
                totalAmount += parseFloat(data[i]['VALOR_TOTAL']);
            }
            totalAmount = formatter.format(totalAmount);
            $(this.api().column(4).footer()).html(totalAmount);
        },
        columns: [

            {data: 'ITEM', name: 'ITEM'},
            {
                data: function (row) {
                    return row.TIPO_BIEN === 'B' ? '<span class="text-secondary">BIEN</span>' : '<span class="text-secondary">SERVICIO</span>'

                }
            },
            {data: 'CANT_APROBADA', name: 'CANT_APROBADA'},
            {data: 'PRECIO_UNIT', name: 'PRECIO_UNIT'},
            {data: 'VALOR_TOTAL', name: 'VALOR_TOTAL'},

        ]
    });
}
function tab_resu_propre() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '   <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                   <div id="data-table-fixed-header_wrapper"' +
        '                        class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                       <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN POR PROGRAMA' +
        '                                            <a href="/excel/obtenerReportepresupuestalprograma" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                           <div class="col-sm-12 table-responsive">' +
        '                               <table id="tabla_resu_prog"' +
        '                                      class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                      role="grid"' +
        '                                      aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                   <thead>' +
        '' +
        '                                   <tr>' +
        '                                       <th class="text-center">PROGRAMA PRESUPUESTAL</th>' +
        '                                       <th class="text-center">009-2021/SIS</th>' +
        '                                       <th class="text-center">189-2020/SIS</th>' +
        '                                       <th class="text-center">040-2017/SIS</th>' +
        '                                       <th class="text-center">003-2020/SIS</th>' +
        '                                       <th class="text-center">182-2020/SIS</th>' +
        '                                       <th class="text-center">22-2017/SIS</th>' +
        '                                       <th class="text-center">085-2020/SIS</th>' +
        '                                       <th class="text-center">27-2018/SIS</th>' +
        '<th class="text-center">107-2019/SIS</th>' +
        '                                       <th class="text-center">191-2017/SIS</th>' +
        '                                       <th class="text-center">131-2018/SIS</th>' +
        '                                       <th class="text-center">TIPO-7</th>' +
        '                                       <th class="text-center">PIA-2021</th>' +
        '                                       <th class="text-center">MODI</th>' +
        '                                       <th class="text-center">TOT RJ</th>' +
        '                                       <th class="text-center">CERTIFICADO</th>' +
        '                                       <th class="text-center">DEVENGADO</th>' +
        '                                       <th class="text-center">TOT EJE</th>' +
        '                                   </tr>' +
        '                                   </thead>' +
        '                                   <tbody>' +
        '                                   </tbody>' +
        '<tfoot>' +
        '                                   <tr>' +
        '                                       <th colspan="1"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '<th  class="text-center"></th>' +
        '<th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        ' <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        ' <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                   </tr>' +
        '                                   </tfoot>' +
        '' +
        '' +
        '                               </table>' +
        '                           </div>' +
        '' +
        '                       </div>' +
        '' +
        '                   </div>' +
        '               </div>';
    idopc.append(valhtml);
    $('#tabla_resu_prog thead tr').clone(true).appendTo('#tabla_resu_prog thead');
    $('#tabla_resu_prog thead tr:eq(1) th').each(function (i) {
        if (i === 0) {
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
    var table = $('#tabla_resu_prog').DataTable({
            ajax: '/presupuesto/obtenerreporteprograma',
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
            columnDefs: [
                {"targets": 0, "width": "50%", "className": "text-left"},
                {"targets": 1, "width": "2%", "className": "text-center"},
                {"targets": 2, "width": "2%", "className": "text-center"},
                {"targets": 3, "width": "2%", "className": "text-center"},
                {"targets": 4, "width": "2%", "className": "text-center"},
                {"targets": 5, "width": "2%", "className": "text-center"},
                {"targets": 6, "width": "2%", "className": "text-center"},
                {"targets": 7, "width": "2%", "className": "text-center"},
                {"targets": 8, "width": "2%", "className": "text-center"},
                {"targets": 9, "width": "2%", "className": "text-center"},
                {"targets": 10, "width": "2%", "className": "text-center"},
                {"targets": 11, "width": "2%", "className": "text-center"},
                {"targets": 12, "width": "2%", "className": "text-center"},
                {"targets": 13, "width": "2%", "className": "text-center"},
                {"targets": 14, "width": "2%", "className": "text-center"},
                {"targets": 15, "width": "2%", "className": "text-center"},
                {"targets": 16, "width": "2%", "className": "text-center"},
                {"targets": 17, "width": "2%", "className": "text-center"},
                {"targets": 18, "width": "2%", "className": "text-center"},
            ],
            footerCallback: function (row, data, start, end, display) {
                var t1 = 0, t2 = 0, t3 = 0, t4 = 0, t5 = 0, t6 = 0, t7 = 0, t8 = 0,
                    t9 = 0, t10 = 0, t11 = 0,t12 = 0,t13 = 0, mo = 0, totrj = 0, est1 = 0, est3 = 0, tote = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    t1 += parseFloat(data[i]['t1']);
                    t2 += parseFloat(data[i]['t2']);
                    t3 += parseFloat(data[i]['t3']);
                    t4 += parseFloat(data[i]['t4']);
                    t5 += parseFloat(data[i]['t5']);
                    t6 += parseFloat(data[i]['t6']);
                    t7 += parseFloat(data[i]['t7']);
                    t8 += parseFloat(data[i]['t8']);
                    t9 += parseFloat(data[i]['t9']);
                    t10 += parseFloat(data[i]['t10']);
                    t11 += parseFloat(data[i]['t11']);
                    t12 += parseFloat(data[i]['t12']);
                    t13 += parseFloat(data[i]['t13']);
                    totrj += parseFloat(data[i]['totrj']);
                    est1 += parseFloat(data[i]['est1']);
                    est3 += parseFloat(data[i]['est3']);
                    tote += parseFloat(data[i]['tote']);
                }
                t1 = formatter.format(t1);
                t2 = formatter.format(t2);
                t3 = formatter.format(t3);
                t4 = formatter.format(t4);
                t5 = formatter.format(t5);
                t6 = formatter.format(t6);
                t7 = formatter.format(t7);
                t8 = formatter.format(t8);
                t9 = formatter.format(t9);
                t10 = formatter.format(t10);
                t11 = formatter.format(t11);
                t12 = formatter.format(t12);
                t13 = formatter.format(t13);
                mo = formatter.format(mo);
                totrj = formatter.format(totrj);
                est1 = formatter.format(est1);
                est3 = formatter.format(est3);
                tote = formatter.format(tote);
                $(this.api().column(1).footer()).html(t1);
                $(this.api().column(2).footer()).html(t2);
                $(this.api().column(3).footer()).html(t3);
                $(this.api().column(4).footer()).html(t4);
                $(this.api().column(5).footer()).html(t5);
                $(this.api().column(6).footer()).html(t6);
                $(this.api().column(7).footer()).html(t7);
                $(this.api().column(8).footer()).html(t8);
                $(this.api().column(9).footer()).html(t9);
                $(this.api().column(10).footer()).html(t10);
                $(this.api().column(11).footer()).html(t11);
                $(this.api().column(12).footer()).html(t12);
                $(this.api().column(13).footer()).html(t13);
                $(this.api().column(14).footer()).html(mo);
                $(this.api().column(15).footer()).html(totrj);
                $(this.api().column(16).footer()).html(est1);
                $(this.api().column(17).footer()).html(est3);
                $(this.api().column(18).footer()).html(tote);
            },
            columns: [
                {data: 'pPDesc', name: 'pPDesc'},
                {
                    data: 't1',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't2',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't3',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't4',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't5',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't6',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't7',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't8',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't9',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't10',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't11',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't12',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't13',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'mo',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'totrj',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'est1',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'est3',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'tote',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
            ]
        }
    );
}

function tab_resu_propre_rj() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '   <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                   <div id="data-table-fixed-header_wrapper"' +
        '                        class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                       <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>POR PROGRAMA Y RESOLUCION JEFATURIAL' +
        '                                            <a href="/excel/obtenerreportepresupuestalprogramatransferencia" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                           <div class="col-sm-12 table-responsive">' +
        '                               <table id="tabla_resu_prog"' +
        '                                      class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                      role="grid"' +
        '                                      aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                   <thead>' +
        '                                   <tr>' +
        '                                       <th class="text-center">PROGRAMA PRESUPUESTAL</th>' +
        '                                       <th class="text-center">META</th>' +
        '                                       <th class="text-center">ESP. GASTO</th>' +
        '                                       <th class="text-center">009-2021/SIS</th>' +
        '                                       <th class="text-center">189-2020/SIS</th>' +
        '                                       <th class="text-center">040-2017/SIS</th>' +
        '                                       <th class="text-center">003-2020/SIS</th>' +
        '                                       <th class="text-center">182-2020/SIS</th>' +
        '                                       <th class="text-center">22-2017/SIS</th>' +
        '                                       <th class="text-center">085-2020/SIS</th>' +
        '                                       <th class="text-center">27-2018/SIS</th>' +
        '<th class="text-center">107-2019/SIS</th>' +
        '                                       <th class="text-center">191-2017/SIS</th>' +
        '                                       <th class="text-center">131-2018/SIS</th>' +
        '                                       <th class="text-center">TIPO-7</th>' +
        '                                       <th class="text-center">PIA-2021</th>' +
        '                                       <th class="text-center">MODI</th>' +
        '                                       <th class="text-center">TOT RJ</th>' +
        '                                       <th class="text-center">CERTIFICADO</th>' +
        '                                       <th class="text-center">DEVENGADO</th>' +
        '                                       <th class="text-center">TOT EJE</th>' +
        '                                   </tr>' +
        '                                   </thead>' +
        '                                   <tbody>' +
        '                                   </tbody>' +
        '<tfoot>' +
        '                                   <tr>' +
        '                                       <th colspan="3"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '<th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        ' <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '<th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +

        '                                   </tr>' +
        '                                   </tfoot>' +
        '' +
        '' +
        '                               </table>' +
        '                           </div>' +
        '' +
        '                       </div>' +
        '' +
        '                   </div>' +
        '               </div>';
    idopc.append(valhtml);
    $('#tabla_resu_prog thead tr').clone(true).appendTo('#tabla_resu_prog thead');
    $('#tabla_resu_prog thead tr:eq(1) th').each(function (i) {
        if (i === 0 || i === 1 || i === 2) {
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
    var table = $('#tabla_resu_prog').DataTable({
            ajax: '/presupuesto/obtenerreporteProgramatransferencia',
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
            columnDefs: [
                {"targets": 0, "width": "50%", "className": "text-left"},
                {"targets": 1, "width": "50%", "className": "text-center"},
                {"targets": 2, "width": "50%", "className": "text-left"},
                {"targets": 3, "width": "2%", "className": "text-center"},
                {"targets": 4, "width": "2%", "className": "text-center"},
                {"targets": 5, "width": "2%", "className": "text-center"},
                {"targets": 6, "width": "2%", "className": "text-center"},
                {"targets": 7, "width": "2%", "className": "text-center"},
                {"targets": 8, "width": "2%", "className": "text-center"},
                {"targets": 9, "width": "2%", "className": "text-center"},
                {"targets": 10, "width": "2%", "className": "text-center"},
                {"targets": 11, "width": "2%", "className": "text-center"},
                {"targets": 12, "width": "2%", "className": "text-center"},
                {"targets": 13, "width": "2%", "className": "text-center"},
                {"targets": 14, "width": "2%", "className": "text-center"},
                {"targets": 15, "width": "2%", "className": "text-center"},
                {"targets": 16, "width": "2%", "className": "text-center"},
                {"targets": 17, "width": "2%", "className": "text-center"},
                {"targets": 18, "width": "2%", "className": "text-center"},
                {"targets": 19, "width": "2%", "className": "text-center"},
            ],
            footerCallback: function (row, data, start, end, display) {
                var t1 = 0, t2 = 0, t3 = 0, t4 = 0, t5 = 0, t6 = 0, t7 = 0, t8 = 0,
                    t9 = 0, t10 = 0, t11 = 0,t12 = 0,t13 = 0, mo = 0, totrj = 0, est1 = 0, est3 = 0, tote = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    t1 += parseFloat(data[i]['t1']);
                    t2 += parseFloat(data[i]['t2']);
                    t3 += parseFloat(data[i]['t3']);
                    t4 += parseFloat(data[i]['t4']);
                    t5 += parseFloat(data[i]['t5']);
                    t6 += parseFloat(data[i]['t6']);
                    t7 += parseFloat(data[i]['t7']);
                    t8 += parseFloat(data[i]['t8']);
                    t9 += parseFloat(data[i]['t9']);
                    t10 += parseFloat(data[i]['t10']);
                    t11 += parseFloat(data[i]['t11']);
                    t12 += parseFloat(data[i]['t12']);
                    t13 += parseFloat(data[i]['t13']);
                    mo += parseFloat(data[i]['mo']);
                    totrj += parseFloat(data[i]['totrj']);
                    est1 += parseFloat(data[i]['est1']);
                    est3 += parseFloat(data[i]['est3']);
                    tote += parseFloat(data[i]['tote']);
                }
                t1 = formatter.format(t1);
                t2 = formatter.format(t2);
                t3 = formatter.format(t3);
                t4 = formatter.format(t4);
                t5 = formatter.format(t5);
                t6 = formatter.format(t6);
                t7 = formatter.format(t7);
                t8 = formatter.format(t8);
                t9 = formatter.format(t9);
                t10 = formatter.format(t10);
                t11 = formatter.format(t11);
                t12 = formatter.format(t12);
                t13 = formatter.format(t13);
                mo = formatter.format(mo);
                totrj = formatter.format(totrj);
                est1 = formatter.format(est1);
                est3 = formatter.format(est3);
                tote = formatter.format(tote);
                $(this.api().column(3).footer()).html(t1);
                $(this.api().column(4).footer()).html(t2);
                $(this.api().column(5).footer()).html(t3);
                $(this.api().column(6).footer()).html(t4);
                $(this.api().column(7).footer()).html(t5);
                $(this.api().column(8).footer()).html(t6);
                $(this.api().column(9).footer()).html(t7);
                $(this.api().column(10).footer()).html(t8);
                $(this.api().column(11).footer()).html(t9);
                $(this.api().column(12).footer()).html(t10);
                $(this.api().column(13).footer()).html(t11);
                $(this.api().column(14).footer()).html(t12);
                $(this.api().column(15).footer()).html(t13);
                $(this.api().column(16).footer()).html(mo);
                $(this.api().column(17).footer()).html(totrj);
                $(this.api().column(18).footer()).html(est1);
                $(this.api().column(19).footer()).html(est3);
                $(this.api().column(20).footer()).html(tote);
            },
            columns: [
                {data: 'pPDesc', name: 'pPDesc'},
                {data: 'mCod', name: 'mCod'},
                {data: 'eGCod', name: 'eGCod'},
                {
                    data: 't1',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't2',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't3',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't4',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't5',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 't6',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't7',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't8',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't9',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't10',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't11',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't12',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 't13',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'mo',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'totrj',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'est1',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'est3',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }, {
                    data: 'tote',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
            ]
        }
    );
}

function tab_resu_me_es() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = ' <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                   <div id="data-table-fixed-header_wrapper"' +
        '                        class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                       <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN PRESUPUESTAL POR META Y ESPECIFICA DE GASTO' +
        '                                            <a href="/excel/obtenerResumenporProgramaespecificaexport" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                           <div class="col-sm-12 table-responsive">' +
        '                               <table id="tabla_resu_mete"' +
        '                                      class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                      role="grid"' +
        '                                      aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                   <thead>' +
        '                                   <tr>' +
        '                                       <th class="text-center">PROGRAMA PRESUPUESTAL</th>' +
        '                                       <th class="text-center">META</th>' +
        '                                       <th class="text-center">ESPECIFICA</th>' +
        '                                       <th class="text-center">MONTO INICIAL</th>' +
        '                                       <th class="text-center">CERTIFICADO</th>' +
        '                                       <th class="text-center">DEVENGADO</th>' +
        '                                       <th class="text-center">SALDO</th>' +
        '                                   </tr>' +
        '                                   </thead>' +
        '                                   <tbody>' +
        '                                   </tbody>' +
        '                                   <tfoot>' +
        '                                   <tr>' +
        '                                       <th colspan="3"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                   </tr>' +
        '                                   </tfoot>' +
        '' +
        '' +
        '                               </table>' +
        '                           </div>' +
        '' +
        '                       </div>' +
        '' +
        '                   </div>' +
        '               </div>';
    idopc.append(valhtml);
    $('#tabla_resu_mete thead tr').clone(true).appendTo('#tabla_resu_mete thead');
    $('#tabla_resu_mete thead tr:eq(1) th').each(function (i) {
        if (i === 0 || i === 1 || i === 2) {
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

    var table = $('#tabla_resu_mete').DataTable({
            ajax: '/presupuesto/obtenerreportefinalidad',
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
                var montoini = 0;
                var cer = 0;
                var dev = 0;
                var sal = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    montoini += parseFloat(data[i]['mont']);
                    cer += parseFloat(data[i]['est1']);
                    dev += parseFloat(data[i]['est3']);
                    sal += parseFloat(data[i]['saldo']);
                }
                montoini = formatter.format(montoini);
                cer = formatter.format(cer);
                dev = formatter.format(dev);
                sal = formatter.format(sal);
                $(this.api().column(3).footer()).html(montoini);
                $(this.api().column(4).footer()).html(cer);
                $(this.api().column(5).footer()).html(dev);
                $(this.api().column(6).footer()).html(sal);
            },
            columnDefs: [
                {"targets": 0, "width": "5%", "className": "text-center"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},
                {"targets": 5, "width": "5%", "className": "text-center"},
                {"targets": 6, "width": "5%", "className": "text-center"},
            ],
            columns: [
                {data: 'pPDesc', name: 'pPDesc'},
                {data: 'mCod', name: 'mCod'},
                {data: 'eGDesc', name: 'eGDesc'},
                {
                    data: 'mont',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est1',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est3',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'saldo',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
            ]
        }
    );

}


function tab_resu_es() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = ' <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                   <div id="data-table-fixed-header_wrapper"' +
        '                        class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                       <div class="row">' +
        ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN PRESUPUESTAL ESPECIFICA DE GASTO' +
        '  <a href="/excel/obtenerResumenPorEspecGas" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen por especifica">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a>' +
        '                                            </h3></u></b>' +
        '                            </div>' +
        '                           <div class="col-sm-12 table-responsive">' +
        '                               <table id="tabla_resu_esg"' +
        '                                      class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                      role="grid"' +
        '                                      aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                   <thead>' +
        '                                   <tr>' +
        '                                       <th class="text-center">CODIGO</th>' +
        '                                       <th class="text-center">ESPECIFICA</th>' +
        '                                       <th class="text-center">MONTO</th>' +
        '                                       <th class="text-center">PORCENTAJE</th>' +
        '                                   </tr>' +
        '                                   </thead>' +
        '                                   <tbody>' +
        '                                   </tbody>' +
        '                                   <tfoot>' +
        '                                   <tr>' +
        '                                       <th colspan="2"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                   </tr>' +
        '                                   </tfoot>' +
        '' +
        '' +
        '                               </table>' +
        '                           </div>' +
        '' +
        '                       </div>' +
        '' +
        '                   </div>' +
        '               </div>';
    idopc.append(valhtml);
    $('#tabla_resu_esg thead tr').clone(true).appendTo('#tabla_resu_esg thead');
    $('#tabla_resu_esg thead tr:eq(1) th').each(function (i) {
        if (i === 0 || i === 1) {
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
    var table = $('#tabla_resu_esg').DataTable({
            ajax: '/presupuesto/reporteEjeEspecifica',
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
                var tot = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    tot += parseFloat(data[i]['tot']);
                }
                tot = formatter.format(tot);
                $(this.api().column(2).footer()).html(tot);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "50%", "className": "text-left"},
                {"targets": 2, "width": "10%", "className": "text-center"},
                {"targets": 3, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'eGCod', name: 'eGCod'},
                {data: 'eGDesc', name: 'eGDesc'},
                {
                    data: 'tot',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {data: 'por', name: 'por'},
            ]
        }
    );

}

var datos = [{
    'eGCod': '2.3.1.1.1.1',
    'eGDesc': 'ALIMENTOS Y BEBIDAS PARA CONSUMO HUMANO',
    'tot': '8276.00',
    'por': '0.23%',
}];

function tab_res_trans() {

    // e.preventDefault();
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '    <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                   <div id="data-table-fixed-header_wrapper"' +
        '                        class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                       <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>REPORTE DE PRESUPUESTO POR TRANSFERENCIA' +
        '                                            <a href="/excel/obtenerreportepresupuestaltransferencia" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                           <div class="col-sm-12 table-responsive">' +
        '                               <table id="tabla_resu_trans"' +
        '                                      class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                      role="grid"' +
        '                                      aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                   <thead>' +
        '                                   <tr>' +
        '                                       <th class="text-center">NR RJ</th>' +
        '                                       <th class="text-center">COD TRANS</th>' +
        '                                       <th class="text-center">PPTO DISP</th>' +
        '                                       <th class="text-center">INCORP</th>' +
        '                                       <th class="text-center">TRANSF</th>' +
        '                                       <th class="text-center">PIM</th>' +
        '                                       <th class="text-center">EJECU</th>' +
        '                                       <th class="text-center">SALDO</th>' +
        '                                   </tr>' +
        '                                   </thead>'+
        '                                   <tbody>' +
        '                                   </tbody>' +
        '                                   <tfoot>' +
        '                                   <tr>' +
        '                                       <th colspan="2"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                       <th  class="text-center"></th>' +
        '                                   </tr>' +
        '                                   </tfoot>' +
        '' +
        '' +
        '                               </table>' +
        '                           </div>' +
        '' +
        '                       </div>' +
        '' +
        '                   </div>' +
        '               </div>';
    idopc.append(valhtml);
    $('#tabla_resu_trans thead tr').clone(true).appendTo('#tabla_resu_trans thead');
    $('#tabla_resu_trans thead tr:eq(1) th').each(function (i) {

        if (i === 0) {
            $(this).html('<input type="text" placeholder=" " />');
        } else
            $(this).html('');
        $('input', this).on('keyup change', function () {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    var table = $('#tabla_resu_trans').DataTable({
            ajax: '/presupuesto/obtenerreportetransferencia',
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
                var trMonto = 0;
                var montin = 0;
                var montT = 0;
                var pim = 0;
                var monteje = 0;
                var sald = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    trMonto += parseFloat(data[i]['trMonto']);
                    montin += parseFloat(data[i]['montin']);
                    montT += parseFloat(data[i]['montT']);
                    monteje += parseFloat(data[i]['monteje']);
                    sald += parseFloat(data[i]['res']);
                    pim += parseFloat(data[i]['pim']);

                }
                trMonto = formatter.format(trMonto);
                montin = formatter.format(montin);
                montT = formatter.format(montT);
                monteje = formatter.format(monteje);
                sald = formatter.format(sald);
                pim = formatter.format(pim);
                $(this.api().column(2).footer()).html(trMonto);
                $(this.api().column(3).footer()).html(montin);
                $(this.api().column(4).footer()).html(montT);
                $(this.api().column(5).footer()).html(pim);
                $(this.api().column(6).footer()).html(monteje);
                $(this.api().column(7).footer()).html(sald);
            },
            columnDefs: [
                {"targets": 0, "width": "20%", "className": "text-left"},
                {"targets": 1, "width": "2%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 3, "width": "20%", "className": "text-center"},
                {"targets": 4, "width": "20%", "className": "text-center"},
                {"targets": 5, "width": "20%", "className": "text-center"},
                {"targets": 6, "width": "20%", "className": "text-center"},
                {"targets": 7, "width": "20%", "className": "text-center"},
            ],
            columns: [
                {data: 'trNumRj', name: 'trNumRj'},
                {data: 'trCodTrans', name: 'trCodTrans'},
                {
                    data: 'trMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'montin',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'montT',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'pim',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'monteje',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'res',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
            ]
        }
    );
}

function tab_res_pres() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '    <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                <div id="data-table-fixed-header_wrapper"' +
        '                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                    <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN GENERAL' +
        '                                            <a href="/excel/obtenerresumenpresupuestal" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                        <div class="col-sm-12 table-responsive">' +
        '                            <table id="tabla_resu_pres"' +
        '                                   class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                   role="grid"' +
        '                                   aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                <thead>' +
        '                                <tr>' +
        '                                    <th class="text-center">PROGRAMA PRESUPUESTAL</th>' +
        '                                    <th class="text-center">META</th>' +
        '                                    <th class="text-center">ESPECIFICA DE GASTO</th>' +
        '                                    <th class="text-center">TRAN/MODI</th>' +
        '                                    <th class="text-center">PIM</th>' +
        '                                    <th class="text-center">EJEC</th>' +
        '                                    <th class="text-center">SALDO</th>' +
        '                                    <th class="text-center">PEDI</th>' +
        '                                    <th class="text-center">CERT</th>' +
        '                                    <th class="text-center">COMP</th>' +
        '                                    <th class="text-center">DEVE</th>' +
        '                                    <th class="text-center">GIRA</th>' +
        '                                </tr>' +
        '                                </thead>' +
        '                                <tbody>' +
        '                                </tbody>' +
        '                                <tfoot>' +
        '                                <tr>' +
        '                                    <th colspan="4"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                </tr>' +
        '                                </tfoot>' +
        '' +
        '' +
        '                            </table>' +
        '                        </div>' +
        '' +
        '                    </div>' +
        '' +
        '                </div>' +
        '            </div>';
    idopc.append(valhtml);
    $('#tabla_resu_pres thead tr').clone(true).appendTo('#tabla_resu_pres thead');
    $('#tabla_resu_pres thead tr:eq(1) th').each(function (i) {

        if (i === 0 || i === 1 || i === 2 || i === 3) {
            var title = $(this).text();
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
    var table = $('#tabla_resu_pres').DataTable({
            ajax: '/presupuesto/reporteejecucion',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            orderCellsTop: true,
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: false,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            footerCallback: function (row, data, start, end, display) {
                var montoini = 0;
                var ped = 0;
                var cer = 0;
                var comp = 0;
                var dev = 0;
                var gir = 0;
                var toteje = 0;
                var sineje = 0;
                const formatter = new Intl.NumberFormat('en-US', {
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
                {"targets": 11, "width": "2%", "className": "text-center"},
            ],
            columns: [
                {data: 'pPDesc', name: 'pPDesc'},
                {data: 'mCod', name: 'mCod'},
                {data: 'eGDesc', name: 'eGDesc'},
                {data: 'trNumRj', name: 'trNumRj'},
                {
                    data: 'mont',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    "data": "totejec", "name": "totejec",
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='#'  title='Click para ver pedidos' onclick='abrilModalVerPed(" + oData.mEGId + "," + oData.trId + ",9)'>" + oData.totejec + "</a>");
                    }
                },
                {
                    data: 'sobr',
                    render: $.fn.dataTable.render.number(',', '.', 2)
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

}

function tab_res_ceplan() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '    <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                <div id="data-table-fixed-header_wrapper"' +
        '                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                    <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN CEPLAN' +
        '                                            <a href="/excel/obtenerresumenpresupuestalceplan" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                        <div class="col-sm-12 table-responsive">' +
        '                            <table id="tabla_resu_ceplan"' +
        '                                   class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                   role="grid"' +
        '                                   aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                <thead>' +
        '                                <tr>' +
        '                                    <th class="text-center">PROGRAMA PRESUPUESTAL</th>' +
        '                                    <th class="text-center">META</th>' +
        '                                    <th class="text-center">ESPECIFICA DE GASTO</th>' +
        '                                    <th class="text-center">PIM</th>' +
        '                                    <th class="text-center">EJEC</th>' +
        '                                    <th class="text-center">SALDO</th>' +
        '                                    <th class="text-center">PEDI</th>' +
        '                                    <th class="text-center">CERT</th>' +
        '                                    <th class="text-center">COMP</th>' +
        '                                    <th class="text-center">DEVE</th>' +
        '                                    <th class="text-center">GIRA</th>' +
        '                                </tr>' +
        '                                </thead>' +
        '                                <tbody>' +
        '                                </tbody>' +
        '                                <tfoot>' +
        '                                <tr>' +
        '                                    <th colspan="3"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                </tr>' +
        '                                </tfoot>' +
        '' +
        '' +
        '                            </table>' +
        '                        </div>' +
        '' +
        '                    </div>' +
        '' +
        '                </div>' +
        '            </div>';
    idopc.append(valhtml);
    $('#tabla_resu_ceplan thead tr').clone(true).appendTo('#tabla_resu_ceplan thead');
    $('#tabla_resu_ceplan thead tr:eq(1) th').each(function (i) {

        if (i === 0 || i === 1 || i === 2 || i === 3) {
            var title = $(this).text();
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
    var table = $('#tabla_resu_ceplan').DataTable({
            ajax: '/presupuesto/getReporteCeplan',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            orderCellsTop: true,
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: false,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            footerCallback: function (row, data, start, end, display) {
                var montoini = 0;
                var ped = 0;
                var cer = 0;
                var comp = 0;
                var dev = 0;
                var gir = 0;
                var toteje = 0;
                var sineje = 0;
                const formatter = new Intl.NumberFormat('en-US', {
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
                $(this.api().column(3).footer()).html(montoini);
                $(this.api().column(4).footer()).html(toteje);
                $(this.api().column(5).footer()).html(sineje);
                $(this.api().column(6).footer()).html(ped);
                $(this.api().column(7).footer()).html(cer);
                $(this.api().column(8).footer()).html(comp);
                $(this.api().column(9).footer()).html(dev);
                $(this.api().column(10).footer()).html(gir);
            },
            columnDefs: [
                {"targets": 0, "width": "50%", "className": "text-left"},
                {"targets": 1, "width": "2%", "className": "text-center"},
                {"targets": 2, "width": "2%", "className": "text-center"},
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
                {
                    data: 'mont',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'totejec',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },

                {
                    data: 'sobr',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est0',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est1',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est2',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est3',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'est4',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },

            ]
        }
    );

}

function tab_res_trama() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '    <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                <div id="data-table-fixed-header_wrapper"' +
        '                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                    <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN TRAMA' +
        '                                            <a href="/excel/obtenerresumenpresupuestaltrama" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                        <div class="col-sm-12 table-responsive">' +
        '                            <table id="tabla_resu_trama"' +
        '                                   class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                   role="grid"' +
        '                                   aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                <thead>' +
        '                                <tr>' +
        '                                    <th class="text-center">AÑO</th>' +
        '                                    <th class="text-center">PROG. PRESUPUESTAL</th>' +
        '                                    <th class="text-center">PRODUCTO</th>' +
        '                                    <th class="text-center">ACTIVIDAD</th>' +
        '                                    <th class="text-center">META</th>' +
        '                                    <th class="text-center">FINALIDAD</th>' +
        '                                    <th class="text-center">CLASIFICADOR</th>' +
        '                                    <th class="text-center">PIM</th>' +
        '                                    <th class="text-center">Nº NOTA</th>' +
        '                                </tr>' +
        '                                </thead>' +
        '                                <tbody>' +
        '                                </tbody>' +
        '                                <tfoot>' +
        '                                <tr>' +
        '                                    <th colspan="7"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                    <th  class="text-center"></th>' +
        '                                </tr>' +
        '                                </tfoot>' +
        '' +
        '' +
        '                            </table>' +
        '                        </div>' +
        '' +
        '                    </div>' +
        '' +
        '                </div>' +
        '            </div>';
    idopc.append(valhtml);
    $('#tabla_resu_trama thead tr').clone(true).appendTo('#tabla_resu_trama thead');
    $('#tabla_resu_trama thead tr:eq(1) th').each(function (i) {

        if (i === 0 || i === 1 || i == 4) {
            var title = $(this).text();
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
    var table = $('#tabla_resu_trama').DataTable({
            ajax: '/presupuesto/obtenerreporteTrama',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            orderCellsTop: true,
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: false,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            footerCallback: function (row, data, start, end, display) {
                var montoini = 0;

                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    montoini += parseFloat(data[i]['monto']);
                }
                montoini = formatter.format(montoini);
                $(this.api().column(7).footer()).html(montoini);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "2%", "className": "text-center"},
                {"targets": 2, "width": "2%", "className": "text-center"},
                {"targets": 3, "width": "2%", "className": "text-center"},
                {"targets": 4, "width": "2%", "className": "text-center"},
                {"targets": 5, "width": "2%", "className": "text-center"},
                {"targets": 6, "width": "2%", "className": "text-center"},
                {"targets": 7, "width": "2%", "className": "text-center"},
                {"targets": 8, "width": "2%", "className": "text-center"},
            ],
            columns: [
                {data: 'trFecCrea', name: 'trFecCrea'},
                {data: 'pPCod', name: 'pPCod'},
                {data: 'fCodProducto', name: 'fCodProducto'},
                {data: 'fCodActividad', name: 'fCodActividad'},
                {data: 'mCod', name: 'mCod'},
                {data: 'fCodFinalidad', name: 'fCodFinalidad'},
                {data: 'eGCod', name: 'eGCod'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {data: 'nNro', name: 'nNro'},
            ]
        }
    );

}

function tab_res_pedido() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '    <div class="col-xl-12 col-sm-12 col-xs-12  ">' +
        '                <div id="data-table-fixed-header_wrapper"' +
        '                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">' +
        '                    <div class="row">'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN POR PEDIDO' +
        '                                            <a href="/excel/obtenerresumenpresupuestalpedido" class="btn btn-green   btn-sm"' +
        '                                               title="Click para imprimir resumen presupuestal">' +
        '                                                <i class="fa fa-file-excel">' +
        '                                                </i>' +
        '                                            </a></h3></u></b>' +
        '                            </div>' +
        '                        <div class="col-sm-12 table-responsive">' +
        '                            <table id="tabla_resu_pedido"' +
        '                                   class="table table-striped  table-bordered dataTable  dtr-inline "' +
        '                                   role="grid"' +
        '                                   aria-describedby="data-table-fixed-header_info" width="100%">' +
        '                                <thead>' +
        '                                <tr>' +
        '                                    <th class="text-center">META</th>' +
        '                                    <th class="text-center">PEDIDO</th>' +
        '                                    <th class="text-center">ESPECIFICA</th>' +
        '                                    <th class="text-center">TRANS.</th>' +
        '                                    <th class="text-center">MONTO</th>' +
        '                                    <th class="text-center">FECHA</th>' +
        '                                    <th class="text-center">O/C</th>' +
        '                                    <th class="text-center">ESTADO SIGA</th>' +
        '                                    <th class="text-center">TIPO</th>' +
        '                                    <th class="text-center">ITEMS</th>' +
        '                                    <th class="text-center">ESTADO</th>' +
        '                                </tr>' +
        '                                </thead>' +
        '                                <tbody>' +
        '                                </tbody>' +
        '                                <tfoot>' +
        '                                <tr>' +
        '                                    <th colspan="4"  class="text-right"><strong>TOTAL</strong></th>' +
        '                                    <th colspan="7" class="text-left"></th>' +
        '                                </tr>' +
        '                                </tfoot>' +
        '' +
        '' +
        '                            </table>' +
        '                        </div>' +
        '' +
        '                    </div>' +
        '' +
        '                </div>' +
        '            </div>';
    idopc.append(valhtml);
    $('#tabla_resu_pedido thead tr').clone(true).appendTo('#tabla_resu_pedido thead');
    $('#tabla_resu_pedido thead tr:eq(1) th').each(function (i) {

        if (i === 0 | i === 1|i === 2|i === 3 |i === 5 |i === 7 |i === 8 ) {
            var title = $(this).text();
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
    var table = $('#tabla_resu_pedido').DataTable({
            ajax: '/presupuesto/obtenerreportePedido',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            orderCellsTop: true,
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: false,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            footerCallback: function (row, data, start, end, display) {
                var montoini = 0;

                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    montoini += parseFloat(data[i]['peMonto']);
                }
                montoini = formatter.format(montoini);
                $(this.api().column(4).footer()).html(montoini);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "2%", "className": "text-center"},
                {"targets": 2, "width": "2%", "className": "text-center"},
                {"targets": 3, "width": "2%", "className": "text-center"},
                {"targets": 4, "width": "2%", "className": "text-center"},
                {"targets": 5, "width": "2%", "className": "text-center"},
                {"targets": 6, "width": "2%", "className": "text-center"},
                {"targets": 7, "width": "2%", "className": "text-left"},
                {"targets": 8, "width": "2%", "className": "text-left"},
                {"targets": 9, "width": "2%", "className": "text-center"},
            ],
            columns: [
                {data: 'mCod', name: 'mCod'},
                {data: 'peCodPed', name: 'peCodPed'},
                {data: 'eGCod', name: 'eGCod'},
                {data: 'pre', name: 'pre'},
                {
                    data: 'peMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {data: 'peFecPre', name: 'peFecPre'},
                {
                    data: function (row) {
                        return row.peFecAcOc === null ? '<span class="text-danger">NO</span>' : '<span class="text-success">SI</span>'

                    }
                },
                {data: 'ests', name: 'ests'},
                {data: 'tdesc', name: 'tdesc'},
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="verItems(' + row.peId +','+row.peCodPed +')" TITLE="ver detalles" >\n' +
                            '<i class="text-purple far fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                            '</tr>';

                    }
                },
                {
                    data: function (row) {
                        return parseInt(row.peEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
            ]
        }
    );

}
