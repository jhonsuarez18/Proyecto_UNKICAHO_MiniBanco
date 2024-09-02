function buscar() {
    var pad = $('#nrohistoria').val();
    var dni = $('#dni').val();
    pad = pad ? pad : 0;
    dni = dni ? dni : 0;
    var datatable = $('#padron');
    datatable.DataTable().destroy();
    datatable.DataTable({
            ajax: '/obtenergestante/' + pad + '/' + dni,
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
                        if (row.partu === '1') {
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
                        if (row.gestado === '1' && row.pestado === '1') {
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
}


function limpiar() {
    $('#nrohistoria').val('');
    $('#dni').val('');
    buscar();
}

