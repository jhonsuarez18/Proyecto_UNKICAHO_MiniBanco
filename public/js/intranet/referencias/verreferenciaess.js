var data = [];
var datadoc = [];
var personal = [];
var personaledit = [];
var personaleditdelete = [];
var personaleditfin = [];
var personaldetref = [];
var cie10s = [];
var cie10editarr = [];
var cie10detarr = [];
var personales = new Array();
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var botEdit = false;

function getTrabEss() {
    var url = "/referencia/getTrabEss";
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data[0]['error'] === 0) {
                    var datos = data[0]['ess'];
                    if (datos !== null) {
                        $('#nombessref').val(datos['descripcion']);
                        $('#idessref').val(datos['codigoRenaes']);
                        swal.close()
                    } else {
                        operacionError('no cuenta con los permisos para este modulo');
                        $('#logout-form').submit();
                    }

                } else {
                    operacionError(data['error']);
                    $('#logout-form').submit();
                    // swal.close()
                }
            }, beforeSend: function () {
                //  swal.showLoading();
            },
        });
}


$('#addref').on('click', function () {
    window.event.preventDefault();
    $('#modal_dialog_add_ref').modal({show: true, backdrop: 'static', keyboard: false});
    getTipSeg();
    $('#fecrefr').datetimepicker({
        format: 'DD-MM-YYYY hh:mm A',
    });

    $('#fecret').datetimepicker({
        format: 'DD-MM-YYYY hh:mm A',
    });
    $('#tabla_personalre').dataTable({searching: false, paging: false, info: false,});
    $('#tabla_cie10').dataTable({searching: false, paging: false, info: false,});
});


$('#envref').on('click', function () {
    window.event.preventDefault();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se registrara una referencia',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            if (validarFormularioAgRef() === 0) {
                if (personales.length === 0 || cie10s.length === 0) {
                    if (personales.length === 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            type: 'error',
                            title: 'atencion!',
                            text: 'Agregue personal  que acompaña el traslado',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                    if (cie10s.length === 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            type: 'error',
                            title: 'atencion!',
                            text: 'Agregue diagnostico',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                } else {
                    let fecref = $('#fecrefr').data('DateTimePicker').date()
                    fecref = new Date(fecref);
                    let fecret = $('#fecret').data('DateTimePicker').date()
                    fecret = new Date(fecret);
                    let idessor = $('#idessor').val();
                    let motr = $('#motr').val();
                    let idessrr = $('#idessrr').val()
                    let idcie10r = $('#idcie10r').val();
                    let pid = $('#pid').val();
                    let estpr = $('#estpr').val();
                    let idveh = $('#idvehiref').val();
                    let idperref = $('#idperref').val();
                    let idperrec = $('#idperrec').val();
                    var conver = $('#nrofua').val();
                    var gg = conver.split('-')
                    var nrofua = gg[0] + gg[1] + gg[2];
                    motr = JSON.stringify(motr);
                    per = JSON.stringify(personales);
                    cie = JSON.stringify(cie10s);
                    $.ajax({
                        url: '/referencia/storeRef',
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            ePid: estpr,
                            idessor: idessor,
                            per: per,
                            cie: cie,
                            pId: pid,
                            cId: idcie10r,
                            idEess: idessrr,
                            idperrec: idperrec,
                            idperref: idperref,
                            idveh: idveh,
                            motr: motr,
                            nrofua: nrofua,
                            fecref: fecref,
                            fecret: fecret,
                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de referencia exitosa',
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
                            $('#enviardoc').prop("disabled", true);
                        }
                    });
                }
            } else {
                operacionSubsanar();
            }

        }
    });
});

function detalleRef(idRef, rest) {
    window.event.preventDefault();
    $('#modal_dialog_ver_ref').modal({show: true});
    personaldetref = [];
    cie10detarr = [];
    getdetalleref(idRef);
    getpersonaldetref(idRef, rest);
    getciedetref(idRef, rest);
    //verPersonalReferencia(idRef);
}

function editarReferencia(idRef) {
    window.event.preventDefault();
    $('#modal_dialog_edit_ref').modal({show: true, backdrop: 'static', keyboard: false});
    personaledit = [];
    $('#fecrefred').datetimepicker({
        format: 'DD-MM-YYYY hh:mm A',
    });

    $('#fecreted').datetimepicker({
        format: 'DD-MM-YYYY hh:mm A',
    });
    // $('#tabla_personalre').dataTable({searching: false, paging: false, info: false,});
    // $('#tabla_cie10').dataTable({searching: false, paging: false, info: false,});
    geteditreferencia(idRef);
    getpersonaledit(idRef);
    getCieEdtRef(idRef);
}

function getCieEdtRef(val) {
    cie10editarr = [];
    var url = "/referencia/getDetCie10/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var pref = data['tab'];
                for (var i = 0; i < pref.length; i++) {
                    if (parseInt(pref[i]['dNEst']) === 1) {
                        var tabcie = new Array();
                        tabcie['dNId'] = pref[i]['dNId'];
                        tabcie['cie'] = pref[i]['cCodigo'];
                        tabcie['descp'] = pref[i]['cDescripcion'];
                        cie10editarr.push(tabcie);
                    }

                }

                cie10TabEdit(val)

            }

        });

}

function cie10TabEdit(val) {
    var datatable = $('#tabla_cie10_edit');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: cie10editarr,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            searching: false, paging: false, info: false,
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "90%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
            ],
            columns: [
                {data: 'cie', name: 'cie'},
                {data: 'descp', name: 'descp'},
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: #ff0000" TITLE="Quitar diagonostico" onclick="quitarDiagEdit(' + row.dNId + ',' + val + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

function quitarDiagEdit(id, val) {
    event.preventDefault();

    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara el diagnostico',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    type: "GET",
                    url: "/referencia/delDiag/" + id,
                    cache: false,
                    dataType: 'json',
                    data: CSRF_TOKEN,
                    success: function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Diagnostico eliminado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            getCieEdtRef(val)
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
                });
        }
    })

}

function tramitar(idRef, oid) {
    window.event.preventDefault();
    $('#modal_dialog_checkList').modal({show: true, backdrop: 'static', keyboard: false});
    checklist(idRef, oid);
}

function verObservacion(rid, revid, oid) {
    window.event.preventDefault();
    $('#modal_dialog_observacion').modal({show: true, backdrop: 'static', keyboard: false});
    var url = "/referencia/getobservacion/" + revid;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    let obs = data['obs'];
                    $('#ocodref').val(obs['codref']);
                    $('#odoc').val(obs['dFDescripcion']);
                    $('#oobs').text(obs['oMotivo']);
                    $('#orid').val(rid);
                    $('#ooid').val(oid);
                    $('#orevid').val(revid);
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
        });
}

