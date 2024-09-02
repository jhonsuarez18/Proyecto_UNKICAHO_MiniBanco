var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var camposadd = [];
$(document).ready(function () {
    //location.reload();
    $('.modal-backdrop').remove();
    $('#fecret').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    cargTipGas();
    var id = $('#idvi').val();
    getComprobantes(id);
});

function camposChoferAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "tpg";
    tablacampos[1] = "validtpg";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    var tablacampos = new Array();
    tablacampos[0] = "ga";
    tablacampos[1] = "validga";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    var tablacampos = new Array();
    tablacampos[0] = "tipc";
    tablacampos[1] = "validtipc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    var tablacampos = new Array();
    tablacampos[0] = "feccomp";
    tablacampos[1] = "valfeccomp";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    var tablacampos = new Array();
    tablacampos[0] = "numdoc";
    tablacampos[1] = "validnumdoc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    var tablacampos = new Array();
    tablacampos[0] = "razso";
    tablacampos[1] = "valrazso";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    var tablacampos = new Array();
    tablacampos[0] = "mont";
    tablacampos[1] = "valmon";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    $('#enviar').prop("disabled", false);
}

function cargTipGas() {
    var url = "/referencia/getTiGas";
    var arreglo;
    var select = $('#tpg').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tg'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        htmla = '<option value="' + result[i]['tGId'] + '">' + result[i]['tGDesc'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                }
            }

        });
}

$('#tpg').on('change', function () {
    CargGas(this.value);
    var tpg = $('#tpg');
    var tpgvalid = $('#validtpg');
    if (this.value === '0') {
        $('#ga').prop('disabled', true);
        validarCaja('tpg', 'validtpg', 'Escoja tipo de gasto', 0)
    } else {
        $('#ga').prop('disabled', false);
        tpgvalid.removeClass('valid-feedback');
        tpg.removeClass('is-valid');
        tpg.removeClass('is-invalid');
        tpgvalid.addClass('invalid-feedback');
        $('#ga').focus();
    }
});

function CargGas(id) {
    var url = "/referencia/getGas/" + id;
    var arreglo;
    var select = $('#ga').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tga'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        htmla = '<option value="' + result[i]['gId'] + '">' + result[i]['gDesc'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                }

            }

        });
}

$('#ga').on('change', function () {
    CargComp(this.value);
});

function CargComp(id) {
    var url = "/referencia/tipComp/" + id;
    var arreglo;
    var select = $('#tipc').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tc'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        htmla = '<option value="' + result[i]['tDGId'] + '">' + result[i]['tDDes'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                }

            }

        });
}

$('#addcomp').on('click', function () {
    window.event.preventDefault();
    $('#modal-add-comp').modal({show: true, backdrop: 'static', keyboard: false});
    $('#feccomp').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    camposChoferAdd();
    limpiarCajaV2(camposadd);
    // $('#tpg')[0].get(0).reset();
});

$('#addfec').on('click', function () {
    event.preventDefault();
    let fec = $('#fecret').val();
    let id = $('#ref').val();
    if (fec !== '') {
        validarCaja('fecret', 'valfecret', 'Correcto', 1);
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se registrara la fecha de retorno',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                $.ajax(
                    {
                        url: '/referencia/fecrefref',
                        type: 'get',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                            fec: fec,
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            location.reload();
                        },
                        beforeSend: function () {
                            $('#enviared').prop("disabled", true);
                        }
                    }
            );
            }
        });
    } else {
        validarCaja('fecret', 'valfecret', 'Ingrese fecha', 0);
    }

});

function atras()
{
    redirect('/referencia/verreferenciasess');
}

