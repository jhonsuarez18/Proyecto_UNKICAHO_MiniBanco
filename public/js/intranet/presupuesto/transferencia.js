var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var arrTecpp = [], arrMo = [], arrCon = [];
var tab = [];

$(function () {
    fuentefinanciamiento();
    $('#tabla_trans').DataTable({
            ajax: '/presupuesto/obtenertransferenciasreporte',
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
                    totalAmount += parseFloat(data[i]['trMonto']);
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 3, "width": "15%", "className": "text-center"},
                {"targets": 4, "width": "30%", "className": "text-center"},
                {"targets": 5, "width": "25%", "className": "text-center"},
            ],
            columns: [
                {data: 'trNumRj', name: 'trNumRj'},
                {data: 'trCodTrans', name: 'trCodTrans'},
                {
                    data: 'trMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {data: 'trFecCrea', name: 'trFecCrea'},
                {data: 'fFdesc', name: 'fFdesc'},
                {
                    data: function (row) {
                        if (parseInt(row.trEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="verTecho(' + row.trId + ')" TITLE="Ver techo presupuestal" >\n' +
                                '<i class="text-orange far fa-lg fa-fw m-r-10 fa-eye"> </i></a>' +
                                '<a href="#"  onclick="abrilModalEdit(' + row.trId + ')" TITLE="Editar transferencia" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar transferencia" onclick="eliminartransferencia(' + row.trId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar transferencia" onclick="eliminartransferencia(' + row.trId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }
            ]
        }
    );
});

function verTecho(trid) {
    window.event.preventDefault();
    $('#modal-dialog_ver_tec').modal({show: true, backdrop: 'static', keyboard: false});
    $('#tabla_tec_pre').DataTable({

            ajax: '/presupuesto/gettec/' + trid,
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
                var c5 = 0;
                var c6 = 0;
                var c7 = 0;
                var c8 = 0;
                var tot = 0;

                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    c5 += parseFloat(data[i]['c5']);
                    c6 += parseFloat(data[i]['c6']);
                    c7 += parseFloat(data[i]['c7']);
                    c8 += parseFloat(data[i]['c8']);
                    tot += parseFloat(data[i]['tot']);

                }
                c5 = formatter.format(c5);
                c6 = formatter.format(c6);
                c7 = formatter.format(c7);
                c8 = formatter.format(c8);
                tot = formatter.format(tot);
                $(this.api().column(1).footer()).html(c5);
                $(this.api().column(2).footer()).html(c6);
                $(this.api().column(3).footer()).html(c7);
                $(this.api().column(4).footer()).html(c8);
                $(this.api().column(5).footer()).html(tot);
            },
            columnDefs: [
                {"targets": 0, "width": "30%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
                {"targets": 3, "width": "15%", "className": "text-center"},
                {"targets": 4, "width": "15%", "className": "text-center"},
                {"targets": 5, "width": "15%", "className": "text-center"},
            ],
            columns: [
                {data: 'pPDesc', name: 'pPDesc'},
                {
                    data: 'c5',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'c6',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'c7',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'c8',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: 'tot',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },

            ]
        }
    );
}


$('#addtransf').on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_trans').modal({show: true, backdrop: 'static', keyboard: false});
    programaPresupuestal();
    concepto();
});

function ordenarTabla() {

    tab.sort(sortFunction);

    function sortFunction(a, b) {
        if (a[0] === b[0]) {
            return 0;
        } else {
            return (a[0] < b[0]) ? -1 : 1;
        }
    }
}

function abrilModalEdit(idedit) {
    window.event.preventDefault();
    $('#modal-dialog_edit').modal('show');
    cargarEditarTrans(idedit)
    programaPresupuestaled();
    conceptoed();
}


function deletetec(id, idtra) {
    event.preventDefault();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara el registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            console.log('aqui');
            $.ajax({
                url: '/presupuesto/deletetec',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Registro de techo presupuestal eliminado',
                                showConfirmButton: false,
                                timer: 6000
                            });
                            tabla_edit_tec(idtra);
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 9000
                            });

                        }
                    }
            })
            ;


        }
    })
}

$('#addtedi').on('click', function (event) {
    event.preventDefault();
    var pp = $('#propreed').val();
    var co = $('#coned').val();
    var mont = $('#montoted').val();
    var idtrans = $('#idtrans').val();

    if (pp.toString() !== '0' && co.toString() !== '0' && mont > 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se entregaran estos materiales/medicamentos ',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                console.log('aqui');
                $.ajax({
                    url: '/presupuesto/tecedit',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        pi: pp,
                        ci: co,
                        mo: mont,
                        tr: idtrans
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de techo presupuestal exitoso',
                                    showConfirmButton: false,
                                    timer: 6000
                                });
                                tabla_edit_tec(idtrans);
                                $('#addtedi').prop("disabled", false);
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    type: 'error',
                                    title: 'ocurrio un error!',
                                    text: data['error'],
                                    showConfirmButton: false,
                                    timer: 9000
                                });

                            }
                        }

                    ,
                    beforeSend: function () {
                        $('#addtedi').prop("disabled", true);
                    }
                    ,


                })
                ;


            }
        })


    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'Ingrese los valores correctos',
            showConfirmButton: false,
            timer: 3000
        });
        $('#montoted').focus();
    }


});