function getdetalleref(idref) {
    var url = "/referencia/getDetRef/" + idref;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#dnidetref').val(data[0]['afi_DNI']);
                $('#appatrdetref').val(data[0]['afi_appaterno']);
                $('#apmatrdetref').val(data[0]['afi_apmaterno']);
                $('#nombresdetref').val(data[0]['afi_nombres']);
                $('#fecnacdetref').val(data[0]['fecnac']);
                $('#edaddetref').val(data[0]['edad']);
                $('#tipsegdetref').val(data[0]['tSDescrip']);
                $('#estabdetor').val(data[0]['Descripcionesor']);
                $('#estabdetref').val(data[0]['Descripcionesde']);
                $('#dfecrefr').val(data[0]['rFecRef']);
                $('#dfecret').val(data[0]['rFecRetor']);
                $('#motdetref').val(data[0]['rMotRef']);
                $('#cie10detref').val(data[0]['cDescripcion']);
                $('#estpdetref').val(data[0]['ePDescripcion']);
                $('#perderef').val(data[0]['personalref']);
                $('#perderec').val(data[0]['personalrec']);
                var nro = data[0]['rNroFua'];
                var nconv = nro.substr(0, 3) + '-' + nro.substr(3, 2) + '-' + nro.substr(5, 7)
                $('#nrofuadet').val(nconv);
                if (data[0]['vId'] === null) {
                    $('#movildet').prop('checked', true);
                    $('#npartdet').prop('hidden', true);
                } else {
                    $('#movildet').prop('checked', false);
                    $('#npartdet').prop('hidden', false);
                    $('#idvehirefdet').val(data[0]['vId']);
                    $('#placardet').val(data[0]['vPlaca']);
                    $('#esspertrdet').val(data[0]['eper']);
                    $('#detrdet').val(data[0]['info']);
                }

            }

        });
}

function geteditreferencia(idref) {
    var url = "/referencia/getDetRef/" + idref;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $('#idrefedit').val(data[0]['rId']);
                $('#pidedit').val(data[0]['afi_DNI']);
                $('#dniedit').val(data[0]['afi_DNI']);
                $('#appatredit').val(data[0]['afi_appaterno']);
                $('#apmatredit').val(data[0]['afi_apmaterno']);
                $('#nombresedit').val(data[0]['afi_nombres']);
                $('#fecnacedit').val(data[0]['fecnac']);
                $('#edadedit').val(data[0]['edad']);
                $('#tipsegedit').val(data[0]['tSDescrip']);
                $('#estabedorid').val(data[0]['eso']);
                $('#estabedor').val(data[0]['Descripcionesor']);
                $('#estabeddesid').val(data[0]['es']);
                $('#estabeddes').val(data[0]['Descripcionesde']);
                $('#estabedit').val(data[0]['Descripcion']);
                $('#fecrefredtxt').val(data[0]['rFecRef']);
                $('#fecretedtxt').val(data[0]['rFecRetor']);
                $('#motrefedit').val(data[0]['rMotRef']);
                $('#perderefed').val(data[0]['personalref']);
                $('#perdereced').val(data[0]['personalrec']);
                $('#idperdereced').val(data[0]['perecpId']);
                $('#idperderefed').val(data[0]['perefpId']);
                var nro = data[0]['rNroFua'];
                var nconv = nro.substr(0, 3) + '-' + nro.substr(3, 2) + '-' + nro.substr(5, 7)
                $('#nrofuaedit').val(nconv);
                if (data[0]['vId'] === null) {
                    $('#moviledit').prop('checked', true);
                    $('#npartedit').prop('hidden', true);
                } else {
                    $('#moviledit').prop('checked', false);
                    $('#npartedit').prop('hidden', false);
                    $('#idvehirefedit').val(data[0]['vId']);
                    $('#placaredit').val(data[0]['vPlaca']);
                    $('#esspertredit').val(data[0]['eper']);
                    $('#detredit').val(data[0]['info']);
                }
                $('#dniedit').focus();
                getestpredit(data[0]['ePId']);
            }

        });
}

function cambiarEstadocheckList(id, rid, oid) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se preparara el documento',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            var url = "/referencia/updateCheckListref/" + id;
            $.ajax(
                {
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: CSRF_TOKEN,
                    success: function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Documento adjuntado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                            // checklist(rid, oid);
                        } else {
                            if (data['error'] === 1) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Documentos preparados',
                                    showConfirmButton: false,
                                    timer: 6000
                                });
                                location.reload();

                            } else
                                operacionError(data['error']);
                        }
                    }
                });
        }
    })

}


function getTipSeg() {
    var url = "/referencia/getEstPac";
    var arreglo;
    var select = $('#estpr').html('');
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
                    htmla = '<option value="' + data[i]['ePId'] + '">' + data[i]['ePDescripcion'] + '</option>';
                    html = html + htmla;
                }
                select.append(html);
            }

        });
}

function getestpredit(idestpr) {
    var url = "/referencia/getEstPac";
    var arreglo;
    var select = $('#estpredit').html('');
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
                    if (data[i]['ePId'].toString() === idestpr.toString()) {
                        htmla = '<option value="' + data[i]['ePId'] + '" selected>' + data[i]['ePDescripcion'] + '</option>';
                        html = html + htmla;
                    } else {
                        htmla = '<option value="' + data[i]['ePId'] + '">' + data[i]['ePDescripcion'] + '</option>';
                        html = html + htmla;
                    }
                }
                select.append(html);
            }

        });
}

function tablapersonalEdit() {
    var datatable = $('#tabla_personal_edit');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: personaledit,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            columnDefs: [
                {"targets": 0, "width": "60%", "className": "text-left"},
                {"targets": 1, "width": "30%", "className": "text-left"},
                {"targets": 2, "width": "10%", "className": "text-center"},
            ],
            columns: [
                {data: 'personals', name: 'personals'},
                {data: 'tPDescripcion', name: 'tPDescripcion'},
                {
                    data: function (row) {
                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: #ff0000" TITLE="Quitar personal" onclick="quitarPersonalEdit(' + row.pId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle"> </i></a>\n' +
                            '</tr>';
                    }
                }
            ]
        }
    );
}

function tablapersonaldetref() {
    var datatable = $('#tabla_personal_verdet');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: personaldetref,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            searching: false, paging: false, info: false,
            columnDefs: [
                {"targets": 0, "width": "60%", "className": "text-left"},
                {"targets": 1, "width": "30%", "className": "text-left"},
            ],
            columns: [
                {data: 'personals', name: 'personals'},
                {data: 'tPDescripcion', name: 'tPDescripcion'},
            ]
        }
    );
}


function getpersonaledit(val) {
    personaledit = [];
    personaleditdelete = [];
    var url = "/referencia/getDetPerRef/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var pref = data['pref'];
                for (var i = 0; i < pref.length; i++) {
                    if (pref[i]['rPEst'] == 1) {
                        var idpers = pref[i]['pId'];
                        var persona = pref[i]['personals'];
                        var tippersonal = pref[i]['tPDescripcion'];
                        var estp = 0;

                        var tablapersonaledit = new Array();
                        tablapersonaledit['pId'] = idpers;
                        tablapersonaledit['personals'] = persona;
                        tablapersonaledit['tPDescripcion'] = tippersonal;
                        tablapersonaledit['estp'] = estp;

                        personaledit.push(tablapersonaledit)
                        personaleditdelete.push(tablapersonaledit)
                    }

                }
                tablapersonalEdit()

            }

        });

}

function getpersonaldetref(val, rest) {
    var url = "/referencia/getDetPerRef/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var pref = data['pref'];
                for (var i = 0; i < pref.length; i++) {
                    var persona = pref[i]['personals'];
                    var tippersonal = pref[i]['tPDescripcion'];

                    if (rest === 0 && pref[i]['rPEst'] === 0) {
// que hace esto??
                        var tablapersonaldet = new Array();
                        tablapersonaldet['personals'] = persona;
                        tablapersonaldet['tPDescripcion'] = tippersonal;
                        personaldetref.push(tablapersonaldet)
                    } else {
                        if (rest === 1 && pref[i]['rPEst'] === 1) {
                            var tablapersonaldet = new Array();
                            tablapersonaldet['personals'] = persona;
                            tablapersonaldet['tPDescripcion'] = tippersonal;
                            personaldetref.push(tablapersonaldet)
                        }
                    }

                }
                tablapersonaldetref();

            }

        });

}