function getComprobantes(id) {
    var datatable = $('#tabla_comp');
    datatable.DataTable().destroy();
    var t =datatable.DataTable({
            ajax: '/referencia/getCompVId/' + id,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            columnDefs: [
                {"targets": 0, "width": "5%", "className": "text-center"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "15%", "className": "text-left"},
                {"targets": 3, "width": "10%", "className": "text-center"},
                {"targets": 4, "width": "30%", "className": "text-left"},
                {"targets": 5, "width": "14%", "className": "text-center"},
                {"targets": 6, "width": "14%", "className": "text-center"},
                {"targets": 7, "width": "30%", "className": "text-center"},
                {"targets": 8, "width": "30%", "className": "text-center"},
            ],
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                var tosdec = 0;
                var tocdec = 0;
                const formatter = new Intl.NumberFormat('es-ES', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    if (parseInt(data[i]['cEst']) === 1) {
                        if (parseInt(data[i]['tDId']) !== 1)
                            tosdec += parseFloat(data[i]['cImp']);
                        else
                            tocdec += parseFloat(data[i]['cImp']);
                        totalAmount += parseFloat(data[i]['cImp']);
                    }

                }

                $('#totbpor').val((Math.round((tosdec / totalAmount) * 100))|| 0);
                $('#totcpor').val((Math.round((tocdec / totalAmount) * 100))|| 0);
                totalAmount = formatter.format(totalAmount);
                tosdec = formatter.format(tosdec);
                tocdec = formatter.format(tocdec);
                $('#totb').val(tosdec);
                $('#totdj').val(tocdec);
                $(this.api().column(6).footer()).html(totalAmount);
            },
            columns: [
                {data: 'cId', name: 'cId'},
                {data: 'cFecha', name: 'cFecha'},
                {data: 'tDDes', name: 'tDDes'},
                {data: 'cNroDoc', name: 'cNroDoc'},
                {data: 'cRazSoc', name: 'cRazSoc'},
                {data: 'gDesc', name: 'gDesc'},
                {data: 'cImp', name: 'cImp'},
                {
                    data: function (row) {
                        return parseInt(row.cEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.cEst) === 1 && parseInt(row.cEst) === 1) {
                            return '<tr >\n' +
                                '<a href="javascript:"  onclick="modalEdit(' + row.cId + ')" TITLE="Edit " >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="javascript:" style="color: red" TITLE="Eliminar comprobante" onclick="eliminarComprobante(' + row.cId + ',' + id + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="javascript:" style="color: green" TITLE="Restaurar comprobante"  onclick="eliminarComprobante(' + row.cId + ',' + id + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }

            ]
        }
    )
    ;
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
}

function enviarComp() {
    //validarDniPac();
    if (validarFormularioReg() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara un nuevo registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                var tipc = $('#tipc').val();
                var feccomp = $('#feccomp').val();
                var numdoc = $('#numdoc').val();
                var razso = $('#razso').val();
                var mont = $('#mont').val();
                var idvi = $('#idvi').val();
                razso = JSON.stringify(razso);
                $.ajax({
                    url: '/referencia/storeComp',
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        tipc: tipc,
                        feccomp: feccomp,
                        numdoc: numdoc,
                        razso: razso,
                        mont: mont,
                        idvi: idvi
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de comprobante exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#modal-add-comp').modal('hide');
                                getComprobantes(idvi);
                                camposChoferAdd();
                                limpiarCajaV2(camposadd);
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
                                $('#modal-add-comp').modal({show: false});
                                getComprobantes(idvi);
                                camposChoferAdd();
                                limpiarCajaV2(camposadd);
                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviar').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();

    }
}

function eliminarComprobante(idcomp, idvia) {
    var url = "/referencia/deleteComp/" + idcomp;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara/restaurara este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: CSRF_TOKEN,
                    success: function (data) {
                        if (data['error'] === 0) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Registro de Paciente exitoso',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            getComprobantes(idvia);
                        } else {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Registro de Paciente exitoso',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            getComprobantes(idvia);

                        }
                    }

                });

        }
    })


}

function modalEdit(id) {
    window.event.preventDefault();
    $('#modal-edit-comp').modal({show: true, backdrop: 'static', keyboard: false});
    $('#feccomped').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    var url = "/referencia/show/" + id;
    var text;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {

                if (data['error'] === 0) {
                    let comp = data['comp'];
                    let tipdoc = data['tipdoccomp'];
                    let gast = data['gast'];
                    let tipgast = data['tipgast'];
                    $('#idcom').val(comp['cId']);
                    $('#efeccomped').val(comp['cFecha']);
                    $('#enumdoc').val(comp['cNroDoc']);
                    $('#erazso').val(comp['cRazSoc']);
                    $('#emont').val(comp['cImp']);
                    cargTipGasEd(tipgast['tGId']);
                    CargGasEd(tipgast['tGId'], gast['gId'])
                    CargComped(gast['gId'], tipdoc['tDGId']);
                    // CargComped(tipdoc['tDGId']);
                } else {

                }
            }
            ,
            beforeSend: function () {
                // bloquear();
            }
        },);
}

function cargTipGasEd(id) {
    var url = "/referencia/getTiGas";
    var arreglo;
    var select = $('#etpg').html('');
    var html = '<option value="0" >SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tg'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['tGId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['tGId'] + '" selected>' + result[i]['tGDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['tGId'] + '">' + result[i]['tGDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }
            }
        });

}

