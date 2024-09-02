var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var metasOrigen = [];
var metasDestino = [];
var metasOrigenEdit = [];
var metasDestinoEdit = [];
var metasOrigenVer = [];
var metasDestinoVer = [];
var presupuestos = [];
var presupuestosorigen = [];
var tip = 0;
$(document).ready(function () {
    transferenciasmod();
    metasd();
    fuentefinanciamiento();
    getOpc();

});
$('#addnmod').on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_modif').modal({show: true, backdrop: 'static', keyboard: false});
    datePickers();
});

function valMnt(mont, saldo) {
    if (parseFloat(mont) <= parseFloat(saldo)) {
        $('#addpres').prop("disabled", false);
        validarCaja('monme', 'validmonme', 'Correcto', 1);
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            icon: 'warning',
            type: 'warning',
            title: 'Saldo insuficiente',
            showConfirmButton: false,
            timer: 3000
        });
        $('#addpres').prop("disabled", true);
        validarCaja('monme', 'validmonme', 'Monto Incorrecto', 0);
    }
}

function validMonto() {
    var mont = $('#monme').val();
    var saldo = $('#salp').val();
    var pro = $('#pro').val();
    if (validarPres() === 0) {
        if (presupuestos.length === 0) {
            valMnt(mont, saldo);
        } else {
            var montt = 0;
            for (var i = 0; i < presupuestos.length; i++) {
                if (presupuestos[i]['prog'] === pro) {
                    montt += parseFloat(presupuestos[i]['monto']);
                }
            }
            var saldo1 = parseFloat($('#salp').val()) - parseFloat(montt);
            valMnt(mont, saldo1);
        }
    }
}

$(function () {
    //CARGAR TABLA INCORPORACION PRESUPUESTAL
    $('#tabla_trans thead tr').clone(true).appendTo('#tabla_trans thead');
    $('#tabla_trans thead tr:eq(1) th').each(function (i) {
        if (i === 1 | i === 2) {
            $(this).html('<input  type="text" placeholder=" " />');
        } else
            $(this).html('');


        $('input', this).on('keyup change', function () {
            if (table_trans.column(i).search() !== this.value) {
                table_trans
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });
    var table_trans = $('#tabla_trans').DataTable({
            ajax: '/presupuesto/obtenerpresupuesto',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: false,
            serverSide: false,
            ordering: false,
            select: true,
            destroy: true,
            decimal: ",",
            thousands: ".",
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['pMonto']);
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(4).footer()).html(totalAmount);
            },
            "scrollX": true,
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "40%", "className": "text-left"},
                {"targets": 3, "width": "10%", "className": "text-center"},
                {"targets": 4, "width": "10%", "className": "text-center"},
                {"targets": 5, "width": "10%", "className": "text-center"},
                {"targets": 6, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'trNumRj', name: 'trNumRj'},
                {data: 'mCod', name: 'mCod'},
                {
                    data: null,
                    render: function (data, type, row) {
                        return row.eGCod + ' ' + row.eGDesc;
                    }
                },
                {
                    data: 'pMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {data: 'pFecCrea', name: 'pFecCrea'},
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.pEst) === 1 && parseInt(row.pEst) === 1) {
                            return '<tr >\n' +
                                '<a href="javascript:;"  onclick="abrilModalEdInc(' + row.pId + ')" TITLE="Editar incorporacion " >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="javascript:;" style="color: red" TITLE="Eliminar incorporacion" onclick="eliminareditincedit(' + row.pId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="javascript:;" style="color: green" TITLE="Restaurar incorporacion"  onclick="eliminareditincedit(' + row.pId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }

            ]
        }
    );
//CARGAR TABLA MODIFICACION PRESUPUESTAL
    $('#tabla_modi thead tr').clone(true).appendTo('#tabla_modi thead');
    $('#tabla_modi thead tr:eq(1) th').each(function (i) {
        if (i === 1 | i === 2) {
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
    var table = $('#tabla_modi').DataTable({
            ajax: '/presupuesto/obtenermodificacionpre',
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
            buttons: [
                'excel'
            ],
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['pMonto']);
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(5).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},

            ],
            columns: [
                {data: 'nNro', name: 'nNro'},
                {data: 'nTipModifica', name: 'nTipModifica'},
                {data: 'trNumRj', name: 'trNumRj'},
                {
                    data: function (row) {
                        if (row.descripcionEjecutora == null) {
                            return row.descripcionEjecutora === null ? '<span ">META ESPECIFICA</span>' : ''
                        } else {
                            return row.descripcionEjecutora
                        }


                    }

                },
                {
                    data: 'pMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                //{data: 'trNumRj', name: 'trNumRj'},

                //{data: 'descripcionEjecutora', name: 'descripcionEjecutora'},
                {
                    data: function (row) {
                        return parseInt(row.nEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.nEst) === 1 && parseInt(row.nEst) === 1) {
                            return '<tr >\n' +
                                '<a href="javascript:;"  onclick="abrilModalVerMod(' + row.nId + ')" TITLE="Ver modificación presupuestal" >\n' +
                                '<i class="text-orange far fa-lg fa-fw m-r-10 fa-eye"> </i></a>' +
                                '<a href="javascript:;"  onclick="abrilModalEdMod(' + row.nId + ')" TITLE="Editar modificacion " >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="javascript:;" style="color: red" TITLE="Eliminar modificacion" onclick="eliminarnotamod(' + row.nId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="javascript:;" style="color: green" TITLE="Restaurar modificacion"  onclick="eliminarnotamod(' + row.nId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }


            ]
        }
    );
})

$('#addincor').on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_incor').modal({show: true, backdrop: 'static', keyboard: false});
    transferencias();
});

var datePickers = function () {

    $('#fecpre').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
};
var datePickersEdit = function () {

    $('#fecpreedit').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
};

function fuentefinanciamiento() {
    var url = "/presupuesto/obtenerfuentefinaciamiento";
    var arreglo;
    var select = $('#ff').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['fFId'] + '">' + data[i]['fFdesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#meo').on('change', function () {
    obtenerEspecificasMetaIdO(this.value);
});
$('#canceledit').on('click', function () {
    metasOrigenEdit = [];
    metasDestinoEdit = [];
    var datatable = $('#tabla_medesedit');
    datatable.DataTable().destroy();
});

$('#metamodedit').on('change', function () {
    obtenerEspecificasMetaIdEdit(this.value, 0);
});
$('#mededit').on('change', function () {
    obtenerEspecificasMetaIdEdit(this.value, 1);
});

function obtenerEspecificasMetaIdO(idmeta) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var select = $('#ego').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function obtenerEspecificasMetaIdEdit(idmeta, lug) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    if (lug == 0) {
        var select = $('#egoedit').html('');
    } else {
        var select = $('#egdedit').html('');
    }

    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function obtenerEspecificasMetaIdEdit1(idEspem, idmeta, dest) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    if (dest == 0) {
        var select = $('#egoedit').html('');
    } else {
        var select = $('#egdedit').html('');
    }
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['mEGId'] === idEspem) {
                        htmla = '<option value="' + data[i]['mEGId'] + '" selected>' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}


