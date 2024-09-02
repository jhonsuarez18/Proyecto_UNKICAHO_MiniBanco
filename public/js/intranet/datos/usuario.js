var sit=0;
var camposadd = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    tablaUsuarios();
    datePickers();
    provincia('provacte',1);
    llenarRol('rocu',0);
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
function camposUserAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "appaterno";
    tablacampos[1] = "valappaterno";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "apmaterno";
    tablacampos[1] = "valapmaterno";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "pnombre";
    tablacampos[1] = "valpnombre";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "snombre";
    tablacampos[1] = "valsnombre";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "fecnac";
    tablacampos[1] = "valfecnac";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "telefo";
    tablacampos[1] = "valtelefo";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "depar";
    tablacampos[1] = "valdepar";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "prov";
    tablacampos[1] = "valprov";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dis";
    tablacampos[1] = "valdis";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "cento";
    tablacampos[1] = "valcento";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dir";
    tablacampos[1] = "valdir";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "provacte";
    tablacampos[1] = "valprovacte";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "disacte";
    tablacampos[1] = "valdisacte";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "estate";
    tablacampos[1] = "valestate";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "nombrecu";
    tablacampos[1] = "valnombrecu";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "emailcu";
    tablacampos[1] = "valemailcu";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "rocu";
    tablacampos[1] = "valrocu";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    $('#enviaruser').prop("disabled", false);
}
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
        $('#prov').focus();
    }
});
$('#enviar').on('click', function () {
    enviar();
});

$('#prov').on('change', function () {
    distrito('dis',this.value, 0);
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
        $('#dis').focus();
    }
});
$('#dis').on('change', function () {

    var dis = $('#dis');
    var disval = $('#valdis');

    if (this.value === '0') {
        validarCaja('dis', 'valdis', 'Escoja distrito', 0)
    }
    else {
        $('#cento').prop('disabled', false);
        disval.removeClass('valid-feedback');
        dis.removeClass('is-valid');
        dis.removeClass('is-invalid');
        disval.addClass('invalid-feedback');
        $('#cento').focus();
    }
});
$('#provacte').on('change', function () {
    distrito('disacte',this.value, 0);
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
        $('#disacte').focus();
    }
});
$('#provacteedit').on('change', function () {
    distrito('disacteedit',this.value, 0);
    var provacte = $('#provacteedit');
    var valprovacte = $('#valprovacteedit');

    if (this.value === '0') {
        $('#disacteedit').prop('disabled', true);
        validarCaja('provacteedit', 'valprovacteedit', 'Escoja provincia', 0)
    }
    else {
        $('#disacteedit').prop('disabled', false);
        valprovacte.removeClass('valid-feedback');
        provacte.removeClass('is-valid');
        provacte.removeClass('is-invalid');
        valprovacte.addClass('invalid-feedback');
        $('#disacteedit').focus();
    }
});
$('#disacte').on('change', function () {
    eess('estate',this.value,0);
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
        $('#estate').focus();
    }
});
$('#disacteedit').on('change', function () {
    eess('estateedit',this.value,0);
    var disacte = $('#disacteedit');
    var valdisacte = $('#valdisacteedit');

    if (this.value === '0') {
        $('#estateedit').prop('disabled', true);
        validarCaja('disacteedit', 'valdisacteedit', 'Escoja distrito', 0)
    }
    else {
        $('#estateedit').prop('disabled', false);
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
        $('#estateedit').focus();
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
function generarUsuario() {

    var nombres = $('#nombres').val();
    var appaterno = $('#appaterno').val();
    var apmaterno = $('#apmaterno').val();
    $('#nombrecu').val(nombres.substr(0, 1) + appaterno + apmaterno.substr(0, 1));
}
function generarUsuarioEdit() {

    var nombres = $('#nombresedit').val();
    var appaterno = $('#appaternoedit').val();
    var apmaterno = $('#apmaternoedit').val();
    $('#nombrecuedit').val(nombres.substr(0, 1) + appaterno + apmaterno.substr(0, 1));
}


function enviar() {
    var cant = validarFormulario();
    if (cant === 0) {
        bloquear();
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

        var estate = $('#estate').val();
        var nombrecu = $('#nombrecu').val();
        var correo = $('#emailcu').val();
        var rol = $('#rocu').val();

        Swal.fire({
            title: 'Se ingresara un nuevo usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    url: '/insertarusuario',
                    type: 'POST',
                    data: {
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
                        estate: 1,
                        _token: CSRF_TOKEN,
                        nombre: nombrecu,
                        correo: correo,
                        rol: rol
                    },
                    dataType: 'JSON',
                    success:

                        function (data) {
                            if (data['error'] === 0) {
                                desbloquear();
                                redirect('/usuario');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Operacion exitosa: la contraseña inicial es ROOT',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            } else {
                                desbloquear();
                                redirect('/usuario');
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
            title: 'Error en el formulario',
            text: 'El formulario tiene errores, porfavor susbane los errores y de clic en guardar',
            showConfirmButton: false,
            timer: 4000
        });
    }
}

function eliminar(id) {
    window.event.preventDefault();
    var url = '/eliminar/' + id;
    Swal.fire({
        title: 'Desea eliminar este registro?',
        type: 'warning',
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
                            desbloquear();
                            redirect('/usuario');
                            exito();
                        } else {
                            desbloquear();
                            redirect('/usuario');
                            exito();

                        }
                    }, beforeSend: function () {
                        bloquear();
                    }

                });
        }
    })
}
function limpiar_campos(){
    $('#appaterno').val("");
    $('#apmaterno').val("");
    $('#nombres').val("");
    $('#telefo').val("");
    $('#fecnac').val("");
}
$('#tipdoc').on('change', function () {
    limpiar_campos();
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
    $('#dni').focus();

});

