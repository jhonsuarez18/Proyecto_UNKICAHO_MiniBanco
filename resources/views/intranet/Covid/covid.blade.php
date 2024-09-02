<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->




<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>

<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- ================== END PAGE LEVEL STYLE ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<div id="response">
    <!-- begin row -->
    <div class="row">
        <!-- begin col-10 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">TRABAJADORES</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i
                                class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->

                <!-- begin panel-body -->
                <div class="panel-body">
                    <!--boton agregar -->
                    <div class="col-sm-12">
                        <a href="covid/veragregarpacientecovid/0/0" class="btn btn-blue btn-sm"
                           title="click para agregar un nuevo usuario" data-toggle="ajax">
                            <i class="fa fa-plus-circle"></i> Agregar trabajador
                        </a>
                    </div>
                    <br>
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_usuario"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <tbody>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    </tbody>
                                    <thead>
                                    <tr role="row">

                                        <th>
                                            NOMBRE
                                        </th>
                                        <th>
                                            DNI
                                        </th>
                                        <th>
                                            LUGAR NACIMIENTO
                                        </th>
                                        <th>
                                            DIRECCION
                                        </th>
                                        <th>
                                            TELEFONO
                                        </th>
                                        <th>
                                           LUGAR DE TRABAJO
                                        </th>
                                        <th>
                                            FECHA EXAMEN
                                        </th>
                                        <th>
                                            ESTADO
                                        </th>
                                        <th>
                                            OPCIONES
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>

                    </div>
                    <div class="  col-sm-12 col-xs-12 col-md-12">
                        <dl class=" row dl-horizontal">
                            <div class="  col-sm-2 col-xs-2 col-md-2">
                                <dt class="text-inverse">Leyenda para estado:</dt>
                            </div>
                            <div class="  col-sm-3 col-xs-3 col-md-3">
                                <dd><i style="color: red;" class="fas fa-lg fa-fw m-r-10 fa-circle"> </i>Positivo
                                    - prueba Molecular
                                </dd>
                                <dd><i style="color: orange;" class="fas fa-lg fa-fw m-r-10 fa-circle"> </i>Positivo
                                    - Prueba Rapida
                                </dd>
                                <dd><i style="color: yellow;" class="fas fa-lg fa-fw m-r-10 fa-circle"> </i>
                                    Sospechoso
                                </dd>
                                <dd><i style="color: green;" class="fas fa-lg fa-fw m-r-10 fa-circle"> </i>Negativo
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <!-- fin boton agregar -->
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->
</div>