function saldo(val) {
    var url = "/presupuesto/obtenersaldo/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#sal').val(data[0]['sal']);
            }

        });
}

$('#med').on('change', function () {
    obtenerEspecificasMetaIdD(this.value);
});

function obtenerEspecificasMetaIdD(idmeta) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var select = $('#egd').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#nrrjmod').on('change', function () {
    var url = "/presupuesto/obtenermetastr/" + this.value;
    var arreglo;
    var select = $('#meo').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
});

$('#nrrjmodedit').on('change', function () {
    metasEditMod1(this.value);
});

function metasEditMod1(id) {
    var url = "/presupuesto/obtenermetastr/" + id;
    var arreglo;
    var select = $('#metamodedit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function metasEditModDest(id) {
    var url = "/presupuesto/obtenermetastr/" + id;
    var arreglo;
    var select = $('#mededit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function metasEditMod2(trid, id, dest) {
    var url = "/presupuesto/obtenermetastr/" + trid;
    var arreglo;
    if (dest == 0) {
        var select = $('#metamodedit').html('');
    } else {
        var select = $('#mededit').html('');
    }
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['mId'] === id) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mCod'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}


function metasd() {
    var url = "/presupuesto/obtenermetas";
    var select = $('#med').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function metas(idtr) {
    var url = "/presupuesto/getmetastransf/" + idtr;
    var arreglo;
    var select = $('#meta').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function transferencias() {
    var url = "/presupuesto/obtenertransferencias";
    var arreglo;
    var select = $('#nrrj').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['trNumRj'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}


function transferenciasmod() {
    var url = "/presupuesto/obtenertransferencias";
    var arreglo;
    var select = $('#nrrjmod').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['trNumRj'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#nrrj').on('change', function () {
    obtenerTransferencia(this.value)
    tablatechopres(this.value);
    $('#meta').prop('disabled', false).focus();
    metas(this.value);
});

function tablatechopres(idtr) {
    $('#tabla_tecpresu').DataTable({
        ajax: '/presupuesto/getTechP/' + idtr,
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
        /*dom: 'lBfrtip',
          buttons: [
            'excel', 'pdf'
        ],*/
        columnDefs: [
            {"targets": 0, "width": "30%", "className": "text-left"},
            {"targets": 1, "width": "30%", "className": "text-left"},
            {"targets": 2, "width": "20%", "className": "text-right"},
            {"targets": 3, "width": "20%", "className": "text-right"},
        ],
        columns: [

            {data: 'pPDesc', name: 'pPDesc'},
            {data: 'cDescripcion', name: 'cDescripcion'},
            {
                data: 'tpMonto',
                render: $.fn.dataTable.render.number(',', '.', 2)
            },
            {data: 'tec', name: 'tec'},
        ]
    });
}

function tabla_presupuest() {
    var datatable = $('#tabla_pres');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: presupuestos,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['monto']);
                }
                totalAmount = formatter.format(totalAmount);
                $('#totalmonorig').val(totalAmount);
                $(this.api().column(3).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "20%", "className": "text-center"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "50%", "className": "text-left"},
                {"targets": 3, "width": "10%", "className": "text-center"},
                {"targets": 4, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'prog', name: 'prog'},
                {data: 'meta', name: 'meta'},
                {data: 'espec', name: 'espec'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {

                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: red" TITLE="Eliminar" onclick="quitarPres(' + row.idespeg + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );
}

function quitarPres(idmeg) {
    var ubi = null;
    for (var i = 0; i < presupuestos.length; i++) {
        if (parseInt(presupuestos[i]['idespeg']) === parseInt(idmeg)) {
            ubi = i;
        }
    }
    presupuestos.splice(ubi, 1);
    tabla_presupuest();
}

$('#meta').on('change', function () {
    obtenerEspecificasMetaId(this.value);
    obtenerMetaId(this.value);
});
$('#addpres').on('click', function () {
    let meta = $('#meta').children("option:selected").text();
    let espegas = $('#esga').children("option:selected").text();
    let idmeg = $('#esga').val();
    let monto = $('#monme').val();
    let prog = $('#pro').val();
    if (validarPres() === 0) {
        let presupues = new Array();
        presupues['idespeg'] = idmeg;
        presupues['meta'] = meta;
        presupues['espec'] = espegas;
        presupues['monto'] = monto;
        presupues['prog'] = prog;
        var ubi = 0;
        for (var i = 0; i < presupuestos.length; i++) {
            if (presupuestos[i]['idespeg'].toString() === presupues['idespeg']) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            $('#envref').prop("disabled", false);
            presupuestos.push(presupues);
        }
        tabla_presupuest();
    } else {
        operacionSubsanar();
    }
});

function techo(ppid) {
    var trid = $('#nrrj').val();
    var bot = $('#enviar');
    $.ajax({
        url: '/presupuesto/getTecho',
        type: 'GET',
        data: {
            _token: CSRF_TOKEN,
            trid: trid,
            ppi: ppid,
        },
        dataType: 'JSON',
        success:
            function (data) {
                if (data === undefined || data.length == 0) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'La meta no tiene techo presupuestal asignado!',
                        showConfirmButton: false,
                        timer: 5000
                    });
                    location.reload()
                } else {
                    $('#salp').val(data[0]['tec']);
                    bot.prop("disabled", false);
                }


            }, beforeSend: function () {

            bot.prop("disabled", true);

        },

    });
}

function obtenerEspecificasMetaId(idmeta) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var select = $('#esga').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function obtenerTransferencia(id) {
    var url = "/presupuesto/obtenertransferenciasid/" + id;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#cdtrans').val(data[0]['trCodTrans']).prop("disabled", true);
                $('#fecin').val(data[0]['trFecCrea']).prop("disabled", true);
                $('#fufi').val(data[0]['fFdesc']).prop("disabled", true);
                $('#montoin').val(data[0]['trMonto']).prop("disabled", true);
            }, beforeSend: function () {

            },

        });
}

