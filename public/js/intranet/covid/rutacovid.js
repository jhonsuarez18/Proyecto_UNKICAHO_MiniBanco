var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    datePickers();
    departamento('depar',0);
    llenarDatosRuta();
    cargarDatos();
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

var list = [];
$('#addmovi').on('click', function () {
    list = [];
    window.event.preventDefault();
    var modal = $('#modal-dialog');
    modal.modal('show');
});

$('#cemod').on('click', function () {
    //  window.event.preventDefault();
    location.reload();
});

$('#addcontacto').on('click', function () {
    var contacto = $('#contacto');
    list.push(contacto.val().toUpperCase());
    addlistContacto(list);
    contacto.focus();
    contacto.val('');
});

function addlistContacto(lista) {
    var listacontact = $('#listacont').html('');
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


var datePickers = function () {

    $('#fecreu').datepicker({
        todayHighlight: true,
        autoclose: true
    });
};


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


function enviar() {
    var modal = $('#modal-dialog');
    var cant = validarFormulario();
    if (cant === 0) {
        bloquear();
        var fecreu = $('#fecreu').val();
        var dis = $('#dis').val();
        var activid = $('#activid').val();
        var contactos = list;
        var idpaciente = $('#idpaciente').val();
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se ingresara una nueva gestante',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/covid/registrarlugares',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        dis: dis,
                        fecreu: fecreu,
                        activid: activid,
                        contactos: contactos,
                        idpaciente: idpaciente
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                modal.modal('hide');

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Operacion exitosa',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                llenarDatosRuta();
                                desbloquear();
                            } else {
                                modal.modal('hide');
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
                                llenarDatosRuta();
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
    if ($('#depar').val() !== '0') {
        text = '';
        validarCaja('depar', 'valdepar', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('depar', 'valdepar', text, 0);
    }
    if ($('#prov').val() !== '0') {
        text = '';
        validarCaja('prov', 'valprov', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('prov', 'valprov', text, 0);
    }
    if ($('#dis').val() !== '0') {
        text = '';
        validarCaja('dis', 'valdis', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione un distrito';
        validarCaja('dis', 'valdis', text, 0);
    }
    if ($('#fecreu').val() === '') {
        cont++;
        text = inicio + ' Ingrese fecha';
        validarCaja('fecreu', 'valfecreu', text, 0);
    } else {

        text = 'Fecha correcta';
        validarCaja('fecreu', 'valfecreu', text, 1);
    }
    if ($('#activid').val() === '') {
        cont++;
        text = inicio + 'Ingrese descripcion de la actividad';
        validarCaja('activid', 'valactivid', text, 0);
    } else {

        text = 'Fecha correcta';
        validarCaja('activid', 'valactivid', text, 1);
    }
    return cont;
}

function llenarDatosRuta() {
    var time = $('#timeline');
    time.empty();
    var idpaciente = $('#idpaciente').val();
    bloquear();
    var url = "/covid/obtenerruta/" + idpaciente;
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

                    var timeline = '';
                    var fecant;
                    for (var i = 0; i < result.length; i++) {

                        if (fecant !== result[i]['lvpfecVisita']) {
                            var lista = '';
                            var part1 = '   <li>\n' +
                                '                            <div class="timeline-time">\n' +
                                '                                <span class="date">' + result[i]['lvpfecVisita'] + '</span>\n' +
                                '                            </div>\n' +
                                '                            <div class="timeline-icon">\n' +
                                '                                <a href="javascript:;">&nbsp;</a>\n' +
                                '                            </div>\n' +
                                '                            <div class="timeline-body">\n' +
                                '                                <div class="timeline-header">\n' +
                                '                                    <dt class="text-inverse text-left  text-truncate">LUGAR : </dt>\n' +
                                '                                    <dd class=" text-truncate">' + result[i]['lugar'] + '</dd>\n' +
                                '                                </div>\n' +
                                '                                <div class="timeline-content">\n' +
                                '                                    <dt class="text-inverse text-left  text-truncate" >ACTIVIDAD :</dt>\n' +
                                '                                    <dd class=" text-truncate">' + result[i]['lvpactividad'] + '<dt class="text-inverse text-left  text-truncate">CONTACTOS :</dt>\n' +
                                '                                    <dd class=" text-truncate">\n' +
                                '                                        <ul id="contc' + result[i]['lvpidLugarVisitaPaciente'] + '">\n';
                            for (var j = 0; j < result.length; j++) {
                                var part3 = '';
                                if (result[i]['lvpfecVisita'] === result[j]['lvpfecVisita']) {
                                    if (result[j]['cvidPersona'] === null)
                                        part3 = '<li>' + result[j]['cvdescripcion'] + '   <a href="covid/veragregarpacientecovid/' + result[j]['cvidContactoVisita'] + '/' + result[j]['lvpidPacienteCovid'] + '" \n' +
                                            '                           title="click para identificar contacto" data-toggle="ajax"><snall style="color: red"> (no identificado)</small></a></li>';
                                    else
                                        part3 = '<li>' + result[j]['cvdescripcion'] + ' <snall style="color: green"> (identificado)</small>  </li>';
                                    lista = lista + part3;
                                }
                            }
                            var part2 = '                                        </ul>\n' +
                                '                                    </dd>\n' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '                        </li>';
                            timeline = timeline + part1 + lista + part2;
                            fecant = result[i]['lvpfecVisita'];
                        }
                    }
                    time.append(timeline);
                } else {

                }
            }

        });
}

function cargarDatos() {
    bloquear();
    var idpaciente = $('#idpaciente').val();
    var url = "/covid/obtenerpacientecoviddidpaciente/" + idpaciente;
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
                    $('#dni').val(result['numeroDoc']).prop("disabled", true);
                    $('#nombres').val(result['apPaterno']+' '+result['apMaterno']+', '+result['pNombre']+' '+result['sNombre']);
                    $('#fecnac').val(result['fecNac']).prop("disabled", true);
                    $('#telefo').val(result['telefono']).prop("disabled", true);
                    $('#dir').val(result['pedir']).prop("disabled", true);
                    $('#fecdiag').val(result['fecExamen']).prop("disabled", true);
                    $('#fecsinini').val(result['fecSintIni']).prop("disabled", true);
                    $('#ref').val(result['referencia']).prop("disabled", true);
                    completarDis(result['dispe'],'lugna');
                    $('#lugcont').val(result['dircont']);
                    llenarMorbilidad(idpaciente);
                    desbloquear();
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
function completarDis(iddisval,idinp) {
    bloquear();
    var url = "/obtenerubicacion/" + iddisval;
    var arreglo='';
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
                    $('#'+idinp).val(arreglo['depdescripcion'] +' - ' + arreglo['prodescripcion']  +' - ' + arreglo['disdescripcion'] );
                    desbloquear();
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
function llenarMorbilidad(idpaciente) {
    $('#morbilidad').prop("disabled", true);
    var  hrefclic= $('#addmorbilidad');
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
                    var result=data['result'];
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
