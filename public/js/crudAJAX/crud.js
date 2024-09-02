//store and edit
$("#idForm").submit(function (e){
    e.preventDefault();
    var url = "create-cliente";//route
    $.ajax({
        type: "POST",//metodo envio
        url: url,
        data: $("#idForm").serialize(),//enviar el formulario completo
        success: function (data) {
            //redireccionar a pagina
        }
    });
});

//autocomplete
$('#').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'data',
        displayKey: 'name',
        source: function (query, process) {
            $.ajax({
                url: '',//url
                type: 'GET',
                data: 'query=' + query,//data enviar
                dataType: 'JSON',
                async: 'false',
                success: function (data) {
                    var bondObjs = {};
                    var bondNames = [];
                    $.each(data, function (i, item) {
                        bondNames.push({
                            id: item.id,
                            name: item.name,
                            codigo: item.codigo,
                            descripcion: item.descripcion
                        });
                        bondObjs[item.id] = item.id;
                        bondObjs[item.name] = item.name;
                        bondObjs[item.codigo] = item.codigo;
                        bondObjs[item.descripcion] = item.descripcion;
                    });
                    process(bondNames);//procesar datos en el input(mostrar)
                }
            });
        }
    }).on('typeahead:selected', function (even, datum) {
    $("#").val(bondObjs[datum.id]);//insertar id en un input hidden
    $("#").focus();
});

//datatable

$(function () {
    $('#no-more-tables').DataTable({//id de la tabla
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" //datatable en español
        },
        processing: true,
        serverSide: true,
        select: true,
        rowId: 'id',// id por fila
        ajax: '{!! route() !!}',//ruta
        columns: [

            {data: 'sdescripcion', name: 'sdescripcion', class: "accion"},//data a mostrar
            {
                class: "alinear_centro",
                //align: "center",
                orderable: false,
                data: function (row) {//mostrar estado de la fila
                    if (row.estado.toUpperCase() === 'ANULADO') {
                        return '<label class="text-danger">ANULADO</label>';
                    }
                    else if (row.estado.toUpperCase() === 'ACTIVO') {
                        return '<label class="text-success">ACTIVO</label>';
                    }
                }
            },
            {
                class: "alinear_centro",
                orderable: false,
                data: function (row) {//acionesa tomar de acuerdo a la fila

                    if (row.estado.toUpperCase() === 'ACTIVO') {
                        return '<div class="btn-group"><button type="button" class="btn btn-xs btn-default accion dropdown-toggle" data-toggle="dropdown"><span class="flaticon-down-arrow"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu accion" role="menu"><li><a onclick="navega(' + "'" + '{{$variable}}/' + row.id + '/edit' + "'" + ');">Editar</a></li><li><a onclick="navega(' + "'" + '{{$variable}}/' + row.id + '/confirmar_anular' + "'" + ');">Anular</a></li><li><a onclick="navega(' + "'" + '{{$variable}}/' + row.id + '' + "'" + ');">Eliminar</a></li></ul></div>';
                    }
                    else {
                        return '<div class="btn-group"><button type="button" class="btn btn-xs btn-default accion dropdown-toggle" data-toggle="dropdown"><span class="flaticon-down-arrow"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu accion" role="menu"><li><a onclick="navega(' + "'" + '{{$variable}}/' + row.id + '/edit' + "'" + ');">Editar</a></li><li><a onclick="navega(' + "'" + '{{$variable}}/' + row.id + '/confirmar_activar' + "'" + ');">Activar</a></li><li><a onclick="navega(' + "'" + '{{$variable}}/' + row.id + '' + "'" + ');">Eliminar</a></li></ul></div>';
                    }
                }
            }
        ]
    });

    $('#no-more-tables tbody').on('dblclick', 'tr', function () {//al hacer doble click en una fila
        var id = this.id;
        navega('{{$variable}}/' + id + '/ver');//enviar al ver de tal dato
    });
});