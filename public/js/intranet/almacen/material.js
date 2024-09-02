var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var tip = [];
var stock = [];
var idmat = [];
var cantmat = [];
var idmovmat = [], cantmovmat = [];
var reciItm = [], rechItm = [];
$(document).ready(function () {
    $('#tabla_addstock').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
    llenarLocal();
    obtenerEejcutora();
    MostrarNotif();
});
var mensajeGriter = function (local) {
    setTimeout(function () {
        $.gritter.add({
            title: 'Bienvenido a medicamentos y dispositivos medicos',
            text: 'Usted tiene 1 transferencia por recibir de '+local,
            image: '../assets/img/diresa/Logo.png',
            sticky: true,
            time: '100',
            class_name: 'my-sticky-class'
        });
    }, 100);
};
$('#adddes').on('click', function () {
    addStock()
});

llenarLocal = function () {
    $.ajax(
        {
            type: "GET",
            url: '/almacen/getLocal',
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idloc').val(data['lId']);
                $('#nomal').val(data['lNombre']);
                $('#diral').val(data['lDireccion']);
            }

        });
}

MostrarNotif = function () {
    var url = "/almacen/getMovimientonotif";
    var perm = $('#recmat').html('');
    var htmla = '', html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data.length>0){
                    htmla =
                        '                         <i class="fas fa-lg fa-fw m-r-10 fa-tasks"></i>Ver transferencias - ' +
                        data.length+
                        '                         <i class="fas fa-lg fa-fw m-r-10 fa-bell parpadea " style="color: red"> </i>' +
                        '                        <br>';
                    html = htmla + html;
                    for(var i=0;i<data.length;i++){
                        mensajeGriter(data[i]['lNombre']);
                    }
                }else{
                    htmla =
                        '                         <i class="fas fa-lg fa-fw m-r-10 fa-tasks"></i>Ver transferencias' +
                        '                        <br>';
                    html = htmla + html;
                }
                perm.append(html);

            }

        });
}

function validarCantAdd() {
    var addcant = parseInt($('#addcant').val());
    if (addcant <= 0) {
        var text = ' ingrese cantidad';
        validarCaja('addcant', 'valadddescm', text, 0);
        return 1;
    } else {
        validarCaja('addcant', 'valadddescm', '', 1);
        return 0;
    }

}

function validarMatAdd() {
    if ($('#addidmed').val() !== '') {
        validarCaja('adddescm', 'valadddescm', 'Correcto', 1);
        return 0;
    } else {
        var text = 'Busque y seleccione un material';
        validarCaja('adddescm', 'valadddescm', text, 0);
        return 1;
    }

}


function addStock() {

    var arrStock = new Array();
    var tipmed = $('#tipmed').val();
    var addidmed = $('#addidmed').val();
    var adddescm = $('#adddescm').val();
    var addcant = $('#addcant').val();
    if (validarMatAdd() === 0 && validarCantAdd() === 0) {
        var ubi = 0;
        for (var i = 0; i < stock.length; i++) {
            if (parseInt(stock[i]['idmed']) === parseInt(addidmed)) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            arrStock['idmed'] = addidmed;
            arrStock['descmed'] = adddescm;
            arrStock['cantmed'] = addcant;
            arrStock['tipmed'] = tipmed;
            idmat.push(addidmed);
            cantmat.push(addcant);
        }
        stock.push(arrStock);
        addlistStock();
    } else {
        valInfo('Verifique cantidad');
    }
}

function addlistStock() {
    var cont = -1;
    var datatable = $('#tabla_addstock');
    datatable.DataTable().destroy();
    datatable.DataTable({

            data: stock,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            columnDefs: [
                {"targets": 0, "width": "60%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'descmed', name: 'descmed'},
                {data: 'tipmed', name: 'tipmed'},
                {data: 'cantmed', name: 'cantmed'},
                {
                    data: function (row) {
                        cont++;
                        return '<tr >\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar fila" onclick="delListEsp(' + cont + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );

}


$('#guardarstock').on('click', function () {
    window.event.preventDefault();
    var idloc = $('#idloc').val();
    var mot = $('#mot').val();
    var ori = $('#ori').val();
    mot = JSON.stringify(mot);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se agregara stock al almacen',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            if (idmat.length < 1 || idmat == undefined)
                valInfo('Escoja materiales para ingresar stock');
            else {
                $.ajax({
                    url: '/almacen/createStock',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idloc: idloc,
                        idmat: idmat,
                        cantmat: cantmat,
                        mot: mot,
                        ori: ori
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de ingreso exitoso',
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
                                    timer: 9000
                                });
                                location.reload();
                            }
                        }

                    ,
                    beforeSend: function () {
                        $('#guardarstock').prop("disabled", true);
                    }
                })
                ;
            }

        }
    })
});

function delListEsp(id) {
    stock.splice(id, 1);
    addlistStock();
}

