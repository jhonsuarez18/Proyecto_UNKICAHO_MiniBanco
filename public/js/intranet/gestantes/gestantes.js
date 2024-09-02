var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var datePickers = function () {

    $('#fecnac').datepicker({
        todayHighlight: true,
        autoclose: true
    });

    $('#fecgest').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecregla').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecafi').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecate').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecnv').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fecabo').datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $('#fectami').datepicker({
        todayHighlight: true,
        autoclose: true
    });

};

$('#checkges').click(function () {

    var idgestante = $('#idgestante').val();
    if (this.checked) {
        Swal.fire({
            title: 'Cuidado!',
            text: 'Si confirma que la gestante dio a luz, todos los datos que no se hayan registrando, se utogeneraran como no atendidos!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, acepto',
            cancelButtonText: 'no, cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: "gestante/cambiarestado/" + idgestante,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success:
                        function (data) {
                            if (data['error'] === 0) {
                                desbloquear();
                                operacionExitosa();
                                redirect('/gestante/control/' + idgestante);
                            } else {
                                bloquear();
                                operacionError(data['error']);
                            }

                        }
                    ,
                    beforeSend: function () {

                    }
                })

            }
            else {

            }
        });
    }
    else {

    }

});


$("#tipact").change(function () {
    var val = $("#tipact").val();
    var opc1 = $("#atepre");
    var opc2 = $("#ateprere");
    var opc3 = $("#exaux");
    var opc4 = $("#seguipre");
    var idgest = $("#idgestante").val();

    switch (val) {
        case '1':
            actividadAPN(idgest);
            opc1.removeClass("hide");
            opc2.addClass("hide");
            opc3.addClass("hide");
            opc4.addClass("hide");
            break;
        case '2':
            actividadAPR(idgest);
            opc1.addClass("hide");
            opc2.removeClass("hide");
            opc3.addClass("hide");
            opc4.addClass("hide");
            break;
        case '3':
            actividadEAB(idgest);
            opc1.addClass("hide");
            opc2.addClass("hide");
            opc3.removeClass("hide");
            opc4.addClass("hide");
            break;
        case '4':
            opc1.addClass("hide");
            opc2.addClass("hide");
            opc3.addClass("hide");
            opc4.removeClass("hide");
            break;
    }
    ;
});


var complementos = function () {
    "use strict";
    return {
        //main function
        init: function () {
            datePickers();
        }
    };
}();

$(document).ready(function () {
    complementos.init();
});

