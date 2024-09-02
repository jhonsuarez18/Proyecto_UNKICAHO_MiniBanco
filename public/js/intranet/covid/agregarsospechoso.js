var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var list = [];
$(document).ready(function () {
    provincia('provcon', 1);
    departamento('depar', 0);
    datePickers();
    llenarOficinas();

});

var datePickers = function () {

    $('#fecnac').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecdiag').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecsinini').datepicker({
        todayHighlight: true,
        autoclose: true
    });

};
$('#recargarpant').on('click', function () {
    location.reload(true);
});

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

$('#prov').on('change', function () {
    distrito_pac(this.value, 'dis');
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
$('#dis').on('change', function () {

    var dis = $('#dis');
    var disval = $('#valdis');

    if (this.value === '0') {
        validarCaja('dis', 'valdis', 'Escoja distrito', 0)
    } else {
        $('#dis').prop('disabled', false);
        disval.removeClass('valid-feedback');
        dis.removeClass('is-valid');
        dis.removeClass('is-invalid');
        disval.addClass('invalid-feedback');
    }
});

$('#tipdoc').on('change', function () {
    var dni = $('#dni');
    var tipdoc = $('#validDni');
    var tipodocval = $('#validtipodoc');
    if (this.value === '0') {
        dni.val('');
        dni.prop('disabled', true);
        validarCaja('tipdoc', 'validtipodoc', 'Escoja tipo documento', 0)
    } else {
        dni.prop('disabled', false);
        dni.val('');
        validarCaja('tipdoc', 'validtipodoc', '', 1)
    }

});

$('#etnia').on('change', function () {

    var etnia = $('#etnia');
    var etniaval = $('#etniaval');

    if (this.value === '0') {
        validarCaja('etnia', 'etniaval', 'Escoja etnia', 0)
    } else {
        $('#dis').prop('disabled', false);
        etniaval.removeClass('valid-feedback');
        etnia.removeClass('is-valid');
        etnia.removeClass('is-invalid');
        etniaval.addClass('invalid-feedback');
    }
});


$('#provcon').on('change', function () {
    distrito_pac(this.value, 'discon');
    var provacte = $('#provcon');
    var valprovacte = $('#valprovcon');

    if (this.value === '0') {
        $('#discon').prop('disabled', true);
        validarCaja('provcon', 'valprovcon', 'Escoja provincia', 0)
    } else {
        $('#discon').prop('disabled', false);
        valprovacte.removeClass('valid-feedback');
        provacte.removeClass('is-valid');
        provacte.removeClass('is-invalid');
        valprovacte.addClass('invalid-feedback');
    }
});


/*function departamento() {
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
                        htmla = '<option value="' + arreglo[i]['idDepartamento'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}*/

function distrito_pac(val, id) {
    //bloquear();
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
                    // desbloquear();
                } else {

                }
            }

        });
}

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


function centroPoblado() {
    //  bloquear();
    var url = "/ubiess/" + val;
    var arreglo;
    var select = $('#estate').html('');
    var html = '<option value="" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "POST",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['eess'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        htmla = '<option value="' + arreglo[i]['idEess'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                    //desbloquear();
                } else {

                }
            }

        });
}


function enviar() {
    var cant = validarFormulario();
    if (cant === 0) {
        // bloquear();
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
        var ofici = $('#ofici').val();
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
                    url: '/covid/registrarpacientecovid',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
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
                        list: list,
                        ofici: ofici
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                if (idcontactovisita === '0') {
                                    redirect('/covid/reporte');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de paciente sospechoso de covid exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    redirect('/covid/reportecovid/' + idpaciente);
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de contacto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                                //  desbloquear();

                            } else {
                                redirect('');
                                //   desbloquear();
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
                        //  bloquear();
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

function enviarConDatos() {

    var idpaciente = $('#idpaciente').val();
    var idpersona = $('#idpersona').val();
    var idcontactovisita = $('#idcontactovisita').val();
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
                url: '/covid/registrarcontactopaciente',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idpersona: idpersona,
                    idcontactovisita: idcontactovisita,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            redirect('/covid/reportecovid/' + idpaciente);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Registro de contacto exitoso',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            // desbloquear();
                        } else {
                            // desbloquear();
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


                    }, beforeSend: function () {
                    $('#enviar').prop("disabled", true);
                    //    bloquear();
                }
            })
            ;

        }
    })


}

