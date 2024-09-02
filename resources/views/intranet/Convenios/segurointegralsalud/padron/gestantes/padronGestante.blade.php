
<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>

<script src="../js/typeahead/bootstrap3-typeahead.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<script src="../assets/plugins/DataTables/media/js/dataTables.fixedHeader.min.js"></script>

<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- ================== END BASE CSS STYLE ================== -->
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>

<!-- ================== END PAGE LEVEL STYLE ================== -->
<div id="response">
    <h1 class="page-header">Padron Gestantes
    </h1>
    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn ">
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>

            </div>
            <h4 class="panel-title"> Gestantes</h4>
        </div>

        <div class="panel-body">
            <div class=".row.row-space-2 .p-2">
                <a href="/gestante/agregar" data-toggle="ajax" class="btn btn-sm btn-primary">
                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>
                    Agregar Gestante
                </a>
            </div>
            <hr>

            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <legend class="m-b-15">BUSQUEDA</legend>

                <div class="col-xl-3 ">
                    <label for="nrohistoria">NroHistoria</label>
                    <input id="nrohistoria" type="text" class="form-control " autocomplete="off"/>
                </div>
                <div class="col-xl-3 ">
                    <label for="dni">Dni</label>
                    <input id="dni" type="text" class="form-control " autocomplete="off"/>
                </div>
            </div>
            <hr>

            <div class="col-xl-12 text-center">
                <a class="btn btn-success   btn-sm" title="Click para buscar"
                   id="recargarpant" onclick="buscar()">
                    <i class="fa fa-search"> Buscar
                    </i></a>
                <a class="btn btn-success   btn-sm" title="Click para limpiar"
                   id="recargarpant" onclick="limpiar()">
                    <i class="fa fa-recycle"> Limpiar
                    </i></a>
            </div>

            <hr>
            <div id="data-table-fixed-header_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="padron"
                               class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                               role="grid"
                               aria-describedby="data-table-fixed-header_info" width="100%">
                            <tbody>
                            </tbody>
                            <thead>
                            <tr role="row">

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end panel -->
<script>
    $.when(
        $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
    ).done(function () {
        $.getScript('../js/intranet/gestantes/padron.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
    });
    $(function () {
        $('#padron').DataTable({
                ajax: '/obtenergestante/0/0',
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

                columnDefs: [
                    {
                        "title": "N° HISTORIA",
                        "targets": 0,
                        "className": "text-center",

                    },
                    {
                        "title": "N° DOC",
                        "targets": 1,
                        "className": "text-center",

                    },
                    {
                        "title": "NOMBRES",
                        "targets": 2,
                        "className": "text-center",


                    },
                    {
                        "title": "FECHNAC",
                        "targets": 3,
                        "className": "text-center",

                    },
                    {
                        "title": "FECHPROBPARTO",
                        "targets": 4,
                        "className": "text-center",

                    },
                    {
                        "title": "FECHPARTO",
                        "targets": 5,
                        "className": "text-center",

                    },
                    {
                        "title": "ESTADO",
                        "targets": 6,
                        "className": "text-center",

                    },

                    {
                        "title": "PROVINCIA",
                        "targets": 7,
                        "className": "text-center",

                    },
                    {
                        "title": "DISTRITO",
                        "targets": 8,
                        "className": "text-center",

                    },
                    {
                        "title": "RED",
                        "targets": 9,
                        "className": "text-center",

                    },
                    {
                        "title": "MICRORED",
                        "targets": 10,
                        "className": "text-center",

                    },
                    {
                        "title": "EJECUTORA",
                        "targets": 11,
                        "className": "text-center",

                    },
                    {
                        "title": "IPRESS",
                        "targets": 12,
                        "className": "text-center",

                    },
                    {
                        "title": "OPCIONES",
                        "targets": 13,
                        "className": "text-center",

                    },

                ],
                processing: true,
                serverSide: true,
                select: true,
                responsive: true,
                bAutoWidth: false,
                rowId: 'id',
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                columns: [
                    {data: 'hisclini', name: 'hisclini'},
                    {data: 'nrdoc', name: 'nrdoc'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'fecnac', name: 'fecnac'},
                    {data: 'fecprobparto', name: 'fecprobparto'},
                    {data: 'fecparto', name: 'fecparto'},
                    {
                        data: function (row) {
                            if (parseInt(row.partu) === 1) {
                                return '<tr >\n' +
                                    '<span class="text-green">PUERPERA</span>' +
                                    '</tr>';
                            }
                            else {
                                return '<tr>' +
                                    '<span class="text-orange">GESTANTE</span>' +
                                    '</tr>';
                            }
                        }
                    },
                    {data: 'provdesc', name: 'provdesc'},
                    {data: 'dist', name: 'dist'},
                    {data: 'red', name: 'red'},
                    {data: 'mrred', name: 'mrred'},
                    {data: 'ejec', name: 'ejec'},
                    {data: 'ess', name: 'ess'},
                    {
                        data: function (row) {
                            if (parseInt(row.gestado) === 1 && parseInt(row.pestado) === 1) {
                                return '<tr >\n' +
                                    '<a href="gestante/control/' + row.id + '"  TITLE="Realizar control" data-toggle="ajax">\n' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard text-orange"> </i></a>\n' +
                                    '<a href="/editarGestante/' + row.id + '"  TITLE="Editar datos" data-toggle="ajax">\n' +
                                    '<i class="text-success far fa-lg fa-fw m-r-10 fa-edit"> </i></a>\n' +
                                    '</tr>';
                            } else {
                                return '<tr >\n' +
                                    '<a href="#" style="color: green" TITLE="Activar gestante" onclick="eliminar(' + row.idGestante + ')">\n' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                                    '</tr>';
                            }
                        }
                    }

                ]
            }
        );
    });
</script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<!-- ================== END PAGE LEVEL JS ================== -->





