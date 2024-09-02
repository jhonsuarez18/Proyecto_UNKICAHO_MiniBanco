<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>


<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"/>

<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<link href="../assets/plugins/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="../js/typeahead/bootstrap3-typeahead.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>

<link rel="stylesheet" href="../assets/plugins/datatables.net/css/buttons.dataTables.min.css">
<script src="../assets/plugins/datatables.net/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables.net/js/buttons.flash.min.js"></script>
<script src="../assets/plugins/datatables.net/js/jszip.min.js"></script>
<script src="../assets/plugins/datatables.net/js/pdfmake.min.js"></script>
<script src="../assets/plugins/datatables.net/js/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables.net/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables.net/js/buttons.print.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<style>
    req {
        color: red;
    }

</style>
<br>
<br>

<div id="response">

    <!-- final cabecera -->

    <input id="idvi" value="{{$vi->vId}}" hidden>
    <div class="row">
        <!---------------------------------------- begin panel comprobantes ------------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">RENDICION DE COMISION DE SERVICIOS
                <small>Detalle de gastos en comision de servicios viaticos, pasajes y otros gastos</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">COMPROBANTES DE PAGO</h1>
                    <div class="panel-heading-btn">
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i
                                class="fa fa-redo"></i></a>
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i
                                class="fa fa-minus"></i></a>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-xl-12">
                        <div class="col-xl-12 row">
                            <label for="dni">NOMBRES Y APELLIDOS
                            </label>
                            <span class="semi-bold" id="dni">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$vi->nomb}} </span>
                        </div>
                        <div class="col-xl-12 row">
                            <label for="dni">DEPENDENCIA
                            </label>
                            <span class="semi-bold" id="dni">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$vi->descripcion}}</span>
                        </div>
                        <div class="col-xl-12 row">
                            <label for="dni">CARGO
                            </label>
                            <span class="semi-bold" id="dni">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;{{$vi->tPDescripcion}}</span>
                        </div>
                        <hr>
                        @if($vi->rFecRetorv === null)
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <input id="ref" value="{{$vi->rId}}" hidden>
                                <div class="col-xl-2 ">
                                    <label for="fecret">FEC RETORNO
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="fecret"
                                           autocomplete="off">
                                    <div class="hide " id="valfecret"></div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4 align-self-center">
                                    <a href="javascript:" id="addfec" class="btn btn-circle btn-primary  "
                                       title="click para agregar fecha de retorno">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <hr>
                            </div>
                        @else
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <h1 class="page-header">CANTIDAD DE VIATICOS ASIGNADOS
                                </h1>
                            </div>

                                <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                    <div class="col-xl-2 col-sm-2 col-xs-2">
                                        <label for="totb">ALIMENTACION
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span>
                                            </div>
                                            <input id="alim" type="text" value="{{$calcvia['alim']}}" class="form-control"
                                                   disabled/>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2 col-xs-2">
                                        <label for="totb">HOSPEDAJE
                                        </label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">S/.</span>
                                            </div>
                                            <input id="hosp" type="text" value="{{$calcvia['hosp']}}" class="form-control"
                                                   disabled/>
                                        </div>
                                    </div>
                                </div>

                            <hr>
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <div class="col-xl-2 ">
                                    <label for="fecret">FEC RETORNO
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="fecret"
                                           autocomplete="off" value="{{$vi->rFecRetorv}}" disabled>
                                    <div class="hide " id="valfecret"></div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                                <button id="addcomp" class="btn btn-circle btn-primary "
                                        title="click para agregar Usuario a Oficina"
                                        data-toggle="modal" data-target="#modal_dialog_add_persref">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>AGREGAR COMPROBANTES
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_comp"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead class="strong">
                                    <tr>
                                        <td ROWSPAN=2 class="align-middle text-center">N°</td>
                                        <td COLSPAN=3 class="text-center">
                                            COMPROBANTE DE PAGO
                                        </td>
                                        <td ROWSPAN=2 class="align-middle text-center">
                                            RAZON SOCIAL
                                        </td>
                                        <td ROWSPAN=2 class="align-middle text-center">
                                            DETALLE GASTO
                                        </td>
                                        <td ROWSPAN=2 class="align-middle text-center">
                                            IMPORTE
                                        </td>
                                        <td ROWSPAN=2 class="align-middle text-center">
                                            ESTADO
                                        </td>
                                        <td ROWSPAN=2 class="align-middle text-center">
                                            OPCIONES
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            FECHA
                                        </td>
                                        <td class="text-center">
                                            TIPO DOC.
                                        </td>
                                        <td class="text-center">
                                            N° DOC.
                                        </td>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right"><strong>TOTAL GENERAL</strong></th>
                                        <th colspan="3" class="text-left"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                    <div class="col-xl-2 col-sm-2 col-xs-2">
                        <label for="totb">TOT BOL
                        </label>
                        <div class="input-group m-b-10">
                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                            <input id="totb" type="text" class="form-control"
                                   disabled/>
                        </div>
                    </div>
                    <div class="col-xl-1 col-sm-1 col-xs-1">
                        <label for="totbpor">% BOL
                        </label>
                        <input id="totbpor" type="text" class="form-control" disabled/>
                    </div>
                    <div class="col-xl-2 col-sm-2 col-xs-2">
                        <label for="totdj">TOT DJ
                        </label>
                        <div class="input-group m-b-10">
                            <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                            <input id="totdj" type="text" class="form-control"
                                   disabled/>
                        </div>
                    </div>
                    <div class="col-xl-1 col-sm-1 col-xs-1">
                        <label for="totcpor">% DJ
                        </label>
                        <input id="totcpor" type="text" class="form-control" disabled/>
                    </div>
                </div>
                <hr>
                <div class="col-xl-12 col-sm-12 col-xs-12 text-center">


                    <a href="/referencia/verreferenciasess" data-toggle="ajax" class="btn btn-success   btn-sm">
                        <i class="fas fa-lg fa-fw m-r-10 fa-arrow-left" title="Clic para ver viatico"> </i>
                        Regresar
                    </a>
                    @if($vi->rFecRetorv !== null)
                        <a href="/referencia/pdfviatico/{{$vi->vId}}" class="btn btn-danger   btn-sm"
                           title="Click para imprimir fromatos en pdf">
                            <i class="fa fa-file-pdf">
                            </i>
                            Imprimir formatos
                        </a>

                    @endif
                </div>
                <hr>


            </div>
        </div>
        <!----------------------------------------End Panel comprobantes---------------------------------------->
        <!--------------begin agregar comprobante--------->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-add-comp">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">COMPROBANTE DE PAGO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">


                                <div class="col-xl-5 ">
                                    <div class="form-group">
                                        <label for="tpg"> TIPO GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="tpg">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validtpg"></div>
                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="form-group">
                                        <label for="ga"> GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="ga">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validga"></div>
                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="form-group">
                                        <label for="tipc"> TIPO COMPROBANTE
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="tipc">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validtipc"></div>
                                    </div>
                                </div>
                                <div class="col-xl-2 ">
                                    <label for="feccomp">FEC COMPROB
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="feccomp"
                                           autocomplete="off">
                                    <div class="hide " id="valfeccomp"></div>
                                </div>
                                <div class="col-xl-4 ">
                                    <label for="numdoc">N° DE DOCUMENTO
                                    </label>
                                    <input id="numdoc" type="text" class="form-control form-control-sm"
                                           autocomplete="off" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    />
                                    <div class="hide " id="validnumdoc"></div>
                                </div>

                                <div class="col-xl-8 ">
                                    <div class="form-group">
                                        <label for="razso">RAZON SOCIAL</label>
                                        <textarea class="form-control typeahead" rows="1" id="razso"
                                                  name="act"
                                                  onkeyup="javascript:this.value=this.value.toUpperCase();"> </textarea>
                                        <div class="hide " id="valrazso"></div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="mont">MONTO
                                        <req>*</req>
                                    </label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                        <input id="mont" type="text" class="form-control"
                                               onkeypress="return filterFloat(event,this);"/>
                                        <div class="hide " id="valmon"></div>
                                    </div>
                                </div>

                                <!--<div class="col-xl-8 ">
                                    <div class="form-group">
                                        <label for="act">DETALLE GASTO</label>
                                        <textarea class="form-control typeahead" rows="3" id="act"
                                                  name="act"> </textarea>
                                        <div class="hide " id="validact"></div>
                                    </div>
                                </div> -->

                            </div>

                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enviar" class="btn btn-success " title="click para agregar comprobante
                    " onclick="enviarComp()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------->
        <!--------------begin editar comprobante--------->
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal-edit-comp">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">EDITAR COMPROBANTE DE PAGO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <input id="idcom" hidden>
                            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                                <div class="col-xl-5 ">
                                    <div class="form-group">
                                        <label for="etpg"> TIPO GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="etpg">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validetpg"></div>
                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="form-group">
                                        <label for="ega"> GASTO
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="ega">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="valiega"></div>
                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="form-group">
                                        <label for="etipc"> TIPO COMPROBANTE
                                            <req>*</req>
                                        </label>
                                        <select class="form-control form-control-sm" id="etipc">
                                            <option selected value="0">SELECCIONE</option>
                                        </select>
                                        <div class="hide " id="validetipc"></div>
                                    </div>
                                </div>
                                <div class="col-xl-2 ">
                                    <label for="efeccomped">FEC COMPROB
                                        <req>*</req>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="efeccomped"
                                           autocomplete="off">
                                    <div class="hide " id="valefeccomped"></div>
                                </div>
                                <div class="col-xl-4 ">
                                    <label for="enumdoc">N° DE DOCUMENTO
                                    </label>
                                    <input id="enumdoc" type="text" class="form-control form-control-sm"
                                           autocomplete="off"
                                    />
                                    <div class="hide " id="validenumdoc"></div>
                                </div>

                                <div class="col-xl-8 ">
                                    <div class="form-group">
                                        <label for="erazso">RAZON SOCIAL</label>
                                        <textarea class="form-control typeahead" rows="1" id="erazso"
                                                  name="act"> </textarea>
                                        <div class="hide " id="valerazso"></div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-3 col-xs-3">
                                    <label for="emont">MONTO
                                        <req>*</req>
                                    </label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                        <input id="emont" type="text" class="form-control"
                                               onkeypress="return filterFloat(event,this);"/>
                                        <div class="hide " id="evalmon"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enviared" class="btn btn-success " title="click para editar comprobante
                    " onclick="editarComp()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!------------------------->
    </div>
</div>

<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/referencias/viatico/detalleviatico.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });

</script>