function validarDni() {

    bloquear();
    var dni = $('#dni').val();
    var url = "/validardni/" + dni;
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
                    var arra = data['cant'][0];
                    if (arra['cant'] > 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'El usuario ya fue creado',
                            text: 'el usuario ya fue creado, redireccionando a la lista de usuario...!',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        redirect('/usuario');
                        desbloquear();
                    }
                    else {
                        desbloquear();
                        text = 'Dni correcto';
                        validarCaja('dni', 'validDni', text, 1);
                        $('#enviar').prop('disabled', false);
                    }

                } else {

                }
            }

        });
}

var llenarRol = function (id,idrol) {

    var url = "/rolesUsuario";
    var arreglo;
    var select = $('#'+id).html('');
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
                    arreglo = data['roll'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if(parseInt(arreglo[i]['id'])===parseInt(idrol)){
                            htmla = '<option value="' + arreglo[i]['id'] + '" selected>' + arreglo[i]['nombre'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + arreglo[i]['id'] + '">' + arreglo[i]['nombre'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                } else {

                }
            }

        });

};

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
    if ($('#nombres').val() === '') {
        cont++;
        text = inicio + ' ingrese nombre';
        validarCaja('nombres', 'valpnombre', text, 0);
    }
    else {
        text = 'Nombre correcto';
        validarCaja('nombres', 'valpnombre', text, 1);
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

    if ($('#depar').val() !== '0') {

        text = '';
        validarCaja('depar', 'valdepar', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('depar', 'valdepar', text, 0);

    }
    if ($('#prov').val() !== '0') {

        text = '';
        validarCaja('prov', 'valprov', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('prov', 'valprov', text, 0);

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

    if ($('#nombrecu').val() === '') {
        cont++;
        text = inicio + ' ingrese nombre de cuenta';
        validarCaja('nombrecu', 'valnombrecu', text, 0);
    }
    else {

        text = 'nombre de cuenta correcto';
        validarCaja('nombrecu', 'valnombrecu', text, 1);
    }
    if ($('#emailcu').val() === '') {
        cont++;
        text = inicio + ' ingrese email';
        validarCaja('emailcu', 'valemailcu', text, 0);
    }
    else {

        text = 'email correcto';
        validarCaja('emailcu', 'valemailcu', text, 1);
    }
    if ($('#rocu').val() !== '0') {
        text = '';
        validarCaja('rocu', 'valrocu', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione rol';
        validarCaja('rocu', 'valrocu', text, 0);

    }

    return cont;
}
function validarFormularioEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#tipdocedit').val() !== '0') {
        text = 'Tipo de documento correcto';
        validarCaja('tipdocedit', 'valtipodocedit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un tipo de documento';
        validarCaja('tipdocedit', 'valtipodocedit', text, 0);
    }
    if ($('#dniedit').val() !== '0') {
        text = 'Numero de documento correcto';
        validarCaja('dniedit', 'valdniedit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' ingrese un numero de documento';
        validarCaja('dniedit', 'validDniedit', text, 0);
    }
    if ($('#appaternoedit').val() === '') {
        cont++;
        text = inicio + ' ingrese apellido paterno';
        validarCaja('appaternoedit', 'valappaternoedit', text, 0);
    }
    else {
        text = 'Apellido paterno correcto';
        validarCaja('appaternoedit', 'valappaternoedit', text, 1);
    }
    if ($('#apmaternoedit').val() === '') {
        cont++;
        text = inicio + ' ingrese apellido materno';
        validarCaja('apmaternoedit', 'valapmaternoedit', text, 0);
    }
    else {
        text = 'Apellido materno correcto';
        validarCaja('apmaternoedit', 'valapmaternoedit', text, 1);
    }
    if ($('#nombresedit').val() === '') {
        cont++;
        text = inicio + ' ingrese nombre';
        validarCaja('nombresedit', 'valpnombreedit', text, 0);
    }
    else {
        text = 'Nombre correcto';
        validarCaja('nombresedit', 'valpnombreedit', text, 1);
    }

    if ($('#fecnacedit').val() === '') {
        cont++;
        text = inicio + ' ingrese fecha de nacimiento';
        validarCaja('fecnacedit', 'valfecnacedit', text, 0);
    }
    else {

        text = 'Fecha de nacimiento correcta';
        validarCaja('fecnacedit', 'valfecnacedit', text, 1);
    }

    if ($('#deparu').val() !== '0') {
        text = 'Departamento correcto';
        validarCaja('deparu', 'valdeparu', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('deparu', 'valdeparu', text, 0);

    }
    if ($('#provu').val() !== '0') {
        text = 'Provincia correcta';
        validarCaja('provu', 'valprovu', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('provu', 'valprovu', text, 0);

    }
    if ($('#disu').val() !== '0') {
        text = 'Distrito correcto';
        validarCaja('disu', 'valdisu', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un distrito';
        validarCaja('disu', 'valdisu', text, 0);

    }

    if ($('#diredit').val() === '') {
        cont++;
        text = inicio + ' ingrese direccion';
        validarCaja('diredit', 'valdiredit', text, 0);
    }
    else {
        text = 'Direccion correcta';
        validarCaja('diredit', 'valdiredit', text, 1);
    }


    if ($('#provacteedit').val() !== '0') {
        text = 'Provincia correcta';
        validarCaja('provacteedit', 'valprovacteedit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione provincia';
        validarCaja('provacteedit', 'valprovacteedit', text, 0);

    }

    if ($('#disacteedit').val() !== '0') {
        text = 'Distrito correcto';
        validarCaja('disacteedit', 'valdisacteedit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione distrito';
        validarCaja('disacteedit', 'valdisacteedit', text, 0);

    }

    if ($('#nombrecuedit').val() === '') {
        cont++;
        text = inicio + ' ingrese nombre de cuenta';
        validarCaja('nombrecuedit', 'valnombrecuedit', text, 0);
    }
    else {

        text = 'nombre de cuenta correcto';
        validarCaja('nombrecuedit', 'valnombrecuedit', text, 1);
    }
    if ($('#emailcuedit').val() === '') {
        cont++;
        text = inicio + ' ingrese email';
        validarCaja('emailcuedit', 'valemailcuedit', text, 0);
    }
    else {

        text = 'email correcto';
        validarCaja('emailcuedit', 'valemailcuedit', text, 1);
    }
    if ($('#rocuedit').val() !== '0') {
        text = 'Rol correcto';
        validarCaja('rocuedit', 'valrocuedit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione rol';
        validarCaja('rocuedit', 'valrocuedit', text, 0);

    }

    return cont;
}
$('#addUsuario').on('click',function(){
    window.event.preventDefault();
    $('#modal_dialog_add_usuario').modal('show');
    departamento('depar',0);
    departamento('deparacte',1);
    provincia('provacte',1,0);
    camposUserAdd();
    getTipoDoc('tipdoc',1);
    $('#dni').focus();
});
function abrilModal(id, nombre) {
    window.event.preventDefault();
    $('#modal-dialog').modal('show');
    $('#nombcom').val(nombre);
    llenarPermisos(id);
}


function llenarPermisos(id) {
    var datatable = $('#tabla_permisos');
    datatable.DataTable().destroy();
    datatable.DataTable({
            ajax: '/obtenerpermisos/' + id,
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
            autoWidth: true,
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
            columns: [
                {data: 'mtitulo', name: 'mtitulo'},
                {data: 'mdescripcion', name: 'mdescripcion'},
                {data: 'ssubTitulo', name: 'ssubTitulo'},
                {
                    data: function (row) {
                        if (parseInt(row.perm) === 1) {
                            return '<tr> <a  href="#" onclick="activarDesactivarPermiso(' + row.idpermiso + ',' + id + ',' + row.sidSubMenu + ',1)"  title="Desactivar permiso" >' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-thumbs-up text-green"> </i></a></tr>';
                        } else {
                            return '<tr> <a  href="#" onclick="activarDesactivarPermiso(' + row.idpermiso + ',' + id + ',' + row.sidSubMenu + ',0)"   title="Activar permiso" >' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a></tr>';
                        }
                    }
                }

            ]
        }
    );
}

function activarDesactivarPermiso(idpermiso, idusu, idsubmenu, estado) {
    window.event.preventDefault();
    var datosperm = {
        idpermiso: idpermiso,
        idusu: idusu,
        idsubmenu: idsubmenu,
        estado: estado,
    };
    datosperm = JSON.stringify(datosperm);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se registrara una nueva atencion',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                    type: 'GET',
                    url: "/cambiarpermiso/" + datosperm,
                    cache: false,
                    dataType: 'json',
                    data: {
                        _token: CSRF_TOKEN
                    },
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                operacionExitosa();
                                llenarPermisos(idusu);
                            } else {
                                operacionError(data['error']);
                                bloquear();
                            }

                        }
                    ,
                    beforeSend: function () {

                    }
                }
            )
            ;
        }
    })

}
function tablaUsuarios(){
    $('#tabla_usuario').DataTable({
        ajax: '/usuarios',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        orderCellsTop: true,
        processing: false,
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
            {"targets": 0, "width": "30%", "className": "text-left"},
            {"targets": 1, "width": "10%", "className": "text-center"},
            {"targets": 2, "width": "10%", "className": "text-left"},
            {"targets": 3, "width": "5%", "className": "text-center"},
            {"targets": 4, "width": "25%", "className": "text-left"},
            {"targets": 5, "width": "10%", "className": "text-left"},
            {"targets": 6, "width": "5%", "className": "text-center"},
            {"targets": 7, "width": "5%", "className": "text-center"},
        ],
        columns: [

            {data: 'nombre', name: 'nombre'},
            {
                data: function (row) {
                    return '<tr >' +
                        '<div class="image" style="alignment:center;">' +
                        '<img  src="storage' + row.imagen + '" title="imagen de perfil" alt="imagen" width="20px" height="20px"/>' +
                        '</div>' +
                        '</tr>';
                }
            },
            {data: 'name', name: 'name'},
            {
                data: function (row) {
                    return '<tr> <a  href="#" onclick="abrilModal(' + row.id + ')"  title="Ver permisos de aplicativo" >' +
                        '<i class="fas fa-lg fa-fw m-r-10 fa-user-secret text-black"> </i></a></tr>';
                }
            },
            {data: 'email', name: 'email'},
            {data: 'description', name: 'description'},
            {
                data: function (row) {
                    return parseInt(row.estado) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.estado) === 1 && parseInt(row.estado) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdUser(' + row.id + ')" TITLE="Editar Usuario" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Usuario" onclick="eliminar(' + row.id +')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Usuario"  onclick="eliminar(' + row.id +')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function abrilModalEdUser(idus) {
    window.event.preventDefault();
    $('#modal_dialog_edit_Usuario').modal('show');
    getEditUser(idus);
}
function getEditUser(idus) {
    var url = "/getEditUs/" + idus;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var user= data['user'];
                //$('#tipdocedit').val(user['tipoDoc']);
                getTipoDoc('tipdocedit',user['idTD'])
                $('#dniedit').val(user['peNumeroDoc']);
                $('#appaternoedit').val(user['peAPPaterno']);
                $('#apmaternoedit').val(user['peAPMaterno']);
                $('#nombresedit').val(user['peNombres']);
                $('#fecnacedit').val(user['peFecNac']);
                $('#telefoedit').val(user['peTelefono']);
                $('#diredit').val(user['peDireccion']);
                $('#nombrecuedit').val(user['name']);
                $('#emailcuedit').val(user['email']);
                habi_deshabi_campos_edit(true);
                $('#tipdocedit').prop('disabled',true);
                //ids
                $('#iduseredit').val(user['id']);
                $('#idpersedit').val(user['peId']);
                $('#idrolusedit').val(user['idrolus']);

                llenarRol('rocuedit',user['role_id']);

                departamento('deparu',user['depar']);
                provincia('provu',user['depar'],user['prov']);
                distrito('disu',user['prov'],user['dist']);

            }

        });
}
$('#deparu').on('change', function () {
    provincia('provu', this.value);
    var prov = $('#deparu');
    var provvalid = $('#valdeparu');

    if (this.value === '0') {
        $('#provu').prop('disabled', true);
        validarCaja('deparu', 'valdeparu', 'Escoja departamento', 0)
    } else {
        $('#provu').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provu').focus();
    }
});
$('#provu').on('change', function () {
    distrito('disu',this.value, 0);
    var prov = $('#provu');
    var provvalid = $('#valprovu');

    if (this.value === '0') {
        $('#disu').prop('disabled', true);
        validarCaja('provu', 'valprovu', 'Escoja provincia', 0)
    } else {
        $('#disu').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#disu').focus();
    }
});
$('#disu').on('change', function () {
    $('#centoedit').prop('disabled',false);
    $('#centoedit').focus();
});
function habi_deshabi_campos($bool){
    $('#apmaterno').prop('disabled',$bool);
    $('#appaterno').prop('disabled',$bool);
    $('#nombres').prop('disabled',$bool);
}
function habi_deshabi_campos_edit($bool){
    $('#apmaternoedit').prop('disabled',$bool);
    $('#appaternoedit').prop('disabled',$bool);
    $('#nombresedit').prop('disabled',$bool);
    $('#tipdocedit').prop('disabled',$bool);
    $('#dniedit').prop('disabled',$bool);
}
function validDniUser() {
    event.preventDefault();
    if(validarDniExpres('enviaruser','dni','tipdoc','validDni')===0){
        var tipdoc = $('#tipdoc').val();
        var dni = $('#dni').val();
        var persona;
        var url = "/getUserDni/" + dni;
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
                        var usuario = data['usuario'];
                        var person = data['person'];
                        if (usuario!==null || person!==null  ) {
                            if(usuario!==null){
                                $('#tipdoc').prop("disabled", true);
                                $('#dni').val(person['peNumeroDoc'])
                                $('#appaterno').val(person['peAPPaterno'])
                                $('#apmaterno').val(person['peAPMaterno'])
                                $('#nombres').val(person['peNombres'])
                                $('#fecnac').val(person['peFecNac'])
                                $('#telefo').val(person['peTelefono'])
                                $('#dir').val(person['peDireccion'])
                                $('#nombrecu').val(usuario['name']).prop("disabled", true);
                                $('#emailcu').val(usuario['email']).prop("disabled", true);

                                llenarRol('rocu',usuario['role_id']);

                                departamento('depar',usuario['idDepartamento']);
                                provincia('prov',usuario['idDepartamento'],usuario['prov']);
                                distrito('dis',usuario['prov'],usuario['dist']);

                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    type: 'warning',
                                    title: 'El Usuario ya esta registrado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#enviaruser').prop("disabled", true);
                                sit=3;
                            }else{
                                $('#idperson').val(person['peId']);
                                $('#tipdoc').prop("disabled", true);
                                $('#dni').val(person['peNumeroDoc']).prop("disabled", true);
                                $('#appaterno').val(person['peAPPaterno']).prop("disabled", true);
                                $('#apmaterno').val(person['peAPMaterno']).prop("disabled", true);
                                $('#nombres').val(person['peNombres']).prop("disabled", true);
                                $('#fecnac').val(person['peFecNac']).prop("disabled", true);
                                $('#telefo').val(person['peTelefono']).prop("disabled", true);
                                $('#dir').val(person['peDireccion']).prop("disabled", true);
                                departamento('depar',person['depa']);
                                provincia('prov',person['depa'],person['provin']);
                                distrito('dis',person['provin'],person['dist']);
                                $('#depar').prop('disabled',true);
                                var nombres = $('#nombres').val();
                                var appaterno = $('#appaterno').val();
                                var apmaterno = $('#apmaterno').val();
                                $('#nombrecu').val(nombres.substr(0, 1) + appaterno + apmaterno.substr(0, 1));
                                $('#emailcu').prop('disabled',false).val('');
                                $('#provacte').val(0).focus();
                                $('#disacte').val(0);
                                $('#estate').val(0);
                                $('#rocu').val(0);
                                sit=2;
                            }

                        }else{
                            api_consulta_doc(tipdoc,dni).then(function(data) {
                                var usr=data['apicliente'];
                                //console.log(usr);
                                if(usr===null){
                                    operacionErrorApi("");
                                    habi_deshabi_campos(false);
                                    $('#appaterno').focus()
                                }else{
                                    if(usr['message']==='not found'){
                                        var message=usr['message'];
                                        operacionErrorApi(message);
                                        habi_deshabi_campos(false);
                                        $('#appaterno').focus();
                                    }else{
                                        $('#nombres').val(usr['nombres']);
                                        $('#appaterno').val(usr['apellidoPaterno']);
                                        $('#apmaterno').val(usr['apellidoMaterno']);
                                        generarUsuario();
                                    }
                                }
                                //console.log(usr); // Acciones con los datos obtenidos
                            }).catch(function(error) {
                                //console.error(error); // Manejo de errores
                            });
                            limpiarCaja(camposadd);
                            $('#emailcu').prop('disabled',false);
                            sit=1;
                        }
                        //desbloquear();
                    } else {

                    }
                },beforeSend: function(){
                    //bloquear();
                },

            });
    }
}

