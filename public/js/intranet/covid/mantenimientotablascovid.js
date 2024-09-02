var idofic = 0;
var exist = 0;
var idsm = 0;
var sit = 0;
var campos = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    tablaEpp();
    tablaSintoma();
    tablaEntregaEpp();
});
function camposEpp(){
    var tablacampos = new Array();
    tablacampos[0] = "descepp";
    tablacampos[1] = "valdescepp";
    campos.push(tablacampos);
}
function camposEppEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "descepp";
    tablacampos[1] = "valdesceppedit";
    campos.push(tablacampos);
}
function camposSintomas(){
    var tablacampos = new Array();
    tablacampos[0] = "descsinto";
    tablacampos[1] = "valdescsinto";
    campos.push(tablacampos);
}
function camposSintomasEdit(){
    var tablacampos = new Array();
    tablacampos[0] = "descsintoedit";
    tablacampos[1] = "valdescsintoedit";
    campos.push(tablacampos);
}

$('#addEpp').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_epp').modal('show');
    campos=[];
    camposEpp();
});
$('#addSintomas').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_sintoma').modal('show');
    campos=[];
    camposSintomas();
});
function tablaEpp(){
    $('#tabla_Epp').DataTable({
        ajax: '/covid/getEppss',
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

            {data: 'descripcion', name: 'descripcion'},
            {data: 'fecCreacion', name: 'fecCreacion'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.estado) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.estado) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdEpp(' + row.idEpp + ')" TITLE="Editar Epp" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Epp" onclick="eliminarEpp(' + row.idEpp + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Epp"  onclick="eliminarEpp(' + row.idEpp + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function tablaSintoma(){
    $('#tabla_Sintoma').DataTable({
        ajax: '/covid/getSintomas',
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

            {data: 'descripcion', name: 'descripcion'},
            {data: 'fecCreacion', name: 'fecCreacion'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.estado) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.estado) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdSinto(' + row.idSintoma + ')" TITLE="Editar Síntoma" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Síntoma" onclick="eliminarSintomas(' + row.idSintoma + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Síntoma"  onclick="eliminarSintomas(' + row.idSintoma + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function tablaEntregaEpp(){
    $('#tabla_Entregaepp').DataTable({
        ajax: '/covid/getEntregaEpps',
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
            {"targets": 1, "width": "10%", "className": "text-right"},
            {"targets": 2, "width": "10%", "className": "text-center"},
            {"targets": 3, "width": "10%", "className": "text-center"},
            {"targets": 4, "width": "10%", "className": "text-left"},
            {"targets": 5, "width": "10%", "className": "text-center"},
        ],
        columns: [

            {data: 'descripcion', name: 'descripcion'},
            {data: 'Cantidad', name: 'Cantidad'},
            {data: 'fecentrega', name: 'fecentrega'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.estado) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.estado) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdEntregaEpp(' + row.idEntregaEpp + ')" TITLE="Editar Entrega Epp" >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Entrega Epp" onclick="eliminarEntregaEpp(' + row.idEntregaEpp + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Entrega Epp"  onclick="eliminarEntregaEpp(' + row.idEntregaEpp + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function abrilModalEdEpp(idepp) {
    window.event.preventDefault();
    $('#modal_dialog_edit_epp').modal('show');
    obtenerEditarEpp(idepp);
    campos=[];
    camposEppEdit();
}

function abrilModalEdSinto(idsint) {
    window.event.preventDefault();
    $('#modal_dialog_edit_sintoma').modal('show');
    obtenerEditarSinto(idsint);
    campos=[];
    camposSintomasEdit();
}


function abrilModalEdEntregaEpp(idm) {
    window.event.preventDefault();
    $('#modal_dialog_edit_entregaepp').modal('show');
    obtenerEditarEntregaEpp(idm);
}

function obtenerEditarEpp(idepp) {
    var url = "/covid/getEppEdit/" + idepp;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var epp = data['epp'];
                    $('#idepp').val(epp['idEpp']);
                    $('#desceppedit').val(epp['descripcion']);
                    $('#desceppedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarSinto(idsint) {
    var url = "/covid/getSintoEdit/" + idsint;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var sinto = data['sinto'];
                    $('#idsinto').val(sinto['idSintoma']);
                    $('#descsintoedit').val(sinto['descripcion']);
                    $('#descsintoedit').focus();
                } else {

                }

            }

        });
}

