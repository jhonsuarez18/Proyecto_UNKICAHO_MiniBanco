var epecificas = new Array();
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    //programaPresupuestal();
    //especificaGasto();
    //producto();
});

$("#addmeta").on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_meta').modal({show: true, backdrop:'static', keyboard: false});
    programaPresupuestal();
    especificaGasto();
});

function abrirModal(e, idmeta) {
    e.preventDefault();
    $('#modal-dialog-edit_meta').modal({show: true, backdrop:'static', keyboard: false});
    llenarEditar(idmeta);

}

$('#edaddespeed').on('click', function () {

    var idesp = $('#edespgased').children("option:selected").val();
    var idmeta = $('#idmeta').val();
    var url = "/presupuesto/storeEspecificaGasto/" + idmeta + "/" + idesp;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                addlistEspecificaEditar(idmeta);
            }

        });
});

function addlistEspecificaEditar(idmeta) {

    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var edlista = $('#edlista').html('');
    var htmla = '', html = '';
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
                    htmla = '<div class="row" ><li > <strong>-</strong> ' + data[i]['eGDesc'] + '</li><div onclick="eliminarEspecificaEdit(' + data[i]['mEGId'] + ',' + idmeta + ')" style="text-decoration:none"> <i style="color: red" title="Quitar" class="fa fa-minus-circle" ></i></div></div>';
                    html = htmla + html;
                }
                edlista.append(html);

            }

        });
}

function eliminarEspecificaEdit(idesga, idmeta) {
    var url = "/presupuesto/deleteespecificagasto/" + idesga;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                addlistEspecificaEditar(idmeta);
            }

        });
}

function especificaGastoEditar() {
    var url = "/presupuesto/obtenerespecificasgasto";
    var arreglo;
    var select = $('#edespgased').html('');
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
                    htmla = '<option value="' + data[i]['eGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);

            }

        });
}


function completarPPedit(idpp) {
    var url = "/presupuesto/obtenerprogramaspresupuestales";
    var arreglo;
    var select = $('#edpropre').html('');
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
                    if (data[i]['pPId'].toString() === idpp.toString()) {
                        htmla = '<option value="' + data[i]['pPId'] + '" selected>' + data[i]['pPDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['pPId'] + '">' + data[i]['pPDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}


function llenarEditar(idmeta) {
    var url = "/presupuesto/obtenermetadespecificaeditar/" + idmeta;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                console.log(data);
                $('#edidfin').val(data['result']['fId']);
                $('#edact').val(data['result']['fDescActividad']);
                $('#edpro').val(data['result']['fDescProducto']).prop("disabled", true);
                $('#edfin').val(data['result']['fDescFinalidad']).prop("disabled", true);
                $('#ednummeta').val(data['result']['mCod']);
                $('#idmeta').val(data['result']['mId']).prop("disabled", true);
                completarPPedit(data['result']['pPId']);
                especificaGastoEditar();
                addlistEspecificaEditar(data['result']['mId']);
            }, beforeSend: function () {

            },

        });

}


$('#addespe').on('click', function () {
    var espag = $('#espgas');
    especifica = new Array();
    especifica["id"] = espag.children("option:selected").val();
    especifica["text"] = espag.children("option:selected").text();
    var ubi = 0;
    for (var i = 0; i < epecificas.length; i++) {
        if (epecificas[i]['id'].toString() === especifica['id']) {
            ubi = 1;
        }
    }
    if (ubi === 0)
        epecificas.push(especifica);
    addlistEspecifica(epecificas);
    espgas.focus();
});

function addlistEspecifica(lista) {

    var listacontact = $('#lista').html('');
    var htmla = '', html = '';
    for (var i = 0; i < lista.length; i++) {
        htmla = '<div class="row"> <li > <strong>-</strong> ' + epecificas[i]['text'] + '</li><div href="#" onclick="delListEspcifica(' + [i] + ')" style="text-decoration:none"> <i style="color: red" title="Quitar" class="fa fa-minus-circle" ></i></div></div>\'';
        html = htmla + html;
    }
    listacontact.append(html);
}

