var camposadd = [];
var camposedd = [];
$('#addva').on('click', function () {
    //  window.event.preventDefault();
    camposMetAdd();
   limpiarCaja(camposadd);
    $('#modal_dialog_add_va').modal({show: true, backdrop: 'static', keyboard: false});
    OrdenCompCom('ordcvale', 0);
    Grifos('grifo', 0);
    $('#fecent').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });

});
$('#ordcvale').on('change', function () {
    ItemsComb('item', this.value, 0,'nfact','grifo');
    $('#item').focus();
});
$('#item').on('change', function () {
    MetasComb('meta', this.value, 0);
    $('#meta').focus();
});
$('#meta').on('change', function () {
    SaldoComb('stock', this.value, 'idcombus', 'progp');
    $('#placa').focus();
});
$('#ordcvaleedit').on('change', function () {
    ItemsComb('itemedit', this.value, 0,'nfactedit','grifoedit');
    $('#itemedit').focus();
});
$('#itemedit').on('change', function () {
    MetasComb('metaedit', this.value, 0);
    $('#metaedit').focus();
});
$('#metaedit').on('change', function () {
    SaldoCombEdit('stockedit', this.value, 'idcombusedit', 'progpedit',1);
    $('#placaedit').focus();
});

function descargarVale(id) {
    window.location = '/combustible/pdfvaleconsumo/' + id;
    return true;
}

