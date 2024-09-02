var camposadd = [];
$('#addstock').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_stock').modal({show: true, backdrop: 'static', keyboard: false});
    OrdenCompra('numoc', 0);
    Metas('meta', 0);
    camposadd = [];
    camposStockAdd();
    $('#itemcom').prop('disabled',true);
});

$('#numoc').on('change', function () {
    $('#itemcom').prop('disabled',false);
    OrdenCompraCombus('itemcom', this.value, 0);
    $('#itemcom').focus();
});
$('#itemcom').on('change', function () {
    SaldoCombus('saldostk', this.value);
    $('#meta').focus();
});
$('#meta').on('change', function () {
    $('#cantidadstk').focus();
});
$('#numocedit').on('change', function () {
    OrdenCompraCombus('itemcomedit', this.value, 0);
});
$('#itemcomedit').on('change', function () {
    SaldoCombusEdit('saldostkedit', this.value, 1);
});

function camposStockAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "numoc";
    tablacampos[1] = "valnumoc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "itemcom";
    tablacampos[1] = "valitemcom";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "saldostk";
    tablacampos[1] = "valsaldostk";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "meta";
    tablacampos[1] = "valmeta";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "cantidadstk";
    tablacampos[1] = "valcantidadstk";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarstock').prop("disabled", false);
}

function camposStockEdit() {
    var tablacampos = new Array();
    tablacampos[0] = "numocedit";
    tablacampos[1] = "valnumocedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "itemcomedit";
    tablacampos[1] = "valitemcomedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "saldostkedit";
    tablacampos[1] = "valsaldostkedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "metaedit";
    tablacampos[1] = "valmetaedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "cantidadstkedit";
    tablacampos[1] = "valcantidadstkedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviareditstock').prop("disabled", false);
}