function getciedetref(val, rest) {

    var url = "/referencia/getDetCie10/" + val;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var pref = data['tab'];
                for (var i = 0; i < pref.length; i++) {
                    if (pref[i]['dNEst'] === 1) {
                        var tabcie = new Array();
                        tabcie['cie'] = pref[i]['cCodigo'];
                        tabcie['descp'] = pref[i]['cDescripcion'];
                        cie10detarr.push(tabcie)
                    }
                }

                cie10tab_det()

            }

        });

}

function cie10tab_det() {
    var datatable = $('#tabla_cie10_det');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: cie10detarr,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            searching: false, paging: false, info: false,
            columnDefs: [
                {"targets": 0, "width": "10%", "className": "text-center"},
                {"targets": 1, "width": "90%", "className": "text-left"},
            ],
            columns: [
                {data: 'cie', name: 'cie'},
                {data: 'descp', name: 'descp'},
            ]
        }
    );
}

$('#dnir').on('change', function () {
    if (validarDniExpress()) {
        var url = "/referencia/getAfiliadoDni/" + this.value;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: CSRF_TOKEN,
                success: function (data) {
                    if (data['error'] === 0) {
                        let afi = data['afiliado'];
                        let tips = data['tipsSeg'];
                        let str = '';
                        $('#pid').val(afi['afi_DNI']);
                        $('#appatr').val(afi['afi_appaterno']);
                        $('#apmatr').val(afi['afi_apmaterno']);
                        $('#nomr').val(afi['afi_nombres']);
                        $('#fcnacr').val(afi['fecnac']);
                        $('#eddr').val(afi['edad']);
                        for (let i = 0; i < tips.length; i++) {
                            str += ' | ' + tips[i]['tSDescrip'];
                        }
                        $('#tsr').text(str);
                        // swal.close()
                    } else {
                        operacionError(data['error']);
                    }
                }, beforeSend: function () {
                    // swal.showLoading();
                },
            });
    }
});
$("#nrofua").mask("999-99-9999999");
$("#nrofuaedit").mask("999-99-9999999");
$("#movil").on('change', function () {
    if ($(this).is(':checked')) {
        $('#npart').prop("hidden", true);
        $('#idvehiref').val(0);
    } else {
        $('#npart').prop("hidden", false);
        $('#placar').val("");
        $('#detr').val("");
        $('#esspertr').val("");
        $('#placar').focus();

    }
});
$("#moviledit").on('change', function () {
    if ($(this).is(':checked')) {
        $('#npartedit').prop("hidden", true);
        $('#idvehirefedit').val(0);
    } else {
        $('#npartedit').prop("hidden", false);
        $('#placaredit').val("");
        $('#detredit').val("");
        $('#esspertredit').val("");
        $('#placaredit').focus();

    }
});
$('#dniedit').on('change', function () {
    if (validarDniEditExpress()) {
        var url = "/referencia/getPacienteDni/" + this.value;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: CSRF_TOKEN,
                success: function (data) {
                    if (data['error'] === 0) {
                        let pa = data['paciente'];
                        let tips = data['tipsSeg'];
                        let str = '';
                        $('#pidedit').val(pa['pId']);
                        $('#appatredit').val(pa['apPaterno']);
                        $('#apmatredit').val(pa['apMaterno']);
                        $('#nombresedit').val(pa['pNombre'] + ' ' + pa['sNombre']);
                        $('#fecnacedit').val(pa['fecNac']);
                        $('#edadedit').val(pa['edad']);
                        for (let i = 0; i < tips.length; i++) {
                            str += ' | ' + tips[i]['tSDescrip'];
                        }
                        $('#tipsegedit').text(str);
                        // swal.close()
                    } else {
                        operacionError(data['error']);
                    }
                }, beforeSend: function () {
                    // swal.showLoading();
                },
            });
    }
});

function validarDniExpress() {
    var dni = $('#dnir').val();
    var expres;
    var text;
    expres = /^[0-9]{8}$/;
    if (expres.test(dni)) {
        validarCaja('dnir', 'valdnir', 'Correcto', 1);
        $('#envref').prop('disabled', false);
        return true;
    } else {
        text = 'Dni incorrecto, vuelva a ingresar el dni';
        validarCaja('dnir', 'valdnir', text, 0);
        $('#envref').prop('disabled', true);
        return false;
    }
}

function validarDniEditExpress() {
    var dni = $('#dniedit').val();
    var expres;
    var text;
    expres = /^[0-9]{8}$/;
    if (expres.test(dni)) {
        validarCaja('dniedit', 'valdniedit', 'Correcto', 1);
        $('#envrefedit').prop('disabled', false);
        return true;
    } else {
        text = 'Dni incorrecto, vuelva a ingresar el dni';
        validarCaja('dniedit', 'valdniedit', text, 0);
        $('#envrefedit').prop('disabled', true);
        return false;
    }
}

$(document).ready(function () {
    verReferencias();
    getTrabEss();
});

$('#perref').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idpersonalre = $('#idperref');
        idpersonalre.val('');
        idpersonalre.val(item.id);
        return item;
    }

});
$('#perrec').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idpersonalre = $('#idperrec');
        idpersonalre.val('');
        idpersonalre.val(item.id);
        return item;
    }

});

$('#entpac').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idpersonalre = $('#identpac');
        idpersonalre.val('');
        idpersonalre.val(item.id);
        return item;
    }

});


/*$('#entpacg').on('click', function () {
    // window.event.preventDefault();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se entregara paciente',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            if ($('#identpac').val() !== '') {
                let idr = $('#idrefentp').val();
                let idp = $('#identpac').val();
                let idv = $('#idve').val();
                $.ajax({
                    url: '/referencia/storePersonalRecib',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idr: idr,
                        idp: idp,
                        idv: idv,
                    },
                    dataType: 'JSON',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Registro de referencia exitosa',
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
                                    timer: 5000
                                });
                                location.reload();

                            }


                        }

                    ,
                    beforeSend: function () {
                        $('#entpacg').prop("disabled", true);
                    }
                });

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    type: 'error',
                    title: 'atencion!',
                    text: 'Agregue un personal para la recpecion',
                    showConfirmButton: false,
                    timer: 3000
                });

            }

        }
    });
});
*/
/// buscar personala a aregar
$('#personalre').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                        desc: item.tPAbreviatura,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let personal = new Array();
        personal[0] = item.id;
        personal[1] = item.name;
        personal[2] = item.desc;
        var ubi = 0;
        for (var i = 0; i < personales.length; i++) {
            if (personales[i][0] === personal[0]) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            personales.push(personal);
        }
        tabla_personal();
        return item;
    }

});
$('#personalre').on('change', function () {
    $('#personalre').val('');
});
$('#personalrefedit').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                        desc: item.tPAbreviatura,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idpersonalre = $('#idpersonalrefedit');
        let tipper = $('#tipperedit');
        idpersonalre.val('');
        idpersonalre.val(item.id);
        tipper.val('');
        tipper.val(item.desc);
        return item;
    }

});
//busca establecimientos a referencias
$('#essrr').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/getEstablecimientoFull",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idEess,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idess = $('#idessrr');
        idess.val('');
        idess.val(item.id);
        return item;
    }

});
//busca establecimientos origen
$('#essor').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/getEstablecimientoFull",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idEess,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idess = $('#idessor');
        idess.val('');
        idess.val(item.id);
        return item;
    }

});
$('#estabedor').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/getEstablecimientoFull",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idEess,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idess = $('#estabedorid');
        idess.val('');
        idess.val(item.id);
        return item;
    }

});


