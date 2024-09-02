<script src=" ../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>

<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- begin page-header -->
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<!-- end page-header -->
<!-- begin row -->
<div id="response">
    <h1 class="page-header">CONTROL GESTANTE </h1>
    <!-- begin panel -->

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">CONTROL DE GESTANTE</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                   data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->

        <div class="panel-body">
            <div class="row col-xl-12 col-sm-12 col-xs-12">
                <input type="text" id="idgestante" value="{{$gestante->id}}" hidden>
                <input type="text" id="espartu" value="{{$gestante->partu}}" hidden>
                <div class="col-xl-3">
                    <label for="histclini">Nro Historia :</label>
                    <input type="text" readonly class="form-control" id="histclini" value="{{$gestante->hisclini}}">
                </div>
                <div class="col-xl-3 ">
                    <label for="dni">Dni :</label>
                    <input id="dni" type="text" readonly class="form-control" value="{{$gestante->nrdoc}}"/>
                </div>
                <div class="col-xl-3 ">
                    <label for="nomb">Nombres : </label>
                    <input id="nomb" type="text" readonly class="form-control" value="{{$gestante->nombre}}"
                    />
                </div>
                <div class="col-xl-3 ">
                    <label for="fecnacr">FechNac</label>
                    <input id="fecnacr" type="text" readonly class="form-control" value="{{$gestante->fecnac}}"/>
                </div>

                @if($gestante->partu=='0')
                    <div class="col-xl-3 ">
                        <label for="fecppr">Fecha probable parto</label>
                        <input id="fecppr" type="text" readonly class="form-control"
                               value="{{$gestante->fecprobparto}}"/>
                    </div>
                @else
                    <div class="col-xl-3 ">
                        <label for="fecppr">Fecha de parto</label>
                        <input id="fecppr" type="text" readonly class="form-control"
                               value="{{$gestante->fecparto}}"/>
                    </div>
                @endif


            </div>
            <br>
            @if($gestante->partu=='0')
                <div class="row col-xl-12 col-sm-12 col-xs-12 ">
                    <div class="radio radio-css radio-inline">
                        <input type="radio" name="checkges" id="checkges" value="option1">
                        <label for="checkges">Culminar Gestacion</label>
                    </div>
                </div>

                <div id="gestante">
                    <br>
                    <div class="col-xl-12  ">
                        <label for="tipact" class="col-xl-3 text-left">Selecccionar Actividad : </label>
                        <select class="col-xl-3 form-control" id="tipact" title="seleccione opcion">
                            <option value="1" selected>Seguimiento de atencion prenatal</option>
                            <option value="2">Atencion prenatal reenfocada</option>
                            <option value="3">Examenes auxiliares</option>
                        </select>
                    </div>
                    <br>
                    <div id="atepre">
                        <br>
                        <br>
                        <legend class="text-black text-center text-"><u><strong>ATENCION PRENATAL</strong> </u>
                        </legend>
                        <br>
                        <br>
                        <table id="atpre"
                               class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                               role="grid" aria-describedby="data-table-autofill_info"
                               width="100%">
                            <thead class="text-purple">
                            <tr>
                                <th colspan="8" class="text-center"> APN</th>
                            </tr>
                            <tr>
                                <th>Descripcion atencion</th>
                                <th>Estado</th>
                                <th>Edad gestacional</th>
                                <th>Observacion</th>
                                <th>Fecha atencion</th>
                                <th>Fecha registro</th>

                                <th>Lugar registro</th>
                                <th>Usuario registro</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div id="exaux" class="hide">
                        <br>
                        <br>
                        <legend class="text-black text-center text-"><u><strong>EXAMENES AUXILIARES BASALES</strong>
                            </u>
                        </legend>
                        <br>
                        <hr>
                        <legend class="m-b-0">EXAMEN SANGUINEO</legend>
                        <div class="row col-xl-12 col-sm-12 col-xs-12 " id="grupsan">

                            <div class="col-xl-2 ">
                                <label for="grusan">GRUPO SANGUINEO </label>
                                <input id="grusan" type="text" class="form-control"
                                       value="{{$gestante->grupSanguineo}}"
                                       disabled/>
                            </div>
                            <div class="col-xl-2 ">
                                <label for="factor">FACTOR RH</label>
                                <input id="factor" type="text" class="form-control" value="{{$gestante->factorRH}}"
                                       disabled/>
                            </div>
                            <div class="col-xl-1 row" id="botenviar">
                                <label for="cambiardat"></label>
                                <a href="#"
                                   onclick="cambiarBotonGrupoSanguineo('{{$gestante->grupSanguineo}}','{{$gestante->factorRH}}',1,event)"
                                   style="color: green" title="Editar tamizaje VBG" id="cambiardat"> <i
                                        class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>
                            </div>

                        </div>
                        <hr>
                        <!-- begin table-responsive -->
                        <div class="table-responsive">
                            <table id="sifvih"
                                   class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                                   role="grid" aria-describedby="data-table-autofill_info"
                                   width="100%">
                                <thead class="text-orange">
                                <tr>
                                    <th colspan="8">[SIFILIS] - [VIH]</th>
                                </tr>
                                <tr>
                                    <th>Descripcion atencion</th>
                                    <th>Estado</th>
                                    <th>Resultado</th>
                                    <th>Observacion</th>
                                    <th>Fecha atencion</th>
                                    <th>Fecha registro</th>
                                    <th>Lugar registro</th>
                                    <th>Usuario registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br><br>

                        <div class="table-responsive">
                            <table id="ohp"
                                   class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                                   role="grid" aria-describedby="data-table-autofill_info"
                                   width="100%">
                                <thead class="text-blue">
                                <tr>
                                    <th colspan="8">[ORINA COOMPLETA] - [HEPATITIS] - [PROTEINAS]</th>
                                </tr>
                                <tr>
                                    <th>Descripcion atencion</th>
                                    <th>Estado</th>
                                    <th>Resultado</th>
                                    <th>Observacion</th>
                                    <th>Fecha atencion</th>
                                    <th>Fecha registro</th>
                                    <th>Lugar registro</th>
                                    <th>Usuario registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br><br>

                        <div class="table-responsive">
                            <table id="hg"
                                   class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                                   role="grid" aria-describedby="data-table-autofill_info"
                                   width="100%">
                                <thead class="text-success">
                                <tr>
                                    <th colspan="7"> [HEMOGLOBINA] - [GLUCOSA]</th>
                                </tr>
                                <tr>
                                    <th>Descripcion atencion</th>
                                    <th>Estado</th>
                                    <th>Resultado</th>
                                    <th>Observacion</th>
                                    <th>Fecha atencion</th>
                                    <th>Fecha registro</th>
                                    <th>Lugar registro</th>
                                    <th>Usuario registro</th>

                                </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table id="eco"
                                   class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                                   role="grid" aria-describedby="data-table-autofill_info"
                                   width="100%">
                                <thead class="text-orange">
                                <tr>
                                    <th colspan="7">[ECOGRAFIA]</th>
                                </tr>
                                <tr>
                                    <th>Descripcion atencion</th>
                                    <th>Estado</th>
                                    <th>Edad gestacional</th>
                                    <th>Observacion</th>
                                    <th>Fecha atencion</th>
                                    <th>Fecha registro</th>
                                    <th>Lugar registro</th>
                                    <th>Usuario registro</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="ateprere" class="hide">
                        <br>
                        <br>
                        <legend class="text-black text-center text-"><u><strong>ACTIVIDADES REALIZADAS DURANTE LA
                                    ATENCION
                                    PRENATAL REENFOCADA</strong> </u></legend>
                        <br>
                        <hr>
                        <div class="row col-xl-12 col-sm-12 col-xs-12 ">
                            <legend class="m-b-0">TAMIZAJE VBG</legend>

                            <div class="col-xl-2 ">
                                <label for="fectami">FECHA </label>
                                <input id="fectami" type="text" class="form-control"
                                       value="{{$gestante->tamizajeVBG}}"
                                       disabled/>
                            </div>
                            <div class="col-xl-2 ">
                                <label for="restami">RESULTADO</label>
                                <input id="restami" type="text" class="form-control"
                                       value="{{$gestante->resultadoVBG}}"
                                       disabled/>
                            </div>
                            <div class="col-xl-1 row" id="botenviartam">
                                <label for="cambiardat"></label>
                                <a href="#" onclick="cambiarBotonTami(1,event)" style="color: green"
                                   title="Editar tamizaje VBG" id="cambiardat"> <i
                                        class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="table-responsive">
                            <table id="atepreresuple"
                                   class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                                   role="grid" aria-describedby="data-table-autofill_info"
                                   width="100%">
                                <thead class="text-blue">
                                <tr>
                                    <th colspan="7">[SUPLEMENTACION]</th>
                                </tr>
                                <tr>

                                    <th>Descripcion atencion</th>
                                    <th>Estado</th>
                                    <th>Observacion</th>
                                    <th>Fecha atencion</th>
                                    <th>Fecha registro</th>
                                    <th>Lugar registro</th>
                                    <th>Usuario registro</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                        <!-- end table-responsive -->
                        <br><br>
                        <div class="table-responsive">
                            <table id="ateprerevac"
                                   class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                                   role="grid" aria-describedby="data-table-autofill_info"
                                   width="100%">
                                <thead class="text-orange">
                                <tr>
                                    <th colspan="7">[VACUNA] - [PLAN PARTO]</th>
                                </tr>
                                <tr>
                                    <th>Descripcion atencion</th>
                                    <th>Estado</th>
                                    <th>Observacion</th>
                                    <th>Fecha atencion</th>
                                    <th>Fecha registro</th>
                                    <th>Lugar registro</th>
                                    <th>Usuario registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else

                <div id="parto">
                    <legend class="text-black text-center text-"><u><strong>CULMINACION DEL EMBARAZO</strong> </u>
                    </legend>
                    <br>
                    @if($gestante->fecabor==null && $gestante->atefecParto==null )
                        <div class="row col-xl-12 col-sm-12 col-xs-12 text-center">
                            <div class="switcher switcher-danger  ">
                                <input type="checkbox" name="switcher_checkbox_1" id="switcher_checkbox_1"
                                >
                                <label for="switcher_checkbox_1">Aborto</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-xl-12 col-sm-12 col-xs-12">

                            <div class="col-xl-3 ">
                                <label for="vipa">Via del parto</label>
                                <select class="form-control" id="vipa" title="seleccione opcion">
                                    <option>VAGINAL</option>
                                    <option>CESAREA</option>
                                </select>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="lupa">Lugar del parto</label>
                                <select class="form-control" id="lupa" title="seleccione opcion">
                                    <option selected>INSTITUCIONAL</option>
                                    <option>DOMICILIARIO</option>
                                    <option>TRAYECTO</option>
                                </select>
                            </div>

                            <div class="col-xl-3 " id="fecatef">
                                <label for="fecate " class="text-center">Fecha atencion</label>
                                <input type="text" class="form-control  " id="fecate" autocomplete="off">
                            </div>
                            <div class="col-xl-3" id="tipcnvf">
                                <label for="tipcnv">Tipo CNV </label>
                                <select class=" form-control" id="tipcnv" title="seleccione opcion">
                                    <option selected>ELECTRONICO</option>
                                    <option>MANUAL</option>
                                </select>
                            </div>
                            <div class="col-xl-3 " id="fecnvf">
                                <label for="fecnv">Fecha CNV </label>
                                <input type="text" class="form-control   " id="fecnv" autocomplete="off">
                            </div>

                            <div class="col-xl-3 " id="fecabof" hidden>
                                <label for="fecabo">Fecha aborto </label>
                                <input type="text" class="form-control   " id="fecabo"
                                       autocomplete="off">
                            </div>

                        </div>

                        <div class="col-xl-12 text-center">
                            <hr>
                            <button id="enviar" class="btn btn-success " title="click para guardar parto"
                                    onclick="enviarPuerperio(event)">
                                <i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                            </button>

                        </div>
                        <hr>
                    @elseif($gestante->atefecParto!=null && $gestante->fecabor==null)

                        <div class="row col-xl-12 col-sm-12 col-xs-12">

                            <div class="col-xl-3 ">
                                <label for="vipa">Via del parto</label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->viaParto}}">
                            </div>
                            <div class="col-xl-3 ">
                                <label for="lupa">Lugar del parto</label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->luParto}}">
                            </div>

                            <div class="col-xl-3 " id="fecatef">
                                <label for="fecate " class="text-center">Fecha parto</label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->atefecParto}}">
                            </div>
                            <div class="col-xl-3" id="tipcnvf">
                                <label for="tipcnv">Tipo CNV </label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->cnvTipo}}">
                            </div>
                            <div class="col-xl-3 " id="fecnvf">
                                <label for="fecnv">Fecha CNV </label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->cnvFecha}}">
                            </div>


                        </div>

                        <br>
                        <br>
                        <legend class="text-black text-center text-"><u><strong>ATENCION DEL PUERPERIO</strong>
                            </u>
                        </legend>
                        <br>
                        <br>
                        <div class="row col-xl-12 col-sm-12 col-xs-12 ">

                            <div class="col-xl-2 ">
                                <label for="hemopu">HEMOGLOBINA </label>
                                <input id="hemopu" type="text" class="form-control"
                                       value="{{$gestante->hemoPuerperio}}"
                                       disabled/>
                            </div>
                            <div class="col-xl-3 ">
                                <label for="plapu">PLANIFICACION FAMILIAR</label>
                                <input id="plapu" type="text" class="form-control"
                                       value="{{$gestante->planifiFami}}"
                                       disabled/>
                            </div>
                            <div class="col-xl-1 row" id="botenviarpuer">
                                <label for="cambiardat"></label>
                                <a href="#" onclick="cambiarBotonPuerpero(1,event)" style="color: green"
                                   title="Editar datos puerperio " id="cambiardat"> <i
                                        class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>
                            </div>
                        </div>
                        <br>
                        <table id="atepuerpe"
                               class="table table-striped table-bordered table-td-valign-middle dataTable no-footer dtr-inline collapsed"
                               role="grid" aria-describedby="data-table-autofill_info"
                               width="100%">
                            <thead class="text-purple">
                            <tr>
                                <th colspan="8" class="text-center"> APN</th>
                            </tr>
                            <tr>
                                <th>Descripcion atencion</th>
                                <th>Estado</th>
                                <th>Observacion</th>
                                <th>Fecha atencion</th>
                                <th>Fecha registro</th>

                                <th>Lugar registro</th>
                                <th>Usuario registro</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <script>


                            var idgestante = $('#idgestante').val();
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
                        </script>
                        <hr>
                    @elseif($gestante->atefecParto==null && $gestante->fecabor!=null)
                        <div class="row col-xl-12 col-sm-12 col-xs-12">

                            <div class="col-xl-3 ">
                                <label for="vipa">Via del parto</label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->viaParto}}">
                            </div>
                            <div class="col-xl-3 ">
                                <label for="lupa">Lugar del parto</label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->luParto}}">
                            </div>

                            <div class="col-xl-3 " id="fecatef">
                                <label for="fecate " class="text-center">Fecha aborto</label>
                                <input type="text" readonly class="form-control" id="vipa"
                                       value="{{$gestante->fecabor}}">
                            </div>

                        </div>
                        <hr>
                    @endif
                    <div class="row col-xl-12 col-sm-12 col-xs-12">
                        <div class="col-xl-3 ">
                            <label for="noco">Nombre de contacto</label>
                            <input type="text" class="form-control" id="noco" autocomplete="off"
                                   disabled value="{{$gestante->nombContacto}}">
                        </div>
                        <div class="col-xl-3 ">
                            <label for="teco">Telefono de contacto</label>
                            <input type="text" class="form-control" id="teco" autocomplete="off"
                                   disabled value="{{$gestante->telfContacto}}">
                        </div>
                        <div class="col-xl-5">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" rows="5" id="observaciones"
                                      disabled>{{$gestante->Observaciones}}</textarea>
                        </div>
                        <div class="col-xl-1 text-center" id="botenviarobs">
                            <label for="cambiardat">Editar</label>
                            <a href="#" onclick="cambiarBotonObs(1,event)" style="color: green"
                               title="Editar datos puerperio " id="cambiardat"> <i
                                    class="fas fa-lg fa-fw m-r-10 fa-edit "> </i></a>
                        </div>
                    </div>

                </div>
            @endif
            <div class="col-xl-12 text-center">
                <hr>
                <button class="btn btn-success" title="click para regresar
                     " href="/gestante/reportar" data-toggle="ajax"><i
                        class="fas fa-lg fa-fw m-r-10  fa-arrow-left"></i>Atras
                </button>

            </div>
        </div>
    </div>

    <!-- end panel -->
    <!-- begin modal -->
    <div class="modal fade" id="modal-dialog-atender">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atender</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <div id="modalopc">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal-->
</div>

<!-- end col-6 -->

<!-- end row -->

<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script>
    App.setPageTitle('Color Admin | Basic Tables');
    App.restartGlobalFunction();
    $.when(
        $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
    ).done(function () {
        $.when(
            $.getScript('../js/intranet/gestantes/gestantes.js'),
            $.getScript('../js/intranet/util.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve)
            }));

    });


    $(function () {
        $('#atpre').DataTable({
                ajax: '/obtenercontrolgestante/1/' + $('#idgestante').val(),
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
    });
</script>
<!-- ================== END PAGE LEVEL JS ================== -->
