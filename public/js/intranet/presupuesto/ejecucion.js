var listPre = [];
var listEspTex = [];
var listMont = [];
var pedido = [];
var listapedidos= [];
var cond=0;

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    //metas();
    //fuentefinanciamiento();
    //tipos();
    //datePickers();
    pedidos();
});

function pedidos() {
    var table = $('#tabla_pedidos').DataTable({
        ajax: '/presupuesto/obtenerpedidos',
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
            {"targets": 0, "width": "8%", "className": "text-center"},
            {"targets": 1, "width": "8%", "className": "text-center"},
            {"targets": 2, "width": "8%", "className": "text-center"},
            {"targets": 3, "width": "8%", "className": "text-center"},
            {"targets": 4, "width": "8%", "className": "text-center"},
            {"targets": 5, "width": "8%", "className": "text-center"},
            {"targets": 6, "width": "5%", "className": "text-center"},
            {"targets": 7, "width": "8%", "className": "text-center"},
            {"targets": 8, "width": "8%", "className": "text-center"},
            {"targets": 9, "width": "5%", "className": "text-center"},
            {"targets": 10, "width": "8%", "className": "text-center"},
            {"targets": 11, "width": "8%", "className": "text-left"},
            {"targets": 12, "width": "20%", "className": "text-center"},
        ],
        footerCallback: function (row, data, start, end, display) {
            var totalAmount = 0;
            const formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2
            });
            for (var i = 0; i < data.length; i++) {
                totalAmount += parseFloat(data[i]['peMonto']);
            }
            totalAmount = formatter.format(totalAmount);
            $(this.api().column(4).footer()).html(totalAmount);
        },
        columns: [

            {data: 'peCodPed', name: 'peCodPed'},
            {data: 'mCod', name: 'mCod'},
            {data: 'eGCod', name: 'eGCod'},
            {data: 'pre', name: 'pre'},
            {
                data: 'peMonto',
                render: $.fn.dataTable.render.number(',', '.', 2)
            },

            {data: 'peFecPre', name: 'peFecPre'},
            {
                data: function (row) {
                    return row.peFecAcOc === null ? '<span class="text-danger">NO</span>' : '<span class="text-success">SI</span>'

                }
            },
            {
                data: function (row) {
                    //var estp = parseInt();
                        return '<a  href="#" onclick="abrilModal(' + row.peId + ',' + row.peEstPed + ')"  ' +
                            'title="Cambiar estado del pedido" >'+row.ests+'</a>'

                }
            },
            {data: 'tdesc', name: 'tdesc'},
            {
                data: function (row) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="verItems(' + row.peId +','+row.peCodPed +')" TITLE="ver detalles" >\n' +
                            '<i class="text-purple far fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                            '</tr>';

                }
            },
            {
                data: function (row) {
                    return parseInt(row.peEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {data: 'name', name: 'name'},
            {
                data: function (row) {
                    if (parseInt(row.peEst) === 1 && parseInt(row.peEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="verDetalles(' + row.peId + ')" TITLE="ver detalles" >\n' +
                            '<i class="text-purple far fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                            '<a href="#"  onclick="abrilModalEdit(' + row.peId + ')" TITLE="Edit Pedido" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar meta" onclick="eliminarPedido(' + row.peId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#"  onclick="verDetalles(' + row.peId + ')" TITLE="ver detalles" >\n' +
                            '<i class="text-purple far fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar meta"  onclick="eliminarPedido(' + row.peId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function DetallePedido(idp) {
    var table = $('#tabla_detalle_pedidos').DataTable({
        ajax: '/presupuesto/getDetPedido/'+idp,
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
            {"targets": 1, "width": "8%", "className": "text-left"},
            {"targets": 2, "width": "8%", "className": "text-right"},
            {"targets": 3, "width": "8%", "className": "text-right"},
            {"targets": 4, "width": "8%", "className": "text-right"},
        ],
        footerCallback: function (row, data, start, end, display) {
            var totalAmount = 0;
            const formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2
            });
            for (var i = 0; i < data.length; i++) {
                totalAmount += parseFloat(data[i]['VALOR_TOTAL']);
            }
            totalAmount = formatter.format(totalAmount);
            $(this.api().column(4).footer()).html(totalAmount);
        },
        columns: [

            {data: 'ITEM', name: 'ITEM'},
            {
                data: function (row) {
                    return row.TIPO_BIEN === 'B' ? '<span class="text-secondary">BIEN</span>' : '<span class="text-secondary">SERVICIO</span>'

                }
            },
            {data: 'CANT_APROBADA', name: 'CANT_APROBADA'},
            {data: 'PRECIO_UNIT', name: 'PRECIO_UNIT'},
            {data: 'VALOR_TOTAL', name: 'VALOR_TOTAL'},

        ]
    });
}

$("#tip").change(function () {
        var caja = $('#nropedido').val('');

        if (this.value === '3')
            cambiarTipoViatico();
        else
            cambiarTipoNormal();

    }
);
$('#addPed').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_Pedido').modal({show: true, backdrop: 'static', keyboard: false});
    datePickers();
    tipos();
    metas();
    //centCost();
    $('#nped').prop("hidden", false);
    $('#centc').prop("hidden", false);
});

function verDetalles(id) {
    window.event.preventDefault();
    $('#modal_dialog_ver_Pedido').modal({show: true, backdrop: 'static', keyboard: false});
    var url = "/presupuesto/getPedidoDetalle/" + id;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var ped = data['ped'];
                    $('#nropedidod').val(ped['peCodPed']);
                    $('#nmd').val(ped['mCod']);
                    $('#tipd').val(ped['tdesc']);
                    $('#transd').val(ped['pre']);
                    $('#ccd').val(ped['cc']);
                    $('#montd').val(ped['peMonto']);
                    $('#fecd').val(ped['peFecPre']);
                    $('#susd').val(ped['peDesc']);
                    $('#esd').val(ped['eGDesc']);
                    $('#usured').val(ped['name']);
                } else {

                }


            }

        });
}
function verItems(id,cod) {
    window.event.preventDefault();
    $('#modal_dialog_ver_Items_Pedido').modal({show: true, backdrop: 'static', keyboard: false});
    $('#numpedi').val(("00000" + cod).slice(-5));
    DetallePedido(id);
}
function cambiarTipoNormal() {
    var valhtml;
    var idopc = $('#tipcam');
    idopc.empty();
    valhtml = ' <label for="mont">MONTO\n' +
        '                        <req>*</req>\n' +
        '                    </label>\n' +
        '                    <div class="input-group m-b-10">\n' +
        '                        <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>\n' +
        '                        <input id="mont" type="text" class="form-control" onkeypress="return filterFloat(event,this);"/>\n' +
        '                    </div>';
    idopc.append(valhtml);
    $('#listesp').prop("hidden", true);
    $('#totvi').prop("hidden", true);
    this.listPre = [];
    this.listEspTex = [];
    this.listMont = [];
    addlistEsp();
}

