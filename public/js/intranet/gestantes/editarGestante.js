$(document).ready(function () {
    completarDis();
    obtenerEtnia();
    obtenerSeguro();
    instruccion();
    idioma();
    estadocivil();
    eess();
    tipodoc();
});
function completarDepartamento(iddep) {
    bloquear();
    var url = "/departamento";
    var arreglo;
    var select = $('#depar').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['dep'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (arreglo[i]['idDepartamento'].toString() === iddep.toString()) {
                            htmla = '<option value="' + arreglo[i]['idDepartamento'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                        }
                        else {
                            htmla = '<option value="' + arreglo[i]['idDepartamento'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}

function eess() {
    bloquear();
    var valdis = $('#disacteb').val();
    var idest = $('#estateb').val();
    var url = "/ubiess/" + valdis;
    var arreglo;
    var select = $('#estate').html('');
    var html = '<option value="0" >SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['eess'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (arreglo[i]['idEess'].toString() === idest.toString()) {
                            htmla = '<option value="' + arreglo[i]['idEess'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                        }
                        else {
                            htmla = '<option value="' + arreglo[i]['idEess'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    distEstable(valdis);
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}

function distEstable(iddis) {

    bloquear();
    var provacteb = $('#provacteb').val();

    var url = "/ubidis/" + provacteb;
    var arreglo;
    var select = $('#disacte').html('');
    var html = '<option value="0" >SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['dis'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (arreglo[i]['idDistrito'].toString() === iddis.toString()) {

                            htmla = '<option value="' + arreglo[i]['idDistrito'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';

                        }
                        else {
                            htmla = '<option value="' + arreglo[i]['idDistrito'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                   provEstable(provacteb);
                } else {

                }
            }

        });
}
function provEstable(idprov) {
    bloquear();
    var url = "/ubiprov/1";
    var arreglo;
    var select = $('#provacte').html('');
    var html = '<option  selected="" value="0">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['prov'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (arreglo[i]['idProvincia'].toString() === idprov.toString()) {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                        }
                        else {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {


                }
            }

        });
}

function completarDis() {
    bloquear();
    var idprovb = $('#idprovb').val();
    var idistp = $('#iddisb').val();

    var url = "/ubidis/" + idprovb;
    var arreglo;
    var select = $('#dis').html('');
    var html = '<option value="0" >SELECCIONE</option>';

    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['dis'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (arreglo[i]['idDistrito'].toString() === idistp.toString()) {

                            htmla = '<option value="' + arreglo[i]['idDistrito'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';

                        }
                        else {
                            htmla = '<option value="' + arreglo[i]['idDistrito'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                   completarprov(idprovb);
                } else {

                }
            }

        });
}

function completarprov(idprovincia) {
    bloquear();
    var iddepa = $('#iddepa').val();
    var url = "/ubiprov/"+iddepa;
    var arreglo;
    var select = $('#prov').html('');
    var html = '<option  selected="" value="0">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['prov'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (arreglo[i]['idProvincia'].toString() === idprovincia.toString()) {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                        }
                        else {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    completarDepartamento(iddepa);
                    desbloquear();
                } else {


                }
            }

        });

}

