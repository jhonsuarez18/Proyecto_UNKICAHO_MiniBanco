var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var combustibles = [];
var combustibless = [];
var combustiblesver = [];
var combustiblesedit = [];
var combustibleseditOrig = [];
var combustibleseditfin = [];
var camposadd = [];

function camposOrdenAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "oca";
    tablacampos[1] = "validoca";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "fufi";
    tablacampos[1] = "validfufi";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "ticom";
    tablacampos[1] = "validticom";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "cant";
    tablacampos[1] = "validcant";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "numfact";
    tablacampos[1] = "valnumfact";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "grifo";
    tablacampos[1] = "valgrifo";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);

    $('#enviaroc').prop("disabled", false);
}

function camposOrdenEdit() {
    var tablacampos = new Array();
    tablacampos[0] = "ocaedit";
    tablacampos[1] = "validocaedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "fufiedit";
    tablacampos[1] = "validfufiedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "ticomedit";
    tablacampos[1] = "validticomedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "cantedit";
    tablacampos[1] = "validcantedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "numfactedit";
    tablacampos[1] = "valnumfactedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "grifoedit";
    tablacampos[1] = "valgrifoedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);

    $('#enviarocedit').prop("disabled", false);
}

$(document).ready(function () {
    tablaordencompra();
});
$('#addordenc').on('click', function () {
    //  window.event.preventDefault();
    $('#modal-dialog_add_oc').modal({show: true, backdrop: 'static', keyboard: false});
    fuentefinanciamiento('fufi', 0);
    cagarTipoComb('ticom');
    camposadd = [];
    combustibles = [];
    //tablaitem();
    tablacombus();
    camposOrdenAdd();
    Grifos('grifo',0);
});

function tablaitem() {
    event.preventDefault();
    var datatable = $('#tab_combu');
    datatable.DataTable().destroy();
    datatable.dataTable({
        columnDefs: [
            {"targets": 0, "width": "40%", "className": "text-center"},
            {"targets": 1, "width": "40%", "className": "text-center"},
            {"targets": 2, "width": "20%", "className": "text-center"},
        ],
    });
}

function tablaordencompra() {
    $('#tabla_oc').DataTable({
        ajax: '/combustible/getordcs',
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

        ],
        columns: [
            {data: 'oNumOC', name: 'oNumOC'},
            {data: 'fFdesc', name: 'fFdesc'},
            {data: 'oCNumFact', name: 'oCNumFact'},
            {data: 'gDesc', name: 'gDesc'},
            {data: 'oCFecCrea', name: 'oCFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.oCEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.oCEst) === 1 && parseInt(row.oCEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalVerOrdC(' + row.oCId + ')" TITLE="Ver orden de compra" >\n' +
                            '<i class="text-orange far fa-lg fa-fw m-r-10 fa-eye"> </i></a>' +
                            '<a href="#"  onclick="abrilModalEdOrdC(' + row.oCId + ')" TITLE="Editar Orden de compra" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Orden de compra" onclick="eliminarOrdenCompra(' + row.oCId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalVerOrdC(' + row.oCId + ')" TITLE="Ver orden de compra" >\n' +
                            '<i class="text-orange far fa-lg fa-fw m-r-10 fa-eye"> </i></a>' +
                            '<a href="#" style="color: green" TITLE="Restaurar orden de compra"  onclick="eliminarOrdenCompra(' + row.oCId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function abrilModalVerOrdC(idoc) {
    window.event.preventDefault();
    $('#modal-dialog_ver_oc').modal('show');
    obtenerVerOrdenC(idoc);
    combustiblesver = [];
}

function abrilModalEdOrdC(idoc) {
    window.event.preventDefault();
    $('#modal-dialog_edit_oc').modal('show');
    obtenerEditarOrdenC(idoc);
    cagarTipoComb('ticomedit');
    combustiblesedit = [];
    combustibleseditOrig = [];
    camposadd = [];
    camposOrdenEdit();
}

function obtenerVerOrdenC(idoc) {
    var url = "/combustible/getOrdCEdit/" + idoc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var ordc = data['ordc'];
                    $('#idordcver').val(ordc['oCId']);
                    $('#ocaver').val(ordc['oNumOC']);
                    $('#numfactver').val(ordc['oCNumFact']);
                    Grifos('grifover',ordc['gId']);
                    fuentefinanciamiento('fufiver', ordc['fFId']);
                    obtenerVerOrdenComb(ordc['oCId'], ordc['oCEst']);
                } else {

                }

            }

        });
}