function obtenerMetaId(id) {
    var url = "/presupuesto/obtenermetaid/" + id;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#pro').val(data[0]['pPDesc']).prop("disabled", true);
                $('#prod').val(data[0]['fDescProducto']).prop("disabled", true);
                $('#act').val(data[0]['fDescActividad']).prop("disabled", true);
                $('#fin').val(data[0]['fDescFinalidad']).prop("disabled", true);
                $('#sus').val(data[0]['mSusten']).prop("disabled", true);
                techo(data[0]['pPId'])
            }, beforeSend: function () {

            },

        });
}

function enviarPres() {
    for (var i = 0; i < presupuestos.length; i++) {
        let presupues = new Array();
        presupues[0] = parseInt(presupuestos[i]['idespeg']);
        presupues[1] = presupuestos[i]['meta'];
        presupues[2] = presupuestos[i]['espec'];
        presupues[3] = presupuestos[i]['monto'];
        presupuestosorigen.push(presupues);
    }
    if (validarFormulario() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se incorporara el prespuesto',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {

                if (parseFloat($('#salp').val()) >= parseFloat($('#monme').val())) {
                    var nrrj = $('#nrrj').val();
                    json = JSON.stringify(presupuestosorigen);
                    $.ajax({
                        url: '/presupuesto/storeprespuesto',
                        type: 'GET',
                        data: {
                            _token: CSRF_TOKEN,
                            nrrj: nrrj,
                            per: json,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de prespuesto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();
                                } else {

                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();
                                }
                            }
                        ,
                        beforeSend: function () {
                            $('#enviar').prop("disabled", true);
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'antencion!',
                        text: 'El monto supera el techo presupuestal',
                        showConfirmButton: false,
                        timer: 6000
                    });
                    location.reload();
                }
            }
        })

    } else {
        operacionSubsanar();
    }
}

function enviarNot() {
    if (validarFormularioMod() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara un nuevo registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar',
        }).then((result) => {
            if (result.value) {
                if (parseFloat($('#totalmonorig').val()) == parseFloat($('#totalmondest').val()) || $('#ejecutval').prop('checked') == true) {
                    var idtrans = $('#nrrjmod').val();
                    var nnota = $('#nnota').val();
                    var ndoc = $('#ndoc').val();
                    var tipmod = $('#tipmod').val();
                    var sustn = $('#sustn').val();
                    //sustn = JSON.stringify(sustn);
                    var fecpre = $('#fecpre').val();
                    var ejec = $('#ejec').val();
                    var idme = new Array();
                    var monto = new Array();
                    var tipo = new Array();
                    metasOrigen = metasOrigen.concat(metasDestino);
                    for (var i = 0; i < metasOrigen.length; i++) {
                        idme[i] = metasOrigen[i]['idMetEsp'];
                        monto[i] = metasOrigen[i]['monto'];
                        tipo[i] = metasOrigen[i]['tipo'];
                    }
                    $.ajax({
                        url: '/presupuesto/storemodificacionprespuestal',
                        type: 'GET',
                        data: {
                            _token: CSRF_TOKEN,
                            idme: idme,
                            idtrans: idtrans,
                            monto: monto,
                            tipo: tipo,
                            nnota: nnota,
                            ndoc: ndoc,
                            tipmod: tipmod,
                            sustn: sustn,
                            fecpre: fecpre,
                            ejec: ejec,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    //redirect('/presupuesto/gestion');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de modificacion prespuestal exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();
                                } else {
                                    //redirect('/presupuesto/gestion');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarnot').prop("disabled", true);
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'antencion!',
                        text: 'El monto total anula no coincide con el monto total credito',
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            }
        });
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });
    }

}

//ENVIAR NOTA EDITAR
function enviarNotEdit() {
    if (validarFormularioModEdit() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editara el registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar',
        }).then((result) => {
            if (result.value) {
                if (parseFloat($('#totalmonorigedit').val()) == parseFloat($('#totalmondestedit').val()) || $('#ejecutvaledit').prop('checked') == true) {
                    var idnota = $('#idmodedit').val();
                    var idtrans = $('#nrrjmodedit').val();
                    var nnota = $('#nnotaedit').val();
                    var ndoc = $('#ndocedit').val();
                    var tipmod = $('#tipmodedit').val();
                    var sustn = $('#sustnedit').val();
                    var fecpre = $('#fecpreedit').val()
                    if ($('#ejecutvaledit').prop('checked')) {
                        var ejec = $('#ejecedit').val();
                        tip = 0;
                    } else {
                        var ejec = null;
                        tip = 1;
                    }

                    var idme = new Array();
                    var idmp = new Array();
                    var monto = new Array();
                    var tipo = new Array();
                    var idp = new Array();
                    var nreg = new Array();
                    metasOrigenEdit = metasOrigenEdit.concat(metasDestinoEdit);
                    for (var i = 0; i < metasOrigenEdit.length; i++) {
                        idme[i] = metasOrigenEdit[i]['idMetEsp'];
                        idmp[i] = metasOrigenEdit[i]['mPId'];
                        monto[i] = metasOrigenEdit[i]['monto'];
                        tipo[i] = metasOrigenEdit[i]['tipo'];
                        idp[i] = metasOrigenEdit[i]['pId'];
                        nreg[i] = metasOrigenEdit[i]['nreg'];
                    }
                    $.ajax({
                        url: '/presupuesto/editmodificacionprespuestal',
                        type: 'GET',
                        data: {
                            _token: CSRF_TOKEN,
                            idnota: idnota,
                            idme: idme,
                            idmp: idmp,
                            idp: idp,
                            nreg: nreg,
                            idtrans: idtrans,
                            monto: monto,
                            tipo: tipo,
                            nnota: nnota,
                            ndoc: ndoc,
                            tipmod: tipmod,
                            sustn: sustn,
                            fecpre: fecpre,
                            ejec: ejec,
                            tip: tip,
                            //ejetrue: ejetrue,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    //redirect('/presupuesto/gestion');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de modificacion prespuestal exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();
                                } else {
                                    //redirect('/presupuesto/gestion');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarnotedit').prop("disabled", true);
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'antencion!',
                        text: 'El monto total anula no coincide con el monto total credito',
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            }
        });
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });

    }
}

