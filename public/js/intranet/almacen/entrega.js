var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var idmovmat = [], cantmovmat = [];
$(document).ready(function () {
    datePickers();
    getEntrega();
});
var datePickers = function () {

    $('#fecen').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd-mm-yyyy',
    });


};
var verItmsEnt = function (rId) {
    window.event.preventDefault();
    $('#modal_dialog_ver_itms_ent').modal({show: true, backdrop: 'static', keyboard: false});
    llenarItmsEnt(rId);
}
$('#essrr').typeahead({
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
        let idess = $('#idessrr');
        idess.val('');
        idess.val(item.id);
        return item;
    }

});
$('#edessrr').typeahead({
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
        var idess = $('#idessrr');
        idess.val('');
        idess.val(item.id);
        return item;
    }

});
var llenarItmsEnt = function (rId) {
    window.event.preventDefault();
    var datatable = $('#tabla_vertabent');
    datatable.DataTable().clear().destroy();
    datatable.DataTable({
            ajax: '/almacen/getItmsEntrega/' + rId,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            columnDefs: [
                {"targets": 0, "width": "50%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "15%", "className": "text-center"},
            ],
            columns: [
                {data: 'med', name: 'med'},
                {data: 'tmDesc', name: 'tmDesc'},
                {data: 'cant', name: 'cant'},
            ]
        }
    );

};
var getEntrega = function () {
    var datatable = $('#tabla_ent_mat');
    datatable.DataTable().clear().destroy();
    datatable.DataTable({
            ajax: '/almacen/getEntrega',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            columnDefs: [
                {"targets": 0, "width": "25%", "className": "text-left"},
                {"targets": 1, "width": "40%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-left"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},
                {"targets": 5, "width": "5%", "className": "text-center"},
                {"targets": 6, "width": "5%", "className": "text-center"},
                {"targets": 7, "width": "5%", "className": "text-center"},
            ],
            columns: [
                {data: 'ess', name: 'ess'},
                {data: 'eMotivo', name: 'eMotivo'},
                {data: 'eEnt', name: 'eEnt'},
                {data: 'eFecEntrega', name: 'eFecEntrega'},
                {
                    data: function (row) {
                        return '<span>' + row.itms + ' <a href="#"  onclick="verItmsEnt(' + row.eId + ')" TITLE="ver itms" >\n' +
                            '<i class="text-primary far fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n </span>';

                    }
                },
                {data: 'name', name: 'name'},
                {
                    data: function (row) {
                        return parseInt(row.eEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.eEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="editEntrega(' + row.eId + ')" TITLE="Editar entrega " >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar stock" onclick="eliminar(' + row.eId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Restaurar stock"  onclick="eliminar(' + row.eId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }
            ]
        }
    );

};

var editEntrega = function (idEnt) {
    $('#ident').val(idEnt);
    window.event.preventDefault();
    $('#modal_dialog_edit_ent').modal({show: true, backdrop: 'static', keyboard: false});
    showEntregaId(idEnt);
}

var showEntregaId = function (idEnt) {
    var url = "/almacen/getEntregaId/" + idEnt;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                let ent = data['ent']
                $('#edidessrr').val(ent['idEess']);
                $('#editedessrr').text(ent['descripcion']);
                $('#edmotr').val(ent['eMotivo']);
                $('#edenta').val(ent['eEnt']);
                let fec = $('#edfecen');
                fec.val(cambiarFormatoFecha(ent['eFecEntrega']));
                fec.datepicker({
                    todayHighlight: true,
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                });
                llenarEditStock(ent['eId']);
            }

        });
}

$('#entmat').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_rec_stock').modal({show: true, backdrop: 'static', keyboard: false});
    llenarMoverStock();
});
var llenarEditStock = function (rId) {
    //window.event.preventDefault();
    var datatable = $('#tabla_edentmat');
    datatable.DataTable().clear().destroy();
    datatable.DataTable({
            ajax: '/almacen/getItmsEntrega/' + rId,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            columnDefs: [
                {"targets": 0, "width": "20%", "className": "text-center"},
                {"targets": 1, "width": "60%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 3, "width": "20", "className": "text-center"},
            ],
            columns: [
                {data: 'mCodMed', name: 'mCodMed'},
                {data: 'med', name: 'med'},
                {data: 'tmDesc', name: 'tmDesc'},
                {
                    data: function (row) {
                        return '<input value="' + row.cant + '" type="text" id="cajval' + row.sId + '" onchange="cambiarCantidad(' + row.esId + ', this.value,'+rId+' )" class="text-center form-control form-control-sm" style="width: 100px;">';
                    }
                }
            ]
        }
    );

};

var cambiarCantidad = function (idmat, cant, rId) {
    $.ajax({
        url: '/almacen/editmatstock',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            idmat: idmat,
            cant: cant,
        },
        dataType: 'JSON',
        success:
            function (data) {
                if (data['error'] === 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        type: 'success',
                        title: 'Modificacion de material exitoso',
                        showConfirmButton: false,
                        timer: 6000
                    });
                    llenarEditStock(rId);
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'ocurrio un error!',
                        text: data['error'],
                        showConfirmButton: false,
                        timer: 9000
                    });
                    location.reload();
                }
            }

        ,
        beforeSend: function () {
            $('#entmat').prop("disabled", true);
        }
    })
    ;
}