function opcmodal(opc, idsubactividad, idactividad) {
    var valhtml;
    var idopc = $('#modalopc');

    idopc.empty();
    if (opc === 1) {
        valhtml =
            '<input type="text"   id="idgestantemod"  hidden>' +
            '<input type="text"   id="idactividadmod"  hidden>' +
            '<label for="fecate" class="text-center">Fecha atencion</label>' +
            '<input type="text" class="form-control  text-center col-xl-10" id="fecate" autocomplete="off">' +
            '<label for="resultado" class="text-center">Edad gestacional </label>' +
            '<input id="resultado" type="number" class="form-control  text-center col-xl-10" required  />' +
            '<label for="observa" class="text-center">Observacion</label>' +
            '<textarea  class="form-control   col-xl-10" id="observa" autocomplete="off">' +
            '</textarea>' +
            '  <div class="col-xl-12 text-right">' +
            '         <br>' +
            '       <a href="javascript:" class="btn btn-danger" data-dismiss="modal">' +
            '       <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>' +
            '       <button id="enviar" class="btn btn-success " title="click para agregar usuario' +
            '       " onclick="enviarAtencion(' + idactividad + ')"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar' +
            '        </button>' +
            '</div>';

    }
    if (opc === 2) {

        valhtml = '<input type="text"   id="idgestantemod"  hidden>' +
            '<input type="text"   id="idactividadmod"  hidden>' +
            '<label for="fecate" class="text-center">Fecha atencion</label>' +
            '<input type="text" class="form-control  text-center col-xl-10" id="fecate" autocomplete="off">' +
            '<label for="resultado" class="text-center" hidden>Resultado </label>' +
            '<input id="resultado" type="text" class="form-control  text-center col-xl-10" hidden/>' +
            '<label for="observa" class="text-center">Observacion</label>' +
            '<textarea  class="form-control   col-xl-10" id="observa" autocomplete="off">' +
            '</textarea>' +
            '  <div class="col-xl-12 text-right">' +
            '         <br>' +
            '       <a href="javascript:" class="btn btn-danger" data-dismiss="modal">' +
            '       <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>' +
            '       <button id="enviar" class="btn btn-success " title="click para agregar usuario' +
            '       " onclick="enviarAtencion(' + idactividad + ')"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar' +
            '        </button>' +
            '</div>';

    }
    if (opc === 3) {
        valhtml = '<input type="text"   id="idgestantemod"  hidden>' +
            '            <input type="text"   id="idactividadmod"  hidden>' +
            '            <label for="fecate" class="text-center">Fecha atencion</label>' +
            '            <input type="text" class="form-control  text-center col-xl-10" id="fecate" autocomplete="off">' +
            ' <label for="resultado">Resultado</label>' +
            '                    <select class="form-control  col-xl-10" id="resultado">' +
            '                        <option selected>SELECCIONE</option>' +
            '                        <option >REACTIVO</option>' +
            '                        <option >NO REACTIVO</option>' +
            '                    </select> ' +

            '            <label for="observa" class="text-center">Observacion</label>' +
            '            <textarea  class="form-control   col-xl-10" id="observa" autocomplete="off">' +
            '            </textarea>' +
            '                     <br>' +
            '              <div class="col-xl-12 text-right">' +
            '                   <a href="javascript:" class="btn btn-danger" data-dismiss="modal">' +
            '                   <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>' +
            '                   <button id="enviar" class="btn btn-success " title="click para agregar usuario' +
            '                   " onclick="enviarAtencion(' + idactividad + ')"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar' +
            '                   </button>' +
            '            </div>';


    }
    if (opc === 4) {
        valhtml = '<input type="text"   id="idgestantemod"  hidden>' +
            '            <input type="text"   id="idactividadmod"  hidden>' +
            '            <label for="fecate" class="text-center">Fecha atencion</label>' +
            '            <input type="text" class="form-control  text-center col-xl-10" id="fecate" autocomplete="off">' +
            ' <label for="resultado">Resultado</label>' +
            '                    <select id="resultado" class="form-control" >' +
            '                        <option selected>SELECCIONE</option>' +
            '                        <option >POSITIVO</option>' +
            '                        <option >NEGATIVO</option>' +
            '                    </select> ' +

            '            <label for="observa" class="text-center">Observacion</label>' +
            '            <textarea  class="form-control   col-xl-10" id="observa" autocomplete="off">' +
            '            </textarea>' +
            '                     <br>' +
            '              <div class="col-xl-12 text-right">' +
            '                   <a href="javascript:" class="btn btn-danger" data-dismiss="modal">' +
            '                   <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>' +
            '                   <button id="enviar" class="btn btn-success " title="click para agregar usuario' +
            '                   " onclick="enviarAtencion(' + idactividad + ')"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar' +
            '                   </button>' +
            '            </div>';

    }
    if (opc === 5) {
        valhtml =
            '<input type="text"   id="idgestantemod"  hidden>' +
            '<input type="text"   id="idactividadmod"  hidden>' +
            '<label for="fecate" class="text-center">Fecha atencion</label>' +
            '<input type="text" class="form-control  text-center col-xl-10" id="fecate" autocomplete="off">' +
            '<label for="resultado" class="text-center">resultado </label>' +
            '<input id="resultado" type="text" class="form-control  text-center col-xl-10"   />' +
            '<label for="observa" class="text-center">Observacion</label>' +
            '<textarea  class="form-control   col-xl-10" id="observa" autocomplete="off">' +
            '</textarea>' +
            '  <div class="col-xl-12 text-right">' +
            '         <br>' +
            '       <a href="javascript:" class="btn btn-danger" data-dismiss="modal">' +
            '       <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>' +
            '       <button id="enviar" class="btn btn-success " title="click para agregar usuario' +
            '       " onclick="enviarAtencion(' + idactividad + ')"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar' +
            '        </button>\n' +
            '</div>';

    }
    if (opc === 6) {
        valhtml = '<input type="text"   id="idgestantemod"  hidden>' +
            '<input type="text"   id="idactividadmod"  hidden>' +
            '<label for="fecate" class="text-center">Fecha atencion</label>' +
            '<input type="text" class="form-control  text-center col-xl-10" id="fecate" autocomplete="off">' +
            '<label for="resultado" class="text-center" hidden>Resultado </label>' +
            '<input id="resultado" type="text" class="form-control  text-center col-xl-10" hidden/>' +
            '<label for="observa" class="text-center">Observacion</label>' +
            '<textarea  class="form-control   col-xl-10" id="observa" autocomplete="off">' +
            '</textarea>' +
            '  <div class="col-xl-12 text-right">' +
            '         <br>' +
            '       <a href="javascript:" class="btn btn-danger" data-dismiss="modal">' +
            '       <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>' +
            '       <button id="enviar" class="btn btn-success " title="click para agregar usuario' +
            '       " onclick="enviarAtencion(' + idactividad + ')"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar' +
            '        </button>' +
            '</div>';


    }
    idopc.append(valhtml);
    $('#idgestantemod').val($('#idgestante').val());
    $('#idactividadmod').val(idsubactividad);
    datePickers();
    $('#fecate').datepicker({
        todayHighlight: true,
        autoclose: true
    });
}

