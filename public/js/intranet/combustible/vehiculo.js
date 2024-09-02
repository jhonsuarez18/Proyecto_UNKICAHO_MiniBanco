var camposadd = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$('#addve').on('click', function () {
    //  window.event.preventDefault();
    $('#modal_dialog_add_veh').modal({show: true, backdrop: 'static', keyboard: false});
    getMarca();
    camposadd = [];
    camposVehiAdd();
    cargaroficinas();
    $('#smarcva').prop('disabled',true);
    $('#modva').prop('disabled',true);
    $('#tipva').prop('disabled',true);
    $('#descent').prop('disabled',true);
});


$(document).ready(function () {
    vehiculos();
});
function camposVehiAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "placva";
    tablacampos[1] = "valplacva";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "marcva";
    tablacampos[1] = "validmarcv";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "smarcva";
    tablacampos[1] = "validsmarcva";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "modva";
    tablacampos[1] = "validmodva";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "tipva";
    tablacampos[1] = "validtipva";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "codp";
    tablacampos[1] = "valcodp";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "conka";
    tablacampos[1] = "valconka";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "nchasis";
    tablacampos[1] = "valnchasis";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "nmotor";
    tablacampos[1] = "valnmotor";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "color";
    tablacampos[1] = "valcolor";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "anfab";
    tablacampos[1] = "valanfab";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "nrar";
    tablacampos[1] = "valnrar";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "descent";
    tablacampos[1] = "validardescent";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#envv').prop("disabled", false);
}