$('#addt').on('click', function () {
    var pp = $('#propre');
    var co = $('#con');
    var mont = $('#montot').val();

    if (pp.children("option:selected").val().toString() !== '0' && co.children("option:selected").val().toString() !== '0' && mont > 0) {

        var tabl = new Array();
        tabl["idp"] = pp.children("option:selected").val();
        tabl["textp"] = pp.children("option:selected").text();
        tabl["idc"] = co.children("option:selected").val();
        tabl["textc"] = co.children("option:selected").text();
        tabl["mont"] = mont;

        var ubi = 0;
        for (var i = 0; i < tab.length; i++) {
            if (tab[i]['idp'].toString() === tabl['idp'] && tab[i]['idc'].toString() === tabl['idc']) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            tab.push(tabl);
            if (!valTot()) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    type: 'error',
                    title: 'ocurrio un error!',
                    text: 'El techo presupuestal supera al monto de transferencia',
                    showConfirmButton: false,
                    timer: 3000
                });
                tab.pop();
                $('#montot').focus();
            }

        }


        tabcon();


    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'Ingrese los valores correctos',
            showConfirmButton: false,
            timer: 3000
        });
        $('#montot').focus();
    }


});

var valTot = function () {
    var tot = $('#monto').val();
    var res = 0, sum = 0;
    console.log(tab);
    for (var i = 0; i < tab.length; i++) {
        sum = sum + parseInt(tab[i]['mont']);
    }
    res = tot - sum;
    if (res >= 0)
        return true;
    else
        return false;

}

var valTotig = function () {
    var tot = $('#monto').val();
    var res = 0, sum = 0;
    console.log(tab);
    for (var i = 0; i < tab.length; i++) {
        sum = sum + parseInt(tab[i]['mont']);
    }
    res = tot - sum;
    if (res === 0)
        return true;
    else
        return false;

}

function tabcon() {
    ordenarTabla();
    $('#tab_tec').DataTable({
            data: tab,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },

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
                    totalAmount += parseFloat(data[i]['mont']);
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(2).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "50%", "className": "text-left"},
                {"targets": 1, "width": "30%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
                {"targets": 3, "width": "5%", "className": "text-center"},
            ],
            columns: [
                {data: 'textp', name: 'textp'},
                {data: 'textc', name: 'textc'},
                {
                    data: 'mont',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="quitar(' + row.idc + ',' + row.idp + ')" TITLE="Quitar" >\n' +
                            '<i class="text-danger fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );

}

function quitar(idc, idp) {
    var ubi = null;
    for (var i = 0; i < tab.length; i++) {
        if (tab[i]['idp'].toString() === idp.toString() && tab[i]['idc'].toString() === idc.toString()) {
            ubi = i;
        }
    }
    tab.splice(ubi, 1);
    tabcon();
}


function concepto() {
    var url = "/presupuesto/getConcepto";
    var select = $('#con').html('');
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
                    htmla = '<option value="' + data[i]['cId'] + '">' + data[i]['cDescripcion'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function conceptoed() {
    var url = "/presupuesto/getConcepto";
    var select = $('#coned').html('');
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
                    htmla = '<option value="' + data[i]['cId'] + '">' + data[i]['cDescripcion'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function programaPresupuestal() {
    var url = "/presupuesto/obtenerprogramaspresupuestales";
    var select = $('#propre').html('');
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
                    htmla = '<option value="' + data[i]['pPId'] + '">' + data[i]['pPCod'] + ' - ' + data[i]['pPDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function programaPresupuestaled() {
    var url = "/presupuesto/obtenerprogramaspresupuestales";
    var select = $('#propreed').html('');
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
                    htmla = '<option value="' + data[i]['pPId'] + '">' + data[i]['pPCod'] + ' - ' + data[i]['pPDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function tabla_edit_tec(val) {
    $('#tab_tec_edit').DataTable({

            ajax: '/presupuesto/gettecedit/' + val,
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
                var tpMonto = 0;

                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    tpMonto += parseFloat(data[i]['tpMonto']);

                }
                tpMonto = formatter.format(tpMonto);
                $(this.api().column(2).footer()).html(tpMonto);
                ;
            },
            columnDefs: [
                {"targets": 0, "width": "30%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
                {"targets": 3, "width": "15%", "className": "text-center"},
            ],
            columns: [
                {data: 'pPDesc', name: 'pPDesc'},
                {data: 'cDescripcion', name: 'cDescripcion'},
                {
                    data: 'tpMonto',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return '<tr >' +
                            '<a href="#"  onclick="deletetec(' + row.tPId + ',' + row.trId + ')" TITLE="Quitar" >' +
                            '<i class="text-danger fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>' +
                            '</tr>';

                    }
                }


            ]
        }
    );
}

function cargarEditarTrans(val) {
    var url = "/presupuesto/obtenertransferenciasedit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtrans').val(data['trId']);
                $('#numrjedt').val(data['trNumRj']);
                $('#codtraedt').val(data['trCodTrans']);
                $('#montoedt').val(data['trMonto']);
                fuentefinanciamientoEdit(data['fFId'])
                tabla_edit_tec(val);
            }

        });

}


function enviarEdit() {
    var idtrans = $('#idtrans').val();
    var numrj = $('#numrjedt').val();
    var codtra = $('#codtraedt').val();
    var monto = $('#montoedt').val();
    var fufi = $('#fufiedit').val();
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

            $.ajax({
                url: '/presupuesto/edittransferencia',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idtrans: idtrans,
                    numrj: numrj,
                    codtra: codtra,
                    monto: monto,
                    fufi: fufi,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Transferencia editada ',
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
                    $('#enviaredit').prop("disabled", true);
                }
            });


        }
    })


}