function cambiarTipoViatico() {
    var valhtml;
    var idopc = $('#tipcam');
    idopc.empty();
    valhtml =
        '                    <label for="espgas"> MONTO\n' +
        '                        <req>*</req>\n' +
        '                    </label>\n' +
        '                    <div class="input-group">\n' +
        '                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>\n' +
        '                            <input id="mont" type="text" class="form-control" onkeypress="return filterFloat(event,this);"/>\n' +
        '                        <span class="input-group-append">\n' +
        '\t\t\t\t\t\t\t\t\t\t\t<a href="#" onclick="addesp()" class="input-group-text" style="text-decoration:none"\n' +
        '                                               title="Agregar especifica de gasto" ><i\n' +
        '                                                    class="fa fa-plus"></i></a>\n' +
        '                            </span>\n' +
        '                    </div>\n';
    idopc.append(valhtml);
    $('#listesp').prop("hidden", false);
    $('#totvi').prop("hidden", false);

}

var datePickers = function () {

    $('#fecpre').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,

    });
};


$('#cencosed').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/presupuesto/getCentroCosto",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.cCId,
                        name: item.cCNombre,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var idcenc = $('#idcenced');
        idcenc.val('');
        idcenc.val(item.id);
        return item;
    }

});
$('#cencos').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/presupuesto/getCentroCosto",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.cCId,
                        name: item.cCNombre,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var idcenc = $('#idcenc');
        idcenc.val('');
        idcenc.val(item.id);
        return item;
    }

});
$('#cencos1').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/presupuesto/getCentroCosto",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.cCId,
                        name: item.cCNombre,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var idcenc = $('#idcenc1');
        idcenc.val('');
        idcenc.val(item.id);
        return item;
    }

});