function obtenerEditarOrdenC(idoc) {
    var url = "/combustible/getOrdCEdit/" + idoc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var ordc = data['ordc'];
                    $('#idordcedit').val(ordc['oCId']);
                    $('#ocaedit').val(ordc['oNumOC']);
                    $('#numocedit').val(ordc['oNumOC']);
                    $('#numfactedit').val(ordc['oCNumFact']);
                    Grifos('grifoedit',ordc['gId']);
                    fuentefinanciamiento('fufiedit', ordc['fFId']);
                    obtenerOrdenComb(ordc['oCId']);
                    $('#ocaedit').focus();
                } else {

                }

            }

        });
}

function obtenerVerOrdenComb(idoc, rest) {
    var url = "/combustible/getOrdComb/" + idoc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var ordcomb = data['ordcomb'];
                    for (var i = 0; i < ordcomb.length; i++) {
                        var idtc = ordcomb[i]['tCId'];
                        var cant = ordcomb[i]['cOTCant'];
                        var tcdes = ordcomb[i]['tCDesc'];
                        if (rest == 0 && ordcomb[i]['cOTEst'] == 0) {
                            var combustver = new Array();
                            combustver[0] = tcdes;
                            combustver[1] = idtc;
                            combustver[2] = cant;
                            combustiblesver.push(combustver);
                        } else {
                            if (rest == 1 && ordcomb[i]['cOTEst'] == 1) {
                                var combustver = new Array();
                                combustver[0] = tcdes;
                                combustver[1] = idtc;
                                combustver[2] = cant;
                                combustiblesver.push(combustver);
                            }
                        }
                    }
                    tablacombusver();

                } else {

                }

            }

        });
}

function obtenerOrdenComb(idoc) {
    var url = "/combustible/getOrdComb/" + idoc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var ordcomb = data['ordcomb'];
                    for (var i = 0; i < ordcomb.length; i++) {
                        if (ordcomb[i]['cOTEst'] == 1) {
                            var idtc = ordcomb[i]['tCId'];
                            var cant = ordcomb[i]['cOTCant'];
                            var tcdes = ordcomb[i]['tCDesc'];
                            var estc = 0;
                            var cotid = ordcomb[i]['cOTId'];
                            var combustedit = new Array();
                            combustedit['text'] = tcdes;
                            combustedit['id'] = idtc;
                            combustedit['cant'] = parseInt(cant);
                            combustedit['estc'] = estc;
                            combustedit['idodc'] = cotid;
                            combustiblesedit.push(combustedit);
                            combustibleseditOrig.push(combustedit);
                        }
                    }
                    tablacombusedit();

                } else {

                }

            }

        });
}

