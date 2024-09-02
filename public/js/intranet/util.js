function bloquear() {

    $.blockUI({
        message: ' <div><i class="fas fa-cog fa-spin"></i> Procesando, espere porfavor<i class="fas fa-cog fa-spin"></i> </div>',
        css: {
            align: 'center',
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    });


}

function redirect(ruta) {
    $.ajax(
        {
            type: "GET",
            url: ruta,
            dataType: "html",
            success: function (data) {
                $("#response").html(data);

            }
        }
    );

}

function cambiarFormatoFecha(texto) {
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3-$2-$1');
}

function desbloquear() {
   // $.unblockUI();
}


function validarCelular() {
    var cel = $('#telefo').val();
    var expres;
    var text;

    expres = /^[0-9]{9}$/;
    if (expres.test(cel)) {
        text = 'Dato correcto';
        validarCaja('telefo', 'telefovalid', text, 1);
    } else {
        text = 'Nro telefonico incorrecte, vuelva a ingresar dato';
        validarCaja('telefo', 'telefovalid', text, 0);
        $('#enviar').prop('disabled', false);
    }
}

function validCelular(telef, valtel, env) {
    var cel = $('#' + telef).val();
    var expres;
    var text;

    expres = /^[0-9]{9}$/;
    if (expres.test(cel)) {
        text = 'Dato correcto';
        validarCaja(telef, valtel, text, 1);
        $('#' + env).prop('disabled', false);
    } else {
        text = 'Nro telefonico incorrecto, vuelva a ingresar dato';
        validarCaja(telef, valtel, text, 0);
        $('#' + env).prop('disabled', true);
    }
}


function validarDniExpress() {
    var dni = $('#dni').val();
    var tipdoc = $('#tipdoc').val();
    var expres;
    var text;

    if (tipdoc === '1') {
        expres = /^[0-9]{8}$/;
        if (expres.test(dni)) {
            validarDni();
        } else {
            text = 'Dni incorrecto, vuelva a ingresar el dni';
            validarCaja('dni', 'validDni', text, 0);
            $('#enviar').prop('disabled', false);
        }
    } else {
        if (tipdoc === '2') {
            expres = /^[0-9]{12}$/;
            if (expres.test(dni)) {
                validarDni();
            } else {
                text = 'Carnet de estranjeria incorrecto, vuelva a ingresar el carnet';
                validarCaja('dni', 'validDni', text, 0);
                $('#enviar').prop('disabled', false);
            }
        }
    }
}

function validarNroFua() {
    var conver = $('#nrofua').val();
    var gg = $conver.split('-')
    var nrofua = $gg[0] + $gg[1] + $gg[2];
    var expres;
    var text;
    var cont = 0;
    expres = /^[0-9]{12}$/;
    if (expres.test(nrofua)) {
        text = 'Dato correcto';
        validarCaja('nrofua', 'valnrofua', text, 1);
    } else {
        cont++;
        text = 'Nro de fua incorrecto,ingrese los 12 digitos';
        validarCaja('nrofua', 'valnrofua', text, 0);
    }
}

function valInfo(text) {
    Swal.fire({
        position: 'top-end',
        icon: 'warning',
        type: 'warning',
        title: text,
        showConfirmButton: false,
        timer: 3000
    });
}

function modalpersona(text) {
    var perm = $('#' + text).html('');
    var htmla = '', html = '';
    htmla = '    <div class="modal fade" id="modal_dialog_add_persona">\n' +
        '        <div class="modal-dialog modal-lg">\n' +
        '            <div class="modal-content">\n' +
        '                <div class="modal-header">\n' +
        '                    <h4 class="modal-title">AGREGAR PERSONA</h4>\n' +
        '                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>\n' +
        '                </div>\n' +
        '                <div class="modal-body">\n' +
        '                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS PERSONA\n' +
        '                        (\n' +
        '                        <req>*</req>\n' +
        '                        <small>Dato obligatorio</small>)\n' +
        '                    </legend>\n' +
        '                    <hr>\n' +
        '                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">\n' +
        '                        <input type="text" id="idpersona"hidden/>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="tipdoc">TIPO DOCUMENTO\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <select class="form-control form-control-sm" id="tipdoc">\n' +
        '                                <option selected value="0">SELECCIONE</option>\n' +
        '                                <option value="1">DNI</option>\n' +
        '                                <option value="2">CARNET EXTRANJERIA</option>\n' +
        '                                <option value="3">OTROS</option>\n' +
        '                            </select>\n' +
        '                            <div id="validtipodoc"></div>\n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="dni">N&#35; DOC\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <input id="dni" type="number" class="form-control form-control-sm" autocomplete="off"\n' +
        '                                   onchange="validarDni()" disabled/>\n' +
        '                            <div class="hide " id="validDni"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="appaterno">APPATERNO\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <input id="appaterno" type="text" class="form-control form-control-sm" autocomplete="off"\n' +
        '                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>\n' +
        '                            <div class="hide " id="valappaterno"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="apmaterno">APMATERNO\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <input id="apmaterno" type="text" class="form-control form-control-sm" autocomplete="off"\n' +
        '                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>\n' +
        '                            <div class="hide " id="valapmaterno"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="pnombre">PNOMBRE\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <input id="pnombre" type="text" class="form-control form-control-sm" autocomplete="off"\n' +
        '                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>\n' +
        '                            <div class="hide " id="valpnombre"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="snombre">SNOMBRE</label>\n' +
        '                            <input id="snombre" type="text" class="form-control form-control-sm" autocomplete="off"\n' +
        '                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>\n' +
        '                            <div class="hide " id="valsnombre"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="fecnac">FECNAC\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <input type="text" class="form-control form-control-sm" id="fecnac" autocomplete="off">\n' +
        '                            <div class="hide " id="valfecnac"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="telefo">TELEFONO\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <input id="telefo" type="number" class="form-control form-control-sm" onchange="validarCelular()"\n' +
        '                                   autocomplete="off"/>\n' +
        '                            <div class="" id="valtelefo"></div>\n' +
        '                        </div>\n' +
        '                        <hr>\n' +
        '\n' +
        '                    </div>\n' +
        '                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION DNI\n' +
        '\n' +
        '                    </legend>\n' +
        '                    <hr>\n' +
        '                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">\n' +
        '                        <input type="text" id="siti"hidden/>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="departa">DEPARTAMENTO\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <select class="form-control form-control-sm" id="departa">\n' +
        '                                <option selected>AMAZONAS</option>\n' +
        '                            </select>\n' +
        '                            <div class="hide " id="valdeparta"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="prov">PROVINCIA\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <select class="form-control form-control-sm" id="prov">\n' +
        '                                <option selected value="0">SELECCIONE</option>\n' +
        '                            </select>\n' +
        '                            <div class="hide " id="valprov"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="dis">DISTRITO\n' +
        '                                <req>*</req>\n' +
        '                            </label>\n' +
        '                            <select class="form-control form-control-sm" id="dis" >\n' +
        '                                <option selected value="0">SELECCIONE</option>\n' +
        '                            </select>\n' +
        '                            <div class="hide " id="valdis"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <input type="text" id="idcentp"hidden/>\n' +
        '                            <label for="cenpo">CENTRO POBLADO</label>\n' +
        '                            <input type="text" class="form-control form-control-sm typeahead" id="cenpo"\n' +
        '                                   name="cenpo" autocomplete="off">\n' +
        '                            <div id="cenpoval"></div>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-12">\n' +
        '                            <label for="ref">REFERENCIA DE UBICACION</label>\n' +
        '                            <input id="ref" type="text" class="form-control form-control-sm"\n' +
        '                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>\n' +
        '                        </div>\n' +
        '                        <div class="col-xl-6 ">\n' +
        '                            <label for="dir">DIRECCION\n' +
        '                            </label>\n' +
        '                            <input id="dir" type="text" class="form-control form-control-sm"\n' +
        '                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>\n' +
        '                            <div id="dirval"></div>\n' +
        '                        </div>\n' +
        '\n' +
        '                    </div>\n' +
        '                    <hr>\n' +
        '                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">\n' +
        '                        <hr>\n' +
        '                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i\n' +
        '                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>\n' +
        '                        <button id="enviarpersona" class="btn btn-success " title="click para agregar personal\n' +
        '                    " onclick="enviarPersona()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar\n' +
        '                        </button>\n' +
        '                    </div>\n' +
        '\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>';
    html = htmla + html;
    perm.append(html);
}

function validarCaja(idimput, idvalid, textvalid, cond) {
    var valid = $('#' + idvalid);
    var imputcalid = $('#' + idimput);
    valid.removeClass('hide');
    if (cond === 1) {
        imputcalid.removeClass('is-invalid');
        valid.removeClass('invalid-feedback');
        imputcalid.addClass('is-valid');
        valid.addClass('valid-feedback');
        valid.text(textvalid);
    } else {
        valid.removeClass('valid-feedback');
        imputcalid.removeClass('is-valid');
        imputcalid.addClass('is-invalid');
        valid.addClass('invalid-feedback');
        valid.text(textvalid);
    }

}

function closeModal(id) {
    //event.preventDefault();
    $('#' + id).modal('hide');
}

function limpiarCaja(campos) {
    for (var i = 0; i < campos.length; i++) {
        var valid = $('#' + campos[i][1]);
        var imputvalid = $('#' + campos[i][0]);
        valid.removeClass('valid-feedback');
        valid.removeClass('invalid-feedback');
        imputvalid.removeClass('is-valid');
        imputvalid.removeClass('is-invalid');
        if (campos[i][2] === 0) {
            imputvalid.val(0);
        } else {
            imputvalid.val('');
        }

        valid.text('');
    }

}

function limpiarCajaV2(campos) {

    for (var i = 0; i < campos.length; i++) {
        var valid = $('#' + campos[i][1]);
        var imputvalid = $('#' + campos[i][0]);
        valid.removeClass('valid-feedback');
        valid.removeClass('invalid-feedback');
        imputvalid.removeClass('is-valid');
        imputvalid.removeClass('is-invalid');
        if (parseInt(campos[i][2]) === 1)
            imputvalid.val(0);
        else
            imputvalid.text('');
        valid.text('');
    }

}
function getTipoDoc(id,idtipdoc) {
    var url = "/mantenimiento/gettipodoc";
    var select = $('#'+id).html('');
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
                    if (parseInt(data[i]['tdId']) === parseInt(idtipdoc)) {
                        htmla = '<option value="' + data[i]['tdId'] + '" selected>' + data[i]['tdDescCorta'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + data[i]['tdId'] + '">' + data[i]['tdDescCorta'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}
function operacionExitosa() {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        type: 'success',
        title: 'Operacion exitosa.',
        showConfirmButton: false,
        timer: 3000
    });
}

function operacionSubsanar() {
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
function operacionErrorApi($message) {
    Swal.fire({
        position: 'top-end',
        icon: 'warning',
        type: 'warning',
        title: 'atencion!',
        text: $message+' El servidor tiene problemas, por favor, ingrese de forma manual..',
        showConfirmButton: false,
        timer: 6000
    });
}

function errorFunc(text) {
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        type: 'error',
        title: text,
        showConfirmButton: false,
        timer: 3000
    });
}

function operacionError(error) {
    Swal.fire({
        icon: 'error',
        title: 'Error...',
        text: error,
    }).then((result) => {
        if (result.value) {
            location.reload();
        }
    });
}


function validarDni() {

   // bloquear();
    var dni = $('#dni').val();
    var url = "/valdni/" + dni;
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
                    var arreglo = data['cant'];
                    if (arreglo[0]['cant'] === 0) {
                        desbloquear();
                        $('#enviar').prop('disabled', false);
                        text = 'Dato correcto';
                        validarCaja('dni', 'validDni', text, 1);
                    } else {
                        desbloquear();
                        llenarGestanteDni(dni);
                    }
                } else {

                }
            }

        }
    );
}