function enviarAtencion(actividad) {

    bloquear();
    var fecate = $('#fecate').val();
    var resultado = $('#resultado').val();
    var obs = $('#observa').val();
    var idsubact = $('#idactividadmod').val();
    var idgest = $('#idgestantemod').val();
    fecate = new Date(fecate);
    var datosate = {
        fecate: fecate,
        resultado: resultado,
        obs: obs,
        idsubact: idsubact,
        idgest: idgest,
    };
    datosate = JSON.stringify(datosate);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se registrara una nueva atencion',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                    type: 'GET',
                    url: "gestante/registraratencion/" + datosate,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success:
                        function (data) {
                            if (data['error'] === 0) {

                                desbloquear();
                                operacionExitosa();
                                $('#modal-dialog-atender').modal('hide');
                                if (actividad === 1)
                                    actividadAPN(idgest);
                                if (actividad === 2)
                                    actividadAPR(idgest);
                                if (actividad === 3)
                                    actividadEAB(idgest);
                                if (actividad === 4)
                                    actividadPuerpero(idgest);
                            } else {
                                operacionError(data['error']);
                                bloquear();
                            }

                        }
                    ,
                    beforeSend: function () {

                    }
                }
            )
            ;
        }
    })


}

function actividadAPN(idgestante) {
    var datatable = $('#atpre');
    datatable.DataTable().destroy();
    datatable.DataTable({
            ajax: '/obtenercontrolgestante/' + 1 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(1,' + row.idac + ',1,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'res', name: 'res'},
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );
}

function actividadEAB(idgestante) {
    var datatable1 = $('#sifvih');
    datatable1.DataTable().destroy();
    datatable1.DataTable({
            ajax: '/obtenercontrolgestante/' + 4 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(3,' + row.idac + ',3,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'res', name: 'res'},
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );
    var datatable2 = $('#ohp');
    datatable2.DataTable().destroy();
    datatable2.DataTable({
            ajax: '/obtenercontrolgestante/' + 5 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(4,' + row.idac + ',3,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'res', name: 'res'},
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );

    var datatable3 = $('#hg');
    datatable3.DataTable().destroy();
    datatable3.DataTable({
            ajax: '/obtenercontrolgestante/' + 6 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(5,' + row.idac + ',3,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'res', name: 'res'},
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );

    var datatable4 = $('#eco');
    datatable4.DataTable().destroy();
    datatable4.DataTable({
            ajax: '/obtenercontrolgestante/' + 7 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(1,' + row.idac + ',3,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'res', name: 'res'},
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );
}

function actividadAPR(idgestante) {
    var datatable1 = $('#atepreresuple');
    datatable1.DataTable().destroy();
    datatable1.DataTable({
            ajax: '/obtenercontrolgestante/' + 2 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(2,' + row.idac + ',2,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );

    var datatable2 = $('#ateprerevac');
    datatable2.DataTable().destroy();
    datatable2.DataTable({
            ajax: '/obtenercontrolgestante/' + 3 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(2,' + row.idac + ',2,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );
}

function actividadPuerpero(idgestante) {
    var datatable1 = $('#atepuerpe');
    datatable1.DataTable().destroy();
    datatable1.DataTable({
            ajax: '/obtenercontrolgestante/' + 8 + '/' + idgestante,
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            bAutoWidth: true,
            rowId: 'id',
            dom: 'lBfrtip',
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            buttons: [
                'excel', 'pdf'
            ],
            columns: [
                {data: 'subact', name: 'subact'},
                {
                    data: function (row) {
                        if (row.est === '1') {
                            return ' <tr><span class="text-success">Atendida</span></tr>';
                        }
                        else {
                            if (row.est === '2') {
                                return ' <td><span class="text-danger">No Atendida</span></td>';

                            }
                            else {
                                return '<tr><a href="#" onclick="abrirModal(2,' + row.idac + ',4,event)" style="color: green" title="atender"> <i class="fas fa-lg fa-fw m-r-10 fa-medkit "> </i></a></tr>';
                            }

                        }
                    }
                },
                {data: 'obs', name: 'obs'},
                {data: 'fecate', name: 'fecate'},
                {data: 'feccrea', name: 'feccrea'},
                {data: 'ess', name: 'ess'},
                {data: 'usu', name: 'usu'},
            ]
        }
    );

}


function abrirModal(opc, idsubactividad, idactividad, e) {
    e.preventDefault();
    $('#modal-dialog-atender').modal('show');
    opcmodal(opc, idsubactividad, idactividad);

}

function cambiarBotonTami(opc, e) {
    e.preventDefault();
    var fecami = $('#fectami');
    var result = $('#restami');
    var botenv = $('#botenviartam');
    var valhtml = '';
    botenv.empty();
    if (opc === 1) {
        fecami.prop("disabled", false);
        result.prop("disabled", false);
        valhtml = '<a  href="#" onclick="enviarTamizaje(event)"  title="Guardar datos tamizaje VBG" id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-save text-success"> </i></a>';

    }
    else {
        valhtml =
            '<a  href="#" onclick="cambiarBotonTami(1,event)" style="color: green" title="Editar tamizaje VBG" id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>';
        fecami.prop("disabled", true);
        result.prop("disabled", true);

    }
    botenv.append(valhtml);
}

function enviarTamizaje(e) {
    e.preventDefault();
    bloquear();
    var idgest = $('#idgestante').val();
    var fectami = $('#fectami').val();
    var restami = $('#restami').val();
    fectami = new Date(fectami);
    var datosate = {
        fectami: fectami,
        idgest: idgest,
        result: restami,
    };
    datosate = JSON.stringify(datosate);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se guardara los datos del tamizaje VGB',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: "gestante/modificarbvg/" + datosate,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            desbloquear();
                            operacionExitosa();
                            cambiarBotonTami(0, event);
                        } else {

                        }

                    }
                ,
                beforeSend: function () {

                }
            })
        }
    })
}

function enviarGruposan(e) {
    e.preventDefault();
    bloquear();
    var idgest = $('#idgestante').val();
    var grusan = $('#grusan').val();
    var factor = $('#factor').val();
    fectami = new Date(fectami);
    var datosate = {
        grusan: grusan,
        idgest: idgest,
        factor: factor,
    };
    datosate = JSON.stringify(datosate);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se guardara los datos del tamizaje VGB',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: "gestante/modificargs/" + datosate,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            desbloquear();
                            operacionExitosa();
                            cambiarBotonGrupoSanguineo(data['grusan'], data['factor'], 0, event)
                        } else {

                        }

                    }
                ,
                beforeSend: function () {

                }
            })
        }
    })
}


