<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>
<div id="response">
    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse" id="imprimir">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>

            </div>
            <h4 class="panel-title">HISTORIAL TRABAJADOR</h4>
        </div>

        <div class="panel-body">
            <input id="idpaciente" value="{{$idpaciente}}" hidden>
            <legend class="m-b-15">DATOS TRABAJADOR
            </legend>
            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <div class="col-xl-2 ">
                    <label for="dni">N° DOC</label>
                    <input id="dni" type="number" class="form-control  " autocomplete="off" disabled/>
                </div>
                <div class="col-xl-4 ">
                    <label for="nombres">NOMBRES</label>
                    <input id="nombres" type="text" class="form-control" autocomplete="off" disabled/>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecnac">FECNAC</label>
                    <input type="text" class="form-control" id="fecnac" autocomplete="off" disabled/>
                </div>
                <div class="col-xl-3 ">
                    <label for="telefo">TELEFONO</label>
                    <input id="telefo" type="number" class="form-control"
                           autocomplete="off" disabled/>
                </div>
                <hr>
                <div class="col-xl-3 ">
                    <label for="lugna">LUGAR DE NACIMIENTO</label>
                    <input id="lugna" type="text" class="form-control" disabled/>
                </div>
                <div class="col-xl-3 ">
                    <label for="dir">DIRECCION</label>
                    <input id="dir" type="text" class="form-control " disabled/>
                </div>
                <div class="col-xl-3">
                    <label for="ref">REFERENCIA DE UBICACION</label>
                    <TEXTAREA id="ref" type="text" class="form-control" disabled/>
                </div>
                <div class="col-xl-3 ">
                    <label for="lugcont">LUGAR DE TRABAJO</label>
                    <input id="lugcont" type="text" class="form-control " disabled/>
                </div>
                <div class="col-xl-3 " hidden>
                    <label for="dircon">DIRECCION</label>
                    <input id="dircon" type="text" class="form-control " disabled/>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecdiag">FEC DIAGNOSTICO</label>
                    <input type="text" class="form-control" id="fecdiag" autocomplete="off" disabled>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecsinini">FEC SINTOMAS INICIALES</label>
                    <input type="text" class="form-control" id="fecsinini" autocomplete="off" disabled>
                </div>
                <div class="col-xl-3 ">
                    <label for="estprueb">ESTADO PRUEBA</label>
                    <select class="form-control" id="estprueb" disabled>
                        <option value="0" selected>Negativo</option>
                        <option value="1">Sospechoso</option>
                        <option value="3" selected>Positivo Prueba rapida</option>
                        <option value="2">Positivo Prueba molecular</option>
                    </select>
                    <div class="hide " id="valestprueb"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="morbilidad">LISTA DE MORBILIDAD</label>
                    <div class="input-group">
                        <ol id="lista">
                        </ol>

                    </div>
                </div>
            </div>
            <hr>
            <legend class="m-b-15">INGRESO TRABAJADOR
            </legend>

            <div id="data-table-fixed-header_wrapper"
                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="tabla_atencion"
                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                               role="grid"
                               aria-describedby="data-table-fixed-header_info" width="100%">
                            <tbody>

                            </tbody>
                            <thead>
                            <tr role="row">
                                <th>FECHA</th>
                                <th>FIEBRE</th>
                                <th>TOS</th>
                                <th>DOLORDEGARGANTA</th>
                                <th>CONGESTIONNASAL</th>
                                <th>DIFICULTADRESPIRATORIA</th>
                                <th>OTRO</th>
                                <th>OBSERVACION</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <legend class="m-b-15">ENTREGA DE EQUIPO DE PROTECCION PERSONAL
            </legend>

            <div id="data-table-fixed-header_wrapper"
                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="tabla_epp"
                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                               role="grid"
                               aria-describedby="data-table-fixed-header_info" width="100%">
                            <tbody>

                            </tbody>
                            <thead>
                            <tr role="row">
                                <th>FECHA ENTREGA PLANIFICADA</th>
                                <th>ESTADO</th>
                                <th>FECHA RECIBIDA</th>
                                <th>DESCRIPCION EPP</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <legend class="m-b-15">CONTACTOS
            </legend>
            <div id="data-table-fixed-header_wrapper"
                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="tabla_contactos"
                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                               role="grid"
                               aria-describedby="data-table-fixed-header_info" width="100%">
                            <tbody>

                            </tbody>
                            <thead>
                            <tr role="row">
                                <th>PSEUDONIMO CONTACTO</th>
                                <th>NOMBRE CONTACTO</th>
                                <th>NRO DOC</th>
                                <th>TELEFONO</th>
                                <th>ACTIVIDAD</th>
                                <th>FEC CONTACTO</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 text-center">
                <hr>
                <button class="btn btn-success" title="click para retrocedrer
                    " href="/covid/reporte" data-toggle="ajax"><i
                        class="fas fa-lg fa-fw m-r-10  fa-backward"></i>atras
                </button>
                <hr>
            </div>
        </div>
    </div>