function validarMoneda(idcaja) {

    var valor = $('#' + idcaja);
    var expres;
    expres = /^[0-9]$/;
    if (expres.test(valor.val())) {
        console.log('aqui')
        //text = 'Monto correcto';
        // validarCaja('monto', 'validmont', text, 1);
        //$('#enviar').prop('disabled', false);
    } else {
        text = 'Monto incorrecto, vuelva a ingresar el monto!';
        validarCaja('dni', 'validmont', text, 0);
        //$('#enviar').prop('disabled', false);
    }

    //return valor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");*/
}

function departamento(id, iddepar) {
  ///  bloquear();
    var url = "/departamento";
    var arreglo;
    var select = $('#' + id).html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['dep'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (parseInt(arreglo[i]['idDepartamento']) === parseInt(iddepar)) {
                            htmla = '<option value="' + arreglo[i]['idDepartamento'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + arreglo[i]['idDepartamento'] + '">' + arreglo[i]['descripcion'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                    //desbloquear();
                } else {

                }
            }

        });
}
function api_consulta_doc(tipdoc,doc){
    var usr;
    var url = "/mantenimiento/getapiclient/"+ tipdoc+"/" + doc;
    var text;
    return new Promise( function(resolve,reject){
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        resolve(data);
                    } else {

                    }
                },
                error: function(error) {
                    reject(error); // Rechaza la promesa con el error
                }
            });
    });
}
function provincia(id, iddep, idprov) {
   // bloquear();
    var url = "/ubiprov/" + iddep;
    var arreglo;
    var select = $('#' + id).html('');
    var html = '<option  selected="" value="0">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['prov'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (parseInt(arreglo[i]['idProvincia']) === parseInt(idprov)) {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + arreglo[i]['idProvincia'] + '">' + arreglo[i]['descripcion'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                  //  desbloquear();
                } else {


                }
            }

        });
}