function cambiarBotonGrupoSanguineo(grupsan, factor, opc, e) {

    e.preventDefault();
    var valhtml;
    var idopc = $('#grupsan');
    idopc.empty();
    if (opc === 1) {
        var grupsanarr = ['A', 'AB', 'B', 'O'];
        var factorharr = ['(+)', '(-)'];
        var cabhtmlgs =
            '                        <div class="col-xl-2 ">' +
            '                            <label for="grusan"> GRUPO SANGUINEO</label>' +
            '                            <select id="grusan" class="form-control">';
        var opcgs = '';
        for (var i = 0; i < grupsanarr.length; i++) {
            if (grupsanarr[i] === grupsan)
                opcgs += '<option selected>' + grupsanarr[i] + '</option>';
            else
                opcgs += '<option >' + grupsanarr[i] + '</option>';
        }
        cabhtmlgs = cabhtmlgs + opcgs;

        var finahltm = '                            </select>' +
            '                            <div  id="valtipseg"></div>' +
            '                        </div>' +
            '                        <div class="col-xl-2 ">' +
            '                            <label for="factor"> FACTOR RH</label>' +
            '                            <select id="factor" class="form-control">';
        finahltm = cabhtmlgs + finahltm;
        var opc2 = '';
        for (var i = 0; i < factorharr.length; i++) {
            if (factorharr[i] === factor)
                opc2 += '<option selected>' + factorharr[i] + '</option>';
            else
                opc2 += '<option >' + factorharr[i] + '</option>';
        }
        finahltm = finahltm + opc2;
        var finalsg = '                            </select>' +
            '                            <div  id="valtipseg"></div>' +
            '                        </div>' +
            '                           <a  href="#" onclick="enviarGruposan(event)"  title="Guardar datos  grupo sanguineo" id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-save text-success"> </i></a>';
        valhtml = finahltm + finalsg;
    }
    else {
        valhtml =
            '                            <div class="col-xl-2 ">' +
            '                                <label for="grusan">GRUPO SANGUINEO </label>' +
            '                                <input id="grusan" type="text"  class="form-control" value="' + grupsan + '" disabled/>' +
            '                            </div>' +
            '                            <div class="col-xl-2 ">' +
            '                                <label for="factor">FACTOR RH</label>' +
            '                                <input id="factor" type="text"  class="form-control" value="' + factor + '" disabled/>' +
            '                            </div>' +
            '                            <div class="col-xl-1 row" id="botenviar">' +
            '                                <label for="cambiardat"></label>' +
            '                                <a  href="#" onclick="cambiarBotonGrupoSanguineo(0,0,1,event)" style="color: green" title="Editar grupo sanguineo" id="cambiardat"> <i class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>' +
            '                            </div>';
    }
    idopc.append(valhtml);
    datePickers();

}


