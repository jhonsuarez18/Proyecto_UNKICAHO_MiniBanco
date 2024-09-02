var data = [];
var idof = 0;
var datadoc = [];
$(document).ready(function () {

    // a partir de aqui

    getTrabEntidad();
});

function getTrabEntidad() {
    var url = "/referencia/gettrabenti";
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: CSRF_TOKEN,
            success: function (data) {
                if (data[0]['error'] === 0) {
                    let datos = data[0]['ent'];
                    if (datos['nomb'] !== null) {
                        $('#indent').val(datos['nomb']);
                        idof = datos['oId'];
                        switch (parseInt(datos['ofitrab'])) {
                            case  1:
                                verReferencias();
                                break;
                            case  2:
                                break;
                            case  3:
                                verReferenciasUdr();
                                break;

                        }


                        //
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
                //swal.showLoading();
            },
        });
}


function verObservacion(id, rid, oid) {
    $('#modal_dialog_observacion').modal({show: true, backdrop: 'static', keyboard: false});
    var url = "/referencia/getobservacion/" + id;
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

$('#obsb').on('click', function () {
    tramitar($('#orid').val(), $('#ooid').val());
});


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
                            checklist(rid, oid);
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

function verReferenciasUdr() {
    $('#tabla_rendicion').DataTable({
            ajax: '/referencia/referenciasudr',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            columnDefs: [
                {"targets": 0, "width": "5%", "className": "text-center"},
                {"targets": 1, "width": "20%", "className": "text-left"},
                {"targets": 2, "width": "20%", "className": "text-left"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},
                {"targets": 5, "width": "5%", "className": "text-center"},
                {"targets": 6, "width": "5%", "className": "text-center"},
                {"targets": 7, "width": "5%", "className": "text-center"},
                {"targets": 8, "width": "5%", "className": "text-center"},
                {"targets": 9, "width": "5%", "className": "text-center"},
            ],
            order: [[9, "asc"], [8, "desc"], [6, "asc"]],
            columns: [
                {data: 'codref', name: 'codref'},
                {data: 'essref', name: 'essref'},
                {data: 'ess', name: 'ess'},
                {data: 'rFecRef', name: 'rFecRef'},
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
                        if (row.plazo === null || parseInt(row.plazo) === 0 || parseInt(row.rEst) === 0) {
                            return '<span > ---- </span>';
                        } else {
                            if (parseInt(row.oId) === 5 && parseInt(row.fRevEst) === 1) {
                                return '<span > ---- </span>';
                            } else {
                                let pam = row.pCantDia;
                                if (row.plazo >= (pam * 0.5))
                                    return '<tr>' + row.plazo + '<i style="color: green" title="dias restantes" class="success fas fa-lg fa-fw m-r-10 fa-clock"> </i></tr>';
                                else {
                                    if (row.plazo >= (pam * 0.2))
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
                },
                {
                    data: function (row) {
                        let res = '<a href="#"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >\n' +
                            '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>' +
                            '<a href="#"  onclick="tramitarUdr(' + row.rId + ',' + row.oId + ',' + row.fRevEst + ')" TITLE="tramitar checklist" >' +
                            '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-tasks"> </i></a>';
                        if (parseInt(row.fRevEst) === 1 && parseInt(row.oId) === 4) {
                            res += '<a href="#"  onclick="recdoc(' + row.rId + ')" TITLE="Recibir documento" >' +
                                '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-handshake"> </i></a>';
                        }
                        return res;
                    }
                }
            ]
        }
    );

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
                url: '/referencia/recdocobs/' + uId,
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

function genDocSub() {

}

function verReferencias() {
    $('#tabla_rendicion').DataTable({
            ajax: '/referencia/referenciasentidad',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            columnDefs: [
                {"targets": 0, "width": "5%", "className": "text-center"},
                {"targets": 1, "width": "30%", "className": "text-left"},
                {"targets": 2, "width": "30%", "className": "text-left"},
                {"targets": 3, "width": "5%", "className": "text-center"},
                {"targets": 4, "width": "5%", "className": "text-center"},
                {"targets": 5, "width": "5%", "className": "text-center"},
                {"targets": 6, "width": "5%", "className": "text-center"},
                {"targets": 7, "width": "5%", "className": "text-center"},
                {"targets": 8, "width": "10%", "className": "text-center"},

            ],
            order: [[9, "asc"], [8, "desc"], [6, "asc"]],
            columns: [
                {data: 'codref', name: 'codref'},
                {data: 'essref', name: 'essref'},
                {data: 'ess', name: 'ess'},
                {data: 'rFecRef', name: 'rFecRef'},
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
                        if (row.plazo === null || parseInt(row.plazo) === 0 || parseInt(row.rEst) === 0) {
                            return '<span > ---- </span>';
                        } else {
                            if (parseInt(row.oId) === 5 && parseInt(row.fRevEst) === 1) {
                                return '<span > ---- </span>';
                            } else {
                                let pam = row.pCantDia;
                                if (row.plazo >= (pam * 0.5))
                                    return '<tr>' + row.plazo + '<i style="color: green" title="dias restantes" class="success fas fa-lg fa-fw m-r-10 fa-clock"> </i></tr>';
                                else {
                                    if (row.plazo >= (pam * 0.2))
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
                },
                {
                    data: function (row) {
                        if (parseInt(row.plazo) === 0 || parseInt(row.rEst) === 0) {
                            return '<span >----</span>';
                        } else {
                            if (parseInt(row.oId) === 6) {
                                var men = '';
                                if (parseInt(row.fRevEst) != 0 && parseInt(row.fRevEst) != 2) {
                                    men += '<a href="#"  onclick="recdoc(' + row.rId + ')" TITLE="Recibir documento" >' +
                                        '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-handshake"> </i></a>';
                                }
                                men += '<a href="#"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >\n' +
                                    '<i class="text-orange fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>' +
                                    '<a href="#"  onclick="notificarId(' + row.oEId + ')" TITLE="Notificar" >' +
                                    '<i class="text-warning fas fa-lg fa-fw m-r-10 fa-bullhorn"> </i></a>' +
                                    '<a href="#"  onclick="tramitar(' + row.rId + ',' + row.oId + ',' + row.fRevEst + ')" TITLE="tramitar checklist" >' +
                                    '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-tasks"> </i></a>';
                                return men;
                            } else {
                                let menu = '';
                                if (parseInt(row.oId) === 5 || parseInt(row.oId) === 7) {
                                    if (parseInt(row.fRevEst) === 2)
                                        menu += '<a href="#"  onclick="recFileObs(' + row.uId + ')" TITLE="Recibir documento observado" >' +
                                            '<i class="text-danger fas fa-lg fa-fw m-r-10 fa-handshake"> </i></a>';

                                }
                                menu += '<a href="#"  onclick="detalleRef(' + row.rId + ',' + row.rEst + ')" TITLE="ver detalle" >' +
                                    '<i class="text-success fas fa-lg fa-fw m-r-10 fa-eye"> </i></a>';
                                /*  if (parseInt(row.oId) !== 5 || parseInt(row.fRevEst) !== 0){
                                      menu += '<a href="#"  onclick="tramitar(' + row.rId + ',' + row.oId + ')" TITLE="tramitar checklist" >' +
                                          '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-tasks"> </i></a>';
                                  }else{
                                      if(parseInt(row.fRevEst) !== 0 && idof!==4){*/
                                menu += '<a href="#"  onclick="tramitar(' + row.rId + ',' + row.oId + ',' + row.fRevEst + ')" TITLE="tramitar checklist1" >' +
                                    '<i class="text-purple fas fa-lg fa-fw m-r-10 fa-tasks"> </i></a>';
                                //  }
                                //}
                                return menu;

                            }
                        }
                    }
                }
            ]
        }
    );

}

function tramitar(idRef, oid, estrev) {
    if (parseInt(oid) === 6) {
        window.event.preventDefault();
        $('#modal_dialog_checkList').modal({show: true, backdrop: 'static', keyboard: false});
        checklist(idRef, oid);
    } else {
        if (parseInt(oid) === 4) {
            if (parseInt(estrev) !== 0) {
                window.event.preventDefault();
                $('#modal_dialog_checkList').modal({show: true, backdrop: 'static', keyboard: false});
                checklist(idRef, oid);
            } else {
                window.event.preventDefault();
                $('#modal_dialog_checkList1').modal({show: true, backdrop: 'static', keyboard: false});
                checklist1(idRef, oid);
            }
        } else {
            window.event.preventDefault();
            $('#modal_dialog_checkList').modal({show: true, backdrop: 'static', keyboard: false});
            checklist(idRef, oid);
        }
    }
}

function tramitarUdr(idRef, oid, estrev) {
    if (parseInt(oid) === 4) {
        window.event.preventDefault();
        $('#modal_dialog_checkList').modal({show: true, backdrop: 'static', keyboard: false});
        checklist(idRef, oid);
    } else {
        if (parseInt(estrev) === 1) {
            window.event.preventDefault();
            $('#modal_dialog_checkList').modal({show: true, backdrop: 'static', keyboard: false});
            checklist(idRef, oid);
        } else {

            window.event.preventDefault();
            $('#modal_dialog_checkList1').modal({show: true, backdrop: 'static', keyboard: false});
            checklist1(idRef, oid);
        }
    }
}


function checklist1(rid, oid) {
    $('#tabla_checklist1').DataTable().destroy();
    var datatable = $('#tabla_checklist1').DataTable({
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
                        if (data === null) {
                            return ''
                        } else {
                            return '<input title="Clic para seleccionar" type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                        }
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
                        if (parseInt(oid) !== 6) {
                            if (parseInt(row.rEstRev) === 2 || parseInt(row.rEstRev) === 3) {
                                return null
                            } else {
                                return row.revid;
                            }
                        }

                    }
                },
                {data: 'dFDescripcion', name: 'dFDescripcion'},
                {
                    data: function (row) {
                        if (parseInt(oid) !== idof) {
                            if (parseInt(row.rEstRev) === 0)
                                return '<i class=" fas fa-lg fa-fw m-r-10 fa-minus-circle " title="Por atender"> </i>';
                            else {
                                if (parseInt(row.rEstRev) === 1)
                                    return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="Atendido"> </i>';
                                else {
                                    if (parseInt(row.rEstRev) === 2)
                                        return '<i class=" fas fa-lg fa-fw m-r-10 fa-check-circle text-primary" title="Aprendido"> </i>';
                                    else {
                                        if (parseInt(row.rEstRev) === 3)
                                            return '<a href="javascript:" data-dismiss="modal"  ' +
                                                'onclick="verObservacion(' + row.revid + ',' + rid + ',' + oid + ')"> ' +
                                                '<i class=" fas fa-lg fa-fw m-r-10 fa-times-circle text-danger" title="observacion"> </i></a>';
                                        else
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-plus-circle" style="color: green" title="Subsanado"> </i>';
                                    }

                                }
                            }

                        } else {

                            if (parseInt(row.rEstRev) === 0)
                                return '<select id="sl' + row.revid + '" onchange="revisarCheckList(' + row.revid + ',' + oid + ',' + rid + ')">\n' +
                                    '  <option value="0">SELECCIONAR </option>\n' +
                                    '  <option value="1">CORRECTO</option>\n' +
                                    '  <option value="2">OBSERVADO</option>\n' +
                                    '</select>';
                            else {
                                if (parseInt(row.rEstRev) === 2)
                                    return '<i class=" fas fa-lg fa-fw m-r-10 fa-check-circle text-primary" title="cORRECTO"> </i>';
                                else if (parseInt(row.rEstRev) === 3)
                                    return '<div data-dismiss="modal" onclick="verObservacion(' + row.revid + ',' + rid + ',' + oid + ')" > <i class=" fas fa-lg fa-fw m-r-10 fa-times-circle text-danger" title="Ver observacion"> </i></div>';
                            }


                        }

                    }

                },
            ]
        }
    );
    $('#example-select-all').on('click', function () {
        // Get all rows with search applied
        var rows = datatable.rows({'search': 'applied'}).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle click on checkbox to set state of "Select all" control
    $('#tabla_checklist1 tbody').on('change', 'input[type="checkbox"]', function () {
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
            text: 'Documentos seleccionados Correctos',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                datatable.$('input[type="checkbox"]').each(function () {
                    if (this.checked) {
                        var url = "/referencia/updateCheckListrefer/" + this.value;
                        $.ajax(
                            {
                                type: "GET",
                                url: url,
                                cache: false,
                                dataType: 'json',
                                data: CSRF_TOKEN,
                                success: function (data) {
                                    if (data['error'] === 0) {
                                        checklist1(rid, oid);
                                    } else {
                                        if (data['error'] === 1) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                type: 'success',
                                                title: 'Documentos Correctos',
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

                });
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    type: 'success',
                    title: 'Documentos Correctos',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        })

    });
}

function checklist(rid, oid) {
    var datatable = $('#tabla_checklist');
    datatable.DataTable().destroy();
    datatable.DataTable({
            ajax: '/referencia/getestfile/' + rid,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            paging: false,
            columnDefs: [
                {"targets": 0, "width": "80%", "className": "text-left"},
                {"targets": 1, "width": "20%", "className": "text-center"},
            ],
            columns: [
                {data: 'dFDescripcion', name: 'dFDescripcion'},
                {
                    data: function (row) {
                        if (parseInt(oid) !== idof) {
                            if (parseInt(row.rEstRev) === 0)
                                return '<i class=" fas fa-lg fa-fw m-r-10 fa-minus-circle " title="Por atender"> </i>';
                            else {
                                if (parseInt(row.rEstRev) === 1)
                                    return '<i class="fas fa-lg fa-fw m-r-10 fa-archive text-success" title="Atendido"> </i>';
                                else {
                                    if (parseInt(row.rEstRev) === 2)
                                        return '<i class=" fas fa-lg fa-fw m-r-10 fa-check-circle text-primary" title="Aprendido"> </i>';
                                    else {
                                        if (parseInt(row.rEstRev) === 3)
                                            return '<a href="javascript:" data-dismiss="modal"  ' +
                                                'onclick="verObservacion(' + row.revid + ',' + rid + ',' + oid + ')"> ' +
                                                '<i class=" fas fa-lg fa-fw m-r-10 fa-times-circle text-danger" title="observacion"> </i></a>';
                                        else
                                            return '<i class="fas fa-lg fa-fw m-r-10 fa-plus-circle" style="color: green" title="Subsanado"> </i>';
                                    }

                                }
                            }

                        } else {

                            if (parseInt(row.rEstRev) === 0)
                                return '<select id="sl' + row.revid + '" onchange="revisarCheckList(' + row.revid + ',' + oid + ',' + rid + ')">\n' +
                                    '  <option value="0">SELECCIONAR </option>\n' +
                                    '  <option value="1">CORRECTO</option>\n' +
                                    '  <option value="2">OBSERVADO</option>\n' +
                                    '</select>';
                            else {
                                if (parseInt(row.rEstRev) === 2)
                                    return '<i class=" fas fa-lg fa-fw m-r-10 fa-check-circle text-primary" title="cORRECTO"> </i>';
                                else if (parseInt(row.rEstRev) === 3)
                                    return '<div data-dismiss="modal" onclick="verObservacion(' + row.revid + ',' + rid + ',' + oid + ')" > <i class=" fas fa-lg fa-fw m-r-10 fa-times-circle text-danger" title="Ver observacion"> </i></div>';
                            }


                        }

                    }

                },
            ]
        }
    )
    ;

}

function revisarCheckList(revrid, oid, rid) {
    let val = $('#sl' + revrid).children("option:selected").val();
    let obs;
    let est;
    switch (val) {
        case '0':
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                type: 'warning',
                title: 'Escoja un estado',
                showConfirmButton: false,
                timer: 3000
            });
            break;
        case '1':
            est = 2;
            enviarRevision(1, 2, revrid, null, oid, rid);
            break;
        case '2':
            Swal.fire({
                title: 'INGRESE OBSERVACION',
                input: 'textarea',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'no'
            }).then(function (result) {
                if (result.value) {
                    enviarRevision(2, 3, revrid, result.value, oid, rid)
                }
            });

            break;
    }
}


function enviarRevision(op, est, revrid, obs, oid, rid) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se revisara el documento',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            obs = JSON.stringify(obs);
            $.ajax({
                url: '/referencia/revisionStore',
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    op: op,
                    est: est,
                    revrid: revrid,
                    obs: obs,
                    rid: rid,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Documento revisado',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            checklist1(data['id'], oid);
                        } else {
                            if (data['error'] === 1) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    type: 'success',
                                    title: 'Documentos revisados',
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
    });
}



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



function tablapersonaldetref() {
    var datatable = $('#tabla_personal_verdet');
    datatable.DataTable().destroy();//Elimina la tabla y refrezca los nuevos datos ingresados
    datatable.DataTable({

            data: personaldetref,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
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

function recdoc(idRef) {
    window.event.preventDefault();
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se recepcionara el documento',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/referencia/recibirdoc/' + idRef,
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


function notificarId(idof) {
    window.event.preventDefault();
    Swal.fire({
        title: 'INGRESE NOTIFICACIÓN',
        input: 'textarea',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Enviar',
        cancelButtonText: 'Cancelar'
    }).then(function (result) {
        if (result.value) {
            enviarNotificacion(idof, result.value)
        }
    });
}

function enviarNotificacion(idof, notif) {
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se registrara una Notificación',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'no'
    }).then((result) => {
        if (result.value) {
            notif = JSON.stringify(notif);
            $.ajax({
                url: '/referencia/notificacionStore',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    idof: idof,
                    notif: notif,
                },
                dataType: 'JSON',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Envio de notificacion exitoso',
                                showConfirmButton: false,
                                timer: 4000
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
                                timer: 4000
                            });
                            location.reload();
                        }

                    }
            });


        }
    });
}