$('#addor').on('click', function () {
    if (validarOrigenMod() === 0) {
        var meta = $('#meo').children("option:selected").text();
        var ego = $('#ego');
        var idMetEsp = ego.children("option:selected").val();
        var espe = ego.children("option:selected").text();
        var monto = $('#montnm').val();
        var metaOrigen = new Array();
        metaOrigen['meta'] = meta;
        metaOrigen['idMetEsp'] = idMetEsp;
        metaOrigen['espe'] = espe;
        metaOrigen['monto'] = monto;
        metaOrigen['tipo'] = 0;
        var ubi = 0;
        for (var i = 0; i < metasOrigen.length; i++) {
            if (metasOrigen[i]['idMetEsp'].toString() === metaOrigen['idMetEsp']) {
                ubi = 1;
            }
        }
        if (ubi === 0)
            metasOrigen.push(metaOrigen);
        tablaOrigen();
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });
    }
});
$('#addoredit').on('click', function () {
    if (validarOrigenModEdit() === 0) {
        var metaedit = $('#metamodedit').children("option:selected").text();
        var egoedit = $('#egoedit');
        var idMetEspedit = egoedit.children("option:selected").val();
        var espeedit = egoedit.children("option:selected").text();
        var montoedit = $('#montnmedit').val();
        var metaOrigenedit = new Array();
        metaOrigenedit['meta'] = metaedit;
        metaOrigenedit['idMetEsp'] = idMetEspedit;
        metaOrigenedit['espe'] = espeedit;
        metaOrigenedit['monto'] = montoedit;
        metaOrigenedit['tipo'] = 0;
        metaOrigenedit['nreg'] = 1;
        metaOrigenedit['pEst'] = 1;
        var ubi = 0;
        for (var i = 0; i < metasOrigenEdit.length; i++) {
            if (metasOrigenEdit[i]['idMetEsp'].toString() === metaOrigenedit['idMetEsp']) {
                metasOrigenEdit[i]['monto'] = montoedit;
                metasOrigenEdit[i]['nreg'] = 0;
                ubi = 1;
            }
        }
        if (ubi === 0) {
            metasOrigenEdit.push(metaOrigenedit);
        }
        tablaOrigenEdit();
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });
    }

});

function tablaOrigen() {
    var datatable = $('#tabla_meor');
    datatable.DataTable().destroy();
    datatable.DataTable({

            data: metasOrigen,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['monto']);
                }
                totalAmount = formatter.format(totalAmount);
                $('#totalmonorig').val(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'meta', name: 'meta'},
                {data: 'espe', name: 'espe'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: #ff0000" TITLE="Quitar meta" onclick="quitarMetOrig(' + row.IdMestEsp + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

//FUNCION QUE MUESTRA LOS DATOS DE ORIGEN EN LA TABLA ORIGEN AL ACTUALIZAR
function tablaOrigenEdit() {
    var datatable = $('#tabla_meoredit');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: metasOrigenEdit,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                console.log(data)
                for (var i = 0; i < data.length; i++) {

                    if (data[i]['pEst'] === 1) {
                        totalAmount += parseFloat(data[i]['monto']);
                    }
                }
                totalAmount = formatter.format(totalAmount);
                $('#totalmonorigedit').val(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'meta', name: 'meta'},
                {data: 'espe', name: 'espe'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        var dest = 0;
                        return '<tr >\n' +
                            '<a href="javascript:;"  onclick="obtenerMetEspecificaMontoOrigen(' + row.trId + ',' + row.mId + ',' + row.idMetEsp + ',' + row.monto + ',' + dest + ')" TITLE="Editar meta " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="javascript:;" style="color: #ff0000" TITLE="Eliminar meta" onclick="eliminarorigModedit(' + row.pId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

//FUNCION QUE MUESTRA LOS DATOS DE ORIGEN EN LA TABLA ORIGEN AL VER
function tablaOrigenVer() {
    var datatable = $('#tabla_meorver');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: metasOrigenVer,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['pEst'] === 1) {
                        totalAmount += parseFloat(data[i]['monto']);
                    }
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'meta', name: 'meta'},
                {data: 'espe', name: 'espe'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
            ]
        }
    );
}

$('#adddes').on('click', function () {
    if (validarDestinoMod() === 0) {
        var meta = $('#med').children("option:selected").text();
        var egd = $('#egd');
        var idMetEsp = egd.children("option:selected").val();
        var espe = egd.children("option:selected").text();
        var monto = $('#montd').val();
        var metaDestino = new Array();
        metaDestino['meta'] = meta;
        metaDestino['idMetEsp'] = idMetEsp;
        metaDestino['espe'] = espe;
        metaDestino['monto'] = monto;
        metaDestino['tipo'] = 1;
        var ubi = 0;
        for (var i = 0; i < metasDestino.length; i++) {
            if (metasDestino[i]['idMetEsp'].toString() === metaDestino['idMetEsp']) {
                ubi = 1;
            }
        }
        if (ubi === 0)
            metasDestino.push(metaDestino);
        tablaDestino();
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });
    }
});

//FUNCION PARA AGREGAR META DESTINO A TABLA  DE EDITAR MODIFICACION
$('#adddesedit').on('click', function () {
    if (validarDestinoModEdit() === 0) {
        var metaedit = $('#mededit').children("option:selected").text();
        var egdedit = $('#egdedit');
        var idMetEspedit = egdedit.children("option:selected").val();
        var espeedit = egdedit.children("option:selected").text();
        var montoedit = $('#montdedit').val();
        var metaDestinoedid = new Array();
        metaDestinoedid['meta'] = metaedit;
        metaDestinoedid['idMetEsp'] = idMetEspedit;
        metaDestinoedid['espe'] = espeedit;
        metaDestinoedid['monto'] = montoedit;
        metaDestinoedid['tipo'] = 1;
        metaDestinoedid['nreg'] = 1;
        metaDestinoedid['pEst'] = 1;
        var ubi = 0;
        for (var i = 0; i < metasDestinoEdit.length; i++) {
            if (metasDestinoEdit[i]['idMetEsp'].toString() === metaDestinoedid['idMetEsp']) {
                metasDestinoEdit[i]['monto'] = montoedit;
                metasDestinoEdit[i]['nreg'] = 0;
                ubi = 1;
            }
        }
        if (ubi === 0) {
            metasDestinoEdit.push(metaDestinoedid);
        }
        tablaDestinoEdit();
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });

    }

});

