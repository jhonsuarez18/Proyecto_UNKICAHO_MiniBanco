var i=0;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var panel = function () {
    "use strict";
    return {
        //main function
        init: function () {
            llenarPanel();
            getNotificacion($('#iduser').val());

        }
    };
}();
$('#actper').on('click',function (){
    $('#modal_dialog_edit_ref').modal({show: true, backdrop: 'static', keyboard: false});
});
$('#eye').on('click',function (){
    $('#eye').prop('hidden',true);
    $('#eyes').prop('hidden',false);
    $('#contra1').attr('type','text');
});
$('#eyes').on('click',function (){
    $('#eyes').prop('hidden',true);
    $('#eye').prop('hidden',false);
    $('#contra1').attr('type','password');
});
$('#eye1').on('click',function (){
    $('#eye1').prop('hidden',true);
    $('#eyes1').prop('hidden',false);
    $('#contra2').attr('type','text');
});
$('#eyes1').on('click',function (){
    $('#eyes1').prop('hidden',true);
    $('#eye1').prop('hidden',false);
    $('#contra2').attr('type','password');
});
$(document).ready(function () {
    llenarPanel();
    getNotificacion($('#iduser').val());
$('#enviar').prop('disabled',false);
$('#eye').prop('hidden',false);
$('#eye1').prop('hidden',false);
});
var mensajeGriter = function (local) {
    setTimeout(function () {
        $.gritter.add({
            title: 'NOTIFICACIÓN',
            text: ' '+local,
            image: '../assets/img/diresa/Logo.png',
            sticky: true,
            time: '100',
            class_name: 'my-sticky-class'
        });
    }, 100,i=1);
};
function getNotificacion (idus) {
      var url="/referencia/getNotifi/"+idus;
    $.ajax(
        {
            type: "GET",
            url:url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if(data.length>0){
                    mensajeGriter(data[0]['nTitulo']);
                    deleteNotificacion(data[0]['nId']);
                }
            }

        });
}
function deleteNotificacion (idn) {
    var url="/referencia/deleteNotifi/"+idn;
    $.ajax(
        {
            type: "GET",
            url:url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {

            }

        });
}
/*$('#contra1').on('change', function () {
    var contra1 = $('#contra1').val();
    var contra2 = $('#contra2').val();
    if (contra1 === contra2) {
        $('#contra1').removeClass("is-invalid");
        $('#contra2').removeClass("is-invalid");
        $('#contra1').addClass("is-valid");
        $('#contra2').addClass("is-valid");
        $('#enviar').removeAttr("disabled", "");
    } else {
        $('#contra1').removeClass("is-valid");
        $('#contra2').removeClass("is-valid");
        $('#contra1').addClass("is-invalid");
        $('#contra2').addClass("is-invalid");
        $('#enviar').attr("disabled", "");
    }
});*/
$('#contra1').on('change', function () {
    var contra1 = $('#contra1').val();
    var contra2 = $('#contra2').val();
    if(contra2!==''){
        if (contra1 === contra2) {
            validarCaja('contra1', 'valcontra1', 'Contraseñas correctas', 1);
            validarCaja('contra2', 'valcontra2', 'Contraseñas correctas', 1);
            $('#enviar').removeAttr("disabled", "");
        } else {
            validarCaja('contra1', 'valcontra1', 'Contraseñas incorrectas', 0);
            validarCaja('contra2', 'valcontra2', 'Contraseñas incorrectas', 0);
            $('#enviar').attr("disabled", "");
        }
    }
});
$('#contra2').on('change', function () {
    var contra1 = $('#contra1').val();
    var contra2 = $('#contra2').val();
    if (contra1 === contra2) {
        validarCaja('contra1', 'valcontra1', 'Contraseñas correctas', 1);
        validarCaja('contra2', 'valcontra2', 'Contraseñas correctas', 1);
        $('#enviar').removeAttr("disabled", "");
    } else {
        validarCaja('contra1', 'valcontra1', 'Contraseñas incorrectas', 0);
        validarCaja('contra2', 'valcontra2', 'Contraseñas incorrectas', 0);
        $('#enviar').attr("disabled", "");
    }
});
/*$('#contra2').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
    }
    , updater: function (item) {
        var contra1 = $('#contra1').val();
        var contra2 = $('#contra2').val();
        if (contra1 === contra2) {
            $('#contra1').removeClass("is-invalid");
            $('#contra2').removeClass("is-invalid");
            $('#contra1').addClass("is-valid");
            $('#contra2').addClass("is-valid");
            $('#enviar').removeAttr("disabled", "");
        } else {
            $('#contra1').removeClass("is-valid");
            $('#contra2').removeClass("is-valid");
            $('#contra1').addClass("is-invalid");
            $('#contra2').addClass("is-invalid");
            $('#enviar').attr("disabled", "");
        }
    }
});*/

function llenarPanel() {
    "use strict";
    var url = "/pruebaPermisos";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {
            _token: CSRF_TOKEN
        },
        dataType: 'json',
        success:
            function (data) {
                if (data['error'] === 0) {
                    var obj = $("#panel");
                    obj.empty();
                    var panel = '<li class="nav-header">MI MENU</li>';
                    var datos = data['panel'];
                    var id = 0, idMenu;
                    for (var i = 0; i < datos.length; i++) {
                        if (id !== datos[i]['midMenu']) {
                            idMenu = datos[i]['midMenu'];
                            panel = panel + '<li class="has-sub">' +
                                '                <a href="javascript:;">' +
                                '                    <b class="caret"></b>' +
                                '                    <i style="' + datos[i]['mcolor'] + '" class="fa ' + datos[i]['mimg'] + '"></i>' +
                                '                    <span>' + datos[i]['mtitulo'] + '</span>' +
                                '                </a>' +

                                '                <ul class="sub-menu" id="sub' + idMenu + '">' +
                                '               </ul>' +
                                '           </li>';

                        }


                        id = datos[i]['midMenu'];
                    }
                    panel = panel + ' <li title="Click para juntar o desplegar"><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>';
                    obj.html(panel);
                    var id = 0;

                    for (var i = 0; i < datos.length; i++) {
                        var submenucabeza = '';
                        if (id !== datos[i]['midMenu']) {
                            idMenu = datos[i]['midMenu'];
                            var submenu = '';
                        }

                        submenu = submenu + '                    <li>' +
                            '                        <a href="/' + datos[i]['url'] + '" data-toggle="ajax">' + datos[i]['ssubTitulo'] + '</a></li>';
                        submenucabeza = $("#sub" + idMenu);
                        submenucabeza.html(submenu);
                        id = datos[i]['midMenu'];

                    }
                }
                else {
                }
            }

        ,
    });
}



App.settings({
    ajaxMode: true,
    ajaxDefaultUrl: '/inicio',
    ajaxType: 'GET',
    ajaxDataType: 'html'
});
/*$('#enviar').on('click',function (){
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se editara los datos del usuario',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar',
        }).then((result) => {
            if(result.value){
                var id = $('#id').val();
                var nombre = $('#nombre').val();
                var email = $('#email').val();
                var archivo = $('#archivo').val();
                var contra1 = $('#contra1').val();
                var contra2 = $('#contra2').val();
                $.ajax({
                    url: '/subir',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id,
                        nombre: nombre,
                        email: email,
                        archivo: archivo,
                        contra1: contra1,
                        contra2: contra2,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                //redirect('/home');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de Documento exitoso',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                location.reload();
                            } else {
                                //redirect('/home');
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
});*/
