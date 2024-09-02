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
<script src="../assets/plugins/DataTables/media/js/dataTables.fixedHeader.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}"/>
<style>
    req {
        color: red;
    }
</style>
<br>
<br>
<div id="response">

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h1 class="panel-title">ENTREGA MATERIAL O INSUMO</h1>
            <div class="panel-heading-btn">
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>

            </div>
        </div>

        <div class="panel-body">
            <div class="col-xl-12  ">
                <button id="entmat" class="btn btn-success " title="click para agregar material o insumo"
                        data-toggle="modal" data-target="#modal_dialog_add_stock">
                    <i class="fas fa-lg fa-fw m-r-10 fa-handshake"></i>Entregar Material
                </button>
            </div>
            <br>
            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                <div id="data-table-fixed-header_wrapper"
                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tabla_ent_mat"
                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                   role="grid"
                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                <tbody>
                                </tbody>
                                <thead>
                                <tr role="row">
                                    <th> ESTABLECIMIENTO</th>
                                    <th> MOTIVO DE ENTREGA</th>
                                    <th>RECEPCIONADO POR</th>
                                    <th>FECHA ENTREGA</th>
                                    <th>ITEMS</th>
                                    <th>USUARIO</th>
                                    <th>ESTADO</th>
                                    <th> OPCIONES</th>
                                </tr>
                                </thead>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_edit_ent">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR ENTREGA MATERIAL/DISPOSITIVO MEDICO ( <req>*</req> Dato obligatorio)</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_edentmat"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <tbody>
                                                </tbody>
                                                <thead>
                                                <tr role="row">
                                                    <th>
                                                        CODIGO
                                                    </th>
                                                    <th>
                                                        NOMBRE
                                                    </th>

                                                    <th>FECING
                                                    </th>
                                                    <th>
                                                        CANTIDAD
                                                    </th>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-xs-12  row">
                                <input id="ident" name="ident" hidden/>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="editedessrr">EESS DE REFERENCIA
                                        <req>*</req>
                                    </label>
                                    <input id="edidessrr" name="edidessrr"  hidden/>
                                    <textarea class="form-control form-control-sm" rows="1" id="editedessrr"
                                               autocomplete="off"> </textarea>
                                    <div class="hide " id="edvalessrr"></div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="edmotr">MOTIVO
                                        <req>*</req></label>
                                    <textarea class="form-control typeahead" rows="1" id="edmotr" name="edmotr"
                                              onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"> </textarea>
                                    <div class="hide " id="edvalmotr"></div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="edenta">ENTREGADO A
                                        <req>*</req></label>
                                    <input class="form-control typeahead" id="edenta" name="edenta"
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                                    <div class="hide " id="edvalenta"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3  ">
                                    <label for="edfecen">FECHA DE ENTREGA
                                     <req>*</req></label>
                                    <input type="text" class="form-control" id="edfecen" autocomplete="off">
                                    <div class="hide " id="edvalfecen"></div>

                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="edventmat" class="btn btn-success " title="click para modificar entrega"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_rec_stock">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ENTREGAR MATERIAL/DISPOSITIVO MEDICO ( <req>*</req> Dato obligatorio)</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_entmat"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <tbody>
                                                </tbody>
                                                <thead>
                                                <tr role="row">
                                                    <th>
                                                        CODIGO
                                                    </th>
                                                    <th>
                                                        NOMBRE
                                                    </th>

                                                    <th>FECING
                                                    </th>
                                                    <th>
                                                        CANTIDAD
                                                    </th>
                                                    <th>
                                                        MOVER
                                                    </th>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-xs-12  row">

                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="motr">MOTIVO
                                        <req>*</req></label>
                                    <textarea class="form-control typeahead" rows="1" id="motr" name="motr"
                                              onkeyup="javascript:this.value=this.value.toUpperCase();"> </textarea>
                                    <div class="hide " id="valmotr"></div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <label for="enta">ENTREGADO A
                                        <req>*</req></label>
                                    <input class="form-control typeahead" id="enta" name="enta"
                                           onkeyup="javascript:this.value=this.value.toUpperCase();"> </input>
                                    <div class="hide " id="valenta"></div>
                                </div>
                                <div class="col-xl-3 col-sm-3 col-xs-3  ">

                                    <label for="fecen">FECHA DE ENTREGA
                                        <req>*</req></label>
                                    <input type="text" class="form-control" id="fecen" autocomplete="off">
                                    <div class="hide " id="valfecen"></div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-xl-4">
                                    <label for="acteess">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        &nbsp;&nbsp;
                                        &nbsp;&nbsp;</label>
                                    <div class="form-check" title="Activar para enviar a establecimiento">
                                        <input class="form-check-input is-valid" type="checkbox" value="" id="acteess">
                                        <label class="form-check-label" for="acteessval">PARA ESTABLECIMIENTO</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-xs-12" hidden id="actess">
                                    <label for="edessrr">EESS
                                        <req>*</req>
                                    </label>
                                    <input id="idessrr" name="idessrr"  hidden/>
                                    <textarea class="form-control form-control-sm typeahead" rows="1" id="edessrr"
                                               autocomplete="off"> </textarea>
                                    <div class="hide " id="edvalessrr"></div>
                                </div>

                            </div>
                            <div class="col-xl-12 text-center">
                                <hr>
                                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                                <button id="enventmat" class="btn btn-success " title="click para guardar entrega"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 ">
            <div class="modal fade" id="modal_dialog_ver_itms_ent">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">VER ITEMS ENTREGADOS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xl-12 col-sm-12 col-xs-12  ">
                                <div id="data-table-fixed-header_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table id="tabla_vertabent"
                                                   class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                                   role="grid"
                                                   aria-describedby="data-table-fixed-header_info" width="100%">
                                                <tbody>
                                                </tbody>
                                                <thead>
                                                <tr role="row">
                                                    <th>
                                                        MEDICAMENTO
                                                    </th>
                                                    <th>
                                                        TIPO
                                                    </th>
                                                    <th>
                                                        CANTIDAD
                                                    </th>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <br>
                                <a href="javascript:;" class="btn btn-primary" data-dismiss="modal"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cerrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script>
    $.getScript('../assets/plugins/sweetalert/dist/sweetalert.min.js').done(function () {
        $.when(
            $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/almacen/entrega.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