function tablaDestino() {
    var datatable = $('#tabla_medes');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: metasDestino,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });

                for (var i = 0; i < data.length; i++) {

                    totalAmount += parseFloat(data[i]['monto']);
                }
                totalAmount = formatter.format(totalAmount);
                $('#totalmondest').val(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'meta', name: 'meta'},
                {data: 'espe', name: 'espe'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: #ff0000" TITLE="Quitar meta" onclick="quitarMetDest(' + row.idMetEsp + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

//FUNCION QUE MUESTRA LOS DATOS DE DESTINO EN LA TABLA DE DESTINO AL ACTUALIZAR
function tablaDestinoEdit() {
    var datatable = $('#tabla_medesedit');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: metasDestinoEdit,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['pEst'] === 1) {
                        totalAmount += parseFloat(data[i]['monto']);
                    }
                }
                totalAmount = formatter.format(totalAmount);
                $('#totalmondestedit').val(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'meta', name: 'meta'},
                {data: 'espe', name: 'espe'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                //{data: 'monto', render: $.fn.dataTable.render.number('.', ',', 2)},
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        var dest = 1;
                        return '<tr >\n' +
                            '<a  href="javascript:;"  onclick="obtenerMetEspecificaMontoDestino(' + row.trId + ',' + row.mId + ',' + row.idMetEsp + ',' + row.monto + ',' + dest + ')" TITLE="Editar meta " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a  href="javascript:;" style="color: #ff0000" TITLE="Eliminar meta" onclick="eliminarorigModedit(' + row.pId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

//FUNCION QUE MUESTRA LOS DATOS DE DESTINO EN LA TABLA DE DESTINO AL VER
function tablaDestinoVer() {
    var datatable = $('#tabla_medesver');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: metasDestinoVer,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['pEst'] === 1) {
                        totalAmount += parseFloat(data[i]['monto']);
                    }
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'meta', name: 'meta'},
                {data: 'espe', name: 'espe'},
                {
                    data: 'monto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                //{data: 'monto', render: $.fn.dataTable.render.number('.', ',', 2)},
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
            ]
        }
    );
}

//FUNCION PARA HABILITAR/DESABILITAR DESTINO EN AGREGAR MODIFICACION
$("#ejecutval").on('change', function () {
    if ($(this).is(':checked')) {
        $('#ejecutora').prop("hidden", false);
        $('#metdes').prop("hidden", true);
        obtenerEejcutora();
    } else {
        $('#metdes').prop("hidden", false);
        $('#ejecutora').prop("hidden", true);

    }
});

//FUNCION PARA HABILITAR/DESABILITAR DESTINO EN EDITAR MODIFICACION
$("#ejecutvaledit").on('change', function () {
    if ($(this).is(':checked')) {
        $('#ejecutoraedit').prop("hidden", false);
        $('#metdesedit').prop("hidden", true);
        obtenerEjecutoraEditMod(0);
        $('#ejetrue').val(1);
    } else {
        $('#metdesedit').prop("hidden", false);
        $('#ejecutoraedit').prop("hidden", true);
        var rj = document.getElementById("nrrjmodedit");
        metasEditModDest(rj.value);
        $('#ejetrue').val(0);
    }
});

function obtenerEejcutora() {
    var url = "/ejecutoras";
    var arreglo;
    var select = $('#ejec').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['idEjecutora'] + '">' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

//FUNCION QUE OBTIENE LAS EJECUTORAS PARA PODER EDITAR EN MODIFICACION PRESUPUESTAL
function obtenerEjecutoraEditMod(id) {
    var url = "/ejecutoras";
    var arreglo;
    var select = $('#ejecedit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['idEjecutora'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['idEjecutora'] + '" selected>' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['idEjecutora'] + '">' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

//FUNCION QUE OBTIENE LAS EJECUTORAS PARA PODER VER EN MODIFICACION PRESUPUESTAL
function obtenerEjecutoraVerMod(id) {
    var url = "/ejecutoras";
    var arreglo;
    var select = $('#ejecver').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['idEjecutora'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['idEjecutora'] + '" selected>' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['idEjecutora'] + '">' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

//ABRIR MODAL EDITAR INCORPORACION
function abrilModalEdInc(id) {
    window.event.preventDefault();
    $('#modal-dialog_edit_inc').modal('show');
    obtenerEditarIncoporacoion(id)


}

//ABRIR MODAL EDITAR MODIFICACION
function abrilModalEdMod(id) {
    window.event.preventDefault();
    $('#modal_dialog_edit_modif').modal({show: true, backdrop: 'static', keyboard: false});
    metasOrigenEdit = [];
    metasDestinoEdit = [];
    datePickersEdit();
    obtenerEditarModificacion(id)


}

function abrilModalVerMod(id) {
    window.event.preventDefault();
    $('#modal_dialog_ver_modif').modal({show: true, backdrop: 'static', keyboard: false});
    metasOrigenVer = [];
    metasDestinoVer = [];
    obtenerVerModificacion(id)


}

var focusMethod = function getFocus(dest) {
    if (dest == 0) {
        document.getElementById("metamodedit").focus();
    } else {
        document.getElementById("mededit").focus();
    }

}

//FUNCION PARA CARGAR META-ESPECIFICA Y MONTO DE ORIGEN
function obtenerMetEspecificaMontoOrigen(transid, metaid, metaespgid, preMonto, dest) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se editara/modificara este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            metasEditMod2(transid, metaid, dest);
            obtenerEspecificasMetaIdEdit1(metaespgid, metaid, dest);
            $('#montnmedit').val(preMonto);

        }
        focusMethod(dest);
    })

    //obtenerEditarModificacion(id)


}

//FUNCION PARA CARGAR META-ESPECIFICA Y MONTO DE DESTINO
function obtenerMetEspecificaMontoDestino(transid, metaid, metaespgid, preMonto, dest) {

    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se editara/modificara este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            metasEditMod2(transid, metaid, dest);
            obtenerEspecificasMetaIdEdit1(metaespgid, metaid, dest);
            $('#montdedit').val(preMonto);

        }
        focusMethod(dest);
    })

    //obtenerEditarModificacion(id)


}

//OBTIENE LOS DATOS DE INCORPORACION
function obtenerEditarIncoporacoion(val) {
    var url = "/presupuesto/obtenerIncorporacionEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var pres = data['pres'];
                    var met = data['met'];
                    $('#idincedit').val(val);
                    transferenciasEditInc(pres['trId']);
                    metasEditInc(met['mId']);
                    $('#monmeincedit').val(pres['pMonto'])

                    obtenerEspecificasMetaIdincedit(met['mId'], met['eGId']);
                } else {

                }

            }

        });
}

