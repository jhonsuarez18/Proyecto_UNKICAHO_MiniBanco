var idofic=0;
var exist=0;
var idsm=0;
var sit=0;
var camposadd = [];
var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
$(document).ready(function (){
    $('.modal-backdrop').remove();
    if(parseInt($('#idvi').val())===1){
        $('#modal_dialog_add_chofer').modal('show');
        camposadd=[];
        camposChoferAdd();
        getFechaUt('fecnacc');
        departamento('deparc',0);
        CargarTipPers(3);
        cargaroficinas();
        limpiarCaja(camposadd);
        iniciarcampos();
    }
    tablachofer();
});
function camposChoferAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "tipdocc";
    tablacampos[1] = "validtipodocc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "dnic";
    tablacampos[1] = "validDnic";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "appaternoc";
    tablacampos[1] = "valappaternoc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "apmaternoc";
    tablacampos[1] = "valapmaternoc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "pnombrec";
    tablacampos[1] = "valpnombrec";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "snombrec";
    tablacampos[1] = "valsnombrec";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "fecnacc";
    tablacampos[1] = "valfecnacc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "telefoc";
    tablacampos[1] = "valtelefoc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "deparc";
    tablacampos[1] = "valdeparc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "provc";
    tablacampos[1] = "valprovc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "disc";
    tablacampos[1] = "valdisc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "cenpoc";
    tablacampos[1] = "valcenpoc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "refc";
    tablacampos[1] = "valrefc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "dirc";
    tablacampos[1] = "valdirc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "tippersc";
    tablacampos[1] = "validartippersc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "colegc";
    tablacampos[1] = "valcolegc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "especc";
    tablacampos[1] = "valespecc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "descentc";
    tablacampos[1] = "validardescentc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarchofer').prop("disabled", false);
}
function camposChoferEdit() {
    var tablacampos = new Array();
    tablacampos[0] = "tipdoceditc";
    tablacampos[1] = "validtipodoceditc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "dnieditc";
    tablacampos[1] = "validDnieditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "appaternoeditc";
    tablacampos[1] = "valappaternoeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "apmaternoeditc";
    tablacampos[1] = "valapmaternoeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "pnombreeditc";
    tablacampos[1] = "valpnombreeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "snombreeditc";
    tablacampos[1] = "valsnombreeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "fecnaceditc";
    tablacampos[1] = "valfecnaceditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "telefoeditc";
    tablacampos[1] = "valtelefoeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "depareditc";
    tablacampos[1] = "valdepareditc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "proveditc";
    tablacampos[1] = "valproveditc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "diseditc";
    tablacampos[1] = "valdiseditc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "cenpoeditc";
    tablacampos[1] = "valcenpoeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "refeditc";
    tablacampos[1] = "valrefeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "direditc";
    tablacampos[1] = "valdireditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "tipperseditc";
    tablacampos[1] = "validartipperseditc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "colegeditc";
    tablacampos[1] = "valcolegeditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "especeditc";
    tablacampos[1] = "valespeceditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "descenteditc";
    tablacampos[1] = "validardescenteditc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarchoferedit').prop("disabled", false);
}
function CargarTipPers(id){
    var url = "/referencia/getTipoP";
    var select = $('#tippersc').html('');
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
$("#nuepermc").on('change', function () {
    $('#descentc').prop("disabled", false);
    $('#descentc').val('');
    $('#descentc').focus();

});
$("#nuepermeditc").on('change', function () {
    $('#descenteditc').prop("disabled", false);
    $('#descenteditc').val('');
    $('#descenteditc').focus();

});
$('#descentc').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getOficEnt/"+idofic,
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.oEId,
                        name: item.estable,
                        uname: item.estable,
                        numdoc: item.codest
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#codoficc');
        var fin = $('#nomboficc');

        var idfin = $('#idoficentc');
        pro.val('');
        fin.val('');
        idfin.val('');
        fin.val(item.uname);
        pro.val(item.numdoc);
        idfin.val(item.id);
        valPersona(0,item.id);
        return item;
    },
});
$('#descenteditc').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getOficEnt/"+idofic,
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.oEId,
                        name: item.estable,
                        uname: item.estable,
                        numdoc: item.codest
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#codoficeditc');
        var fin = $('#nomboficeditc');

        var idfin = $('#idoficenteditc');
        pro.val('');
        fin.val('');
        idfin.val('');
        fin.val(item.uname);
        pro.val(item.numdoc);
        idfin.val(item.id);
        valPersonaEdit(0,item.id);
        return item;
    },
});
function CargarTipPersEdit(id){
    var url = "/referencia/getTipoP";
    var arreglo;
    var select = $('#tipperseditc').html('');
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

$('#persrefeditc').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getPersonas",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idp,
                        name: item.nombre,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {

        var idfin = $('#idperseditc');
        idfin.val('');
        idfin.val(item.id);
        valPersonaEdit(item.id,0);
        return item;
    },
});
$('#cenpoc').typeahead({
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
        let idcentp = $('#idcentpc');
        idcentp.val('');
        idcentp.val(item.id);
        return item;
    }

});
$('#cenpoeditc').typeahead({
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
        let idcentp = $('#idcentpeditc');
        idcentp.val('');
        idcentp.val(item.id);
        return item;
    }

});
function cargaroficinas(){
    var url = "/referencia/getOficAct";
    var perm = $('#nuepermc').html('');
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
                    var encarg = data['ofic'];
                    if(encarg.length>0){
                        for (var i = 0; i < encarg.length; i++) {
                            htmla ='<div class="form-check">\n' +
                                '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nuepermc' + encarg[i]['oId'] + '" value="" onchange="cargarofent(' + encarg[i]['oId'] + ')">' +
                                '                        <label class="form-check-label" for="nuepermc' + encarg[i]['oId'] + '">' + encarg[i]['oNombre']  + '</label>\n' +
                                '                    </div>';
                            html = htmla + html;
                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}
function cargaroficinasedit(idus){
    var url = "/referencia/getOficAct";
    var perm = $('#nuepermeditc').html('');
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
                    var ofic = data['ofic'];
                    if(ofic.length>0){
                        for (var i = 0; i < ofic.length; i++) {
                            htmla ='<div class="form-check">\n' +
                                '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nuepermeditc' + ofic[i]['oId'] + '" value="" onchange="cargarofent(' + ofic[i]['oId'] + ')">' +
                                '                        <label class="form-check-label" for="nuepermeditc' + ofic[i]['oId'] + '">' + ofic[i]['oNombre']  + '</label>\n' +
                                '                    </div>';
                            html = htmla + html;
                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}
function cargarofent(id) {
    idofic=id;
}
$('#addChofer').on('click',function(){
    window.event.preventDefault();
    $('#modal_dialog_add_chofer').modal('show');
    camposadd=[];
    camposChoferAdd();
    getFechaUt('fecnacc');
    departamento('deparc',0);
    CargarTipPers(3);
    cargaroficinas();
    limpiarCaja(camposadd);
    iniciarcampos();
});
function iniciarcampos(){
    $('#tipdocc').val("0").prop('disabled',false);
    $('#provc').val("0").prop('disabled',true);
    $('#deparc').val("0").prop('disabled',false);
    $('#disc').val("0").prop('disabled',true);
    $('#dnic').prop('disabled',true);
    $('#descentc').prop('disabled',true);
    $('#appaternoc').prop('disabled',false);
    $('#apmaternoc').prop('disabled',false);
    $('#pnombrec').prop('disabled',false);
    $('#snombrec').prop('disabled',false);
    $('#fecnacc').prop('disabled',false);
    $('#telefoc').prop('disabled',false);
    $('#cenpoc').prop('disabled',false);
    $('#refc').prop('disabled',false);
    $('#dirc').prop('disabled',false);
}
$('#tipdocc').on('change', function () {
    var dni = $('#dnic');
    if (this.value === '0') {
        dni.val('');
        dni.prop('disabled', true);
        validarCaja('tipdocc', 'validtipodocc', 'Escoja tipo documento', 0)
    } else {
        dni.prop('disabled', false);
        dni.val('');
        validarCaja('tipdocc', 'validtipodocc', '', 1)
    }

});
$('#deparc').on('change', function () {
    provincia('provc', this.value);
    var prov = $('#deparc');
    var provvalid = $('#valdeparc');

    if (this.value === '0') {
        $('#provc').prop('disabled', true);
        validarCaja('deparc', 'valdeparc', 'Escoja departamento', 0)
    } else {
        $('#provc').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provc').focus();
    }
});
$('#depareditc').on('change', function () {
    provincia('proveditc', this.value,0);
    var prov = $('#depareditc');
    var provvalid = $('#valdeparc');

    if (this.value === '0') {
        $('#proveditc').prop('disabled', true);
        validarCaja('depareditc', 'valdepareditc', 'Escoja departamento', 0)
    } else {
        $('#proveditc').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#proveditc').focus();
    }
});
$('#provc').on('change', function () {
    distrito('disc',this.value, 0);
    var prov = $('#provc');
    var provvalid = $('#valprovc');

    if (this.value === '0') {
        $('#disc').prop('disabled', true);
        validarCaja('provc', 'valprovc', 'Escoja provincia', 0)
    } else {
        $('#disc').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#disc').focus();
    }
});
$('#proveditc').on('change', function () {
    distrito('diseditc',this.value, 0);
    var prov = $('#proveditc');
    var provvalid = $('#valproveditc');

    if (this.value === '0') {
        $('#diseditc').prop('disabled', true);
        validarCaja('proveditc', 'valproveditc', 'Escoja provincia', 0)
    } else {
        $('#diseditc').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#diseditc').focus();
    }
});
$('#disc').on('change', function () {

    var dis = $('#disc');
    var disval = $('#valdisc');

    if (this.value === '0') {
        validarCaja('disc', 'valdisc', 'Escoja distrito', 0)
    } else {
        $('#disc').prop('disabled', false);
        disval.removeClass('valid-feedback');
        dis.removeClass('is-valid');
        dis.removeClass('is-invalid');
        disval.addClass('invalid-feedback');
        $('#cenpoc').focus();
    }
});
$('#diseditc').on('change', function () {
    $('#cenpoeditc').prop('disabled', false);
    $('#cenpoeditc').focus();
});
function valPersona(idper,ideess) {
    var idperson=$('#idpersonc').val();
    var idofent=$('#idoficentc').val();
    if(idperson==''){
        idperson=idper;
    }
    if(idofent==0){
        idofent=ideess;
    }
    if(idperson!==0){
        var url = "/referencia/valPers/" + idperson;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        var result = data['per'];
                        if (result.length>0) {
                            for(var i=0;i<result.length;i++){
                                if(result[i]['pEst']==0){
                                    if(result[i]['oEId']===parseInt(idofent)){
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'warning',
                                            type: 'warning',
                                            title: 'El chofer ya esta asignado a esa oficina entidad, por favor restaure',
                                            showConfirmButton: false,
                                            timer: 4000
                                        });
                                        validarCaja('dnic', 'validDnic', 'El chofer ya esta asignado a esa oficina entidad', 0);
                                        validarCaja('descentc', 'validardescentc', 'La oficina Entidad ya esta asignado a ese chofer', 0);
                                        i=result.length;
                                        $('#enviarchofer').prop("disabled", true);
                                    }else{
                                        validarCaja('dnic', 'validDnic', 'Persona Correcta', 1);
                                        if(idofent!==0){
                                            validarCaja('descentc', 'validardescentc', 'Oficina Entidad Correcto', 1);
                                        }
                                        $('#enviarchofer').prop("disabled", false);
                                    }
                                }else{
                                    validarCaja('validDnic', 'validDnic', 'El chofer ya esta asignado a una oficina entidad', 0);
                                    if(idofent!==0){
                                        validarCaja('descentc', 'validardescentc', 'Oficina Entidad Correcto', 1);
                                    }
                                    $('#enviarchofer').prop("disabled", true);
                                }
                            }
                        }
                        else {
                            validarCaja('validDnic', 'validDnic', 'Persona Correcta', 1);
                            if(idofent!==0){
                                validarCaja('descentc', 'validardescentc', 'Oficina Entidad Correcto', 1);
                            }
                            $('#enviarchofer').prop("disabled", false);
                        }
                    }

                }, beforeSend() {
                    $('#enviarchofer').prop("disabled", true);
                }

            });
    }
}

