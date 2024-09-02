var sit=0;
var exist=0;
var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
$(document).ready(function (){
});

function TipoSeguro(idts) {
    //bloquear();
    var url = "/referencia/getTipSAct";
    var arreglo;
    var select = $('#tipseg').html('');
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
                    arreglo = data['tipsa'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if(arreglo[i]['tSId']==idts){
                            htmla = '<option value="' + arreglo[i]['tSId'] + '" selected>' + arreglo[i]['tSDescrip'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + arreglo[i]['tSId'] + '">' + arreglo[i]['tSDescrip'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}
function TipoSeguroEdit(idts) {
    //bloquear();
    var url = "/referencia/getTipSAct";
    var arreglo;
    var select = $('#tipsegedit').html('');
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
                    arreglo = data['tipsa'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if(arreglo[i]['tSId']==idts){
                            htmla = '<option value="' + arreglo[i]['tSId'] + '" selected>' + arreglo[i]['tSDescrip'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + arreglo[i]['tSId'] + '">' + arreglo[i]['tSDescrip'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                    desbloquear();
                } else {

                }
            }

        });
}
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
        $('#prov').focus();
    }
});
$('#deparedit').on('change', function () {
    provincia('provedit', this.value,0);
    var prov = $('#deparedit');
    var provvalid = $('#valdeparedit');

    if (this.value === '0') {
        $('#provedit').prop('disabled', true);
        validarCaja('deparedit', 'valdeparedit', 'Escoja departamento', 0)
    } else {
        $('#provedit').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provedit').focus();
    }
});
$('#prov').on('change', function () {
    distrito('dis',this.value,0);
    var prov = $('#prov');
    var provvalid = $('#valprov');

    if (this.value === '0') {
        $('#dis').prop('disabled', true);
        validarCaja('prov', 'valprov', 'Escoja provincia', 0)
    } else {
        $('#dis').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#dis').focus();
    }
});
$('#provedit').on('change', function () {
    distrito('disedit',this.value, 0);
    var prov = $('#provedit');
    var provvalid = $('#valprovedit');

    if (this.value === '0') {
        $('#disedit').prop('disabled', true);
        validarCaja('provedit', 'valprovedit', 'Escoja provincia', 0)
    } else {
        $('#disedit').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#disedit').focus();
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
        $('#cenpo').focus();
    }
});
$('#disedit').on('change', function () {
        $('#cenpoedit').prop('disabled', false);
        $('#cenpoedit').focus();
});
//busca centros poblados
$('#cenpo').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/cepo",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idCentroPoblado,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idcentp = $('#idcentp');
        idcentp.val('');
        idcentp.val(item.id);
        return item;
    }

});
$('#cenpoedit').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/cepo",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idCentroPoblado,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idcentp = $('#idcentpedit');
        idcentp.val('');
        idcentp.val(item.id);
        return item;
    }

});
function validarDni() {
    if(validarDniExpres()===0){
        var dni = $('#dni').val();
        var url = "/referencia/getPacDni/" + dni;
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
                        var pacient = data['pacient'];
                        var person = data['person'];
                        if (pacient!==null || person!==null  ) {
                            if(pacient!==null){
                                $('#tipdoc').prop("disabled", true);
                                $('#dni').val(person['numeroDoc']).prop("disabled", true);
                                $('#appaterno').val(person['apPaterno']).prop("disabled", true);
                                $('#apmaterno').val(person['apMaterno']).prop("disabled", true);
                                $('#pnombre').val(person['pNombre']).prop("disabled", true);
                                $('#snombre').val(person['sNombre']).prop("disabled", true);
                                $('#fecnac').val(person['fecNac']).prop("disabled", true);
                                $('#telefo').val(person['telefono']).prop("disabled", true);
                                $('#dir').val(person['direccion']).prop("disabled", true);
                                $('#fecdiag').val(person['fecExamen']).prop("disabled", true);
                                $('#fecsinini').val(person['fecSintIni']).prop("disabled", true);
                                $('#ref').val(person['referencia']).prop("disabled", true);
                                $('#cenpo').val(person['centrop']).prop("disabled", true);
                                if(person['dist']==null){
                                    completarDis(person['idDistrito']);
                                }else{
                                    completarDis(person['dist']);
                                }
                                completarDisCont(person['paidDistrito']);
                                TipoSeguro(pacient['tSId']);
                                $('#tipseg').prop("disabled", true);
                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    type: 'warning',
                                    title: 'El paciente ya esta registrado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#enviarpac').prop("disabled", true);
                                sit=3;
                            }else{
                                $('#idperson').val(person['idPersona']);
                                $('#tipdoc').prop("disabled", true);
                                $('#dni').val(person['numeroDoc']).prop("disabled", true);
                                $('#appaterno').val(person['apPaterno']).prop("disabled", true);
                                $('#apmaterno').val(person['apMaterno']).prop("disabled", true);
                                $('#pnombre').val(person['pNombre']).prop("disabled", true);
                                $('#snombre').val(person['sNombre']).prop("disabled", true);
                                $('#fecnac').val(person['fecNac']).prop("disabled", true);
                                $('#telefo').val(person['telefono']).prop("disabled", true);
                                $('#dir').val(person['direccion']).prop("disabled", true);
                                $('#cenpo').val(person['centrop']).prop("disabled", true);
                                $('#fecdiag').val(person['fecExamen']).prop("disabled", true);
                                $('#fecsinini').val(person['fecSintIni']).prop("disabled", true);
                                $('#ref').val(person['referencia']).prop("disabled", true);
                                if(person['dist']==null){
                                    completarDis(person['idDistrito']);
                                }else{
                                    completarDis(person['dist']);
                                }
                                completarDisCont(person['paidDistrito']);
                                desbloquear();
                                $('#tipseg').focus();
                                sit=2;
                            }

                        }else{
                            $('#appaterno').focus();
                            sit=1;
                        }
                        desbloquear();
                    } else {

                    }
                },beforeSend: function(){
                    bloquear();
                },

            });
    }
}
function validarDniPac() {

    var dni =43504823;
    var url = "/referencia/getPacienteDni/" + dni;
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

                } else {

                }
            },beforeSend: function(){
                bloquear();
            },

        });
}
function completarDis(iddisval) {
    bloquear();
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
                    desbloquear();
                } else {

                }
            }

        });
}
function completarDisEdit(iddisval) {
    bloquear();
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
                    $('#provedit').append('<option  selected="">' + arreglo['prodescripcion'] + '</option>').prop("disabled", false);
                    $('#disedit').append('<option  selected="">' + arreglo['disdescripcion'] + '</option>').prop("disabled", false);
                    $('#deparedit').append('<option  selected="">' + arreglo['depdescripcion'] + '</option>').prop("disabled", false);
                    desbloquear();
                } else {

                }
            }

        });
}
function completarDisCont(iddisval) {
    bloquear();
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

                    desbloquear();
                } else {

                }
            }

        });
}
function CargarTipPers(id){
    var url = "/referencia/getTipoP";
    var arreglo;
    var select = $('#tippers').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tipp'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if(result[i]['tPId'].toString() === id.toString()){
                            htmla = '<option value="' + result[i]['tPId'] + '"selected>' + result[i]['tPDescripcion'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + result[i]['tPId'] + '">' + result[i]['tPDescripcion'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}
function CargarTipPersEdit(id){
    var url = "/referencia/getTipoP";
    var arreglo;
    var select = $('#tippersedit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tipp'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if(result[i]['tPId'].toString() === id.toString()){
                            htmla = '<option value="' + result[i]['tPId'] + '"selected>' + result[i]['tPDescripcion'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + result[i]['tPId'] + '">' + result[i]['tPDescripcion'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

$('#addPacref').on('click',function(){
    window.event.preventDefault();
    $('#modal_dialog_add_pacref').modal({show: true, backdrop: 'static', keyboard: false});
    $('#fecnac').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    TipoSeguro(0);
    departamento('depar',0);
});

$('#tabla_Pacref').DataTable({
    ajax: '/referencia/getPac',
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    orderCellsTop: true,
    processing: false,
    serverSide: false,
    ordering: false,
    select: true,
    destroy: false,
    responsive: true,
    bAutoWidth: true,
    dom: 'lBfrtip',
    buttons: [
        'excel', 'pdf'
    ],
    columnDefs: [
        {"targets": 0, "width": "25%", "className": "text-left"},
        {"targets": 1, "width": "10%", "className": "text-center"},
        {"targets": 2, "width": "10%", "className": "text-center"},
        {"targets": 3, "width": "20%", "className": "text-left"},
        {"targets": 4, "width": "5%", "className": "text-center"},
        {"targets": 5, "width": "5%", "className": "text-center"},
        {"targets": 6, "width": "5%", "className": "text-center"},
        {"targets": 7, "width": "5%", "className": "text-center"},
        {"targets": 8, "width": "5%", "className": "text-center"},
    ],
    columns: [

        {data: 'person', name: 'person'},
        {data: 'numeroDoc', name: 'numeroDoc'},
        {
            data: function (row) {
                if(row.codigo==null){
                  return row.coddist;
                }else{
                    return row.codigo;
                }

            }
        },
        {data: 'tSDescrip', name: 'tSDescrip'},
        {data: 'telefono', name: 'telefono'},
        {data: 'pFecCrea', name: 'pFecCrea'},
        {data: 'user', name: 'user'},
        {
            data: function (row) {
                return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

            }
        },
        {
            data: function (row) {
                if (parseInt(row.pEst) === 1 && parseInt(row.pEst) === 1) {
                    return '<tr >\n' +
                        '<a href="#"  onclick="abrilModalEdPac(' + row.numeroDoc + ')" TITLE="Editar Personal " >\n' +
                        '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                        '<a href="#" style="color: red" TITLE="Eliminar Paciente" onclick="eliminarPaciente(' + row.pId +')">' +
                        '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                        '</tr>';
                } else {
                    return '<tr >\n' +
                        '<a href="#" style="color: green" TITLE="Restaurar Paciente"  onclick="eliminarPaciente(' + row.pId +')">\n' +
                        '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                        '</tr>';
                }
            }
        }
    ]
});

function abrilModalEdPac(dni) {
    window.event.preventDefault();
    $('#modal_dialog_edit_pacref').modal('show');
    TipoSeguroEdit(0);
    $('#fecnacedit').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    obtenerEditarPaciente(dni);
}
function obtenerEditarPaciente(dni) {
    var url = "/referencia/getPacDni/" + dni;
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
                    var pacient = data['pacient'];
                    var person = data['person'];
                    if (pacient!==null || person!==null  ) {
                            $('#tipdocedit').prop("disabled", false);
                            $('#tipdocedit').val(person['tipoDoc']);
                            $('#dniedit').val(person['numeroDoc']).prop("disabled",false);
                            $('#appaternoedit').val(person['apPaterno']);
                            $('#apmaternoedit').val(person['apMaterno']);
                            $('#pnombreedit').val(person['pNombre']);
                            $('#snombreedit').val(person['sNombre']);
                            $('#fecnacedit').val(person['fecNac']);
                            $('#telefoedit').val(person['telefono']);
                            $('#diredit').val(person['direccion']);
                            $('#fecdiagedit').val(person['fecExamen']);
                            $('#fecsininiedit').val(person['fecSintIni']);
                            $('#refedit').val(person['referencia']);
                            $('#cenpoedit').val(person['centrop']);
                            $('#idpacienedit').val(pacient['pId']);
                            $('#idpactipsedit').val(pacient['pTSId']);
                            $('#idpersonedit').val(pacient['idPersona']);
                            if(person['dist']==null){
                                $('#siti').val(2);
                                $('#idcentpedit').val(person['idCentroPoblado']);
                                departamento('deparedit',person['idDepartamento']);
                                provincia('provedit',person['idDepartamento'],person['idProvincia']);
                                distrito('disedit',person['idProvincia'],person['idDistrito']);
                            }else{
                                departamento('deparedit',person['depa']);
                                provincia('provedit',person['depa'],person['provin']);
                                distrito('disedit',person['provin'],person['dist']);
                                $('#siti').val(1);
                            }
                            TipoSeguroEdit(pacient['tSId']);
                            desbloquear();

                    }else{
                        $('#appaterno').focus();
                    }
                    desbloquear();
                } else {

                }
            },beforeSend: function(){
                bloquear();
            },

        });
}


function eliminarPaciente(idpac){

    var url="/referencia/deletePac/"+idpac;
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
            if(exist==0){
                $.ajax(
                    {
                        url: url,
                        type: 'GET',
                        cache:false,
                        dataType: 'JSON',
                        data: '_token = <?php echo csrf_token() ?>',
                        success: function (data) {
                            if (data['error'] === 0) {
                                redirect('/referencia/agregarpaciente');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Paciente eliminado/restaurado correctamente!',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            } else {
                                redirect('/Usuario/agregarpaciente');
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
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    type: 'warning',
                    title: 'atencion!',
                    text: 'El Personal esta activo en otro establecimiento..',
                    showConfirmButton: false,
                    timer: 5000
                });
                redirect('/referencia/agregarpersonal');
            }
        }
    })
}
function enviarPac() {
    //validarDniPac();
    if(validarFormularioPac()===0){
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
                var idperson = $('#idperson').val();
                var tipdoc = $('#tipdoc').val();
                var ndoc = $('#dni').val();
                var appaterno = $('#appaterno').val();
                var apmaterno = $('#apmaterno').val();
                var pnombre = $('#pnombre').val();
                var snombre = $('#snombre').val();
                var fecnac = $('#fecnac').val();
                var telefono = $('#telefo').val();
                var iddist = $('#dis').val();
                var idcento = $('#idcentp').val();
                var referenc = $('#ref').val();
                var direcc = $('#dir').val();
                var tipos = $('#tipseg').val();

                $.ajax({
                    url: '/referencia/storePac',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idperson:idperson,
                        tipdoc:tipdoc,
                        numdoc:ndoc,
                        appaterno:appaterno,
                        apmaterno: apmaterno,
                        pnombre:pnombre,
                        snombre:snombre,
                        fecNac:fecnac,
                        telefono: telefono,
                        iddist: iddist,
                        idcp:idcento,
                        referencia:referenc,
                        direccion:direcc,
                        tips: tipos,
                        sit:sit,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Paciente exitoso',
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

                    ,
                    beforeSend: function () {
                        $('#enviarpac').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}

function enviarPacEdit() {
    if($('#cenpoedit').val()==''){
        $('#idcentpedit').val(0);
    }
    if(validarFormularioPacEdit()===0){
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editara el registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                var idperson = $('#idpersonedit').val();
                var tipdoc = $('#tipdocedit').val();
                var ndoc = $('#dniedit').val();
                var appaterno = $('#appaternoedit').val();
                var apmaterno = $('#apmaternoedit').val();
                var pnombre = $('#pnombreedit').val();
                var snombre = $('#snombreedit').val();
                var fecnac = $('#fecnacedit').val();
                var telefono = $('#telefoedit').val();
                var iddist = $('#disedit').val();
                var idcento = $('#idcentpedit').val();
                var referenc = $('#refedit').val();
                var direcc = $('#diredit').val();
                var tipos = $('#tipsegedit').val();
                var idpac = $('#idpacienedit').val();
                var idpactips = $('#idpactipsedit').val();
                var siti=$('#siti').val();
                $.ajax({
                    url: '/referencia/editPac',
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        idperson:idperson,
                        tipdoc:tipdoc,
                        numdoc:ndoc,
                        appaterno:appaterno,
                        apmaterno: apmaterno,
                        pnombre:pnombre,
                        snombre:snombre,
                        fecNac:fecnac,
                        telefono: telefono,
                        iddist: iddist,
                        idcp:idcento,
                        referencia:referenc,
                        direccion:direcc,
                        tips: tipos,
                        idpac:idpac,
                        idpactips:idpactips,
                        siti:siti,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Paciente Editado Exitosamente',
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

                    ,
                    beforeSend: function () {
                        $('#enviarpacedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}

function validarFormularioPac() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#tipdoc').val() !== '0') {
        validarCaja('tipdoc', 'validtipodoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Tipo de documento';
        validarCaja('tipdoc', 'validtipodoc', text, 0);
    }
    if ($('#dni').val() !== '') {
        validarCaja('dni', 'validDni', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Dni';
        validarCaja('dni', 'validDni', text, 0);
    }
    if ($('#appaterno').val() !== '') {
        validarCaja('appaterno', 'valappaterno', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Apellido Paterno';
        validarCaja('appaterno', 'valappaterno', text, 0);
    }
    if ($('#apmaterno').val() !== '') {
        validarCaja('apmaterno', 'valapmaterno', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Apellido Materno';
        validarCaja('apmaterno', 'valapmaterno', text, 0);
    }
    if ($('#pnombre').val() !== '') {
        validarCaja('pnombre', 'valpnombre', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Primer Nombre';
        validarCaja('pnombre', 'valpnombre', text, 0);
    }
    if ($('#fecnac').val() !== '') {
        validarCaja('fecnac', 'valfecnac', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Fecha de Nacimiento';
        validarCaja('fecnac', 'valfecnac', text, 0);
    }
    if ($('#telefo').val() !== '') {
        validarCaja('telefo', 'valtelefo', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Telefono';
        validarCaja('telefo', 'valtelefo', text, 0);
    }
    if ($('#depar').val() !== '0') {
        validarCaja('depar', 'valdepar', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Departamento';
        validarCaja('depar', 'valdepar', text, 0);
    }
    if ($('#prov').val() !== '0') {
        validarCaja('prov', 'valprov', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Provincia';
        validarCaja('prov', 'valprov', text, 0);
    }
    if ($('#dis').val() !== '0') {
        validarCaja('dis', 'valdis', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Distrito';
        validarCaja('dis', 'valdis', text, 0);
    }
    if ($('#tipseg').val() !== '0') {
        validarCaja('tipseg', 'valtipseg', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el Tipo de seguro';
        validarCaja('tipseg', 'valtipseg', text, 0);
    }
    return cont;
}

function validarFormularioPacEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#tipdocedit').val() !== '0') {
        validarCaja('tipdocedit', 'validtipodocedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Tipo de documento';
        validarCaja('tipdocedit', 'validtipodocedit', text, 0);
    }
    if ($('#dniedit').val() !== '') {
        validarCaja('dniedit', 'validDniedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Dni';
        validarCaja('dniedit', 'validDniedit', text, 0);
    }
    if ($('#appaternoedit').val() !== '') {
        validarCaja('appaternoedit', 'valappaternoedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Apellido Paterno';
        validarCaja('appaternoedit', 'valappaternoedit', text, 0);
    }
    if ($('#apmaternoedit').val() !== '') {
        validarCaja('apmaternoedit', 'valapmaternoedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Apellido Materno';
        validarCaja('apmaternoedit', 'valapmaternoedit', text, 0);
    }
    if ($('#pnombreedit').val() !== '') {
        validarCaja('pnombreedit', 'valpnombreedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Primer Nombre';
        validarCaja('pnombreedit', 'valpnombreedit', text, 0);
    }
    if ($('#fecnacedit').val() !== '') {
        validarCaja('fecnacedit', 'valfecnacedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Fecha de Nacimiento';
        validarCaja('fecnacedit', 'valfecnacedit', text, 0);
    }
    if ($('#telefoedit').val() !== '') {
        validarCaja('telefoedit', 'valtelefoedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Fecha de Nacimiento';
        validarCaja('telefoedit', 'valtelefoedit', text, 0);
    }
    if ($('#deparedit').val() !== '0') {
        validarCaja('deparedit', 'valdeparedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Departamento';
        validarCaja('deparedit', 'valdeparedit', text, 0);
    }
    if ($('#provedit').val() !== '0') {
        validarCaja('provedit', 'valprovedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Provincia';
        validarCaja('provedit', 'valprovedit', text, 0);
    }
    if ($('#disedit').val() !== '0') {
        validarCaja('disedit', 'valdisedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Distrito';
        validarCaja('disedit', 'valdisedit', text, 0);
    }
    if ($('#tipsegedit').val() !== '0') {
        validarCaja('tipsegedit', 'valtipsegedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el Tipo de seguro';
        validarCaja('tipsegedit', 'valtipsegedit', text, 0);
    }
    return cont;
}

/*function validarDniExpres() {
    var dni = $('#dni').val();
    var tipdoc = $('#tipdoc').val();
    var expres;
    var text;
    var cont = 0;
    if (tipdoc === '1') {
        expres = /^[0-9]{8}$/;
        if (expres.test(dni)) {
            validarCaja('dni', 'validDni', 'correcto', 1);
            $('#enviarpac').prop('disabled', false);
        }
        else {
            cont++;
            text = 'Dni incorrecto, vuelva a ingresar el dni';
            validarCaja('dni', 'validDni', text, 0);
            $('#enviarpac').prop('disabled', true);
        }
    }
    else {
        if (tipdoc === '2') {
            expres = /^[0-9]{12}$/;
            if (expres.test(dni)) {
                validarCaja('dni', 'validDni', 'correcto', 1);
                $('#enviarpac').prop('disabled', false);
            }
            else {
                cont++;
                text = 'Carnet de estranjeria incorrecto, vuelva a ingresar el carnet';
                validarCaja('dni', 'validDni', text, 0);
                $('#enviarpac').prop('disabled', true);
            }
        }
    }
    return cont;
}*/
