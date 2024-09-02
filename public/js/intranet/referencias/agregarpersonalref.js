var idofic=0;
var exist=0;
var idsm=0;
var sit=0;
var camposadd = [];
var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
$(document).ready(function (){
    tabla_Personal();
});
function camposPersAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "tipdoc";
    tablacampos[1] = "validtipodoc";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dni";
    tablacampos[1] = "validDni";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
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
    tablacampos[0] = "cenpo";
    tablacampos[1] = "cenpoval";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "ref";
    tablacampos[1] = "valref";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dir";
    tablacampos[1] = "dirval";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "tippers";
    tablacampos[1] = "validartippers";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "coleg";
    tablacampos[1] = "validarcoleg";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "espec";
    tablacampos[1] = "validarespec";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "descent";
    tablacampos[1] = "validardescent";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarpers').prop("disabled", false);
}
function camposPersEdit() {
    var tablacampos = new Array();
    tablacampos[0] = "tipdocedit";
    tablacampos[1] = "validtipodocedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dniedit";
    tablacampos[1] = "validDniedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "appaternoedit";
    tablacampos[1] = "valappaternoedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "apmaternoedit";
    tablacampos[1] = "valapmaternoedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "pnombreedit";
    tablacampos[1] = "valpnombreedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "snombreedit";
    tablacampos[1] = "valsnombreedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "fecnacedit";
    tablacampos[1] = "valfecnacedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "telefoedit";
    tablacampos[1] = "valtelefoedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "deparedit";
    tablacampos[1] = "valdeparedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "provedit";
    tablacampos[1] = "valprovedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "disedit";
    tablacampos[1] = "valdisedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "cenpoedit";
    tablacampos[1] = "cenpovaledit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "refedit";
    tablacampos[1] = "valrefedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "diredit";
    tablacampos[1] = "dirvaledit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "tippersedit";
    tablacampos[1] = "validartippersedit";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "colegedit";
    tablacampos[1] = "validarcolegedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "especedit";
    tablacampos[1] = "validarespecedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "descentedit";
    tablacampos[1] = "validardescentedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarpersedit').prop("disabled", false);
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
$("#nueperm").on('change', function () {
    $('#descent').prop("disabled", false);
    $('#descent').val('');
    $('#descent').focus();

});
$("#nuepermedit").on('change', function () {
    $('#descentedit').prop("disabled", false);
    $('#descentedit').val('');
    $('#descentedit').focus();

});
$('#descent').typeahead({

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
        var pro = $('#codofic');
        var fin = $('#nombofic');

        var idfin = $('#idoficent');
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
$('#descentedit').typeahead({

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
        var pro = $('#codoficedit');
        var fin = $('#nomboficedit');

        var idfin = $('#idoficentedit');
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

$('#persrefedit').typeahead({

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

        var idfin = $('#idpersedit');
        idfin.val('');
        idfin.val(item.id);
        valPersonaEdit(item.id,0);
        return item;
    },
});
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
function cargaroficinas(){
    var url = "/referencia/getOficAct";
    var perm = $('#nueperm').html('');
    var htmla = '', html = '';
    var perm1 = $('#adduser').html('');
    var htmla1 = '', html1 = '';
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
                                '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nueperm' + encarg[i]['oId'] + '" value="" onchange="cargarofent(' + encarg[i]['oId'] + ')">' +
                                '                        <label class="form-check-label" for="nueperm' + encarg[i]['oId'] + '">' + encarg[i]['oNombre']  + '</label>\n' +
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
    var perm = $('#nuepermedit').html('');
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
                                '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="nuepermedit' + ofic[i]['oId'] + '" value="" onchange="cargarofent(' + ofic[i]['oId'] + ')">' +
                                '                        <label class="form-check-label" for="nuepermedit' + ofic[i]['oId'] + '">' + ofic[i]['oNombre']  + '</label>\n' +
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
$('#estabrefedit').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/getEstablecimientoFull",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idEess,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idess = $('#idestabedit');
        idess.val('');
        idess.val(item.id);
        valPersonaEdit(0,item.id);
        return item;
    }
});
function cargarofent(id) {
    idofic=id;
}
$('#addPersref').on('click',function(){
    window.event.preventDefault();
    $('#modal_dialog_add_persref').modal('show');
    CargarTipPers(0);
    cargaroficinas();
    camposPersAdd();
    getFechaUt('fecnac');
    departamento('depar',0);
    $('#dni').prop('disabled',true);
    $('#prov').prop('disabled',true);
    $('#dis').prop('disabled',true);
    $('#descent').prop('disabled',true);
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
        dni.focus();
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
    distrito('dis',this.value, 0);
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
function valPersona(idper,ideess) {
    var idperson=$('#idperson').val();
    var idofent=$('#idoficent').val();
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
                                            title: 'El personal ya esta asignado a esa oficina entidad, por favor restaure',
                                            showConfirmButton: false,
                                            timer: 4000
                                        });
                                        validarCaja('persref', 'validarpersref', 'El personal ya esta asignado a esa oficina entidad', 0);
                                        validarCaja('descent', 'validardescent', 'La oficina Entidad ya esta asignado a ese personal', 0);
                                        i=result.length;
                                        $('#enviarpers').prop("disabled", true);
                                    }else{
                                        validarCaja('persref', 'validarpersref', 'Persona Correcta', 1);
                                        if(idofent!==0){
                                            validarCaja('descent', 'validardescent', 'Oficina Entidad Correcto', 1);
                                        }
                                        $('#enviarpers').prop("disabled", false);
                                    }
                                }else{
                                    validarCaja('persref', 'validarpersref', 'El personal ya esta asignado a una oficina entidad', 0);
                                    if(idofent!==0){
                                        validarCaja('descent', 'validardescent', 'Oficina Entidad Correcto', 1);
                                    }
                                    $('#enviarpers').prop("disabled", true);
                                }
                            }
                        }
                        else {
                            validarCaja('persref', 'validarpersref', 'Persona Correcta', 1);
                            if(idofent!==0){
                                validarCaja('descent', 'validardescent', 'Oficina Entidad Correcto', 1);
                            }
                            $('#enviarpers').prop("disabled", false);
                        }
                    }

                }, beforeSend() {
                    $('#enviarpers').prop("disabled", true);
                }

            });
    }
}

