$(document).ready(function () {
    getFechaUt('fecentrega');
});
$("#report").change(function () {
    switch (this.value) {
        case '1':
            tab_resu_general();
            $('#panelfech').prop("hidden", true);
            break;
        case '2':
            $('#panelfech').prop("hidden", false);
            break;
    }
});
function buscar(){
    if($('#fecentrega').val()!=''){
        tab_por_fechaEntrega($('#fecentrega').val());
    }else{
        console.log('incorrecto');
    }
}

function tab_resu_general() {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = ' <div class="col-xl-12 col-sm-12 col-xs-12  ">\n' +
        '                   <div id="data-table-fixed-header_wrapper"\n' +
        '                        class="dataTables_wrapper form-inline dt-bootstrap no-footer">\n' +
        '                       <div class="row">\n'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN GENERAL\n' +
        '                                            <a href="/excel/obtenerResumenporProgramaespecificaexport" class="btn btn-green   btn-sm"\n' +
        '                                               title="Click para imprimir resumen presupuestal">\n' +
        '                                                <i class="fa fa-file-excel">\n' +
        '                                                </i>\n' +
        '                                            </a></h3></u></b>\n' +
        '                            </div>' +
        '                           <div class="col-sm-12 table-responsive">\n' +
        '                               <table id="tabla_resu_general"\n' +
        '                                      class="table table-striped  table-bordered dataTable  dtr-inline "\n' +
        '                                      role="grid"\n' +
        '                                      aria-describedby="data-table-fixed-header_info" width="100%">\n' +
        '                                   <thead>\n' +
        '                                   <tr>\n' +
        '                                    <th class="text-center">PACIENTE</th>\n' +
        '                                    <th class="text-center">FECHA ENTREGA</th>\n' +
        '                                    <th class="text-center">EPP</th>\n' +
        '                                    <th class="text-center">CANTIDAD</th>\n' +
        '                                   </tr>\n' +
        '                                   </thead>\n' +
        '                                   <tbody>\n' +
        '                                   </tbody>\n' +
        '                                   <tfoot>\n' +
        '                                   <tr>\n' +
        '                                       <th colspan="3"  class="text-right"><strong>TOTAL</strong></th>\n' +
        '                                       <th  class="text-center"></th>\n' +
        '                                   </tr>\n' +
        '                                   </tfoot>\n' +
        '\n' +
        '\n' +
        '                               </table>\n' +
        '                           </div>\n' +
        '\n' +
        '                       </div>\n' +
        '\n' +
        '                   </div>\n' +
        '               </div>';
    idopc.append(valhtml);
    $('#tabla_resu_general thead tr').clone(true).appendTo('#tabla_resu_general thead');
    $('#tabla_resu_general thead tr:eq(1) th').each(function (i) {
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

}

function tab_por_fechaEntrega(fecha) {
    var valhtml;
    var idopc = $('#reporte');
    idopc.empty();
    valhtml = '    <div class="col-xl-12 col-sm-12 col-xs-12  ">\n' +
        '                <div id="data-table-fixed-header_wrapper"\n' +
        '                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">\n' +
        '                    <div class="row">\n'
        + ' <div class="text-center col-sm-12"><b><u><h3>RESUMEN POR FECHA ENTREGA\n' +
        '</h3></u></b>\n' +
        '                            </div>' +
        '                        <div class="col-sm-12 table-responsive">\n' +
        '                            <table id="tabla_resu_fechaentre"\n' +
        '                                   class="table table-striped  table-bordered dataTable  dtr-inline "\n' +
        '                                   role="grid"\n' +
        '                                   aria-describedby="data-table-fixed-header_info" width="100%">\n' +
        '                                <thead>\n' +
        '                                <tr>\n' +
        '                                    <th class="text-center">PACIENTE</th>\n' +
        '                                    <th class="text-center">FECHA ENTREGA</th>\n' +
        '                                    <th class="text-center">EPP</th>\n' +
        '                                    <th class="text-center">CANTIDAD</th>\n' +
        '                                </tr>\n' +
        '                                </thead>\n' +
        '                                <tbody>\n' +
        '                                </tbody>\n' +
        '                                <tfoot>\n' +
        '                                <tr>\n' +
        '                                    <th colspan="3"  class="text-right"><strong>TOTAL</strong></th>\n' +
        '                                    <th  class="text-center"></th>\n' +
        '                                </tr>\n' +
        '                                </tfoot>\n' +
        '\n' +
        '\n' +
        '                            </table>\n' +
        '                        </div>\n' +
        '\n' +
        '                    </div>\n' +
        '\n' +
        '                </div>\n' +
        '            </div>';
    idopc.append(valhtml);
    $('#tabla_resu_fechaentre thead tr').clone(true).appendTo('#tabla_resu_fechaentre thead');
    $('#tabla_resu_fechaentre thead tr:eq(1) th').each(function (i) {

        if (i === 0) {
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
    var table = $('#tabla_resu_fechaentre').DataTable({
            ajax: '/covid/getreportefechaentre/'+fecha,
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
                var cantt = 0;
                /*var ped = 0;
                var cer = 0;
                var comp = 0;
                var dev = 0;
                var gir = 0;
                var toteje = 0;
                var sineje = 0;*/
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    cantt += parseFloat(data[i]['Cantidad']);
                    /*ped += parseFloat(data[i]['est0']);
                    cer += parseFloat(data[i]['est1']);
                    comp += parseFloat(data[i]['est2']);
                    dev += parseFloat(data[i]['est3']);
                    gir += parseFloat(data[i]['est4']);
                    toteje += parseFloat(data[i]['totejec']);
                    sineje += parseFloat(data[i]['sobr']);*/
                }
                 cantt= formatter.format(cantt);
                /*ped = formatter.format(ped);
                cer = formatter.format(cer);
                comp = formatter.format(comp);
                dev = formatter.format(dev);
                gir = formatter.format(gir);
                toteje = formatter.format(toteje);
                sineje = formatter.format(sineje);*/
                $(this.api().column(3).footer()).html(cantt);
                /*$(this.api().column(4).footer()).html(toteje);
                $(this.api().column(5).footer()).html(sineje);
                $(this.api().column(6).footer()).html(ped);
                $(this.api().column(7).footer()).html(cer);
                $(this.api().column(8).footer()).html(comp);
                $(this.api().column(9).footer()).html(dev);
                $(this.api().column(10).footer()).html(gir);*/
            },
            columnDefs: [
                {"targets": 0, "width": "30%", "className": "text-left"},
                {"targets": 1, "width": "15%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 3, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'paciente', name: 'paciente'},
                {data: 'fecentregar', name: 'fecentregar'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'Cantidad', name: 'Cantidad'},
            ]
        }
    );
}
