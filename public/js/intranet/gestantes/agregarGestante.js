var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    provincia('provacte',1);
    departamento('depar',0);
    datePickers();
});

var datePickers = function () {

    $('#fecnac').datepicker({
        todayHighlight: true,
        autoclose: true
    });


    $('#fecregla').datepicker({
        todayHighlight: true,
        autoclose: true
    });

};
$('#recargarpant').on('click', function () {
    location.reload(true);
});

$('#depar').on('change', function () {
    provincia('prov',this.value);
    var prov = $('#depar');
    var provvalid = $('#valdepar');

    if (this.value === '0') {
        $('#prov').prop('disabled', true);
        validarCaja('depar', 'valdepar', 'Escoja departamento', 0)
    }
    else {
        $('#prov').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
    }
});

$('#prov').on('change', function () {
    distrito(this.value, 'dis');
    var prov = $('#prov');
    var provvalid = $('#validDni');

    if (this.value === '0') {
        $('#dis').prop('disabled', true);
        validarCaja('prov', 'valprov', 'Escoja provincia', 0)
    }
    else {
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
    }
    else {
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
    }
    else {
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
    }
    else {
        $('#dis').prop('disabled', false);
        etniaval.removeClass('valid-feedback');
        etnia.removeClass('is-valid');
        etnia.removeClass('is-invalid');
        etniaval.addClass('invalid-feedback');
    }
});


$('#disacte').on('change', function () {
    eess(this.value);
    var disacte = $('#disacte');
    var valdisacte = $('#valdisacte');

    if (this.value === '0') {
        $('#estate').prop('disabled', true);
        validarCaja('disacte', 'valdisacte', 'Escoja distrito', 0)
    }
    else {
        $('#estate').prop('disabled', false);
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
    }
});


$('#estate').on('change', function () {

    var disacte = $('#estate');
    var valdisacte = $('#valestate');

    if (this.value === '0') {
        validarCaja('estate', 'valestate', 'Escoja establecimiento', 0)
    }
    else {
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
    }
});

$('#tipseg').on('change', function () {

    var disacte = $('#tipseg');
    var valdisacte = $('#valtipseg');

    if (this.value === '0') {
        validarCaja('tipseg', 'valtipseg', 'Escoja tipo seguro', 0)
    }
    else {
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
    }
});
$('#nivinstr').on('change', function () {

    var disacte = $('#nivinstr');
    var valdisacte = $('#valnivinstr');

    if (this.value === '0') {
        validarCaja('nivinstr', 'valnivinstr', 'Escoja nivel instruccion', 0)
    }
    else {
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
    }
});
$('#idiom').on('change', function () {

    var disacte = $('#idiom');
    var valdisacte = $('#validiom');

    if (this.value === '0') {
        validarCaja('idiom', 'validiom', 'Escoja idioma', 0)
    }
    else {
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
    }
});

$('#estaciv').on('change', function () {

    var disacte = $('#estaciv');
    var valdisacte = $('#valestaciv');

    if (this.value === '0') {
        validarCaja('estaciv', 'valestaciv', 'Escoja estado civil', 0)
    }
    else {
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
    }
});