function metas() {
    var url = "/presupuesto/obtenermetas";
    var arreglo;
    var select = $('#nromet').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function metasEdit(idmeta, idesp, idtrans) {
    var url = "/presupuesto/obtenermetas";
    var select = $('#nrometedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['mId'].toString() === idmeta.toString()) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mCod'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mCod'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
                obtenerEspecificasMetaIdEdit(idmeta, idesp, idtrans);
            }

        });
}

function tipos() {
    var url = "/presupuesto/obtenertipo";
    var arreglo;
    var select = $('#tip').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['tId'] + '">' + data[i]['tdesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}


function tiposEdit(idtipo) {
    var url = "/presupuesto/obtenertipo";
    var arreglo;
    var select = $('#tipedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['tId'].toString() === idtipo.toString()) {
                        htmla = '<option value="' + data[i]['tId'] + '" selected>' + data[i]['tdesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['tId'] + '">' + data[i]['tdesc'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function transmodiEditChang(id) {
    var url = "/presupuesto/obtenerTransferenciasModifica2/" + id;
    var arreglo;
    var select = $('#npreedit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['pre'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function transmodi(id) {

    var url = "/presupuesto/obtenerTransferenciasModifica2/" + id;
    var arreglo;
    var select = $('#npre').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['trId'] + '" >' + data[i]['pre'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

/*function transedit(id) {
    var url = "/presupuesto/gettransedit/" + 1;
    var arreglo;
    var select = $('#npreedit').html('');
    var html = '<option value="0" >SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['trId'] + '" selected>' + data[i]['trNumRj'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}*/

function transmodiEdit(idespg, idtrans) {
    var url = "/presupuesto/obtenerTransferenciasModifica2/" + idespg;
    var arreglo;
    var select = $('#npreedit').html('');
    var html = '<option value="0" >SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['trId'].toString() === idtrans.toString()) {
                        htmla = '<option value="' + data[i]['trId'] + '" selected>' + data[i]['pre'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['trId'] + '">' + data[i]['pre'] + '</option>';

                    }


                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

$('#nromet').on('change', function () {
    obtenerEspecificasMetaId(this.value);
    // cambiarTipoNormal();
    /*    $('#tip option').prop('selected', function () {
            return this.defaultSelected;
        });*/
});
$('#espgas').on('change', function () {
    transmodi(this.value);
});
$('#nrometedit').on('change', function () {
    obtenerEspecificasMetaIdEditchang(this.value);
});
$('#espgasedit').on('change', function () {
    transmodiEditChang(this.value);
});
$('#npre').on('change', function () {
    saldo(this.value, $('#espgas').val());
});
$('#npreedit').on('change', function () {
    saldoE(this.value, $('#espgasedit').val());
    //saldoEdit(this.value, $('#espgasedit').val());
});

function saldo(idt, ideg) {
    var url = "/presupuesto/obtenersaldo/" + idt + '/' + ideg;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var sald = data['saldo'];
                if (data['error'] === 0) {
                    if (sald.length !== 0) {
                        if (sald[0]['sal'] !== 0) {
                            $('#sal').val(sald[0]['sal']);
                            $('#idtransf').val(sald[0]['trId']);
                            $('#idtrb').val(sald[0]['mEGId']);
                        } else {
                            $('#sal').val(sald[0]['mont']);
                            $('#idtransf').val(sald[0]['trId']);
                            $('#idtrb').val(sald[0]['mEGId']);
                        }

                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            type: 'info',
                            title: 'oops!!',
                            text: 'No tiene prespuesto incorporado',
                            showConfirmButton: false,
                            timer: 6000
                        });
                        $('#sal').val(0);
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
                    location.reload();
                }

            }

        });
}
function saldoE(idt, ideg) {
    var url = "/presupuesto/obtenersaldo/" + idt + '/' + ideg;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var sald = data['saldo'];
                if (data['error'] === 0) {
                    if (sald.length !== 0) {
                        if (sald[0]['sal'] !== 0) {
                            $('#saledit').val(sald[0]['sal']);
                            $('#idtransfedit').val(sald[0]['trId']);
                            $('#idtrbedit').val(sald[0]['mEGId']);
                        } else {
                            $('#saledit').val(sald[0]['mont']);
                            $('#idtransfedit').val(sald[0]['trId']);
                            $('#idtrbedit').val(sald[0]['mEGId']);
                        }

                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            type: 'info',
                            title: 'oops!!',
                            text: 'No tiene prespuesto incorporado',
                            showConfirmButton: false,
                            timer: 6000
                        });
                        $('#saledit').val(0);
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
                    location.reload();
                }

            }

        });
}
$('#montedit').on('change',function (){
    if(parseInt($('#saledit').val())>=parseInt($('#montedit').val())){
        validarCaja('montedit', 'valmontedit', 'Correcto', 1);
        $('#enviaredit').prop('disabled',false);
    }else{
        var text = ' ingrese un monto correcto';
        validarCaja('montedit', 'valmontedit', text, 0);
        $('#enviaredit').prop('disabled',true);
    }
})
function saldoEdit(idt, ideg) {
    var url = "/presupuesto/obtenersaldo/" + idt + '/' + ideg;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var sald = data['saldo'];
                    /*if(sald[0]['sal']!=null){
                        $('#sal').val(sald[0]['sal']);
                    }else{
                        $('#sal').val(sald[0]['mont']);
                    }*/
                    $('#idtransfedit').val(sald[0]['trId']);
                    $('#idtrbedit').val(sald[0]['mEGId']);
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

        });
}