//OBTIENE LOS DATOS DE MODIFICACION
function obtenerEditarModificacion(val) {
    var url = "/presupuesto/obtenerModificacionEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var idejec = data[0]['idEjecutora'];
                var fec = data[0]['nFecNotaSoli'];
                fec = $.datepicker.formatDate("dd-mm-yy", $.datepicker.parseDate('yy-mm-dd', fec));
                $('#idmodedit').val(data[0]['nId']);
                $('#nnotaedit').val(data[0]['nNro']);
                $('#ndocedit').val(data[0]['nDoc']);
                $('#tipmodedit').val(data[0]['nTipModifica']);
                $('#sustnedit').val(data[0]['nSustento']);
                $('#fecpreedit').val(fec);
                transferenciasEditMod(data[0]['trId']);

                if (data[0]['idEjecutora'] === null) {
                    $('#ejecutvaledit').prop("checked", false)
                    $('#ejecutoraedit').prop("hidden", true);
                    $('#metdesedit').prop("hidden", false);
                    ObtenerModifPresEditMod(data[0]['nId']);
                } else {
                    $('#ejecutvaledit').prop("checked", true)
                    $('#ejecutoraedit').prop("hidden", false);
                    $('#metdesedit').prop("hidden", true);
                    ObtenerModifPresEditMod(data[0]['nId'])
                    obtenerEjecutoraEditMod(idejec);
                }

            }

        });
}

//OBTIENE LOS DATOS VER MODIFICACION
function obtenerVerModificacion(val) {
    var url = "/presupuesto/obtenerModificacionEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var idejec = data[0]['idEjecutora'];
                var fec = data[0]['nFecNotaSoli'];
                fec = $.datepicker.formatDate("dd-mm-yy", $.datepicker.parseDate('yy-mm-dd', fec));
                //$('#idmodver').val(data[0]['nId']);
                $('#nnotaver').val(data[0]['nNro']);
                $('#ndocver').val(data[0]['nDoc']);
                $('#tipmodver').val(data[0]['nTipModifica']);
                $('#sustnver').val(data[0]['nSustento']);
                $('#fecprever').val(fec);
                transferenciasVerMod(data[0]['trId']);

                if (data[0]['idEjecutora'] === null) {
                    $('#ejecutvalver').prop("checked", false)
                    $('#ejecutoraver').prop("hidden", true);
                    $('#metdesver').prop("hidden", false);
                    ObtenerModifPresVerMod(data[0]['nId']);
                    //metasEditModDest(rjd.value);
                } else {
                    $('#ejecutvalver').prop("checked", true)
                    $('#ejecutoraver').prop("hidden", false);
                    $('#metdesver').prop("hidden", true);
                    ObtenerModifPresVerMod(data[0]['nId'])
                    obtenerEjecutoraVerMod(idejec);
                }

            }

        });
}

//FUNCION PARA OBTENER Y EDITAR LAS TRANSFERENCIAS DE INCORPORACION
function transferenciasEditInc(id) {
    var url = "/presupuesto/obtenertransferencias";
    var select = $('#nrrjincedt').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {

                    if (data[i]['trId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['trId'] + '" selected>' + data[i]['trNumRj'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['trNumRj'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

//FUNCION PARA OBTENER Y EDITAR LAS TRANSFERENCIAS DE MODIFICACION
function transferenciasEditMod(id) {
    var url = "/presupuesto/obtenertransferencias";
    var select = $('#nrrjmodedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['trId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['trId'] + '" selected>' + data[i]['trNumRj'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['trNumRj'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
                //var rj = document.getElementById("nrrjmodedit");
                metasEditMod1($('#nrrjmodedit').val());
                metasEditModDest($('#nrrjmodedit').val());
            }

        });

}

//FUNCION PARA OBTENER Y VERLAS TRANSFERENCIAS DE MODIFICACION
function transferenciasVerMod(id) {
    var url = "/presupuesto/obtenertransferencias";
    var select = $('#nrrjmodver').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['trId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['trId'] + '" selected>' + data[i]['trNumRj'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['trNumRj'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
                var rj = document.getElementById("nrrjmodedit");
                metasEditMod1(rj.value);
                metasEditModDest(rj.value);
            }

        });

}

//OBTENER MODIFICACION PRESUPUESTAL EDIT
function ObtenerModifPresEditMod(val) {
    var url = "/presupuesto/obtenerModificacionEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['pMonto'] < 0) {
                        var metaedit = data[i]['mCod'];
                        var idMetEspedit = data[i]['mEGId'];
                        var espeedit = data[i]['egdesc'];
                        var montoedit = data[i]['pMonto'];
                        var mId = data[i]['mId'];
                        var trId = data[i]['trId'];
                        var pId = data[i]['pId'];
                        var pEst = data[i]['pEst'];
                        var mPId = data[i]['mPId'];

                        var metaOrigenedit = new Array();
                        metaOrigenedit['meta'] = metaedit;
                        metaOrigenedit['idMetEsp'] = idMetEspedit;
                        metaOrigenedit['espe'] = espeedit;
                        metaOrigenedit['monto'] = -1 * (montoedit);
                        metaOrigenedit['tipo'] = 0;
                        metaOrigenedit['mId'] = mId;
                        metaOrigenedit['trId'] = trId;
                        metaOrigenedit['pId'] = pId;
                        metaOrigenedit['pEst'] = pEst;
                        metaOrigenedit['mPId'] = mPId;
                        metaOrigenedit['nreg'] = 0;
                        metasOrigenEdit.push(metaOrigenedit)
                    } else {
                        var metaedit = data[i]['mCod'];
                        var idMetEspedit = data[i]['mEGId'];
                        var espeedit = data[i]['egdesc'];
                        var montoedit = data[i]['pMonto'];
                        var mId = data[i]['mId'];
                        var trId = data[i]['trId'];
                        var pId = data[i]['pId'];
                        var pEst = data[i]['pEst'];
                        var mPId = data[i]['mPId'];
                        var metaDestinoedit = new Array();
                        metaDestinoedit['meta'] = metaedit;
                        metaDestinoedit['idMetEsp'] = idMetEspedit;
                        metaDestinoedit['espe'] = espeedit;
                        metaDestinoedit['monto'] = montoedit;
                        metaDestinoedit['tipo'] = 1;
                        metaDestinoedit['mId'] = mId;
                        metaDestinoedit['trId'] = trId;
                        metaDestinoedit['pId'] = pId;
                        metaDestinoedit['pEst'] = pEst;
                        metaDestinoedit['mPId'] = mPId;
                        metaDestinoedit['nreg'] = 0;
                        metasDestinoEdit.push(metaDestinoedit);
                    }

                }
                tablaOrigenEdit()
                tablaDestinoEdit()
            }

        });

}