function eliminarOrdenCompra(idoc) {
    var url = "/combustible/deleteOrdC/" + idoc;
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
                            tablaordencompra();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Orden Compra eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaordencompra();
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

function fuentefinanciamiento(val, idfufi) {
    var url = "/presupuesto/obtenerfuentefinaciamiento";
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
                    if (data[i]['fFId'].toString() === idfufi.toString()) {
                        htmla = '<option value="' + data[i]['fFId'] + '" selected>' + data[i]['fFdesc'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + data[i]['fFId'] + '">' + data[i]['fFdesc'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function cagarTipoComb(val) {
    var url = "/combustible/getticomb";
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
                    htmla = '<option value="' + data[i]['tCId'] + '">' + data[i]['tCDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
$('#fufi').on('change',function(){
    $('#numfact').focus();
})
$('#grifo').on('change',function(){
    $('#ticom').focus();
})
$('#ticom').on('change',function(){
    $('#cant').focus();
})
$('#addcom').on('click', function () {
    event.preventDefault();
    if (validarMontoTip() === 0) {
        var textcom = $('#ticom').children("option:selected").text();
        var idcom = $('#ticom').children("option:selected").val();
        var cant = $('#cant').val();

        var combustible = new Array();
        combustible['text'] = textcom;
        combustible['id'] = parseInt(idcom);
        combustible['cant'] = parseInt(cant);
        var ubi = 0;
        for (var i = 0; i < combustibles.length; i++) {
            if (parseInt(combustibles[i]['id'])=== parseInt(combustible['id'])) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            combustibles.push(combustible);
        }

        tablacombus();
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
$('#addcomedit').on('click', function () {
    event.preventDefault();
    if (validarMontoTipEdit() === 0) {
        var textcom = $('#ticomedit').children("option:selected").text();
        var idcom = $('#ticomedit').children("option:selected").val();
        var cant = $('#cantedit').val();

        var combustible = new Array();
        combustible['text'] = textcom;
        combustible['id'] = parseInt(idcom);
        combustible['cant'] = parseInt(cant);
        combustible['estc'] = 2;
        combustible['idodc'] = 0;
        var ubi = 0;
        for (var i = 0; i < combustiblesedit.length; i++) {
            if (combustiblesedit[i]['id'] === combustible['id']) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            combustiblesedit.push(combustible);
        }

        tablacombusedit();
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

function validarOCExp() {
    var expres = /^[0-9]{7}$/;
    var oc = $('#oca');
    if (expres.test(oc.val())) {
        return true;
    } else {
        $('#oca').val(pad_with_zeroes(parseInt(oc.val()), 7));
        return true;
    }
}

function validarMontoTip() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#ticom').val() !== '0') {
        validarCaja('ticom', 'validticom', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione tipo de combustible';
        validarCaja('ticom', 'validticom', text, 0);
    }
    if ($('#cant').val() !== '') {
        validarCaja('cant', 'validcant', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingre cantidad';
        validarCaja('cant', 'validcant', text, 0);
    }
    return cont;
}

function validarMontoTipEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#ticomedit').val() !== '0') {
        validarCaja('ticomedit', 'validticomedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione tipo de combustible';
        validarCaja('ticomedit', 'validticomedit', text, 0);
    }
    if ($('#cantedit').val() !== '') {
        validarCaja('cantedit', 'validcantedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingre cantidad';
        validarCaja('cantedit', 'validcantedit', text, 0);
    }
    return cont;
}

function tablacombus() {
    event.preventDefault();
    var datatable = $('#tab_combu');
    datatable.DataTable().destroy();
    datatable.DataTable({

            data: combustibles,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['cant']);
                }
                $('#totalmonorig').val(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "40%", "className": "text-left"},
                {"targets": 1, "width": "40%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
            ],
            columns: [
                {data: 'text', name: 'text'},
                {data: 'cant', name: 'cant'},
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Quitar combustible" onclick="quitarCombOC(' + row.id + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

function quitarCombOC(idoc) {
    var ubi = null;
    for (var i = 0; i < combustibles.length; i++) {
        if (combustibles[i]['id'] === idoc) {
            ubi = i;
        }
    }
    combustibles.splice(ubi, 1);
    tablacombus();
}

function tablacombusver() {
    var datatable = $('#tab_combu_ver');
    datatable.DataTable().destroy();
    datatable.DataTable({

            data: combustiblesver,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i][2]);
                }
                $('#totalmonorig').val(totalAmount);
                $(this.api().column(1).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "40%", "className": "text-left"},
                {"targets": 1, "width": "40%", "className": "text-center"},
            ],
            columns: [
                {data: 0, name: 0},
                {data: 2, name: 2}
            ]
        }
    );
}

function tablacombusedit() {
    var datatable = $('#tab_combu_edit');
    datatable.DataTable().destroy();
    datatable.DataTable({

            data: combustiblesedit,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['cant']);
                }
                $('#totalmonorig').val(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "40%", "className": "text-left"},
                {"targets": 1, "width": "40%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
            ],
            columns: [
                {data: 'text', name: 'text'},
                {data: 'cant', name: 'cant'},
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Quitar combustible" onclick="quitarCombOCEdit(' + row.id + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

function quitarCombOCEdit(idoc) {
    var ubi = null;
    for (var i = 0; i < combustiblesedit.length; i++) {
        if (combustiblesedit[i]['id'] === idoc) {
            ubi = i;
        }
    }
    combustiblesedit.splice(ubi, 1);
    tablacombusedit();
}

$('#enviaroc').on('click', function () {
    combustibless = [];
    for (var i = 0; i < combustibles.length; i++) {
        var combustible = new Array();
        combustible[0] = combustibles[i]['text'];
        combustible[1] = combustibles[i]['id'];
        combustible[2] = combustibles[i]['cant'];
        combustibless.push(combustible);
    }
    event.preventDefault();
    if (validarFormulario() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara una nueva orden de compra',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                var numoc = $('#oca').val();
                var idfufi = $('#fufi').val();
                var numfact = $('#numfact').val();
                var idgrifo = $('#grifo').val();

                json = JSON.stringify(combustibless);
                $.ajax({
                    url: '/combustible/storeoc',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        numoc: numoc,
                        idfufi: idfufi,
                        numfact: numfact,
                        idgrif: idgrifo,
                        combus: json
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de orden de compra exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal-dialog_add_oc')
                                tablaordencompra();
                                combustibles = [];
                                camposadd = [];
                                tablacombus();
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
                                closeModal('modal-dialog_add_oc')
                                tablaordencompra();
                                combustibles = [];
                                camposadd = [];
                                tablacombus();

                            }
                        },
                    beforeSend: function () {
                        $('#enviaroc').prop("disabled", true);
                    }
                });

            }
        });
    } else {
        operacionSubsanar();
    }
});
$('#enviarocedit').on('click', function () {
    combustibleseditfin = [];
    getcombusteliminado();
    if (validarFormularioEdit() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se registrara una referencia',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                if (combustiblesedit.length === 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'atencion!',
                        text: 'Agregue Combustible a la Orden de compra',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#enviaredit').prop("disabled", true);

                } else {

                    let idoc = $('#idordcedit').val();
                    var numoc = $('#ocaedit').val();
                    var idfufi = $('#fufiedit').val();
                    var numfact = $('#numfactedit').val();
                    var idgrifo = $('#grifoedit').val();
                    json = JSON.stringify(combustibleseditfin);
                    $.ajax({
                        url: '/combustible/editOrdC',
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            idoc: idoc,
                            numoc: numoc,
                            idfufi: idfufi,
                            numfact: numfact,
                            idgrif: idgrifo,
                            combus: json,

                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Orden de compra editado exitosamente',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    limpiarCaja(camposadd);
                                    closeModal('modal-dialog_edit_oc')
                                    tablaordencompra();
                                    combustiblesedit = [];
                                    camposadd = [];
                                    tablacombusedit();
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 5000
                                    });
                                    limpiarCaja(camposadd);
                                    closeModal('modal-dialog_edit_oc')
                                    tablaordencompra();
                                    combustiblesedit = [];
                                    camposadd = [];
                                    tablacombusedit();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviaredit').prop("disabled", true);
                        }
                    });
                }

            }
        });
    } else {
        operacionSubsanar();
    }
});

//mostrar quienes han sido eliminados
function getcombusteliminado() {
    for (var i = 0; i < combustibleseditOrig.length; i++) {
        var cnt = 0;
        for (var b = 0; b < combustiblesedit.length; b++) {
            if (combustibleseditOrig[i]['id'] == combustiblesedit[b]['id']) {
                var tablapersonalfin = new Array();
                tablapersonalfin[0] = combustiblesedit[b]['text'];
                tablapersonalfin[1] = combustiblesedit[b]['id'];
                tablapersonalfin[2] = combustiblesedit[b]['cant'];
                tablapersonalfin[3] = 1;
                tablapersonalfin[4] = combustibleseditOrig[i]['idodc'];
                combustibleseditfin.push(tablapersonalfin)
            } else {
                cnt = cnt + 1;
                if (cnt == combustiblesedit.length) {
                    var tablapersonalfin = new Array();
                    tablapersonalfin[0] = combustibleseditOrig[i]['text'];
                    tablapersonalfin[1] = combustibleseditOrig[i]['id'];
                    tablapersonalfin[2] = combustibleseditOrig[i]['cant'];
                    tablapersonalfin[3] = combustibleseditOrig[i]['estc'];
                    tablapersonalfin[4] = combustibleseditOrig[i]['idodc'];
                    combustibleseditfin.push(tablapersonalfin)
                    if (combustiblesedit[b]['estc'] == 2 && i == 0) {
                        var tablapersonalfin = new Array();
                        tablapersonalfin[0] = combustiblesedit[b]['text'];
                        tablapersonalfin[1] = combustiblesedit[b]['id'];
                        tablapersonalfin[2] = combustiblesedit[b]['cant'];
                        tablapersonalfin[3] = combustiblesedit[b]['estc'];
                        tablapersonalfin[4] = 0;
                        combustibleseditfin.push(tablapersonalfin)
                    }
                } else {
                    if (combustiblesedit[b]['estc'] == 2 && i == 0) {
                        var tablapersonalfin = new Array();
                        tablapersonalfin[0] = combustiblesedit[b]['text'];
                        tablapersonalfin[1] = combustiblesedit[b]['id'];
                        tablapersonalfin[2] = combustiblesedit[b]['cant'];
                        tablapersonalfin[3] = combustiblesedit[b]['estc'];
                        tablapersonalfin[4] = 0;
                        combustibleseditfin.push(tablapersonalfin)
                    }
                }
            }
        }
    }
}

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#oca').val() !== ' ') {
        text = '';
        validarCaja('oca', 'validoca', text, 1);
    } else {
        cont++;
        text = inicio + ' ingrese numero de orden de compra';
        validarCaja('oca', 'validnoca', text, 0);
    }
    if ($('#fufi').val() !== '0') {
        text = '';
        validarCaja('fufi', 'validfufi', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione una fuente de financiamiento';
        validarCaja('fufi', 'validfufi', text, 0);
    }
    if ($('#numfact').val() !== '') {
        text = '';
        validarCaja('numfact', 'valnumfact', text, 1);
    } else {
        cont++;
        text = inicio + ' Ingrese numero de factura';
        validarCaja('numfact', 'valnumfact', text, 0);
    }
    if ($('#grifo').val() !== '0') {
        text = '';
        validarCaja('grifo', 'valgrifo', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione una grifo';
        validarCaja('grifo', 'valgrifo', text, 0);
    }
    if (combustibles.length !== 0) {
        validarCaja('cant', 'validcant', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingre cantidad';
        validarCaja('cant', 'validcant', text, 0);
    }
    return cont;
}

function validarFormularioEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#ocaedit').val() !== ' ') {
        text = '';
        validarCaja('ocaedit', 'validocaedit', text, 1);
    } else {
        cont++;
        text = inicio + ' ingrese numero de orden de compra';
        validarCaja('ocaedit', 'validnocaedit', text, 0);
    }
    if ($('#fufiedit').val() !== '0') {
        text = '';
        validarCaja('fufiedit', 'validfufiedit', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione una fuente de financiamiento';
        validarCaja('fufiedit', 'validfufiedit', text, 0);
    }
    if ($('#numfactedit').val() !== '') {
        text = '';
        validarCaja('numfactedit', 'valnumfactedit', text, 1);
    } else {
        cont++;
        text = inicio + ' Ingrese numero de factura';
        validarCaja('numfactedit', 'valnumfactedit', text, 0);
    }
    if ($('#grifoedit').val() !== '0') {
        text = '';
        validarCaja('grifoedit', 'valgrifoedit', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione una grifo';
        validarCaja('grifoedit', 'valgrifoedit', text, 0);
    }
    if (combustiblesedit.length !== 0) {
        validarCaja('cantedit', 'validcantedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingre cantidad';
        validarCaja('cantedit', 'validcantedit', text, 0);
    }
    return cont;
}

function valNumOC() {
    if (validarOCExp()) {
        var val = $('#oca').val();
        var url = "/combustible/getvalNumOc/" + val;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        var result = data['ordc'];
                        if (result.length > 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'Numero de orden de compra ya esta registrada',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            validarCaja('oca', 'validoca', 'El numero de orden de compra ya fue registrado', 0);
                            $('#oca').val(val);
                        } else {
                            validarCaja('oca', 'validoca', 'Nro de orden de compra correcto', 1);
                            $('#enviaroc').prop("disabled", false);
                            $('#oca').val(val);
                        }
                    }

                }, beforeSend() {
                    $('#enviaroc').prop("disabled", true);
                }

            });
    }
}

function valNumOCEdit() {
    var val = $('#ocaedit').val();
    var url = "/combustible/getvalNumOc/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['ordc'];
                    if (result.length > 0) {
                        if (result[0]['oNumOC'] === $('#numocedit').val()) {
                            validarCaja('ocaedit', 'validocaedit', 'Nro de orden de compra correcto', 1);
                            $('#enviarocedit').prop("disabled", false);
                            $('#ocaedit').val(val);
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'Numero de orden de compra ya esta registrada',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            validarCaja('ocaedit', 'validocaedit', 'El numero de orden de compra ya fue registrado', 0);
                            $('#ocaedit').val(val);
                        }

                    } else {
                        validarCaja('ocaedit', 'validocaedit', 'Nro de orden de compra correcto', 1);
                        $('#enviarocedit').prop("disabled", false);
                        $('#ocaedit').val(val);
                    }
                }

            }, beforeSend() {
                $('#enviarocedit').prop("disabled", true);
            }

        });
}
function Grifos(val, idgf) {
    var url = "/combustible/getGrifAct";
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
                var grifos = data['grif'];
                var htmla = '';
                for (var i = 0; i < grifos.length; i++) {
                    if (grifos[i]['gId'].toString() === idgf.toString()) {
                        htmla = '<option value="' + grifos[i]['gId'] + '" selected>' + grifos[i]['gRuc'] + ' | ' + grifos[i]['gDesc'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + grifos[i]['gId'] + '">' + grifos[i]['gRuc'] + ' | ' + grifos[i]['gDesc'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}