function obtenerEspecificasMetaId(idmeta) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var select = $('#espgas').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function obtenerEspecificasMetaIdEditchang(idmeta) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var select = $('#espgasedit').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {
                    htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function obtenerEspecificasMetaIdEdit(idmeta, idesp, transf) {
    var url = "/presupuesto/obtenerespecificasmeta/" + idmeta;
    var arreglo;
    var select = $('#espgasedit').html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                var htmla = '';
                for (var i = 0; i < data.length; i++) {


                    if (data[i]['mEGId'].toString() === idesp.toString()) {
                        htmla = '<option value="' + data[i]['mEGId'] + '"selected>' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mEGId'] + '">' + data[i]['eGCod'] + ' ' + data[i]['eGDesc'] + '</option>';

                    }
                    html = html + htmla;
                }
                select.append(html);
                transmodiEdit(idesp, transf);
            }

        });
}

function enviar() {
    for (var i = 0; i < pedido.length; i++) {
        let listape = new Array();
        listape[0] = pedido[i]['npedi'];
        listape[1] = pedido[i]['idcencos'];
        listape[2] = $('#idtrb').val();
        listape[3] = $('#mont').val();
        listapedidos.push(listape);
    }
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
            if (validarFormulario() === 0) {
                var nromet = $('#nromet').val();
                if (listPre === undefined || listPre.length === 0) {
                    var npre = $('#idtrb').val();
                    var mont = $('#mont').val();
                    listPre.push(npre);
                    listMont.push(mont);
                }
                var espgas = $('#espgas').val();
                var tip = $('#tip').val();
                var idtransf = $('#idtransf').val();
                var nropedido = $('#nropedido').val();
                var estado = $('#estado').val();
                var fecpre = $('#fecpre').val();
                var sus = $('#sus').val();
                var idcenc = $('#idcenc').val();
                var condic=cond;
                sus = JSON.stringify(sus);
                json = JSON.stringify(listapedidos);
                $.ajax({
                    url: '/presupuesto/storeejecucion',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        nromet: nromet,
                        espgas: espgas,
                        npre: listPre,
                        tip: tip,
                        nropedido: nropedido,
                        codtrans: idtransf,
                        mont: listMont,
                        fecpre: fecpre,
                        estado: estado,
                        sus: sus,
                        cond:condic,
                        lisped:json,
                        idcenc: idcenc
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de pedido exitoso',
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
                        $('#enviar').prop("disabled", true);
                    }
                });
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    type: 'warning',
                    title: 'antencion!',
                    text: 'El formulario tiene errores, por favor, subsanelos..',
                    showConfirmButton: false,
                    timer: 3000
                });
            }

        }
    })


}