$('#estabeddes').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/getEstablecimientoFull",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.idEess,
                        name: item.Descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idess = $('#estabeddesid');
        idess.val('');
        idess.val(item.id);
        return item;
    }

});
//busca diagnosticos
$('#cie10r').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getcie10",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.cId,
                        name: item.descripcion,
                        cCodigo: item.cCodigo,
                        cDescripcion: item.cDescripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {

        let cie10 = new Array();
        cie10[0] = item.id;
        cie10[1] = item.cCodigo;
        cie10[2] = item.cDescripcion;
        var ubi = 0;

        for (var i = 0; i < cie10s.length; i++) {
            if (cie10s[i][1].toString() === cie10[1]) {
            }
        }
        if (ubi === 0) {
            cie10s.push(cie10);
        }
        tabla_cie10();
        return item;
    }

});
//busca diagnosticos
$('#cie10red').on('change', function () {
    $('#cie10red').val('');
});
$('#cie10red').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getcie10",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.cId,
                        name: item.descripcion,
                        cCodigo: item.cCodigo,
                        cDescripcion: item.cDescripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {

        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara un nuevo diagnostico',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                var idr = $('#idrefedit').val()
                var url = "/referencia/addeditcie10/" + idr + "/" + item.id;
                $.ajax(
                    {
                        type: "GET",
                        url: url,
                        cache: false,
                        dataType: 'json',
                        data: CSRF_TOKEN,
                        success: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Documentos preparados',
                                showConfirmButton: false,
                                timer: 6000
                            });
                            getCieEdtRef(idr)


                        }
                    });

            }
        })
        return item;
    }

});
$('#cie10r').on('change', function () {
    $('#cie10r').val('');
});

function tabla_cie10() {
    var datatable = $('#tabla_cie10');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: cie10s,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            searching: false, paging: false, info: false,
            columnDefs: [
                {"targets": 0, "width": "5%", "className": "text-center"},
                {"targets": 1, "width": "80%", "className": "text-left"},
                {"targets": 2, "width": "5%", "className": "text-center"},
            ],
            columns: [
                {data: 1, name: 1},
                {data: 2, name: 2},

                {
                    data: function (row) {

                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: red" TITLE="Eliminar " onclick="quitarCie10(' + row.cCodigo + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );

}

//FUNCION QUITAR PERSONAL
function quitarCie10(ccodigo) {
    var ubi = null;
    for (var i = 0; i < cie10s.length; i++) {
        if (cie10s[i][0] === ccodigo) {
            ubi = i;
        }
    }
    cie10s.splice(ubi, 1);
    tabla_cie10();
}


$('#cie10edit').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getcie10",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.cId,
                        name: item.descripcion,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idcie = $('#idcie10edit');
        idcie.val('');
        idcie.val(item.id);
        return item;
    }

});


function checklist(rid, oid) {
    $('#tabla_checklist').DataTable().destroy();
    var table = $('#tabla_checklist').DataTable({
            ajax: '/referencia/getestfile/' + rid,
            paging: false,
            ordering: false,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            'columnDefs': [
                {
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        if (data === null)
                            return ''
                        else
                            return '<input title="Clic para seleccionar" type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                },
                {"targets": 1, "width": "70%", "className": "text-left"},
                {"targets": 2, "width": "25%", "className": "text-center"},
            ],
            'select': {
                'style': 'multi'
            },


            columns: [
                {
                    data: function (row) {
                        if ([1, 7, 8, 15, 16, 17, 19].includes(row.dId) || row.rEstRev !== 0)
                            return null
                        else
                            return row.revid;
                    }
                },
                {data: 'dFDescripcion', name: 'dFDescripcion'},
                {
                    data: function (row) {
                        if (parseInt(oid) === 6) {
                            if (parseInt(row.rEstRev) === 0) {
                                if (parseInt(row.dId) === 1) {
                                    if (row.cod === null) {
                                        return '<a  href="/referencia/viatico/' + row.vId + '"  data-toggle="ajax"> ' +
                                            '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard text-purple" title="Clic para tramitar viatico"> </i>' +
                                            '</a>';
                                    } else {
                                        return '<a  href="/referencia/viatico/' + row.vId + '"  data-toggle="ajax"> ' +
                                            '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard text-success" title="Clic para tramitar viatico"> </i>' +
                                            '</a>';
                                    }
                                } else {
                                    if ([7, 8, 16, 17, 15, 19].includes(row.dId))
                                        return '';
                                    else
                                        return '<i class=" fas fa-lg fa-fw m-r-10 fa-minus-circle text-secondary" title="Por atender"> </i>';

                                }
                            } else {
                                if (parseInt(row.rEstRev) === 1) {
                                    switch (row.dId) {
                                        case 7:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>' +
                                                '<a href="/referencia/pdfformtOfic/' + row.rId + '"   TITLE="Descargar oficio" >' +
                                                '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a>';
                                        case 8:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>' +
                                                '<a href="/referencia/pdfformtInform/' + row.rId + '"   TITLE="Descargar informe" >' +
                                                '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a>';
                                        case 15:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>' +
                                                '<a href="/referencia/pdfformtI/' + row.rId + '"   TITLE="Descargar formato 1" >' +
                                                '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a>';
                                        case 16:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>' +
                                                '<a href="/referencia/pdfformtII/' + row.rId + '"   TITLE="Descargar formato 2" >' +
                                                '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a>';
                                        case 17:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>' +
                                                '<a href="/referencia/pdfformtIII/' + row.rId + '"   TITLE="Descargar formato 3" >' +
                                                '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a>';
                                        case 19:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>' +
                                                '<a href="/referencia/pdfformtReemb/' + row.rId + '"   TITLE="Descargar anexo 1" >' +
                                                '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a>';
                                        case 1:
                                            if (row.cod === null) {
                                                return '<a  href="/referencia/viatico/' + row.vId + '"  data-toggle="ajax"> ' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard text-purple" title="Clic para tramitar viatico"> </i>' +
                                                    '</a>';
                                            } else {
                                                return '<a  href="/referencia/viatico/' + row.vId + '"  data-toggle="ajax"> ' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard text-success" title="Clic para ver viatico"> </i>' +
                                                    '</a>';
                                            }
                                        default:
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="atendido"> </i>';
                                    }

                                } else {
                                    if (parseInt(row.rEstRev) === 2)
                                        return '<i class=" fas fa-lg fa-fw m-r-10 fa-check-circle text-primary" title="Revision correcta"> </i>';
                                    else {
                                        if (parseInt(row.rEstRev) === 3)
                                            return '<a href="javascript:" data-dismiss="modal"  onclick="verObservacion(' + row.rId + ',' + row.revid + ',' + oid + ')"> <i class=" fas fa-lg fa-fw m-r-10 fa-times-circle text-danger" title="observacion"> </i></a>';
                                        else
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-plus-circle" style="color: green" title="Subsanado"> </i>';
                                    }

                                }
                            }
                            // return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="Preparado"> </i>';

                        } else {
                            if (parseInt(row.rEstRev) === 0) {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-minus-circle" title="No revisado"> </i>';
                            } else {
                                if (parseInt(row.rEstRev) === 2)
                                    return '<i class=" fas fa-lg fa-fw m-r-10 fa-check-circle text-primary" title="Revision correcta"> </i>';
                                else
                                    return '<a href="javascript:" data-dismiss="modal"  onclick="verObservacion(' + row.rId + ',' + row.revid + ',' + oid + ')"> <i class=" fas fa-lg fa-fw m-r-10 fa-times-circle text-danger" title="observacion"> </i></a>';

                            }
                        }


                    }


                }

            ]
        }
    );
    $('#example-select-all').on('click', function () {
        // Get all rows with search applied
        var rows = table.rows({'search': 'applied'}).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle click on checkbox to set state of "Select all" control
    $('#tabla_checklist tbody').on('change', 'input[type="checkbox"]', function () {
        // If checkbox is not checked
        if (!this.checked) {
            var el = $('#example-select-all').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if (el && el.checked && ('indeterminate' in el)) {
                // Set visual state of "Select all" control
                // as 'indeterminate'
                el.indeterminate = true;
            }
        }
    });

    $('#button').on('click', function (e) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se preparara los documentos seleccionados',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                table.$('input[type="checkbox"]').each(function () {
                    if (this.checked) {
                        var url = "/referencia/updateCheckListref/" + this.value + "/" + rid;
                        $.ajax(
                            {
                                type: "GET",
                                url: url,
                                cache: false,
                                dataType: 'json',
                                data: CSRF_TOKEN,
                                success: function (data) {

                                    switch (parseInt(data['error'])) {
                                        case 0:
                                            checklist(rid, oid)
                                            break;
                                        case 1:
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                type: 'success',
                                                title: 'Documentos preparados',
                                                showConfirmButton: false,
                                                timer: 6000
                                            });
                                            location.reload()
                                            break;
                                        case 2:
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'error',
                                                type: 'error',
                                                title: 'Falta hacer rendicion de viaticos',
                                                showConfirmButton: false,
                                                timer: 3000
                                            });
                                            break;

                                        default:
                                            operacionError(data['error']);
                                            break;
                                    }

                                }
                            });
                    }

                });
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    type: 'success',
                    title: 'Documentos preparados',
                    showConfirmButton: false,
                    timer: 3000
                });
                //descargarOficio(rid);
            }
        })

        // Iterate over all checkboxes in the table

    });

    /* $('#button').on('click', function () {
         var rows_selected = table.column(0).checkboxes.selected();


     });*/

}

