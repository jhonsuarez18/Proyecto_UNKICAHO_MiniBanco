var listidspermisalm = [];
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    cargarencargados();

});

function CargarLocales(idejecutora, id) {
    var url = "/almacen/getlocal/" + idejecutora;
    var arreglo;
    if (id == 0) {
        var select = $('#desclocal').html('');
    } else {
        var select = $('#desclocaledit').html('');
    }
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
                    var result = data['loc'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if (result[i]['lId'].toString() === id.toString()) {
                            htmla = '<option value="' + result[i]['lId'] + '"selected>' + result[i]['lNombre'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + result[i]['lId'] + '">' + result[i]['lNombre'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}

$('#ejecutora').on('change', function () {
    CargarLocales(this.value, 0);
    $('#desclocal').focus();
});

$('#ejecutoraedit').on('change', function () {
    CargarLocales(this.value, 1);
    $('#desclocaledit').focus();
});
$('#desclocal').on('change', function () {
    $('#idlocal').val(this.value);
    $('#user').focus();
    if($('#dni').val()!=''){
        valusuario();
    }
});
$('#desclocaledit').on('change', function () {
    $('#idlocaledit').val(this.value);
    $('#usuarioedit').focus();
    if($('#dniedit').val()!=''){
        valusuarioEdit();
    }
});

function CargarEjecutoras(id) {
    var url = "/ejecutoras";
    var arreglo;
    if (id == 0) {
        var select = $('#ejecutora').html('');
    } else {
        var select = $('#ejecutoraedit').html('');
    }
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
                    if (data[i]['idEjecutora'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['idEjecutora'] + '"selected>' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + data[i]['idEjecutora'] + '">' + data[i]['codigoEjecutora'] + '|' + data[i]['descripcionEjecutora'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

$('#user').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/almacen/getUser",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idu,
                        name: item.nombre,
                        uname: item.usname,
                        numdoc: item.numeroDoc
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#dni');
        var fin = $('#nombcompl');

        var idfin = $('#iduser');
        pro.val('');
        fin.val('');
        idfin.val('');
        fin.val(item.uname);
        pro.val(item.numdoc);
        idfin.val(item.id);
        valusuario();
        return item;
    },
});

$('#usuarioedit').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/almacen/getUser",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idu,
                        name: item.nombre,
                        uname: item.usname,
                        numdoc: item.numeroDoc
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#dniedit');
        var fin = $('#nomusuedit');

        var idfin = $('#iduseredit');
        pro.val('');
        fin.val('');
        idfin.val('');
        fin.val(item.uname);
        pro.val(item.numdoc);
        idfin.val(item.id);
        valusuarioEdit();
        return item;
    }

});

function cargarencargados() {
    $('#tabla_encargado').DataTable({
        ajax: '/almacen/getencarg',
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
            {"targets": 0, "width": "20%", "className": "text-left"},
            {"targets": 1, "width": "2%", "className": "text-center"},
            {"targets": 3, "width": "6%", "className": "text-center"},
            {"targets": 5, "width": "6%", "className": "text-center"},
            {"targets": 6, "width": "6%", "className": "text-center"},
        ],
        columns: [

            {data: 'lNombre', name: 'lNombre'},
            {data: 'codigoEjecutora', name: 'codigoEjecutora'},
            {data: 'ejecutora', name: 'ejecutora'},
            {data: 'dni', name: 'dni'},
            {data: 'nombre', name: 'nombre'},
            {data: 'user', name: 'user'},
            {
                data: function (row) {
                    return parseInt(row.enEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.enEst) === 1 && parseInt(row.enEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdEncarg(' + row.enId + ',' + row.idUsuario + ')" TITLE="Editar Encargado " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Encargado" onclick="eliminarencargadoPermisos(' + row.enId + ',' + row.idUsuario + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Encargado"  onclick="eliminarencargadoPermisos(' + row.enId + ',' + row.idUsuario + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}

function abrilModalEdEncarg(idenc, idus) {
    window.event.preventDefault();
    $('#modal-dialog_editencarg').modal({show: true, backdrop: 'static', keyboard: false});
    obtenerEditarEncargado(idenc)
    $('#nuepermedit').prop("hidden", false);
    cargarsubmodulosAlmaEdit(idus);
}

function eliminarencargadoPermisos(idencarg, idusu) {
    obtenerpermisoseliminar(idusu);
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
                    url: '/almacen/deleteencarg',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        listidspermisalm: listidspermisalm,
                        idencarg: idencarg,
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/almacen/asignarusuario');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Encargado eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/asignarusuario');
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

function obtenerEditarEncargado(idenc) {
    var url = "/almacen/getEncargadoEdit/" + idenc;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var result = data['result'];
                $('#idlocaledit').val(result[0]['lId']);
                $('#iduseredit').val(result[0]['idUsuario']);
                $('#idusuarioedit').val(result[0]['idUsuario']);
                $('#idencarg').val(result[0]['enId']);
                $('#locedit').val(result[0]['lNombre']);
                $('#codejeedit').val(result[0]['codigoEjecutora']);
                $('#descejeedit').val(result[0]['ejecutora']);
                $('#usuarioedit').val(result[0]['nombre']);
                $('#dniedit').val(result[0]['dni']);
                $('#nomusuedit').val(result[0]['user']);
                CargarEjecutoras(result[0]['idEjecutora']);
                $('#ejecutoraedit').focus();
                CargarLocales(result[0]['idEjecutora'], result[0]['lId'])
            }

        });
}

function enviarencarg() {
    if (validarFormularioEncarg() === 0) {
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
                var idlocal = $('#idlocal').val();
                var iduser = $('#iduser').val();

                $.ajax({
                    url: '/almacen/storeencarg',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        listidspermisalm: listidspermisalm,
                        idlocal: idlocal,
                        iduser: iduser,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Encargado exitoso',
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
                        $('#enviarencarg').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            type: 'warning',
            title: 'atencion!',
            text: 'El formulario tiene errores, por favor, subsanelos..',
            showConfirmButton: false,
            timer: 3000
        });
    }
}

function enviarEditEncarg() {
    if (validarFormularioEncargEdit() === 0) {
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
                var idencarg = $('#idencarg').val();
                var idlocaledit = $('#idlocaledit').val();
                var iduseredit = $('#iduseredit').val();

                $.ajax({
                    url: '/almacen/editencarg',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idencarg: idencarg,
                        idlocaledit: idlocaledit,
                        iduseredit: iduseredit,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Encargado Editado Exitosamente',
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
                        $('#enviarencarg').prop("disabled", true);
                    }
                });


            }
        });
    } else {
        operacionSubsanar();
    }
}

function cargarsubmodulosAlmaEdit(idus) {
    var url = "/almacen/getPermisos/" + idus;
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
                    var result = data['result'];
                    var encarg = data['encarg'];
                    if (encarg.length == 0) {
                        for (var i = 0; i < result.length; i++) {
                            htmla =
                                '                        <a  href="#" onclick="activarDesactivarPermiso(' + null + ',' + idus + ',' + result[i]['idSubMenu'] + ',0,1)"  title="Activar permiso" >' +
                                '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a>' +
                                '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                            html = htmla + html;
                        }
                    } else {
                        for (var i = 0; i < result.length; i++) {
                            var cont = 0;
                            for (var b = 0; b < encarg.length; b++) {
                                if (result[i]['idSubMenu'] == encarg[b]['idSubMenu']) {
                                    if (encarg[b]['estado'] == 0) {
                                        htmla =
                                            '                        <a  href="#" onclick="activarDesactivarPermiso(' + encarg[b]['idPermiso'] + ',' + idus + ',' + encarg[b]['idSubMenu'] + ',0,1)"  title="Activar permiso" >' +
                                            '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a>' +
                                            '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                                        html = htmla + html;
                                    } else {
                                        htmla =
                                            '                        <a  href="#" onclick="activarDesactivarPermiso(' + encarg[b]['idPermiso'] + ',' + idus + ',' + encarg[b]['idSubMenu'] + ',1,1)"  title="Desactivar permiso" >' +
                                            '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-up text-green"> </i></a>' +
                                            '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                                        html = htmla + html;
                                    }
                                } else {
                                    cont = cont + 1;
                                    if (cont == encarg.length) {
                                        htmla =
                                            '                        <a  href="#" onclick="activarDesactivarPermiso(' + null + ',' + idus + ',' + result[i]['idSubMenu'] + ',0,1)"  title="Activar permiso" >' +
                                            '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a>' +
                                            '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                                        html = htmla + html;
                                    }
                                }
                            }

                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}

function cargarsubmodulosAlma(idus) {
    var url = "/almacen/getPermisos/" + idus;
    var perm = $('#nueperm').html('');
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
                    var result = data['result'];
                    var encarg = data['encarg'];
                    if (encarg.length == 0) {
                        for (var i = 0; i < result.length; i++) {
                            htmla =
                                '                        <a  href="#" onclick="activarDesactivarPermiso(' + null + ',' + idus + ',' + result[i]['idSubMenu'] + ',0,0)"  title="Activar permiso" >' +
                                '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a>' +
                                '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                            html = htmla + html;
                        }
                    } else {
                        for (var i = 0; i < result.length; i++) {
                            var cont = 0;
                            for (var b = 0; b < encarg.length; b++) {
                                if (result[i]['idSubMenu'] == encarg[b]['idSubMenu']) {
                                    if (encarg[b]['estado'] == 0) {
                                        htmla =
                                            '                        <a  href="#" onclick="activarDesactivarPermiso(' + encarg[b]['idPermiso'] + ',' + idus + ',' + encarg[b]['idSubMenu'] + ',0,0)"  title="Activar permiso" >' +
                                            '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a>' +
                                            '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                                        html = htmla + html;
                                    } else {
                                        htmla =
                                            '                        <a  href="#" onclick="activarDesactivarPermiso(' + encarg[b]['idPermiso'] + ',' + idus + ',' + encarg[b]['idSubMenu'] + ',1,0)"  title="Desactivar permiso" >' +
                                            '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-up text-green"> </i></a>' +
                                            '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                                        html = htmla + html;
                                    }
                                } else {
                                    cont = cont + 1;
                                    if (cont == encarg.length) {
                                        htmla =
                                            '                        <a  href="#" onclick="activarDesactivarPermiso(' + null + ',' + idus + ',' + result[i]['idSubMenu'] + ',0,0)"  title="Activar permiso" >' +
                                            '                         <i class="fas fa-lg fa-fw m-r-10 fa-thumbs-down text-red"> </i></a>' +
                                            '                        <label for="subperm' + result[i]['idSubMenu'] + '">' + result[i]['subTitulo'] + '</label><br>';
                                        html = htmla + html;
                                    }
                                }
                            }

                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}

function cargarvacio() {
    $('#nueperm').prop("hidden", true);
}

function activarDesactivarPermiso(idpermiso, idusu, idsubmenu, estado, lug) {
    window.event.preventDefault();
    var datosperm = {
        idpermiso: idpermiso,
        idusu: idusu,
        idsubmenu: idsubmenu,
        estado: estado,
    };
    datosperm = JSON.stringify(datosperm);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'activar/desactivar permiso',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                    type: 'GET',
                    url: "/cambiarpermiso/" + datosperm,
                    cache: false,
                    dataType: 'json',
                    data: {
                        _token: CSRF_TOKEN
                    },
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                operacionExitosa();
                                if (lug == 0) {
                                    cargarsubmodulosAlma(idusu);
                                } else {
                                    cargarsubmodulosAlmaEdit(idusu);
                                }
                            } else {
                                operacionError(data['error']);
                                //bloquear();
                            }

                        }
                    ,
                    beforeSend: function () {

                    }
                }
            )
            ;
        }
    })

}

