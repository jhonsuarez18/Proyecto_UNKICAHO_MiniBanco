<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>
<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<script src="../js/intranet/datos/editarUsuario.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- ================== END BASE CSS STYLE ================== -->
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>

<div id="response">
    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>

            </div>
            <h4 class="panel-title">Reportar Casos Covid-19</h4>
        </div>

        <div class="panel-body">
            <input id="idpaciente" value="{{$idpaciente}}" hidden>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                        <span class="d-sm-none">Tab 1</span>
                        <span class="d-sm-block d-none">Datos del paciente</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                        <span class="d-sm-none">Tab 2</span>
                        <span class="d-sm-block d-none">Lugares visitados</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#default-tab-3" data-toggle="tab" class="nav-link">
                        <span class="d-sm-none">Tab 3</span>
                        <span class="d-sm-block d-none">Contactos identificados</span>
                    </a>
                </li>
            </ul>
            <!-- end nav-tabs -->
            <!-- begin tab-content -->
            <div class="tab-content">
                <!-- begin tab-pane -->
                <div class="tab-pane fade active show" id="default-tab-1">
                    <legend class="m-b-15">DATOS PACIENTE
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
                            <label for="lugcont">LUGAR CONTAGIO</label>
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
                </div>
                <!-- end tab-pane -->
                <!-- begin tab-pane -->
                <div class="tab-pane fade" id="default-tab-2">
                    <div class="col-xl-12 text-center">
                        <button class="btn btn-primary" title="Clic para agregar movimiento" id="addmovi"><i
                                class="fas fa-sm fa-fw m-r-10  fa-plus"></i>Agregar movimiento
                        </button>
                    </div>
                    <ul class="timeline" id="timeline">

                    </ul>
                </div>
                <!-- end tab-pane -->
                <!-- begin tab-pane -->
                <div class="tab-pane fade" id="default-tab-3">
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
                </div>
                <!-- end tab-pane -->
            </div>
        </div>
        <div class="col-xl-12 text-center">
            <hr>
            <button class="btn btn-success" title="click para retrocedrer
                    " href="/covid/reporte" data-toggle="ajax"><i class="fas fa-lg fa-fw m-r-10  fa-backward"></i>atras
            </button>
            <hr>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar Movimiento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="col-xl-12 ">
                        <label for="fecreu">FECHA DE REUNION
                        </label>
                        <input type="text" class="form-control" id="fecreu" autocomplete="off">
                        <div class="hide " id="valfecreu"></div>
                        <hr>
                        <label for="depar">DEPARTAMENTO</label>
                        <select class="form-control" id="depar">
                            <option value="0" selected>AMAZONAS</option>
                        </select>
                        <div class="hide " id="valdepar"></div>
                        <label for="prov">PROVINCIA
                            <req>*</req>
                        </label>
                        <select class="form-control" id="prov" disabled>
                            <option selected value="0">SELECCIONE</option>
                        </select>
                        <div class="hide " id="valprov"></div>

                        <label for="dis">DISTRITO
                            <req>*</req>
                        </label>
                        <select class="form-control" id="dis" disabled>
                            <option selected value="0">SELECCIONE</option>
                        </select>
                        <div class="hide " id="valdis"></div>
                        <label for="activid">ACTIVIDAD</label>
                        <textarea class="form-control" rows="3"
                                  onkeyup="javascript:this.value=this.value.toUpperCase();" id="activid"></textarea>
                        <div class="hide " id="valactivid"></div>
                        <label for="snombre">CONTACTO</label>
                        <div class="input-group">
                            <input type="text" id="contacto" name="contacto" class="form-control" value=""
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                            <span class="input-group-append">
											<a href="#" onclick="" class="input-group-text" style="text-decoration:none"
                                               title="Agregar contacto" id="addcontacto"><i
                                                    class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        <label>LISTA DE CONTACTOS</label>
                        <div class="input-group">
                            <ol id="listacont">
                            </ol>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal" id="cemod">Cancelar</a>
                <button id="enviar" class="btn btn-success " title="click para agregar una visita" onclick="enviar()"><i
                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<link href="../assets/plugins/button-toggle/bootstrap-toggle.min.css" rel="stylesheet">
<script src="../assets/plugins/button-toggle/bootstrap-toggle.min.js"></script>
<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script>
    $.when(
        $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
    ).done(function () {
        $.getScript('../js/intranet/util.js'),
            $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js'),
            $.getScript('../js/intranet/covid/rutacovid.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
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


                columns: [

                    {data: 'descripcion', name: 'descripcion'},
                    {data: 'nombres', name: 'nombres'},
                    {data: 'numeroDoc', name: 'numeroDoc'},
                    {data: 'telefono', name: 'telefono'},
                    {data: 'atcdesc', name: 'atcdesc'},
                    {data: 'feccontact', name: 'feccontact'},
                    {
                        data: function (row) {
                            return '<tr><a href="/covid/reportecovid/' + row.idPacienteCovid2 + '" style="color: mediumorchid" TITLE="Ver movimientos" data-toggle="ajax">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-map-marker-alt"> </i></a>' +
                                '<a href="/covid/vereditarpaciente/' + row.idPacienteCovid2 + '" style="color: green" TITLE="Editar datos paciente" data-toggle="ajax">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-edit"> </i></a>' +
                                '<a  href="/covid/verhistorialclinico/' + row.idPacienteCovid2 + '"   title="Ver historia clinica"  style="color: #00CF00" data-toggle="ajax">' +
                                '<i class="fas fa-lg fa-fw m-r-10 fa-clipboard"> </i></a>' +
                                '</tr>';
                        }
                    }
                ]
            }
        );
    });
</script>




