function OrdenCompra(val, idoc) {
    var url = "/combustible/getOrdCAct";
    var arreglo;
    var select = $('#' + val).html('');
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
                    if (data[i]['oCId'].toString() === idoc.toString()) {
                        htmla = '<option value="' + data[i]['oCId'] + '" selected>' + data[i]['oNumOC'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + data[i]['oCId'] + '">' + data[i]['oNumOC'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function Metas(val, idmeg) {
    var url = "/combustible/getMetEGC";
    var arreglo;
    var select = $('#' + val).html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var megc = data['megc'];
                var htmla = '';
                for (var i = 0; i < megc.length; i++) {
                    if (megc[i]['mEGId'].toString() === idmeg.toString()) {
                        htmla = '<option value="' + megc[i]['mEGId'] + '" selected>' + megc[i]['mCod'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + megc[i]['mEGId'] + '">' + megc[i]['mCod'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function OrdenCompraCombus(val, idoc, idodc) {
    var url = "/combustible/getOrdComb/" + idoc;
    var arreglo;
    var select = $('#' + val).html('');
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
                var ordcom = data['ordcomb'];
                for (var i = 0; i < ordcom.length; i++) {
                    if (ordcom[i]['cOTEst'] === 1) {

                        if (ordcom[i]['cOTId'].toString() === idodc.toString()) {
                            htmla = '<option value="' + ordcom[i]['cOTId'] + '" selected>' + ordcom[i]['tCDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + ordcom[i]['cOTId'] + '">' + ordcom[i]['tCDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                }
                select.append(html);
            }

        });
}

function SaldoCombus(val, idocc) {
    var url = "/combustible/getOrdC/" + idocc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var ordcom = data['ordcomb'];
                if (ordcom.length > 1) {
                    for (var i = 0; i < ordcom.length; i++) {
                        if (ordcom[i]['sald'] != null) {
                            $('#' + val).val(ordcom[i]['sald']);
                        }
                    }
                } else {
                    if (ordcom[0]['sald'] != null) {
                        $('#' + val).val(ordcom[0]['sald']);
                    } else {
                        $('#' + val).val(ordcom[0]['cOTCant']);
                    }

                }
            }

        });
}

function SaldoCombusEdit(val, idocc, lg) {
    var url = "/combustible/getOrdC/" + idocc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var ordcom = data['ordcomb'];
                if (ordcom[0]['sald'] != null) {
                    if (lg === 0) {
                        $('#' + val).val(parseFloat(ordcom[0]['sald']) + parseFloat($('#cantcedit').val()));
                    } else {
                        if ($('#idcotedit').val() === idocc) {
                            $('#' + val).val(parseFloat(ordcom[0]['sald']) + parseFloat($('#cantcedit').val()));
                        } else {
                            $('#' + val).val(ordcom[0]['sald']);
                        }
                    }

                } else {
                    $('#' + val).val(ordcom[0]['cOTCant']);
                }
            }

        });
}

$(document).ready(function () {
    tablaStock();
});

function validCant() {
    var cant = $('#cantidadstk').val();
    var saldo = $('#saldostk').val();
    if (parseFloat(cant) > parseFloat(saldo)) {
        validarCaja('cantidadstk', 'valcantidadstk', 'Ingrese una cantidad menor o igual al saldo', 0);
        $('#cantidadstk').val('');
        $('#cantidadstk').focus();
        $('#enviarstock').prop("disabled", true);
    } else {
        $('#enviarstock').focus();
        validarCaja('cantidadstk', 'valcantidadstk', 'Correcto', 1);
        $('#enviarstock').prop("disabled", false);
    }
}

function validCantEd() {
    var cant = $('#cantidadstkedit').val();
    var saldo = $('#saldostkedit').val();
    if (parseFloat(cant) > parseFloat(saldo)) {
        validarCaja('cantidadstkedit', 'valcantidadstkedit', 'Ingrese una cantidad menor o igual al saldo', 0);
        $('#cantidadstkedit').val('');
        $('#cantidadstkedit').focus();
        $('#enviareditstock').prop("disabled", true);
    } else {
        $('#enviareditstock').focus();
        validarCaja('cantidadstkedit', 'valcantidadstkedit', 'Correcto', 1);
        $('#enviareditstock').prop("disabled", false);
    }
}

function tablaStock() {
    $('#tabla_stock').DataTable({
        ajax: '/combustible/getCombs',
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
            {"targets": 0, "width": "10%", "className": "text-center"},
            {"targets": 1, "width": "30%", "className": "text-left"},
            {"targets": 2, "width": "10%", "className": "text-center"},
            {"targets": 3, "width": "10%", "className": "text-left"},
            {"targets": 4, "width": "10%", "className": "text-center"},
            {"targets": 5, "width": "10%", "className": "text-center"},
            {"targets": 6, "width": "10%", "className": "text-center"},
            {"targets": 7, "width": "10%", "className": "text-center"},
        ],
        columns: [
            {data: 'oNumOC', name: 'oNumOC'},
            {data: 'progp', name: 'progp'},
            {data: 'mCod', name: 'mCod'},
            {data: 'tCDesc', name: 'tCDesc'},
            {data: 'cStock', name: 'cStock'},
            {data: 'cons', name: 'cons'},
            {
                data: function (row) {
                    let stock = parseFloat(row.cStock);
                    let gas = parseFloat(row.cons);
                    let sal = parseFloat(stock - gas);
                    if (parseFloat(sal) >= parseFloat(stock * 0.5))
                        return '<a a href="javascript:"  data-dismiss="modal"  onclick="abrilModalVerVales(' + row.cMId + ',' + parseInt(row.oNumOC) + ')" ' +
                            'title="Click para ver Consumo" >' + '<span class="text-green-transparent-6">' + sal + '</span>' + '</a>';
                    else {
                        if (parseFloat(gas) >= parseFloat(stock * 0.2))
                            return '<a a href="javascript:"  data-dismiss="modal"  onclick="abrilModalVerVales(' + row.cMId + ',' + parseInt(row.oNumOC) + ')" ' +
                                'title="Click para ver Consumo" >' + '<span class="text-danger">' + sal + '</span>' + '</a>';
                        else {
                            return '<a a href="javascript:"  data-dismiss="modal"  onclick="abrilModalVerVales(' + row.cMId + ',' + parseInt(row.oNumOC) + ')" ' +
                                'title="Click para ver Consumo" >' + '<span class="text-yellow-50">' + sal + '</span>' + '</a>';
                        }
                    }

                }

            },
            {
                data: function (row) {
                    return parseInt(row.cMEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.cMEst) === 1 && parseInt(row.cMEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEditComb(' + row.cMId + ')" TITLE="Editar Stock Combustible" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Stock Combustible" onclick="eliminarStockComb(' + row.cMId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Stock Combustible"  onclick="eliminarStockComb(' + row.cMId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function tablaVales(idcm) {
    $('#tabla_vales').DataTable({
        ajax: '/combustible/getValesOC/'+idcm,
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
        footerCallback: function (row, data, start, end, display) {
            var totalAmount = 0;
            for (var i = 0; i < data.length; i++) {
                totalAmount += parseFloat(data[i]['cCantGal']);
            }
            $('#totalmonorig').val(totalAmount);
            $(this.api().column(5).footer()).html(totalAmount);
        },
        columnDefs: [
            {"targets": 0, "width": "10%", "className": "text-center"},
            {"targets": 1, "width": "30%", "className": "text-left"},
            {"targets": 2, "width": "10%", "className": "text-center"},
            {"targets": 3, "width": "10%", "className": "text-left"},
            {"targets": 4, "width": "10%", "className": "text-center"},
            {"targets": 5, "width": "10%", "className": "text-center"},
        ],
        columns: [
            {data: 'codcons', name: 'codcons'},
            {data: 'oCNumFact', name: 'oCNumFact'},
            {data: 'tCDesc', name: 'tCDesc'},
            {data: 'cActiv', name: 'cActiv'},
            {data: 'cFecEnt', name: 'cFecEnt'},
            {data: 'cCantGal', name: 'cCantGal'}
        ]
    });
}

function abrilModalVerVales(cmid, numoc) {
    window.event.preventDefault();
    $('#modal_dialog_vales_cons').modal('show');
    var pad = "0000000";
    var n = numoc;
    var result = (pad+n).slice(-pad.length);
    $('#numocv').val(result);
    tablaVales(cmid);

}

function eliminarStockComb(idstc) {
    var url = "/combustible/deleteComb/" + idstc;
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
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'JSON',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            tablaStock();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Stock Combustible eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaStock();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 4000
                            });

                        }
                    }

                });
        }
    })
}

