var cnt=0;
var idp=0;
var idp1=0;
var idsm=0;
var contp=0;
var idofic=0;
var camposadd = [];
var exist=0;
var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
$(document).ready(function (){
    tabla_PermUsu();
});
function camposAsigPermAdd() {
    var tablacampos = new Array();
    tablacampos[0] = "userref";
    tablacampos[1] = "validaruserref";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dni";
    tablacampos[1] = "validardni";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "nombcompl";
    tablacampos[1] = "validarnombcompl";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "descent";
    tablacampos[1] = "validardescent";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarusuofic').prop("disabled", false);
}
function camposAsigPermEdit() {
    var tablacampos = new Array();
    tablacampos[0] = "userrefedit";
    tablacampos[1] = "validaruserrefedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "dniedit";
    tablacampos[1] = "validardniedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "nombcompledit";
    tablacampos[1] = "validarnombcompledit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);
    tablacampos = [];
    tablacampos[0] = "descentedit";
    tablacampos[1] = "validardescentedit";
    tablacampos[2] = 1;
    camposadd.push(tablacampos);

    $('#enviarusuoficedit').prop("disabled", false);
}
$('#desclocal').on('change', function () {
    $('#idlocal').val(this.value);
});
$('#desclocaledit').on('change', function () {
    $('#idlocaledit').val(this.value);
});
function cerrarmodal(){
    //location.reload();
}
$('#userref').typeahead({

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

        var idfin = $('#idusof');
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
$('#userrefedit').typeahead({

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
        var fin = $('#nombcompledit');

        var idfin = $('#idusofedit');
        pro.val('');
        fin.val('');
        idfin.val('');
        fin.val(item.uname);
        pro.val(item.numdoc);
        idfin.val(item.id);
        valusuarioEdit();
        return item;
    },
});

$('#descent').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getOficEnt/"+idofic,
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.oEId,
                        name: item.estable,
                        uname: item.estable,
                        numdoc: item.codest
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#codofic');
        var fin = $('#nombofic');

        var idfin = $('#idoficent');
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
$('#descentedit').typeahead({

    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getOficEnt/"+idofic,
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.oEId,
                        name: item.estable,
                        uname: item.estable,
                        numdoc: item.codest
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        var pro = $('#codoficedit');
        var fin = $('#nomboficedit');

        var idfin = $('#idoficentedit');
        pro.val('');
        fin.val('');
        idfin.val('');
        fin.val(item.uname);
        pro.val(item.numdoc);
        idfin.val(item.id);
        valusuarioEdit();
        return item;
    },
});
function valusuario() {

    var idusuario = $('#idusof').val();
    var idlocal = $('#idoficent').val();
    if(parseInt(idusuario)!==0 && $('#userref').val()!==''){
        var url = "/referencia/valuser/" + idusuario;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        var usus = data['usof'];
                        if (usus.length > 0) {
                            for (var i = 0; i < usus.length; i++) {
                                if (usus[i]['oEId'] == idlocal && usus[i]['id'] == idusuario && usus[i]['uOEst'] == 1) {
                                    validarCaja('descent', 'validardescent', 'Oficina Asignado a ese usuario', 0);
                                    validarCaja('userref', 'validaruserref', 'El usuario ya esta asignado a esa oficina', 0);
                                    $('#enviarusuofic').prop("disabled", true);
                                } else {
                                    if (usus[i]['uOEst'] == 0 && usus[i]['oEId'] == idlocal) {
                                        validarCaja('descent', 'validardescent', 'Oficina Asignado a ese usuario', 0);
                                        validarCaja('userref', 'validaruserref', 'El usuario ya esta asignado a esa oficina por favor restaure encargado', 0);
                                        $('#enviarusuofic').prop("disabled", true);
                                        i=usus.length;
                                    } else {
                                        if (usus[i]['uOEst'] == 1) {
                                            validarCaja('descent', 'validardescent', 'Oficina correcto', 1);
                                            validarCaja('userref', 'validaruserref', 'El usuario ya fue asignado a una oficina', 0);
                                            $('#enviarusuofic').prop("disabled", true);
                                        } else {
                                            validarCaja('descent', 'validardescent', 'Oficina correcto', 1);
                                            validarCaja('userref', 'validaruserref', 'Usuario correcto', 1);
                                            $('#enviarusuofic').prop("disabled", false);
                                        }
                                    }
                                }
                            }

                        } else {
                            validarCaja('descent', 'validardescent', 'Oficina correcto', 1);
                            validarCaja('userref', 'validaruserref', 'Usuario correcto', 1);
                            $('#enviarusuofic').prop("disabled", false);
                        }
                    }


                }, beforeSend() {
                    $('#enviarusuofic').prop("disabled", true);
                }

            });
    }
}
function valusuarioEdit() {

    var idusumod = $('#idusofiedit').val();
    var idusuario = $('#idusofedit').val();
    var idlocal = $('#idoficentedit').val();
    if(parseInt(idusuario)!==0 && $('#userrefedit').val()!==''){
        var url = "/referencia/valuser/" + idusuario;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        var usus = data['usof'];
                        if (usus.length > 0) {
                            for (var i = 0; i < usus.length; i++) {
                                if (usus[i]['oEId'] == idlocal && usus[i]['id'] == idusuario && usus[i]['uOEst'] == 1) {
                                    validarCaja('descentedit', 'validardescentedit', 'Oficina Asignado a ese usuario', 0);
                                    validarCaja('userrefedit', 'validaruserrefedit', 'El usuario ya esta asignado a esa oficina', 0);
                                    $('#enviarusuoficedit').prop("disabled", true);
                                } else {
                                    if (usus[i]['uOEst'] == 0 && usus[i]['oEId'] == idlocal) {
                                        validarCaja('descentedit', 'validardescentedit', 'Oficina Asignado a ese usuario', 0);
                                        validarCaja('userrefedit', 'validaruserrefedit', 'El usuario ya esta asignado a esa oficina por favor restaure encargado', 0);
                                        $('#enviarusuoficedit').prop("disabled", true);
                                        i=usus.length;
                                    } else {
                                        if (usus[i]['uOEst'] == 1) {
                                            if(parseInt(idusumod)===parseInt(idusuario)){
                                                validarCaja('descentedit', 'validardescentedit', 'Oficina correcto', 1);
                                                validarCaja('userrefedit', 'validaruserrefedit', 'Usuario correcto', 1);
                                                $('#enviarusuoficedit').prop("disabled", false);
                                            }else{
                                                validarCaja('descentedit', 'validardescentedit', 'Oficina correcto', 1);
                                                validarCaja('userrefedit', 'validaruserrefedit', 'El usuario ya fue asignado a una oficina', 0);
                                                $('#enviarusuoficedit').prop("disabled", true);
                                            }
                                        } else {
                                            validarCaja('descentedit', 'validardescentedit', 'Oficina correcto', 1);
                                            validarCaja('userrefedit', 'validaruserrefedit', 'Usuario correcto', 1);
                                            $('#enviarusuoficedit').prop("disabled", false);
                                        }
                                    }
                                }
                            }

                        } else {
                            validarCaja('descentedit', 'validardescentedit', 'Oficina correcto', 1);
                            validarCaja('userrefedit', 'validaruserrefedit', 'Usuario correcto', 1);
                            $('#enviarusuoficedit').prop("disabled", false);
                        }
                    }


                }, beforeSend() {
                    $('#enviarusuoficedit').prop("disabled", true);
                }

            });
    }
}
function tabla_PermUsu(){
    $('#tabla_UsuOfi').DataTable({
        ajax: '/referencia/getUsuOfi',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        orderCellsTop: true,
        processing: true,
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
            {"targets": 1, "width": "12%", "className": "text-center"},
            {"targets": 2, "width": "35%", "className": "text-left"},
            {"targets": 3, "width": "10%", "className": "text-left"},
            {"targets": 4, "width": "5%", "className": "text-center"},
            {"targets": 5, "width": "5%", "className": "text-left"},
            {"targets": 6, "width": "3%", "className": "text-center"},
            {"targets": 7, "width": "5%", "className": "text-center"},
        ],
        columns: [

            {data: 'usuario', name: 'usuario'},
            {data: 'numeroDoc', name: 'numeroDoc'},
            //{data: 'descripcion', name: 'descripcion'},
            {
                data: function (row) {
                    switch (parseInt(row.oId)){
                        case 4: return  row.Descripcion ;
                            idsm=18;
                            break;
                        case 5:return row.nombre ;
                            idsm=18;
                            break;
                        case 6:return row.descripcion ;
                            idsm=17;
                            break;
                        case 7:return row.descripcionEjecutora;
                            idsm=18;
                            break;
                    }

                }
            },
            {data: 'oNombre', name: 'oNombre'},
            {data: 'uOFecCrea', name: 'uOFecCrea'},
            {data: 'uname', name: 'uname'},
            {
                data: function (row) {
                    return parseInt(row.uOEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.uOEst) === 1 && parseInt(row.uOEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#"  onclick="abrilModalEdUsuOfi(' + row.uOId+','+row.id+ ')" TITLE="Editar Usuario de Referencia " >\n' +
                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                            '<a href="#" style="color: red" TITLE="Eliminar Usuario de Referencias" onclick="eliminarUsuOfic(' + row.uOId +','+row.id+','+row.oId+','+0+')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Restaurar Usuario de Referencias"  onclick="eliminarUsuOfic(' + row.uOId +','+row.id+','+row.oId+','+1+')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            }
        ]
    });
}
function abrilModalEdUsuOfi(iduo,id) {
    window.event.preventDefault();
    $('#modal_dialog_edit_usuofic').modal('show');
    cargaroficinasRef('nuepermedit');
    obtenerEditarUsuOfic(iduo);
    camposAsigPermEdit();
    camposadd=[];

}
//OBTIENE LOS DATOS DE USUARIO DE REFERENCIA
function obtenerEditarUsuOfic(val) {
    var url = "/referencia/getUsuOfEdit/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var usof = data['usof'];
                    $('#iduoficedit').val(usof[0]['uOId']);
                    $('#userrefedit').val(usof[0]['usuario']);
                    $('#dniedit').val(usof[0]['numeroDoc']);
                    $('#idusofiedit').val(usof[0]['id']);
                    $('#idusofedit').val(usof[0]['id']);
                    $('#idoficentedit').val(usof[0]['oEId']);
                    $('#nombcompledit').val(usof[0]['uname']);
                    $('#descentedit').prop("disabled",false);
                    $('#nuepermedit'+usof[0]['oId']).prop("checked", true);
                    $('#userrefedit').focus();
                    cargarofent(usof[0]['oId']);
                    switch (usof[0]['oId']){
                        case 4:$('#descentedit').val(usof[0]['Descripcion']);
                        getidpermiso(usof[0]['id'],18);
                        $('#idofiperm').val(2);
                            break;
                        case 5:$('#descentedit').val(usof[0]['nombre']);
                            getidpermiso(usof[0]['id'],18);
                            $('#idofiperm').val(2);
                            break;
                        case 6:$('#descentedit').val(usof[0]['descripcion']);
                            getidpermiso(usof[0]['id'],17);
                            $('#idofiperm').val(1);
                            break;
                        case 7:$('#descentedit').val(usof[0]['descripcionEjecutora']);
                            getidpermiso(usof[0]['id'],18);
                            $('#idofiperm').val(2);
                            break;
                    }
                }
                else {

                }

            }

        });
}
function eliminarUsuOfic(idusof,idusu,idof,lug){
    var idsm=18;
    if(idof==6){
        idsm=17;
    }
    if(lug==1){
        validarelimicion(idusu);
    }else{
        exist=0;
    }
    var url="/referencia/deleteUsuOfi/"+idusof+"/"+idusu+"/"+idsm;
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
            if(exist===0){
                $.ajax(
                    {
                        url: url,
                        type: 'GET',
                        cache:false,
                        dataType: 'JSON',
                        data: '_token = <?php echo csrf_token() ?>',
                        success: function (data) {
                            if (data['error'] === 0) {
                                tabla_PermUsu();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Usuario Referencia eliminado/restaurado correctamente!',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            } else {
                                tabla_PermUsu();
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
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    type: 'warning',
                    title: 'atencion!',
                    text: 'El Usuario esta activo en otro Oficina',
                    showConfirmButton: false,
                    timer: 5000
                });
                tabla_PermUsu();
            }

        }
    })
}
function validarelimicion(iduser){
    exist=0;
    var url = "/referencia/valuser/" + iduser;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['usof'];
                    for(var i=0;i<result.length;i++){
                        if(result[i]['uOEst']==1 && result.length>1){
                            exist=exist+1;
                        }
                    }
                }

            }, beforeSend() {
                $('#enviarpers').prop("disabled", true);
            }

        });
}
$("#nueperm").on('change', function () {
    $('#descent').prop("disabled", false);
    $('#descent').val('');
    $('#codofic').val('');
    $('#nombofic').val('');
    $('#descent').focus();

});
$("#nuepermedit").on('change', function () {
    $('#descentedit').prop("disabled", false);
    $('#descentedit').val('');
    $('#codoficedit').val('');
    $('#nomboficedit').val('');
    $('#descentedit').focus();

});
$('#addUsuOfi').on('click', function () {
    cargaroficinasRef('nueperm');
    camposAsigPermAdd();

});
function enviarUsuOfic() {
    var idu=$('#idusof').val();
    var idsub=0;
    if(idofic==6){
        getidpermiso(idu,17);
        idsub=17;
    }else{
        getidpermiso(idu,18);
        idsub=18;
    }
    if(validarFormularioUsuOfic()===0){
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
                var idoficent = $('#idoficent').val();
                var iduser = $('#idusof').val();

                $.ajax({
                    url: '/referencia/storeUsuOfi',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        idper:idp,
                        idsubm:idsub,
                        idoficent: idoficent,
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
                                    title: 'Registro de Usuario Oficina exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_usuofic');
                                tabla_PermUsu();
                                camposadd = [];
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
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_add_usuofic');
                                tabla_PermUsu();
                                camposadd = [];

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarusuofic').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function getidpermiso(iduser,idsm){
    var url = "/referencia/getidPer/" + iduser+'/'+idsm;
    cnt=cnt+1;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                //if (data['error'] === 0) {
                    //var per = data['per'];
                    if(data.length==0){
                            idp1=data.length;
                    }else{
                        if(cnt==1){
                            idp=data[0]['idPermiso'];
                        }else{
                            idp1=data[0]['idPermiso'];
                        }
                          $('#idpermedit').val(data[0]['idPermiso']);
                    }

               /* }
                else {

                }*/

            }

        });
}
function enviarUsuOficEdit() {
    var idu=$('#idusofedit').val();
    var idsub=0;
    var idtipp=2;
    if(idofic==6){
        getidpermiso(idu,17);
        idsub=17;
        idtipp=1;
    }else{
        getidpermiso(idu,18);
        idsub=18;
    }
    var idper= $('#idpermedit').val();
    if(validarFormularioUsuOficEdit()===0){
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
                var idtipp1=$('#idofiperm').val();
                var iduofic= $('#iduoficedit').val();
                var idoficentedit = $('#idoficentedit').val();
                var idusofedit = $('#idusofedit').val();
                $.ajax({
                    url: '/referencia/editUsuOfi',
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        idtipp1:idtipp1,
                        idtipp2:idtipp,
                        idperx:idp,
                        idper:idp1,
                        idsubm:idsub,
                        iduofic: iduofic,
                        idoficentedit: idoficentedit,
                        idusofedit: idusofedit,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Usuario de Referencia Editado Exitosamente',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_edit_usuofic');
                                tabla_PermUsu();
                                camposadd = [];
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
                                limpiarCaja(camposadd);
                                closeModal('modal_dialog_edit_usuofic');
                                tabla_PermUsu();
                                camposadd = [];

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#enviarusuoficedit').prop("disabled", true);
                    }
                });


            }
        });
    }else{
        operacionSubsanar();
    }
}
function cargarofent(id) {
    idofic=id;
}
function validarFormularioUsuOfic() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#dni').val() !== '') {
        validarCaja('dni', 'validardni', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Usuario';
        validarCaja('dni', 'validardni', text, 0);
    }
    if ($('#descent').val() !== '') {
        validarCaja('descent', 'validardescent', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la entidad';
        validarCaja('descent', 'validardescent', text, 0);
    }
    return cont;
}
function validarFormularioUsuOficEdit() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#dniedit').val() !== '') {
        validarCaja('dniedit', 'validardniedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione Usuario';
        validarCaja('dni', 'validardniedit', text, 0);
    }
    if ($('#descentedit').val() !== '') {
        validarCaja('descentedit', 'validardescentedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione la entidad';
        validarCaja('descentedit', 'validardescentedit', text, 0);
    }
    return cont;
}
