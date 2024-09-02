var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    $('.modal-backdrop').remove();
    if(parseInt($('#idvi').val())===1){
        $('#modal-dialog_add_proveedor').modal({show: true, backdrop:'static', keyboard: false});
        //camposadd=[];
        //camposUserAdd();
        //limpiarCaja(camposadd);
        //datePickers();
        departamento('deparpro',0);
        provincia('provpro',1,0);
        $('#ruc').focus();
    }
    tablaProveedor();
});
function valRuc() {
    event.preventDefault();
    if(validarDniExpres('enviarprov','ruc','tipdoc','valruc')===0){
        var ruc = $('#ruc').val();
        var url = "/mantenimiento/getProveeRuc/" + ruc;
        var text;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        var proveedor = data['proveedor'];
                            if(proveedor!==null){
                                //$('#tipdoccl').prop("disabled", true);
                                $('#razons').val(proveedor['pvRazonS'])
                                $('#telefono').val(proveedor['pvTelefono'])
                                $('#direccion').val(proveedor['pvDireccion'])

                                departamento('deparpro',proveedor['idDepartamento']);
                                provincia('provpro',proveedor['idDepartamento'],proveedor['idProvincia']);
                                distrito('dispro',proveedor['idProvincia'],proveedor['dtId']);


                                desbloquear();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    type: 'warning',
                                    title: 'El proveedor ya esta registrado',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#enviarprov').prop("disabled", true);
                                sit=3;
                            }else{
                                api_consulta_doc();
                                //limpiarCaja(camposadd);
                                sit=1;
                            }
                        //desbloquear();
                    } else {

                    }
                },beforeSend: function(){
                    //bloquear();
                },

            });

    }
}
function api_consulta_doc(){
    var tipdoc = $('#tipdoc').val();
    var ruc = $('#ruc').val();
    var url = "/mantenimiento/getapiclient/"+ tipdoc+"/" + ruc;
    var text;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var proveedor = data['apicliente'];
                        if(tipdoc==='3'){
                            if(proveedor['razonSocial']===""){
                                operacionErrorApi(proveedor['razonSocial']);
                                //habi_deshabi_campos(false);
                                $('#razons').focus()
                            }else{
                                //habi_deshabi_campos(true);
                                $('#razons').val(proveedor['razonSocial']);
                                $('#telefono').focus();
                            }
                            if(proveedor['message']==="ruc no valido"){
                                var inicio=proveedor['message'];
                                text = inicio + ' Ingrese uno correcto';
                                validarCaja('razons', 'valrazons', text, 0);
                            }
                        }
                } else {

                }
            },beforeSend: function(){
                //bloquear();
            },

        });
}
$("#addproveedor").on('click', function () {
    window.event.preventDefault();
    $('#modal-dialog_add_proveedor').modal({show: true, backdrop:'static', keyboard: false});
    departamento('deparpro',0);
});
$('#deparpro').on('change', function () {
    provincia('provpro',this.value);
    var prov = $('#deparpro');
    var provvalid = $('#valdeparpro');

    if (this.value === '0') {
        $('#provpro').prop('disabled', true);
        validarCaja('deparpro', 'valdeparpro', 'Escoja departamento', 0)
    }
    else {
        $('#provpro').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provpro').focus();
    }
});
$('#deparproedit').on('change', function () {
    provincia('provproedit', this.value,0);
    var prov = $('#deparproedit');
    var provvalid = $('#valdeparproedit');

    if (this.value === '0') {
        $('#provproedit').prop('disabled', true);
        validarCaja('deparproedit', 'valdeparproedit', 'Escoja departamento', 0)
    } else {
        $('#provproedit').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#provproedit').focus();
    }
});
$('#provpro').on('change', function () {
    distrito('dispro',this.value, 0);
    var prov = $('#provpro');
    var provvalid = $('#valprovpro');

    if (this.value === '0') {
        $('#dispro').prop('disabled', true);
        validarCaja('provpro', 'valprovrpo', 'Escoja provincia', 0)
    }
    else {
        $('#dispro').prop('disabled', false);
        provvalid.removeClass('valid-feedback');
        prov.removeClass('is-valid');
        prov.removeClass('is-invalid');
        provvalid.addClass('invalid-feedback');
        $('#dispro').focus();
    }
});
$('#provproedit').on('change', function () {
    distrito('disproedit',this.value, 0);
    var provacte = $('#provproedit');
    var valprovacte = $('#valprovproedit');

    if (this.value === '0') {
        $('#disproedit').prop('disabled', true);
        validarCaja('provproedit', 'valprovproedit', 'Escoja provincia', 0)
    }
    else {
        $('#disproedit').prop('disabled', false);
        valprovacte.removeClass('valid-feedback');
        provacte.removeClass('is-valid');
        provacte.removeClass('is-invalid');
        valprovacte.addClass('invalid-feedback');
        $('#disproedit').focus();
    }
});
$('#dispro').on('change', function () {

    var dis = $('#dispro');
    var disval = $('#valdispro');

    if (this.value === '0') {
        validarCaja('dispro', 'valdispro', 'Escoja distrito', 0)
    }
    else {
        disval.removeClass('valid-feedback');
        dis.removeClass('is-valid');
        dis.removeClass('is-invalid');
        disval.addClass('invalid-feedback');
        $('#direccion').focus();
    }
});
$('#disproedit').on('change', function () {
    var disacte = $('#disproedit');
    var valdisacte = $('#valdisproedit');

    if (this.value === '0') {
        $('#estate').prop('disabled', true);
        validarCaja('disproedit', 'valdisproedit', 'Escoja distrito', 0)
    }
    else {
        $('#estate').prop('disabled', false);
        valdisacte.removeClass('valid-feedback');
        disacte.removeClass('is-valid');
        disacte.removeClass('is-invalid');
        valdisacte.addClass('invalid-feedback');
        $('#estate').focus();
    }
});
function abrirModal(e,idprov) {
    e.preventDefault();
    $('#modal-dialog-edit_proveedor').modal({show: true, backdrop:'static', keyboard: false});
    llenarEditar(idprov);

}

