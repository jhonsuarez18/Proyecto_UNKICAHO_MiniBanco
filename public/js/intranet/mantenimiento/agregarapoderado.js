var sit=0;
var camposadd = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    $('.modal-backdrop').remove();
    if(parseInt($('#idvi').val())===1){
        $('#modal_dialog_add_apoderado').modal('show');
        camposadd=[];
        camposUserAdd();
        limpiarCaja(camposadd);
        datePickers();

        $('#tipdocap').focus();
    }
    datePickers();
    departamento('deparap',0);
    provincia('provacte',1,0);
    getTipoDoc('tipdocap',0);
    getGradInst();
    getEstadCivi()
    tablaApoderados();
});
function getGradInst() {
    var url = "/mantenimiento/getgradinst";
    var select = $('#gradiap').html('');
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
                    htmla = '<option value="' + data[i]['giId'] + '">' + data[i]['giDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function getEstadCivi() {
    var url = "/mantenimiento/getestadcivi";
    var select = $('#estcap').html('');
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
                    htmla = '<option value="' + data[i]['ecId'] + '">' + data[i]['ecDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
var datePickers = function () {

    $('#fecnacap').datepicker({
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
$('#deparap').on('change', function () {
    provincia('provap',this.value);
    var prov = $('#deparap');
    var provvalid = $('#valdeparap');

    if (this.value === '0') {
        $('#provap').prop('disabled', true);
        validarCaja('deparap', 'valdeparap', 'Escoja departamento', 0)
    }
    else {
        $('#provap').prop('disabled', false);
        $('#disap').prop('disabled', true);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provap').focus();
    }
});
$('#deparcledit').on('change', function () {
    provincia('provcledit', this.value,0);
    var prov = $('#deparcledit');
    var provvalid = $('#valdeparcledit');

    if (this.value === '0') {
        $('#provcledit').prop('disabled', true);
        validarCaja('deparcledit', 'valdeparcledit', 'Escoja departamento', 0)
    } else {
        $('#provcledit').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provcledit').focus();
    }
});

$('#provap').on('change', function () {
    distrito('disap',this.value, 0);
    var prov = $('#provap');
    var provvalid = $('#validDni');

    if (this.value === '0') {
        $('#disap').prop('disabled', true);
        validarCaja('provap', 'valprovap', 'Escoja provincia', 0)
    }
    else {
        $('#disap').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#disap').focus();
    }
});
$('#disap').on('change', function () {

    var dis = $('#disap');
    var disval = $('#valdis');

    if (this.value === '0') {
        validarCaja('disap', 'valdisap', 'Escoja distrito', 0)
    }
    else {
        $('#centoap').prop('disabled', false);
        disval.removeClass('valid-feedback');
        dis.removeClass('is-valid');
        dis.removeClass('is-invalid');
        disval.addClass('invalid-feedback');
        $('#centoap').focus();
    }
});

$('#provcledit').on('change', function () {
    distrito('discledit',this.value, 0);
    var provacte = $('#provcledit');
    var valprovacte = $('#valprovcledit');

    if (this.value === '0') {
        $('#discledit').prop('disabled', true);
        validarCaja('provcledit', 'valprovcledit', 'Escoja provincia', 0)
    }
    else {
        $('#discledit').prop('disabled', false);
        valprovacte.removeClass('valid-feedback');
        provacte.removeClass('is-valid');
        provacte.removeClass('is-invalid');
        valprovacte.addClass('invalid-feedback');
        $('#discledit').focus();
    }
});
$('#discledit').on('change', function () {
    var disacte = $('#discledit');
    var valdisacte = $('#valdiscledit');

    if (this.value === '0') {
        $('#estate').prop('disabled', true);
        validarCaja('discledit', 'valdiscledit', 'Escoja distrito', 0)
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
    $('#appaternocl').val("");
    $('#apmaternocl').val("");
    $('#nombrescl').val("");
    $('#telefocl').val("");
    $('#razonscl').val("");
    $('#fecnaccl').val("");
}
function limpiar_campos_edit(){
    $('#appaternocledit').val("");
    $('#apmaternocledit').val("");
    $('#nombrescledit').val("");
    $('#razonscledit').val("");
}
$('#tipdocap').on('change', function () {
    limpiar_campos();
    var dni = $('#dniap');
    var tipdoc = $('#validDniap');
    var tipodocval = $('#validtipodocap');
    if (this.value === '0') {
        dni.val('');
        dni.prop('disabled', true);
        validarCaja('tipdocap', 'validtipodocap', 'Escoja tipo documento', 0)
    }
    else {
        dni.prop('disabled', false);
        dni.val('');
        validarCaja('tipdocap', 'validtipodocap', '', 1)
    }

    if(parseInt(this.value)===1){
        blo_desblo_campos(false,true)
    }else{
        if(parseInt(this.value)===3){
            blo_desblo_campos(true,false)
        }
    }
    $('#dniap').focus();


});
$('#tipdoccledit').on('change', function () {
    limpiar_campos_edit();
    var dni = $('#dnicledit');
    var tipdoc = $('#valdnicledit');
    var tipodocval = $('#valtipodoccledit');
    if (this.value === '0') {
        dni.val('');
        dni.prop('disabled', true);
        validarCaja('tipdoccledit', 'valtipodoccledit', 'Escoja tipo documento', 0)
    }
    else {
        dni.prop('disabled', false);
        dni.val('');
        validarCaja('tipdoccledit', 'valtipodoccledit', '', 1)
    }

    if(parseInt(this.value)===1){
        blo_desblo_camposEdit(false,true)
    }else{
        if(parseInt(this.value)===3){
            blo_desblo_camposEdit(true,false)
        }
    }
    $('#dnicledit').focus();


});

function validarDni() {

    bloquear();
    var dni = $('#dnicl').val();
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
                            title: 'El cliente ya fue creado',
                            text: 'el cliente ya fue creado, redireccionando a la lista de usuario...!',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        redirect('/usuario');
                        desbloquear();
                    }
                    else {
                        desbloquear();
                        text = 'Dni correcto';
                        validarCaja('dnicl', 'validDnicl', text, 1);
                        $('#enviar').prop('disabled', false);
                    }

                } else {

                }
            }

        });
}



function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#tipdoccl').val() !== '0') {

        text = '';
        validarCaja('tipdoccl', 'validtipodoccl', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un tipo de documento';
        validarCaja('tipdoccl', 'validtipodoccl', text, 0);
    }
    if ($('#dnicl').val() !== '0') {
    }
    else {
        cont++;
        text = inicio + ' ingrese un numero de documento';
        validarCaja('dnicl', 'validDnicl', text, 0);
    }

    if($('#tipdoccl').val()===1){
        if ($('#appaternocl').val() === '') {
            cont++;
            text = inicio + ' ingrese apellido paterno';
            validarCaja('appaternocl', 'valappaternocl', text, 0);
        }
        else {
            text = 'Apellido paterno correcto';
            validarCaja('appaternocl', 'valappaternocl', text, 1);
        }
        if ($('#apmaternocl').val() === '') {
            cont++;
            text = inicio + ' ingrese apellido materno';
            validarCaja('apmaternocl', 'valapmaternocl', text, 0);
        }
        else {
            text = 'Apellido materno correcto';
            validarCaja('apmaternocl', 'valapmaternocl', text, 1);
        }
        if ($('#nombrescl').val() === '') {
            cont++;
            text = inicio + 'Ingrese nombre';
            validarCaja('nombrescl', 'valnombrescl', text, 0);
        }
        else {
            text = 'Nombre correcto';
            validarCaja('pnombrecl', 'valpnombrecl', text, 1);
        }
    }else{
        if($('#tipdoccl').val()===3){
            if ($('#razonscl').val() === '') {
                cont++;
                text = inicio + ' ingrese Razon Social';
                validarCaja('razonscl', 'valrazonscl', text, 0);
            }
            else {
                text = 'Razon Social correcto';
                validarCaja('razonscl', 'valrazonscl', text, 1);
            }
        }
    }



    if ($('#deparcl').val() !== '0') {

        text = '';
        validarCaja('deparcl', 'valdeparcl', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('deparcl', 'valdeparcl', text, 0);

    }
    if ($('#provcl').val() !== '0') {

        text = '';
        validarCaja('provcl', 'valprovcl', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('provcl', 'valprovcl', text, 0);

    }
    if ($('#discl').val() !== '0') {
        text = '';
        validarCaja('discl', 'valdiscl', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un distrito';
        validarCaja('discl', 'valdiscl', text, 0);

    }

    return cont;
}
function validarFormularioEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#tipdoccledit').val() !== '0') {
        text = 'Tipo de documento correcto';
        validarCaja('tipdoccledit', 'valtipodoccledit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un tipo de documento';
        validarCaja('tipdoccledit', 'valtipodoccledit', text, 0);
    }
    if ($('#dnicledit').val() !== '0') {
        text = 'Numero de documento correcto';
        validarCaja('dnicledit', 'valdnicledit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' ingrese un numero de documento';
        validarCaja('dnicledit', 'valdnicledit', text, 0);
    }
    if($('#tipdoccledit').val()===1){
        if ($('#appaternocledit').val() === '') {
            cont++;
            text = inicio + ' ingrese apellido paterno';
            validarCaja('appaternocledit', 'valappaternocledit', text, 0);
        }
        else {
            text = 'Apellido paterno correcto';
            validarCaja('appaternocledit', 'valappaternocledit', text, 1);
        }
        if ($('#apmaternoedit').val() === '') {
            cont++;
            text = inicio + ' ingrese apellido materno';
            validarCaja('apmaternoedit', 'valapmaternoedit', text, 0);
        }
        else {
            text = 'Apellido materno correcto';
            validarCaja('apmaternocledit', 'valapmaternocledit', text, 1);
        }
        if ($('#nombrescledit').val() === '') {
            cont++;
            text = inicio + ' ingrese nombres';
            validarCaja('pnombrecledit', 'valpnombrecledit', text, 0);
        }
        else {
            text = 'Nombre correcto';
            validarCaja('pnombrecledit', 'valpnombrecledit', text, 1);
        }
    }else{
        if($('#tipdoccledit').val()===3){
            if ($('#razonscledit').val() === '') {
                cont++;
                text = inicio + ' ingrese razon social';
                validarCaja('razonscledit', 'valrazonscledit', text, 0);
            }
            else {
                text = 'Razon Social correcto';
                validarCaja('razonscledit', 'valrazonscledit', text, 1);
            }
        }

    }

    if ($('#deparcledit').val() !== '0') {
        text = 'Departamento correcto';
        validarCaja('deparcledit', 'valdeparcledit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un departamento';
        validarCaja('deparcledit', 'valdeparcledit', text, 0);

    }
    if ($('#provcledit').val() !== '0') {
        text = 'Provincia correcta';
        validarCaja('provcledit', 'valprovcledit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione una provincia';
        validarCaja('provcledit', 'valprovcledit', text, 0);

    }
    if ($('#discledit').val() !== '0') {
        text = 'Distrito correcto';
        validarCaja('discledit', 'valdiscledit', text, 1);
    }
    else {
        cont++;
        text = inicio + ' seleccione un distrito';
        validarCaja('discledit', 'valdiscledit', text, 0);

    }

    return cont;
}
$('#addcliente').on('click',function(){
    window.event.preventDefault();
    $('#modal_dialog_add_cliente').modal('show');
    datePickers();
    getTipoDoc('tipdoccl',0);
    departamento('deparcl',0);
    provincia('provacte',1,0);
    camposUserAdd();
    $('#tipdoccl').focus();
});


/*function llenarPermisos(id) {
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
}*/

/*function activarDesactivarPermiso(idpermiso, idusu, idsubmenu, estado) {
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

}*/
function tablaApoderados(){
    $('#tabla_apoderado').DataTable({
        ajax: '/mantenimiento/obtenerApoderado',
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
            {"targets": 2, "width": "10%", "className": "text-center"},
            {"targets": 3, "width": "5%", "className": "text-center"},
            {"targets": 4, "width": "25%", "className": "text-center"},
            {"targets": 5, "width": "10%", "className": "text-center"},
            {"targets": 6, "width": "5%", "className": "text-center"},
            {"targets": 7, "width": "5%", "className": "text-center"},
        ],
        columns: [
            {data: 'apoderad', name: 'apoderad'},
            {data: 'apNumeroDoc', name: 'apNumeroDoc'},
            {data: 'codigo', name: 'codigo'},
            /*{
                data: function (row) {
                    if(row.codigo==null){
                        return row.coddist;
                    }else{
                        return row.codigo;
                    }

                }
            },*/
            {
                data: function (row) {
                    return row.apTelefono === null ? '<span class="text-black-50">--------</span>' :  '<span class="text-black-50">' + row.apTelefono+ '</span>';

                }
            },
            //{data: 'peTelefono', name: 'peTelefono'},
            {data: 'tdDescCorta', name: 'tdDescCorta'},
            {data: 'apFecNac', name: 'apFecNac'},
            {data: 'apFecCreacion', name: 'apFecCreacion'},
            {
                data: function (row) {
                    return parseInt(row.apEstado) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.clEst) === 1 && parseInt(row.clEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdClien(' + row.peNumeroDoc + ')" TITLE="Editar Cliente " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Cliente" onclick="eliminarCliente(' + row.clId +')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Cliente"  onclick="eliminarCliente(' + row.clId +')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function abrilModalEdClien(dni) {
    window.event.preventDefault();
    $('#modal_dialog_edit_cliente').modal('show');
    $('#fecnaccledit').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    obtenerEditarCliente(dni);

}
function obtenerEditarCliente(dni) {
    var url = "/mantenimiento/getClienDni/" + dni;
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
                    var client = data['cliente'];
                    var person = data['person'];
                    console.log(data['person']);
                    if (client!==null || person!==null  ) {
                        $('#tipdoccledit').prop("disabled", true);
                        getTipoDoc('tipdoccledit',person['tipoDoc']);
                        $('#idpersonedit').val(person['peId']);
                        $('#idclientedit').val(client['clId']);
                        console.log(person['peId'],client['clId'])
                        $('#tipdoccledit').val(person['tipoDoc']);
                        $('#dnicledit').val(person['peNumeroDoc']).prop("disabled",true);
                        if(person['tipoDoc']===1){
                            blo_desblo_campos()
                            $('#appaternocledit').val(person['peAPPaterno']);
                            $('#apmaternocledit').val(person['peAPMaterno']);
                            $('#nombrescledit').val(person['peNombres']);
                            $('#telefocledit').val(person['peTelefono']);
                            blo_desblo_camposEdit(false,true)
                        }else{
                            if($('#tipdoccledit').val(person['tipoDoc']===3)){
                                blo_desblo_camposEdit(true,false)
                                $('#razonscledit').val(person['peNombres']);
                            }
                        }
                        $('#fecnaccledit').val(person['peFecNac']);
                        $('#telefocledit').val(person['peTelefono']);
                        $('#dircledit').val(person['peDireccion']);

                        departamento('deparcledit',person['depa']);
                        provincia('provcledit',person['depa'],person['provin']);
                        distrito('discledit',person['provin'],person['dist']);
                        $('#siti').val(1);
                        $('#tipdoccledit').prop('disabled',false);
                        $('#dnicledit').prop('disabled',false);
                        $('#dnicledit').focus();
                        //desbloquear();
                        $('#appaternocledit').focus();
                    }else{
                        $('#appaternoedit').focus();
                    }
                    //desbloquear();
                } else {

                }
            },beforeSend: function(){
                //bloquear();
            },

        });
}
function eliminarCliente(idcli){

    var url="/mantenimiento/deleteclien/"+idcli;
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
                    url: url,
                    type: 'GET',
                    cache:false,
                    dataType: 'JSON',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            tablaApoderados();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Cliente eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tablaApoderados();
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
/*function abrilModalEdUser(idus) {
    window.event.preventDefault();
    $('#modal_dialog_edit_Usuario').modal('show');
    getEditUser(idus);
}*/
/*function getEditUser(idus) {
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
                $('#tipdocedit').val(user['tipoDoc']);
                $('#dniedit').val(user['numeroDoc']);
                $('#appaternoedit').val(user['apPaterno']);
                $('#apmaternoedit').val(user['apMaterno']);
                $('#pnombreedit').val(user['pNombre']);
                $('#snombreedit').val(user['sNombre']);
                $('#fecnacedit').val(user['fecNac']);
                $('#telefoedit').val(user['telefono']);
                $('#diredit').val(user['direccion']);
                $('#nombrecuedit').val(user['name']);
                $('#emailcuedit').val(user['email']);
                $('#idcentpedit').val(user['idCentroPoblado']);
                $('#centoedit').val(user['cenpo']);

                //ids
                $('#iduseredit').val(user['id']);
                $('#idpersedit').val(user['idPersona']);
                $('#idrolusedit').val(user['idrolus']);

                llenarRol('rocuedit',user['role_id']);

                departamento('deparu',user['departamentoid']);
                provincia('provu',user['departamentoid'],user['provinciaid']);
                distrito('disu',user['provinciaid'],user['distritoid']);

                departamento('deparacteedit',user['dep']);
                provincia('provacteedit',user['dep'],user['provate']);
                distrito('disacteedit',user['provate'],user['disate']);
                eess('estateedit',user['disate'],user['estab']);
            }

        });
}*/
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
function blo_desblo_campos($bool1,$bool){
    $('#hidnombres').prop("hidden",$bool1);
    $('#hidappaterno').prop("hidden",$bool1);
    $('#hidapmaterno').prop("hidden",$bool1);
    $('#hidfecnac').prop("hidden",$bool1);
    $('#hidrazons').prop("hidden",$bool);
}
function blo_desblo_camposEdit($bool1,$bool){
    $('#hidnombresedit').prop("hidden",$bool1);
    $('#hidappaternoedit').prop("hidden",$bool1);
    $('#hidapmaternoedit').prop("hidden",$bool1);
    $('#hidfecnacedit').prop("hidden",$bool1);
    $('#hidrazonsedit').prop("hidden",$bool);
}
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
function validDniApoderado() {
    event.preventDefault();
    if(validarDniExpres('enviarapoderado','dniap','tipdocap','validDniap')===0){
        var dni = $('#dnicl').val();
        var url = "/mantenimiento/getApoderDni/" + dni;
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
                        var apoderado = data['apoderado'];
                        console.log(apoderado);
                        if (apoderado!==null) {
                            $('#tipdocap').prop("disabled", true);
                            $('#dniap').val(apoderado['apNumeroDoc'])
                            if(apoderado['idTD']===1){
                                $('#appaternoap').val(apoderado['apAPPaterno'])
                                $('#apmaternoap').val(apoderado['apAPMaterno'])
                                $('#nombresap').val(apoderado['apNombres'])
                            }else{

                            }
                            $('#fecnacap').val(apoderado['apFecNac'])
                            $('#telefoap').val(apoderado['apTelefono'])
                            $('#dirap').val(apoderado['apDireccion'])

                            /*departamento('deparcl',person['depa']);
                            provincia('provcl',person['depa'],person['provin']);
                            distrito('discl',person['provin'],person['dist']);*/


                            desbloquear();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Apoderado ya esta registrado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#enviarapoderado').prop("disabled", true);
                            sit=3;

                        }else{
                            api_consulta_doc();
                            //limpiarCaja(camposadd);
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
function validDniConviviente() {
    event.preventDefault();
    if(validarDniExpres('enviarapoderado','dnicv','tipdoccv','validDnicv')===0){
        var dni = $('#dnicv').val();
        var url = "/mantenimiento/getApoderDni/" + dni;
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
                        var apoderado = data['apoderado'];
                        console.log(apoderado);
                        if (apoderado!==null) {
                            $('#tipdocap').prop("disabled", true);
                            $('#dniap').val(apoderado['apNumeroDoc'])
                            if(apoderado['idTD']===1){
                                $('#appaternoap').val(apoderado['apAPPaterno'])
                                $('#apmaternoap').val(apoderado['apAPMaterno'])
                                $('#nombresap').val(apoderado['apNombres'])
                            }else{

                            }
                            $('#fecnacap').val(apoderado['apFecNac'])
                            $('#telefoap').val(apoderado['apTelefono'])
                            $('#dirap').val(apoderado['apDireccion'])

                            /*departamento('deparcl',person['depa']);
                            provincia('provcl',person['depa'],person['provin']);
                            distrito('discl',person['provin'],person['dist']);*/


                            desbloquear();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Apoderado ya esta registrado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#enviarapoderado').prop("disabled", true);
                            sit=3;

                        }else{
                            api_consulta_doc();
                            //limpiarCaja(camposadd);
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
function api_consulta_doc(){
    var tipdoc = $('#tipdocap').val();
    var dni = $('#dniap').val();
    var url = "/mantenimiento/getapiclient/"+ tipdoc+"/" + dni;
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
                    var client = data['apicliente'];
                    if(tipdoc==='1'){
                        if(client===null){
                            operacionErrorApi("");
                            habi_deshabi_campos(false);
                            $('#appaternoap').focus()
                        }else{
                            if(client['message']==="not found"){
                                var message=client['message'];
                                operacionErrorApi(message);
                                habi_deshabi_campos(false);
                                $('#appaternoap').focus()
                            }else{
                                habi_deshabi_campos(true);
                                $('#nombresap').val(client['nombres']);
                                $('#appaternoap').val(client['apellidoPaterno']);
                                $('#apmaternoap').val(client['apellidoMaterno']);
                            }

                        }
                    }else{
                        if(tipdoc==='3'){
                            if(client['razonSocial']===""){
                                operacionErrorApi(client['razonSocial']);
                                habi_deshabi_campos(false);
                                $('#razonscl').focus()
                            }else{
                                habi_deshabi_campos(true);
                                $('#razonscl').val(client['razonSocial']);
                            }
                            if(client['message']==="ruc no valido"){
                                var inicio=client['message'];
                                text = inicio + ' Ingrese uno correcto';
                                validarCaja('razonscl', 'valrazonscl', text, 0);
                            }
                        }
                    }
                    //console.log(client['nombres']);


                    //desbloquear();
                } else {

                }
            },beforeSend: function(){
                //bloquear();
            },

        });
}
function validDniClientEdit() {
    event.preventDefault();
    if(validarDniExpres('enviarclient','dnicledit','tipdoccledit','valdnicledit')===0){
        var tipdoc = $('#tipdoccledit').val();
        var dni = $('#dnicledit').val();
        var url = "/mantenimiento/getapiclient/"+ tipdoc+"/" + dni;
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
                        var client = data['apicliente'];
                        //var person = data['person'];
                        console.log(client);
                        if(tipdoc==='1'){
                            if(client===null){
                                operacionErrorApi("");
                                habi_deshabi_campos_edit(false);
                                $('#appaternocledit').focus()
                            }else{
                                habi_deshabi_campos_edit(true);
                                $('#nombrescledit').val(client['nombres']);
                                $('#appaternocledit').val(client['apellidoPaterno']);
                                $('#apmaternocledit').val(client['apellidoMaterno']);
                            }
                            if(client['message']==="not found"){
                                var message=client['message'];
                                operacionErrorApi(message);
                                habi_deshabi_campos_edit(false);
                                $('#appaternocledit').focus()
                            }
                        }else{
                            if(tipdoc==='3'){
                                if(client['razonSocial']===""){
                                    operacionErrorApi(client['razonSocial']);
                                    habi_deshabi_campos_edit(false);
                                    $('#razonscledit').focus()
                                }else{
                                    habi_deshabi_campos_edit(true);
                                    $('#razonscledit').val(client['razonSocial']);
                                }
                                if(client['message']==="ruc no valido"){
                                    var inicio=client['message'];
                                    text = inicio + ' Ingrese uno correcto';
                                    validarCaja('razonscledit', 'valrazonscledit', text, 0);
                                }
                            }
                        }
                        //console.log(client['nombres']);


                        //desbloquear();
                    } else {

                    }
                },beforeSend: function(){
                    //bloquear();
                },

            });
    }
}
function habi_deshabi_campos($bool){
    $('#apmaternocl').prop('disabled',$bool);
    $('#appaternocl').prop('disabled',$bool);
    $('#nombrescl').prop('disabled',$bool);
    $('#razonscl').prop('disabled',$bool);
}
function habi_deshabi_campos_edit($bool){
    $('#apmaternocledit').prop('disabled',$bool);
    $('#appaternocledit').prop('disabled',$bool);
    $('#nombrescledit').prop('disabled',$bool);
    $('#razonscledit').prop('disabled',$bool);
}
function enviarCliente() {
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
                var tipdoc = $('#tipdoccl').val();
                var dni = $('#dnicl').val();

                var appaterno = $('#appaternocl').val();
                var apmaterno = $('#apmaternocl').val();
                var nombres = $('#nombrescl').val();
                var fecnac = $('#fecnaccl').val();
                var telefo = $('#telefocl').val();
                var razonsoc = $('#razonscl').val();

                //ubicacion
                var iddist = $('#discl').val();

                var dir = $('#dircl').val();
                var idcenpo = $('#idcentp').val();

                $.ajax({
                    url: '/mantenimiento/storecliente',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idpers: idper,
                        tipdoc: tipdoc,
                        dni: dni,
                        appaterno: appaterno,
                        apmaterno: apmaterno,
                        nombres: nombres,
                        razons: razonsoc,
                        fecnac: fecnac,
                        telefo: telefo,
                        iddist: iddist,
                        dir: dir,
                        sit: sit,
                        idcp: idcenpo,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Alumno exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                if(parseInt($('#idvi').val())===1){
                                    redirect('/transacciones/ventas');
                                }else{
                                    limpiarCaja(camposadd);
                                    closeModal('modal_dialog_add_cliente')
                                    tablaApoderados();
                                    iniciarcampos();
                                }

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
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_cliente')
                                tablaApoderados();
                                iniciarcampos();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarclient').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarClienteEdit() {
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
                var idper=$('#idpersonedit').val();
                var idclient=$('#idclientedit').val();
                var tipdoc = $('#tipdoccledit').val();
                var dni = $('#dnicledit').val();

                var appaterno = $('#appaternocledit').val();
                var apmaterno = $('#apmaternocledit').val();
                var nombres = $('#nombrescledit').val();
                var fecnac = $('#fecnaccledit').val();
                var telefo = $('#telefocledit').val();
                var razons = $('#razonscledit').val();

                //ubicacion
                var iddist = $('#discledit').val();

                var dir = $('#dircledit').val();

                $.ajax({
                    url: '/mantenimiento/updatecliente',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idpers: idper,
                        idclient: idclient,
                        tipdoc: tipdoc,
                        dni: dni,
                        appaterno: appaterno,
                        apmaterno: apmaterno,
                        nombres: nombres,
                        razons:razons,
                        fecnac: fecnac,
                        telefo: telefo,
                        iddist: iddist,
                        dir: dir,
                        sit: sit,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Cliente editado exitosamente',
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
                        $('#enviarclient').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
/*function enviarEditUser() {
    if($('#centoedit').val()===''){
        $('#idcentpedit').val('0');
    }
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
                var pnombre = $('#pnombreedit').val();
                var snombre = $('#snombreedit').val();
                var fecnac = $('#fecnacedit').val();
                var telefo = $('#telefoedit').val();

                //ubicacion
                var iddis = $('#disu').val();

                var dir = $('#diredit').val();
                var cenpo = $('#idcentpedit').val();

                var estate = $('#estateedit').val();
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
                        pnombre: pnombre,
                        snombre: snombre,
                        fecnac: fecnac,
                        telefo: telefo,
                        iddis: iddis,
                        dir: dir,
                        idcp: cenpo,
                        estate: estate,
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
}*/
