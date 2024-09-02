var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    $('.modal-backdrop').remove();
    if(parseInt($('#idvi').val())===1){
        $('#modal-dialog_add_producto').modal({show: true, backdrop:'static', keyboard: false});
        //camposadd=[];
        //camposUserAdd();
        //limpiarCaja(camposadd);
        getTipProducto();
        getMarca();
        getPresentacion();
        $('#tipproducto').focus();
    }
tablaProducto();
});

$("#addproducto").on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_producto').modal({show: true, backdrop:'static', keyboard: false});
    getTipProducto();
    getMarca();
    getPresentacion();
});

function abrirModal(e, idprod) {
    e.preventDefault();
    $('#modal-dialog-edit_producto').modal({show: true, backdrop:'static', keyboard: false});
    llenarEditar(idprod);

}
$('#tipproducto').on('change', function () {
    var tipprod=$('#tipproducto').val();
    var url = "/mantenimiento/obtenertipproductoeditar/" + tipprod;
    var text;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#unidm').val(data['result']['umDesc']);
            },beforeSend: function(){
            },

        });
});
$('#editipproducto').on('change', function () {
    var tipprod=$('#editipproducto').val();
    var url = "/mantenimiento/obtenertipproductoeditar/" + tipprod;
    var text;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#ediunidm').val(data['result']['umDesc']);
            },beforeSend: function(){
            },

        });
});
function gettipproductoedit(id) {
    var url = "/mantenimiento/gettipproductoedit/" + id;

    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#veid').val(data[0]['vId']);
                $('#placve').val(data[0]['vPlaca']);
                $('#codpe').val(data[0]['vCodPatri']);
                $('#conke').val(data[0]['vConKil']);
                marcaEdit(data[0]['mId']);
                subMarcaEdit(data[0]['mId'], data[0]['sMId']);
                modeloEdit(data[0]['sMId'], data[0]['moId'])
                tipoVeEdit(data[0]['moId'], data[0]['mTVId'])

                $('#nchasisedit').val(data[0]['vNChasis']);
                $('#nmotoredit').val(data[0]['vNMotor']);
                $('#coloredit').val(data[0]['vColor']);
                $('#descente').val(data[0]['eper']);
                idofice=data[0]['oId'];
                $('#idoficente').val(data[0]['oEId']);
                $('#anfabed').val(data[0]['vAnoFab']);
                $('#nrared').val(data[0]['vNmAro']);



                //  oId
                cargaroficinasededit(data[0]['oId']);

            }
        });
}
function getTipProducto() {
    var url = "/mantenimiento/gettipproducto";
    var select = $('#tipproducto').html('');
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
                    htmla = '<option value="' + data[i]['tpId'] + '">' + data[i]['tpDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function getMarca() {
    var url = "/mantenimiento/getmarca";
    var select = $('#marca').html('');
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
                    htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function getPresentacion() {
    var url = "/mantenimiento/getpresentacion";
    var select = $('#present').html('');
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
                    htmla = '<option value="' + data[i]['psId'] + '">' + data[i]['psDesc'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function llenarEditar(idprod) {
    var url = "/mantenimiento/obtenerproductoeditar/" + idprod;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idproducto').val(data[0]['pCod']);
                tipproductoEdit(data[0]['tpId']);
                marcaEdit(data[0]['mId']);
                presentacionEdit(data[0]['psId']);
                $('#ediprecioc').val(data[0]['pPrecioC']);
                $('#edipreciov').val(data[0]['pPrecioV']);
                $('#ediconteni').val(data[0]['pContenido']);
                $('#edistock').val(data[0]['pStock']);
                $('#ediunidm').val(data[0]['umDesc']);
            }, beforeSend: function () {

            },

        });

}
function tipproductoEdit(id) {
    var url = "/mantenimiento/gettipproducto";
    var arreglo;
    var select = $('#editipproducto').html('');
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
                    if (data[i]['tpId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['tpId'] + '" selected>' + data[i]['tpDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['tpId'] + '">' + data[i]['tpDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function marcaEdit(id) {
    var url = "/mantenimiento/getmarca";
    var arreglo;
    var select = $('#edimarca').html('');
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
                    if (data[i]['mId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['mId'] + '" selected>' + data[i]['mDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['mId'] + '">' + data[i]['mDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function presentacionEdit(id) {
    var url = "/mantenimiento/getpresentacion";
    var arreglo;
    var select = $('#edipresent').html('');
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
                    if (data[i]['psId'].toString() === id.toString()) {
                        htmla = '<option value="' + data[i]['psId'] + '" selected>' + data[i]['psDesc'] + '</option>';
                    } else {
                        htmla = '<option value="' + data[i]['psId'] + '">' + data[i]['psDesc'] + '</option>';
                    }

                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function enviarProd() {
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
                var tipproducto=$('#tipproducto').val();
                var marca = $('#marca').val();
                var precioc = $('#precioc').val();
                var preciov = 0;
                var stock = 0;
                var contenido = 0;
                var present = $('#present').val();

                $.ajax({
                    url: '/mantenimiento/storeproducto',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        tipproducto: tipproducto,
                        marca:marca,
                        precioc:precioc,
                        preciov:preciov,
                        stock:stock,
                        presenta:present,
                        contenido:contenido
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de producto exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                if(parseInt($('#idvi').val())===1){
                                    redirect('/transacciones/compras');
                                }else{
                                    //limpiarCaja(camposadd);
                                    closeModal('modal-dialog_add_producto')
                                    tablaProducto();
                                }
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
            var idproducto=$('#idproducto').val();
            var editipproducto=$('#editipproducto').val();
            var edimarca = $('#edimarca').val();
            var ediprecioc = $('#ediprecioc').val();
            var edipreciov = $('#edipreciov').val();
            var edistock = $('#edistock').val();
            var edicontenido = $('#ediconteni').val();
            var edipresent = $('#edipresent').val();

            $.ajax({
                url: '/mantenimiento/editproducto',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idproducto: idproducto,
                    tipproducto: editipproducto,
                    marca:edimarca,
                    precioc:ediprecioc,
                    preciov:edipreciov,
                    stock:edistock,
                    contenido:edicontenido,
                    presenta:edipresent
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Producto  editado',
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
function tablaProducto(){
    $('#tabla_producto').DataTable({
            ajax: '/mantenimiento/obtenerproducto',
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
                {"targets": 0, "width": "18%", "className": "text-center"},
                {"targets": 1, "width": "15%", "className": "text-center"},
                {"targets": 2, "width": "15%", "className": "text-center"},
                //{"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 3, "width": "15%", "className": "text-center"},
                //{"targets": 5, "width": "15%", "className": "text-center"},
                {"targets": 4, "width": "10%", "className": "text-center"},
                {"targets": 5, "width": "10%", "className": "text-center"},
                {"targets": 6, "width": "10%", "className": "text-center"},
            ],

            columns: [
                {data: 'tpDesc', name: 'tpDesc'},
                {data: 'mDesc', name: 'mDesc'},
                {data: 'psDesc', name: 'psDesc'},
                //{data: 'pContenido', name: 'pContenido'},
                {data: 'pPrecioC', name: 'pPrecioC'},
                //{data: 'pPrecioV', name: 'pPrecioV'},
                //{data: 'pStock', name: 'pStock'},
                {
                    data: function (row) {
                        //let stock = parseFloat(row.cStock);
                        //let gas = parseFloat(row.cons);
                        //let sal = parseFloat(stock - gas);
                        if (row.tpDesc==='GAS')
                            if (parseInt(row.pStock) >= 80)
                                return '<span class="text-green-transparent-6">' + row.pStock + '</span>' ;
                            else {
                                    if((parseInt(row.pStock) >= 50) && (parseInt(row.pStock)<= 80))
                                        return '<span class="text-yellow-transparent-6">' + row.pStock + '</span>';
                                    else{
                                        return '<span class="text-danger">' + row.pStock + '</span>';
                                }

                            }

                        else {
                            return '<span class="text-black-50">' + row.pStock+ '</span>';
                        }

                    }

                },
                {
                    data: function (row) {
                        return parseInt(row.pEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.pEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="abrirModal(event,' + row.pCod + ')" TITLE="Editar producto" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar producto" onclick="eliminarProducto(' + row.pCod + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar producto" onclick="eliminarProducto(' + row.pCod + ')">\n' +
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
    if ($('#producto').val() !== '0') {
        validarCaja('producto', 'validproducto', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Producto';
        validarCaja('producto', 'validproducto', text, 0);
        $('#producto').focus();
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
                        $('#enviarprod').prop("disabled", false);
                        $('#nummeta').val(val);
                    }
                }

            }, beforeSend() {
                $('#enviarprod').prop("disabled", true);
            }

        });
}
function eliminarProducto(idprod){
    var url = "/mantenimiento/deleteproducto/" + idprod;
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
                            tablaProducto();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Producto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                           tablaProducto();
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