function obtenerEtnia() {
    var etniaarray = [];
    $("#etnia option").each(function () {
        if ($(this).val() !== '0')
            etniaarray.push($(this).val());
    });
    var etniabu = $('#etniabu').val();
    var select = $('#etnia').html('');
    var html = '<option  selected="" value="0">SELECCIONE</option>';
    var htmla = '';
    for (var i = 0; i < etniaarray.length; i++) {
        if (etniaarray[i].toString() === etniabu.toString()) {
            htmla = '<option  selected>' + etniaarray[i] + '</option>';
        }
        else {
            htmla = '<option >' + etniaarray[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}


function tipodoc() {
   var tipdoc= $("#tipodocb").val();
    $("#tipdoc").val(tipdoc);
}

function obtenerSeguro() {
    var segarray = [];
    $("#tipseg option").each(function () {
        if ($(this).val() !== '0')
            segarray.push($(this).val());
    });
    var tipsegb = $('#tipsegb').val();
    var select = $('#tipseg').html('');
    var html = '<option   value="0">SELECCIONE</option>';
    var htmla = '';
    for (var i = 0; i < segarray.length; i++) {
        if (segarray[i].toString() === tipsegb.toString()) {
            htmla = '<option  selected>' + segarray[i] + '</option>';
        }
        else {
            htmla = '<option >' + segarray[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}


function instruccion() {
    var insarray = [];
    $("#nivinstr option").each(function () {
        if ($(this).val() !== '0')
            insarray.push($(this).val());
    });
    var nivinstrb = $('#nivinstrb').val();
    var select = $('#nivinstr').html('');
    var html = '<option   value="0">SELECCIONE</option>';
    var htmla = '';
    for (var i = 0; i < insarray.length; i++) {
        if (insarray[i].toString() === nivinstrb.toString()) {
            htmla = '<option  selected>' + insarray[i] + '</option>';
        }
        else {
            htmla = '<option >' + insarray[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}

function idioma() {
    var idiomarray = [];
    $("#idiom option").each(function () {
        if ($(this).val() !== '0')
            idiomarray.push($(this).val());
    });
    var idiomb = $('#idiomb').val();
    var select = $('#idiom').html('');
    var html = '<option   value="0">SELECCIONE</option>';
    var htmla = '';
    for (var i = 0; i < idiomarray.length; i++) {
        if (idiomarray[i].toString() === idiomb.toString()) {
            htmla = '<option  selected>' + idiomarray[i] + '</option>';
        }
        else {
            htmla = '<option >' + idiomarray[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}

function estadocivil() {
    var estadocivilarray = [];
    $("#estaciv option").each(function () {
        if ($(this).val() !== '0')
            estadocivilarray.push($(this).val());
    });
    var estacivb = $('#estacivb').val();
    var select = $('#estaciv').html('');
    var html = '<option   value="0">SELECCIONE</option>';
    var htmla = '';
    for (var i = 0; i < estadocivilarray.length; i++) {
        if (estadocivilarray[i].toString() === estacivb.toString()) {
            htmla = '<option  selected>' + estadocivilarray[i] + '</option>';
        }
        else {
            htmla = '<option >' + estadocivilarray[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}

function enviarEditar() {
    var cant = validarFormulario();
    if (cant === 0) {
        bloquear();
//datos persona
        var idpersona = $('#idpersona').val();
        var idgestante = $('#idgestante').val();
        var nrohistoria = $('#nrohistoria').val();
        var tipdoc = $('#tipdoc').val();
        var dni = $('#dni').val();
        var appaterno = $('#appaterno').val();
        var apmaterno = $('#apmaterno').val();
        var pnombre = $('#pnombre').val();
        var snombre = $('#snombre').val();
        var fecnac = $('#fecnac').val();
        var telefo = $('#telefo').val();
        //ubicacion
        var iddis = $('#dis').val();
        var dir = $('#dir').val();
        var cenpo = $('#cenpo').val();
        var ref = $('#ref').val();
        var etnia = $('#etnia').val();
        //establecimiento
        var estate = $('#estate').val();
        /// datos adicionales//
        var tipseg = $('#tipseg').val();
        var nivinstr = $('#nivinstr').val();
        var estaciv = $('#estaciv').val()
        ////fromula obs
        var gest = $('#gest').val();
        var pari = $('#pari').val();
        ////dato embarazo
        var fecregla = $('#fecregla').val();
        var fecpart = $('#fecpart').val();
        var idiom = $('#idiom').val();
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editaran los datos de la gestante',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/gestante/editargestante',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idpersona: idpersona,
                        idgestante:idgestante,
                        nrohistoria: nrohistoria,
                        tipdoc: tipdoc,
                        dni: dni,
                        appaterno: appaterno,
                        apmaterno: apmaterno,
                        pnombre: pnombre,
                        snombre: snombre,
                        fecnac: fecnac,
                        telefo: telefo,
                        iddis: iddis,
                        dir: dir,
                        cenpo: cenpo,
                        ref: ref,
                        etnia: etnia,
                        estate: estate,
                        tipseg: tipseg,
                        nivinstr: nivinstr,
                        estaciv: estaciv,
                        gest: gest,
                        pari: pari,
                        fecregla: fecregla,
                        fecpart: fecpart,
                        idiom: idiom
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                redirect('/gestante/reportar');
                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Operacion exitosa',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            } else {
                                redirect('/gestante/reportar');
                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    type: 'error',
                                    title: 'Operacion exitosa',
                                    text: data['error'],
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                            }


                        }

                    ,
                    beforeSend: function () {
                        bloquear();
                    }
                })
                ;

            }
        })
    }

    else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'Error en el formulario',
            text: 'El formulario tiene errores, porfavor susbane los errores y de clic en guardar',
            showConfirmButton: false,
            timer: 4000
        });
    }
}