function OrdenCompCom(val, idoc) {
    var url = "/combustible/getOrdCCombus";
    var select = $('#' + val).html('');
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
                    if (data[i]['oCId'].toString() === idoc.toString()) {
                        htmla = '<option value="' + data[i]['oCId'] + '" selected>' + data[i]['oNumOC'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + data[i]['oCId'] + '">' + data[i]['oNumOC'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function ItemsComb(val, idoc, idocc,nfact,grif) {
    var url = "/combustible/getItemsVal/" + idoc;
    var select = $('#' + val).html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var ordcc = data['ordcomb'];
                var htmla = '';
                for (var i = 0; i < ordcc.length; i++) {
                    if (ordcc[i]['cOTId'].toString() === idocc.toString()) {
                        htmla = '<option value="' + ordcc[i]['cOTId'] + '" selected>' + ordcc[i]['tCDesc'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + ordcc[i]['cOTId'] + '">' + ordcc[i]['tCDesc'] + '</option>';
                        html = html + htmla;
                    }
                }
                $('#'+nfact).val(ordcc[0]['oCNumFact']);
                $('#'+grif).val(ordcc[0]['grif']);
                select.append(html);
            }

        });
}

function camposMetAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "ordcvale";
    tablacampos[1] = "valordcvale";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "item";
    tablacampos[1] = "valitem";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "meta";
    tablacampos[1] = "valmeta";
    tablacampos[2] = 0;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "stock";
    tablacampos[1] = "valstock";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "progp";
    tablacampos[1] = "valprogp";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "placa";
    tablacampos[1] = "valplaca";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "esspert";
    tablacampos[1] = "valesspert";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "det";
    tablacampos[1] = "valdet";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "cilind";
    tablacampos[1] = "valcilind";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "consum";
    tablacampos[1] = "valconsum";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "dnic";
    tablacampos[1] = "valdnic";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "nombresc";
    tablacampos[1] = "valnombresc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "apellidosc";
    tablacampos[1] = "valapellidosc";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "eess";
    tablacampos[1] = "valeess";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "nfact";
    tablacampos[1] = "valnfact";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "dauto";
    tablacampos[1] = "valdauto";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "fecent";
    tablacampos[1] = "valfecent";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "cntkm";
    tablacampos[1] = "valcntkm";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "galmin";
    tablacampos[1] = "valgalmin";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "grifo";
    tablacampos[1] = "valgrifo";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "activ";
    tablacampos[1] = "valactiv";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos=[];
    tablacampos[0] = "cntgal";
    tablacampos[1] = "valcntgal";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarvale').prop("disabled", false);
}

$('#enviarvale').on('click', function () {
    event.preventDefault();
    if (validarFormulario() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregará un nuevo vale de consumo',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                var idchof = $('#idchof').val();
                var idcombus = $('#idcombus').val();
                var idvehi = $('#idvehi').val();

                var dauto = $('#dauto').val();
                var fecent = $('#fecent').val();
                var cntkm = $('#cntkm').val();
                var cntgal = $('#cntgal').val();
                var activ = $('#activ').val();

                $.ajax({
                    url: '/combustible/storeVale',
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        idchof: idchof,
                        idcombus: idcombus,
                        idvehi: idvehi,
                        dauto: dauto,
                        fecent: fecent,
                        cntkm: cntkm,
                        cntgal: cntgal,
                        activ: activ,

                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                if (descargarVale(data['id'])) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de vale de consumo exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    closeModal('modal_dialog_add_va');
                                    limpiarCaja(camposadd);
                                    vales();

                                }
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
                                closeModal('modal_dialog_add_va');
                                limpiarCaja(camposadd);
                                vales();


                            }
                        },
                    beforeSend: function () {
                        $('#enviarvale').prop("disabled", true);
                    }
                });

            }
        });
    } else {
        operacionSubsanar();
    }
});
$('#enviareditvale').on('click', function (){
    if (validarFormularioEdit() === 0){
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
                var idcons = $('#idvalconsedit').val();
                var idchof = $('#idchofedit').val();
                var idcombus = $('#idcombusedit').val();
                var idvehi = $('#idvehiedit').val();

                var dauto = $('#dautoedit').val();
                var fecent = $('#fecentedit').val();
                var cntkm = $('#cntkmedit').val();
                var cntgal = $('#cntgaledit').val();
                var activ = $('#activedit').val();

                $.ajax({
                    url: '/combustible/editConsu',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idcons: idcons,
                        idchof: idchof,
                        idcombus: idcombus,
                        idvehi: idvehi,
                        dauto: dauto,
                        fecent: fecent,
                        cntkm: cntkm,
                        cntgal: cntgal,
                        activ: activ,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Vale de consumo Editado Exitosamente',
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
                        $('#enviareditvale').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
});

function MetasComb(val, idoc, idocc) {
    var url = "/combustible/getMEGVal/" + idoc;
    var select = $('#' + val).html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var megval = data['megval'];
                var htmla = '';
                for (var i = 0; i < megval.length; i++) {
                    if (megval[i]['cMId'].toString() === idocc.toString()) {
                        htmla = '<option value="' + megval[i]['cMId'] + '" selected>' + megval[i]['mCod'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + megval[i]['cMId'] + '">' + megval[i]['mCod'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function Grifos(val, idgf) {
    var url = "/combustible/getGrifAct";
    var select = $('#' + val).html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var grifos = data['grif'];
                var htmla = '';
                for (var i = 0; i < grifos.length; i++) {
                    if (grifos[i]['gId'].toString() === idgf.toString()) {
                        htmla = '<option value="' + grifos[i]['gId'] + '" selected>' + grifos[i]['gRuc'] + ' | ' + grifos[i]['gDesc'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + grifos[i]['gId'] + '">' + grifos[i]['gRuc'] + ' | ' + grifos[i]['gDesc'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function SaldoComb(val, idoc, valcb, valpp) {
    var url = "/combustible/getSaldCom/" + idoc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var saldoc = data['saldoc'];
                if(saldoc.length>1){
                    for(var i=0;i<saldoc.length;i++){
                        if(saldoc[i]['sald']!=null){
                            $('#'+val).val(saldoc[i]['sald']);
                            $('#' + valpp).val(saldoc[i]['pPDesc']);
                            $('#' + valcb).val(saldoc[i]['cMId']);
                        }
                    }
                }else{
                    if(saldoc[0]['sald']!=null){
                        $('#'+val).val(saldoc[0]['sald']);
                        $('#' + valpp).val(saldoc[0]['pPDesc']);
                        $('#' + valcb).val(saldoc[0]['cMId']);
                    }else{
                        $('#' + val).val(saldoc[0]['cStock']);
                        $('#' + valpp).val(saldoc[0]['pPDesc']);
                        $('#' + valcb).val(saldoc[0]['cMId']);
                    }
                }
            }

        });
}
function SaldoCombEdit(val, idoc, valcb, valpp,lg) {
    var url = "/combustible/getSaldCom/" + idoc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var saldoc = data['saldoc'];
                if(saldoc[0]['sald']!=null){
                    if(lg===0){
                        $('#'+val).val(parseFloat(saldoc[0]['sald'])+parseFloat($('#cantgedit').val()));
                    }else{
                        if($('#idcomedit').val()===idoc){
                            $('#'+val).val(parseFloat(saldoc[0]['sald'])+parseFloat($('#cantgedit').val()));
                        }else{
                            $('#'+val).val(parseFloat(saldoc[0]['sald']));
                        }
                    }

                }else{
                    $('#' + val).val(saldoc[0]['cStock']);

                }
                $('#' + valpp).val(saldoc[0]['pPDesc']);
                $('#' + valcb).val(saldoc[0]['cMId']);
            }

        });
}
function validCant() {
    var cant = parseFloat($('#cntgal').val());
    var saldo = parseFloat($('#stock').val());
    if (cant > saldo) {
        validarCaja('cntgal', 'valcntgal', 'Ingrese una cantidad menor o igual al stock', 0);
        $('#cntgal').val('');
        $('#cntgal').focus();
        $('#enviarvale').prop("disabled", true);
    } else {
        $('#enviarvale').focus();
        validarCaja('cntgal', 'valcntgal', 'Correcto', 1);
        $('#enviarvale').prop("disabled", false);
    }
}
function validCantEdit() {
    var cant = parseFloat($('#cntgaledit').val());
    var saldo = parseFloat($('#stockedit').val());
    if (cant > saldo) {
        validarCaja('cntgaledit', 'valcntgaledit', 'Ingrese una cantidad menor o igual al stock', 0);
        $('#cntgaledit').val('');
        $('#cntgaledit').focus();
        $('#enviareditvale').prop("disabled", true);
    } else {
        $('#enviareditvale').focus();
        validarCaja('cntgaledit', 'valcntgaledit', 'Correcto', 1);
        $('#enviareditvale').prop("disabled", false);
    }
}
function valCantKm() {
    var galmin= parseFloat($('#cntkm').val())* parseFloat($('#consum').val());
    $('#galmin').val(galmin);

}
function valCantKmEdit() {
    var galmin= parseFloat($('#cntkmedit').val())* parseFloat($('#consumedit').val());
    $('#galminedit').val(galmin);

}

$(document).ready(function () {
    $('.modal-backdrop').remove();
    vales();
    if(parseInt($('#idvi').val())===1){
        camposMetAdd();
        limpiarCaja(camposadd);
        $('#modal_dialog_add_va').modal({show: true, backdrop: 'static', keyboard: false});
        OrdenCompCom('ordcvale', 0);
        Grifos('grifo', 0);
        $('#fecent').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true
        });
    }
});

function valChofDni() {
    var dni = $('#dnic').val();
    var url = "/referencia/getChofDni/" + dni;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var chofer = data['chofer'];
                    if (chofer.length > 0) {
                        $('#idchof').val(chofer[0]['pId']);
                        $('#nombresc').val(chofer[0]['nombre']).prop("disabled", true);
                        $('#apellidosc').val(chofer[0]['apell']).prop("disabled", true);
                        $('#eess').val(chofer[0]['eper']);

                    } else {
                        $('#idchof').val("");
                        $('#nombresc').val("").prop("disabled", true);
                        $('#apellidosc').val("").prop("disabled", true);
                        $('#eess').val("");
                        /*Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Chofer No Registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });*/
                        Swal.fire({
                            title: 'Chofer no Registrado',
                            text: 'Desea registrarlo?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, acepto',
                            cancelButtonText: 'no, cancelar'
                        }).then((result) => {
                            if (result.value) {
                         redirect('/referencia/chofer');
                            }
                        });
                    }
                } else {

                }
            }, beforeSend: function () {
            },

        });
}
function valChofDniEdit() {
    var dni = $('#dnicedit').val();
    var url = "/referencia/getChofDni/" + dni;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var chofer = data['chofer'];
                    if (chofer.length > 0) {
                        $('#idchofedit').val(chofer[0]['pId']);
                        $('#nombrescedit').val(chofer[0]['nombre']).prop("disabled", true);
                        $('#apellidoscedit').val(chofer[0]['apell']).prop("disabled", true);
                        $('#eessedit').val(chofer[0]['eper']);
                    } else {
                        $('#idchofedit').val("");
                        $('#nombrescedit').val("").prop("disabled", true);
                        $('#apellidoscedit').val("").prop("disabled", true);
                        $('#eessedit').val("");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Chofer No Registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                } else {

                }
            }, beforeSend: function () {
            },

        });
}