$('#provacte').on('change', function () {
    distrito(this.value, 'disacte');
    var provacte = $('#provacte');
    var valprovacte = $('#valprovacte');

    if (this.value === '0') {
        $('#disacte').prop('disabled', true);
        validarCaja('provacte', 'valprovacte', 'Escoja provincia', 0)
    }
    else {
        $('#disacte').prop('disabled', false);
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

/*function provincia(id,iddep) {
    bloquear();
    var url = "/ubiprov/"+iddep;
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

function eess(val) {
    bloquear();
    var url = "/ubiess/" + val;
    var arreglo;
    var select = $('#estate').html('');
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
                    arreglo = data['eess'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        htmla = '<option value="' + arreglo[i]['idEess'] + '">' + arreglo[i]['descripcion'] + '</option>';
                        html = html + htmla;
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}

function centroPoblado() {
    bloquear();
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
                    desbloquear();
                } else {

                }
            }

        });
}


function fechaultimaRegla() {
    var fechault = $('#fecregla').val();
    date = fechault.split('/').reverse().join('/');
    fechault = new Date(fechault);
    fechault.setMonth(fechault.getMonth() + 12);
    fechault.setMonth(fechault.getMonth() + -3);
    fechault.setDate(fechault.getDate() + 7)
    var dd = fechault.getDate();
    var mm = fechault.getMonth() + 1;

    var yyyy = fechault.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var today = mm + '/' + dd + '/' + yyyy;
    $('#fecpart').val(today);
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
                    url: '/gestante/registrargestante',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idpersona: idpersona,
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

function validarDni() {

    bloquear();
    var dni = $('#dni').val();
    var url = "/valdni/" + dni;
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
                    var arreglo = data['cant'];
                    if (arreglo[0]['cant'] === 0) {
                        desbloquear();
                        $('#enviar').prop('disabled', false);
                        text = 'Dato correcto';
                        validarCaja('dni', 'validDni', text, 1);
                    }
                    else {
                        desbloquear();
                        llenarGestanteDni(dni);
                    }
                } else {

                }
            }

        });
}

function llenarGestanteDni(dni) {
    var url = "/obtenercontrolgestantedni/" + dni;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var arreglo = data['gestante'];
                if (data['error'] === 0) {
                    $('#idpersona').val(arreglo['idPersona']);
                    $('#nrohistoria').val(arreglo['nroHistoria']).prop('disabled', true);
                    $('#tipdoc').val(arreglo['tipoDoc']).prop('disabled', false);
                    $('#dni').prop('disabled', true);
                    $('#appaterno').val(arreglo['apPaterno']).prop('disabled', true);
                    $('#apmaterno').val(arreglo['apMaterno']).prop('disabled', true);
                    $('#pnombre').val(arreglo['pNombre']).prop('disabled', true);
                    $('#snombre').val(arreglo['sNombre']).prop('disabled', true);
                    $('#fecnac').val(arreglo['fecNac']).prop('disabled', true);
                    $('#telefo').val(arreglo['telefono']).prop('disabled', true);
                    $('#dir').val(arreglo['direccion']).prop('disabled', true);
                    $('#ref').val(arreglo['referencia']).prop('disabled', true);
                    $('#cenpo').val(arreglo['idCentroPoblado']).prop('disabled', true);
                    var select = $('#prov').html('');
                    var html = '<option  selected="">' + arreglo['prov'] + '</option>';
                    select.append(html);
                    select = $('#dis').html('');
                    html = '<option  selected="">' + arreglo['dist'] + '</option>';
                    select.append(html);
                    select = $('#etnia').html('');
                    html = '<option  selected="">' + arreglo['etnia'] + '</option>';
                    select.append(html);
                }

            }

        });
}

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#tipdoc').val() !== '0') {

        text = '';
        validarCaja('tipdoc', 'validtipodoc', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un tipo de documento';
        validarCaja('tipdoc', 'validtipodoc', text, 0);
    }
    if ($('#dni').val() !== '0') {
    }
    else {
        cont++;
        text = inicio + ' ingrese un numero de documento';
        validarCaja('dni', 'validDni', text, 0);
    }

    if ($('#nrohistoria').val() === '') {
        cont++;
        text = inicio + ' ingrese el numero de historia clinica';
        validarCaja('nrohistoria', 'valnrohistoria', text, 0);
    }
    else {

        text = 'Historia clinica correcta';
        validarCaja('nrohistoria', 'valnrohistoria', text, 1);
    }


    if ($('#appaterno').val() === '') {
        cont++;
        text = inicio + ' ingrese apellido paterno';
        validarCaja('appaterno', 'valappaterno', text, 0);
    }
    else {

        text = 'Apellido paterno correcto';
        validarCaja('appaterno', 'valappaterno', text, 1);
    }
    if ($('#apmaterno').val() === '') {
        cont++;
        text = inicio + ' ingrese apellido materno';
        validarCaja('apmaterno', 'valapmaterno', text, 0);
    }
    else {
        text = 'Apellido materno correcto';
        validarCaja('apmaterno', 'valapmaterno', text, 1);
    }
    if ($('#pnombre').val() === '') {
        cont++;
        text = inicio + ' ingrese primer nombre';
        validarCaja('pnombre', 'valpnombre', text, 0);
    }
    else {
        text = 'Primer nombre correcto';
        validarCaja('pnombre', 'valpnombre', text, 1);
    }
    if ($('#fecnac').val() === '') {
        cont++;
        text = inicio + ' ingrese fecha de nacimiento';
        validarCaja('fecnac', 'valfecnac', text, 0);
    }
    else {

        text = 'Fecha de nacimiento correcta';
        validarCaja('fecnac', 'valfecnac', text, 1);
    }
    /*if ($('#telefo').val() === '') {
        cont++;
        text = inicio + ' ingrese numero telefonico';
        validarCaja('telefo', 'telefovalid', text, 0);
    }
    else {

        text = 'Numero telefonico correcto';
        validarCaja('telefo', 'telefovalid', text, 1);
    }*/
    if ($('#prov').val() !== '0') {

        text = '';
        validarCaja('prov', 'valprov', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('prov', 'valprov', text, 0);

    }
    if ($('#depar').val() !== '0') {

        text = '';
        validarCaja('depar', 'valdepar', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('depar', 'valdepar', text, 0);

    }
    if ($('#dis').val() !== '0') {
        text = '';
        validarCaja('dis', 'valdis', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un distrito';
        validarCaja('dis', 'valdis', text, 0);

    }
    if ($('#dir').val() === '') {
        cont++;
        text = inicio + ' ingrese direccion';
        validarCaja('dir', 'dirval', text, 0);
    }
    else {

        text = 'Direccion correcta';
        validarCaja('dir', 'dirval', text, 1);
    }


    if ($('#etnia').val() !== '0') {
        text = '';
        validarCaja('etnia', 'etniaval', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione etnia';
        validarCaja('etnia', 'etniaval', text, 0);

    }
    if ($('#provacte').val() !== '0') {
        text = '';
        validarCaja('provacte', 'valprovacte', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione provincia';
        validarCaja('provacte', 'valprovacte', text, 0);

    }

    if ($('#disacte').val() !== '0') {
        text = '';
        validarCaja('disacte', 'valdisacte', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione distrito';
        validarCaja('disacte', 'valdisacte', text, 0);

    }
    if ($('#estate').val() !== '0') {
        text = '';
        validarCaja('estate', 'valestate', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione establecimiento';
        validarCaja('estate', 'valestate', text, 0);

    }

    if ($('#tipseg').val() !== '0') {
        text = '';
        validarCaja('tipseg', 'valtipseg', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione tipo de seguro';
        validarCaja('tipseg', 'valtipseg', text, 0);

    }
    if ($('#nivinstr').val() !== '0') {
        text = '';
        validarCaja('nivinstr', 'valnivinstr', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione nivel de instruccion';
        validarCaja('nivinstr', 'valnivinstr', text, 0);

    }
    if ($('#idiom').val() !== '0') {
        text = '';
        validarCaja('idiom', 'validiom', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione idioma';
        validarCaja('idiom', 'validiom', text, 0);

    }
    if ($('#estaciv').val() !== '0') {
        text = '';
        validarCaja('estaciv', 'valestaciv', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione estado civil';
        validarCaja('estaciv', 'valestaciv', text, 0);

    }

    if ($('#gest').val() === '') {
        cont++;
        text = inicio + ' ingrese Gesta';
        validarCaja('gest', 'valgest', text, 0);
    }
    else {
        text = 'Gesta correcto';
        validarCaja('gest', 'valgest', text, 1);
    }
    if ($('#pari').val() === '') {
        cont++;
        text = inicio + ' ingrese Paridad';
        validarCaja('pari', 'valpari', text, 0);
    }
    else {

        text = 'Paridad correcto';
        validarCaja('pari', 'valpari', text, 1);
    }
    if ($('#fecregla').val() === '') {
        cont++;
        text = inicio + ' ingrese fecha de ultima regla';
        validarCaja('fecregla', 'valfecregla', text, 0);
    }
    else {
        text = 'Fecha de ultima regla correcto';
        validarCaja('fecregla', 'valfecregla', text, 1);
    }
    return cont;
}