function CargGasEd(idtg, id) {
    var url = "/referencia/getGas/" + idtg;
    var arreglo;
    var select = $('#ega').html('');
    var html = '<option value="0" ="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tga'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['gId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['gId'] + '" selected>' + result[i]['gDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['gId'] + '">' + result[i]['gDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

function CargComped(id, idc) {
    var url = "/referencia/tipComp/" + id;
    var arreglo;
    var select = $('#etipc').html('');
    var html = '<option value="0" >SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tc'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['tDGId'].toString() === idc.toString()) {
                            htmla = '<option value="' + result[i]['tDGId'] + '" selected>' + result[i]['tDDes'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['tDGId'] + '">' + result[i]['tDDes'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

$('#etpg').on('change', function () {
    CargGaseditar(this.value);
    /* var tpg = $('#tpg');
     var tpgvalid = $('#validtpg');
     if (this.value === '0') {
         $('#ga').prop('disabled', true);
         validarCaja('tpg', 'validtpg', 'Escoja tipo de gasto', 0)
     } else {
         $('#ga').prop('disabled', false);
         tpgvalid.removeClass('valid-feedback');
         tpg.removeClass('is-valid');
         tpg.removeClass('is-invalid');
         tpgvalid.addClass('invalid-feedback');
         $('#ga').focus();
     }*/
});

function CargGaseditar(id) {
    var url = "/referencia/getGas/" + id;
    var arreglo;
    var select = $('#ega').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tga'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        htmla = '<option value="' + result[i]['gId'] + '">' + result[i]['gDesc'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                }

            }

        });
}

$('#ega').on('change', function () {
    CargCompEdit(this.value);
    /* var tpg = $('#tpg');
     var tpgvalid = $('#validtpg');
     if (this.value === '0') {
         $('#ga').prop('disabled', true);
         validarCaja('tpg', 'validtpg', 'Escoja tipo de gasto', 0)
     } else {
         $('#ga').prop('disabled', false);
         tpgvalid.removeClass('valid-feedback');
         tpg.removeClass('is-valid');
         tpg.removeClass('is-invalid');
         tpgvalid.addClass('invalid-feedback');
         $('#ga').focus();
     }*/
});

function CargCompEdit(id) {
    var url = "/referencia/tipComp/" + id;
    var arreglo;
    var select = $('#etipc').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tc'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        htmla = '<option value="' + result[i]['tDGId'] + '">' + result[i]['tDDes'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                }

            }

        });
}

function editarComp() {
    //validarDniPac();
    if (validarFormularioEd() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editara el registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                var tipc = $('#etipc').val();
                var feccomp = $('#efeccomped').val();
                var numdoc = $('#enumdoc').val();
                var razso = $('#erazso').val();
                var mont = $('#emont').val();
                var idvi = $('#idvi').val();
                var idcom = $('#idcom').val()
                razso = JSON.stringify(razso);
                $.ajax({
                    url: '/referencia/updateComp',
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        tipc: tipc,
                        feccomp: feccomp,
                        numdoc: numdoc,
                        razso: razso,
                        mont: mont,
                        idcom: idcom,
                        idvi: idvi
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Edicion de comprobante exitosa',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#modal-edit-comp').modal('hide');
                                getComprobantes(idvi);
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
                                $('#modal-edit-comp').modal({show: false});
                                getComprobantes(idvi);

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviared').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function validarFormularioReg() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#tpg').val() !== '0') {
        validarCaja('tpg', 'validtipodoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione Tipo de gasto';
        validarCaja('tpg', 'validtpg', text, 0);
    }
    if ($('#ga').val() !== '0') {
        validarCaja('ga', 'validga', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione gasto';
        validarCaja('ga', 'validga', text, 0);
    }

    if ($('#tipc').val() !== '0') {
        validarCaja('tipc', 'validtipc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione tipo comprobante';
        validarCaja('tipc', 'validtipc', text, 0);
    }

    if ($('#mont').val() !== '') {
        validarCaja('mont', 'valmon', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese monto';
        validarCaja('mont', 'valmon', text, 0);
    }


    return cont;
}


function validarFormularioEd() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#etpg').val() !== '0') {
        validarCaja('etpg', 'validetpg', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione Tipo de gasto';
        validarCaja('etpg', 'validetpg', text, 0);
    }
    if ($('#ega').val() !== '0') {
        validarCaja('ega', 'valiega', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione gasto';
        validarCaja('ega', 'valiega', text, 0);
    }

    if ($('#etipc').val() !== '0') {
        validarCaja('etipc', 'validetipc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccione tipo comprobante';
        validarCaja('etipc', 'validetipc', text, 0);
    }

    if ($('#emont').val() !== '') {
        validarCaja('emont', 'evalmon', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese monto';
        validarCaja('emont', 'evalmon', text, 0);
    }


    return cont;
}