$('#envv').on('click', function () {
    if (validar() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara un nuevo vehiculo',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                var placva = $('#placva').val();
                var tipva = $('#tipva').val();
                var codp = $('#codp').val();
                var conka = $('#conka').val();
                var nchasis = $('#nchasis').val();
                var nmotor = $('#nmotor').val();
                var nrar = $('#nrar').val();
                var anfab = $('#anfab').val();
                var color = $('#color').val();
                var idoficent = $('#idoficent').val();
                $.ajax({
                    url: '/combustible/storevehi',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        placva: placva,
                        tipva: tipva,
                        codp: codp,
                        conka: conka,
                        nchasis: nchasis,
                        nmotor: nmotor,
                        color: color,
                        idoficent: idoficent,
                        nrar:nrar,
                        anfab:anfab
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de vehiculo exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_veh');
                                vehiculos();
                                camposadd = [];
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
                                closeModal('modal_dialog_add_veh');
                                vehiculos();
                                camposadd = [];

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#envv').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
});

$('#envve').on('click', function () {
    if (validarEdit() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editara el vehiculo',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                var placve = $('#placve').val();
                var tipve = $('#tipve').val();
                var codpe = $('#codpe').val();
                var conke = $('#conke').val();
                var nchasis = $('#nchasisedit').val();
                var nmotor = $('#nmotoredit').val();
                var color = $('#coloredit').val();
                var nrare = $('#nrared').val();
                var anfabe = $('#anfabed').val();
                var idoficente = $('#idoficente').val();
                var veid = $('#veid').val();
                $.ajax({
                    url: '/combustible/editvehi',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        placve: placve,
                        tipve: tipve,
                        codpe: codpe,
                        conke: conke,
                        nchasis: nchasis,
                        nmotor: nmotor,
                        color: color,
                        idoficente: idoficente,
                        veid: veid,
                        nrar: nrare,
                        anfab: anfabe
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                $('#envve').prop("disabled", false);
                                $('#modal_dialog_ed_veh').modal('hide');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'se ha editado el registro',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                vehiculos();
                            } else {
                                $('#envve').prop("disabled", false);
                                $('#modal_dialog_ed_veh').modal('hide');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    type: 'error',
                                    title: 'ocurrio un error!',
                                    text: data['error'],
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                vehiculos();
                            }
                        }
                    ,
                    beforeSend: function () {
                        $('#envve').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
});

function validar() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#placva').val() !== '') {
        validarCaja('placva', 'valplacva', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese placa';
        validarCaja('placva', 'valplacva', text, 0);
    }
    if ($('#marcva').val() !== '0') {
        validarCaja('marcva', 'validmarcv', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la marca';
        validarCaja('marcva', 'validmarcv', text, 0);
    }
    if ($('#smarcva').val() !== '0') {
        validarCaja('smarcva', 'validsmarcva', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione submarca';
        validarCaja('smarcva', 'validsmarcva', text, 0);
    }
    if ($('#modva').val() !== '0') {
        validarCaja('modva', 'validmodva', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione  modelo';
        validarCaja('modva', 'validmodva', text, 0);
    }
    /*if ($('#codp').val() !== '') {
        validarCaja('codp', 'valcodp', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese codigo patrimonial';
        validarCaja('codp', 'valcodp', text, 0);
    }*/
    /*if ($('#conka').val() !== '') {
        validarCaja('conka', 'valconka', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese codigo patrimonial';
        validarCaja('conka', 'valconka', text, 0);
    }*/
    if ($('#idoficent').val() !== '') {
        validarCaja('idoficent', 'validardescent', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese entidad';
        validarCaja('idoficent', 'validardescent', text, 0);
    }


    return cont;
}

function validarEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#placve').val() !== '') {
        validarCaja('placva', 'valplacva', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese placa';
        validarCaja('placva', 'valplacva', text, 0);
    }
    if ($('#marcve').val() !== '0') {
        validarCaja('marcva', 'validmarcv', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la marca';
        validarCaja('marcva', 'validmarcv', text, 0);
    }
    if ($('#smarcve').val() !== '0') {
        validarCaja('smarcva', 'validsmarcva', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione submarca';
        validarCaja('smarcva', 'validsmarcva', text, 0);
    }
    if ($('#modve').val() !== '0') {
        validarCaja('modva', 'validmodva', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione  modelo';
        validarCaja('modva', 'validmodva', text, 0);
    }
    /*if ($('#codpe').val() !== '') {
        validarCaja('codp', 'valcodp', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese codigo patrimonial';
        validarCaja('codp', 'valcodp', text, 0);
    }
    if ($('#conke').val() !== '') {
        validarCaja('conka', 'valconka', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese codigo patrimonial';
        validarCaja('conka', 'valconka', text, 0);
    }*/
    if ($('#idoficente').val() !== '') {
        validarCaja('idoficent', 'validardescent', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese entidad';
        validarCaja('idoficent', 'validardescent', text, 0);
    }


    return cont;
}

function vehiculos() {
    var tab = $('#tabla_vehiculos');
    tab.DataTable({
        ajax: '/combustible/getvehiculos',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
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
            {"targets": 0, "width": "5%", "className": "text-center"},
            {"targets": 1, "width": "5%", "className": "text-center"},
            {"targets": 2, "width": "5%", "className": "text-center"},
            {"targets": 3, "width": "5%", "className": "left-center"},
            {"targets": 4, "width": "5%", "className": "text-center"},
            {"targets": 5, "width": "5%", "className": "text-center"},
            {"targets": 6, "width": "5%", "className": "text-center"},
            {"targets": 7, "width": "5%", "className": "text-center"},
            {"targets": 8, "width": "5%", "className": "text-center"},
            {"targets": 9, "width": "5%", "className": "text-center"},
            {"targets": 10, "width": "5%", "className": "text-center"},
            {"targets": 11, "width": "5%", "className": "text-center"},


        ],
        columns: [
            {data: 'vPlaca', name: 'vPlaca'},
            {data: 'mDesc', name: 'mDesc'},
            {data: 'sMDesc', name: 'sMDesc'},
            {data: 'moDesc', name: 'moDesc'},
            {data: 'tVDesc', name: 'tVDesc'},
            {data: 'mCilindra', name: 'mCilindra'},
            {data: 'vNmAro', name: 'vNmAro'},
            {data: 'vAnoFab', name: 'vAnoFab'},

            {data: 'vConKil', name: 'vConKil'},
            {data: 'eper', name: 'eper'},
            {
                data: function (row) {
                    return parseInt(row.vEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.vEst) === 1 && parseInt(row.vEst) === 1) {
                        return '<tr >\n' +
                            '<a href="javascript:;"  onclick="editar(' + row.vId + ')" TITLE="Editar Encargado " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="javascript:;" style="color: red" TITLE="Eliminar Encargado" onclick="eliminarv(' + row.vId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: green" TITLE="Restaurar Encargado"  onclick="eliminarv(' + row.vId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function editar(id) {
    window.event.preventDefault();
    $('#modal_dialog_ed_veh').modal({show: true, backdrop: 'static', keyboard: false});
    getvehiculodit(id)
}

function getvehiculodit(id) {
    var url = "/combustible/getvehiculodit/" + id;

    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#veid').val(data[0]['vId']);
                $('#placve').val(data[0]['vPlaca']);
                $('#codpe').val(data[0]['vCodPatri']);
                $('#conke').val(data[0]['vConKil']);
                marcaEdit(data[0]['mId']);
                subMarcaEdit(data[0]['mId'], data[0]['sMId']);
                modeloEdit(data[0]['sMId'], data[0]['moId'])
                tipoVeEdit(data[0]['moId'], data[0]['mTVId'])

                $('#nchasisedit').val(data[0]['vNChasis']);
                $('#nmotoredit').val(data[0]['vNMotor']);
                $('#coloredit').val(data[0]['vColor']);
                $('#descente').val(data[0]['eper']);
                idofice=data[0]['oId'];
                $('#idoficente').val(data[0]['oEId']);
                $('#anfabed').val(data[0]['vAnoFab']);
                $('#nrared').val(data[0]['vNmAro']);



                //  oId
                cargaroficinasededit(data[0]['oId']);

            }
        });
}

function marcaEdit(id) {
    var url = "/combustible/getmarca";
    var arreglo;
    var select = $('#marcve').html('');
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
                    if (data[i]['mId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function subMarcaEdit(mid, id) {
    var url = "/combustible/getsubmarca/" + mid;
    var arreglo;
    var select = $('#smarcve').html('');
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
                    if (data[i]['sMId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['sMId'] + '" selected>' + data[i]['sMDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['sMId'] + '">' + data[i]['sMDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function modeloEdit(idSm, id) {
    var url = "/combustible/getmodelos/" + idSm;
    var select = $('#modve').html('');
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
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['tCDesc'] + ' | ' + data[i]['mDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['tCDesc'] + ' | ' + data[i]['mDesc'] + '</option>';
                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function tipoVeEdit(idmod, idtipv) {
    var url = "/combustible/gettipve/" + idmod;
    var select = $('#tipve').html('');
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
                    if (data[i]['mTVId'].toString() === idtipv.toString()) {
                        htmla = '<option value="' + data[i]['mTVId'] + '" selected>' + data[i]['tVDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mTVId'] + '">' + data[i]['tVDesc'] + '</option>';
                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function getMarca() {
    var url = "/combustible/getmarca";
    var select = $('#marcva').html('');
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
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#marcve').on('change', function () {
    getSubmarcaEdit(this.value);
});

function getSubmarcaEdit(id) {
    var url = "/combustible/getsubmarca/" + id;
    var select = $('#smarcve').html('');
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
                    htmla = '<option value="' + data[i]['sMId'] + '">' + data[i]['sMDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#smarcve').on('change', function () {
    $('#modva').prop("disabled", false);
    getModelosEdit(this.value);
});

function getModelosEdit(id) {
    var url = "/combustible/getmodelos/" + id;
    var select = $('#modve').html('');
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
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['tCDesc'] + ' | ' + data[i]['mDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#modve').on('change', function () {
    getTipVeEdit(this.value);
});
$('#modva').on('change', function () {
    $('#tipva').prop("disabled", false);
    getTipVe(this.value);
});

function getTipVeEdit(id) {
    var url = "/combustible/gettipve/" + id;
    var select = $('#tipve').html('');
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
                    htmla = '<option value="' + data[i]['mTVId'] + '">' + data[i]['tVDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function getTipVe(id) {
    var url = "/combustible/gettipve/" + id;
    var select = $('#tipva').html('');
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
                    htmla = '<option value="' + data[i]['mTVId'] + '">' + data[i]['tVDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#marcva').on('change', function () {
    $('#smarcva').prop("disabled", false);
    getSubmarca(this.value);
});

function getSubmarca(id) {
    var url = "/combustible/getsubmarca/" + id;
    var select = $('#smarcva').html('');
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
                    htmla = '<option value="' + data[i]['sMId'] + '">' + data[i]['sMDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#smarcva').on('change', function () {
    $('#modva').prop("disabled", false);
    getModelos(this.value);
});

function getModelos(id) {
    var url = "/combustible/getmodelos/" + id;
    var select = $('#modva').html('');
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
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['tCDesc'] + ' | ' + data[i]['mDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$("#nueperm").on('change', function () {
    $('#descent').prop("disabled", false);
    $('#descent').val('');
    $('#codofic').val('');
    $('#nombofic').val('');
    $('#descent').focus();

});

function cargarofent(id) {
    idofic = id;
}

function cargaroficinas() {
    var url = "/referencia/getOficAct";
    var perm = $('#nueperm').html('');
    var htmla = '', html = '';
    var perm1 = $('#adduser').html('');
    var htmla1 = '', html1 = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var encarg = data['ofic'];
                    if (encarg.length > 0) {
                        for (var i = 0; i < encarg.length; i++) {
                            htmla = '<div class="form-check">\n' +
                                '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nueperm' + encarg[i]['oId'] + '" value="" onchange="cargarofent(' + encarg[i]['oId'] + ')">' +
                                '                        <label class="form-check-label" for="nueperm' + encarg[i]['oId'] + '">' + encarg[i]['oNombre'] + '</label>\n' +
                                '                    </div>';
                            html = htmla + html;
                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}

$('#descent').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getOficEnt/" + idofic,
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.oEId,
                        name: item.estable,
                        uname: item.estable,
                        numdoc: item.codest
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var idfin = $('#idoficent');
        idfin.val(item.id);
        return item;
    },
    //valusuario,
});

function cargarofented(id) {
    idofice = id;
}

function cargaroficinasededit(id) {
    var url = "/referencia/getOficAct";
    var perm = $('#nueperme').html('');
    var htmla = '', html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var encarg = data['ofic'];
                    if (encarg.length > 0) {
                        for (var i = 0; i < encarg.length; i++) {
                            if (encarg[i]['oId'].toString() === id.toString()) {
                                htmla = '<div class="form-check">\n' +
                                    '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nueperm' + encarg[i]['oId'] + '" value="" onchange="cargarofented(' + encarg[i]['oId'] + ')" checked>' +
                                    '                        <label class="form-check-label" for="nueperm' + encarg[i]['oId'] + '">' + encarg[i]['oNombre'] + '</label>\n' +
                                    '                    </div>';
                            } else {
                                htmla = '<div class="form-check">\n' +
                                    '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nueperm' + encarg[i]['oId'] + '" value="" onchange="cargarofented(' + encarg[i]['oId'] + ')">' +
                                    '                        <label class="form-check-label" for="nueperm' + encarg[i]['oId'] + '">' + encarg[i]['oNombre'] + '</label>\n' +
                                    '                    </div>';
                            }
                            html = htmla + html;
                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}

$('#descente').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getOficEnt/" + idofice,
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.oEId,
                        name: item.estable,
                        uname: item.estable,
                        numdoc: item.codest
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var idfin = $('#idoficente');
        idfin.val(item.id);
        return item;
    },
    //valusuario,
});

function eliminarv(idref) {
    var url = "/combustible/deletevehi/" + idref;
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
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Vehiculo eliminado/restaurado correctamente!',
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

                });

        }
    })
}

function valPlaca() {
    var val = $('#placva').val();
    var url = "/combustible/getvalplac/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['vei'];
                    if (parseInt(result[0]['cant']) > 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La meta ya esta registrada',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        validarCaja('placva', 'valplacva', 'El numero de placa ya fue registrado', 0);
                        $('#placva').val(val);
                    } else {
                        validarCaja('placva', 'valplacva', 'Nro de placa correcto', 1);
                        $('#envv').prop("disabled", false);
                        $('#placva').val(val);
                    }
                }

            }, beforeSend() {
                $('#envv').prop("disabled", true);
            }

        });
}