function enviarUser() {
    if(validarFormulario()===0){
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
                var idper=$('#idperson').val();
                var tipdoc = $('#tipdoc').val();
                var dni = $('#dni').val();

                var appaterno = $('#appaterno').val();
                var apmaterno = $('#apmaterno').val();
                var nombres = $('#nombres').val();
                var fecnac = $('#fecnac').val();
                var telefo = $('#telefo').val();

                //ubicacion
                var iddis = $('#dis').val();

                var dir = $('#dir').val();

                //var estate = 1;
                var nombrecu = $('#nombrecu').val();
                var correo = $('#emailcu').val();
                var rol = $('#rocu').val();
                $.ajax({
                    url: '/insertarusuario',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idpers: idper,
                        tipdoc: tipdoc,
                        dni: dni,
                        appaterno: appaterno,
                        apmaterno: apmaterno,
                        nombres: nombres,
                        fecnac: fecnac,
                        telefo: telefo,
                        iddis: iddis,
                        dir: dir,
                        sit: sit,
                        nombre: nombrecu,
                        correo: correo,
                        rol: rol
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Usuario exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
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
                                    timer: 4000
                                });
                                location.reload();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviaruser').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarEditUser() {
    if(validarFormularioEdit()===0){
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se Editará el registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                var iduser = $('#iduseredit').val();
                var idpers = $('#idpersedit').val();
                var idrolus = $('#idrolusedit').val();

                var tipdoc = $('#tipdocedit').val();
                var dni = $('#dniedit').val();

                var appaterno = $('#appaternoedit').val();
                var apmaterno = $('#apmaternoedit').val();
                var nombres = $('#nombresedit').val();
                var fecnac = $('#fecnacedit').val();
                var telefo = $('#telefoedit').val();

                //ubicacion
                var iddis = $('#disu').val();

                var dir = $('#diredit').val();

                var nombrecu = $('#nombrecuedit').val();
                var correo = $('#emailcuedit').val();
                var rol = $('#rocuedit').val();

                $.ajax({
                    url: '/updateuser',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        iduser: iduser,
                        idpers: idpers,
                        idrolus: idrolus,
                        tipdoc: tipdoc,
                        dni: dni,
                        appaterno: appaterno,
                        apmaterno: apmaterno,
                        nombres: nombres,
                        fecnac: fecnac,
                        telefo: telefo,
                        iddis: iddis,
                        dir: dir,
                        nombre: nombrecu,
                        correo: correo,
                        rol: rol
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Usuario editado  exitosamente',
                                    showConfirmButton: false,
                                    timer: 4000
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
                                    timer: 4000
                                });
                                location.reload();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviaredituser').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