function valPersonaEdit(idper,ideess) {
    var idperson=$('#idpersoneditc').val();
    var idperact=$('#idpersacteditc').val();
    var idofent=$('#idoficenteditc').val();
    if(idperson==''){
        idperson=idper;
    }
    if(idofent==''){
        idofent=ideess;
    }
    if(idperson!==0){
        var url = "/referencia/valPers/" + idperson;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        var result = data['per'];
                        if (result.length>0) {
                            if(result.length>1 && idperson===idperact){
                                for(var i=0;i<result.length;i++){
                                    if(result[i]['pEst']===0){
                                        if(result[i]['oEId']===parseInt(idofent)){
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'warning',
                                                type: 'warning',
                                                title: 'El chofer ya esta asignado a ese establecimiento, por favor restaure',
                                                showConfirmButton: false,
                                                timer: 4000
                                            });
                                            validarCaja('dnieditc', 'validDnieditc', 'El chofer ya esta asignado a esa oficina entidad', 0);
                                            validarCaja('descenteditc', 'validardescenteditc', 'La oficina entidad ya esta asignado a ese chofer', 0);
                                            i=result.length;
                                            $('#enviarchoferedit').prop("disabled", true);
                                        }else{
                                            validarCaja('dnieditc', 'validDnieditc', 'Persona Correcta', 1);
                                            if(idofent!==''){
                                                validarCaja('descenteditc', 'validardescenteditc', 'Oficina entidad Correcto', 1);
                                            }
                                            $('#enviarchoferedit').prop("disabled", false);
                                        }
                                    }else{
                                        validarCaja('dnieditc', 'validDnieditc', 'El chofer ya esta asignado a una oficina entidad', 0);
                                        if(idofent!==0){
                                            validarCaja('descenteditc', 'validardescenteditc', 'Oficina entidad Correcto', 1);
                                        }
                                    }
                                }
                            }else{
                                validarCaja('dnieditc', 'validDnieditc', 'Persona Correcta', 1);
                                if(idofent!==0){
                                    validarCaja('descenteditc', 'validardescenteditc', 'Oficina entidad Correcto', 1);
                                }
                                $('#enviarchoferedit').prop("disabled", false);
                            }
                        }
                        else {
                            validarCaja('dnieditc', 'validDnieditc', 'Persona Correcta', 1);
                            if(idofent!==0){
                                validarCaja('descenteditc', 'validardescenteditc', 'Oficina entidad Correcto', 1);
                            }
                            $('#enviarchoferedit').prop("disabled", false);
                        }
                    }

                }, beforeSend() {
                    $('#enviarchoferedit').prop("disabled", true);
                }

            });
    }
}
function tablachofer(){
    $('#tabla_Chofer').DataTable({
        ajax: '/referencia/getChof',
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
            {"targets": 0, "width": "20%", "className": "text-left"},
            {"targets": 1, "width": "5%", "className": "text-center"},
            {"targets": 2, "width": "10%", "className": "text-left"},
            {"targets": 3, "width": "20%", "className": "text-left"},
            {"targets": 4, "width": "10%", "className": "text-left"},
            {"targets": 5, "width": "5%", "className": "text-center"},
            {"targets": 6, "width": "5%", "className": "text-left"},
            {"targets": 7, "width": "5%", "className": "text-center"},
            {"targets": 8, "width": "5%", "className": "text-center"},
        ],
        columns: [

            {data: 'person', name: 'person'},
            {data: 'numeroDoc', name: 'numeroDoc'},
            {data: 'tPDescripcion', name: 'tPDescripcion'},
            {
                data: function (row) {
                    switch (parseInt(row.oId)){
                        case 4: return  row.Descripcion ;
                            idsm=18;
                            break;
                        case 5:return row.nombre ;
                            idsm=18;
                            break;
                        case 6:return row.descripcion ;
                            idsm=17;
                            break;
                        case 7:return row.descripcionEjecutora;
                            idsm=18;
                            break;
                        case 8:return row.eDesc;
                            idsm=18;
                            break;
                    }

                }
            },
            {data: 'oNombre', name: 'oNombre'},
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
                            '<a href="#"  onclick="abrilModalEdChofer(' + row.numeroDoc + ')" TITLE="Editar Chofer " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Chofer" onclick="eliminarChofer(' + row.pId +','+row.idPersona +','+0+  ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Chofer"  onclick="eliminarChofer(' + row.pId +','+row.idPersona+','+1+ ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function abrilModalEdChofer(idper) {
    window.event.preventDefault();
    $('#modal_dialog_edit_chofer').modal('show');
    cargaroficinasedit(0);
    obtenerEditarChofer(idper);
    getFechaUt('fecnaceditc');
    camposadd=[];
    camposChoferEdit();
}
function obtenerEditarChofer(dni) {
    var url = "/referencia/getPacDni/" + dni;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var personal = data['personal'];
                    var person = data['person'];
                    if (personal!==null || person!==null  ){
                        $('#tipdoceditc').prop("disabled", false);
                        $('#tipdoceditc').val(person['tipoDoc']);
                        $('#dnieditc').val(person['numeroDoc']).prop("disabled",false);
                        $('#appaternoeditc').val(person['apPaterno']);
                        $('#apmaternoeditc').val(person['apMaterno']);
                        $('#pnombreeditc').val(person['pNombre']);
                        $('#snombreeditc').val(person['sNombre']);
                        $('#fecnaceditc').val(person['fecNac']);
                        $('#telefoeditc').val(person['telefono']);
                        $('#direditc').val(person['direccion']);
                        $('#fecdiageditc').val(person['fecExamen']);
                        $('#fecsininieditc').val(person['fecSintIni']);
                        $('#refeditc').val(person['referencia']);
                        $('#cenpoeditc').val(person['centrop']);
                        $('#idpersonaleditc').val(personal['pId']);
                        $('#idpersoneditc').val(personal['idPersona']);
                        $('#idpersacteditc').val(personal['idPersona']);
                        $('#persrefeditc').val(personal['person']);
                        $('#colegeditc').val(personal['pColegiatura']);
                        $('#especeditc').val(personal['pEspecialidad']);
                        $('#idoficenteditc').val(personal['oEId']);
                        $('#nuepermeditc'+personal['oId']).prop("checked", true);
                        CargarTipPersEdit(personal['tPId']);
                        cargarofent(personal['oId']);
                        switch (personal['oId']){
                            case 4:$('#descenteditc').val(personal['Descripcion']);
                                break;
                            case 5:$('#descenteditc').val(personal['nombre']);
                                break;
                            case 6:$('#descenteditc').val(personal['descripcion']);
                                break;
                            case 7:$('#descenteditc').val(personal['descripcionEjecutora']);
                                break;
                            case 8:$('#descenteditc').val(personal['eDesc']);
                                break;
                        }
                        if(person['dist']==null){
                            $('#siti').val(2);
                            $('#idcentpeditc').val(person['idCentroPoblado']);
                            departamento('depareditc',person['idDepartamento']);
                            provincia('proveditc',person['idDepartamento'],person['idProvincia']);
                            distrito('diseditc',person['idProvincia'],person['idDistrito']);
                        }else{
                            departamento('depareditc',person['depa']);
                            provincia('proveditc',person['depa'],person['provin']);
                            distrito('diseditc',person['provin'],person['dist']);
                            $('#sitic').val(1);
                        }
                    }
                    $('#dnieditc').focus();
                }
                else {

                }

            }

        });
}
function validarelimicion(idperson){
    exist=0;
    var url = "/referencia/valPers/" + idperson;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['per'];
                    for(var i=0;i<result.length;i++){
                        if(result[i]['pEst']==1 && result.length>1){
                            exist=exist+1;
                        }
                    }
                }

            }, beforeSend() {
                $('#enviarchofer').prop("disabled", true);
            }

        });
}
function validDni() {
    if(validarDniExpres('enviarchofer','dnic','tipdocc','validDnic')===0){
        var dni = $('#dnic').val();
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
                        var personal = data['personal'];
                        var person = data['person'];

                        if (personal!==null || person!==null  ) {
                            if(personal!==null){
                                $('#tipdoc').prop("disabled", true);
                                $('#dnic').val(person['numeroDoc']).prop("disabled", true);
                                $('#appaternoc').val(person['apPaterno']).prop("disabled", true);
                                $('#apmaternoc').val(person['apMaterno']).prop("disabled", true);
                                $('#pnombrec').val(person['pNombre']).prop("disabled", true);
                                $('#snombrec').val(person['sNombre']).prop("disabled", true);
                                $('#fecnacc').val(person['fecNac']).prop("disabled", true);
                                $('#telefoc').val(person['telefono']).prop("disabled", true);
                                $('#dirc').val(person['direccion']).prop("disabled", true);
                                $('#cenpoc').val('').prop("disabled", true);
                                $('#refc').val(person['referencia']).prop("disabled", true);
                                $('#cenpoc').val(person['centrop']).prop("disabled", true);
                                $('#colegc').val(personal['pColegiatura']).prop("disabled", true);
                                $('#especc').val(personal['pEspecialidad']).prop("disabled", true);
                                $('#nuepermc'+personal['oId']).prop("checked", true);
                                CargarTipPers(personal['tPId']);
                                $('#tippersc').prop("disabled",true);
                                cargarofent(personal['oId']);
                                if(person['dist']==null){
                                    completarDis(person['idDistrito']);
                                }else{
                                    completarDis(person['dist']);
                                }
                                switch (personal['oId']){
                                    case 4:$('#descentc').val(personal['Descripcion']);
                                        break;
                                    case 5:$('#descentc').val(personal['nombre']);
                                        break;
                                    case 6:$('#descentc').val(personal['descripcion']);
                                        break;
                                    case 7:$('#descentc').val(personal['descripcionEjecutora']);
                                        break;
                                }
                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    type: 'warning',
                                    title: 'El chofer ya esta registrado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#enviarchofer').prop("disabled", true);
                                sit=3;
                            }else{
                                $('#idpersonc').val(person['idPersona']);
                                $('#tipdocc').prop("disabled", true);
                                $('#dnic').val(person['numeroDoc']).prop("disabled", true);
                                $('#appaternoc').val(person['apPaterno']).prop("disabled", true);
                                $('#apmaternoc').val(person['apMaterno']).prop("disabled", true);
                                $('#pnombrec').val(person['pNombre']).prop("disabled", true);
                                $('#snombrec').val(person['sNombre']).prop("disabled", true);
                                $('#fecnacc').val(person['fecNac']).prop("disabled", true);
                                $('#telefoc').val(person['telefono']).prop("disabled", true);
                                $('#dirc').val(person['direccion']).prop("disabled", true);
                                $('#cenpoc').val(person['centrop']).prop("disabled", true);
                                $('#fecdiagc').val(person['fecExamen']).prop("disabled", true);
                                $('#fecsininic').val(person['fecSintIni']).prop("disabled", true);
                                $('#refc').val(person['referencia']).prop("disabled", true);
                                if(person['dist']==null){
                                    completarDis(person['idDistrito']);
                                }else{
                                    completarDis(person['dist']);
                                }
                                desbloquear();
                                $('#tippersc').focus();
                                sit=2;
                            }

                        }else{
                            $('#appaternoc').focus();
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
                    $('#provc').append('<option  selected="">' + arreglo['prodescripcion'] + '</option>').prop("disabled", true);
                    $('#disc').append('<option  selected="">' + arreglo['disdescripcion'] + '</option>').prop("disabled", true);
                    $('#deparc').append('<option  selected="">' + arreglo['depdescripcion'] + '</option>').prop("disabled", true);
                    desbloquear();
                } else {

                }
            }

        });
}
function eliminarChofer(idper,idperson,lug){
    if(lug==1){
        validarelimicion(idperson);
    }else{
        exist=0;
    }
    var url="/referencia/deletePers/"+idper;
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
                                tablachofer();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Chofer eliminado/restaurado correctamente!',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                            } else {
                                tablachofer();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    type: 'error',
                                    title: 'ocurrio un error!',
                                    text: data['error'],
                                    showConfirmButton: false,
                                    timer: 4000
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
                    text: 'El Chofer esta activo en otro oficina entidad..',
                    showConfirmButton: false,
                    timer: 5000
                });
                tablachofer();
            }
        }
    })
}
function enviarChofer() {
    if(validarFormularioChofer()===0){
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
                var idperson = $('#idpersonc').val();
                var tipdoc = $('#tipdocc').val();
                var ndoc = $('#dnic').val();
                var appaterno = $('#appaternoc').val();
                var apmaterno = $('#apmaternoc').val();
                var pnombre = $('#pnombrec').val();
                var snombre = $('#snombrec').val();
                var fecnac = $('#fecnacc').val();
                var telefono = $('#telefoc').val();
                var iddist = $('#disc').val();
                var idcento = $('#idcentpc').val();
                var referenc = $('#refc').val();
                var direcc = $('#dirc').val();
                var idofent = $('#idoficentc').val();
                var idtipp = $('#tippersc').val();
                var coleg = $('#colegc').val();
                var espec = $('#especc').val();

                $.ajax({
                    url: '/referencia/storePers',
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
                        sit:sit,
                        idoe:idofent,
                        idtipp:idtipp,
                        coleg: coleg,
                        espec: espec,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Chofer exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                    if(parseInt($('#idvi').val())===1){
                                        redirect('/combustible/vale');
                                    }else{
                                        limpiarCaja(camposadd);
                                        closeModal('modal_dialog_add_chofer')
                                        tablachofer();
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
                                closeModal('modal_dialog_add_chofer')
                                tablachofer();
                                iniciarcampos();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarchofer').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarChoferEdit() {
    if($('#cenpoeditc').val()==''){
        $('#idcentpeditc').val(0);
    }
    if(validarFormularioChoferEdit()===0){
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
                var idperson = $('#idpersoneditc').val();
                var tipdoc = $('#tipdoceditc').val();
                var ndoc = $('#dnieditc').val();
                var appaterno = $('#appaternoeditc').val();
                var apmaterno = $('#apmaternoeditc').val();
                var pnombre = $('#pnombreeditc').val();
                var snombre = $('#snombreeditc').val();
                var fecnac = $('#fecnaceditc').val();
                var telefono = $('#telefoeditc').val();
                var iddist = $('#diseditc').val();
                var idcento = $('#idcentpeditc').val();
                var referenc = $('#refeditc').val();
                var direcc = $('#direditc').val();
                var tipos = $('#tipsegeditc').val();
                var siti=$('#sitic').val();


                var idpers = $('#idpersonaleditc').val();
                var idofent = $('#idoficenteditc').val();
                var idtipp = $('#tipperseditc').val();
                var coleg = $('#colegeditc').val();
                var espec = $('#especeditc').val();
                $.ajax({
                    url: '/referencia/editPers',
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
                        idpers:idpers,
                        siti:siti,

                        idoe:idofent,
                        idtipp:idtipp,
                        coleg: coleg,
                        espec: espec,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Chofer Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_edit_chofer')
                                tablachofer();
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
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_edit_chofer')
                                tablachofer();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarchoferedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}

function validarFormularioChofer() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#tipdocc').val() !== '0') {
        validarCaja('tipdocc', 'validtipodocc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + 'Seleccione Tipo documento';
        validarCaja('tipdocc', 'validtipodocc', text, 0);
    }
    if ($('#dnic').val() !== '') {
        validarCaja('dnic', 'validDnic', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese N° documento';
        validarCaja('dnic', 'validDnic', text, 0);
    }
    if ($('#appaternoc').val() !== '') {
        validarCaja('appaternoc', 'valappaternoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese apellido paterno';
        validarCaja('appaternoc', 'valappaternoc', text, 0);
    }
    if ($('#apmaternoc').val() !== '') {
        validarCaja('apmaternoc', 'valapmaternoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese apellido materno';
        validarCaja('apmaternoc', 'valapmaternoc', text, 0);
    }
    if ($('#pnombrec').val() !== '') {
        validarCaja('pnombrec', 'valpnombrec', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese primer nombre';
        validarCaja('pnombrec', 'valpnombrec', text, 0);
    }
    if ($('#fecnacc').val() !== '') {
        validarCaja('fecnacc', 'valfecnacc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese fecha de nacimiento';
        validarCaja('fecnacc', 'valfecnacc', text, 0);
    }
    /*if ($('#telefoc').val() !== '') {
        validarCaja('telefoc', 'valtelefoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese telefono';
        validarCaja('telefoc', 'valtelefoc', text, 0);
    }*/
    if ($('#deparc').val() !== '0') {
        validarCaja('deparc', 'valdeparc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Departamento';
        validarCaja('deparc', 'valdeparc', text, 0);
    }
    if ($('#provc').val() !== '0') {
        validarCaja('provc', 'valprovc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Provincia';
        validarCaja('provc', 'valprovc', text, 0);
    }
    if ($('#disc').val() !== '0') {
        validarCaja('disc', 'valdisc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Distrito';
        validarCaja('disc', 'valdisc', text, 0);
    }
    if ($('#descentc').val() !== '') {
        validarCaja('descentc', 'validardescentc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la Oficina Entidad';
        validarCaja('descentc', 'validardescentc', text, 0);
    }
    if ($('#tippersc').val() !== '0') {
        validarCaja('tippersc', 'validartippersc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el tipo de personal';
        validarCaja('tippersc', 'validartippersc', text, 0);
    }
    return cont;
}

function validarFormularioChoferEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#dnieditc').val() !== '') {
        validarCaja('dnieditc', 'validDnieditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Persona';
        validarCaja('dnieditc', 'validDnieditc', text, 0);
    }
    if ($('#appaternoeditc').val() !== '') {
        validarCaja('appaternoeditc', 'valappaternoeditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese apellido paterno';
        validarCaja('appaternoeditc', 'valappaternoeditc', text, 0);
    }
    if ($('#apmaternoeditc').val() !== '') {
        validarCaja('apmaternoeditc', 'valapmaternoeditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese apellido materno';
        validarCaja('apmaternoeditc', 'valapmaternoeditc', text, 0);
    }
    if ($('#pnombreeditc').val() !== '') {
        validarCaja('pnombreeditc', 'valpnombreeditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese primer nombre';
        validarCaja('pnombreeditc', 'valpnombreeditc', text, 0);
    }
    if ($('#fecnaceditc').val() !== '') {
        validarCaja('fecnaceditc', 'valfecnaceditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese fecha de nacimiento';
        validarCaja('fecnaceditc', 'valfecnaceditc', text, 0);
    }
    /*if ($('#telefoeditc').val() !== '') {
        validarCaja('telefoeditc', 'valtelefoeditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese telefono';
        validarCaja('telefoeditc', 'valtelefoeditc', text, 0);
    }*/
    if ($('#depareditc').val() !== '0') {
        validarCaja('depareditc', 'valdepareditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Departamento';
        validarCaja('depareditc', 'valdepareditc', text, 0);
    }
    if ($('#proveditc').val() !== '0') {
        validarCaja('proveditc', 'valproveditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Provincia';
        validarCaja('proveditc', 'valproveditc', text, 0);
    }
    if ($('#diseditc').val() !== '0') {
        validarCaja('diceditc', 'valdiseditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Distrito';
        validarCaja('diseditc', 'valdiseditc', text, 0);
    }
    if ($('#idoficenteditc').val() !== '') {
        validarCaja('descenteditc', 'validardescenteditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la oficina entidad';
        validarCaja('descenteditc', 'validardescenteditc', text, 0);
    }
    if ($('#tipperseditc').val() !== '0') {
        validarCaja('tipperseditc', 'validartipperseditc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el tipo de personal';
        validarCaja('tipperseditc', 'validartipperseditc', text, 0);
    }
    return cont;
}