function llenarEditar(idprov) {
    var url = "/mantenimiento/obtenerproveedoreditar/" + idprov;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idproveedor').val(data['result']['pvCod']);
                $('#rucedit').val(data['result']['pvRuc']).focus();
                $('#razonsedit').val(data['result']['pvRazonS']).prop('disabled',true);
                $('#telefonoedit').val(data['result']['pvTelefono']);
                $('#direccionedit').val(data['result']['pvDireccion']);
                departamento('deparproedit',data['result']['idDepartamento']);
                provincia('provproedit',data['result']['idDepartamento'],data['result']['idProvincia']);
                distrito('disproedit',data['result']['idProvincia'],data['result']['dtId']);
            }, beforeSend: function () {

            },

        });

}
function enviarProv() {
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
                var razons = $('#razons').val();
                var ruc = $('#ruc').val();
                var telefono = $('#telefono').val();
                var distrito = $('#dispro').val();
                var direccion = $('#direccion').val();
                $.ajax({
                    url: '/mantenimiento/storeproveedor',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        razons: razons,
                        ruc: ruc,
                        telefono: telefono,
                        distrito: distrito,
                        direccion: direccion,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de proveedor exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                if(parseInt($('#idvi').val())===1){
                                    redirect('/transacciones/compras');
                                }else{
                                    //limpiarCaja(camposadd);
                                    closeModal('modal-dialog_add_proveedor')
                                    tablaProveedor();
                                    //iniciarcampos();
                                }
                                //location.reload();
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
                        $('#enviarprov').prop("disabled", true);
                    }
                });

            }
        });
    }else{
        operacionSubsanar();
    }
}

function enviarProvEdit() {
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
            var idprov = $('#idproveedor').val();
            var razons = $('#razonsedit').val();
            var ruc = $('#rucedit').val();
            var telefono = $('#telefonoedit').val();
            var distrito = $('#disproedit').val();
            var direccion = $('#direccionedit').val();
            $.ajax({
                url: '/mantenimiento/editproveedor',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    idprov: idprov,
                    razons: razons,
                    ruc: ruc,
                    telefono: telefono,
                    distrito: distrito,
                    direccion: direccion,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Proveedor  editado',
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
                    $('#enviarprovedit').prop("disabled", true);
                }
            });


        }
    });

}
function tablaProveedor(){
    $('#tabla_proveedor').DataTable({
            ajax: '/mantenimiento/obtenerproveedor',
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
                {"targets": 1, "width": "4%", "className": "text-left"},
                {"targets": 2, "width": "4%", "className": "text-center"},
                {"targets": 3, "width": "4%", "className": "text-center"},
                {"targets": 4, "width": "4%", "className": "text-center"},
                {"targets": 5, "width": "4%", "className": "text-center"},
            ],

            columns: [
                {data: 'pvRuc', name: 'pvRuc'},
                {data: 'pvRazonS', name: 'pvRazonS'},
                //{data: 'pvTelefono', name: 'pvTelefono'},
                //{data: 'pvDireccion', name: 'pvDireccion'},
                {
                    data: function (row) {
                        return row.pvTelefono === null ? '<span class="text-black-50">--------</span>' :  '<span class="text-black-50">' + row.pvTelefono+ '</span>';

                    }
                },
                {
                    data: function (row) {
                        return row.pvDireccion === null ? '<span class="text-black-50">--------</span>' :  '<span class="text-black-50">' + row.pvDireccion+ '</span>';

                    }
                },
                {
                    data: function (row) {
                        return parseInt(row.pvEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.pvEst) === 1) {
                            return '<tr >\n' +
                                '<a href="#"  onclick="abrirModal(event,' + row.pvCod + ')" TITLE="Editar proveedor" >\n' +
                                '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                '<a href="#" style="color: red" TITLE="Eliminar proveedor" onclick="eliminarProveedor(' + row.pvCod + ')">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                '</tr>';
                        } else {
                            return '<tr >\n' +
                                '<a href="#" style="color: green" TITLE="Activar proveedor" onclick="eliminarProveedor(' + row.pvCod + ')">\n' +
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
    if ($('#ruc').val() !== '0') {
        validarCaja('ruc', 'valrazons', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Razon Social';
        validarCaja('razons', 'valrazons', text, 0);
        $('#razons').focus();
    }
    if ($('#ruc').val() !== '0') {
        validarCaja('ruc', 'valruc', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Ruc';
        validarCaja('ruc', 'valruc', text, 0);
        $('#ruc').focus();
    }
    if ($('#telefono').val() !== '0') {
        validarCaja('telefono', 'valtelefono', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Telefono';
        validarCaja('telefono', 'valtelefono', text, 0);
        $('#telefono').focus();
    }
    if ($('#direccion').val() !== '0') {
        validarCaja('direccion', 'valdireccion', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingresa Direccion';
        validarCaja('direccion', 'valdireccion', text, 0);
        $('#direccion').focus();
    }
    return cont;
}


/*function valNumMeta() {
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
}*/
function eliminarProveedor(idprov){
    var url = "/mantenimiento/deleteproveedor/" + idprov;
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
                            tablaProveedor();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Proveedor eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            tablaProveedor();
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