//OBTENER MODIFICACION PRESUPUESTAL VER
function ObtenerModifPresVerMod(val) {
    var url = "/presupuesto/obtenerModificacionEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['pMonto'] < 0) {
                        var metaver = data[i]['mCod'];
                        var idMetEspver = data[i]['mEGId'];
                        var espever = data[i]['egdesc'];
                        var montover = data[i]['pMonto'];
                        var mId = data[i]['mId'];
                        var trId = data[i]['trId'];
                        var pId = data[i]['pId'];
                        var pEst = data[i]['pEst'];
                        var mPId = data[i]['mPId'];

                        var metaOrigenver = new Array();
                        metaOrigenver['meta'] = metaver;
                        metaOrigenver['idMetEsp'] = idMetEspver;
                        metaOrigenver['espe'] = espever;
                        metaOrigenver['monto'] = -1 * (montover);
                        metaOrigenver['tipo'] = 0;
                        metaOrigenver['mId'] = mId;
                        metaOrigenver['trId'] = trId;
                        metaOrigenver['pId'] = pId;
                        metaOrigenver['pEst'] = pEst;
                        metaOrigenver['mPId'] = mPId;
                        metaOrigenver['nreg'] = 0;
                        metasOrigenVer.push(metaOrigenver)
                    } else {
                        var metaver = data[i]['mCod'];
                        var idMetEspver = data[i]['mEGId'];
                        var espever = data[i]['egdesc'];
                        var montover = data[i]['pMonto'];
                        var mId = data[i]['mId'];
                        var trId = data[i]['trId'];
                        var pId = data[i]['pId'];
                        var pEst = data[i]['pEst'];
                        var mPId = data[i]['mPId'];
                        var metaDestinover = new Array();
                        metaDestinover['meta'] = metaver;
                        metaDestinover['idMetEsp'] = idMetEspver;
                        metaDestinover['espe'] = espever;
                        metaDestinover['monto'] = montover;
                        metaDestinover['tipo'] = 1;
                        metaDestinover['mId'] = mId;
                        metaDestinover['trId'] = trId;
                        metaDestinover['pId'] = pId;
                        metaDestinover['pEst'] = pEst;
                        metaDestinover['mPId'] = mPId;
                        metaDestinover['nreg'] = 0;
                        metasDestinoVer.push(metaDestinover);
                    }

                }
                tablaOrigenVer()
                tablaDestinoVer()
            }

        });

}

function metasEditInc(id) {
    var url = "/presupuesto/obtenermetas";
    var arreglo;
    var select = $('#metaincedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {

                    if (data[i]['mId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mCod'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function metasEditMod(id) {
    var url = "/presupuesto/obtenermetas";
    var arreglo;
    var select = $('#metamodedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {

                    if (data[i]['mId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mCod'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function notamodEditMod(id) {
    var url = "/presupuesto/obtenermetas";
    var arreglo;
    var select = $('#metamodedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {

                    if (data[i]['mId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mCod'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function enviareditincEdit() {

    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se editara el registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            var idinc = $('#idincedit').val();
            var esga = $('#esgaincedit').val();
            var nrrj = $('#nrrjincedt').val();
            var monme = $('#monmeincedit').val();
            $.ajax({
                url: '/presupuesto/editprespuesto',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    esga: esga,
                    nrrj: nrrj,
                    monme: monme,
                    idinc: idinc
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Prespuesto  editado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();

                        }


                    }

                ,
                beforeSend: function () {
                    $('#enviareditincedit').prop("disabled", true);
                }
            });


        }
    });


}

function eliminareditincedit(idpr) {
    var url = "/presupuesto/eliminarpresup/" + idpr;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara/restaurara este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/gestion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Pedido eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/gestion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });

                        }
                    }

                });

        }
    })


}

function eliminarnotamod(idnot) {
    var url = "/presupuesto/eliminarnotmod/" + idnot;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara/restaurara este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/gestion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Nota eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/gestion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });

                        }
                    }

                });

        }
    })


}

//FUNCION QUITAR META ORIGEN
function quitarMetOrig(idmetesp) {
    var ubi = null;
    for (var i = 0; i < metasOrigen.length; i++) {
        if (metasOrigen[i]['idMetEsp'] === idmetesp) {
            ubi = i;
        }
    }
    metasOrigen.splice(ubi, 1);
    tablaOrigen();
}

//FUNCION QUITAR META DESTINO
function quitarMetDest(idmetesp) {
    var ubi = null;
    for (var i = 0; i < metasDestino.length; i++) {
        if (metasDestino[i]['idMetEsp'] === idmetesp) {
            ubi = i;
        }
    }
    metasDestino.splice(ubi, 1);
    tablaDestino();
}

//FUNCION PARA ELIMINAR DATO SELECCIONADO DE ORIGEN (EDITAR MODIFICACION PRESUPUESTAL)
function eliminarorigModedit(idpr) {
    var url = "/presupuesto/eliminarpresup/" + idpr;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara/restaurara este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            //redirect('/presupuesto/gestion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Modificacion Presupuestal eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            metasOrigenEdit = [];
                            metasDestinoEdit = [];
                            ObtenerModifPresEditMod($('#idmodedit').val());
                        } else {
                            //redirect('/presupuesto/gestion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });

                        }
                    }

                });

        }
    })


}

function obtenerEspecificasMetaIdincedit(idmeta, idesp) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var select = $('#esgaincedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['eGId'].toString() === idesp.toString()) {
                        htmla = '<option value="' + data[i]['mEGId'] + '" selected>' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';

                    }
                    html = html + htmla;


                }
                select.append(html);
            }

        });
}

$('#metaincedit').on('change', function () {
    obtenerEspecificasMetaIdDIncEditActu(this.value);
});