function valPersonaEdit(idper,ideess) {
    var idperson=$('#idpersonedit').val();
    var idperact=$('#idpersactedit').val();
    var idofent=$('#idoficentedit').val();
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
                                                title: 'El personal ya esta asignado a ese establecimiento, por favor restaure',
                                                showConfirmButton: false,
                                                timer: 4000
                                            });
                                            validarCaja('persrefedit', 'validarpersrefedit', 'El personal ya esta asignado a esa oficina entidad', 0);
                                            validarCaja('descentedit', 'validardescentedit', 'La oficina entidad ya esta asignado a ese personal', 0);
                                            i=result.length;
                                            $('#enviarpersedit').prop("disabled", true);
                                        }else{
                                            validarCaja('persrefedit', 'validarpersrefedit', 'Persona Correcta', 1);
                                            if(idofent!==''){
                                                validarCaja('descentedit', 'validardescentedit', 'Oficina entidad Correcto', 1);
                                            }
                                            $('#enviarpersedit').prop("disabled", false);
                                        }
                                    }else{
                                        validarCaja('persrefedit', 'validarpersrefedit', 'El personal ya esta asignado a una oficina entidad', 0);
                                        if(idofent!==0){
                                            validarCaja('descentedit', 'validardescentedit', 'Oficina entidad Correcto', 1);
                                        }
                                    }
                                }
                            }else{
                                validarCaja('persrefedit', 'validarpersrefedit', 'Persona Correcta', 1);
                                if(idofent!==0){
                                    validarCaja('descentedit', 'validardescentedit', 'Oficina entidad Correcto', 1);
                                }
                                $('#enviarpersedit').prop("disabled", false);
                            }
                        }
                        else {
                            validarCaja('persrefedit', 'validarpersrefedit', 'Persona Correcta', 1);
                            if(idofent!==0){
                                validarCaja('descentedit', 'validardescentedit', 'Oficina entidad Correcto', 1);
                            }
                            $('#enviarpersedit').prop("disabled", false);
                        }
                    }

                }, beforeSend() {
                    $('#enviarpersedit').prop("disabled", true);
                }

            });
    }
}
function tabla_Personal(){
    $('#tabla_Persref').DataTable({
        ajax: '/referencia/getPers',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        orderCellsTop: true,
        processing: true,
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
            {"targets": 5, "width": "5%", "className": "text-left"},
            {"targets": 6, "width": "5%", "className": "text-left"},
            {"targets": 7, "width": "5%", "className": "text-center"},
            {"targets": 8, "width": "5%", "className": "text-center"},
            {"targets": 9, "width": "5%", "className": "text-center"},
            {"targets": 10, "width": "5%", "className": "text-center"},
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
            {data: 'pColegiatura', name: 'pColegiatura'},
            {data: 'pEspecialidad', name: 'pEspecialidad'},
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
                            '<a href="#"  onclick="abrilModalEdPers(' + row.numeroDoc + ')" TITLE="Editar Personal " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Personal" onclick="eliminarPersonal(' + row.pId +','+row.idPersona +','+0+  ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Personal"  onclick="eliminarPersonal(' + row.pId +','+row.idPersona+','+1+ ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function abrilModalEdPers(idper) {
    window.event.preventDefault();
    $('#modal_dialog_edit_persref').modal('show');
    cargaroficinasedit(0);
    obtenerEditarPersonal(idper);
    camposPersEdit();
    getFechaUt('fecnacedit');
}
function obtenerEditarPersonal(dni) {
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
                        $('#idpersonaledit').val(personal['pId']);
                        $('#idpersonedit').val(personal['idPersona']);
                        $('#idpersactedit').val(personal['idPersona']);
                        $('#persrefedit').val(personal['person']);
                        $('#colegedit').val(personal['pColegiatura']);
                        $('#especedit').val(personal['pEspecialidad']);
                        $('#idoficentedit').val(personal['oEId']);
                        $('#nuepermedit'+personal['oId']).prop("checked", true);
                        CargarTipPersEdit(personal['tPId']);
                        cargarofent(personal['oId']);
                        switch (personal['oId']){
                            case 4:$('#descentedit').val(personal['Descripcion']);
                                break;
                            case 5:$('#descentedit').val(personal['nombre']);
                                break;
                            case 6:$('#descentedit').val(personal['descripcion']);
                                break;
                            case 7:$('#descentedit').val(personal['descripcionEjecutora']);
                                break;
                            case 8:$('#descentedit').val(personal['eDesc']);
                                break;
                        }
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
                    }
                    $('#persrefedit').focus();
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
                    $('#enviarpers').prop("disabled", true);
                }

            });
}
function validDni() {
    if(validarDniExpres('enviarpers','dni','tipdoc','validDni')===0){
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
                        var personal = data['personal'];
                        var person = data['person'];

                        if (personal!==null || person!==null  ) {
                            if(personal!==null){
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
                                $('#coleg').val(personal['pColegiatura']).prop("disabled", true);
                                $('#espec').val(personal['pEspecialidad']).prop("disabled", true);
                                $('#nueperm'+personal['oId']).prop("checked", true);
                                CargarTipPers(personal['tPId']);
                                $('#tippers').prop("disabled",true);
                                cargarofent(personal['oId']);
                                if(person['dist']==null){
                                    completarDis(person['idDistrito']);
                                }else{
                                    completarDis(person['dist']);
                                }
                                switch (personal['oId']){
                                    case 4:$('#descent').val(personal['Descripcion']);
                                        //getidpermiso(usof[0]['id'],18);
                                        $('#idofiperm').val(2);
                                        break;
                                    case 5:$('#descent').val(personal['nombre']);
                                        //getidpermiso(usof[0]['id'],18);
                                        $('#idofiperm').val(2);
                                        break;
                                    case 6:$('#descent').val(personal['descripcion']);
                                        //getidpermiso(usof[0]['id'],17);
                                        $('#idofiperm').val(1);
                                        break;
                                    case 7:$('#descent').val(personal['descripcionEjecutora']);
                                        //getidpermiso(usof[0]['id'],18);
                                        $('#idofiperm').val(2);
                                        break;
                                }
                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    type: 'warning',
                                    title: 'El personal ya esta registrado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#enviarpers').prop("disabled", true);
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
                                desbloquear();
                                $('#tippers').focus();
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
function eliminarPersonal(idper,idperson,lug){
    if(lug==1){
        validarelimicion(idperson);
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
                                tabla_Personal();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Personal eliminado/restaurado correctamente!',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                            } else {
                                tabla_Personal();
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
                    text: 'El Personal esta activo en otro oficina entidad..',
                    showConfirmButton: false,
                    timer: 5000
                });
                tabla_Personal();
            }
        }
    })
}
function enviarPers() {
    if(validarFormularioPers()===0){
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
                var idofent = $('#idoficent').val();
                var idtipp = $('#tippers').val();
                var coleg = $('#coleg').val();
                var espec = $('#espec').val();

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
                                    title: 'Registro de Personal exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_persref');
                                tabla_Personal();
                                camposadd = [];
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
                                closeModal('modal_dialog_add_persref');
                                tabla_Personal();
                                camposadd = [];

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarpers').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}

function enviarPersEdit() {
    if($('#cenpoedit').val()==''){
        $('#idcentpedit').val(0);
    }
    if(validarFormularioPersEdit()===0){
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
                var siti=$('#siti').val();


                var idpers = $('#idpersonaledit').val();
                var idofent = $('#idoficentedit').val();
                var idtipp = $('#tippersedit').val();
                var coleg = $('#colegedit').val();
                var espec = $('#especedit').val();
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
                                    title: 'Personal Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                tabla_Personal();
                                closeModal('modal_dialog_edit_persref');
                                limpiarCaja(camposadd);
                                camposadd = [];
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
                                tabla_Personal();
                                closeModal('modal_dialog_edit_persref');
                                limpiarCaja(camposadd);
                                camposadd = [];
                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarpersedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}

function validarFormularioPers() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#idpers').val() !== '') {
        validarCaja('persref', 'validarpersref', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Persona';
        validarCaja('persref', 'validarpersref', text, 0);
    }
    if ($('#descent').val() !== '') {
        validarCaja('descent', 'validardescent', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la Oficina Entidad';
        validarCaja('descent', 'validardescent', text, 0);
    }
    if ($('#tippers').val() !== '0') {
        validarCaja('tippers', 'validartippers', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el tipo de personal';
        validarCaja('tippers', 'validartippers', text, 0);
    }
    return cont;
}

function validarFormularioPersEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#idpersedit').val() !== '') {
        validarCaja('persrefedit', 'validarpersrefedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Persona';
        validarCaja('persrefedit', 'validarpersrefedit', text, 0);
    }
    if ($('#idoficentedit').val() !== '') {
        validarCaja('descentedit', 'validardescentedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la oficina entidad';
        validarCaja('descentedit', 'validardescentedit', text, 0);
    }
    if ($('#tippersedit').val() !== '0') {
        validarCaja('tippersedit', 'validartippersedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el tipo de personal';
        validarCaja('tippersedit', 'validartippersedit', text, 0);
    }
    return cont;
}
