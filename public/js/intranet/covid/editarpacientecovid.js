var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var list = [];
$(document).ready(function () {
    completarDis();
    distContg();
    datePickers();
    tipodoc();
    tippru();
    llenarMorbilidad();
});

function tipodoc() {
    var tipdoc = $("#tipodocb").val();
    $("#tipdoc").val(tipdoc);
}

function tippru() {
    var tiprue = $("#idestpruebp").val();
    $("#estprueb").val(tiprue);
}

var datePickers = function () {

    $('#fecdiag').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecsinini').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecnac').datepicker({
        todayHighlight: true,
        autoclose: true
    });

};

function completarDis() {

    var idprovb = $('#idprov').val();
    var idistp = $('#iddis').val();
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

                        } else {
                            htmla = '<option value="' + arreglo[i]['idDistrito'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                    completarprov(idprovb);
                } else {

                }
            },
            beforeSend: function () {
                bloquear();
            }

        });
}

function completarprov(idprovincia) {

    var iddepa = $('#iddep').val();
    var url = "/ubiprov/" + iddepa;
    var arreglo;
    var select = $('#prov').html('');
  var html = '';
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
                        } else {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    completarDepartamento(iddepa);
                    desbloquear();
                } else {


                }
            },
            beforeSend: function () {
                bloquear();
            }

        });

}

function completarDepartamento(iddep) {
    var url = "/departamento";
    var arreglo;
    var select = $('#depar').html('');
    var html = '';
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
                        } else {
                            htmla = '<option value="' + arreglo[i]['idDepartamento'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            },
            beforeSend: function () {
                bloquear();
            }

        });
}

function distContg() {
    var provacteb = $('#idprovcon').val();
    var iddis = $('#iddiscon').val();
    var url = "/ubidis/" + provacteb;
    var arreglo;
    var select = $('#discon').html('');
    var html = '';
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

                        } else {
                            htmla = '<option value="' + arreglo[i]['idDistrito'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                    provCont(provacteb);
                } else {

                }
            },
            beforeSend: function () {
                bloquear();
            }

        });
}

function provCont(idprov) {

    var url = "/ubiprov/1";
    var arreglo;
    var select = $('#provcon').html('');
    var html = '';
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
                        } else {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        }
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {


                }
            },
            beforeSend: function () {
                bloquear();
            }

        });
}

$('#depar').on('change', function () {
    provincia('prov', this.value);
    var prov = $('#depar');
    var provvalid = $('#valdepar');

    if (this.value === '0') {
        $('#prov').prop('disabled', true);
        validarCaja('depar', 'valdepar', 'Escoja departamento', 0)
    } else {
        $('#prov').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
    }
});

/*function provincia(id, iddep) {
    bloquear();
    var url = "/ubiprov/" + iddep;
    var arreglo;
    var select = $('#' + id).html('');
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

                        htmla = '<option value="' + arreglo[i]['idProvincia'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {


                }
            }

        });
}*/

$('#prov').on('change', function () {
    distrito(this.value, 'dis');
    var prov = $('#prov');
    var provvalid = $('#validDni');

    if (this.value === '0') {
        $('#dis').prop('disabled', true);
        validarCaja('prov', 'valprov', 'Escoja provincia', 0)
    } else {
        $('#dis').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
    }
});

/*function distrito(val, id) {
    bloquear();
    var url = "/ubidis/" + val;
    var arreglo;
    var select = $('#' + id).html('');
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
                    arreglo = data['dis'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        htmla = '<option value="' + arreglo[i]['idDistrito'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}*/

$('#provcon').on('change', function () {
    distrito(this.value, 'discon');
    var prov = $('#provcon');
    var provvalid = $('#validDni');

    if (this.value === '0') {
        $('#dis').prop('disabled', true);
        validarCaja('prov', 'valprov', 'Escoja provincia', 0)
    } else {
        $('#dis').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
    }
});

/*function distrito(val, id) {
    bloquear();
    var url = "/ubidis/" + val;
    var arreglo;
    var select = $('#' + id).html('');
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
                    arreglo = data['dis'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        htmla = '<option value="' + arreglo[i]['idDistrito'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}*/