function obtenerEspecificasMetaIdDIncEditActu(idmeta) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var select = $('#esgaincedit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}


function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#nrrj').val() !== '0') {
        validarCaja('nrrj', 'validarnrrj', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione una Rj';
        validarCaja('nrrj', 'validarnrrj', text, 0);
    }
    if ($('#meta').val() !== '0') {
        validarCaja('meta', 'validmeta', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione una meta';
        validarCaja('meta', 'validmeta', text, 0);
    }
    if ($('#esga').val() !== '0') {
        validarCaja('esga', 'validaresga', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione una especifica';
        validarCaja('esga', 'validaresga', text, 0);
    }

    if ($('#monme').val() !== '') {
        validarCaja('monme', 'validqeqweqwemonme', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese un monto';
        validarCaja('monme', 'validqeqweqwemonme', text, 0);
    }
    if (presupuestos.length !== 0) {
    } else {
        cont++;
        text = inicio + ' ingrese presupuesto';
        validarCaja('monme', 'validmonme', text, 0);
    }

    return cont;
}

//FUNCION PARA VALIDAR EL FORMULARIO AGREGAR MODIFICACION PRESUPUESTAL
function validarFormularioMod() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#nnota').val() !== '') {
        validarCaja('nnota', 'validarnnota', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese un numero de Nota';
        validarCaja('nnota', 'validarnnota', text, 0);
    }
    if ($('#ndoc').val() !== '') {
        validarCaja('ndoc', 'validarndoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Numero de documento';
        validarCaja('ndoc', 'validarndoc', text, 0);
    }
    if ($('#tipmod').val() !== '') {
        validarCaja('tipmod', 'validartipmod', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Tipo de Modificación';
        validarCaja('tipmod', 'validartipmod', text, 0);
    }


    if ($('#sustn').val() !== '') {
        validarCaja('sustn', 'validarsustn', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese un sustento';
        validarCaja('sustn', 'validarsustn', text, 0);
    }

    if ($('#fecpre').val() !== '') {
        validarCaja('fecpre', 'validarfecpre', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese fecha';
        validarCaja('fecpre', 'validarfecpre', text, 0);
    }

    if ($('#nrrjmod').val() !== '0') {
        validarCaja('nrrjmod', 'validarnrrjmod', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione una Rj';
        validarCaja('nrrjmod', 'validarnrrjmod', text, 0);
    }


    return cont;
}

//FUNCION PARA VALIDAR ORIGEN AGREGAR MODIFICACION PRESUPUESTAL
function validarOrigenMod() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#meo').val() !== '0') {
        validarCaja('meo', 'validarmeo', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta de Origen';
        validarCaja('meo', 'validarmeo', text, 0);
    }
    if ($('#ego').val() !== '0') {
        validarCaja('ego', 'validarego', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Especifica de Gasto de Origen';
        validarCaja('ego', 'validarego', text, 0);
    }
    if ($('#montnm').val() > 0) {
        validarCaja('montnm', 'validarmontnm', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese monto mayor a 0';
        validarCaja('montnm', 'validarmontnm', text, 0);
    }
    return cont;
}

//FUNCION PARA VALIDAR DESTINO AGREGAR MODIFICACION PRESUPUESTAL
function validarDestinoMod() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#med').val() !== '0') {
        validarCaja('med', 'validarmed', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta de Destino';
        validarCaja('med', 'validarmed', text, 0);
    }
    if ($('#egd').val() !== '0') {
        validarCaja('egd', 'validaregd', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Especifica de Gasto de Destino';
        validarCaja('egd', 'validaregd', text, 0);
    }
    if ($('#montd').val() > 0) {
        validarCaja('montd', 'validarmontd', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese monto mayor a 0';
        validarCaja('montd', 'validarmontd', text, 0);
    }
    return cont;
}


//FUNCION PARA VALIDAR EL FORMULARIO EDITAR MODIFICACION PRESUPUESTAL
function validarFormularioModEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#nnotaedit').val() !== '') {
        validarCaja('nnotaedit', 'validarnnotaedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese un numero de Nota';
        validarCaja('nnotaedit', 'validarnnotaedit', text, 0);
    }
    if ($('#ndocedit').val() !== '') {
        validarCaja('ndocedit', 'validarndocedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Numero de documento';
        validarCaja('ndoc', 'validarndoc', text, 0);
    }
    if ($('#tipmodedit').val() !== '') {
        validarCaja('tipmodedit', 'validartipmodedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Tipo de Modificación';
        validarCaja('tipmodedit', 'validartipmodedit', text, 0);
    }


    if ($('#sustnedit').val() !== '') {
        validarCaja('sustnedit', 'validarsustnedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese un sustento';
        validarCaja('sustnedit', 'validarsustnedit', text, 0);
    }

    if ($('#fecpreedit').val() !== '') {
        validarCaja('fecpreedit', 'validarfecpreedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese fecha';
        validarCaja('fecpreedit', 'validarfecpreedit', text, 0);
    }

    if ($('#nrrjmodedit').val() !== '0') {
        validarCaja('nrrjmodedit', 'validarnrrjmodedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione una Rj';
        validarCaja('nrrjmodedit', 'validarnrrjmodedit', text, 0);
    }


    return cont;
}

//FUNCION PARA VALIDAR ORIGEN EDITAR MODIFICACION PRESUPUESTAL
function validarOrigenModEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#metamodedit').val() !== '0') {
        validarCaja('metamodedit', 'validarmetamodedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta de Origen';
        validarCaja('metamodedit', 'validarmetamodedit', text, 0);
    }
    if ($('#egoedit').val() !== '0') {
        validarCaja('egoedit', 'validaregoedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Especifica de Gasto de Origen';
        validarCaja('egoedit', 'validaregoedit', text, 0);
    }
    if ($('#montnmedit').val() > 0) {
        validarCaja('montnmedit', 'validarmontnmedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese monto mayor a 0';
        validarCaja('montnmedit', 'validarmontnmedit', text, 0);
    }
    return cont;
}

function valnota() {
    var not = $('#nnota').val();
    var url = "/presupuesto/validarnNota/" + not;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['not'];
                    if (result.length > 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La nota modificatoria ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('nnota', 'validarnnota', 'La nota modificatoria ya fue registrado', 0);

                    } else {
                        validarCaja('nnota', 'validarnnota', 'Nota modificatoria correcto', 1);
                        $('#enviarnot').prop("disabled", false);
                    }
                }

            }, beforeSend() {
                $('#enviarnot').prop("disabled", true);
            }

        });
}

//FUNCION PARA VALIDAR DESTINO EDITAR MODIFICACION PRESUPUESTAL
function validarDestinoModEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#mededit').val() !== '0') {
        validarCaja('mededit', 'validarmededit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta de Destino';
        validarCaja('mededit', 'validarmededit', text, 0);
    }
    if ($('#egdedit').val() !== '0') {
        validarCaja('egdedit', 'validaregdedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Especifica de Gasto de Destino';
        validarCaja('egdedit', 'validaregdedit', text, 0);
    }
    if ($('#montdedit').val() > 0) {
        validarCaja('montdedit', 'validarmontdedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese monto mayor a 0';
        validarCaja('montdedit', 'validarmontdedit', text, 0);
    }
    return cont;
}

function validarPres() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#meta').val() !== '0') {
        validarCaja('meta', 'validmeta', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta';
        validarCaja('meta', 'validmeta', text, 0);
    }
    if ($('#esga').val() !== '0') {
        validarCaja('esga', 'validaresga', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Especifica de Gasto';
        validarCaja('esga', 'validaresga', text, 0);
    }
    if ($('#monme').val() > 0 && $('#monme').val() !== '') {
        validarCaja('monme', 'validmonme', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese monto mayor a 0';
        validarCaja('monme', 'validmonme', text, 0);
    }
    return cont;
}