function delListEspcifica(id) {
    epecificas.splice(id, 1);
    addlistEspecifica(epecificas);
}


function enviar() {
    if (validarFormulario() === 0) {
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
                var propre = $('#propre').val();
                var prod = $('#idfin').val();
                var nummeta = $('#nummeta').val();
                var arr = new Array();
                for (var i = 0; i < epecificas.length; i++)
                    arr.push(epecificas[i]['id']);
                var sus = $('#sus').val();
                sus = JSON.stringify(sus);
                $.ajax({
                    url: '/presupuesto/storemeta',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        especifica: arr,
                        propre: propre,
                        prod: prod,
                        nummeta: nummeta,
                        sus: sus,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de meta exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                location.reload();
                                //redirect('/presupuesto/agregarmeta');
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
                                //redirect('/presupuesto/agregarmeta');
                            }
                        }
                    ,
                    beforeSend: function () {
                        $('#enviar').prop("disabled", true);
                    }
                });

            }
        });
    }else{
        operacionSubsanar();
    }
}

function enviarEdit() {
    var idfin = $('#edidfin').val();
    var idmeta = $('#idmeta').val();
    var propre = $('#edpropre').val();
    var prod = $('#idfin').val();
    var nummeta = $('#ednummeta').val();
    $.ajax({
        url: '/presupuesto/editmeta',
        type: 'GET',
        cache: false,
        data: {
            _token: CSRF_TOKEN,
            idmeta: idmeta,
            propre: propre,
            prod: prod,
            nummeta: nummeta,
            idfin: idfin
        },
        dataType: 'JSON',
        success:
            function (data) {
                if (data['error'] === 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        type: 'success',
                        title: 'Edicion exitosa!',
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

$('#edact').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        desc = JSON.stringify(this.value);
        $.ajax({
            url: '/presupuesto/obfides',
            type: "GET",
            cache: false,
            data: {
                _token: CSRF_TOKEN,
                desc: desc,
            },
            dataType: 'json',
            success:
                function (data) {
                    $('#edpro').val(data[0]['fDescActividad']);
                    $('#edfin').val(data[0]['fDescFinalidad']);
                    $('#edidfin').val(data[0]['fId']);
                }

            ,
        });
    }
});

/*
$('#act').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        desc = JSON.stringify(this.value);
        $.ajax({
            url: '/presupuesto/obfides',
            type: "GET",
            cache: false,
            data: {
                _token: CSRF_TOKEN,
               // desc: desc,
            },
            dataType: 'json',
            success:
                function (data) {
                    $('#pro').val(data[0]['fDescProducto']);
                    $('#fin').val(data[0]['fDescFinalidad']);
                    $('#idfin').val(data[0]['fId']);
                }

            ,
        });
    }
});*/

/*$('#act').on('change', function () {
        $.ajax({
            url: '/presupuesto/obfides',
            type: "GET",
            cache: false,
            data: {
                _token: CSRF_TOKEN,
                desc: desc,
            },
            dataType: 'json',
            success:
                function (data) {
                    $('#pro').val(data[0]['fDescProducto']);
                    $('#fin').val(data[0]['fDescFinalidad']);
                    $('#idfin').val(data[0]['fId']);

                }

            ,
        });
});*/


function producto() {
    var url = "/presupuesto/obtenerfinalidad";
    var arreglo;
    var select = $('#prod').html('');
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
                    htmla = '<option value="' + data[i]['fId'] + '">' + data[i]['descr'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);

            }

        });
}

function especificaGasto() {
    var url = "/presupuesto/obtenerespecificasgasto";
    var arreglo;
    var select = $('#espgas').html('');
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
                    htmla = '<option value="' + data[i]['eGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);

            }

        });
}