function distrito(id, idprov, iddist) {
    //bloquear();
    var url = "/ubidis/" + idprov;
    var arreglo;
    var select = $('#' + id).html('');
    var html = '<option value="0" selected="">SELECCIONE</option>';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['dis'];
                    var htmla = '';
                    for (var i = 0; i < arreglo.length; i++) {
                        if (parseInt(arreglo[i]['dtId']) === parseInt(iddist)) {
                            htmla = '<option value="' + arreglo[i]['dtId'] + '" selected>' + arreglo[i]['descripcion'] + '</option>';
                            html = html + htmla;
                        } else {
                            htmla = '<option value="' + arreglo[i]['dtId'] + '">' + arreglo[i]['descripcion'] + '</option>';
                            html = html + htmla;
                        }
                    }
                    select.append(html);
                  //  desbloquear();
                } else {

                }
            }

        });
}

function validarDniExpres(buton, dnii, tipdocc, val) {
    var dni = $('#' + dnii).val();
    var tipdoc = $('#' + tipdocc).val();
    var expres;
    var text;
    var cont = 0;
    if (tipdoc === '1') {
        expres = /^[0-9]{8}$/;
        if (expres.test(dni)) {
            validarCaja(dnii, val, 'correcto', 1);
            $('#' + buton).prop('disabled', false);
        } else {
            cont++;
            text = 'Dni incorrecto, vuelva a ingresar el dni';
            validarCaja(dnii, val, text, 0);
            $('#' + buton).prop('disabled', true);
        }
    } else {
        if (tipdoc === '2') {
            expres = /^[0-9]{12}$/;
            if (expres.test(dni)) {
                validarCaja(dnii, val, 'correcto', 1);
                $('#' + buton).prop('disabled', false);
            } else {
                cont++;
                text = 'Carnet de estranjeria incorrecto, vuelva a ingresar el carnet';
                validarCaja(dnii, val, text, 0);
                $('#' + buton).prop('disabled', true);
            }
        }else{
            if (tipdoc === '3') {
                expres = /^[0-9]{11}$/;
                if (expres.test(dni)) {
                    validarCaja(dnii, val, 'correcto', 1);
                    $('#' + buton).prop('disabled', false);
                } else {
                    cont++;
                    text = 'Ruc incorrecto, vuelva a ingresar el Ruc';
                    validarCaja(dnii, val, text, 0);
                    $('#' + buton).prop('disabled', true);
                }
            }
        }

    }
    return cont;
}