function descargarOficio(id) {
    window.location = '/referencia/pdfformtOfic/' + id;
    return true;
}

// abre modal de pacientes
function entregarPaciente(id, idv) {
    $('#idrefentp').val(id);
    $('#idve').val(idv);
    window.event.preventDefault();
    $('#modal_dialog_rec_ref').modal({show: true, backdrop: 'static', keyboard: false});
}

///arreglar pasaer a checklist
$('#subsanar').on('click', function () {
    let oid = $('#ooid').val();
    let rId = $('#orid').val();
    let idrev = $('#orevid').val();
    var url = "/referencia/subsanarobs/" + idrev;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se levantara la observacion',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
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
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Documento subsanado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            tramitar(rId, oid);
                        } else {
                            if (data['error'] === 1) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Documentos subsanado',
                                    showConfirmButton: false,
                                    timer: 6000
                                });
                                location.reload();

                            } else
                                operacionError(data['error']);
                        }
                    }

                });

        }
    })


});


function verReferencias() {

    $('#tabla_referencias').DataTable({

            ajax: '/referencia/getReferenciasEstablecimiento',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: false,
            // ordering: true,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            columnDefs: [
                {"targets": 0, "width": "5%", "className": "text-center"},
                {"targets": 1, "width": "30%", "className": "text-left"},
                {"targets": 2, "width": "30%", "className": "text-left"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "3%", "className": "text-center"},
                {"targets": 5, "width": "3%", "className": "text-center"},
                {"targets": 6, "width": "3%", "className": "text-center"},
                {"targets": 7, "width": "3%", "className": "text-center"},
                {"targets": 8, "width": "3%", "className": "text-center"},
                {"targets": 9, "width": "20%", "className": "text-center"},
            ],
            order: [[8, "asc"], [4, "desc"], [5, "desc"],],
            columns: [
                {data: 'codref', name: 'codref'},
                {data: 'essref', name: 'essref'},
                {data: 'ess', name: 'ess'},
                {data: 'rFecRef', name: 'rFecRef'},
                {
                    data: function (row) {
                        if (row.plazo === null || parseInt(row.rEst) === 0) {
                            return '<span >----</span>';
                        } else {
                            if (parseInt(row.oId) === 5 && parseInt(row.fRevEst) === 1) {
                                return '<span >----</span>';
                            } else {
                                let pam = row.pCantDia;
                                if (parseFloat(row.plazo) >= (pam * 0.5))
                                    return '<tr>' + row.plazo + '<i style="color: green" title="dias restantes" class="success fas fa-lg fa-fw m-r-10 fa-clock"> </i></tr>';
                                else {
                                    if (parseFloat(row.plazo) >= (pam * 0.2))
                                        return '<tr>' + row.plazo + '<i style="color: yellow" title="dias restantes" class="success fas fa-lg fa-fw m-r-10 fa-clock"> </i></tr>';
                                    else {
                                        return '<tr>' + row.plazo + '<i style="color: red" title="dias restantes" class="success fas fa-lg fa-fw m-r-10 fa-clock"> </i></tr>';
                                    }
                                }
                            }
                        }
                    }

                },
                {

                    data: function (row) {

                        if (row.oNombre === null) {
                            return '<span > ---- </span>';
                        } else {
                            return row.oNombre;
                        }


                    }
                },
                {

                    data: function (row) {

                        if (row.fFecRevi === null) {
                            return '<span > ---- </span>';
                        } else {

                            return row.fFecRevi;
                        }


                    }
                },
                {
                    data: function (row) {
                        if (parseInt(row.plazo) === 0 || parseInt(row.rEst) === 0) {
                            return '<span >----</span>';
                        } else {
                            if (parseInt(row.oId) === 5 && parseInt(row.fRevEst) === 1) {
                                return '<span style="color: purple">APROBADO PARA REEMBOLSO</span>';
                            } else
                                switch (parseInt(row.fRevEst)) {
                                    case 0:
                                        return '<span class="text-success">PENDIENTE</span>';
                                    case 1:
                                        return '<span class="text-primary">APROBADO</span>';
                                    case 2:
                                        return '<span class="text-danger">OBSERVADO</span>';
                                    case 3:
                                        return '<span style="color: green">SUBSANADO</span>';
                                    default:
                                        return '<span >----</span>';

                                }
                        }
                    }


                },
                {
                    data: function (row) {
                        return parseInt(row.rEst) === 0 ? '<span class="text-danger">ELIMINADO</span>' : '<span class="text-success">ACTIVO</span>'

                    }
                }
                , {
                    data: function (row) {
                        if (parseInt(row.plazo) === 0 || parseInt(row.rEst) === 0) {
                            return '<span >----</span>';
                        } else {
                            if (parseInt(row.rEstRec) === 0) {
                                if (parseInt(row.rEst) === 1) {
                                    return '<a href="javascript:"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >\n' +
                                        '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                                        '<a href="javascript:"  onclick="entregarPaciente(' + row.rId + ',' + row.vId + ')" TITLE="Entregar paciente  " >\n' +
                                        '<i class="fas fa-lg fa-fw m-r-10 fa-bed"> </i></a>\n' +
                                        '<a href="javascript:"  onclick="editarReferencia(' + row.rId + ')" TITLE="Editar referencia" >\n' +
                                        '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                        '<a href="javascript:" style="color: #ff0000" TITLE="Eliminar referencia" onclick="eliminarReferencia(' + row.rId + ')">' +
                                        '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                                        '</tr>';
                                } else {
                                    return '<a href="javascript:"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >\n' +
                                        '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                                        '<a href="javascript:"  onclick="entregarPaciente(' + row.rId + ',' + vId + ')" TITLE="Entregar paciente  " >\n' +
                                        '<i class="fas fa-lg fa-fw m-r-10 fa-bed"> </i></a>\n' +
                                        '<a href="javascript:" style="color: green" TITLE="Activar referencia" onclick="eliminarReferencia(' + row.rId + ')">\n' +
                                        '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n';
                                }

                            } else {
                                if (parseInt(row.oId) === 6) {
                                    var opc = '';
                                    let res = '';
                                    if (parseInt(row.fRevEst) !== 1 && parseInt(row.fRevEst) !== 3) {
                                        res += '<a href="javascript:"  onclick="tramitar(' + row.rId + ',' + row.oId + ')" TITLE="tramitar documentos" >\n' +
                                            '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-tasks"> </i></a>\n';
                                    } else {
                                        res += '<a href="javascript:"  onclick="abrirModalUbi(' + row.rId + ')" TITLE="Ver Historial" >\n' +
                                            '<i class="text-green fas fa-lg fa-fw m-r-10 fa-clipboard"> </i></a>\n';

                                    }
                                    if (parseInt(row.ed) === 1)
                                        opc =
                                            '<a href="javascript:"  onclick="editarReferencia(' + row.rId + ')" TITLE="Editar referencia" >\n' +
                                            '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                            '<a href="javascript:" style="color: #ff0000" TITLE="Eliminar referencia" onclick="eliminarReferencia(' + row.rId + ')">' +
                                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n';

                                    return res += '<a href="javascript:"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >\n' +
                                        '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>' + opc;
                                } else {
                                    let menu = '';
                                    if (parseInt(row.fRevEst) === 2 && row.oId === 4) {
                                        menu += '<a href="javascript"  onclick="recFileObs(' + row.uId + ')" TITLE="Recibir archivo observado" >' +
                                            '<i class="text-danger fas fa-lg fa-fw m-r-10 fa-handshake"> </i></a>';
                                    }

                                    menu += '<a href="javascript:"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >\n' +
                                        '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>\n' +
                                        '<a href="javascript:"  onclick="abrirModalUbi(' + row.rId + ')" TITLE="Ver Historial" >\n' +
                                        '<i class="text-green fas fa-lg fa-fw m-r-10 fa-clipboard"> </i></a>';

                                    return menu;
                                }

                            }
                        }

                    }
                }
            ]
        }
    )
    ;

}