function validarDni() {

    var dni = $('#dni').val();
    var cvidContactoVisita = $('#idcontactovisita').val();
    var url = "/covid/obtenerpacientecoviddni/" + dni;
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
                    var result = data['result'];
                    if (result) {
                        $('#idpersona').val(result['idPersona']);
                        $('#tipdoc').prop("disabled", true);
                        $('#dni').val(result['numeroDoc']).prop("disabled", true);
                        $('#appaterno').val(result['apPaterno']).prop("disabled", true);
                        $('#apmaterno').val(result['apMaterno']).prop("disabled", true);
                        $('#pnombre').val(result['pNombre']).prop("disabled", true);
                        $('#snombre').val(result['sNombre']).prop("disabled", true);
                        $('#fecnac').val(result['fecNac']).prop("disabled", true);
                        $('#telefo').val(result['telefono']).prop("disabled", true);
                        $('#dir').val(result['direccion']).prop("disabled", true);
                        $('#cenpo').val(result['sNombre']).prop("disabled", true);
                        $('#fecdiag').val(result['fecExamen']).prop("disabled", true);
                        $('#fecsinini').val(result['fecSintIni']).prop("disabled", true);
                        $('#ref').val(result['referencia']).prop("disabled", true);
                        completarDis(result['idDistrito']);
                        completarDisCont(result['paidDistrito']);
                        estPrueba(result['estadoPrueba']);
                        llenarMorbilidad(result['idPacienteCovid']);
                        //  desbloquear();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El paciente ya esta registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        if (cvidContactoVisita !== '0') {
                            $("#enviar").attr("onclick", "enviarConDatos()");
                        } else {
                            redirect('/covid/reporte');
                        }

                    }
                    //  desbloquear();
                } else {

                }
            }, beforeSend: function () {
                // bloquear();
            },

        });
}

function llenarMorbilidad(idpaciente) {
    $('#morbilidad').prop("disabled", true);
    var hrefclic = $('#addmorbilidad');
    hrefclic.removeAttr('href');
    hrefclic.attr("onclick", "").unbind("click");
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
                        htmla = '<li > <strong>-</strong> ' + result[i]['descripcion'] + '</li>';
                        html = htmla + html;
                    }
                    listacontact.append(html);
                } else {

                }
            }

        });
}

function estPrueba(idesprueb) {
    var arrayPrueba = [];
    $("#estprueb option").each(function () {
        arrayPrueba.push($(this).text());
    });
    var select = $('#estprueb').html('');
    var htmla = '';
    for (var i = 0; i < arrayPrueba.length; i++) {
        if (i === idesprueb) {
            htmla = '<option  selected disabled="">' + arrayPrueba[i] + '</option>';
            break;
        }
    }
    select.append(htmla).prop("disabled", true);
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


    /*  if ($('#provcon').val() !== '0') {
          text = '';
          validarCaja('provcon', 'valprovcon', text, 1);
      } else {
          cont++;
          text = inicio + ' seleccione provincia';
          validarCaja('provcon', 'valprovcon', text, 0);

      }
  */
    /*  if ($('#discon').val() !== '0') {
          text = '';
          validarCaja('discon', 'valdiscon', text, 1);
      } else {
          cont++;
          text = inicio + ' seleccione distrito';
          validarCaja('discon', 'valdiscon', text, 0);

      }*/
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

function completarDis(iddisval) {
    //bloquear();
    var url = "/obtenerubicacion/" + iddisval;
    var arreglo;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['ubic'];
                    $('#prov').append('<option  selected="">' + arreglo['prodescripcion'] + '</option>').prop("disabled", true);
                    $('#dis').append('<option  selected="">' + arreglo['disdescripcion'] + '</option>').prop("disabled", true);
                    $('#depar').append('<option  selected="">' + arreglo['depdescripcion'] + '</option>').prop("disabled", true);
                    // desbloquear();
                } else {

                }
            }

        });
}

function completarDisCont(iddisval) {
   // bloquear();
    var url = "/obtenerubicacion/" + iddisval;
    var arreglo;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['ubic'];
                    $('#provcon').append('<option  selected="">' + arreglo['prodescripcion'] + '</option>').prop("disabled", true);
                    $('#discon').append('<option  selected="">' + arreglo['disdescripcion'] + '</option>').prop("disabled", true);

                    //  desbloquear();
                } else {

                }
            }

        });
}

$('#addmorbilidad').on('click', function () {
    var morbilidad = $('#morbilidad');
    var ubi = 0;
    for (var i = 0; i < list.length; i++) {
        if (list[i].toString() === morbilidad.val().toUpperCase()) {
            ubi = 1;
        }
    }
    if (ubi === 0)
        list.push(morbilidad.val().toUpperCase());
    addlistContacto(list);
    morbilidad.focus();
    morbilidad.val('');
});

function addlistContacto(lista) {
    var listacontact = $('#lista').html('');
    var htmla = '', html = '';
    for (var i = 0; i < lista.length; i++) {
        htmla = '<li > <strong>-</strong> ' + lista[i] + '<a href="#" onclick="delListContacto(' + [i] + ')" style="text-decoration:none"> <i style="color: red" title="Quitar" class="fa fa-minus-circle" ></i></a></li>';
        html = htmla + html;
    }
    listacontact.append(html);
}

function delListContacto(id) {
    list.splice(id, 1);
    addlistContacto(list);
}

function llenarOficinas() {
   // bloquear();
    var url = "/ubicacion/obteneroficinas";
    var arreglo;
    var select = $('#ofici').html('');
    var html = '<option value="" selected="">SELECCIONE</option>';
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
                    htmla = '<option value="' + data[i]['idofi'] + '">' + data[i]['ofi'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
                //  desbloquear();

            }

        });
}