function valVehiPlaca() {
    var placa = $('#placa').val();
    var url = "/combustible/getVehPla/" + placa;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var placa = data['veh'];
                    if (placa.length > 0) {
                        $('#idvehi').val(placa[0]['vId']);
                        $('#det').val(placa[0]['info']).prop("disabled", true);
                        $('#consum').val(placa[0]['vConKil']).prop("disabled", true);
                        $('#esspert').val(placa[0]['eper']);

                    } else {
                        $('#idchof').val(0);
                        $('#esspert').val("");
                        $('#cilind').val("");
                        $('#consum').val("");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Vehiculo No Registrado/Activo',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                } else {

                }
            }, beforeSend: function () {
            },

        });
}
function valVehiPlacaEdit() {
    var placa = $('#placaedit').val();
    var url = "/combustible/getVehPla/" + placa;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var placa = data['veh'];
                    if (placa.length > 0) {
                        $('#idvehiedit').val(placa[0]['vId']);
                        $('#cilindedit').val(placa[0]['mCilindra']).prop("disabled", true);
                        $('#consumedit').val(placa[0]['vConKil']).prop("disabled", true);
                        $('#infoedit').val(placa[0]['info']);
                        $('#esspertedit').val(placa[0]['eper']);

                    } else {
                        $('#idchofedit').val(0);
                        $('#esspertedit').val("");
                        $('#infoedit').val("");
                        $('#consumedit').val("");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Vehiculo No Registrado/Activo',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                } else {

                }
            }, beforeSend: function () {
            },

        });
}