$("#switcher_checkbox_1").on('change', function () {
    if ($(this).is(':checked')) {
        $('#fecatef').prop('hidden', true);
        $('#tipcnvf').prop('hidden', true);
        $('#fecnvf').prop('hidden', true);
        $('#fecabof').prop('hidden', false);
        $('#atepuerpe').prop('hidden', true);
    }
    else {
        $('#fecatef').prop('hidden', false);
        $('#tipcnvf').prop('hidden', false);
        $('#fecnvf').prop('hidden', false);
        $('#fecabof').prop('hidden', true);
        $('#atepuerpe').prop('hidden', false);

    }
});

function enviarPuerperio(e) {
    e.preventDefault();
    bloquear();
    var idgest = $('#idgestante').val();
    var vipa = $('#vipa').val();
    var lupa = $('#lupa').val();
    var fecate = $('#fecate').val();
    var tipcnv = $('#tipcnv').val();
    var fecnv = $('#fecnv').val();
    var fecabo = $('#fecabo').val();
    fecate = new Date(fecate);
    fecnv = new Date(fecnv);
    fecabo = new Date(fecabo);
    var datosate = {
        idgest: idgest,
        vipa: vipa,
        lupa: lupa,
        fecate: fecate,
        tipcnv: tipcnv,
        fecnv: fecnv,
        fecabo: fecabo,
    };
    datosate = JSON.stringify(datosate);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se guardara los datos del parto o aborto',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: "gestante/registrarparto/" + datosate,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            operacionExitosa();
                            desbloquear();
                            redirect('/gestante/control/' + idgest);
                        } else {

                        }

                    }
                ,
                beforeSend: function () {

                }
            })
        }
    })
}


