var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    tablaTipProducto();
});

$("#addtipproducto").on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_tipproducto').modal({show: true, backdrop:'static', keyboard: false});
    getUnidM()
});

function abrirModal(e, idtipprod) {
    e.preventDefault();
    $('#modal-dialog-edit_tipproducto').modal({show: true, backdrop:'static', keyboard: false});
    llenarEditar(idtipprod);

}
function getUnidM() {
    var url = "/mantenimiento/getunidm";
    var select = $('#unidm').html('');
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
                    htmla = '<option value="' + data[i]['umId'] + '">' + data[i]['umDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function UnidMEdit(id) {
    var url = "/mantenimiento/getunidm";
    var arreglo;
    var select = $('#edunidm').html('');
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
                    if (data[i]['umId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['umId'] + '" selected>' + data[i]['umDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['umId'] + '">' + data[i]['umDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function llenarEditar(idtipprod) {
    var url = "/mantenimiento/obtenertipproductoeditar/" + idtipprod;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idtipproducto').val(data['result']['tpId']);
                $('#edtipproducto').val(data['result']['tpDesc']);
                UnidMEdit((data['result']['idUm']));
            }, beforeSend: function () {

            },

        });

}
function enviar() {
    if (validarFormulario() === 0) {
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
                var tipproducto = $('#tipproducto').val();
                var unidmd = $('#unidm').val();

                $.ajax({
                    url: '/mantenimiento/storetipproducto',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        tipproducto: tipproducto,
                        unidm: unidmd,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de tipo producto exitoso',
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

            }
        });
    }else{
        operacionSubsanar();
    }
}

function enviarEditProd() {
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
            var idtipproducto = $('#idtipproducto').val();
            var edtipproducto = $('#edtipproducto').val();
            var edunidm = $('#edunidm').val();
            $.ajax({
                url: '/mantenimiento/edittipproducto',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    idtipproducto: idtipproducto,
                    tipproducto: edtipproducto,
                    unidm: edunidm,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo Producto  editado',
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
                    $('#enviared').prop("disabled", true);
                }
            });


        }
    });

}
function tablaTipProducto(){
    $('#tabla_tipproducto').DataTable({
            ajax: '/mantenimiento/obtenertipproducto',
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
                {"targets": 0, "width": "40%", "className": "text-center"},
                {"targets": 1, "width": "30%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 3, "width": "10%", "className": "text-center"},
            ],

            columns: [
                {data: 'tpDesc', name: 'tpDesc'},
                {data: 'umDesc', name: 'umDesc'},
                {
                    data: function (row) {
                        return parseInt(row.tpEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.tpEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="abrirModal(event,' + row.tpCod + ')" TITLE="Editar tipo producto" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar tipo producto" onclick="eliminarTipProducto(' + row.tpCod + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar tipo producto" onclick="eliminarTipProducto(' + row.tpCod + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }

            ]
        }
    );

}

function validarFormulario() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;
    if ($('#tipproducto').val() !== '0') {
        validarCaja('tipproducto', 'validtipproducto', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Producto';
        validarCaja('tipproducto', 'validtipproducto', text, 0);
        $('#tipproducto').focus();
    }

    return cont;
}


function valNumMeta() {
    var val = $('#nummeta').val();
    val = zeroFill(val, 4);
    var url = "/presupuesto/validarmeta/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['met'];
                    if (parseInt(result[0]['cant']) > 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'La meta ya esta registrada',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        validarCaja('nummeta', 'validnummeta', 'El numero de meta ya fue registrado', 0);
                        $('#nummeta').val(val);
                    }
                    else {
                        validarCaja('nummeta', 'validnummeta', 'Nro de meta correcto', 1);
                        $('#enviar').prop("disabled", false);
                        $('#nummeta').val(val);
                    }
                }

            }, beforeSend() {
                $('#enviar').prop("disabled", true);
            }

        });
}
function eliminarTipProducto(idtipprod){
    var url = "/mantenimiento/deletetipproducto/" + idtipprod;
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
                            tablaTipProducto();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Tipo Producto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tablaTipProducto();
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
