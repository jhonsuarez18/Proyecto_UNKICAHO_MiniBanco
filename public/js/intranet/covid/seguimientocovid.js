var listids = [];
var listidsepps = [];
var listidseppsentr = [];
var listcantepp = [];
var listcantiepp = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    datePickers();
});

var datePickers = function () {

    $('#fecbusq').datepicker({
        todayHighlight: true,
        autoclose: true,
    });


};
$('#addepp').on('click', function () {
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
function verEppEntregado(id) {
    $('#ver_epp_entregado').modal('show');
    var datatable = $('#tabla_epp');
    datatable.DataTable().destroy();
    datatable.DataTable({
            ajax: '/covid/obtenerentregaepp/' + id,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            buttons: [
                'excel', 'pdf'
            ],

            columnDefs: [
                {"targets": 0,"width": "20%",  "className": "text-center",},
                {"targets": 1,"width": "20%",  "className": "text-center",},
                {"targets": 2,"width": "20%",  "className": "text-center",},
                {"targets": 3,"width": "30%",  "className": "text-center",},
                {"targets": 4,"width": "5%",  "className": "text-right"},

            ],
            columns: [
                {data: 'feent', name: 'feent'},
                {
                    data: function (row) {
                        if (row.fecdar) {
                            return '<small class="text-primary">ENTREGADO</small>';
                        } else {
                            return '<small class="text-danger">NO ENTREGADO</small>';

                        }
                    }
                },
                {data: 'fecdar', name: 'fecdar'},
                {data: 'desc', name: 'desc'},
                {data: 'Cantidad', name: 'Cantidad'},

            ]
        }
    );
}

function abrilModal(id) {
    window.event.preventDefault();
    $('#idpacientemodal').val(id);
    $('#modal-dialog').modal('show');
    $('#epps').prop('hidden',false)
    $('#eppsUni').prop('hidden',true)
    $('#lote').prop("checked", true);
    cargarEpps(id);
    cargarSintomas(id);
}
$('#unid').on('change',function (){
    $('#eppsUni').prop('hidden',false)
    $('#epps').prop('hidden',true)
    cargarEppsUni($('#idpacientemodal').val());
})
$('#lote').on('change',function (){
    $('#eppsUni').prop('hidden',true)
    $('#epps').prop('hidden',false)
    cargarEpps($('#idpacientemodal').val());
})
function cargarEpps(id) {
    var url = "/covid/obtenerEpps/" + id;
    var epps = $('#epps').html('');
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
                    var result = data['result'];
                    for (var i = 0; i < result.length; i++) {
                        htmla = ' <div class="col-md-7 checkbox checkbox-css">\n' +
                            '                        <input type="checkbox" id="epps' + result[i]['idEntregaEpp'] + '" value="" onchange="detectarclickEpps(' + result[i]['idEntregaEpp'] +  ')">' +
                            '                        <label for="epps' + result[i]['idEntregaEpp'] + '">' + result[i]['Cantidad']+' ' +result[i]['descripcion'] + '</label>\n' +
                            '                    </div> ' +
                            '    <div class="col-md-2 checkbox checkbox-css" id="unidad' + result[i]['idEntregaEpp'] + '" hidden>\n' +
                            '                     <input type="checkbox" id="unid' + result[i]['idEntregaEpp'] + '" value="" onchange="detectarUnidEpps(' + result[i]['idEntregaEpp'] + ')">' +
                            '                     <label for="unid' + result[i]['idEntregaEpp'] + '">UNID.</label>' +
                            '                    </div> ' +
                            '    <div class="col-md-12" id="cantidad' + result[i]['idEntregaEpp'] + '" hidden>\n' +
                            '                     <br><label for="canti' + result[i]['idEntregaEpp'] + '">CANT.</label>'+
                            '                     <input type="number" id="canti' + result[i]['idEntregaEpp'] + '" value="">' +
                            '</div>';
                        html = htmla + html;
                    }

                    epps.append(html);
                } else {

                }
            }

        });

}
/*function cargarEppsUni(id) {
    var url = "/covid/getEppsUni/" + id;
    var epps = $('#eppsUni').html('');
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
                    var result = data['result'];
                    for (var i = 0; i < result.length; i++) {
                        htmla = ' <div class="checkbox checkbox-css">\n' +
                            '                        <input type="checkbox" id="eppsUni' + result[i]['idEntregaEpp'] + '" value="" onchange="detectarclickEpps(' + result[i]['idEntregaEpp'] + ')">' +
                            '                        <label for="eppsUni' + result[i]['idEntregaEpp'] + '">' + result[i]['descripcion'] + '</label>\n' +
                            '                    </div> <br><input class="form-control form-control-sm" type="number" id="cant">';
                        html = htmla + html;
                    }

                    epps.append(html);
                } else {

                }
            }

        });

}*/
function cargarSintomas() {
    var url = "/covid/obtenersintomas";
    var sintomas = $('#sintomas').html('');
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
                    var result = data['result'];
                    for (var i = 0; i < result.length; i++) {
                        htmla = ' <div class="checkbox checkbox-css">\n' +
                            '                        <input type="checkbox" id="' + result[i]['idSintoma'] + '" value="" onchange="detectarclick(' + result[i]['idSintoma'] + ')">' +
                            '                        <label for="' + result[i]['idSintoma'] + '">' + result[i]['descripcion'] + '</label>\n' +
                            '                    </div>';
                        html = htmla + html;
                    }

                    sintomas.append(html);
                } else {

                }
            }

        });

}