function abrirModalUbi(idref) {
    window.event.preventDefault();
    $('#modal_dialog_ubic_ref').modal({show: true, backdrop: 'static', keyboard: false});
    llenarDatosUbicacion(idref);
    $('#idrefub').val(idref);
}

function abrirModalObserv(idrev, idref) {
    window.event.preventDefault();
    $('#modal_dialog_observacion_hist').modal({show: true, backdrop: 'static', keyboard: false});
    $('#idrefob').val(idref);
    var url = "/referencia/getobservacion/" + idrev;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data['error'] === 0) {
                    let obs = data['obs'];
                    $('#ocodrefh').val(obs['codref']);
                    $('#odoch').val(obs['dFDescripcion']);
                    $('#oobsh').text(obs['oMotivo']);
                    /*$('#oridh').val(rid);
                    $('#ooidh').val(oid);
                    $('#orevidh').val(revid);*/
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
        });
}

function llenarDatosUbicacion(idpaciente) {
    var time = $('#timeline');
    time.empty();
    var url = "/referencia/getUbicacion/" + idpaciente;
    //var idpaciente = $('#idpaciente').val();
    //bloquear();
    //var url = "/covid/obtenerruta/" + idpaciente;
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
                    var result1 = data['result1'];
                    var timeline = '';
                    var fecant;
                    var oficio = '';

                    for (var b = 0; b < result1.length; b++) {
                        var part1 = '   <li>\n' +
                            '                            <div class="timeline-time">\n' +
                            '                                <span class="date">' + result1[b]['uFecCrea'] + '</span>\n' +
                            '                                <span class="time">' + result1[b]['uhora'] + '</span>\n' +
                            '                            </div>\n' +
                            '                            <div class="timeline-icon">\n' +
                            '                                <a href="javascript:;">&nbsp;</a>\n' +
                            '                            </div>\n' +
                            '                            <div class="timeline-body">\n' +
                            '                                <div class="timeline-header">\n' +
                            '                                    <dt class="text-inverse text-left  text-truncate">OFICINA : </dt>\n' +
                            '                                    <dd class=" text-truncate">' + result1[b]['oNombre'] + '</dd>\n' +
                            '                                </div>\n' +
                            '                                <div class="timeline-content">\n' +
                            '                                    <dt class="text-inverse text-left  text-truncate" >PERSONA ENCARGADA :</dt>\n' +
                            '                                    <dd class=" text-truncate">' + result1[b]['nombre'] + '<dt class="text-inverse text-left  text-truncate">DOCUMENTOS PRESENTADOS :</dt>\n' +
                            '                                    <dd class=" text-truncate">\n' +
                            '                                        <ul id="contc' + result1[b]['oNombre'] + '">\n';


                        var lista = '';
                        for (var i = 0; i < result.length; i++) {

                            if (result[i]['uId'] === result1[b]['uId']) {
                                var part3 = '';

                                switch (result[i]['rEstRev']) {
                                    case 0:
                                        //part3 = '<li>' +' <small style="color: green"> EN TRAMITE</small>  </li>';
                                        part3 = '<li>' + result[i]['dFDescripcion'] + ' <small style="color:  grey">  RECEPCIONADO</small>' + ' </li>';
                                        lista = lista + part3;
                                        break;
                                    case 1:
                                        let inicio = '<li>' + result[i]['dFDescripcion'] + ' <small style="color: cornflowerblue"> ATENDIDO' +
                                            '</small>';
                                        switch (parseInt(result[i]['dId'])) {
                                            case 1:
                                                part3 = inicio + '<a  href="/referencia/viatico/' + result[i]['vId'] + '"  data-toggle="ajax">' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard text-purple" title="Clic para tramitar viatico"> </i></a></li>';
                                                break;
                                            case 7:
                                                part3 = inicio + '<a href="/referencia/pdfformtOfic/' + result[i]['rId'] + '"   TITLE="Descargar oficio " >' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a></li>';
                                                break;
                                            case 8:
                                                part3 = inicio + '<a href="/referencia/pdfformtInform/' + result[i]['rId'] + '"   TITLE="Descargar informe " >' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a></li>';
                                                break;
                                            case 15:
                                                part3 = inicio + '<a href="/referencia/pdfformtI/' + result[i]['rId'] + '"   TITLE="Descargar formato 1 " >' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a></li>';
                                                break;
                                            case 16:
                                                part3 = inicio + '<a href="/referencia/pdfformtII/' + result[i]['rId'] + '"   TITLE="Descargar formato 2 " >' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a></li>';
                                                break;
                                            case 17:
                                                part3 = inicio + '<a href="/referencia/pdfformtIII/' + result[i]['rId'] + '"   TITLE="Descargar formato 3 " >' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a></li>';
                                                break;
                                            case 19:
                                                part3 = inicio + '<a href="/referencia/pdfformtReemb/' + result[i]['rId'] + '"   TITLE="Descargar anexo I " >' +
                                                    '<i class="fas fa-lg fa-fw m-r-10 fa-file-pdf text-danger"> </i></a></li>';
                                                break;


                                            default:
                                                part3 = inicio + ' </li>';
                                                break;
                                        }
                                        lista += part3;
                                        break;
                                    case 2:
                                        part3 = '<li>' + result[i]['dFDescripcion'] + ' <small style="color: #0a6aa1">  APROBADO</small>' + ' </li>';
                                        lista += part3;
                                        break;
                                    case 3:
                                        //part3 = '<li>' +result[i]['dFDescripcion'] + ' <small style="color: RED">  OBSERVADO </small>'+' </li>';
                                        part3 = '<li>' + result[i]['dFDescripcion'] + '<a data-dismiss="modal"  onclick="abrirModalObserv(' + result[i]['rvId'] + ',' + result[i]['rId'] + ')" ' +
                                            'title="Ver Observacion" >' + ' <small style="color: RED">  OBSERVADO </small>' + '</a>' + ' </li>';
                                        lista += part3;
                                        break;
                                    case 4:
                                        part3 = '<li>' + result[i]['dFDescripcion'] + ' <small style="color: green"> SUBSANADO  </small>' + ' </li>';
                                        lista += part3;
                                        break;
                                }
                                /*if (result[i]['rEstRev'] === 0) {
                                    part3 = '<li>' +' <small style="color: green"> EN TRAMITE</small>  </li>';
                                    lista = lista + part3;
                                }else{
                                    part3 = '<li>' +result[i]['dFDescripcion'] + ' <small style="color: cornflowerblue">  ACEPTADO </small>'+' </li>';
                                    lista = lista + part3;
                                }*/
                                //fecant = result[i]['pCantDia'];
                            }
                        }

                        var part2 = '                                        </ul>\n' +
                            '                                    </dd>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                        </li>';
                        timeline = timeline + part1 + oficio + lista + part2;
                    }

                    /* var part2 = '                                        </ul>\n' +
                         '                                    </dd>\n' +
                         '                                </div>\n' +
                         '                            </div>\n' +
                         '                        </li>';*/
                    //timeline = timeline + part1 + lista + part2;
                    //timeline = timeline + part1 + lista + part2;
                    time.append(timeline);
                } else {

                }
            }

        });
}