function fuentefinanciamientoEdit(idtrans) {
    var url = "/presupuesto/obtenerfuentefinaciamiento";
    var arreglo;
    var select = $('#fufiedit').html('');
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
                    if (data[i]['fFId'].toString() === idtrans.toString()) {
                        htmla = '<option value="' + data[i]['fFId'] + '" selected>' + data[i]['fFdesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['fFId'] + '">' + data[i]['fFdesc'] + '</option>';

                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });


}

$("#enviar").click(function (event) {
    event.preventDefault();
    if (valTotig()) {
        event.preventDefault();
        var numrj = $('#numrj').val();
        var codtra = $('#codtra').val();
        var monto = $('#monto').val();
        var fufi = $('#fufi').val();
        var arrc = [], arrpp = [], arrm = [];
        for (var i = 0; i < tab.length; i++) {
            arrc[i] = tab[i]['idc'];
            arrpp[i] = tab[i]['idp'];
            arrm[i] = tab[i]['mont'];
        }
        var _token = $('meta[name="csrf-token"]').attr('content');
        arrc = JSON.stringify(arrc);
        arrpp = JSON.stringify(arrpp);
        arrm = JSON.stringify(arrm);
        $.ajax({
            url: "presupuesto/transferenciastore",
            type: "POST",
            data: {
                _token: _token,
                numrj: numrj,
                codtra: codtra,
                monto: monto,
                fufi: fufi,
                arrc: arrc,
                arrpp: arrpp,
                arrm: arrm


            },
            success: function (data) {
                $("#uploadResponse").html(data);
                if (data['error'] === 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        type: 'success',
                        title: 'Registro de transferencia exitoso',
                        showConfirmButton: false,
                        timer: 3000
                    })
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

            },
        });
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'El monto de la Rj es superior o menor al techo presupuestal',
            showConfirmButton: false,
            timer: 3000
        });
    }
});

function fuentefinanciamiento() {
    var url = "/presupuesto/obtenerfuentefinaciamiento";
    var arreglo;
    var select = $('#fufi').html('');
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


$("#monto").on("input", function () {
    // allow numbers, a comma or a dot
    var v = $(this).val(), vc = v.replace(/[^0-9,\.]/, '');
    if (v !== vc)
        $(this).val(vc);
});

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#numrj').val() !== '') {
        validarCaja('numrj', 'validnumrj', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese numero de rj';
        validarCaja('numrj', 'validnumrj', text, 0);
    }

    if ($('#codtra').val() !== '') {
        validarCaja('codtra', 'validcodtra', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese codigo de transferencia';
        validarCaja('codtra', 'validcodtra', text, 0);
    }
    if ($('#monto').val() !== '' && parseInt($('#monto').val()) !== 0) {
        validarCaja('monto', 'validmont', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese monto';
        validarCaja('monto', 'validmont', text, 0);
    }
    if ($('#fufi').val() !== '0') {
        validarCaja('fufi', 'validfufi', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion una transferencia';
        validarCaja('fufi', 'validfufi', text, 0);
    }
    return cont;
}


function valNumrj() {
    var val = $('#numrj').val();
    var url = "/presupuesto/validartransf";
    $.ajax(
        {
            url: url,
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                val: val,
            },
            dataType: 'JSON',
            cache: false,
            success: function (data) {
                if (parseInt(data[0]['cant']) > 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        type: 'warning',
                        title: 'La transferencia ya esta registrada',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    validarCaja('numrj', 'validnumrj', 'La transferencia ya fue registrada', 0);
                } else {
                    validarCaja('numrj', 'validnumrj', 'Nro de transferencia correcta', 1);
                    $('#enviar').prop("disabled", false);
                }

            }, beforeSend() {
                $('#enviar').prop("disabled", true);
            }

        });
}

function eliminartransferencia(idtr) {
    window.event.preventDefault();
    var url = "/presupuesto/deltransferencia/" + idtr;
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
                            redirect('/presupuesto/transferencia');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Transferencia eliminada/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/transferencia');
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