function detectarclickEpps(id) {
    if ($('#epps' + id).prop('checked')) {
        var ubi = 0;
        for (var i = 0; i < listidsepps.length; i++) {
            if (listidsepps[i] === id) {
                ubi = 1;
            }
        }
        if (ubi === 0)
            listidsepps.push(id);
        $('#unidad'+id).prop('hidden',false);
        $('#unid'+id).prop('checked',false);
    } else {
        for (var i = 0; i < listidsepps.length; i++) {
            if (listidsepps[i] === id) {
                listidsepps.splice(i, 1);
                break;
            }
        }
        $('#unidad'+id).prop('hidden',true);
        $('#cantidad'+id).prop('hidden',true);
    }
}
function detectarUnidEpps(id) {
    if ($('#unid' + id).prop('checked')) {
        /*var ubi = 0;
        for (var i = 0; i < listidsepps.length; i++) {
            if (listidsepps[i] === id) {
                ubi = 1;
            }
        }
        if (ubi === 0)
            listidsepps.push(id);*/
        $('#cantidad'+id).prop('hidden',false);
        $('#canti'+id).focus();
    } else {
        /*for (var i = 0; i < listidsepps.length; i++) {
            if (listidsepps[i] === id) {
                listidsepps.splice(i, 1);
                break;
            }
        }*/
        $('#cantidad'+id).prop('hidden',true);
    }
}
function detectarclick(id) {
    if ($('#' + id).prop('checked')) {
        var ubi = 0;
        for (var i = 0; i < listids.length; i++) {
            if (listids[i] === id) {
                ubi = 1;
            }
        }
        if (ubi === 0)
            listids.push(id);

    } else {
        for (var i = 0; i < listids.length; i++) {
            if (listids[i] === id) {
                listids.splice(i, 1);
                break;
            }
        }

    }
}