$('#cmodalobsh').on('click', function () {
    abrirModalUbi($('#idrefob').val());
});
$('#cmodalobschec').on('click', function () {
    tramitar($('#orid').val(), $('#ooid').val());
});

function eliminarReferencia(idref) {
    var url = "/referencia/deleteRef/" + idref;
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
                            redirect('/referencia/verreferenciasess');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Referencia eliminado/restaurado correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/referencia/verreferenciasess');
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

//agrega personal a las referencias
$('#addper').on('click', function () {
    let idpersonal = $('#idpersonalre').val();
    let persona = $('#personalre');
    let tipper = $('#tipper').val();
    if (idpersonal !== '' && persona.val() !== '' && tipper !== '') {

    } else {
        errorFunc('Busque el personal para asignar a la referencia');
        persona.focus();
    }
});
$('#addoredit').on('click', function () {
    let idpersonal = $('#idpersonalrefedit').val();
    let persona = $('#personalrefedit');
    let tipper = $('#tipperedit').val();
    if (idpersonal !== '' && persona.val() !== '' && tipper !== '') {
        let personal = new Array();
        personal['pId'] = idpersonal;
        personal['personals'] = persona.val();
        personal['tPDescripcion'] = tipper;
        personal['estp'] = 1;
        var ubi = 0;
        for (var i = 0; i < personaledit.length; i++) {
            if (personaledit[i]['pId'].toString() === personal['pId']) {
                ubi = 1;
            }
        }
        if (ubi === 0) {
            $('#envrefedit').prop("disabled", false);
            personaledit.push(personal);
        }

        tablapersonalEdit();
        persona.val('');
        $('#idpersonalrefedit').val('');
        $('#tipperedit').val('');
        persona.focus();
    } else {
        errorFunc('Busque el personal para asignar a la referencia');
        persona.focus();
    }
});

// tabla para ve rla lista del personal que participa en la referencia
function tabla_personal() {
    var datatable = $('#tabla_personalre');
    datatable.DataTable().destroy();
    datatable.DataTable({
            data: personales,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            columnDefs: [
                {"targets": 0, "width": "60%", "className": "text-left"},
                {"targets": 1, "width": "10%", "className": "text-center"},
                {"targets": 2, "width": "20%", "className": "text-center"},
            ],
            searching: false, paging: false, info: false,
            columns: [
                {data: 1, name: 1},
                {data: 2, name: 2},

                {
                    data: function (row) {

                        return '<tr >\n' +
                            '<a href="javascript:;" style="color: red" TITLE="Quitar fila " onclick="quitarPersonal(' + row.idpersonal + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-trash"> </i></a>\n' +
                            '</tr>';

                    }
                }
            ]
        }
    );

}

//FUNCION QUITAR PERSONAL
function quitarPersonal(idpersonal) {
    var ubi = null;
    for (var i = 0; i < personales.length; i++) {
        if (personales[i][0] === idpersonal) {
            ubi = i;
        }
    }
    personales.splice(ubi, 1);
    tabla_personal();
}


//mostrar quienes han sido eliminados
function getpersonaleliminado() {
    for (var i = 0; i < personaleditdelete.length; i++) {
        var cnt = 0;
        for (var b = 0; b < personaledit.length; b++) {
            if (personaleditdelete[i]['pId'] == personaledit[b]['pId']) {
            } else {
                cnt = cnt + 1;
                if (cnt == personaledit.length) {
                    var tablapersonalfin = new Array();
                    tablapersonalfin[0] = personaleditdelete[i]['pId'].toString();
                    tablapersonalfin[1] = personaleditdelete[i]['personals'];
                    tablapersonalfin[2] = personaleditdelete[i]['tPDescripcion'];
                    tablapersonalfin[3] = personaleditdelete[i]['estp'];
                    personaleditfin.push(tablapersonalfin)
                    if (personaledit[b]['estp'] == 1 && i == 0) {
                        var tablapersonalfin = new Array();
                        tablapersonalfin[0] = personaledit[b]['pId'];
                        tablapersonalfin[1] = personaledit[b]['personals'];
                        tablapersonalfin[2] = personaledit[b]['tPDescripcion'];
                        tablapersonalfin[3] = personaledit[b]['estp'];
                        personaleditfin.push(tablapersonalfin)
                    }
                } else {
                    if (personaledit[b]['estp'] == 1 && i == 0) {
                        var tablapersonalfin = new Array();
                        tablapersonalfin[0] = personaledit[b]['pId'];
                        tablapersonalfin[1] = personaledit[b]['personals'];
                        tablapersonalfin[2] = personaledit[b]['tPDescripcion'];
                        tablapersonalfin[3] = personaledit[b]['estp'];
                        personaleditfin.push(tablapersonalfin)
                    }
                }
            }
        }
    }
}

$('#envrefedit').on('click', function () {
    getpersonaleliminado();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se registrara una referencia',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {

            if (validarFormularioEditRef() === 0) {
                if (personaledit.length === 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        type: 'error',
                        title: 'atencion!',
                        text: 'Agregue personal a la referencia',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#envrefedit').prop("disabled", true);

                } else {

                    let idref = $('#idrefedit').val();
                    let dniedit = $('#dniedit').val();
                    let pid = $('#pidedit').val();
                    let estpr = $('#estpredit').val();
                    var conver = $('#nrofuaedit').val();
                    var gg = conver.split('-')
                    var nrofua = gg[0] + gg[1] + gg[2];
                    let estabedorid = $('#estabedorid').val()
                    let idessrr = $('#estabeddesid').val()
                    let fecrefred = $('#fecrefred').data('DateTimePicker').date();
                    console.log(fecrefred);
                    fecrefred = new Date(fecrefred);
                    console.log(fecrefred);
                    let fecreted = $('#fecreted').data('DateTimePicker').date();
                    fecreted = new Date(fecreted);

                    let idveh = $('#idvehirefedit').val();

                    let motr = $('#motrefedit').val();
                    let idperdereced = $('#idperdereced').val();
                    let idperderefed = $('#idperderefed').val();
                    motr = JSON.stringify(motr);
                    $.ajax({
                        url: '/referencia/editRef',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            idref: idref,
                            pid: pid,
                            estpr: estpr,
                            nrofua: nrofua,
                            estabedorid: estabedorid,
                            idessrr: idessrr,
                            fecrefred: fecrefred,
                            fecreted: fecreted,
                            idveh: idveh,
                            motr: motr,
                            idperdereced: idperdereced,
                            idperderefed: idperderefed,
                            dniedit: dniedit

                        },
                        dataType: 'JSON',
                        success:
                            function (data) {
                                if (data['error'] === 0) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        type: 'success',
                                        title: 'Registro de referencia exitosa',
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
                                        timer: 5000
                                    });
                                    location.reload();

                                }


                            }

                        ,
                        beforeSend: function () {
                            $('#envrefedit').prop("disabled", true);
                        }
                    });
                }

            } else {
                operacionSubsanar();
            }

        }
    });

});