function abrilModalEditComb(idcomb) {
    window.event.preventDefault();
    $('#modal_dialog_edit_stock').modal('show');
    obtenerEditCombus(idcomb);
    camposadd = [];
    camposStockEdit();
}

function obtenerEditCombus(idcomb) {
    var url = "/combustible/getCombEdit/" + idcomb;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var comb = data['comb'];
                    $('#idstkcomb').val(comb[0]['cMId']);
                    OrdenCompra('numocedit', comb[0]['oCId']);
                    OrdenCompraCombus('itemcomedit', comb[0]['oCId'], comb[0]['cOTId']);
                    Metas('metaedit', comb[0]['mEGId']);
                    $('#cantidadstkedit').val(comb[0]['cStock']);
                    $('#cantcedit').val(comb[0]['cStock']);
                    $('#idcotedit').val(comb[0]['cOTId']);
                    SaldoCombusEdit('saldostkedit', comb[0]['cOTId'], 0);
                } else {

                }

            }

        });
}

function enviarStock() {
    if (validarFormularioCombus() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara un nuevo registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                var idcot = $('#itemcom').val();
                var idmeg = $('#meta').val();
                var stock = $('#cantidadstk').val();
                $.ajax({
                    url: '/combustible/storeComb',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idcot: idcot,
                        idmeg: idmeg,
                        stock: stock,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Stock Combustible exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_stock')
                                tablaStock();
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
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_stock')
                                tablaStock();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarstock').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarEditStock() {
    if (validarFormularioCombusEdit() === 0) {
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
                var idcomb = $('#idstkcomb').val();
                var idcot = $('#itemcomedit').val();
                var idmeg = $('#metaedit').val();
                var stock = $('#cantidadstkedit').val();

                $.ajax({
                    url: '/combustible/editComb',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idcomb: idcomb,
                        idcot: idcot,
                        idmeg: idmeg,
                        stock: stock,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Stock Combustible Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_edit_stock')
                                tablaStock();
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
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_edit_stock')
                                tablaStock();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviareditstock').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }

}

function validarFormularioCombus() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#numoc').val() !== '0') {
        validarCaja('numoc', 'valnumoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Orden de Compra';
        validarCaja('numoc', 'valnumoc', text, 0);
    }
    if ($('#itemcom').val() !== '0') {
        validarCaja('itemcom', 'valitemcom', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Item';
        validarCaja('itemcom', 'valitemcom', text, 0);
    }
    if ($('#meta').val() !== '0') {
        validarCaja('meta', 'valmeta', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta';
        validarCaja('meta', 'valmeta', text, 0);
    }
    if ($('#cantidadstk').val() !== '') {
        if (parseFloat($('#cantidadstk').val()) <= parseFloat($('#saldostk').val())) {
            validarCaja('cantidadstk', 'valcantidadstk', 'Correcto', 1);
        } else {
            cont++;
            text = inicio + ' Ingrese Una cantidad valida';
            validarCaja('cantidadstk', 'valcantidadstk', text, 0);
        }
    } else {
        cont++;
        text = inicio + ' Ingrese Cantidad';
        validarCaja('cantidadstk', 'valcantidadstk', text, 0);
    }
    return cont;
}

function validarFormularioCombusEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#numocedit').val() !== '0') {
        validarCaja('numocedit', 'valnumocedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Orden de Compra';
        validarCaja('numocedit', 'valnumocedit', text, 0);
    }
    if ($('#itemcomedit').val() !== '0') {
        validarCaja('itemcomedit', 'valitemcomedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Item';
        validarCaja('itemcomedit', 'valitemcomedit', text, 0);
    }
    if ($('#metaedit').val() !== '0') {
        validarCaja('metaedit', 'valmetaedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta';
        validarCaja('metaedit', 'valmetaedit', text, 0);
    }
    if ($('#cantidadstkedit').val() !== '') {
        if (parseFloat($('#cantidadstkedit').val()) <= parseFloat($('#saldostkedit').val())) {
            validarCaja('cantidadstkedit', 'valcantidadstkedit', 'Correcto', 1);
        } else {
            cont++;
            text = inicio + ' Ingrese Una cantidad valida';
            validarCaja('cantidadstkedit', 'valcantidadstkedit', text, 0);
        }
    } else {
        cont++;
        text = inicio + ' Ingrese Cantidad';
        validarCaja('cantidadstkedit', 'valcantidadstkedit', text, 0);
    }
    return cont;
}