$(function () {
    $('#tabla_atencion').DataTable({
            ajax: '/covid/reportaratencionesdiariascovid/0',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: false,
            serverSide: false,
            select: true,
            responsive: true,
            bAutoWidth: true,
            ordering: false,
            rowId: 'id',
            dom: 'lBfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            columnDefs: [
                {"targets": 0, "width": "30%", "className": "text-left"},
                {"targets": 1, "width": "6%", "className": "text-center"},
                {"targets": 2, "width": "15%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},
                {"targets": 6, "width": "5%", "className": "text-center"},
            ],
            columns: [

                {data: 'nomb', name: 'nomb'},
                {data: 'numeroDoc', name: 'numeroDoc'},
                {data: 'dircont', name: 'dircont'},

                {
                    data: function (row) {
                        return '<label > ' + row.dia + '</label>';

                    }
                },
                {
                    data: function (row) {
                        return '<a  href="#"   onclick="verEppEntregado(' + row.idPacienteCovid + ')"  title="Ver epp entregado" >' +
                            '<i class="text-success fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>'
                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.atenc) === 1) {
                            return '<label class="text-primary">CONTROLADO</label>';
                        } else {
                            return '<label class="text-danger">NO CONTROLADO</label>';
                        }
                    }
                },
                {
                    data: function (row) {
                        var epp = '';

                        if (parseInt(row.epp) === 0) {
                            epp = '<a  href="#"   onclick="entregaEpp(' + row.idPacienteCovid + ')"  title="Entregar Epp" >' +
                                '<i class="text-success fas fa-lg fa-fw m-r-10 fa-handshake"> </i></a>';
                        }

                        if (parseInt(row.atenc) === 1) {
                            return '<tr><i class="fas fa-lg fa-fw m-r-10 fa-user-md"> </i>' + epp + '' +
                                '</tr>';
                        } else {
                            return '<tr><a  href="#" onclick="abrilModal(' + row.idPacienteCovid + ')"  title="Atender" >' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-user-md"></i></a> ' + epp + '' +
                                '</tr>';
                        }

                    }
                }

            ]
        }
    );
});

function enviar() {
    listcantiepp=[];
    var idpaciente = $('#idpacientemodal').val();
    var fecbusq = $('#fecbusq').val();
    var obs = $('#obs').val();
    var epps = 0;
    for(var i = 0; i < listidsepps.length; i++){
        if($('#canti'+listidsepps[i]).val()===''){
            listcantiepp.push(0);
        }else{
            listcantiepp.push(parseInt($('#canti'+listidsepps[i]).val()));
        }
    }
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se ingresara una nueva atencion',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/covid/registraatencion',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    listidsepps: listidsepps,
                    listcantiepp: listcantiepp,
                    idpaciente: idpaciente,
                    listasintom: listids,
                    obs: obs,
                    fecbusq: fecbusq
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Operacion exitosa',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            desbloquear();
                            $('#modal-dialog').modal('hide');
                            redirect('/covid/verseguimientoCovid');
                        } else {
                            // desbloquear();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'Error ',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#modal-dialog').modal('hide');
                            redirect('/covid/verseguimientoCovid');
                        }
                    }
                ,
                beforeSend: function () {
                    $('#enviar').prop("disabled", true);
                }
            })
            ;

        }
    })

}

function limpiar() {
    $('#fecbusq').val('');
}

function buscar() {
    var fecbus = $('#fecbusq').val();
    var url;
    if (fecbus === '')
        url = '/covid/reportaratencionesdiariascovid/0';
    else {
        fecbus = new Date(fecbus);
        var fecbus = {
            fecbus: fecbus,
        };
        fecbus = JSON.stringify(fecbus);
        url = '/covid/reportaratencionesdiariascovid/' + fecbus;
    }

    var datatable = $('#tabla_atencion');
    datatable.DataTable().destroy();
    datatable.DataTable({
            ajax: url,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            select: true,
            ordering: false,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            columns: [


                {data: 'nomb', name: 'nomb'},
                {data: 'numeroDoc', name: 'numeroDoc'},
                {data: 'dircont', name: 'dircont'},

                {
                    data: function (row) {
                        return '<label > ' + row.dia + '</label>';

                    }
                },
                {
                    data: function (row) {
                        return '<a  href="#"   onclick="verEppEntregado(' + row.idPacienteCovid + ')"  title="Ver epp entregado" >' +
                            '<i class="text-success fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>'
                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.atenc) === 1) {
                            return '<label class="text-primary">CONTROLADO</label>';
                        } else {
                            return '<label class="text-danger">NO CONTROLADO</label>';
                        }
                    }
                },
                {
                    data: function (row) {
                        var epp = '';

                        if (parseInt(row.epp) === 0) {
                            epp = '<a  href="#"   onclick="entregaEpp(' + row.idPacienteCovid + ')"  title="Entregar Epp" >' +
                                '<i class="text-success fas fa-lg fa-fw m-r-10 fa-handshake"> </i></a>';
                        }

                        if (parseInt(row.atenc) === 1) {
                            return '<tr><i class="fas fa-lg fa-fw m-r-10 fa-user-md"> </i>' + epp + '' +
                                '</tr>';
                        } else {
                            return '<tr><a  href="#" onclick="abrilModal(' + row.idPacienteCovid + ')"  title="Atender" >' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-user-md"></i></a> ' + epp + '' +
                                '</tr>';
                        }

                    }
                }

            ]
        }
    );
}