function validarFormularioAgRef() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($("#otip").is(':checked')) {
        if ($('#essor').val() !== '') {
            validarCaja('essor', 'valessor', 'Correcto', 1);
        } else {
            cont++;
            text = inicio + ' ingrese establecimiento de origen';
            validarCaja('essor', 'valessor', text, 0);
        }
    }
    if ($('#estpr').val() !== '0') {
        validarCaja('estpr', 'valestpr', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione un estado';
        validarCaja('estpr', 'valestpr', text, 0);
    }


    if ($('#dnir').val() !== '') {
        validarCaja('dnir', 'valdnir', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese el dni';
        validarCaja('dnir', 'valdnir', text, 0);
    }
    if ($('#movil').is(':checked')) {
    } else {
        if ($('#idvehiref').val() !== '0') {
            validarCaja('placar', 'valplacar', 'Correcto', 1);
        } else {
            cont++;
            text = inicio + ' ingrese placa';
            validarCaja('placar', 'valplacar', text, 0);
        }
    }
    if ($('#idessrr').val() !== '') {
        validarCaja('essrr', 'valessrr', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese y seleccione un establecimiento';
        validarCaja('essrr', 'valessrr', text, 0);
    }
    if ($('#nrofua').val() !== '') {
        validarCaja('nrofua', 'valnrofua', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Nro de fua correcto,12 digitos';
        validarCaja('nrofua', 'valnrofua', text, 0);
    }
    if ($('#idperref').val() !== '') {
        validarCaja('perref', 'valperref', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Nro de fua correcto,12 digitos';
        validarCaja('perref', 'valperref', text, 0);
    }
    if ($('#idperrec').val() !== '') {
        validarCaja('perrec', 'valnrofua', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Nro de fua correcto,12 digitos';
        validarCaja('perrec', 'valperrec', text, 0);
    }
    if ($('#vfecrefr').val() !== '') {
        validarCaja('vfecrefr', 'valperrec', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese fecha y hora de salida';
        validarCaja('vfecrefr', 'valfecrefr', text, 0);
    }

    if ($('#vfecret').val() !== '') {
        validarCaja('vfecret', 'valfecret', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese fecha y hora de retorno';
        validarCaja('vfecret', 'valfecret', text, 0);
    }
    if ($('#otip').is(':checked')) {
    } else {
        if ($('#essor').val() !== '0') {
            validarCaja('essor', 'valessor', 'Correcto', 1);
        } else {
            cont++;
            text = inicio + ' ingrese placa';
            validarCaja('essor', 'valessor', text, 0);
        }
    }
    return cont;

}

function validarFormularioEditRef() {
    var inicio = 'Por favor';
    var text;
    var cont = 0;

    if ($('#estpredit').val() !== '0') {
        validarCaja('estpredit', 'valestpredit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Seleccione un estado';
        validarCaja('estpredit', 'valestpredit', text, 0);
    }


    if ($('#dniedit').val() !== '') {
        validarCaja('dniedit', 'valdniedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese el dni';
        validarCaja('dniedit', 'valdniedit', text, 0);
    }
    /* if ($('#motr').text() !== '') {
         validarCaja('motr', 'valmotr', 'Correcto', 1);
     } else {
         cont++;
         text = inicio + ' ingrese motivo de referencia';
         validarCaja('motr', 'valmotr', text, 0);
     }*/
    if ($('#idestabedit').val() !== '') {
        validarCaja('essrr', 'valessrr', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese y seleccione un establecimiento';
        validarCaja('estabedit', 'valestabedit', text, 0);
    }
    if ($('#idcie10edit').val() !== '') {
        validarCaja('cie10edit', 'valcie10edit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese y seleccione un CIE0';
        validarCaja('cie10edit', 'valcie10edit', text, 0);
    }
    if ($('#fecrefredit').val() !== '') {
        validarCaja('fecrefredit', 'valfecrefredit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' ingrese la fecha';
        validarCaja('fecrefredit', 'valfecrefredit', text, 0);
    }
    if ($('#nrofuaedit').val() !== '') {
        validarCaja('nrofuaedit', 'valnrofuaedit', 'Correcto', 1);
    } else {
        cont++;
        text = inicio + ' Ingrese Nro de fua correcto,12 digitos';
        validarCaja('nrofuaedit', 'valnrofuaedit', text, 0);
    }
    return cont;

}


function recFileObs(uId) {
    window.event.preventDefault();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se recepcionara el archivo observado',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/referencia/recdocobsess/' + uId,
                type: 'GET',
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Recepcion de File exitoso',
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

            });

        }
    })
}


$("#otip").on('change', function () {
    if ($(this).is(':checked')) {
        $('#otrip').prop("hidden", false);
        $('#idessor').val(0);
        $('#essor').val("");
        $('#essor').focus();
    } else {
        $('#otrip').prop("hidden", true);


    }
});

function quitarPersonalEdit(idpersonal) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se eliminara un personal que acompaña la referencia',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            var idr = $('#idrefedit').val()
            var url = "/referencia/destroyPersonalRef/" + idpersonal + "/" + idr;
            $.ajax(
                {

                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: CSRF_TOKEN,
                    success: function (data) {

                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Personal eliminado de la referencia',
                                showConfirmButton: false,
                                timer: 6000
                            });
                            getpersonaledit(idr);
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
                        }

                    }
                });
        }
    })
    tablapersonalEdit();
}

perderefed
/// buscar personala a aregar
$('#personaled').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                        desc: item.tPAbreviatura,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        Swal.fire({
            title: 'Esta seguro(a)?',
            text: 'Se agregara un personal acompañante',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                var idr = $('#idrefedit').val()
                var url = "/referencia/addeditper/" + item.id + "/" + idr;
                $.ajax(
                    {

                        type: "GET",
                        url: url,
                        cache: false,
                        dataType: 'json',
                        data: CSRF_TOKEN,
                        success: function (data) {

                            if (data['error'] === 0) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Personal agregado a la referencia',
                                    showConfirmButton: false,
                                    timer: 6000
                                });
                                getpersonaledit(idr);
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
                            }

                        }
                    });
            }
        })
        return item;
    }

});
$('#personaled').on('change', function () {
    $('#personaled').val('');
});

$('#perderefed').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idpersonalre = $('#idperderefed');
        idpersonalre.val('');
        idpersonalre.val(item.id);
        return item;
    }

});
$('#perdereced').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/referencia/getpersonal",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({
                        id: item.pId,
                        name: item.nombres,
                    });
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        let idpersonalre = $('#idperdereced');
        idpersonalre.val('');
        idpersonalre.val(item.id);
        return item;
    }

});