function obtenerpermisoseliminar(idus) {
    var url = "/almacen/getPermisos/" + idus;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['result'];
                    var encarg = data['encarg'];
                    for (var i = 0; i < encarg.length; i++) {
                        listidspermisalm[i] = encarg[i]['idPermiso'];
                    }
                } else {

                }
            }

        });
}
function valusuario() {

       var idusuario = $('#iduser').val();
       var idlocal = $('#desclocal').val();
    var url = "/almacen/validarusuario/" + idusuario;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                        var usus = data['usu'];
                        if (usus.length > 0) {
                            for (var i = 0; i < usus.length; i++) {
                                if (usus[i]['lId'] == idlocal && usus[i]['idUsuario'] == idusuario && usus[i]['enEst'] == 1) {
                                    validarCaja('desclocal', 'validarlocal', 'Local Asignado a ese usuario', 0);
                                    validarCaja('nombcompl', 'validarusuario', 'El usuario ya esta asignado a ese local', 0);
                                    $('#enviarencarg').prop("disabled", true);
                                    $('#nueperm').prop("hidden", true);
                                } else {
                                    if (usus[i]['enEst'] == 0 && usus[i]['lId'] == idlocal) {
                                        validarCaja('desclocal', 'validarlocal', 'Local Asignado a ese usuario', 0);
                                        validarCaja('nombcompl', 'validarusuario', 'el usuario ya esta asignado a ese local por favor restaure encargado', 0);
                                        $('#enviarencarg').prop("disabled", true);
                                        $('#nueperm').prop("hidden", true);
                                    } else {
                                        if (usus[i]['enEst'] == 1) {
                                            validarCaja('desclocal', 'validarlocal', 'Local correcto', 1);
                                            validarCaja('nombcompl', 'validarusuario', 'El usuario ya fue asignado a un local', 0);
                                            $('#enviarencarg').prop("disabled", true);
                                            $('#nueperm').prop("hidden", true);
                                        } else {
                                            validarCaja('desclocal', 'validarlocal', 'Local correcto', 1);
                                            validarCaja('nombcompl', 'validarusuario', 'Usuario correcto', 1);
                                            $('#enviarencarg').prop("disabled", false);
                                            $('#nueperm').prop("hidden", false);
                                            cargarsubmodulosAlma(idusuario);
                                        }
                                    }
                                }
                            }

                        } else {
                            validarCaja('desclocal', 'validarlocal', 'Local correcto', 1);
                            validarCaja('nombcompl', 'validarusuario', 'Usuario correcto', 1);
                            $('#enviarencarg').prop("disabled", false);
                            $('#nueperm').prop("hidden", false);
                            cargarsubmodulosAlma(idusuario);
                        }
                }


            }, beforeSend() {
                $('#enviarencarg').prop("disabled", true);
            }

        });
}


