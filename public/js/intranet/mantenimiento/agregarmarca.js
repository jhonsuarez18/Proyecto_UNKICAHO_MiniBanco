
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
tablaMarca();
});

$("#addmarca").on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_marca').modal({show: true, backdrop:'static', keyboard: false});
});

function abrirModal(e, idmarca) {
    e.preventDefault();
    $('#modal-dialog-edit_marca').modal({show: true, backdrop:'static', keyboard: false});
    llenarEditar(idmarca);

}

function llenarEditar(idmarca) {
    var url = "/mantenimiento/obtenermarcaeditar/" + idmarca;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idmarca').val(data['result']['mId']);
                $('#edmarca').val(data['result']['mDesc']);
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
                var marca = $('#marca').val();
                $.ajax({
                    url: '/mantenimiento/storemarca',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        marca: marca,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de marca exitoso',
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
            var idmarca = $('#idmarca').val();
            var marca = $('#edmarca').val();
            $.ajax({
                url: '/mantenimiento/editmarca',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idmarca: idmarca,
                    marca: marca,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Marca  editado',
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
function tablaMarca(){
    $('#tabla_marca').DataTable({
            ajax: '/mantenimiento/obtenermarca',
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
                {"targets": 0, "width": "2%", "className": "text-center"},
                {"targets": 1, "width": "4%", "className": "text-center"},
                {"targets": 2, "width": "4%", "className": "text-center"},
            ],

            columns: [
                {data: 'mDesc', name: 'mDesc'},
                {
                    data: function (row) {
                        return parseInt(row.mEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.mEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="abrirModal(event,' + row.mCod + ')" TITLE="Editar marca" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar marca" onclick="eliminarMarca(' + row.mCod + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar marca" onclick="eliminarMarca(' + row.mCod + ')">\n' +
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
    if ($('#marca').val() !== '0') {
        validarCaja('marca', 'validmarca', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Marca';
        validarCaja('marca', 'validmarca', text, 0);
        $('#marca').focus();
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
function eliminarMarca(idmarca){
    var url = "/mantenimiento/deletemarca/" + idmarca;
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
                            tablaMarca();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Marca eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
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
                                timer: 3000
                            });

                        }
                    }

                });

        }
    })
}