function entregaEpp(idpaciente) {

    var url = "/covid/entregarepp/" + idpaciente;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se registrara la entregara del epp',
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
                                title: 'Operacion exitosa',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            redirect('/covid/verseguimientoCovid');
                        } else {

                        }
                    }

                });

        }
    })


}

function imprimir() {
    var fecbus = $('#fecbusq').val();
    var url;
    if (fecbus === '')
        url = '/excel/obtenerAsistencia/0';
    else {
        fecbus = new Date(fecbus);
        var fecbus = {
            fecbus: fecbus,
        };
        fecbus = JSON.stringify(fecbus);
        url = '/excel/obtenerAsistencia/' + fecbus;
    }
    window.location = url;
}

function nuevaEntregaEpp() {
    window.event.preventDefault();
    $('#nuevaEntregaEpp').modal('show');
    var url = "/covid/getEpps";
    var epps = $('#nuevepps').html('');
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
                    var result = data['result'];
                    for (var i = 0; i < result.length; i++) {
                        htmla = ' <div class="checkbox checkbox-css">\n' +
                            '                        <input type="checkbox" id="nuepps' + result[i]['idEpp'] + '" value="" onchange="detectarclickEppsEntreg(' + result[i]['idEpp'] + ')">' +
                            '                        <label for="nuepps' + result[i]['idEpp'] + '">' + result[i]['descripcion'] + '</label>\n' +
                            '                    </div><br><input class="form-control form-control-sm" id="cant' + result[i]['idEpp'] + '"  type="number" hidden>';
                        html = htmla + html;
                    }

                    epps.append(html);
                } else {

                }
            }

        });

}


function detectarclickEppsEntreg(id) {
    if ($('#nuepps' + id).prop('checked')) {
        var ubi = 0;
        for (var i = 0; i < listidseppsentr.length; i++) {
            if (listidseppsentr[i] === id) {
                ubi = 1;
            }
        }
        if (ubi === 0)
            listidseppsentr.push(id);
            listcantepp=[];
        $('#cant'+id).prop('hidden',false);
        $('#cant'+id).focus();

    } else {
        for (var i = 0; i < listidseppsentr.length; i++) {
            if (listidseppsentr[i] === id) {
                listidseppsentr.splice(i, 1);
                listcantepp.splice(i, 1);
                break;
            }
        }
        $('#cant'+id).prop('hidden',true);
        listcantepp=[];
    }
}

$('#enviarnuepps').on('click', function () {
    if (listidseppsentr.length < 1 || listidseppsentr === undefined) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'Error ',
            text: 'Escoja almenos un epp a entregar',
            showConfirmButton: false,
            timer: 3000
        });
    }
    else {
        for(var i = 0; i < listidseppsentr.length; i++){
            listcantepp.push($('#cant'+listidseppsentr[i]).val());
        }
        if(validarFormulario()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'se iniciara una nueva entrega',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/covid/crearentregaApp',
                        type: 'GET',
                        data: {
                            _token: CSRF_TOKEN,
                            listidseppsentr: listidseppsentr,
                            listcantepp: listcantepp,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Operacion exitosa',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();
                                } else {
                                    // desbloquear();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'Error ',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    location.reload();
                                }
                            }
                        ,
                        beforeSend: function () {
                            $('#enviarnuepps').prop("disabled", true);
                        }
                    })
                    ;

                }
            })
        }else{
            operacionSubsanar();
        }
    }
});
function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
        for(var i = 0; i < listidseppsentr.length; i++){
            if ($('#cant'+listidseppsentr[i]).val() !== '' && $('#cant'+listidseppsentr[i]).val() !== '0') {
                validarCaja('cant'+listidseppsentr[i], 'validtipodocedit', 'Correcto', 1);
            } else {
                cont++;
                text = inicio + ' Seleccione Tipo de documento';
                validarCaja('cant'+listidseppsentr[i], 'validtipodocedit', text, 0);
            }
        }
    return cont;
}