function cambiarBotonPuerpero(opc, e) {
    e.preventDefault();
    var hemopu = $('#hemopu');
    var plapu = $('#plapu');
    var botenv = $('#botenviarpuer');
    var valhtml = '';
    botenv.empty();
    if (opc === 1) {
        hemopu.prop("disabled", false);
        plapu.prop("disabled", false);
        valhtml = '<a  href="#" onclick="enviarDatosPuerpero(event)"  title="Guardar datos puerperio " id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-save text-success"> </i></a>';
        hemopu.focus();
    }
    else {
        valhtml =
            '<a  href="#" onclick="cambiarBotonPuerpero(1,event)" style="color: green" title="Editar datos puerperio " id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>';
        hemopu.prop("disabled", true);
        plapu.prop("disabled", true);
        hemopu.focus();
    }
    botenv.append(valhtml);
}

function enviarDatosPuerpero(e) {
    e.preventDefault();
    bloquear();

    var idgest = $('#idgestante').val();
    var hemopu = $('#hemopu').val();
    var plapu = $('#plapu').val();
    var datosate = {
        idgest: idgest,
        hemopu: hemopu,
        plapu: plapu,
    };
    datosate = JSON.stringify(datosate);
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se guardara los datos del puerperio',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: "gestante/cambiardatospuerperio/" + datosate,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success:
                    function (data) {
                        if (data['error'] === 0) {
                            desbloquear();
                            operacionExitosa();
                            cambiarBotonPuerpero(0, event);
                        } else {

                        }

                    }
                ,
                beforeSend: function () {

                }
            })
        }
    })
}

function cambiarBotonObs(opc, e) {
    e.preventDefault();
    var noco = $('#noco');
    var teco = $('#teco');
    var observaciones = $('#observaciones');

    var botenv = $('#botenviarobs');
    var valhtml = '';
    botenv.empty();
    if (opc === 1) {
        noco.prop("disabled", false);
        teco.prop("disabled", false);
        observaciones.prop("disabled", false);
        valhtml = '<label for="cambiardat">Guardar</label>' +
            '<a  href="#" onclick="enviarObs(event)"  title="Guardar datos puerperio " id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-save text-success"> </i></a>';
        hemopu.focus();
    }
    else {
        valhtml = '<label for="cambiardat">Editar</label>' +
            '<a  href="#" onclick="cambiarBotonObs(1,event)" style="color: green" title="Editar datos puerperio " id="cambiardat">' +
            '<i class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>';
        noco.prop("disabled", true);
        teco.prop("disabled", true);
        observaciones.prop("disabled", true);
        hemopu.focus();
    }
    botenv.append(valhtml);
}

function enviarObs(e) {
    e.preventDefault();
    bloquear();
    var idgest = $('#idgestante').val();
    var noco = $('#noco').val();
    var teco = $('#teco').val();
    var observaciones = $('#observaciones').val();
    $.ajax({
        /* the route pointing to the post function */
        url: '/gestante/cambiardatosobservacion/',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {
            _token: CSRF_TOKEN,
            idgest: idgest,
            noco: noco,
            teco: teco,
            observaciones: observaciones
        },
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {

            if (data['error'] === 0) {
                desbloquear();
                operacionExitosa();
                cambiarBotonObs(0, event);

            } else {
                bloquear();
            }
        }, beforeSend: function () {
            bloquear();
        }
    });


}