var llenarMoverStock = function () {
    window.event.preventDefault();
    var datatable = $('#tabla_entmat');
    datatable.DataTable().clear().destroy();
    datatable.DataTable({
            ajax: '/almacen/getStockTrAl',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "70%", "className": "text-left"},
                {"targets": 2, "width": "10%", "className": "text-center"},
                {"targets": 3, "width": "4%", "className": "text-center"},
            ],
            columns: [
                {data: 'mCodMed', name: 'mCodMed'},
                {data: 'mMedNom', name: 'mMedNom'},
                {data: 'sFecCrea', name: 'sFecCrea'},
                {data: 'stock', name: 'stock'},
                {
                    data: function (row) {
                        return '<input value="0" type="text" id="cajval' + row.sId + '" onchange="agregarMatMov(' + row.stock + ',' + row.sId + ', this.value )" class="text-center form-control form-control-sm" style="width: 100px;">';
                    }
                }
            ]
        }
    );

};


var agregarMatMov = function (stock, idStock, cant) {

    var caja = $('#cajval' + idStock);
    if (parseInt(stock) >= parseInt(cant) && parseInt(cant) > -1) {
        var pos = null;
        for (var i = 0; i < idmovmat.length; i++) {
            if (parseInt(idmovmat[i]) === parseInt(idStock)) {
                pos = i;
            }
        }
        if (parseInt(cant) > 0) {
            if (pos === null) {
                idmovmat.push(idStock);
                cantmovmat.push(cant);
            } else {
                dlListMov(pos);
                idmovmat.push(idStock);
                cantmovmat.push(cant);
            }
            validarCaja('cajval' + idStock, 'valadddescm', '', 1);
        } else {
            dlListMov(pos);
        }

    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'La cantidad es erronea',
            showConfirmButton: false,
            timer: 3000
        });
        validarCaja('cajval' + idStock, 'valadddescm', '', 0);
    }
}

function dlListMov(id) {
    idmovmat.splice(id, 1);
    cantmovmat.splice(id, 1);
}

$('#enventmat').on('click', function () {
    window.event.preventDefault();
    if (valdiarEntrega() === 0) {
        var fecen = $('#fecen').val();
        var enta = $('#enta').val();
        var motr = $('#motr').val();
        var idEess = $('#idessrr').val();
        motr = JSON.stringify(motr);
        enta = JSON.stringify(enta);
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se entregaran estos materiales/medicamentos',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/almacen/createEntrega',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idmovmat: idmovmat,
                        cantmovmat: cantmovmat,
                        enta: enta,
                        motr: motr,
                        fecen: fecen,
                        idEess: idEess
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Entrea de material exitosa',
                                    showConfirmButton: false,
                                    timer: 6000
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
                                    timer: 9000
                                });
                                location.reload();
                            }
                        }

                    ,
                    beforeSend: function () {
                        $('#entmat').prop("disabled", true);
                    }
                })
                ;


            }
        })
    }
});



$('#edventmat').on('click', function () {
    window.event.preventDefault();

        let ident = $('#ident').val();
        let fecen = $('#edfecen').val();
        let enta = $('#edenta').val();
        let motr = $('#edmotr').val();
        let idEess = $('#edidessrr').val();
        motr = JSON.stringify(motr);
        enta = JSON.stringify(enta);
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se guardala los comabios estos Medicamentos/dispostivos medicos',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/almacen/editEntrega',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        ident: ident,
                        enta: enta,
                        motr: motr,
                        fecen: fecen,
                        idEess: idEess
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Entrega de material editado exitosamente',
                                    showConfirmButton: false,
                                    timer: 6000
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
                                    timer: 9000
                                });
                                location.reload();
                            }
                        }

                    ,
                    beforeSend: function () {
                        $('#entmat').prop("disabled", true);
                    }
                })
                ;


            }
        })
});

//FUNCION PARA HABILITAR/DESABILITAR DESTINO EN AGREGAR MODIFICACION
$("#acteess").on('change', function () {
    if ($(this).is(':checked')) {
        $('#actess').prop("hidden", false);
    } else {
        $('#actess').prop("hidden", true);

    }
});


function valdiarEntrega() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#enta').val() !== '') {
        validarCaja('enta', 'valenta', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese una entidad o persona';
        validarCaja('enta', 'valenta', text, 0);
        $('#enta').focus();
    }
    if ($('#motr').val() !== '') {
        validarCaja('motr', 'valmotr', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + 'ingrese el motivo';
        validarCaja('motr', 'valmotr', text, 0);
        $('#motr').focus();
    }
    if ($('#fecen').val() !== '') {
        validarCaja('fecen', 'valfecen', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + 'ingrese el fecha entrega';
        validarCaja('fecen', 'valfecen', text, 0);
        $('#fecen').focus();
    }

    if (idmovmat === undefined || idmovmat.length === 0) {
        cont++;
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'Ingrese almenos un material a entregar',
            showConfirmButton: false,
            timer: 3000
        });
    }
    return cont;
}

var eliminar = function (id) {
    var url = "/almacen/delEntrega/" + id;
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
                            redirect('/almacen/entregamaterial');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entrega eliminada/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/entregamaterial');
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