function programaPresupuestal() {
    var url = "/presupuesto/obtenerprogramaspresupuestales";
    var arreglo;
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
                    htmla = '<option value="' + data[i]['pPId'] + '">' +data[i]['pPCod']+' || ' +data[i]['pPDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#act').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/presupuesto/obfi",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.fId,
                        name: item.fDescActividad,
                        desp: item.fDescProducto,
                        def: item.fDescFinalidad
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#pro');
        var fin = $('#fin');

        var idfin = $('#idfin');
        pro.val('');
        fin.val('');
        idfin.val('');
        pro.val(item.desp);
        fin.val(item.def);
        idfin.val(item.id);
        return item;
    }

});
$(function () {

    $('#tabla_meta').DataTable({
            ajax: '/presupuesto/obtenermetaespecifica',
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
            columnDefs: [
                {"targets": 0, "width": "2%", "className": "text-center"},
                {"targets": 6, "width": "4%", "className": "text-center"},
            ],

            columns: [
                {data: 'mCod', name: 'mCod'},
                {data: 'esp', name: 'esp'},
                {data: 'pPDesc', name: 'pPDesc'},
                {data: 'fDescFinalidad', name: 'fDescFinalidad'},
                {data: 'fDescActividad', name: 'fDescActividad'},
                {data: 'fDescProducto', name: 'fDescProducto'},
                {
                    data: function (row) {
                        if (parseInt(row.mEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="abrirModal(event,' + row.mId + ')" TITLE="Editar meta" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar meta" onclick="eliminar(event,' + row.mId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar meta" onclick="eliminar(event,' + row.mId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }

            ]
        }
    );
});
$('#edact').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/presupuesto/obfi",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.fId,
                        name: item.fDescActividad,
                        desp: item.fDescProducto,
                        def: item.fDescFinalidad
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#edpro');
        var fin = $('#edfin');

        var idfin = $('#edidfin');
        pro.val('');
        fin.val('');
        idfin.val('');
        pro.val(item.desp);
        fin.val(item.def);
        idfin.val(item.id);
        return item;
    }

});



function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#propre').val() !== '0') {
        validarCaja('propre', 'validpropre', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion un programa presupuestal';
        validarCaja('propre', 'validpropre', text, 0);
        $('#propre').focus();
    }
    if ($('#act').val() !== ' ') {
        validarCaja('act', 'validact', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese una actividad y presione enter';
        validarCaja('act', 'validact', text, 0);
        $('#act').focus();
    }
    if ($('#pro').val() !== ' ') {
        validarCaja('act', 'validact', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion y presione enter';
        validarCaja('act', 'validact', text, 0);
        $('#act').focus();
    }
    if (epecificas === undefined || epecificas.length === 0) {
        cont++;
        text = inicio + ' seleccion e ingrese especificas';
        validarCaja('espgas', 'validmorbilidad', text, 0);

    }
    else {
        validarCaja('espgas', 'validmorbilidad', 'Correcto', 1);
    }


    return cont;
}


function zeroFill(number, width) {
    width -= number.toString().length;
    if (width > 0) {
        return new Array(width + (/\./.test(number) ? 2 : 1)).join('0') + number;
    }
    return number + ""; // always return a string
}

function valNumMeta() {
    var val = $('#nummeta').val();
    val = zeroFill(val, 4);
    var url = "/presupuesto/validarmeta/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['met'];
                    if (parseInt(result[0]['cant']) > 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La meta ya esta registrada',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        validarCaja('nummeta', 'validnummeta', 'El numero de meta ya fue registrado', 0);
                        $('#nummeta').val(val);
                    }
                    else {
                        validarCaja('nummeta', 'validnummeta', 'Nro de meta correcto', 1);
                        $('#enviar').prop("disabled", false);
                        $('#nummeta').val(val);
                    }
                }

            }, beforeSend() {
                $('#enviar').prop("disabled", true);
            }

        });
}

var eliminar = function (e, idMet) {
    var url = "/presupuesto/eliminarmeta/" + idMet;
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
                            redirect('/presupuesto/agregarmeta');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Meta eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/agregarmeta');
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