function enviarEdit() {
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
            var idpedidoedit = $('#idpedidoedit').val();
            var nromet = $('#nrometedit').val();
            var npre = $('#npreedit').val();
            var mont = $('#montedit').val();
            var espgas = $('#espgasedit').val();
            var tip = $('#tipedit').val();
            var idtrans = $('#idtransfedit').val();
            var nropedido = $('#nropedidoedit').val();
            var estado = $('#estadoedit').children("option:selected").val();
            var fecpre = $('#fecpreedit').val();
            var sus = $('#susedit').val();
            sus = JSON.stringify(sus);
            var idcenc = $('#idcenced').val();
            $.ajax({
                url: '/presupuesto/editejecucion',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idpedidoedit: idpedidoedit,
                    nromet: nromet,
                    espgas: espgas,
                    npre: npre,
                    tip: tip,
                    nropedido: nropedido,
                    codtrans: idtrans,
                    mont: mont,
                    fecpre: fecpre,
                    estado: estado,
                    sus: sus,
                    idcenc: idcenc
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Pedido editado ',
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
                    $('#enviaredit').prop("disabled", true);
                }
            });


        }
    })


}

function abrilModal(id, estado) {
    window.event.preventDefault();
    $('#modal-dialog').modal('show');
    $('#idpedido').val(id);
    var estval = [];
    var esttext = [];
    $("#estadocan option").each(function () {
        estval.push($(this).val());
        esttext.push($(this).text());
    });
    var select = $('#estadocan').html('');
    var html = '';
    var htmla = '';
    for (var i = 0; i < esttext.length; i++) {
        if (i === estado) {
            htmla = '<option value="' + i + '" selected>' + esttext[i] + '</option>';
        } else {
            htmla = '<option value="' + i + '">' + esttext[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}

function abrilModalEdit(idedit) {
    window.event.preventDefault();
    $('#modal-dialog_edit').modal('show');
    cargarEditarPedido(idedit)
    getFechaUt('fecpreedit');
}

function cargarEditarPedido(val) {
    var url = "/presupuesto/obtenereditarpedido/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var ped = data['pedido'];
                    var espga = data['espga'];
                    var presup = data['presup'];
                    var cencos = data['cencos'];
                    if (typeof data['cencos'] !== 'undefined' && data['cencos'] !== null) {
                        $('#idcenced').val(cencos['idc'])
                        $('#cencosed').text(cencos['cCAbreviado'])
                    }
                    $('#idpedidoedit').val(val);
                    $('#nropedidoedit').val(ped['peCodPed']);
                    $('#fecpreedit').val(ped['peFecPre']);
                    $('#montedit').val(ped['peMonto']);
                    $('#idtransfedit').val(ped['trId']);
                    $('#susedit').val(ped['peDesc'])
                    estadoEdit(ped['peEstPed']);
                    metasEdit(espga['mId'], espga['mEGId'], parseInt(ped['trId']));
                    tiposEdit(ped['tId']);
                    saldoE(parseInt(ped['trId']),parseInt(espga['mEGId']));
                    //transedit(parseInt(ped['peCodTrans']));
                } else {

                }
            }

        });
}


function estadoEdit(estado) {
    var estval = [];
    var esttext = [];
    $("#estadoedit option").each(function () {
        estval.push($(this).val());
        esttext.push($(this).text());
    });
    var select = $('#estadoedit').html('');
    var html = '';
    var htmla = '';
    for (var i = 0; i < esttext.length; i++) {
        if (i === estado) {
            htmla = '<option value="' + i + '" selected>' + esttext[i] + '</option>';
        } else {
            htmla = '<option value="' + i + '">' + esttext[i] + '</option>';
        }
        html = html + htmla;
    }
    select.append(html);
}

function cambiarEstado() {
    var pedido = $('#idpedido').val();
    var estado = $('#estadocan').children("option:selected").val();
    var url = "/presupuesto/cambiarestadopedido/" + pedido + "/" + estado;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se cambiara el estado del pedido',
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
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: CSRF_TOKEN,
                    success: function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Operacion exitosa',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#modal-dialog').modal('hide');
                            redirect('/presupuesto/ejecucion');
                        } else {

                        }
                    }

                });

        }
    })


}