``

function llenarMorbilidad() {
    var idpaciente = $('#idpaciente').val();
    var morb = $('#morbilidad');
    var url = "/covid/morbililista/" + idpaciente;
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
                    var listacontact = $('#lista').html('');
                    var htmla = '', html = '';
                    for (var i = 0; i < result.length; i++) {

                        htmla = '<li > <strong>' + result[i]['descripcion'] + '</strong><a href="#" onclick="eliminarMorbilidad(' +result[i]['idMorbilidadpacientecovid'] + ')" style="text-decoration:none"> <i style="color: red" title="Quitar" class="fa fa-minus-circle" ></i></a></li>';
                        html = htmla + html;
                        list.push(result[i]['descripcion']);
                    }
                    listacontact.append(html);
                    morb.focus();
                    morb.val('');
                } else {

                }
            }

        });

}


$('#addmorbilidad').on('click', function () {
    window.event.preventDefault();
    var idpaciente = $('#idpaciente').val();
    var morbilidad = $('#morbilidad').val();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se agregara una nueva morbilidad al paciente',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/covid/agregarmorbilidad',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idpaciente: idpaciente,
                    morbilidad: morbilidad,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Registro de morbilidad exitosa',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            desbloquear();
                            llenarMorbilidad();
                        } else {
                            desbloquear();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });
                            llenarMorbilidad();
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
});
function eliminarMorbilidad(idmorb) {
    window.event.preventDefault();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara una morbilidad',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/covid/eliminarmorbilidad',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idmorb: idmorb,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Morbilidad Eliminada',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            desbloquear();
                            llenarMorbilidad();
                        } else {
                            desbloquear();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });
                            llenarMorbilidad();
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