var datePickers = function () {

    $('#edfecen').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,

    });
};

function vales() {
    $('#tabla_vale').DataTable({
        ajax: '/combustible/getConsms',
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
            {"targets": 0, "width": "5%", "className": "text-left"},
            {"targets": 1, "width": "5%", "className": "text-center"},
            {"targets": 3, "width": "5%", "className": "text-center"},
            {"targets": 5, "width": "6%", "className": "text-center"},
            {"targets": 6, "width": "15%", "className": "text-left"},
            {"targets": 7, "width": "6%", "className": "text-center"},
            {"targets": 8, "width": "6%", "className": "text-center"},
            {"targets": 9, "width": "5%", "className": "text-center"},
            {"targets": 10, "width": "10%", "className": "text-center"},
            {"targets": 11, "width": "5%", "className": "text-center"},
            {"targets": 12, "width": "15%", "className": "text-center"},
        ],
        columns: [

            {data: 'codcons', name: 'codcons'},
            {data: 'oNumOC', name: 'oNumOC'},
            {data: 'pPDesc', name: 'pPDesc'},
            {data: 'oCNumFact', name: 'oCNumFact'},
            {data: 'gDesc', name: 'gDesc'},
            {data: 'vPlaca', name: 'vPlaca'},
            {data: 'chofer', name: 'chofer'},
            {
                data: function (row){
                    return '<a href="javascript:" data-dismiss="modal"  onclick="verActividad(' + row.cId +')"><span class="text-success">Ver</span></a>';
                }
            },
            //{data: 'cActiv', name: 'cActiv'},
            {data: 'tCDesc', name: 'tCDesc'},
            {data: 'cCantGal', name: 'cCantGal'},
            {data: 'cFecEnt', name: 'cFecEnt'},
            {
                data: function (row) {
                    return parseInt(row.cEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.cEst) === 1 && parseInt(row.cEst) === 1) {
                        if (parseInt(row.ed) === 1)
                            return '<tr >\n' +
                                '<a href="combustible/pdfvaleconsumo/' + row.cId + '" TITLE="imprimir Vale" >\n' +
                                '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-print"> </i></a>\n' +
                                '<a href="#"  onclick="abrilModalEdVale(' + row.cId + ')" TITLE="Editar Vale de consumo " >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar Vale de consumo" onclick="eliminarValeCons(' + row.cId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                            else
                            return '<tr >\n' +
                                '<a href="combustible/pdfvaleconsumo/' + row.cId + '" TITLE="imprimir Vale" >\n' +
                                '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-print"> </i></a>\n' +
                                '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Vale de consumo"  onclick="eliminarValeCons(' + row.cId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '<a href="combustible/pdfvaleconsumo/' + row.cId + '" TITLE="imprimir Vale" >\n' +
                            '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-print"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function verActividad(idc) {
    var url = "/combustible/getValConsEdit/" + idc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var consu = data['valcomb'];
                    Swal.fire({
                        title: 'Ver Actividad',
                        text: consu[0]['cActiv'],
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Cerrar',
                        //cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.value) {
                        }
                    });

                }
                else {

                }

            }

        });


}
function abrilModalEdVale(idc) {
    window.event.preventDefault();
    $('#modal_dialog_edit_va').modal('show');

    //cargaroficinasedit(0);
    obtenerEditValCons(idc);
    getFechaUt('fecentedit');
}
function obtenerEditValCons(idc) {
    var url = "/combustible/getValConsEdit/" + idc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var consu = data['valcomb'];
                    $('#idvalconsedit').val(consu[0]['cId']);
                    $('#idcombusedit').val(consu[0]['cMId']);
                    $('#idcomedit').val(consu[0]['cMId']);
                    $('#cantgedit').val(consu[0]['cCantGal']);
                    $('#idvehiedit').val(consu[0]['vId']);
                    $('#idchofedit').val(consu[0]['pId']);
                    $('#progpedit').val(consu[0]['pPDesc']);
                    OrdenCompCom('ordcvaleedit', consu[0]['oCId']);
                    ItemsComb('itemedit', consu[0]['oCId'], consu[0]['cOTId']);
                    MetasComb('metaedit', consu[0]['cOTId'], consu[0]['cMId']);
                    SaldoCombEdit('stockedit', consu[0]['cMId'], 'idcombusedit', 'progpedit',0);


                    $('#placaedit').val(consu[0]['vPlaca']);
                    $('#infoedit').val(consu[0]['info']);
                    $('#consumedit').val(consu[0]['vConKil']);
                    $('#esspertedit').val(consu[0]['entv']);

                    $('#dnicedit').val(consu[0]['numeroDoc']);
                    $('#nombrescedit').val(consu[0]['nombres']);
                    $('#apellidoscedit').val(consu[0]['apellidos']);
                    $('#eessedit').val(consu[0]['entp']);
                    $('#nfactedit').val(consu[0]['oCNumFact']);
                    $('#dautoedit').val(consu[0]['cDocAuto']);
                    $('#fecentedit').val(consu[0]['cFecEnt']);
                    $('#cntkmedit').val(consu[0]['cCantKil']);
                    $('#cntgaledit').val(consu[0]['cCantGal']);
                    $('#galminedit').val(parseFloat(consu[0]['vConKil'])*parseFloat(consu[0]['cCantKil']));
                    $('#activedit').val(consu[0]['cActiv']);
                    $('#grifoedit').val(consu[0]['grif']);

                }
                else {

                }

            }

        });
}
function eliminarValeCons(idvalc) {
    var url = "/combustible/deleteValeC/" + idvalc;
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
                    cache: false,
                    dataType: 'JSON',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            vales();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Vale de consumo eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            vales();
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
        }
    })
}

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#ordcvale').val() !== '0') {
        text = '';
        validarCaja('ordcvale', 'valordcvale', text, 1);
    } else {
        cont++;
        text = inicio + ' Seleccione orden de compra';
        validarCaja('ordcvale', 'valordcvale', text, 0);
    }
    if ($('#item').val() !== '0') {
        text = '';
        validarCaja('item', 'valitem', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione item';
        validarCaja('item', 'valitem', text, 0);
    }
    if ($('#meta').val() !== '0') {
        validarCaja('meta', 'valmeta', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta';
        validarCaja('meta', 'valmeta', text, 0);
    }
    if ($('#idvehi').val() !== '0') {
        validarCaja('placa', 'valplaca', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese placa';
        validarCaja('placa', 'valplaca', text, 0);
    }
    if ($('#idchof').val() !== '0') {
        validarCaja('dnic', 'valdnic', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Dni';
        validarCaja('dnic', 'valdnic', text, 0);
    }
    if ($('#dauto').val() !== '') {
        validarCaja('dauto', 'valdauto', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Doc Autorizacion';
        validarCaja('dauto', 'valdauto', text, 0);
    }
    if ($('#fecent').val() !== '') {
        validarCaja('fecent', 'valfecent', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Fecha Entrega';
        validarCaja('fecent', 'valfecent', text, 0);
    }
    if ($('#cntkm').val() !== '') {
        validarCaja('cntkm', 'valcntkm', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Cant. Km';
        validarCaja('cntkm', 'valcntkm', text, 0);
    }
    if ($('#cntgal').val() !== '') {
        validarCaja('cntgal', 'valcntgal', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Cant. Galones';
        validarCaja('cntgal', 'valcntgal', text, 0);
    }
    if ($('#activ').val() !== '') {
        validarCaja('activ', 'valactiv', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese actividad';
        validarCaja('activ', 'valactiv', text, 0);
    }
    return cont;
}

function validarFormularioEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#ordcvaleedit').val() !== '0') {
        text = '';
        validarCaja('ordcvaleedit', 'valordcvaleedit', text, 1);
    } else {
        cont++;
        text = inicio + ' Seleccione orden de compra';
        validarCaja('ordcvaleedit', 'valordcvaleedit', text, 0);
    }
    if ($('#itemedit').val() !== '0') {
        text = '';
        validarCaja('itemedit', 'valitemedit', text, 1);
    } else {
        cont++;
        text = inicio + ' seleccione item';
        validarCaja('itemedit', 'valitemedit', text, 0);
    }
    if ($('#metaedit').val() !== '0') {
        validarCaja('metaedit', 'valmetaedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Meta';
        validarCaja('metaedit', 'valmetaedit', text, 0);
    }
    if ($('#idvehiedit').val() !== '0') {
        validarCaja('placaedit', 'valplacaedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese placa';
        validarCaja('placaedit', 'valplacaedit', text, 0);
    }
    if ($('#idchofedit').val() !== '0') {
        validarCaja('dnicedit', 'valdnicedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Dni';
        validarCaja('dnicedit', 'valdnicedit', text, 0);
    }
    if ($('#dautoedit').val() !== '') {
        validarCaja('dautoedit', 'valdautoedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Doc Autorizacion';
        validarCaja('dautoedit', 'valdautoedit', text, 0);
    }
    if ($('#fecentedit').val() !== '') {
        validarCaja('fecentedit', 'valfecentedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Fecha Entrega';
        validarCaja('fecentedit', 'valfecentedit', text, 0);
    }
    if ($('#cntkmedit').val() !== '') {
        validarCaja('cntkmedit', 'valcntkmedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Cant. Km';
        validarCaja('cntkmedit', 'valcntkmedit', text, 0);
    }
    if ($('#cntgaledit').val() !== '') {
        validarCaja('cntgaledit', 'valcntgaledit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Cant. Galones';
        validarCaja('cntgaledit', 'valcntgaledit', text, 0);
    }
    if ($('#activedit').val() !== '') {
        validarCaja('activedit', 'valactivedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese actividad';
        validarCaja('activedit', 'valactivedit', text, 0);
    }
    return cont;
}