<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Estado de prueba</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input id="idpacientemodal" hidden>
            <div class="modal-body">
                <select class="form-control" id="estprueb">
                    <option value="0" selected>Negativo
                    </option>
                    <option value="1">
                        Sospechoso
                    </option>
                    <option value="2"> Positivo
                        - Prueba Rapida
                    </option>
                    <option value="3">Positivo
                        - prueba Molecular
                    </option>

                </select>
                <div class="hide " id="valestprueb"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal" id="cemod">Cancelar</a>
                <button id="enviar" class="btn btn-success " title="click para agregar una visita"
                        onclick="cambiarEstado()"><i
                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- begin vertical-box -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>

    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../js/intranet/util.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

    function abrilModal(id) {
        window.event.preventDefault();
        $('#modal-dialog').modal('show');
        $('#idpacientemodal').val(id)
    }

    function cambiarEstado() {
        window.event.preventDefault();
        var idp = $('#idpacientemodal').val()
        var estp = $('#estprueb').val()
        var url = "/covid/cambiarestado/" + idp + "/" + estp;
        var arreglo;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        $('#modal-dialog').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            type: 'success',
                            title: 'Se cambio el estado correctamente',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        redirect('/covid/reporte');
                    } else {

                    }
                }

            });
    }

    $(function () {

        $('#tabla_usuario').DataTable({
                ajax: '/covid/reportepacientes',
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                processing: true,
                  serverSide: true,
                select: true,
                destroy: true,
                responsive: true,
                bAutoWidth: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                columnDefs: [
                    {"targets": 0, "width": "30%"},
                    {"targets": 1, "className": "text-center", "width": "4%"},
                    {"targets": 2, "width": "25%"},
                    {"targets": 4, "className": "text-center",},
                    {"targets": 5, "width": "25%",},
                    {"targets": 6, "className": "text-center",},
                    {"targets": 7, "className": "text-center", "width": "0%"},
                    {"targets": 8, "className": "text-center", "width": "10%"},
                ],
                columns: [

                    {data: 'nomb', name: 'nomb'},
                    {data: 'numeroDoc', name: 'numeroDoc'},
                    {data: 'dirrec', name: 'dirrec'},
                    {data: 'direccion', name: 'direccion'},
                    {data: 'telefono', name: 'telefono'},
                    {data: 'dircont', name: 'dircont'},
                    {data: 'fecExamen', name: 'fecExamen'},

                    {
                        data: function (row) {
                            var est=parseInt(row.estadoPrueba);
                            if (est === 0) {
                                return '<tr><a  href="#" onclick="abrilModal(' + row.idPacienteCovid + ')"  title="Modificar estado" >' +
                                    '<i style="color: green;" class="fas fa-lg fa-fw m-r-10 fa-circle" /></a></tr>';
                            } else {
                                if (est === '1') {
                                    return '<tr><a  href="#" onclick="abrilModal(' + row.idPacienteCovid + ')"  title="Modificar estado" >' +
                                        '<i style="color: yellow;" class="fas fa-lg fa-fw m-r-10 fa-circle" /></a></tr>';
                                } else {
                                    if (est === '2') {
                                        return '<tr><a  href="#" onclick="abrilModal(' + row.idPacienteCovid + ')"  title="Modificar estado" >' +
                                            '<i style="color: orange;" class="fas fa-lg fa-fw m-r-10 fa-circle"  /></a> </tr>';
                                    } else {
                                        return '<tr><a  href="#" onclick="abrilModal(' + row.idPacienteCovid + ')"  title="Modificar estado" >' +
                                            '<i style="color: red;" class="fas fa-lg fa-fw m-r-10 fa-circle"  /></a> </tr>';
                                    }
                                }
                            }
                        }
                    },
                    {
                        data: function (row) {
                            if (parseInt(row.estado) === 1) {
                                return '<tr><a href="/covid/reportecovid/' + row.idPacienteCovid + '" style="color: mediumorchid" TITLE="Ver movimientos" data-toggle="ajax">' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-map-marker-alt"> </i></a>' +
                                    '<a  href="/covid/verhistorialclinico/' + row.idPacienteCovid + '"   title="Ver historia clinica"  style="color: #00CF00" data-toggle="ajax">' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard"> </i></a>' +
                                    '<a href="/covid/vereditarpaciente/' + row.idPacienteCovid + '" style="color: green" TITLE="Editar datos paciente" data-toggle="ajax">' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-edit"> </i></a>' +
                                    '</tr>';
                            } else {
                                return '<tr><a href="/covid/reportecovid/' + row.idPacienteCovid + '" style="color: mediumorchid" TITLE="Ver movimientos" data-toggle="ajax">' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-map-marker-alt"> </i></a>' +
                                    '<a  href="/covid/verhistorialclinico/' + row.idPacienteCovid + '"   title="Ver historia clinica"  style="color: #00CF00" data-toggle="ajax">' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard"> </i></a>' +
                                   '<a href="/covid/vereditarpaciente/' + row.idPacienteCovid + '" style="color: green" TITLE="Editar datos paciente" data-toggle="ajax">' +
                                    '<i class="fas fa-lg fa-fw m-r-10 fa-edit"> </i></a>' +

                                    '</tr>';
                                ;
                            }
                        }
                    }

                ]
            }
        );
    });

</script>