$('#adddescm').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/almacen/getMedDis",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({id: item.mId, name: item.mMedNom, tipmed: item.tmDesc});
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        $('#addidmed').val(item.id);
        $('#tipmed').val(item.tipmed);

        return item;
    }
});

$(function () {
    $('#tabla_stock_loc').DataTable({
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
                {"targets": 0, "width": "50%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "4%", "className": "text-center"},
                {"targets": 3, "width": "4%", "className": "text-center"},
                {"targets": 4, "width": "4%", "className": "text-center"},
                {"targets": 5, "width": "4%", "className": "text-center"},
                {"targets": 6, "width": "10%", "className": "text-center"},
            ],

            columns: [
                {data: 'mMedNom', name: 'mMedNom'},
                {data: 'tmDesc', name: 'tmDesc'},
                {data: 'stock', name: 'stock'},
                {data: 'sFecCrea', name: 'sFecCrea'},
                {
                    data: function (row) {
                        if (parseInt(row.sEstEnt) === 0) {
                            return '<span class="text-primary">DONACION</span>';
                        } else {
                            if (parseInt(row.sEstEnt) === 1)
                                return '<span class="text-success">TRANSFERENCIA</span>';
                            else {
                                if (parseInt(row.sEstEnt) === 2)
                                    return '<span class="text-purple">DEMID</span>';
                                else {
                                    if (parseInt(row.sEstEnt) === 3)
                                        return '<span class="text-pink">COMP DIR</span>';
                                    else {

                                        return '<span class="text-amber">CENARES</span>';
                                    }

                                }
                            }

                        }
                    }


                },
                {
                    data: function (row) {
                        return parseInt(row.sEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.sEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="editStock(' + row.sId + ')" TITLE="Editar stock " >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar stock" onclick="eliminarStock(' + row.sId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Restaurar stock"  onclick="eliminarStock(' + row.sId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }

            ]
        }
    );
});

var eliminarStock = function (sId) {
    var url = "/almacen/delStockLoc/" + sId;
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
                            redirect('/almacen/ingresomaterial');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'stock eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/ingresomaterial');
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

};


$('#editstock').on('click', function () {
    window.event.preventDefault();
    var idstock = $('#idstock').val();
    var cantedit = $('#cantedit').val();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se editara el stock ',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/almacen/editStock',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idstock: idstock,
                    cantedit: cantedit,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Edicion  exitosa',
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
                                timer: 9000
                            });
                            location.reload();
                        }
                    }

                ,
                beforeSend: function () {
                    $('#guardarstock').prop("disabled", true);
                }
            })
            ;


        }
    })
});
var eliminarStock = function (sId) {
    var url = "/almacen/delStockLoc/" + sId;
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
                            redirect('/almacen/ingresomaterial');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'stock eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/ingresomaterial');
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

var editStock = function (sId) {
    window.event.preventDefault();
    $('#modal_dialog_edit_stock').modal({show: true, backdrop: 'static', keyboard: false});
    llenarEditStock(sId)

};

$('#movmat').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_mov_stock').modal({show: true, backdrop: 'static', keyboard: false});
    llenarMoverStock();

});

$('#recmat').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_rec_stock').modal({show: true, backdrop: 'static', keyboard: false});
    llenarVerMovimientos();
});

var llenarVerMovimientos = function () {
    window.event.preventDefault();
    var datatable = $('#tabla_verenviostock');
    datatable.DataTable().clear().destroy();
    datatable.DataTable({
            ajax: '/almacen/getMovimiento',
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
                {"targets": 0, "width": "30%", "className": "text-center"},
                {"targets": 1, "width": "50%", "className": "text-left"},
                {"targets": 2, "width": "15%", "className": "text-center"},
                {"targets": 3, "width": "4%", "className": "text-center"},
                {"targets": 4, "width": "4%", "className": "text-center"},
            ],
            columns: [
                {data: 'descripcionEjecutora', name: 'descripcionEjecutora'},
                {data: 'rMotivo', name: 'rMotivo'},
                {data: 'rFecCrea', name: 'rFecCrea'},
                {data: 'cant', name: 'cant'},
                {
                    data: function (row) {
                        return '<tr >' +
                            '<a href="#"  onclick="verItmsMov(' + row.rId + ')" TITLE="Recibir" >\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-eye text-primary"> </i></a>\n' +
                            '</tr>';

                    }
                },
            ]
        }
    );
}
var verItmsMov = function (rId) {
    window.event.preventDefault();
    $('#modal_dialog_rec_stock').modal('hide');
    $('#modal_dialog_ver_itms_stock').modal({show: true, backdrop: 'static', keyboard: false});
    llenarItmsRecibirMov(rId);
}