function addesp() {
    var esp = $('#espgas');
    var mont = $('#mont');
    var npre = $('#idtrb');
    if (validarMontovia() === 0) {
        var ubi = 0;
        for (var i = 0; i < listPre.length; i++) {
            if (listPre[i].toString() === esp.val().toUpperCase()) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            listPre.push(npre.val());
            listEspTex.push(esp.children("option:selected").text());
            listMont.push(mont.val());
        }

        addlistEsp();
        esp.focus();
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'Verifique monto',
            showConfirmButton: false,
            timer: 3000
        });
        mont.focus();
    }
}

function addlistEsp() {
    var listacontact = $('#listesp').html('');
    var total = 0;
    var htmla = '', html = '', htmlc = '<label for="mont">LISTA ESPECIFICAS\n' +
        '                        <req>*</req>\n' +
        '                    </label>';
    for (var i = 0; i < listEspTex.length; i++) {
        htmla = '<li >  ' + listEspTex[i] + '<strong> Monto : s./</strong>' + listMont[i] + ' <a href="#" onclick="delListEsp(' + [i] + ')" style="text-decoration:none"> <i style="color: red" title="Quitar" class="fa fa-minus-circle" ></i></a></li>';
        html = htmla + html;
        total = total + parseInt(listMont[i]);
    }
    $('#totv').val(total);
    listacontact.append(htmlc + html);
}

function delListEsp(id) {
    listPre.splice(id, 1);
    listEspTex.splice(id, 1);
    listMont.splice(id, 1);
    addlistEsp();
}


function valNroPedido(nomped,valnped) {
    var ped = $('#'+nomped);
    var nump = ('00000' + ped.val()).slice(-5);
    ped.val(nump);
    var tip = $('#tip').val();
    var url = "/presupuesto/validarpedido/" + nump + "/" + tip;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['ped'];
                    if (parseInt(result[0]['cant']) > 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El pedido ya esta registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        //validarCaja('nropedido', 'validnropedido', 'El pedido ya fue registrado', 0);
                        validarCaja(''+nomped, ''+valnped, 'El pedido ya fue registrado', 0);
                    } else {
                        //validarCaja('nropedido', 'validnropedido', 'Nro de pedido correcto', 1);
                        validarCaja(''+nomped, ''+valnped, 'Nro de pedido correcto', 1);
                        $('#enviar').prop("disabled", false);
                    }
                }

            }, beforeSend() {
                $('#enviar').prop("disabled", true);
            }

        });
}

function validarMonto() {
    var sald = parseInt($('#sal').val());
    var mont = parseInt($('#mont').val());
    if (sald < mont) {
        var text = ' ingrese monto';
        validarCaja('mont', 'valmon', text, 0);
        return 1;
    } else {
        validarCaja('mont', 'valmon', '', 1);
        return 0;
    }
}

function validarMontovia() {
    var sald = parseInt($('#sal').val());
    var mont = parseInt($('#mont').val());
    if (sald < mont) {
        var text = ' ingrese monto';
        validarCaja('mont', 'valmon', text, 0);
        return 1;
    } else {
        validarCaja('mont', 'valmon', '', 1);
        return 0;
    }

}