function valusuarioEdit() {

        var idusuario = $('#iduseredit').val();
        var idlocal = $('#idlocaledit').val();
        var idused = $('#idusuarioedit').val();
    var url = "/almacen/validarusuario/" + idusuario;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                        var usus = data['usu'];
                        if (usus.length > 0) {
                            for (var i = 0; i < usus.length; i++) {
                                if (usus[i]['idUsuario'] == idused) {
                                    MsmValCorrect(idusuario);
                                } else {
                                    if (usus[i]['lId'] == idlocal && usus[i]['idUsuario'] == idusuario && usus[i]['enEst'] == 1) {
                                        validarCaja('desclocaledit', 'validarlocaledit', 'Local Asignado a ese usuario', 0);
                                        validarCaja('nomusuedit', 'validarusuarioedit', 'El usuario ya esta asignado a ese local', 0);
                                        $('#enviareditencarg').prop("disabled", true);
                                        $('#nuepermedit').prop("hidden", true);
                                    } else {
                                        if (usus[i]['enEst'] == 0 && usus[i]['lId'] == idlocal) {
                                            validarCaja('desclocaledit', 'validarlocaledit', 'Local Asignado a ese usuario', 0);
                                            validarCaja('nomusuedit', 'validarusuarioedit', 'el usuario ya esta asignado a ese local por favor restaure encargado', 0);
                                            $('#enviareditencarg').prop("disabled", true);
                                            $('#nuepermedit').prop("hidden", true);
                                        } else {
                                            if (usus[i]['enEst'] == 1) {
                                                validarCaja('desclocaledit', 'validarlocaledit', 'Local correcto', 1);
                                                validarCaja('nomusuedit', 'validarusuarioedit', 'El usuario ya fue asignado a un local', 0);
                                                $('#enviareditencarg').prop("disabled", true);
                                                $('#nuepermedit').prop("hidden", true);
                                            } else {
                                                MsmValCorrect(idusuario);
                                            }
                                        }
                                    }
                                }

                            }

                        } else {
                            MsmValCorrect(idusuario);
                        }
                }


            }, beforeSend() {
                $('#enviareditencarg').prop("disabled", true);
            }

        });
}

