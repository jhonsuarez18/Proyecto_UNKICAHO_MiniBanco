var exis=0;
var exispp=0;
var exisff=0;
var exisc=0;
var exiseg=0;
var exisfin=0;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    //programaPresupuestal();
    //especificaGasto();
    //tipos();
    $('#btng').prop("hidden", false);
    $('#btne').prop("hidden", true);
});
function obtenerTipoEdit(val){
    $('#btng').prop("hidden", true);
    $('#btne').prop("hidden", false);
    var url = "/presupuesto/getTipEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtip').val(data['tId']);
                $('#desctipo').val(data['tdesc']);
                $('#desctipo').focus();
                //$('#desctipo').val(data['result']['tdesc']);

            }

        });
}
function obtenerFuenEdit(val){
    $('#btngff').prop("hidden", true);
    $('#btneff').prop("hidden", false);
    var url = "/presupuesto/getFuenEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idfuen').val(data['fFId']);
                $('#descfuen').val(data['fFdesc']);
                $('#descfuen').focus();
                //$('#desctipo').val(data['result']['tdesc']);

            }

        });
}
function obtenerConceptEdit(val){
    $('#btngc').prop("hidden", true);
    $('#btnec').prop("hidden", false);
    var url = "/presupuesto/getConcepEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idconcep').val(data['cId']);
                $('#descconcep').val(data['cDescripcion']);
                $('#descconcep').focus();
                //$('#desctipo').val(data['result']['tdesc']);

            }

        });
}
function obtenerProgPresEdit(val){
    $('#btngprog').prop("hidden", true);
    $('#btneprog').prop("hidden", false);
    var url = "/presupuesto/getProgPresEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idprog').val(data['pPId']);
                $('#codprog').val(data['pPCod']);
                $('#descprog').val(data['pPDesc']);
                $('#codprog').focus();

            }

        });

}
function obtenerEspGEdit(val){
    $('#btngespg').prop("hidden", true);
    $('#btneespg').prop("hidden", false);
    var url = "/presupuesto/getEspeGEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idespg').val(data['eGId']);
                $('#codespg').val(data['eGCod']);
                $('#descespg').val(data['eGDesc']);
                $('#codespg').focus();

            }

        });

}
function obtenerFinEdit(val){
    $('#btngfin').prop("hidden", true);
    $('#btnefin').prop("hidden", false);
    var url = "/presupuesto/getFinEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idfin').val(data['fId']);
                $('#codpro').val(data['fCodProducto']);
                $('#descpro').val(data['fDescProducto']);
                $('#codact').val(data['fCodActividad']);
                $('#descact').val(data['fDescActividad']);
                $('#codfin').val(data['fCodFinalidad']);
                $('#descfin').val(data['fDescFinalidad']);
                $('#codpro').focus();

            }

        });

}
$(function () {
    $('#tabla_tipo').DataTable({
            ajax: '/presupuesto/gettipoPed',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: false,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
           columnDefs: [
                {"targets": 0, "width": "2%", "className": "text-center"},
                {"targets": 1, "width": "5%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "3%", "className": "text-left"},
                {"targets": 4, "width": "3%", "className": "text-center"},
                {"targets": 5, "width": "3%", "className": "text-center"},
            ],

            columns: [
                {data: 'tCod', name: 'tCod'},
                {data: 'tdesc', name: 'tdesc'},
                {data: 'tFecCrea', name: 'tFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.tEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipoEdit(' + row.tId + ')" TITLE="Editar Tipo" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Tipo" onclick="eliminartip(' + row.tId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Tipo" onclick="eliminartip(' + row.tId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
    CargarProgramaPresupuestal();
    CargarFuenteFinanciamiento();
    CargarConcepto();
    CargarEspecificaGasto();
});
$(function () {
    $('#tabla_Finalidad').DataTable({
            ajax: '/presupuesto/getFin',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: false,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
            columnDefs: [
                {"targets": 0, "width": "2%", "className": "text-center"},
                {"targets": 1, "width": "20%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "20%", "className": "text-left"},
                {"targets": 4, "width": "3%", "className": "text-center"},
                {"targets": 5, "width": "20%", "className": "text-left"},
                {"targets": 6, "width": "5%", "className": "text-center"},
                {"targets": 7, "width": "5%", "className": "text-left"},
                {"targets": 8, "width": "5%", "className": "text-center"},
                {"targets": 9, "width": "5%", "className": "text-center"},
            ],

            columns: [
                {data: 'fCodProducto', name: 'fCodProducto'},
                {data: 'fDescProducto', name: 'fDescProducto'},
                {data: 'fCodActividad', name: 'fCodActividad'},
                {data: 'fDescActividad', name: 'fDescActividad'},
                {data: 'fCodFinalidad', name: 'fCodFinalidad'},
                {data: 'fDescFinalidad', name: 'fDescFinalidad'},
                {data: 'fFecCrea', name: 'fFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.fEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.fEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerFinEdit(' + row.fId + ')" TITLE="Editar Finalidad" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Finalidad" onclick="eliminarfin(' + row.fId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Finalidad" onclick="eliminarfin(' + row.fId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
function CargarFuenteFinanciamiento(){
    $('#tabla_fuente').DataTable({
        ajax: '/presupuesto/getFuenF',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: false,
        ordering: false,
        select: true,
        destroy: true,
        responsive: true,
        bAutoWidth: true,
        dom: 'lBfrtip',
        buttons: [
            'excel'
        ],
        columnDefs: [
            {"targets": 0, "width": "2%", "className": "text-center"},
            {"targets": 1, "width": "5%", "className": "text-left"},
            {"targets": 2, "width": "5%", "className": "text-center"},
            {"targets": 3, "width": "3%", "className": "text-left"},
            {"targets": 4, "width": "3%", "className": "text-center"},
            {"targets": 5, "width": "3%", "className": "text-center"},
        ],

        columns: [
            {data: 'fFCod', name: 'fFCod'},
            {data: 'fFdesc', name: 'fFdesc'},
            {data: 'fFFecCrea', name: 'fFFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.fFEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.fFEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="obtenerFuenEdit(' + row.fFId + ')" TITLE="Editar Fuente Financiamiento" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Eliminar Fuente Financiamiento" onclick="eliminarfuen(' + row.fFId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Activar Fuente Financiamiento" onclick="eliminarfuen(' + row.fFId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            },

        ]
    })
}
function CargarConcepto(){
    $('#tabla_concepto').DataTable({
        ajax: '/presupuesto/getConcep',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: false,
        ordering: false,
        select: true,
        destroy: true,
        responsive: true,
        bAutoWidth: true,
        dom: 'lBfrtip',
        buttons: [
            'excel'
        ],
        columnDefs: [
            {"targets": 0, "width": "2%", "className": "text-left"},
            {"targets": 1, "width": "5%", "className": "text-center"},
            {"targets": 2, "width": "5%", "className": "text-left"},
            {"targets": 3, "width": "3%", "className": "text-center"},
            {"targets": 4, "width": "3%", "className": "text-center"},
        ],

        columns: [
            //{data: 'fFCod', name: 'fFCod'},
            {data: 'cDescripcion', name: 'cDescripcion'},
            {data: 'cFecCrea', name: 'cFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.cEstado) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.cEstado) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="obtenerConceptEdit(' + row.cId + ')" TITLE="Editar Concepto" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Eliminar Concepto" onclick="eliminarconcepto(' + row.cId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Activar Concepto" onclick="eliminarconcepto(' + row.cId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            },

        ]
    })
}
function CargarProgramaPresupuestal(){
    $('#tabla_PrograPres').DataTable({
        ajax: '/presupuesto/getProgPres',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: false,
        ordering: false,
        select: true,
        destroy: true,
        responsive: true,
        bAutoWidth: true,
        dom: 'lBfrtip',
        buttons: [
            'excel'
        ],
        columnDefs: [
            {"targets": 0, "width": "2%", "className": "text-center"},
            {"targets": 1, "width": "5%", "className": "text-left"},
            {"targets": 2, "width": "5%", "className": "text-center"},
            {"targets": 3, "width": "3%", "className": "text-left"},
            {"targets": 4, "width": "3%", "className": "text-center"},
            {"targets": 5, "width": "3%", "className": "text-center"},
        ],

        columns: [
            {data: 'pPCod', name: 'pPCod'},
            {data: 'pPDesc', name: 'pPDesc'},
            {data: 'pPFecCrea', name: 'pPFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.pPEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.pPEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="obtenerProgPresEdit(' + row.pPId + ')" TITLE="Editar Programa Presupuestal" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Eliminar Programa Presupuestal" onclick="eliminarProgPres(' + row.pPId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Activar Programa Presupuestal" onclick="eliminarProgPres(' + row.pPId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            },

        ]
    })
}
function CargarEspecificaGasto(){
    $('#tabla_EspecificaG').DataTable({
        ajax: '/presupuesto/getEspeG',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: false,
        ordering: false,
        select: true,
        destroy: true,
        responsive: true,
        bAutoWidth: true,
        dom: 'lBfrtip',
        buttons: [
            'excel'
        ],
        columnDefs: [
            {"targets": 0, "width": "2%", "className": "text-center"},
            {"targets": 1, "width": "10%", "className": "text-left"},
            {"targets": 2, "width": "3%", "className": "text-center"},
            {"targets": 3, "width": "2%", "className": "text-left"},
            {"targets": 4, "width": "2%", "className": "text-center"},
            {"targets": 5, "width": "2%", "className": "text-center"},
        ],

        columns: [
            {data: 'eGCod', name: 'eGCod'},
            {data: 'eGDesc', name: 'eGDesc'},
            {data: 'eGFecCrea', name: 'eGFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.eGEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.eGEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="obtenerEspGEdit(' + row.eGId + ')" TITLE="Editar Especifica de Gasto" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Eliminar Especifica de Gasto" onclick="eliminarEspG(' + row.eGId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Activar Especifica de Gasto" onclick="eliminarEspG(' + row.eGId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            },

        ]
    })
}
function valTipPedido() {
    var tip = $('#desctipo').val();
    var url = "/presupuesto/validarTipPedido/" + tip;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tip'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Tipo de pedido ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desctipo', 'validartipo', 'El Tipo de pedido ya fue registrado', 0);
                        if(result[0]['tEst']==0){
                            $('#idtip').val(result[0]['tId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Tipo de pedido ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exis=1;
                            $('#enviartipo').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desctipo', 'validartipo', 'Tipo de pedido correcto', 1);
                        $('#enviartipo').prop("disabled", false);
                        exis=0;
                    }
                }

            }, beforeSend() {
                $('#enviartipo').prop("disabled", true);
            }

        });
}
function valfuen() {
    var fuen = $('#descfuen').val();
    var url = "/presupuesto/validarFuenF/" + fuen;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['fuen'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La Fuente de Financiamiento ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('descfuen', 'validarfuen', 'La Fuente de Financiamiento ya fue registrado', 0);
                        if(result[0]['fFEst']==0){
                            $('#idfuen').val(result[0]['fFId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'La Fuente de Financiamiento ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exisff=1;
                            $('#enviarfuen').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('descfuen', 'validarfuen', 'Fuente de Financiamiento correcto', 1);
                        $('#enviarfuen').prop("disabled", false);
                        exisff=0;
                    }
                }

            }, beforeSend() {
                $('#enviarfuen').prop("disabled", true);
            }

        });
}
function valconcep() {
    var concep = $('#descconcep').val();
    var url = "/presupuesto/validarConcep/" + concep;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['concep'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Concepto ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('descconcep', 'validarconcep', 'El Concepto ya fue registrado', 0);
                        if(result[0]['cEstado']==0){
                            $('#idconcep').val(result[0]['cId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Concepto ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exisc=1;
                            $('#enviarconcep').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('descconcep', 'validarconcep', 'Concepto correcto', 1);
                        $('#enviarconcep').prop("disabled", false);
                        exisc=0;
                    }
                }

            }, beforeSend() {
                $('#enviarconcep').prop("disabled", true);
            }

        });
}

function valProgramaPres() {
    var codp = $('#codprog').val();
    var desp = $('#descprog').val();
    var url = "/presupuesto/validarProgPres/" + codp+"/"+desp;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['Prog'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Programa Presupuestal ya esta registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        validarCaja('descprog', 'validardescprog', 'El Programa Presupuestal ya fue registrado', 0);
                        if(result[0]['pPEst']==0){
                            $('#idprog').val(result[0]['pPId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Programa Presupuestal ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            exispp=1;
                            $('#enviarprogpres').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('descprog', 'validardescprog', 'Programa Presupuestal correcto', 1);
                        $('#enviarprogpres').prop("disabled", false);
                        exispp=0;
                    }
                }

            }, beforeSend() {
                $('#enviarprogpres').prop("disabled", true);
            }

        });
}
function valEspeG() {
    var codeg = $('#codespg').val();
    var deseg = $('#descespg').val();
    var url = "/presupuesto/validarEspeG/" + codeg+"/"+deseg;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['espg'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La Especifica de Gasto ya esta registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        validarCaja('descespg', 'validardescespg', 'La Especifica de Gasto ya fue registrado', 0);
                        if(result[0]['eGEst']==0){
                            $('#idespg').val(result[0]['eGId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'La Especifica de Gasto ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            exiseg=1;
                            $('#enviarespg').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('descespg', 'validardescespg', 'Especifica de Gasto correcto', 1);
                        $('#enviarespg').prop("disabled", false);
                        exiseg=0;
                    }
                }

            }, beforeSend() {
                $('#enviarespg').prop("disabled", true);
            }

        });
}
function valCodFin() {
    var codfin = $('#codfin').val();
    var url = "/presupuesto/validarFin/" + codfin;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['fin'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La Finalidad ya esta registrado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        validarCaja('codfin', 'validarcodfin', 'La Finalidad ya fue registrado', 0);
                        if(result[0]['fEst']==0){
                            $('#idfin').val(result[0]['fId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'La Finalidad ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            exisfin=1;
                            $('#enviarfin').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('codfin', 'validarcodfin', 'Finalidad correcto', 1);
                        $('#enviarfin').prop("disabled", false);
                        exisfin=0;
                    }
                }

            }, beforeSend() {
                $('#enviarfin').prop("disabled", true);
            }

        });
}
function enviarTipEdit() {
    if(validarFormularioTip()===0){
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
                var idtip = $('#idtip').val();
                var desctip = $('#desctipo').val();

                $.ajax({
                    url: '/presupuesto/editTipoPed',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtip: idtip,
                        desctip: desctip,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo de Pedido  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/presupuesto/datosgenerales');
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
                                redirect('/presupuesto/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarTipEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarFuenEdit() {
    if(validarFormularioFuen()===0){
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
                var idff = $('#idfuen').val();
                var descfuen = $('#descfuen').val();

                $.ajax({
                    url: '/presupuesto/editFuenF',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idff: idff,
                        descfuen: descfuen,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Fuente de Financiamiento  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/presupuesto/datosgenerales');
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
                                redirect('/presupuesto/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarFuenEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarConcepEdit() {
    if(validarFormularioConcep()===0){
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
                var idconcep = $('#idconcep').val();
                var descconcep = $('#descconcep').val();

                $.ajax({
                    url: '/presupuesto/editConcep',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idconcep: idconcep,
                        descconcep: descconcep,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Concepto  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/presupuesto/datosgenerales');
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
                                redirect('/presupuesto/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarConcepEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}

function enviarProgPEdit() {
    if(validarFormularioProgPres()===0){
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
                var idprog = $('#idprog').val();
                var codprog=$('#codprog').val();
                var descprog = $('#descprog').val();

                $.ajax({
                    url: '/presupuesto/editProgramaPres',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idprog: idprog,
                        codprog:codprog,
                        descprog: descprog,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Programa Presupuestal  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/presupuesto/datosgenerales');
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
                                redirect('/presupuesto/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarProgPEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarEspGEdit() {
    if(validarFormularioEspG()===0){
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
                var idespg = $('#idespg').val();
                var codespg=$('#codespg').val();
                var descespg = $('#descespg').val();

                $.ajax({
                    url: '/presupuesto/editEspeG',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idespg: idespg,
                        codespg:codespg,
                        descespg: descespg,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Especifica de Gasto  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/presupuesto/datosgenerales');
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
                                redirect('/presupuesto/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarEspGEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarFinEdit() {
    if(validarFormularioFin()===0){
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
                var idfin=$('#idfin').val();
                var codpro=$('#codpro').val();
                var descpro = $('#descpro').val();
                var codact=$('#codact').val();
                var descact = $('#descact').val();
                var codfin=$('#codfin').val();
                var descfin = $('#descfin').val();

                $.ajax({
                    url: '/presupuesto/editFin',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idfin:idfin,
                        codpro:codpro,
                        descpro: descpro,
                        codact:codact,
                        descact: descact,
                        codfin:codfin,
                        descfin: descfin,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Finalidad  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/presupuesto/datosgenerales');
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
                                redirect('/presupuesto/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarfinEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function cancelarprog(){
    $('#btngprog').prop("hidden",false);
    $('#btneprog').prop("hidden",true);
    $('#codprog').val("");
    $('#descprog').val("");
    $('#codprog').focus();
    exispp=0;
}
function cancelartip(){
    $('#btng').prop("hidden",false);
    $('#btne').prop("hidden",true);
    $('#desctipo').val("");
    $('#desctipo').focus();
    exis=0;
}
function cancelarfuen(){
    $('#btngff').prop("hidden",false);
    $('#btneff').prop("hidden",true);
    $('#descfuen').val("");
    $('#descfuen').focus();
    exisff=0;
}
function cancelarconcep(){
    $('#btngc').prop("hidden",false);
    $('#btnec').prop("hidden",true);
    $('#descconcep').val("");
    $('#descconcep').focus();
    exisc=0;
}
function cancelarespg(){
    $('#btngespg').prop("hidden",false);
    $('#btneespg').prop("hidden",true);
    $('#descespg').val("");
    $('#descespg').focus();
    exiseg=0;
}
function cancelarfin(){
    $('#btngfin').prop("hidden",false);
    $('#btnefin').prop("hidden",true);
    $('#codpro').val("");
    $('#descpro').val("");
    $('#codact').val("");
    $('#descact').val("");
    $('#codfin').val("");
    $('#descfin').val("");
    $('#codpro').focus();
    exiseg=0;
}
function enviarTip() {
    if(exis==1){
        var idtip=$('#idtip').val();
        eliminartipExis(idtip);
    }else{
        if(validarFormularioTip()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'Se agregara un nuevo registro',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar',
            }).then((result) => {
                if(result.value){
                    var destip = $('#desctipo').val();
                    var nfilas ="0"+$("#tabla_tipo tr").length;
                    $.ajax({
                        url: '/presupuesto/storetipo',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            destip: destip,
                            tcod:nfilas,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo de pedido exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarnot').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarFuen() {
    if(exisff==1){
        var idff=$('#idfuen').val();
        console.log(idff);
        eliminarfuenExis(idff);
    }else{
        if(validarFormularioFuen()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'Se agregara un nuevo registro',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar',
            }).then((result) => {
                if(result.value){
                    var desfuen = $('#descfuen').val();
                    var nfilas ="0"+$("#tabla_fuente tr").length;
                    $.ajax({
                        url: '/presupuesto/storefuente',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            desfuen: desfuen,
                            fFcod:nfilas,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Fuente de Financiamiento exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarfuen').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }

}
function enviarConcep() {
    if(exisc==1){
        var idc=$('#idconcep').val();
        console.log(idc);
        eliminarConcepExis(idc);
    }else{
        if(validarFormularioConcep()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'Se agregara un nuevo registro',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar',
            }).then((result) => {
                if(result.value){
                    var desconcep = $('#descconcep').val();
                    $.ajax({
                        url: '/presupuesto/storeConcep',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            desconcep: desconcep,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Concepto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarconcep').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }

}
function enviarProgPres(){
    if(exispp==1){
        var idpp=$('#idprog').val();
        console.log(idpp);
        eliminarProgExis(idpp);
    }else{
        if(validarFormularioProgPres()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'Se agregara un nuevo registro',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar',
            }).then((result) => {
                if(result.value){
                    var codprogpres=$('#codprog').val();
                    var descprogpres = $('#descprog').val();
                    $.ajax({
                        url: '/presupuesto/storeprogpres',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            codprogpres:codprogpres,
                            descprogpres: descprogpres,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Programa Presupuestal exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarprogpres').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarEspG(){
    if(exiseg==1){
        var ideg=$('#idespg').val();
        console.log(ideg);
        eliminarEspGExis(ideg);
    }else{
        if(validarFormularioEspG()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'Se agregara un nuevo registro',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar',
            }).then((result) => {
                if(result.value){
                    var codespg=$('#codespg').val();
                    var descespg = $('#descespg').val();
                    $.ajax({
                        url: '/presupuesto/storeEspeG',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            codespg:codespg,
                            descespg: descespg,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Especifica de Gasto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarespg').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarFin(){
    if(exisfin==1){
        var idfin=$('#idfin').val();
        eliminarFinExis(idfin);
    }else{
        if(validarFormularioFin()===0){
            Swal.fire({
                title: 'Esta seguro(a)?',
                text: 'Se agregara un nuevo registro',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto',
                cancelButtonText: 'no, cancelar',
            }).then((result) => {
                if(result.value){
                    var codpro=$('#codpro').val();
                    var descpro = $('#descpro').val();
                    var codact=$('#codact').val();
                    var descact = $('#descact').val();
                    var codfin=$('#codfin').val();
                    var descfin = $('#descfin').val();
                    $.ajax({
                        url: '/presupuesto/storeFin',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            codpro:codpro,
                            descpro: descpro,
                            codact:codact,
                            descact: descact,
                            codfin:codfin,
                            descfin: descfin,

                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Finalidad exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/presupuesto/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        type: 'error',
                                        title: 'ocurrio un error!',
                                        text: data['error'],
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#enviarfin').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function eliminartip(idtip) {
    var url = "/presupuesto/deletetip/" + idtip;
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarfuen(idff) {
    var url = "/presupuesto/deletefuen/" + idff;
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Fuente Financiamiento eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarconcepto(idc) {
    var url = "/presupuesto/deleteConcep/" + idc;
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Concepto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarfin(idfin) {
    var url = "/presupuesto/deleteFin/" + idfin;
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Finalidad eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminartipExis(idtip) {
    var url = "/presupuesto/deletetip/" + idtip;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se restaurara este registro',
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo de Pedido restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarfuenExis(idff) {
    var url = "/presupuesto/deletefuen/" + idff;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se restaurara este registro',
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Fuente de Financiamiento restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarConcepExis(idc) {
    var url = "/presupuesto/deleteConcep/" + idc;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se restaurara este registro',
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Concepto restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarProgExis(idprog) {
    var url = "/presupuesto/deleteProgPres/" + idprog;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se restaurara este registro',
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Programa Presupuestal restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarEspGExis(ideg) {
    var url = "/presupuesto/deleteEspeG/" + ideg;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se restaurara este registro',
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Especifica de Gasto restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarFinExis(idfin) {
    var url = "/presupuesto/deleteFin/" + idfin;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se restaurara este registro',
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Finalidad restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarProgPres(idPP) {
    var url = "/presupuesto/deleteProgPres/" + idPP;
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Programa Presupuestal eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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
function eliminarEspG(ideg) {
    var url = "/presupuesto/deleteEspeG/" + ideg;
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
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/presupuesto/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Especifica de Gasto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/presupuesto/datosgenerales');
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

function validarFormularioTip() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desctipo').val() !== '') {
        validarCaja('desctipo', 'validartipo', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del tipo de Pedido';
        validarCaja('desctipo', 'validartipo', text, 0);
    }
    return cont;
}
function validarFormularioFuen() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#descfuen').val() !== '') {
        validarCaja('descfuen', 'validarfuen', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion de la Fuente de Financiamiento';
        validarCaja('descfuen', 'validarfuen', text, 0);
    }
    return cont;
}
function validarFormularioConcep() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#descconcep').val() !== '') {
        validarCaja('descconcep', 'validarconcep', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del Concepto';
        validarCaja('descconcep', 'validarconcep', text, 0);
    }
    return cont;
}

function validarFormularioProgPres() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#codprog').val() !== '') {
        validarCaja('codprog', 'validarcodprog', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el codigo del programa presupuestal';
        validarCaja('codprog', 'validarcodprog', text, 0);
    }
    if ($('#descprog').val() !== '') {
        validarCaja('descprog', 'validardescprog', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del programa presupuestal';
        validarCaja('descprog', 'validardescprog', text, 0);
    }
    return cont;
}
function validarFormularioEspG() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#codespg').val() !== '') {
        validarCaja('codespg', 'validarcodespg', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el codigo de Especifica de Gasto';
        validarCaja('codespg', 'validarcodespg', text, 0);
    }
    if ($('#descespg').val() !== '') {
        validarCaja('descespg', 'validardescespg', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion de Especifica de Gasto';
        validarCaja('descespg', 'validardescespg', text, 0);
    }
    return cont;
}
function validarFormularioFin() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#codpro').val() !== '') {
        validarCaja('codpro', 'validarcodpro', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el codigo del producto';
        validarCaja('codpro', 'validarcodpro', text, 0);
    }
    if ($('#descpro').val() !== '') {
        validarCaja('descpro', 'validardescpro', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del producto';
        validarCaja('descpro', 'validardescpro', text, 0);
    }
    if ($('#codact').val() !== '') {
        validarCaja('codact', 'validarcodact', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el codigo de la actividad';
        validarCaja('codact', 'validarcodact', text, 0);
    }
    if ($('#descact').val() !== '') {
        validarCaja('descact', 'validardescact', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion de la actividad';
        validarCaja('descact', 'validardescact', text, 0);
    }
    if ($('#codfin').val() !== '') {
        validarCaja('codfin', 'validarcodfin', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el codigo de finalidad';
        validarCaja('codfin', 'validarcodfin', text, 0);
    }
    if ($('#descfin').val() !== '') {
        validarCaja('descfin', 'validardescfin', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion de finalidad';
        validarCaja('descfin', 'validardescfin', text, 0);
    }
    return cont;
}

