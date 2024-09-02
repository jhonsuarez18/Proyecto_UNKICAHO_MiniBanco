var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    tablaVenta();
    if(parseInt($('#idvi').val())===1){
        $('#modal-dialog_add_venta').modal({show: true, backdrop:'static', keyboard: false});
        //getProveedor();
        getProducto();
    }
});
var tab = [];
$("#addventa").on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_venta').modal({show: true, backdrop:'static', keyboard: false});
    //getProveedor();
    getProducto();
});
$('#producto').on('change', function () {
    var prod=$('#producto').val();
    var url = "/mantenimiento/obtenerproductoeditar/" + prod;
    var text;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#preciov').val(data[0]['pPrecioC']);
                $('#stock').val(data[0]['pStock']);
                $('#preciov').focus();
            },beforeSend: function(){
                //bloquear();
            },

        });
});
$('#client').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/mantenimiento/client",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.clId,
                        name: item.person,
                    });
                });
                process(bondNames);
            }
        });
    }
    , updater: function (item) {
        let idcentp = $('#idcl');
        idcentp.val('');
        idcentp.val(item.id);
        return item;
    }

});
function validpreciot() {
    event.preventDefault();
    calprectotal()
}
function validpreciot() {
    event.preventDefault();
    calprectotal()
}
function getProveedor() {
    var url = "/mantenimiento/getproveedor";
    var select = $('#proveedor').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var result = data['result'];
                var htmla = '';
                for (var i = 0; i < result.length; i++) {
                    htmla = '<option value="' + result[i]['pvCod'] + '">' + result[i]['pvProv'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
$("#movil").on('change', function () {
    if ($(this).is(':checked')) {
        $('#grval').prop("hidden", false);
        $('#cantval').val(1);
        $('#preciov').val(1);
        $('#cantval').focus();
    } else {
        $('#grval').prop("hidden", true);
        $('#cantval').val(0);
        $('#preciov').val(0);
    }
});
$("#benefise").on('change', function () {
    if ($(this).is(':checked')) {
        $('#grbenval').prop("hidden", false);
        //$('#nomben').val(1);
        //$('#dniben').val(1);
        $('#nomben').focus();
    } else {
        $('#grbenval').prop("hidden", true);
        //$('#nomben').val(0);
        //$('#dniben').val(0);
    }
});
function addcliente(){
    redirect('/mantenimiento/cliente');
}
/*function valCliDni() {
    var dni = $('#idcl').val();
     if(dni==0){
         Swal.fire({
             title: 'Cliente no Registrado',
             text: 'Desea registrarlo?',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, acepto',
             cancelButtonText: 'no, cancelar'
         }).then((result) => {
             if (result.value) {
                 redirect('/mantenimiento/cliente');
             }
         });
     }

}*/
function getProducto() {
    var url = "/mantenimiento/getproducto";

    var select = $('#producto').html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var result = data['result'];
                var htmla = '';
                for (var i = 0; i < result.length; i++) {
                    htmla = '<option value="' + result[i]['pCod'] + '">' + result[i]['product'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}
function calprectotal(){
    var cantval=$('#cantval').val()
    var precval=$('#precioval').val()
    $('#preciotval').val(cantval*precval)
    var total=0;
    for (var i = 0; i < tab.length; i++) {
        total=tab[i]['preciov']*tab[i]['cant']+total;
    }
    $('#totalp').val(total-(cantval*precval));
}
$('#adddetv').on('click', function () {
    var producto = $('#producto');
    var preciov = $('#preciov').val();
    var stock = $('#stock').val();
    var cant = $('#cant').val();
    if (producto.children("option:selected").val().toString() !== '0' && preciov > 0 && cant > 0  ) {
if (parseInt(cant)>0){
    var tabl = new Array();
    tabl["idp"] = producto.children("option:selected").val();
    tabl["textp"] = producto.children("option:selected").text();
    tabl["preciov"] = preciov;
    tabl["cant"] = cant;
    tabl["subt"] = cant*preciov;

    var ubi = 0;
    for (var i = 0; i < tab.length; i++) {
        if (tab[i]['idp'].toString() === tabl['idp'] ) {
            ubi = 1;
        }
    }
    if (ubi === 0) {
        tab.push(tabl);

    }
    tabdetvent();
    calprectotal()
}else{
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        type: 'error',
        title: 'ocurrio un error!',
        text: 'La cantidad supero al stock',
        showConfirmButton: false,
        timer: 3000
    });
    $('#producto').focus();
}
    } else {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            type: 'error',
            title: 'ocurrio un error!',
            text: 'Ingrese los valores correctos',
            showConfirmButton: false,
            timer: 3000
        });
        $('#producto').focus();
    }


});
$('#buscarbene').on('click', function () {
     var dni = $('#dniben').val();
     var nomb = $('#nomben').val();
    cargartablabenef(dni,nomb);
});
function tabdetvent() {
    ordenarTabla();
    $('#tab_detventa').DataTable({
            data: tab,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },

            destroy: true,
            decimal: ",",
            thousands: ".",
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
            footerCallback: function (row, data, start, end, display) {
                var totalAmount = 0;
                const formatter = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                });
                for (var i = 0; i < data.length; i++) {
                    totalAmount += parseFloat(data[i]['subt']);
                }
                totalAmount = formatter.format(totalAmount);
                $(this.api().column(3).footer()).html(totalAmount);
            },
            columnDefs: [
                {"targets": 0, "width": "30%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
                {"targets": 3, "width": "20%", "className": "text-center"},
                {"targets": 4, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'textp', name: 'textp'},
                {data: 'cant', name: 'cant'},
                {data: 'preciov', name: 'preciov'},
                {
                    data: 'subt',
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="quitar(' + row.idp+ ')" TITLE="Quitar" >\n' +
                            '<i class="text-danger fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );

}
function ordenarTabla() {

    tab.sort(sortFunction);

    function sortFunction(a, b) {
        if (a[0] === b[0]) {
            return 0;
        } else {
            return (a[0] < b[0]) ? -1 : 1;
        }
    }
}
function quitar( idp) {
    var ubi = null;
    for (var i = 0; i < tab.length; i++) {
        if (tab[i]['idp'].toString() === idp.toString()) {
            ubi = i;
        }
    }
    tab.splice(ubi, 1);
    tabdetvent();
}
function enviarrec() {
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
                var idcliente = $('#idcl').val();
                var cantval = 0;
                var precval = 0;
                var arrpv = [], arrp = [], arrct = [];
                for (var i = 0; i < tab.length; i++) {
                    arrpv[i] = tab[i]['preciov'];
                    arrp[i] = tab[i]['idp'];
                    arrct[i] = tab[i]['cant'];
                }
                var _token = $('meta[name="csrf-token"]').attr('content');
                arrct = JSON.stringify(arrct);
                arrp = JSON.stringify(arrp);
                arrpv = JSON.stringify(arrpv);
                $.ajax({
                    url: '/transacciones/storeventa',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idcli: idcliente,
                        arrp:arrp,
                        arrpv:arrpv,
                        arrct:arrct,
                        cantval:cantval,
                        precval:precval,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Recepcion exitoso',
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
function tablaVenta(){
    $('#tabla_venta').DataTable({
            ajax: '/transacciones/obtenerventa',
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
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "15%", "className": "text-left"},
                {"targets": 2, "width": "15%", "className": "text-left"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "15%", "className": "text-center"},
                {"targets": 5, "width": "15%", "className": "text-center"},
                {"targets": 6, "width": "10%", "className": "text-center"},
                {"targets": 7, "width": "10%", "className": "text-center"},
                {"targets": 8, "width": "10%", "className": "text-center"},
            ],

            columns: [
                {data: 'codvent', name: 'codvent'},
                {data: 'cliente', name: 'cliente'},
                {data: 'product', name: 'product'},
                {data: 'vpCant', name: 'vpCant'},
                {data: 'vpPrecioV', name: 'vpPrecioV'},
                {data: 'total', name: 'total'},
                {data: 'vFecCrea', name: 'vFecCrea'},
                {
                    data: function (row) {
                        return parseInt(row.vEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.vpEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar producto" onclick="eliminarVenta(1, '+ row.vpCod + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar producto" onclick="eliminarVenta(0,' + row.vpCod + ')">\n' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                '</tr>';
                        }
                    }
                }

            ]
        }
    );

}
function cargartablabenef($dni,$nomb){
    $('#tab_beneficiario').DataTable({
            ajax: '/mantenimiento/getbenef/'+$dni+'/'+$nomb,
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
                {"targets": 0, "width": "40%", "className": "text-left"},
                {"targets": 1, "width": "20%", "className": "text-center"},
                {"targets": 1, "width": "30%", "className": "text-left"},
            ],

            columns: [
                {data: 'beneficiario', name: 'beneficiario'},
                {data: 'dni', name: 'dni'},
                {data: 'distrito', name: 'distrito'},
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
    if ($('#idcl').val() !== '0') {
        validarCaja('client', 'validclient', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Cliente';
        validarCaja('client', 'validclient', text, 0);
        $('#client').focus();
    }

    return cont;
}
function eliminarVenta(est,idprod){
    var url = "/transacciones/deleteventa/"+est+"/" + idprod;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara/restaurara producto comprado',
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
                            tablaVenta();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Producto eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tablaVenta();
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