function getFechaUt(fec) {
    $('#' + fec).datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
}

function pad_with_zeroes(number, length) {

    var my_string = '' + number;
    while (my_string.length < length) {
        my_string = '0' + my_string;
    }
    return my_string;

}

function cargaroficinasRef(val) {
    var url = "/referencia/getOficAct";
    var perm = $('#' + val).html('');
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
                    var encarg = data['ofic'];
                    if (encarg.length > 0) {
                        for (var i = 0; i < encarg.length; i++) {
                            if (encarg[i]['oId'] === 4 || encarg[i]['oId'] === 5 || encarg[i]['oId'] === 6) {
                                htmla = '<div class="form-check">\n' +
                                    '                        <input class="form-check-input" name="flexRadioDefault" type="radio" id="' + val + encarg[i]['oId'] + '" value="" onchange="cargarofent(' + encarg[i]['oId'] + ')">' +
                                    '                        <label class="form-check-label" for="' + val + encarg[i]['oId'] + '">' + encarg[i]['oNombre'] + '</label>\n' +
                                    '                    </div>';
                                html = htmla + html;
                            }
                        }
                    }

                    perm.append(html);
                } else {

                }
            }

        });
}

//FUNCION QUE NO PERMITA INGRESAR LETRAS A UNA CAJA DE TEXTO
function filterFloat(evt, input) {
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;
    if (key >= 48 && key <= 57) {
        if (filter(tempValue) === false) {
            return false;
        } else {
            return true;
        }
    } else {
        if (key == 8 || key == 13 || key == 0) {
            return true;
        } else if (key == 46) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;

        }
    }
}

function filter(__val__) {
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if (preg.test(__val__) === true) {
        return true;
    } else {
        return false;
    }

}

function valVehiPlac(plac, idvehr, det, esspert) {
    var placa = $('#' + plac).val();
    var url = "/combustible/getVehPla/" + placa;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var placa = data['veh'];
                    if (placa.length > 0) {
                        $('#' + idvehr).val(placa[0]['vId']);
                        $('#' + det).val(placa[0]['info']).prop("disabled", true);
                        $('#' + esspert).val(placa[0]['eper']);

                    } else {
                        $('#' + esspert).val("");
                        $('#' + idvehr).val(0);
                        $('#' + det).val("");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            type: 'warning',
                            title: 'Vehiculo No Registrado/Activo',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                } else {

                }
            }, beforeSend: function () {
            },

        });
}