function obtenerEditarEntregaEpp(idm) {
    var url = "/covid/getEntreEppEdit/" + idm;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var eepp = data['eepp'];
                    $('#ideepp').val(eepp['idEntregaEpp']);
                    $('#desceepp').val(eepp['descripcion']);
                    $('#canteepp').val(eepp['Cantidad']);
                    $('#canteepp').focus();
                } else {

                }

            }

        });
}

function eliminarEpp(idepp) {
    var url = "/covid/deleteEpp/" + idepp;
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
                            tablaEpp();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Epp eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaEpp();
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

function eliminarSintomas(idsint) {
    var url = "/covid/deleteSinto/" + idsint;
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
                            tablaSintoma();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Sintoma eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaSintoma();
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

function eliminarEntregaEpp(ideepp) {
    var url = "/covid/deleteEntreEpp/" + ideepp;
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
                            tablaEntregaEpp();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Entrega Epp eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            tablaEntregaEpp();
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
function enviarEpp() {
    if (validarFormularioEpp('descepp', 'valdescepp') === 0) {
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
                var descepp = $('#descepp').val();
                $.ajax({
                    url: '/covid/storeEpp',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        descripcion: descepp,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Epp exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_epp')
                                tablaEpp();
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
                                closeModal('modal_dialog_add_epp')
                                tablaEpp();
                            }
                        }
                    ,
                    beforeSend: function () {
                        $('#enviarepp').prop("disabled", false);
                    }
                });
            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarSinto() {
    if (validarFormularioSinto('descsinto', 'valdescsinto') === 0) {
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
                var descsinto = $('#descsinto').val();

                $.ajax({
                    url: '/covid/storeSinto',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        descripcion: descsinto,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Síntoma exitoso',
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_add_sintoma')
                                tablaSintoma();
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
                                closeModal('modal_dialog_add_sintoma')
                                tablaSintoma();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarsinto').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarEppEdit() {
    if (validarFormularioEpp('desceppedit', 'valdesceppedit') === 0) {
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
                var idepp = $('#idepp').val();
                var descepp = $('#desceppedit').val();

                $.ajax({
                    url: '/covid/editEpp',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idepp: idepp,
                        descripcion: descepp,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Epp Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_epp')
                                tablaEpp();
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
                                closeModal('modal_dialog_edit_epp')
                                tablaEpp();

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

function enviarSintoEdit() {
    if (validarFormularioSinto('descsintoedit', 'valdescsintoedit') === 0) {
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
                var idsinto = $('#idsinto').val();
                var descsinto = $('#descsintoedit').val();

                $.ajax({
                    url: '/covid/editSinto',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idsinto: idsinto,
                        descripcion: descsinto,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Síntoma Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(campos);
                                closeModal('modal_dialog_edit_sintoma')
                                tablaSintoma();
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
                                closeModal('modal_dialog_edit_sintoma')
                                tablaSintoma();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarsintoedit').prop("disabled", false);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function enviarEEppEdit() {
    if (validarFormularioEEpp('desceepp', 'valdesceepp',
        'canteepp', 'valcanteepp') === 0) {
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
                var ideepp = $('#ideepp').val();
                var canteepp = $('#canteepp').val();

                $.ajax({
                    url: '/covid/editEntreEpp',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        ideepp: ideepp,
                        cantidad: canteepp,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Entrega Epp Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                closeModal('modal_dialog_edit_entregaepp')
                                tablaEntregaEpp();
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
                                closeModal('modal_dialog_edit_entregaepp')
                                tablaEntregaEpp();

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

function validarFormularioEpp(desm, val) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + desm).val() !== '') {
        validarCaja(desm, val, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Descripcion Epp';
        validarCaja(desm, val, text, 0);
    }
    return cont;
}

function validarFormularioSinto(destc, val) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#' + destc).val() !== '') {
        validarCaja(destc, val, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Síntoma';
        validarCaja(destc, val, text, 0);
    }
    return cont;
}

function validarFormularioEEpp(descepp, valepp, cantepp, valcantepp) {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#' + descepp).val() !== '') {
        validarCaja(descepp, valepp, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Epp';
        validarCaja(descepp, valepp, text, 0);
    }
    if ($('#' + cantepp).val() !== '' && parseInt($('#' + cantepp).val() )!== 0) {
        validarCaja(cantepp, valcantepp, 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Cantidad';
        validarCaja(cantepp, valcantepp, text, 0);
    }
    return cont;
}