function eliminarPedido(idpedido) {
    var url = "/presupuesto/eliminarpedido/" + idpedido;

    var idpaciente = $('#idpaciente').val();
    var idpersona = $('#idpersona').val();
    var idcontactovisita = $('#idcontactovisita').val();
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
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: CSRF_TOKEN,
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/ejecucion');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Pedido eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/ejecucion');
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

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#estado').val() !== '') {
        validarCaja('estado', 'validestado', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion un estado';
        validarCaja('estado', 'validestado', text, 0);
    }

    if ($('#nromet').val() !== '0') {
        validarCaja('nromet', 'validnromet', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion una meta';
        validarCaja('nromet', 'validnromet', text, 0);
    }
    if ($('#tip').val() !== '0') {
        validarCaja('tip', 'validtip', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion un tipo';
        validarCaja('tip', 'validtip', text, 0);
    }
    if ($('#espgas').val() !== '0') {
        validarCaja('espgas', 'validespgas', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion una especifica';
        validarCaja('espgas', 'validespgas', text, 0);
    }

    if ($('#npre').val() !== '0') {
        validarCaja('npre', 'valnpre', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion una transferencia';
        validarCaja('npre', 'valnpre', text, 0);
    }
    if ($('#mont').val() === '') {
        cont++;
        text = inicio + ' ingrese monto';
        validarCaja('mont', 'valmon', text, 0);
    } else {
        validarCaja('mont', 'valmon', 'correcto', 1);
    }
    if ($('#totv').val() === '') {
        cont++;
        text = inicio + 'Ingrese especificas';
        validarCaja('totv', 'valtotv', text, 0);
    } else {
        validarCaja('totv', 'valtotv', 'correcto', 1);
    }
    if ($('#pegrupal').is(':checked')) {

    } else {
        if ($('#nropedido').val() === '') {
            cont++;
            text = inicio + ' ingrese nro pedido';
            validarCaja('nropedido', 'validnropedido', text, 0);
        } else {
            validarCaja('nropedido', 'validnropedido', 'correcto', 1);
        }
    }
    if ($('#fecpre').val() === '') {
        cont++;
        text = inicio + ' ingrese fecha';
        validarCaja('fecpre', 'valfecpre', text, 0);
    } else {
        validarCaja('fecpre', 'valfecpre', 'correcto', 1);
    }
    cont += validarMonto();
    return cont;
}

function Validarmonto(evt, input) {
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if (preg.test(tempValue) === true) {
        return true;
    } else {
        return false;
    }
}


$("#mont").on('change', function () {
    let sal = $('#sal').val();
    if (parseFloat(this.value) > parseFloat(sal)) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'No tiene suficiene presupuesto',
            showConfirmButton: false,
            timer: 3000
        });
        $('#enviar').prop("disabled", true);
    } else
        $('#enviar').prop("disabled", false);

});

$('#addpedi').on('click', function () {
    let npedi = $('#nropedido1').val();
    let centcost = $('#cencos1').val();
    let idcentcost = $('#idcenc1').val();
    if (validarPedi() === 0) {
        let pedidocen = new Array();
        pedidocen['npedi'] = npedi;
        pedidocen['cencos'] = centcost;
        pedidocen['idcencos'] = idcentcost;
        var ubi = 0;
        for (var i = 0; i < pedido.length; i++) {
            if (pedido[i]['idcencos'].toString() === pedidocen['idcencos'] || pedido[i]['npedi'].toString() === pedidocen['npedi']) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            $('#envref').prop("disabled", false);
            pedido.push(pedidocen);
        }
        tabla_pedi();
        $('#nropedido1').focus();
    } else {
        operacionSubsanar();
    }
});

function tabla_pedi() {
    var datatable = $('#tabla_pedi');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: pedido,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            /*footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['monto']);
                }
                totalAmount = formatter.format(totalAmount);
                $('#totalmonorig').val(totalAmount);
                $(this.api().column(3).footer()).html(totalAmount);
            },*/
            columnDefs: [
                {"targets": 0, "width": "20%", "className": "text-center"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'npedi', name: 'npedi'},
                {data: 'cencos', name: 'cencos'},
                {
                    data: function (row) {

                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: red" TITLE="Eliminar" onclick="quitarPedi(' + row.npedi + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );
}
function validarPedi() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#nropedido1').val() !== '') {
        validarCaja('nropedido1', 'validnropedido1', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Nro de Pedido';
        validarCaja('nropedido1', 'validnropedido1', text, 0);
    }
    if ($('#idcenc1').val() !== '') {
        validarCaja('cencos1', 'validcencos1', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Centro de Costo';
        validarCaja('cencos1', 'validcencos1', text, 0);
    }
    return cont;
}
function quitarPedi(npedi) {
    var ubi = null;
    for (var i = 0; i < pedido.length; i++) {
        if (parseInt(pedido[i]['npedi']) === parseInt(npedi)) {
            ubi = i;
        }
    }
    pedido.splice(ubi, 1);
    tabla_pedi();
}

$("#pegrupal").on('change', function () {
    if ($(this).is(':checked')) {
        $('#grupalp').prop("hidden", false);
        $('#messag').prop("hidden", false);
        $('#data-table_list_pedi').prop("hidden", false);
        $('#nped').prop("hidden", true);
        $('#centc').prop("hidden", true);
        cond=1;
    } else {
        $('#grupalp').prop("hidden", true);
        $('#messag').prop("hidden", true);
        $('#data-table_list_pedi').prop("hidden", true);
        $('#nped').prop("hidden", false);
        $('#centc').prop("hidden", false);
        cond=0;
    }
});