var llenarItmsRecibirMov = function (rId) {
    $('#idrot').val(rId);
    window.event.preventDefault();
    var datatable = $('#tabla_recstockimt');
    datatable.DataTable().clear().destroy();
    datatable.DataTable({
            ajax: '/almacen/getItmsMovimiento/' + rId,
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
                {"targets": 1, "width": "20%", "className": "text-left"},
                {"targets": 2, "width": "15%", "className": "text-center"},
                {"targets": 3, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'med', name: 'med'},
                {data: 'tmDesc', name: 'tmDesc'},
                {data: 'cant', name: 'cant'},
                {
                    data: function (row) {
                        return '<tr class="text-center"><div class="row" id="valitmstock' + row.rsId + '">' +
                            '<a href="#"  onclick="recibirStock(' + row.rsId + ')" TITLE="Recibir" >\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-success"> </i></a>\n' +
                            '<a href="#"  onclick="rechazarStock(' + row.rsId + ')" TITLE="Rechazar" >\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-danger"> </i></a>\n' +
                            '</div></tr>';

                    }
                },
            ]
        }
    );

};
var llenarMoverStock = function () {
    window.event.preventDefault();
    var datatable = $('#tabla_mov_stock');
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


var recibirStock = function (iStock) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se aceptara este item',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            var idopc = $('#valitmstock' + iStock);
            idopc.empty();
            idopc.append('<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-success"> </i>');
            reciItm.push(iStock);
        }
    })

}
var rechazarStock = function (iStock) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se rechazara este item',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            var idopc = $('#valitmstock' + iStock);
            idopc.empty();
            idopc.append('<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-danger"> </i>');
            rechItm.push(iStock);
        }
    })

}


$('#reittr').on('click', function () {
    window.event.preventDefault();
    var idro = $('#idrot').val();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se recibira los itms',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                url: '/almacen/recibiritmstock',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    reciItm: reciItm,
                    rechItm: rechItm,
                    idro: idro
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Recepcion de transferencia exitosa',
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
                                timer: 9000
                            });
                            location.reload();
                        }
                    }

                ,
                beforeSend: function () {
                    $('#reittr').prop("disabled", true);
                }
            })
            ;
        }


    })
});

function dlListMov(id) {
    idmovmat.splice(id, 1);
    cantmovmat.splice(id, 1);
}

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
            }
            else {
                dlListMov(pos);
                idmovmat.push(idStock);
                cantmovmat.push(cant);
            }
            validarCaja('cajval' + idStock, 'valadddescm', '', 1);
        }
        else {
            dlListMov(pos);
        }

    }
    else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'El stock es menor',
            showConfirmButton: false,
            timer: 3000
        });
        validarCaja('cajval' + idStock, 'valadddescm', '', 0);
    }


}


var llenarEditStock = function (sId) {
    $.ajax(
        {
            type: "GET",
            url: '/almacen/getStockEdit/' + sId,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var stock = data['stock'];
                $('#idstock').val(stock[0]['idstock']);
                $('#mededit').val(stock[0]['mMedNom']);
                $('#tipedit').val(stock[0]['tmDesc']);
                $('#cantedit').val(stock[0]['sCantUni']);

            }

        });
}

function obtenerEejcutora() {
    var url = "/ejecutoras";
    var arreglo;
    var select = $('#ejec').html('');
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
                    htmla = '<option value="' + data[i]['idEjecutora'] + '">' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);

            }

        });
}

$('#ejec').on('click', function () {
    window.event.preventDefault();
    var id = $('#ejec').val();
    llenarAlmacen(id);
});

function llenarAlmacen(id) {

    var url = "/almacen/getLocEje/" + id;
    var arreglo;
    var select = $('#almac').html('');
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
                    htmla = '<option value="' + data[i]['lId'] + '">' + data[i]['lNombre'] + '|' + data[i]['lDireccion'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);

            }

        });
}


$('#enviarMov').on('click', function () {
    window.event.preventDefault();
    if (validarMovimiento() === 0) {

        var idal = $('#almac').val();
        var motr = $('#motr').val();
        motr = JSON.stringify(motr);
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se rotara estos materiales/medicamentos ',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/almacen/createMoivimiento',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idmovmat: idmovmat,
                        cantmovmat: cantmovmat,
                        idal: idal,
                        motr: motr
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Movimiento de stock exitoso',
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
                        $('#enviarMov').prop("disabled", true);
                    }
                })
                ;


            }
        })
    }
});


function validarMovimiento() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#ejec').val() !== '0') {
        validarCaja('ejec', 'validejec', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion una ejecutora';
        validarCaja('ejec', 'validejec', text, 0);
        $('#ejec').focus();
    }
    if ($('#almac').val() !== '0') {
        validarCaja('almac', 'validalmac', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' seleccion un almacen';
        validarCaja('almac', 'validalmac', text, 0);
        $('#almac').focus();
    }

    if (idmovmat === undefined || idmovmat.length === 0) {
        cont++;
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'Ingrese almenos un material a rotar',
            showConfirmButton: false,
            timer: 3000
        });
    }
    return cont;
}
