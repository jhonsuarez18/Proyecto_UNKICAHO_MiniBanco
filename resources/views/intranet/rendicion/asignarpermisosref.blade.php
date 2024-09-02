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
<style>
    req {
        color: red;
    }

</style>
<br>
<br>
<div id="response">

    <!-- final cabecera -->


    <div class="row">
        <!---------------------------------------- begin panel PERMISOS ------------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">Permisos Usuario
                <small>Aqui puedo agregar los permisos del usuario de referencia</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">PERMISOS</h1>
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
                    <legend class="m-b-15">ASIGNAR USUARIO A OFICINA

                    </legend>
                    <div class="col-xl-12">
                        <button id="addUsuOfi" class="btn btn-success " title="click para agregar Usuario a Oficina"
                                data-toggle="modal" data-target="#modal_dialog_add_usuofic">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Usuario a Oficina
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_UsuOfi"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            USUARIO OFIC.
                                        </th>
                                        <th>
                                            DNI USUARIO OFIC.
                                        </th>
                                        <th>
                                            ENTIDAD
                                        </th>
                                        <th>
                                            OFICINA
                                        </th>
                                        <th>
                                            FECHA CREACION
                                        </th>
                                        <th>
                                            USUARIO REG.
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
                </div>

            </div>
        </div>
        <!----------------------------------------End Panel DOCUMENTO---------------------------------------->

    </div>
</div>
<!----------------------------------------INICIO MODAL AGREGAR USUARIO OFICINA---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_usuofic">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR USUARIO A OFICINA-ESTABLECIMIENTO-RED</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-sm-12 col-xs-12 row">
                        <input id="idusof" hidden/>
                        <div class="col-xl-12">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">USUARIO</legend>
                            <div class="col-xl-12">
                                <label for="userref">USUARIO
                                    <req>*</req>
                                </label>
                                <input id="userref" type="text" class="form-control form-control-sm typeahead"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                />
                                <div class="hide" id="validaruserref" ></div>
                            </div>
                            <div class="col-xl-12 row">
                                <div class="col-xl-6">
                                    <br>
                                    <label for="dni">DNI
                                        <req>*</req>
                                    </label>
                                    <input id="dni" type="text" class="form-control" disabled
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                    />
                                    <div class="hide" id="validardni" ></div>
                                </div>
                                <div class="col-xl-6">
                                    <br>
                                    <label for="nombcompl">NOMBRE DE USUARIO
                                        <req>*</req>
                                    </label>
                                    <input id="nombcompl" type="text" class="form-control" disabled
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                    />
                                    <div class="hide" id="validarnombcompl" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 container">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">OFICINA</legend>
                            <div class="col-xl-12 row">
                                <div class="col-xl-4" id="nueperm">

                                </div>
                                <input id="idoficent" hidden/>
                                <div class="col-xl-8">
                                    <label for="descent">ENTIDAD
                                        <req>*</req>
                                    </label>
                                    <input id="descent" type="text" class="form-control typeahead" disabled
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                    />
                                    <div class="hide" id="validardescent" ></div>
                                    <!--<div class="row">
                                         <div class="col-xl-6">
                                             <br>
                                             <label for="codofic">CODIGO
                                                 <req>*</req>
                                             </label>
                                             <input id="codofic" type="text" class="form-control" disabled
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                             />
                                             <div class="hide" id="validarcodofic" ></div>
                                         </div>
                                         <div class="col-xl-6">
                                             <br>
                                             <label for="nombofic">OFICINA
                                                 <req>*</req>
                                             </label>
                                             <input id="nombofic" type="text" class="form-control" disabled
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                             />
                                             <div class="hide" id="validarnombofic" ></div>
                                         </div>
                                     </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarusuofic" class="btn btn-success " title="click para agregar usuario a oficina
                    " onclick="enviarUsuOfic()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR USUARIO OFICINA---------------------------------------->


<!----------------------------------------INICIO MODAL EDITAR USUARIO OFICINA---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_usuofic">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR USUARIO OFICINA-ESTABLECIMIENTO-RED</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input id="iduoficedit" hidden/>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row">
                        <input id="idusofiedit" hidden/>
                        <input id="idusofedit" hidden/>
                        <div class="col-xl-12">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">USUARIO</legend>
                            <div class="col-xl-12">
                                <label for="userrefedit">USUARIO
                                    <req>*</req>
                                </label>
                                <input id="userrefedit" type="text" class="form-control form-control-sm typeahead"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                />
                                <div class="hide" id="validaruserrefedit" ></div>
                            </div>
                            <div class="col-xl-12 row">
                                <div class="col-xl-6">
                                    <br>
                                    <label for="dniedit">DNI
                                        <req>*</req>
                                    </label>
                                    <input id="dniedit" type="text" class="form-control" disabled
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                    />
                                    <div class="hide" id="validardniedit" ></div>
                                </div>
                                <div class="col-xl-6">
                                    <br>
                                    <label for="nombcompledit">NOMBRE DE USUARIO
                                        <req>*</req>
                                    </label>
                                    <input id="nombcompledit" type="text" class="form-control" disabled
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 container">
                            <input id="idofiperm" hidden/>
                            <input id="idpermedit" hidden/>
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">OFICINA</legend>
                            <div class="col-xl-12 row">
                                <div class="col-xl-4" id="nuepermedit">

                                </div>
                                <input id="idoficentedit" hidden/>
                                <div class="col-xl-8">
                                    <label for="descentedit">ENTIDAD
                                        <req>*</req>
                                    </label>
                                    <input id="descentedit" type="text" class="form-control typeahead" disabled
                                           onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                    />
                                    <div class="hide" id="validardescentedit" ></div>
                                    <!--<div class="row">
                                        <div class="col-xl-6">
                                            <br>
                                            <label for="codoficedit">CODIGO
                                                <req>*</req>
                                            </label>
                                            <input id="codoficedit" type="text" class="form-control" disabled
                                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                            />
                                            <div class="hide" id="validarcodoficedit" ></div>
                                        </div>
                                        <div class="col-xl-6">
                                            <br>
                                            <label for="nomboficedit">OFICINA
                                                <req>*</req>
                                            </label>
                                            <input id="nomboficedit" type="text" class="form-control" disabled
                                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                            />
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarusuoficedit" class="btn btn-success " title="click para editar usuario a oficina
                    " onclick="enviarUsuOficEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR USUARIO OFICINA---------------------------------------->
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
            $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/referencias/asignarpermisosref.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
