var existm=0;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    CargarTipoMaterial(0);
});

$(function () {
    $('#tabla_tipom').DataTable({
            ajax: '/almacen/getTipoMate',
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
                {data: 'tmDesc', name: 'tmDesc'},
                {data: 'tmFecCrea', name: 'tmFecCrea'},
                {data: 'uname', name: 'uname'},
                {
                    data: function (row) {
                        return parseInt(row.tmEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tmEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="obtenerTipomEdit(' + row.tmId + ')" TITLE="Editar Tipo Material" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Tipo Material" onclick="eliminartipm(' + row.tmId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Tipo Material" onclick="eliminartipm(' + row.tmId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );

});
function valTipMaterial() {
    var tipm = $('#desctipom').val();
    var url = "/almacen/validarTipMaterial/" + tipm;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['tipm'];
                    if (result.length>0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'El Tipo de Material ya esta registrado',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        validarCaja('desctipom', 'validartipom', 'El Tipo de Material ya fue registrado', 0);
                        if(result[0]['tmEst']==0){
                            $('#idtipm').val(result[0]['tmId']);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                type: 'warning',
                                title: 'El Tipo de Material ya esta registrado, Si desea restaurar haga clic en guardar',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            existm=1;
                            $('#enviartipom').prop("disabled", false);
                        }

                    }
                    else {
                        validarCaja('desctipom', 'validartipom', 'Tipo de Material correcto', 1);
                        $('#enviartipom').prop("disabled", false);
                        existm=0;
                    }
                }

            }, beforeSend() {
                $('#enviartipom').prop("disabled", true);
            }

        });
}
function enviarTipm() {
    if(existm==1){
        var idtipm=$('#idtipm').val();
        eliminartipmExis(idtipm);
    }else{
        if(validarFormularioTipM()===0){
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
                    var destipm = $('#desctipom').val();
                    $.ajax({
                        url: '/almacen/storeTipoM',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            destipm: destipm,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/almacen/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Tipo de Material exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/almacen/datosgenerales');
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
                            $('#enviartipom').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarMate() {
    if(existm==1){
        var idtipm=$('#idtipm').val();
        eliminartipmExis(idtipm);
    }else{
        if(validarFormularioMaterial()===0){
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
                    var codmate = $('#codmate').val();
                    var desmate = $('#descmate').val();
                    var destipm = $('#desctipm').val();
                    var desconcen = $('#descconc').val();
                    var despres = $('#descpres').val();
                    $.ajax({
                        url: '/almacen/storeMate',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            codmate:codmate,
                            desmate:desmate,
                            destipm: destipm,
                            desconcen:desconcen,
                            despres:despres,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    redirect('/almacen/datosgenerales');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de Material exitoso',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    //location.reload();
                                } else {
                                    redirect('/almacen/datosgenerales');
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
                            $('#enviarmate').prop("disabled", true);
                        }
                    });
                }
            });
        }else{
            operacionSubsanar();
        }
    }
}
function enviarMateEdit() {
    if(validarFormularioMaterial()===0){
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
                var idmate = $('#idmate').val();
                var codmate = $('#codmate').val();
                var desmate = $('#descmate').val();
                var destipm = $('#desctipm').val();
                var desconcen = $('#descconc').val();
                var despres = $('#descpres').val();
                $.ajax({
                    url: '/almacen/editMate',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idmate: idmate,
                        codmate:codmate,
                        desmate:desmate,
                        destipm: destipm,
                        desconcen:desconcen,
                        despres:despres,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Material  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/almacen/datosgenerales');
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
                                redirect('/almacen/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarmateEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function enviarTipMEdit() {
    if(validarFormularioTipM()===0){
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
                var idtipm = $('#idtipm').val();
                var desctipm = $('#desctipom').val();

                $.ajax({
                    url: '/almacen/editTipoMate',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipm: idtipm,
                        desctipm: desctipm,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Tipo de Material  editado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                redirect('/almacen/datosgenerales');
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
                                redirect('/almacen/datosgenerales');

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarTipmEdit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function obtenerTipomEdit(val){
    $('#btngtm').prop("hidden", true);
    $('#btnetm').prop("hidden", false);
    var url = "/almacen/getTipMEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtipm').val(data['tmId']);
                $('#desctipom').val(data['tmDesc']);
                $('#desctipom').focus();
            }

        });
}
function obtenerMaterialEdit(val){
    $('#btngmate').prop("hidden", true);
    $('#btnemate').prop("hidden", false);
    var url = "/almacen/getMateEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idmate').val(data['mId']);
                $('#codmate').val(data['mCodMed']);
                $('#descmate').val(data['mMedNom']);
                $('#descconc').val(data['mMedCnc']);
                $('#descpres').val(data['mMedPres']);
                CargarTipoMaterial(data['tmId']);
                $('#codmate').focus();
            }

        });
}
function eliminartipmExis(idtipm) {
    var url = "/almacen/deleteTipM/" + idtipm;
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
                            redirect('/almacen/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo de Material restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/datosgenerales');
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
function eliminartipm(idtipm) {
    var url = "/almacen/deleteTipM/" + idtipm;
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
                            redirect('/almacen/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo de Material eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/datosgenerales');
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
function eliminarmaterial(idmate) {
    var url = "/almacen/deleteMate/" + idmate;
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
                            redirect('/almacen/datosgenerales');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Material eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/almacen/datosgenerales');
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
function CargarTipoMaterial(id){
    var url = "/almacen/getTipM";
    var arreglo;
        var select = $('#desctipm').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                console.log(data);
                if (data['error'] === 0) {
                    var result = data['tipm'];
                    var htmla = '';
                    for (var i = 0; i < result.length; i++) {
                        if(result[i]['tmId'].toString() === id.toString()){
                            htmla = '<option value="' + result[i]['tmId'] + '"selected>' + result[i]['tmDesc'] + '</option>';
                            html = html + htmla;
                        }else{
                            htmla = '<option value="' + result[i]['tmId'] + '">' + result[i]['tmDesc'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                }

            }

        });
}
$(function () {
    $('#tabla_Material').DataTable({
            ajax: '/almacen/getMate',
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
                {"targets": 2, "width": "10%", "className": "text-left"},
                {"targets": 3, "width": "3%", "className": "text-left"},
                {"targets": 4, "width": "3%", "className": "text-left"},
                {"targets": 5, "width": "3%", "className": "text-center"},
                {"targets": 6, "width": "3%", "className": "text-left"},
                {"targets": 7, "width": "3%", "className": "text-center"},
                {"targets": 8, "width": "3%", "className": "text-center"},
            ],

            columns: [
                {data: 'mCodMed', name: 'mCodMed'},
                {data: 'mMedNom', name: 'mMedNom'},
                {data: 'tmDesc', name: 'tmDesc'},
                {data: 'mMedCnc', name: 'mMedCnc'},
                {data: 'mMedPres', name: 'mMedPres'},
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
                                '<a href="#"  onclick="obtenerMaterialEdit(' + row.mId + ')" TITLE="Editar Material" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: #ff0000" TITLE="Eliminar Material" onclick="eliminarmaterial(' + row.mId + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar Material" onclick="eliminarmaterial(' + row.mId + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                },

            ]
        }

    );

});
function cancelartipm(){
    $('#btngtm').prop("hidden",false);
    $('#btnetm').prop("hidden",true);
    $('#desctipom').val("");
    $('#desctipom').focus();
    existm=0;
}
function cancelarMate(){
    $('#btngmate').prop("hidden",false);
    $('#btnemate').prop("hidden",true);
    $('#codmate').val("");
    $('#descmate').val("");
    $('#descconc').val("");
    $('#descpres').val("");
    $('#codmate').focus();
    $('#desctipm').select().val(0);
    existm=0;
}
function validarFormularioTipM() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#desctipom').val() !== '') {
        validarCaja('desctipom', 'validartipom', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del Tipo de Material';
        validarCaja('desctipom', 'validartipom', text, 0);
    }
    return cont;
}
function validarFormularioMaterial() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#descmate').val() !== '') {
        validarCaja('descmate', 'validardescmate', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese la descripcion del Material';
        validarCaja('descmate', 'validardescmate', text, 0);
    }
    if ($('#desctipm').val() !=='0') {
        validarCaja('desctipm', 'validardesctipm', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione el Tipo de Material';
        validarCaja('desctipm', 'validardesctipm', text, 0);
    }
    return cont;
}