function MsmValCorrect(idusuario) {
    validarCaja('desclocaledit', 'validarlocaledit', 'Local correcto', 1);
    validarCaja('nomusuedit', 'validarusuarioedit', 'Usuario correcto', 1);
    $('#enviareditencarg').prop("disabled", false);
    $('#nuepermedit').prop("hidden", false);
    cargarsubmodulosAlmaEdit(idusuario);
}

function nuevoEncargado() {
    window.event.preventDefault();
    $('#nuevo_modal_encargado').modal('show');
    CargarEjecutoras(0);
}

function validarFormularioEncarg() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#codeje').val() !== '') {
        validarCaja('loc', 'validarlocal', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el local';
        validarCaja('loc', 'validarlocal', text, 0);
    }
    if ($('#dni').val() !== '') {
        validarCaja('user', 'validarusuario', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el usuario';
        validarCaja('user', 'validarusuario', text, 0);
    }
    return cont;
}

function validarFormularioEncargEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#codejeedit').val() !== '') {
        validarCaja('loc', 'validarlocal', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el local';
        validarCaja('loc', 'validarlocal', text, 0);
    }
    if ($('#dniedit').val() !== '') {
        validarCaja('user', 'validarusuario', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el usuario';
        validarCaja('user', 'validarusuario', text, 0);
    }
    return cont;
}