function enviar() {
    var cant = validarFormulario();
    if (cant === 0) {
        bloquear();
//datos persona

        var idpersona = $('#idpersona').val();
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
        //disdatoscontagio
        var discon = $('#discon').val();
        var idcontactovisita = $('#idcontactovisita').val();
        var fecdiag = $('#fecdiag').val();
        var fecsinini = $('#fecsinini').val();
        var estprueb = $('#estprueb').val();
        var idpaciente = $('#idpaciente').val();
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se ingresara una nuevo sospechoso de covid-19',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/covid/editarpacientecovid',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idpaciente: idpaciente,
                        tipdoc: tipdoc,
                        dni: dni,
                        idcontactovisita: idcontactovisita,
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
                        discon: discon,
                        fecdiag: fecdiag,
                        fecsinini: fecsinini,
                        estprueb: estprueb,
                        list: list
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                    redirect('/covid/reporte');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de paciente sospechoso de covid exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });

                                desbloquear();

                            } else {
                                redirect('');
                                desbloquear();
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

                    ,
                    beforeSend: function () {
                        $('#enviar').prop("disabled", true);
                        bloquear();
                    }
                })
                ;

            }
        })
    } else {
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

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#tipdoc').val() !== '0') {

        text = '';
        validarCaja('tipdoc', 'validtipodoc', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione un tipo de documento';
        validarCaja('tipdoc', 'validtipodoc', text, 0);
    }
    if ($('#dni').val() !== '0') {
    } else {
        cont++;
        text = inicio + ' ingrese un numero de documento';
        validarCaja('dni', 'validDni', text, 0);
    }

    if ($('#nrohistoria').val() === '') {
        cont++;
        text = inicio + ' ingrese el numero de historia clinica';
        validarCaja('nrohistoria', 'valnrohistoria', text, 0);
    } else {

        text = 'Historia clinica correcta';
        validarCaja('nrohistoria', 'valnrohistoria', text, 1);
    }


    if ($('#appaterno').val() === '') {
        cont++;
        text = inicio + ' ingrese apellido paterno';
        validarCaja('appaterno', 'valappaterno', text, 0);
    } else {

        text = 'Apellido paterno correcto';
        validarCaja('appaterno', 'valappaterno', text, 1);
    }
    if ($('#apmaterno').val() === '') {
        cont++;
        text = inicio + ' ingrese apellido materno';
        validarCaja('apmaterno', 'valapmaterno', text, 0);
    } else {
        text = 'Apellido materno correcto';
        validarCaja('apmaterno', 'valapmaterno', text, 1);
    }
    if ($('#pnombre').val() === '') {
        cont++;
        text = inicio + ' ingrese primer nombre';
        validarCaja('pnombre', 'valpnombre', text, 0);
    } else {
        text = 'Primer nombre correcto';
        validarCaja('pnombre', 'valpnombre', text, 1);
    }
    if ($('#fecnac').val() === '') {
        cont++;
        text = inicio + ' ingrese fecha de nacimiento';
        validarCaja('fecnac', 'valfecnac', text, 0);
    } else {

        text = 'Fecha de nacimiento correcta';
        validarCaja('fecnac', 'valfecnac', text, 1);
    }

    if ($('#prov').val() !== '0') {

        text = '';
        validarCaja('prov', 'valprov', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('prov', 'valprov', text, 0);

    }
    if ($('#depar').val() !== '0') {

        text = '';
        validarCaja('depar', 'valdepar', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('depar', 'valdepar', text, 0);

    }
    if ($('#dis').val() !== '0') {
        text = '';
        validarCaja('dis', 'valdis', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione un distrito';
        validarCaja('dis', 'valdis', text, 0);

    }
    if ($('#dir').val() === '') {
        cont++;
        text = inicio + ' ingrese direccion';
        validarCaja('dir', 'dirval', text, 0);
    } else {

        text = 'Direccion correcta';
        validarCaja('dir', 'dirval', text, 1);
    }


    if ($('#provcon').val() !== '0') {
        text = '';
        validarCaja('provcon', 'valprovcon', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione provincia';
        validarCaja('provcon', 'valprovcon', text, 0);

    }

    if ($('#discon').val() !== '0') {
        text = '';
        validarCaja('discon', 'valdiscon', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione distrito';
        validarCaja('discon', 'valdiscon', text, 0);

    }
    if ($('#estate').val() !== '0') {
        text = '';
        validarCaja('estate', 'valestate', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione establecimiento';
        validarCaja('estate', 'valestate', text, 0);

    }

    if ($('#tipseg').val() !== '0') {
        text = '';
        validarCaja('tipseg', 'valtipseg', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione tipo de seguro';
        validarCaja('tipseg', 'valtipseg', text, 0);

    }
    if ($('#nivinstr').val() !== '0') {
        text = '';
        validarCaja('nivinstr', 'valnivinstr', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione nivel de instruccion';
        validarCaja('nivinstr', 'valnivinstr', text, 0);

    }
    if ($('#idiom').val() !== '0') {
        text = '';
        validarCaja('idiom', 'validiom', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione idioma';
        validarCaja('idiom', 'validiom', text, 0);

    }
    if ($('#estaciv').val() !== '0') {
        text = '';
        validarCaja('estaciv', 'valestaciv', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione estado civil';
        validarCaja('estaciv', 'valestaciv', text, 0);

    }

    if ($('#gest').val() === '') {
        cont++;
        text = inicio + ' ingrese Gesta';
        validarCaja('gest', 'valgest', text, 0);
    } else {
        text = 'Gesta correcto';
        validarCaja('gest', 'valgest', text, 1);
    }
    if ($('#pari').val() === '') {
        cont++;
        text = inicio + ' ingrese Paridad';
        validarCaja('pari', 'valpari', text, 0);
    } else {

        text = 'Paridad correcto';
        validarCaja('pari', 'valpari', text, 1);
    }
    if ($('#fecregla').val() === '') {
        cont++;
        text = inicio + ' ingrese fecha de ultima regla';
        validarCaja('fecregla', 'valfecregla', text, 0);
    } else {
        text = 'Fecha de ultima regla correcto';
        validarCaja('fecregla', 'valfecregla', text, 1);
    }
    return cont;
}
