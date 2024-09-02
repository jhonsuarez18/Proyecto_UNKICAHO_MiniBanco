var idofic = 0;
var exist = 0;
var idsm = 0;
var sit = 0;
var campos = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    tablaGrifo();
    tablaMarca();
    tablaSubMarca();
    tablaTipCombus();
    tablaTipVehi();
    tablaModelo();
    tablaModelTipV();
});
function camposMarca(){
    var tablacampos = new Array();
    tablacampos[0] = "descmarc";
    tablacampos[1] = "valdescmarc";
    campos.push(tablacampos);
}
function camposMarcaEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "descmarcedit";
    tablacampos[1] = "valdescmarcedit";
    campos.push(tablacampos);
}
function camposTipComb(){
    var tablacampos = new Array();
    tablacampos[0] = "desctipcomb";
    tablacampos[1] = "valdesctipcomb";
    campos.push(tablacampos);
}
function camposTipCombEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "desctipcombedit";
    tablacampos[1] = "valdesctipcombedit";
    campos.push(tablacampos);
}
function camposTipVehi(){
    var tablacampos = new Array();
    tablacampos[0] = "desctipvehic";
    tablacampos[1] = "valdesctipvehic";
    campos.push(tablacampos);
}
function camposTipVehiEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "desctipvehicedit";
    tablacampos[1] = "valdesctipvehicedit";
    campos.push(tablacampos);
}
function camposModelo(){
    var tablacampos = new Array();
    tablacampos[0] = "marc";
    tablacampos[1] = "valmarc";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = "descsubmarc";
    tablacampos1[1] = "valdescsubmarc";
    campos.push(tablacampos1);
}
function camposModeloEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "marcedit";
    tablacampos[1] = "valmarcedit";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = "descsubmarcedit";
    tablacampos1[1] = "valdescsubmarcedit";
    campos.push(tablacampos1);
}
function camposVersion(){
    var tablacampos = new Array();
    tablacampos[0] = "submarc";
    tablacampos[1] = "valsubmarc";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = "tipcomb";
    tablacampos1[1] = "valtipcomb";
    campos.push(tablacampos1);

    var tablacampos2 = new Array();
    tablacampos2[0] = "descmodel";
    tablacampos2[1] = "valdescmodel";
    campos.push(tablacampos2);
}
function camposVersionEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "submarcedit";
    tablacampos[1] = "valsubmarcedit";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = "tipcombedit";
    tablacampos1[1] = "valtipcombedit";
    campos.push(tablacampos1);

    var tablacampos2 = new Array();
    tablacampos2[0] = "descmodeledit";
    tablacampos2[1] = "valdescmodeledit";
    campos.push(tablacampos2);
}
function camposModelTipV(){
    var tablacampos = new Array();
    tablacampos[0] = "modelo";
    tablacampos[1] = "valmodelo";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = "tipvehic";
    tablacampos1[1] = "valtipvehic";
    campos.push(tablacampos1);
}
function camposModelTipVEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "modeloedit";
    tablacampos[1] = "valmodeloedit";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = "tipvehicedit";
    tablacampos1[1] = "valtipvehicedit";
    campos.push(tablacampos1);
}
function camposGrifo(){
    var tablacampos = new Array();
    tablacampos[0] = "ruc";
    tablacampos[1] = "valruc";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = 'descgrif';
    tablacampos1[1] = 'valdescgrif';
    campos.push(tablacampos1);
}
function camposGrifoEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "edruc";
    tablacampos[1] = "valedruc";
    campos.push(tablacampos);

    var tablacampos1 = new Array();
    tablacampos1[0] = 'eddescgrif';
    tablacampos1[1] = 'valeddescgrif';
    campos.push(tablacampos1);
}
function CargarMarcas(desm, id) {
    var url = "/combustible/getMarcsAct";
    var select = $('#' + desm).html('');
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
                    var result = data['marc'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['mId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['mId'] + '"selected>' + result[i]['mDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['mId'] + '">' + result[i]['mDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

function CargarSubMarcas(dessm, id) {
    var url = "/combustible/getSubMarcsAct";
    var select = $('#' + dessm).html('');
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
                    var result = data['submarc'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['sMId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['sMId'] + '"selected>' + result[i]['sMDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['sMId'] + '">' + result[i]['sMDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

function CargarTipComb(destipc, id) {
    var url = "/combustible/getTipCsAct";
    var select = $('#' + destipc).html('');
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
                    var result = data['tipcomb'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['tCId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['tCId'] + '"selected>' + result[i]['tCDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['tCId'] + '">' + result[i]['tCDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

function CargarModelos(desmodel, id) {
    var url = "/combustible/getModelsAct";
    var select = $('#' + desmodel).html('');
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
                    var result = data['model'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['mId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['mId'] + '"selected>' + result[i]['model'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['mId'] + '">' + result[i]['model'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

function CargarTipVehic(destipv, id) {
    var url = "/combustible/getTipVsAct";
    var select = $('#' + destipv).html('');
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
                    var result = data['tipv'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['tVId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['tVId'] + '"selected>' + result[i]['tVDesc'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['tVId'] + '">' + result[i]['tVDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

$('#addMarca').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_marca').modal('show');
    campos=[];
    camposMarca();
});
$('#addTipComb').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_tipcomb').modal('show');
    campos=[];
    camposTipComb();
});
$('#addTipVehic').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_tipvehic').modal('show');
    campos=[];
    camposTipVehi();
});
$('#addSubMarc').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_submarc').modal('show');
    CargarMarcas('marc', 0);
    campos=[];
    camposModelo();
});
$('#addModelo').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_modelo').modal('show');
    CargarSubMarcas('submarc', 0);
    CargarTipComb('tipcomb', 0);
    campos=[];
    camposVersion();
});
$('#addModeloTipV').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_modeltipv').modal('show');
    CargarModelos('modelo', 0);
    CargarTipVehic('tipvehic', 0);
    campos=[];
    camposModelTipV();
});
$('#addgrifo').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_grifo').modal('show');
    campos=[];
    camposGrifo();
});
function tablaMarca(){
    $('#tabla_Marca').DataTable({
        ajax: '/combustible/getmarcas',
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
            {"targets": 2, "width": "20%", "className": "text-left"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "10%", "className": "text-center"},
        ],
        columns: [

            {data: 'mDesc', name: 'mDesc'},
            {data: 'mFecCrea', name: 'mFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.mEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.mEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdMarca(' + row.mId + ')" TITLE="Editar Marca " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Marca" onclick="eliminarMarca(' + row.mId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Marca"  onclick="eliminarMarca(' + row.mId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function tablaTipCombus(){
    $('#tabla_TipCombustible').DataTable({
        ajax: '/combustible/getTipCombs',
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
            {"targets": 2, "width": "20%", "className": "text-left"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "10%", "className": "text-center"},
        ],
        columns: [

            {data: 'tCDesc', name: 'tCDesc'},
            {data: 'tCFecCrea', name: 'tCFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.tCEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.tCEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdTipComb(' + row.tCId + ')" TITLE="Editar Tipo Combustible" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Tipo Combustible" onclick="eliminarTipComb(' + row.tCId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Tipo Combustible"  onclick="eliminarTipComb(' + row.tCId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function tablaTipVehi(){
    $('#tabla_TipVehiculo').DataTable({
        ajax: '/combustible/getTipVehics',
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
            {"targets": 2, "width": "20%", "className": "text-left"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "10%", "className": "text-center"},
        ],
        columns: [

            {data: 'tVDesc', name: 'tVDesc'},
            {data: 'tVFecCrea', name: 'tVFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.tVEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.tVEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdTipVehic(' + row.tVId + ')" TITLE="Editar Tipo Vehiculo" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Tipo Vehiculo" onclick="eliminarTipVehic(' + row.tVId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Tipo Vehiculo"  onclick="eliminarTipVehic(' + row.tVId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function tablaSubMarca(){
    $('#tabla_SubMarca').DataTable({
        ajax: '/combustible/getSubMarcs',
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
            {"targets": 2, "width": "20%", "className": "text-left"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "10%", "className": "text-center"},
            {"targets": 5, "width": "10%", "className": "text-center"},
        ],
        columns: [

            {data: 'mDesc', name: 'mDesc'},
            {data: 'sMDesc', name: 'sMDesc'},
            {data: 'sMFecCrea', name: 'sMFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.sMEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.sMEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdSubMarc(' + row.sMId + ')" TITLE="Editar Sub Marca" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Sub Marca" onclick="eliminarSubMarc(' + row.sMId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Sub Marca"  onclick="eliminarSubMarc(' + row.sMId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function tablaModelo(){
    $('#tabla_Modelo').DataTable({
        ajax: '/combustible/getModels',
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
            {"targets": 0, "width": "25%", "className": "text-left"},
            {"targets": 1, "width": "25%", "className": "text-left"},
            {"targets": 2, "width": "10%", "className": "text-center"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "10%", "className": "text-left"},
            {"targets": 5, "width": "10%", "className": "text-center"},
            {"targets": 6, "width": "10%", "className": "text-center"}
        ],
        columns: [

            {data: 'sMDesc', name: 'sMDesc'},
            {data: 'tCDesc', name: 'tCDesc'},
            {data: 'mDesc', name: 'mDesc'},
            {data: 'mFecCrea', name: 'mFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.mEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.mEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdModelo(' + row.mId + ')" TITLE="Editar Modelo" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Modelo" onclick="eliminarModelo(' + row.mId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Modelo"  onclick="eliminarModelo(' + row.mId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function tablaModelTipV(){
    $('#tabla_ModeloTipV').DataTable({
        ajax: '/combustible/getModelTipVs',
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
            {"targets": 0, "width": "10%", "className": "text-left"},
            {"targets": 1, "width": "10%", "className": "text-left"},
            {"targets": 2, "width": "10%", "className": "text-left"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "20%", "className": "text-left"},
            {"targets": 5, "width": "5%", "className": "text-center"},
            {"targets": 6, "width": "5%", "className": "text-center"},
            {"targets": 7, "width": "5%", "className": "text-center"},
            {"targets": 8, "width": "5%", "className": "text-center"}
        ],
        columns: [

            {data: 'mDesc', name: 'mDesc'},
            {data: 'sMDesc', name: 'sMDesc'},
            {data: 'tCDesc', name: 'tCDesc'},
            {data: 'model', name: 'model'},
            {data: 'tVDesc', name: 'tVDesc'},
            {data: 'mTVFecCrea', name: 'mTVFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.mTVEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'
                }
            },
            {
                data: function (row) {
                    if (parseInt(row.mTVEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdModeloTipV(' + row.mTVId + ')" TITLE="Editar Modelo Tipo Vehiculo" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Modelo Tipo Vehiculo" onclick="eliminarModeloTipV(' + row.mTVId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Modelo Tipo Vehiculo"  onclick="eliminarModeloTipV(' + row.mTVId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function tablaGrifo() {
    $('#tabla_grifo').DataTable({
        ajax: '/combustible/getGrifos',
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
            {"targets": 0, "width": "10%", "className": "text-left"},
            {"targets": 1, "width": "10%", "className": "text-left"},
        ],
        columns: [

            {data: 'gRuc', name: 'gRuc'},
            {data: 'gDesc', name: 'gDesc'},
            {data: 'gFecCrea', name: 'gFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.gEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.gEst) === 1) {
                        return '<tr >\n' +
                            '<a href="javascript:"  onclick="abrilModalEdGrif(' + row.gid + ')" TITLE="Editar Modelo Tipo Vehiculo" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="javascript:" style="color: red" TITLE="Eliminar Modelo Tipo Vehiculo" onclick="eliminarGrifo(' + row.gid + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="javascript:" style="color: green" TITLE="Restaurar Modelo Tipo Vehiculo"  onclick="eliminarGrifo(' + row.gid + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function abrilModalEdMarca(idmarc) {
    window.event.preventDefault();
    $('#modal_dialog_edit_marca').modal('show');
    obtenerEditarMarca(idmarc);
    campos=[];
    camposMarcaEdit();
}

function abrilModalEdTipComb(idtc) {
    window.event.preventDefault();
    $('#modal_dialog_edit_tipcomb').modal('show');
    obtenerEditarTipComb(idtc);
    campos=[];
    camposTipCombEdit();
}

function abrilModalEdTipVehic(idtv) {
    window.event.preventDefault();
    $('#modal_dialog_edit_tipvehic').modal('show');
    obtenerEditarTipVehic(idtv);
    campos=[];
    camposTipVehiEdit();
}

function abrilModalEdSubMarc(idsm) {
    window.event.preventDefault();
    $('#modal_dialog_edit_submarc').modal('show');
    obtenerEditarSubMarc(idsm);
    campos=[];
    camposModeloEdit();
}

function abrilModalEdModelo(idm) {
    window.event.preventDefault();
    $('#modal_dialog_edit_modelo').modal('show');
    obtenerEditarModelo(idm);
    campos=[];
    camposVersionEdit();
}

function abrilModalEdModeloTipV(idmtv) {
    window.event.preventDefault();
    $('#modal_dialog_edit_modeltipv').modal('show');
    obtenerEditarModeloTipV(idmtv);
    campos=[];
    camposModelTipVEdit();
}


function abrilModalEdGrif(id) {
    window.event.preventDefault();
    $('#modal_dialog_edit_grifo').modal('show');
    obtenerEditarGrifo(id);
    campos=[];
    camposGrifoEdit();
}


function obtenerEditarMarca(idmarc) {
    var url = "/combustible/getMarcEdit/" + idmarc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var marc = data['marc'];
                    $('#idmarcedit').val(marc['mId']);
                    $('#descmarcedit').val(marc['mDesc']);
                    $('#descmarcedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarTipComb(idtc) {
    var url = "/combustible/getTipCEdit/" + idtc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var marc = data['tipcomb'];
                    $('#idtipcombedit').val(marc['tCId']);
                    $('#desctipcombedit').val(marc['tCDesc']);
                    $('#desctipcombedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarTipVehic(idtv) {
    var url = "/combustible/getTipVEdit/" + idtv;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var vehic = data['tipvehic'];
                    $('#idtipvehicedit').val(vehic['tVId']);
                    $('#desctipvehicedit').val(vehic['tVDesc']);
                    $('#desctipvehicedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarSubMarc(idsm) {
    var url = "/combustible/getSubMEdit/" + idsm;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var subm = data['subm'];
                    $('#idsubmarcedit').val(subm['sMId']);
                    $('#descsubmarcedit').val(subm['sMDesc']);
                    CargarMarcas('marcedit', subm['mId']);
                    $('#marcedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarModelo(idm) {
    var url = "/combustible/getModelEdit/" + idm;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var model = data['model'];
                    $('#idmodeledit').val(model['mId']);
                    $('#descmodeledit').val(model['mDesc']);
                    CargarSubMarcas('submarcedit', model['sMId']);
                    CargarTipComb('tipcombedit', model['tCId']);
                    $('#submarcedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarGrifo(id) {
    var url = "/combustible/getGrifosEdit/" + id;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var grif = data['grifo'];
                    $('#idedgrif').val(grif['gId']);
                    $('#edruc').val(grif['gRuc']);
                    $('#eddescgrif').val(grif['gDesc']);
                } else {

                }

            }

        });
}

function obtenerEditarModeloTipV(idmtv) {
    var url = "/combustible/getModelTipVEdit/" + idmtv;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var modeltv = data['modeltipv'];
                    $('#idmodeltvedit').val(modeltv['mTVId']);
                    $('#usoedit').val(modeltv['tVUso']);
                    CargarModelos('modeloedit', modeltv['mId']);
                    CargarTipVehic('tipvehicedit', modeltv['tVId']);
                    $('#idmodeltvedi').focus();
                } else {

                }

            }

        });
}

function eliminarMarca(idm) {
    var url = "/combustible/deleteMarc/" + idm;
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
                            tablaMarca();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Marca eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaMarca();
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

function eliminarTipComb(idtc) {
    var url = "/combustible/deleteTipC/" + idtc;
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
                            tablaTipCombus();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo Combustible eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaTipCombus();
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

function eliminarTipVehic(idtv) {
    var url = "/combustible/deleteTipV/" + idtv;
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
                            tablaTipVehi();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo Vehiculo eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaTipVehi();
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

function eliminarSubMarc(idsm) {
    var url = "/combustible/deleteSubM/" + idsm;
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
                            tablaSubMarca();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Sub Marca eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaSubMarca();
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

function eliminarModelo(idm) {
    var url = "/combustible/deleteModel/" + idm;
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
                            tablaModelo();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Modelo eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaModelo();
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

function eliminarModeloTipV(idmtv) {
    var url = "/combustible/deleteModelTipV/" + idmtv;
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
                            tablaModelTipV();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Modelo Tipo Vehiculo eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaModelTipV();
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

function eliminarGrifo(id){
    var url = "/combustible/deletegrif/" + id;
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
                            tablaGrifo();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Grifo eliminado correctamente',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaGrifo();
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
function enviarMarca() {
    if (validarFormularioMarca('descmarc', 'valdescmarc') === 0) {
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
                var descmarc = $('#descmarc').val();

                $.ajax({
                    url: '/combustible/storeMarc',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        descmarc: descmarc,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Marca exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_marca')
                                tablaMarca();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_marca')
                                tablaMarca();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmarca').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarTipComb() {
    if (validarFormularioTipComb('desctipcomb', 'valdesctipcomb') === 0) {
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
                var desctipcomb = $('#desctipcomb').val();

                $.ajax({
                    url: '/combustible/storeTipC',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        desctipcomb: desctipcomb,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Tipo Combustible exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_tipcomb')
                                tablaTipCombus();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_tipcomb')
                                tablaTipCombus();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviartipcomb').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarGrifo() {
    if (validarFormularioGrifo() === 0) {
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
                var ruc = $('#ruc').val();
                var descgrif = $('#descgrif').val();
                $.ajax({
                    url: '/combustible/storeGrifo',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        descgrif: descgrif,
                        ruc: ruc
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de grifo exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_grifo');
                                $('#ruc').val('');
                                $('#descgrif').val('');
                                tablaGrifo();
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
                                closeModal('modal_dialog_add_grifo')
                                $('#ruc').val('');
                                $('#descgrif').val('');
                                tablaGrifo();
                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviargrifo').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarTipVehic() {
    if (validarFormularioTipVehic('desctipvehic', 'valdesctipvehic') === 0) {
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
                var desctipvehic = $('#desctipvehic').val();

                $.ajax({
                    url: '/combustible/storeTipV',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        desctipvehic: desctipvehic,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Tipo Vehiculo exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_tipvehic')
                                tablaTipVehi();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_tipvehic')
                                tablaTipVehi();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviartipvehic').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarSubMarc() {
    if (validarFormularioSubM('marc', 'valmarc', 'descsubmarc', 'valdescsubmarc') === 0) {
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
                var idmarc = $('#marc').val();
                var descsubmarc = $('#descsubmarc').val();

                $.ajax({
                    url: '/combustible/storeSubM',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idmarc: idmarc,
                        descsubmarc: descsubmarc,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Sub Marca exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_submarc')
                                tablaSubMarca();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_submarc')
                                tablaSubMarca();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarsubmarc').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarModelo() {
    if (validarFormularioModel('submarc', 'valsubmarc',
        'tipcomb', 'valtipcomb',
        'descmodel', 'valdescmodel') === 0) {
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
                var idsubmarc = $('#submarc').val();
                var idtipcomb = $('#tipcomb').val();
                var descmodel = $('#descmodel').val();

                $.ajax({
                    url: '/combustible/storeModel',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idsubm: idsubmarc,
                        idtipcomb: idtipcomb,
                        descmodel: descmodel,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Modelo exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_modelo')
                                tablaModelo();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_modelo')
                                tablaModelo();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmodelo').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarModeloTipV() {
    if (validarFormularioModelTipV('modelo', 'valmodelo',
        'tipvehic', 'valtipvehic',
        'uso', 'valuso') === 0) {
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
                var idtipv = $('#tipvehic').val();
                var idmd = $('#modelo').val();

                $.ajax({
                    url: '/combustible/storeModelTipV',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtv: idtipv,
                        idmodel: idmd,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Modelo Tipo Vehiculo exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_modeltipv')
                                tablaModelTipV();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_modeltipv')
                                tablaModelTipV();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmodelotipv').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarMarcaEdit() {
    if (validarFormularioMarca('descmarcedit', 'valdescmarcedit') === 0) {
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
                var idmarc = $('#idmarcedit').val();
                var descmarc = $('#descmarcedit').val();

                $.ajax({
                    url: '/combustible/editMarc',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idmarc: idmarc,
                        descmarc: descmarc,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Marca Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_marca')
                                tablaMarca();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_marca')
                                tablaMarca();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmarcaedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarTipCombEdit() {
    if (validarFormularioTipComb('desctipcombedit', 'valdesctipcombedit') === 0) {
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
                var idtipcomb = $('#idtipcombedit').val();
                var desctipcomb = $('#desctipcombedit').val();

                $.ajax({
                    url: '/combustible/editTipC',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipcomb: idtipcomb,
                        desctipcomb: desctipcomb,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo Combustible Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_tipcomb')
                                tablaTipCombus();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_tipcomb')
                                tablaTipCombus();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviartipcombedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarTipVehicEdit() {
    if (validarFormularioTipVehic('desctipvehicedit', 'valdesctipvehicedit') === 0) {
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
                var idtipvehic = $('#idtipvehicedit').val();
                var desctipvehic = $('#desctipvehicedit').val();

                $.ajax({
                    url: '/combustible/editTipV',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipvehic: idtipvehic,
                        desctipvehic: desctipvehic,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo Vehículo Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_tipvehic')
                                tablaTipVehi();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_tipvehic')
                                tablaTipVehi();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviartipvehicedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarGrifdit() {
    if (validarFormularioGrifoedi() === 0) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editara el registro',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                var idedgrif = $('#idedgrif').val();
                var edruc = $('#edruc').val();
                var eddescgrif = $('#eddescgrif').val();

                $.ajax({
                    url: '/combustible/editGrifo',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idedgrif: idedgrif,
                        edruc: edruc,
                        eddescgrif: eddescgrif,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Grifo editado correctamente',
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_grifo')
                                $('#idedgrif').val('');
                                $('#edruc').val('');
                                $('#eddescgrif').val('');
                                tablaGrifo();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_grifo')
                                $('#idedgrif').val('');
                                $('#edruc').val('');
                                $('#eddescgrif').val('');
                                tablaGrifo();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviargrifoed').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarSubMarcEdit() {
    if (validarFormularioSubM('marcedit', 'valmarcedit', 'descsubmarcedit', 'valdescsubmarcedit') === 0) {
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
                var idsubmarc = $('#idsubmarcedit').val();
                var idmarc = $('#marcedit').val();
                var descsubmarc = $('#descsubmarcedit').val();

                $.ajax({
                    url: '/combustible/editSubM',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idsubmarc: idsubmarc,
                        idmarc: idmarc,
                        descsubmarc: descsubmarc,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Sub Marca Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_submarc')
                                tablaSubMarca();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_submarc')
                                tablaSubMarca();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarsubmarcedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarModeloEdit() {
    if (validarFormularioModel('submarcedit', 'valsubmarcedit',
        'tipcombedit', 'valtipcombedit',
        'descmodeledit', 'valdescmodeledit') === 0) {
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
                var idmodel = $('#idmodeledit').val();
                var idsubmarc = $('#submarcedit').val();
                var idtipcomb = $('#tipcombedit').val();
                var descmodel = $('#descmodeledit').val();

                $.ajax({
                    url: '/combustible/editModel',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idmodel: idmodel,
                        idsubm: idsubmarc,
                        idtipcomb: idtipcomb,
                        descmodel: descmodel,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Modelo Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_modelo')
                                tablaModelo();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_modelo')
                                tablaModelo();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmodeloedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarModeloTipVEdit() {
    if (validarFormularioModelTipV('modeloedit', 'valmodeloedit',
        'tipvehicedit', 'valtipvehicedit',
        'usoedit', 'valusoedit') === 0) {
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
                var idmodeltipv = $('#idmodeltvedit').val();
                var idtipv = $('#tipvehicedit').val();
                var idmd = $('#modeloedit').val();
                $.ajax({
                    url: '/combustible/editModelTipV',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idmtv: idmodeltipv,
                        idtv: idtipv,
                        idmodel: idmd,

                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Modelo Tipo Vehiculo Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_modeltipv')
                                tablaModelTipV();
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
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_modeltipv')
                                tablaModelTipV();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmodelotipvedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function validarFormularioMarca(desm, val) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + desm).val() !== '') {
        validarCaja(desm, val, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Marca';
        validarCaja(desm, val, text, 0);
    }
    return cont;
}

function validarFormularioTipComb(destc, val) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + destc).val() !== '') {
        validarCaja(destc, val, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Tipo Combustible';
        validarCaja(destc, val, text, 0);
    }
    return cont;
}

function validarFormularioGrifo() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#ruc').val() !== '') {
        validarCaja('ruc', 'valruc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese ruc';
        validarCaja('ruc', 'valruc', text, 0);
    }
    if ($('#descgrif').val() !== '') {
        validarCaja('descgrif', 'valdescgrif', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese nombre de grifo';
        validarCaja('descgrif', 'valdescgrif', text, 0);
    }
    return cont;
}

function validarFormularioGrifoedi() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#edruc').val() !== '') {
        validarCaja('edruc', 'valedruc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese ruc';
        validarCaja('edruc', 'valedruc', text, 0);
    }
    if ($('#eddescgrif').val() !== '') {
        validarCaja('eddescgrif', 'valeddescgrif', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese descripcion grifo';
        validarCaja('eddescgrif', 'valeddescgrif', text, 0);
    }
    return cont;
}

function validarFormularioTipVehic(destv, val) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + destv).val() !== '') {
        validarCaja(destv, val, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Tipo Vehículo';
        validarCaja(destv, val, text, 0);
    }
    return cont;
}

function validarFormularioSubM(desm, valm, dessm, valsm) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + desm).val() !== '0') {
        validarCaja(desm, valm, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Marca';
        validarCaja(desm, valm, text, 0);
    }
    if ($('#' + dessm).val() !== '') {
        validarCaja(dessm, valsm, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Sub Marca';
        validarCaja(dessm, valsm, text, 0);
    }
    return cont;
}

function validarFormularioModel(dessm, valsm, desctc, valtc, desmd, valmd) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + dessm).val() !== '0') {
        validarCaja(dessm, valsm, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + 'Seleccione Sub Marca';
        validarCaja(dessm, valsm, text, 0);
    }
    if ($('#' + desctc).val() !== '0') {
        validarCaja(desctc, valtc, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Tipo combustible';
        validarCaja(desctc, valtc, text, 0);
    }
    if ($('#' + desmd).val() !== '') {
        validarCaja(desmd, valmd, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Modelo';
        validarCaja(desmd, valmd, text, 0);
    }
    return cont;
}

function validarFormularioModelTipV(desmd, valmd, desctv, valtv, us, valus) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + desmd).val() !== '0') {
        validarCaja(desmd, valmd, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + 'Seleccione Modelo';
        validarCaja(desmd, valmd, text, 0);
    }
    if ($('#' + desctv).val() !== '0') {
        validarCaja(desctv, valtv, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Tipo vehiculo';
        validarCaja(desctv, valtv, text, 0);
    }

    return cont;
}

