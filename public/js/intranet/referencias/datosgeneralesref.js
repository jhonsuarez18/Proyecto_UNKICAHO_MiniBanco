var exisdoc=0;
var existips=0;
var exisplaz=0;
var exisestp=0;
var existipp=0;
var exisof=0;
var exisenti=0;
var existipd=0;
var existipg=0;
var exisgast=0;
var exiscie=0;
var existipdg=0;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
CargarPlazo(0);
tabla_tipdoc();
tabla_tipgas();
tabla_gastos();
tabla_Cie10();
tabla_TipDG();
CargarTipoGas('tipgas',0);
});
$(function () {
    $('#tabla_documento').DataTable({
            ajax: '/referencia/getDoc',
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
                {"targets": 0, "width": "20%", "className": "text-left"},
                {"targets": 1, "width": "20%", "className": "text-left"},
                {"targets": 2, "width": "10%", "className": "text-center"},
                {"targets": 3, "width": "10%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},
                {"targets": 5, "width": "5%", "className": "text-center"},
            ],

            columns: [
                {data: 'dTitulo', name: 'dTitulo'},
                {data: 'dDescripcion', name: 'dDescripcion'},
                {data: 'dFecCrea', name: 'dFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.dEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.dEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerDocEdit(' + row.dId + ')" TITLE="Editar Documento" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Documento" onclick="eliminarDoc(' + row.dId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Documento" onclick="eliminarDoc(' + row.dId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
$(function () {
    $('#tabla_tipseguro').DataTable({
            ajax: '/referencia/getTipS',
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
                {"targets": 0, "width": "20%", "className": "text-left"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "5%", "className": "text-left"},
                {"targets": 3, "width": "3%", "className": "text-center"},
                {"targets": 4, "width": "3%", "className": "text-center"},

            ],

            columns: [
                {data: 'tSDescrip', name: 'tSDescrip'},
                {data: 'tSFecCrea', name: 'tSFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.tSEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tSEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipSEdit(' + row.tSId + ')" TITLE="Editar Tipo de Seguro" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Tipo de Seguro" onclick="eliminarTipS(' + row.tSId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Tipo de Seguro" onclick="eliminarTipS(' + row.tSId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
$(function () {
    $('#tabla_plazo').DataTable({
            ajax: '/referencia/getPlazos',
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
                {data: 'pCantDia', name: 'pCantDia'},
                {data: 'pFecCrea', name: 'pFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.pEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerPlazoEdit(' + row.pId + ')" TITLE="Editar Plazo" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Plazo" onclick="eliminarPlazo(' + row.pId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Plazo" onclick="eliminarPlazo(' + row.pId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
$(function () {
    $('#tabla_estadop').DataTable({
            ajax: '/referencia/getEstp',
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
                {data: 'ePDescripcion', name: 'ePDescripcion'},
                {data: 'ePFecCrea', name: 'ePFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.ePEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.ePEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerEstPEdit(' + row.ePId + ')" TITLE="Editar Estado Paciente" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Estado Paciente" onclick="eliminarEstP(' + row.ePId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Estado Paciente" onclick="eliminarEstP(' + row.ePId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
$(function () {
    $('#tabla_TipoP').DataTable({
            ajax: '/referencia/getTipP',
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
                {"targets": 1, "width": "5%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "3%", "className": "text-left"},
                {"targets": 4, "width": "3%", "className": "text-center"},
                {"targets": 5, "width": "3%", "className": "text-center"},

            ],

            columns: [
                {data: 'tPDescripcion', name: 'tPDescripcion'},
                {data: 'tPAbreviatura', name: 'tPAbreviatura'},
                {data: 'tPFecCrea', name: 'tPFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.tPEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tPEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipPEdit(' + row.tPId + ')" TITLE="Editar Tipo Personal" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Tipo Personal" onclick="eliminarTipP(' + row.tPId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Tipo Personal" onclick="eliminarTipP(' + row.tPId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
$(function () {
    $('#tabla_Oficina').DataTable({
            ajax: '/referencia/getOfic',
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
                {"targets": 0, "width": "25%", "className": "text-left"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "3%", "className": "text-center"},
                {"targets": 4, "width": "3%", "className": "text-center"},

            ],

            columns: [
                {data: 'oNombre', name: 'oNombre'},
                {data: 'pCantDia', name: 'pCantDia'},
                {data: 'oFecCrea', name: 'oFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.oEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.oEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerOficEdit(' + row.oId + ')" TITLE="Editar Oficina" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Oficina" onclick="eliminarOfic(' + row.oId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Oficina" onclick="eliminarOfic(' + row.oId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
$(function () {
    $('#tabla_entidad').DataTable({
            ajax: '/referencia/getEnti',
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
                {"targets": 0, "width": "25%", "className": "text-left"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "3%", "className": "text-center"},

            ],

            columns: [
                {data: 'eDesc', name: 'eDesc'},
                {data: 'eFecCrea', name: 'eFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.eEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.eEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerEntiEdit(' + row.eId + ')" TITLE="Editar Entidad" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Entidad" onclick="eliminarEnti(' + row.eId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Entidad" onclick="eliminarEnti(' + row.eId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
});
function tabla_tipdoc(){
    $('#tabla_TipDoc').DataTable({
            ajax: '/referencia/getTipDoc',
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
                {"targets": 0, "width": "25%", "className": "text-left"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "3%", "className": "text-center"},

            ],

            columns: [
                {data: 'tDDes', name: 'tDDes'},
                {data: 'tDFecCrea', name: 'tDFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.tDEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tDEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipDocEdit(' + row.tDId + ')" TITLE="Editar Entidad" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Entidad" onclick="eliminarTipDoc(' + row.tDId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Entidad" onclick="eliminarTipDoc(' + row.tDId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
}
function tabla_tipgas(){
    $('#tabla_TipGas').DataTable({
            ajax: '/referencia/getTipGas',
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
                {"targets": 0, "width": "25%", "className": "text-left"},
                {"targets": 1, "width": "5%", "className": "text-center"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "3%", "className": "text-center"},

            ],

            columns: [
                {data: 'tGDesc', name: 'tGDesc'},
                {data: 'tGFecCrea', name: 'tGFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.tGEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tGEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipGasEdit(' + row.tGId + ')" TITLE="Editar Tipo de Gasto" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Tipo de Gasto" onclick="eliminarTipGas(' + row.tGId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Tipo de Gasto" onclick="eliminarTipGas(' + row.tGId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
}
function tabla_gastos(){
    $('#tabla_Gasto').DataTable({
            ajax: '/referencia/getGast',
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
                {"targets": 0, "width": "35%", "className": "text-left"},
                {"targets": 1, "width": "25%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},

            ],

            columns: [
                {data: 'gDesc', name: 'gDesc'},
                {data: 'tGDesc', name: 'tGDesc'},
                {data: 'gCosDia', name: 'gCosDia'},
                {data: 'gFecCrea', name: 'gFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.gEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.gEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerGastEdit(' + row.gId + ')" TITLE="Editar Gasto" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Gasto" onclick="eliminarGast(' + row.gId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Gasto" onclick="eliminarGast(' + row.gId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
}
function tabla_Cie10(){
    $('#tabla_cie10').DataTable({
            ajax: '/referencia/getCie',
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
                {"targets": 0, "width": "20%", "className": "text-left"},
                {"targets": 1, "width": "40%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},

            ],

            columns: [
                {data: 'cCodigo', name: 'cCodigo'},
                {data: 'cDescripcion', name: 'cDescripcion'},
                {data: 'cFecCrea', name: 'cFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.cEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.cEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerCie10Edit(' + row.cId + ')" TITLE="Editar Cie10" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Cie10" onclick="eliminarCie10(' + row.cId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Cie10" onclick="eliminarCie10(' + row.cId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
}
function tabla_TipDG(){
    $('#tabla_tipdg').DataTable({
            ajax: '/referencia/getTipDG',
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
                {"targets": 0, "width": "20%", "className": "text-left"},
                {"targets": 1, "width": "40%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},

            ],

            columns: [
                {data: 'tDDes', name: 'tDDes'},
                {data: 'gDesc', name: 'gDesc'},
                {data: 'tDGFecCrea', name: 'tDGFecCrea'},
                // {data: 'Usuario', name: 'Usuario'},
                {
                    data: function (row) {
                        return parseInt(row.tDGEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tDGEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipDGEdit(' + row.tDGId + ')" TITLE="Editar Tipo documento gasto" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Tipo documento" onclick="eliminarTipDG(' + row.tDGId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Tipo documento gasto" onclick="eliminarTipDG(' + row.tDGId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );
}
function enviarDoc() {
    if(exisdoc==1){
        var iddoc=$('#iddoc').val();
        eliminartipmExis(iddoc);
    }else{
        if(validarFormularioDoc()===0){
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
                    var titdoc = $('#titdoc').val();
                    var desdoc = $('#descdoc').val();
                    $.ajax({
                        url: '/referencia/storeDoc',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            titdoc: titdoc,
                            desdoc: desdoc,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Documento exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviardoc').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarTipS() {
    if(existips==1){
        var iddoc=$('#idtips').val();
        eliminartipsExis(iddoc);
    }else{
        if(validarFormularioTipS()===0){
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
                    var destips = $('#desctips').val();
                    $.ajax({
                        url: '/referencia/storeTipS',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            destips: destips,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo de Seguro exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviartips').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarPlazo() {
    if(exisplaz==1){
        var idplaz=$('#idplazo').val();
        eliminarPlazExis(idplaz);
    }else{
        if(validarFormularioPlazo()===0){
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
                    var cantd = $('#cantd').val();
                    $.ajax({
                        url: '/referencia/storePlazo',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            cantd: cantd,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Plazo exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviarplazo').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarEstP() {
    if(exisestp==1){
        var idestp=$('#idestpac').val();
        eliminarEstPExis(idestp);
    }else{
        if(validarFormularioEstP()===0){
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
                    var desestp = $('#desestp').val();
                    $.ajax({
                        url: '/referencia/storeEstp',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            desestp: desestp,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Estado de Paciente exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviarestp').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarTipP() {
    if(existipp==1){
        var idtipp=$('#idtipp').val();
        eliminarTipPExis(idtipp);
    }else{
        if(validarFormularioTipP()===0){
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
                    var destipp = $('#destipp').val();
                    var abretipp = $('#abretipp').val();
                    $.ajax({
                        url: '/referencia/storeTipP',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            destipp: destipp,
                            abretipp: abretipp,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo de Personal exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviartipp').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarOfic() {
    if(exisof==1){
        var idofic=$('#idofic').val();
        eliminarOficExis(idofic);
    }else{
        if(validarFormularioOfic()===0){
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
                    var nomofic = $('#nomofic').val();
                    var idplaz = $('#plazo').val();
                    $.ajax({
                        url: '/referencia/storeOfic',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                           nomofic: nomofic,
                            idplaz: idplaz,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Oficina exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviarofic').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarEnti() {
    if(exisenti==1){
        var identi=$('#identi').val();
        eliminarEntiExis(identi);
    }else{
        if(validarFormularioEnti()===0){
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
                    var nomenti = $('#nomenti').val();
                    $.ajax({
                        url: '/referencia/storeEnti',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            nomenti: nomenti,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/referencia/datosgeneralesref');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Entidad exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    redirect('/referencia/datosgeneralesref');
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

                        ,
                        beforeSend: function () {
                            $('#enviarenti').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarTipDoc() {
    if(existipd==1){
        var idtipd=$('#idtipd').val();
        eliminarTipdExis(idtipd);
    }else{
        if(validarFormularioTipDoc()===0){
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
                    var desctipd = $('#desctipd').val();
                    $.ajax({
                        url: '/referencia/storeTipDoc',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            desctip: desctipd,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    tabla_tipdoc();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo Gasto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    tabla_tipdoc();
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

                        ,
                        beforeSend: function () {
                            $('#enviartipdoc').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarTipGas() {
    if(existipg==1){
        var idtipg=$('#idtipg').val();
        eliminarTipgExis(idtipg);
    }else{
        if(validarFormularioTipGas()===0){
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
                    var desctipg = $('#desctipg').val();
                    $.ajax({
                        url: '/referencia/storeTipGas',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            desctipg: desctipg,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    tabla_tipgas();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo de Gasto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    tabla_tipgas();
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

                        ,
                        beforeSend: function () {
                            $('#enviartipgas').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarGas() {
    if(exisgast==1){
        var idgast=$('#idgast').val();
        eliminarGastExis(idgast);
    }else{
        valdescgast();
        if(validarFormularioGasto()===0){
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
                    var descgast = $('#descgast').val();
                    var idtipgas = $('#tipgas').val();
                    var cosdia = $('#cosdia').val();
                    $.ajax({
                        url: '/referencia/storeGast',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            descgast: descgast,
                            idtipg: idtipgas,
                            cosdia: cosdia,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    tabla_gastos();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Gasto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    tabla_gastos();
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

                        ,
                        beforeSend: function () {
                            $('#enviartipgas').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarCie() {
    if(exiscie==1){
        var idcie=$('#idcie').val();
        eliminarCieExis(idcie);
    }else{
        valdesccie();
        if(validarFormularioCie10()===0){
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
                    var codcie = $('#codcie').val();
                    var desccie = $('#desccie').val();
                    $.ajax({
                        url: '/referencia/storeCie',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            codcie: codcie,
                            desccie: desccie,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    tabla_Cie10();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Cie10 exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    tabla_Cie10();
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

                        ,
                        beforeSend: function () {
                            $('#enviarcie').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarTipDG() {
    if(existipdg==1){
        var idtipdg=$('#idtipdg').val();
        eliminarTipDGExis(idtipdg);
    }else{
        valTipDG();
        if(validarFormularioTipDG()===0){
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
                    var idtipd = $('#tipdoc').val();
                    var idgast = $('#gasto').val();
                    $.ajax({
                        url: '/referencia/storeTipDG',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            idtipd: idtipd,
                            idgas: idgast,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    tabla_TipDG();
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo documento gasto exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    tabla_TipDG();
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

                        ,
                        beforeSend: function () {
                            $('#enviartipdg').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarDocEdit() {
    if(validarFormularioDoc()===0){
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
                var iddoc = $('#iddoc').val();
                var titdoc = $('#titdoc').val();
                var descdoc = $('#descdoc').val();

                $.ajax({
                    url: '/referencia/editDoc',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        iddoc: iddoc,
                        titdoc: titdoc,
                        descdoc:descdoc,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Documento  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviarDocEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarTipSEdit() {
    if(validarFormularioTipS()===0){
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
                var idtips = $('#idtips').val();
                var desctips = $('#desctips').val();

                $.ajax({
                    url: '/referencia/editTipS',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtips: idtips,
                        desctips:desctips,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo de Seguro  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviartipsEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarPlazoEdit() {
    if(validarFormularioPlazo()===0){
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
                var idplaz = $('#idplazo').val();
                var cantd = $('#cantd').val();

                $.ajax({
                    url: '/referencia/editPlazo',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idplaz: idplaz,
                        cantd:cantd,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Plazo  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviarplazoEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarEstPEdit() {
    if(validarFormularioEstP()===0){
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
                var idestp = $('#idestpac').val();
                var desestp = $('#desestp').val();

                $.ajax({
                    url: '/referencia/editEstp',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idestp: idestp,
                        desestp:desestp,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Estado de Paciente  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviarestpEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarTipPEdit() {
    if(validarFormularioTipP()===0){
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
                var idtipp = $('#idtipp').val();
                var destipp = $('#destipp').val();
                var abretipp = $('#abretipp').val();

                $.ajax({
                    url: '/referencia/editTipP',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipp: idtipp,
                        destipp:destipp,
                        abretipp:abretipp,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo de Personal  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviartippEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarOficEdit() {
    if(validarFormularioOfic()===0){
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
                var idofic = $('#idofic').val();
                var nomofic = $('#nomofic').val();
                var idplaz = $('#plazo').val();

                $.ajax({
                    url: '/referencia/editOfic',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idofic: idofic,
                        idplaz:idplaz,
                        nomofic:nomofic,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Oficina  Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviaroficEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarEntiEdit() {
    if(validarFormularioEnti()===0){
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
                var identi = $('#identi').val();
                var nomenti = $('#nomenti').val();

                $.ajax({
                    url: '/referencia/editEnti',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        identi: identi,
                        nomenti:nomenti,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Entidad  Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/referencia/datosgeneralesref');
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
                                redirect('/referencia/datosgeneralesref');

                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviarentiedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarTipDocEdit() {
    if(validarFormularioTipDoc()===0){
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
                var idtipd = $('#idtipd').val();
                var desctipd = $('#desctipd').val();

                $.ajax({
                    url: '/referencia/editTipDoc',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipdoc: idtipd,
                        desctip:desctipd,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo Documento  Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                tabla_tipdoc();
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
                                tabla_tipdoc();
                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviartipdocedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarTipGasEdit() {
    if(validarFormularioTipGas()===0){
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
                var idtipg = $('#idtipg').val();
                var desctipg = $('#desctipg').val();

                $.ajax({
                    url: '/referencia/editTipGas',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipgas: idtipg,
                        desctipg:desctipg,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo Gasto Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                tabla_tipgas();
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
                                tabla_tipgas();
                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviartipgasedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarGasEdit() {
    if(validarFormularioGasto()===0){
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
                var idgast = $('#idgast').val();
                var descgast = $('#descgast').val();
                var idtipg = $('#tipgas').val();
                var cosdia = $('#cosdia').val();

                $.ajax({
                    url: '/referencia/editGast',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idgast: idgast,
                        descgas:descgast,
                        idtipg: idtipg,
                        cosdia:cosdia,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Gasto Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                tabla_gastos();
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
                                tabla_gastos();
                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviargasedit').prop("disabled", false);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarCieEdit() {
    if(validarFormularioCie10()===0){
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
                var idcie = $('#idcie').val();
                var codcie = $('#codcie').val();
                var desccie = $('#desccie').val();

                $.ajax({
                    url: '/referencia/editCie',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idcie: idcie,
                        codcie:codcie,
                        desccie: desccie,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Cie10 Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                tabla_Cie10();
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
                                tabla_Cie10();
                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviarcieedit').prop("disabled", false);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarTipDGEdit() {
    if(validarFormularioTipDG()===0){
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
                var idtipdg = $('#idtipdg').val();
                var idtipd = $('#tipdoc').val();
                var idgast = $('#gasto').val();

                $.ajax({
                    url: '/referencia/editTipDG',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtdg: idtipdg,
                        idtipd:idtipd,
                        idgas: idgast,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo documento gasto Editado Correctamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                tabla_TipDG();
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
                                tabla_TipDG();
                            }

                        }
                    ,
                    beforeSend: function () {
                        $('#enviartipdgedit').prop("disabled", false);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function obtenerDocEdit(val){
    $('#btngdoc').prop("hidden", true);
    $('#btnedoc').prop("hidden", false);
    var url = "/referencia/getDocEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#iddoc').val(data['dId']);
                $('#titdoc').val(data['dTitulo']);
                $('#descdoc').val(data['dDescripcion']);
                $('#titdoc').focus();
            }

        });
}
function obtenerTipSEdit(val){
    $('#btngtips').prop("hidden", true);
    $('#btnetips').prop("hidden", false);
    var url = "/referencia/getTipSEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtips').val(data['tSId']);
                $('#desctips').val(data['tSDescrip']);
                $('#desctips').focus();
            }

        });
}
function obtenerPlazoEdit(val){
    $('#btngplazo').prop("hidden", true);
    $('#btneplazo').prop("hidden", false);
    var url = "/referencia/getPlazoEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idplazo').val(data['pId']);
                $('#cantd').val(data['pCantDia']);
                $('#cantd').focus();
            }

        });
}
function obtenerEstPEdit(val){
    $('#btngestp').prop("hidden", true);
    $('#btneestp').prop("hidden", false);
    var url = "/referencia/getEstpEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idestpac').val(data['ePId']);
                $('#desestp').val(data['ePDescripcion']);
                $('#desestp').focus();
            }

        });
}
function obtenerTipPEdit(val){
    $('#btngtipp').prop("hidden", true);
    $('#btnetipp').prop("hidden", false);
    var url = "/referencia/getTipPEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtipp').val(data['tPId']);
                $('#destipp').val(data['tPDescripcion']);
                $('#abretipp').val(data['tPAbreviatura']);
                $('#destipp').focus();
            }

        });
}
function obtenerOficEdit(val){
    $('#btngofic').prop("hidden", true);
    $('#btneofic').prop("hidden", false);
    var url = "/referencia/getOficEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idofic').val(data['oId']);
                $('#nomofic').val(data['oNombre']);
                CargarPlazo(data['pId']);
                $('#nomofic').focus();
            }

        });
}
function obtenerEntiEdit(val){
    $('#btngenti').prop("hidden", true);
    $('#btneenti').prop("hidden", false);
    var url = "/referencia/getEntiEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#identi').val(data['eId']);
                $('#nomenti').val(data['eDesc']);
                $('#nomenti').focus();
            }

        });
}
function obtenerTipDocEdit(val){
    $('#btngtipd').prop("hidden", true);
    $('#btnetipd').prop("hidden", false);
    var url = "/referencia/getTipDocEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtipd').val(data['tDId']);
                $('#desctipd').val(data['tDDes']);
                $('#desctipd').focus();
            }

        });
}
function obtenerTipGasEdit(val){
    $('#btngtipg').prop("hidden", true);
    $('#btnetipg').prop("hidden", false);
    var url = "/referencia/getTipGasEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtipg').val(data['tGId']);
                $('#desctipg').val(data['tGDesc']);
                $('#desctipg').focus();
            }

        });
}
function obtenerGastEdit(val){
    $('#btnggas').prop("hidden", true);
    $('#btnegas').prop("hidden", false);
    var url = "/referencia/getGastEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idgast').val(data['gId']);
                $('#descgast').val(data['gDesc']);
                $('#cosdia').val(data['gCosDia']);
                $('#descgast').focus();
                CargarTipoGas('tipgas',data['tGId']);
            }

        });
}
function obtenerCie10Edit(val){
    $('#btngcie').prop("hidden", true);
    $('#btnecie').prop("hidden", false);
    var url = "/referencia/getCieEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idcie').val(data['cId']);
                $('#codcie').val(data['cCodigo']);
                $('#desccie').val(data['cDescripcion']);
                $('#codcie').focus();
            }

        });
}
function obtenerTipDGEdit(val){
    $('#btngtipdg').prop("hidden", true);
    $('#btnetipdg').prop("hidden", false);
    var url = "/referencia/getTipDGEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtipdg').val(data['tDGId']);
                $('#tipdoc').focus();
            }

        });
}
function cancelarDoc(){
    $('#btngdoc').prop("hidden",false);
    $('#btnedoc').prop("hidden",true);
    $('#titdoc').val("");
    $('#descdoc').val("");
    $('#titdoc').focus();
    exisdoc=0;
}
function cancelarTipS(){
    $('#btngtips').prop("hidden",false);
    $('#btnetips').prop("hidden",true);
    $('#desctips').val("");
    $('#desctips').focus();
    existips=0;
}
function cancelarPlazo(){
    $('#btngplazo').prop("hidden",false);
    $('#btneplazo').prop("hidden",true);
    $('#cantd').val("");
    $('#cantd').focus();
    exisplaz=0;
}
function cancelarEstP(){
    $('#btngestp').prop("hidden",false);
    $('#btneestp').prop("hidden",true);
    $('#desestp').val("");
    $('#desestp').focus();
    exisestp=0;
}
function cancelarTipP(){
    $('#btngtipp').prop("hidden",false);
    $('#btnetipp').prop("hidden",true);
    $('#destipp').val("");
    $('#abretipp').val("");
    $('#destipp').focus();
    existipp=0;
}
function cancelarOfic(){
    $('#btngofic').prop("hidden",false);
    $('#btneofic').prop("hidden",true);
    $('#nomofic').val("");
    $('#plazo').val("");
    $('#nomofic').focus();
    exisofic=0;
}
function cancelarEnti(){
    $('#btngenti').prop("hidden",false);
    $('#btneenti').prop("hidden",true);
    $('#nomenti').val("");
    $('#nomenti').focus();
    exisenti=0;
}
function cancelarTipDoc(){
    $('#btngtipd').prop("hidden",false);
    $('#btnetipd').prop("hidden",true);
    $('#desctipd').val("");
    $('#desctipd').focus();
    existipd=0;
}
function cancelarTipGas(){
    $('#btngtipg').prop("hidden",false);
    $('#btnetipg').prop("hidden",true);
    $('#desctipg').val("");
    $('#desctipg').focus();
    existipg=0;
}
function cancelarGas(){
    $('#btnggas').prop("hidden",false);
    $('#btnegas').prop("hidden",true);
    $('#descgast').val("");
    $('#cosdia').val("");
    $('#tipgas').val(0);
    $('#descgast').focus();
    exisgast=0;
}
function cancelarCie(){
    $('#btngcie').prop("hidden",false);
    $('#btnecie').prop("hidden",true);
    $('#codcie').val("");
    $('#desccie').val("");
    $('#codcie').focus();
    exiscie=0;
}
function cancelarTipDG(){
    $('#btngtipdg').prop("hidden",false);
    $('#btnetipdg').prop("hidden",true);
    $('#tipdoc').val(0);
    $('#gasto').val(0);
    $('#tipdoc').focus();
    existipdg=0;
}
function eliminarDoc(iddoc) {
    var url = "/referencia/deleteDoc/" + iddoc;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Documento eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarTipS(idtips) {
    var url = "/referencia/deleteTipS/" + idtips;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo de Seguro eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarPlazo(idplaz) {
    var url = "/referencia/deletePlazo/" + idplaz;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Plazo eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarEstP(idestp) {
    var url = "/referencia/deleteEstp/" + idestp;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Estado de Paciente eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarTipP(idtipp) {
    var url = "/referencia/deleteTipP/" + idtipp;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo de Personal eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarOfic(idofic) {
    var url = "/referencia/deleteOfic/" + idofic;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Oficina eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarEnti(identi) {
    var url = "/referencia/deleteEnti/" + identi;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entidad eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarTipDoc(idtipd) {
    var url = "/referencia/deleteTipDoc/" + idtipd;
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
                            tabla_tipdoc();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entidad eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_tipdoc();
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
function eliminarTipGas(idtipg) {
    var url = "/referencia/deleteTipGas/" + idtipg;
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
                            tabla_tipgas();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo Gasto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_tipgas();
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
function eliminarGast(idgast) {
    var url = "/referencia/deleteGast/" + idgast;
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
                            tabla_gastos();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Gasto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_gastos();
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
function eliminarCie10(idcie) {
    var url = "/referencia/deleteCie/" + idcie;
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
                            tabla_Cie10();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Cie10 eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_Cie10();
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
function eliminarTipDG(idtdg) {
    var url = "/referencia/deleteTipDG/" + idtdg;
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
                            tabla_TipDG();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo documento gasto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_TipDG();
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
function valdescriptips() {
    var destips = $('#desctips').val();
    var url = "/referencia/validarTipSeguro/" + destips;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tips'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Tipo de Seguro ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desctips', 'validardesctips', 'El Tipo de Seguro ya fue registrado', 0);
                        if(result[0]['tSEst']==0){
                            $('#idtips').val(result[0]['tSId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Tipo de Seguro ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            existips=1;
                            $('#enviartips').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desctips', 'validardesctips', 'Tipo de Seguro correcto', 1);
                        $('#enviartips').prop("disabled", false);
                        existips=0;
                    }
                }

            }, beforeSend() {
                $('#enviartips').prop("disabled", true);
            }

        });
}
function valcantd() {
    var cantd = $('#cantd').val();
    var url = "/referencia/validarPlazo/" + cantd;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['plaz'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Plazo ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('cantd', 'validarcantd', 'El Plazo ya fue registrado', 0);
                        if(result[0]['pEst']==0){
                            $('#idplazo').val(result[0]['pId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Plazo ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            existips=1;
                            $('#enviarplazo').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('cantd', 'validarcantd', 'Plazo correcto', 1);
                        $('#enviarplazo').prop("disabled", false);
                        existips=0;
                    }
                }

            }, beforeSend() {
                $('#enviarplazo').prop("disabled", true);
            }

        });
}
function valdesestp() {
    var desestp = $('#desestp').val();
    var url = "/referencia/validarEstp/" + desestp;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['estp'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Estado de Paciente ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desestp', 'validardesestp', 'El Estado de Paciente ya fue registrado', 0);
                        if(result[0]['ePEst']==0){
                            $('#idestpac').val(result[0]['ePId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Estado de Paciente ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exisestp=1;
                            $('#enviarestp').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desestp', 'validardesestp', 'Estado de Paciente correcto', 1);
                        $('#enviarestp').prop("disabled", false);
                        exisestp=0;
                    }
                }

            }, beforeSend() {
                $('#enviarestp').prop("disabled", true);
            }

        });
}
function valnomofic() {
    var nomofic = $('#nomofic').val();
    var url = "/referencia/validarOfic/" + nomofic;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['ofic'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La Oficina ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('nomofic', 'validarnomofic', 'La oficina ya fue registrado', 0);
                        if(result[0]['oEst']==0){
                            $('#idofic').val(result[0]['oId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'La oficina ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exisof=1;
                            $('#enviarofic').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('nomofic', 'validarnomofic', 'Nombre de Oficina correcto', 1);
                        $('#enviarofic').prop("disabled", false);
                        exisof=0;
                    }
                }

            }, beforeSend() {
                $('#enviarofic').prop("disabled", true);
            }

        });
}
function valnomenti() {
    var nomenti = $('#nomenti').val();
    var url = "/referencia/validarEnti/" + nomenti;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['enti'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La Entidad ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('nomenti', 'validnomenti', 'La entidad ya fue registrado', 0);
                        if(result[0]['eEst']==0){
                            $('#identi').val(result[0]['eId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'La entidad ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exisof=1;
                            $('#enviarenti').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('nomenti', 'validnomenti', 'Nombre de Entidad correcto', 1);
                        $('#enviarenti').prop("disabled", false);
                        exisenti=0;
                    }
                }

            }, beforeSend() {
                $('#enviarenti').prop("disabled", true);
            }

        });
}
function valdesctipdoc() {
    var destipd = $('#desctipd').val();
    var url = "/referencia/validarTipDoc/" + destipd;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tipdoc'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Tipo de Documento ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desctipd', 'valdesctipd', 'El tipo de documento ya fue registrado', 0);
                        if(result[0]['tDEst']==0){
                            $('#identi').val(result[0]['Id']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El tipo de documento ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            existipd=1;
                            $('#enviartipdoc').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desctipd', 'valdesctipd', 'Tipo de documento correcto', 1);
                        $('#enviartipdoc').prop("disabled", false);
                        existipd=0;
                    }
                }

            }, beforeSend() {
                $('#enviartipdoc').prop("disabled", true);
            }

        });
}
function valdesctipgas() {
    var destipg = $('#desctipg').val();
    var url = "/referencia/validarTipGas/" + destipg;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tipgas'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Tipo de Gasto ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desctipg', 'valdesctipg', 'El tipo de gasto ya fue registrado', 0);
                        if(result[0]['tGEst']==0){
                            $('#idtipg').val(result[0]['tGId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El tipo de Gasto ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            existipg=1;
                            $('#enviartipgas').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desctipg', 'valdesctipg', 'Tipo de gasto correcto', 1);
                        $('#enviartipgas').prop("disabled", false);
                        existipg=0;
                    }
                }

            }, beforeSend() {
                $('#enviartipgas').prop("disabled", true);
            }

        });
}
function valdescgast() {
    var desgast = $('#descgast').val();
    var url = "/referencia/validarGast/" + desgast;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['gast'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Gasto ya registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('descgast', 'valdescgast', 'Gasto ya registrado', 0);
                        if(result[0]['gEst']==0){
                            $('#idgast').val(result[0]['gId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Gasto ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exisgast=1;
                            $('#enviargas').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('descgast', 'valdescgast', 'Gasto correcto', 1);
                        $('#enviargas').prop("disabled", false);
                        exisgast=0;
                    }
                }

            }, beforeSend() {
                $('#enviargas').prop("disabled", true);
            }

        });
}
function valdesccie() {
    var desccie = $('#desccie').val();
    var url = "/referencia/validarCie/" + desccie;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['cie'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Cie10 ya registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desccie', 'valdesccie', 'Cie10 ya registrado', 0);
                        if(result[0]['cEst']==0){
                            $('#idcie').val(result[0]['cId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Cie10 ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            exiscie=1;
                            $('#enviarcie').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desccie', 'valdesccie', 'Cie10 correcto', 1);
                        $('#enviarcie').prop("disabled", false);
                        exiscie=0;
                    }
                }

            }, beforeSend() {
                $('#enviarcie').prop("disabled", true);
            }

        });
}
function eliminartipsExis(idtips) {
    var url = "/referencia/deleteTipS/" + idtips;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo de Seguro restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarPlazExis(idplaz) {
    var url = "/referencia/deletePlazo/" + idplaz;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Plazo restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarEstPExis(idestp) {
    var url = "/referencia/deleteEstp/" + idestp;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Estado de Paciente restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarOficExis(idofic) {
    var url = "/referencia/deleteOfic/" + idofic;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Oficina restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarEntiExis(identi) {
    var url = "/referencia/deleteEnti/" + identi;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entidad restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarTipdExis(idtipd) {
    var url = "/referencia/deleteTipDoc/" + idtipd;
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
                            redirect('/referencia/datosgeneralesref');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entidad restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/datosgeneralesref');
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
function eliminarTipgExis(idtipg) {
    var url = "/referencia/deleteTipGas/" + idtipg;
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
                            tabla_tipgas();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entidad restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_tipgas();
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
function eliminarGastExis(idgast) {
    var url = "/referencia/deleteGast/" + idgast;
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
                            tabla_gastos();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Gasto restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_gastos();
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
function eliminarCieExis(idcie) {
    var url = "/referencia/deleteCie/" + idcie;
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
                            tabla_Cie10();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Cie10 restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tabla_Cie10();
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
function CargarPlazo(id){
    var url = "/referencia/getPlazosOfic";
    var arreglo;
    var select = $('#plazo').html('');
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
                    var result = data['plaz'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if(result[i]['pId'].toString() === id.toString()){
                            htmla = '<option value="' + result[i]['pId'] + '"selected>' + result[i]['pCantDia'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + result[i]['pId'] + '">' + result[i]['pCantDia'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}
function CargarTipoGas(nomtipg,id){
    var url = "/referencia/getTipGasAct";
    var arreglo;
    var select = $('#'+nomtipg).html('');
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
                    var result = data['tipgas'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if(result[i]['tGId'].toString() === id.toString()){
                            htmla = '<option value="' + result[i]['tGId'] + '"selected>' + result[i]['tGDesc'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + result[i]['tGId'] + '">' + result[i]['tGDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}
function CargarTipoGas(nomtipg,id){
    var url = "/referencia/getTipGasAct";
    var arreglo;
    var select = $('#'+nomtipg).html('');
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
                    var result = data['tipgas'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if(result[i]['tGId'].toString() === id.toString()){
                            htmla = '<option value="' + result[i]['tGId'] + '"selected>' + result[i]['tGDesc'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + result[i]['tGId'] + '">' + result[i]['tGDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}
function validarFormularioDoc() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#titdoc').val() !== '') {
        validarCaja('titdoc', 'validartitdoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el titulo del documento';
        validarCaja('titdoc', 'vvalidartitdoc', text, 0);
    }
    if ($('#descdoc').val() !=='') {
        validarCaja('descdoc', 'validardescdoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del documento';
        validarCaja('descdoc', 'validardescdoc', text, 0);
    }
    return cont;
}
function validarFormularioTipS() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desctips').val() !== '') {
        validarCaja('desctips', 'validardesctips', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del tipo de seguro';
        validarCaja('desctips', 'validardesctips', text, 0);
    }
    return cont;
}
function validarFormularioPlazo() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#cantd').val() !== '') {
        validarCaja('cantd', 'validarcantd', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la Cantidad de dias';
        validarCaja('cantd', 'validarcantd', text, 0);
    }
    return cont;
}
function validarFormularioEstP() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desestp').val() !== '') {
        validarCaja('desestp', 'validardesestp', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el estado del paciente';
        validarCaja('desestp', 'validardesestp', text, 0);
    }
    return cont;
}
function validarFormularioTipP() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#destipp').val() !== '') {
        validarCaja('destipp', 'validardestipp', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del tipo de personal';
        validarCaja('destipp', 'validardestipp', text, 0);
    }
    if ($('#abretipp').val() !== '') {
        validarCaja('abretipp', 'validarabretipp', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese abreviatura del tipo de personal';
        validarCaja('abretipp', 'validarabretipp', text, 0);
    }
    return cont;
}
function validarFormularioOfic() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#nomofic').val() !== '') {
        validarCaja('nomofic', 'validarnomofic', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el nombre de la oficina';
        validarCaja('nomofic', 'validarnomofic', text, 0);
    }
    if ($('#plazo').val() !== '0') {
        validarCaja('plazo', 'validarplazo', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el plazo';
        validarCaja('plazo', 'validarplazo', text, 0);
    }
    return cont;
}
function validarFormularioEnti() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#nomenti').val() !== '') {
        validarCaja('nomenti', 'validnomenti', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el nombre de la entidad';
        validarCaja('nomenti', 'validnomenti', text, 0);
    }
    return cont;
}
function validarFormularioTipDoc() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desctipd').val() !== '') {
        validarCaja('desctipd', 'valdesctipd', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el tipo de documento';
        validarCaja('desctipd', 'valdesctipd', text, 0);
    }
    return cont;
}
function validarFormularioTipGas() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desctipg').val() !== '') {
        validarCaja('desctipg', 'valdesctipg', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese el tipo de gasto';
        validarCaja('desctipg', 'valdesctipg', text, 0);
    }
    return cont;
}
function validarFormularioGasto() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#descgast').val() !== '') {
        validarCaja('descgast', 'valdescgast', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del gasto';
        validarCaja('descgast', 'valdescgast', text, 0);
    }
    if (parseInt($('#tipgas').val()) !==0) {
        validarCaja('tipgas', 'valtipgas', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el tipo de gasto';
        validarCaja('tipgas', 'valtipgas', text, 0);
    }
    return cont;
}
function validarFormularioCie10() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desccie').val() !== '') {
        validarCaja('desccie', 'valdesccie', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion';
        validarCaja('desccie', 'valdesccie', text, 0);
    }
    if ($('#codcie').val() !=='') {
        validarCaja('codcie', 'valcodcie', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese codigo';
        validarCaja('codcie', 'valcodcie', text, 0);
    }
    return cont;
}
function validarFormularioTipDG() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#tipdoc').val() !== 0) {
        validarCaja('tipdoc', 'valtipdoc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione tipo documento';
        validarCaja('tipdoc', 'valtipdoc', text, 0);
    }
    if ($('#gasto').val() !==0) {
        validarCaja('gasto', 'valgasto', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione gasto';
        validarCaja('gasto', 'valgasto', text, 0);
    }
    return cont;
}