</div>
<script>
    $.when(
        $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
    ).done(function () {
        $.getScript('../js/intranet/util.js'),
            $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js'),
            $.getScript('../js/intranet/covid/historiaclinica.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
    });


    $(function () {
        var idpa = $('#idpaciente').val();
        $('#tabla_epp').DataTable({
                ajax: '/covid/obtenerentregaepp/' + idpa,
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
                processing: true,
                serverSide: true,
                select: true,
                responsive: true,
                bAutoWidth: true,
                rowId: 'id',
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'pdf'
                ],

                columnDefs: [
                    {"targets": 0, "className": "text-center",},
                    {"targets": 1, "className": "text-center",},
                    {"targets": 2, "className": "text-center",},
                    {"targets": 3, "className": "text-center",},


                ],
                columns: [
                    {data: 'feent', name: 'feent'},
                    {
                        data: function (row) {
                            if (row.fecdar) {
                                return '<small class="text-primary">ENTREGADO</small>';
                            } else {
                                return '<small class="text-danger">NO ENTREGADO</small>';

                            }
                        }
                    },
                    {data: 'fecdar', name: 'fecdar'},
                    {data: 'desc', name: 'desc'},

                ]
            }
        );
    });

    $(function () {
        var idpa = $('#idpaciente').val();
        $('#tabla_atencion').DataTable({
                ajax: '/covid/veratencionespaciente/' + idpa,
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
                processing: true,
                serverSide: true,
                select: true,
                responsive: true,
                bAutoWidth: true,
                rowId: 'id',
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'pdf'
                ],

                columnDefs: [
                    {"targets": 0, "className": "text-center",},
                    {"targets": 1, "className": "text-center",},
                    {"targets": 2, "className": "text-center",},
                    {"targets": 3, "className": "text-center",},
                    {"targets": 4, "className": "text-center",},
                    {"targets": 5, "className": "text-center",},
                    {"targets": 6, "className": "text-center",},
                    {"targets": 7, "className": "text-center",},

                ],
                columns: [
                    {data: 'FEC', name: 'FEC'},
                    {
                        data: function (row) {
                            if (row.FIEBRE === '1') {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-red"> </i>';
                            } else {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-green"> </i>';
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (row.TOS === '1') {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-red"> </i>';
                            } else {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-green"> </i>';
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (row.DOLORDEGARGANTA === '1') {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-red"> </i>';
                            } else {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-green"> </i>';
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (row.CONGESTIONNASAL === '1') {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-red"> </i>';
                            } else {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-green"> </i>';
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (row.DIFICULTADRESPIRATORIA === '1') {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-red"> </i>';
                            } else {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-green"> </i>';
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (row.OTRO === '1') {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-check-circle text-red"> </i>';
                            } else {
                                return '<i class="fas fa-lg fa-fw m-r-10 fa-times-circle text-green"> </i>';
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (row.OB === '0') {
                                return '<small>SIN OBSERVACIONES</small>';
                            } else {
                                return '<small>'+ row.OB+'</small>';

                            }
                        }
                    },

                ]
            }
        );
    });
    $(function () {
        var idpa = $('#idpaciente').val();
        $('#tabla_contactos').DataTable({

                ajax: '/covid/contactosidnetificados/' + idpa,
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
                processing: true,
                serverSide: true,
                select: true,
                responsive: true,
                bAutoWidth: true,
                rowId: 'id',
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                columnDefs: [
                    {"targets": 2, "className": "text-center",},
                    {"targets": 3, "className": "text-center",},
                    {"targets": 5, "className": "text-center",},
                    {"targets": 6, "className": "text-center",},

                ],
                columns: [

                    {data: 'descripcion', name: 'descripcion'},
                    {data: 'nombres', name: 'nombres'},
                    {data: 'numeroDoc', name: 'numeroDoc'},
                    {data: 'telefono', name: 'telefono'},
                    {data: 'atcdesc', name: 'atcdesc'},
                    {data: 'feccontact', name: 'feccontact'},
                    {
                        data: function (row) {
                            return '<a href="/covid/reportecovid/' + row.idPacienteCovid2 + '" style="color: mediumorchid" TITLE="Ver movimientos" data-toggle="ajax">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-map-marker-alt"> </i></a>' +
                                '</tr>';
                        }
                    }
                ]
            }
        );
    });
</script>




















