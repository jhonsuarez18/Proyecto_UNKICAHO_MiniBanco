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
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<br>
<br>
<div id="response">

    <!-- final cabecera -->

    <input id="idvi" value="{{$vi}}" hidden>
    <div class="row">
        <!---------------------------------------- begin panel CHOFER ------------------------------------->
        <div class="col-xl-12">
            <h1 class="page-header">Chofer
                <small>Aqui puedo agregar al chofer</small>
            </h1>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h1 class="panel-title">CHOFER</h1>
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
                    <!--<legend class="m-b-15">AGREGAR CHOFER

                    </legend>-->
                    <div class="col-xl-12">
                        <button id="addChofer" class="btn btn-success " title="click para agregar Chofer"
                                data-toggle="modal" data-target="#modal_dialog_add_chofer">
                            <i class="fas fa-lg fa-fw m-r-10 fa-plus-circle"></i>Agregar Chofer
                        </button>
                    </div>

                </div>
                <div class="col-xl-12 col-sm-12 col-xs-12  ">
                    <div id="data-table-fixed-header_wrapper"
                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tabla_Chofer"
                                       class="table table-striped  table-bordered dataTable no-footer dtr-inline"
                                       role="grid"
                                       aria-describedby="data-table-fixed-header_info" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            NOMBRES COMPLETOS
                                        </th>
                                        <th>
                                            DNI
                                        </th>
                                        <th>
                                            TIPO PERS.
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
        <!----------------------------------------End Panel CHOFERL---------------------------------------->

    </div>
</div>
<!----------------------------------------INICIO MODAL AGREGAR CHOFER---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_add_chofer">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AGREGAR CHOFER</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS PERSONA
                        (
                        <req>*</req>
                        <small>Dato obligatorio</small>)
                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idpersonc"hidden/>
                        <div class="col-xl-6 ">
                            <label for="tipdocc">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="tipdocc">
                                <option selected value="0">SELECCIONE</option>
                                <option value="1">DNI</option>
                                <option value="2">CARNET EXTRANJERIA</option>
                                <option value="3">OTROS</option>
                            </select>
                            <div id="validtipodocc"></div>
                        </div>

                        <div class="col-xl-6 ">
                            <label for="dnic">N&#35; DOC
                                <req>*</req>
                            </label>
                            <input id="dnic" type="number" class="form-control form-control-sm" autocomplete="off"
                                   onchange="validDni()" disabled/>
                            <div class="hide " id="validDnic"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="appaternoc">APPATERNO
                                <req>*</req>
                            </label>
                            <input id="appaternoc" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valappaternoc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="apmaternoc">APMATERNO
                                <req>*</req>
                            </label>
                            <input id="apmaternoc" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valapmaternoc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="pnombrec">PNOMBRE
                                <req>*</req>
                            </label>
                            <input id="pnombrec" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valpnombrec"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="snombrec">SNOMBRE</label>
                            <input id="snombrec" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valsnombrec"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="fecnacc">FECNAC
                                <req>*</req>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="fecnacc" autocomplete="off">
                            <div class="hide " id="valfecnacc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="telefoc">TELEFONO
                            </label>
                            <input id="telefoc" type="number" class="form-control form-control-sm"
                                   onchange="validCelular('telefoc','valtelefoc','enviarchofer')"
                                   autocomplete="off"/>
                            <div class="" id="valtelefoc"></div>
                        </div>
                        <hr>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION DNI

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <label for="deparc">DEPARTAMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="deparc">
                                <option selected>AMAZONAS</option>
                            </select>
                            <div class="hide " id="valdeparc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="provc">PROVINCIA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="provc" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valprovc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="disc">DISTRITO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="disc" disabled>
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valdisc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <input type="text" id="idcentpc" value="0" hidden/>
                            <label for="cenpoc">CENTRO POBLADO</label>
                            <input type="text" class="form-control form-control-sm typeahead" id="cenpoc"
                                   name="cenpo" autocomplete="off">
                            <div class="hide " id="valcenpoc"></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="refc">REFERENCIA DE UBICACION</label>
                            <input id="refc" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valrefc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="dirc">DIRECCION
                            </label>
                            <input id="dirc" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valdirc"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <select class="form-control form-control-sm" id="tippersc" disabled hidden>

                            </select>
                            <div class="hide" id="validartippersc" ></div>
                        </div>
                        <div class="col-xl-6">
                            <input id="colegc" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off" hidden
                            />
                            <div class="hide " id="valcolegc"></div>
                        </div>
                        <div class="col-xl-6">
                            <input id="especc" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off" hidden
                            />
                            <div class="hide " id="valespecc"></div>
                        </div>
                    </div>
                    <div class="col-xl-12 container">
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ENTIDAD</legend>
                        <hr>
                        <div class="row">
                            <div class="col-xl-4" id="nuepermc">

                            </div>
                            <input id="idoficentc" hidden/>
                            <div class="col-xl-8">
                                <!--<label for="descentc">ENTIDAD
                                    <req>*</req>
                                </label>-->
                                <input id="descentc" type="text" class="form-control typeahead" disabled
                                       placeholder="Ingrese la entidad"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                />
                                <div class="hide" id="validardescentc" ></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarchofer" class="btn btn-success " title="click para agregar Chofer
                    " onclick="enviarChofer()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL AGREGAR CHOFER---------------------------------------->

<!----------------------------------------INICIO MODAL EDITAR CHOFER---------------------------------------->
<div class="col-xl-12">
    <div class="modal fade" id="modal_dialog_edit_chofer">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR CHOFER</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS PERSONA
                        (
                        <req>*</req>
                        <small>Dato obligatorio</small>)
                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <input type="text" id="idpersoneditc"hidden/>
                        <input type="text" id="idpersacteditc"hidden/>
                        <div class="col-xl-6 ">
                            <label for="tipdoceditc">TIPO DOCUMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="tipdoceditc">
                                <option selected value="0">SELECCIONE</option>
                                <option value="1">DNI</option>
                                <option value="2">CARNET EXTRANJERIA</option>
                                <option value="3">OTROS</option>
                            </select>
                            <div id="validtipodoceditc"></div>
                        </div>

                        <div class="col-xl-6 ">
                            <label for="dnieditc">N&#35; DOC
                                <req>*</req>
                            </label>
                            <input id="dnieditc" type="number" class="form-control form-control-sm" autocomplete="off"
                                   onchange="validDni()" disabled/>
                            <div class="hide " id="validDnieditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="appaternoeditc">APPATERNO
                                <req>*</req>
                            </label>
                            <input id="appaternoeditc" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valappaternoeditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="apmaternoeditc">APMATERNO
                                <req>*</req>
                            </label>
                            <input id="apmaternoeditc" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valapmaternoeditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="pnombreeditc">PNOMBRE
                                <req>*</req>
                            </label>
                            <input id="pnombreeditc" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valpnombreeditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="snombreeditc">SNOMBRE</label>
                            <input id="snombreeditc" type="text" class="form-control form-control-sm" autocomplete="off"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valsnombreeditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="fecnaceditc">FECNAC
                                <req>*</req>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="fecnaceditc" autocomplete="off">
                            <div class="hide " id="valfecnaceditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="telefoeditc">TELEFONO
                            </label>
                            <input id="telefoeditc" type="number" class="form-control form-control-sm" onchange="validarCelular()"
                                   autocomplete="off"/>
                            <div class="" id="valtelefoeditc"></div>
                        </div>
                        <hr>

                    </div>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">DATOS UBICACION DNI

                    </legend>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                        <div class="col-xl-6 ">
                            <input type="text" id="sitic"hidden/>
                            <label for="depareditc">DEPARTAMENTO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="depareditc">
                                <option selected>AMAZONAS</option>
                            </select>
                            <div class="hide " id="valdepareditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="proveditc">PROVINCIA
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="proveditc">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valproveditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="diseditc">DISTRITO
                                <req>*</req>
                            </label>
                            <select class="form-control form-control-sm" id="diseditc">
                                <option selected value="0">SELECCIONE</option>
                            </select>
                            <div class="hide " id="valdiseditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <input type="text" id="idcentpeditc"hidden/>
                            <label for="cenpoeditc">CENTRO POBLADO</label>
                            <input type="text" class="form-control form-control-sm typeahead" id="cenpoeditc"
                                   name="cenpo" autocomplete="off">
                            <div class="hide " id="valcenpoeditc"></div>
                        </div>
                        <div class="col-xl-12">
                            <label for="refeditc">REFERENCIA DE UBICACION</label>
                            <input id="refeditc" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valrefeditc"></div>
                        </div>
                        <div class="col-xl-6 ">
                            <label for="direditc">DIRECCION
                            </label>
                            <input id="direditc" type="text" class="form-control form-control-sm"
                                   onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                            <div class="hide " id="valdireditc"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <input type="text" id="idpersonaleditc"hidden/>
                            <select class="form-control form-control-sm" id="tipperseditc" disabled hidden>

                            </select>
                            <div class="hide" id="validartipperseditc" ></div>
                        </div>
                        <div class="col-xl-6">
                            <input id="colegeditc" type="text" class="form-control form-control-sm" hidden
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                            />
                            <div class="hide " id="valcolegeditc"></div>
                        </div>
                        <div class="col-xl-6">
                            <input id="especeditc" type="text" class="form-control form-control-sm" hidden
                                   onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                            />
                            <div class="hide" id="valespeceditc" ></div>
                        </div>
                    </div>
                    <div class="col-xl-12 container">
                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse py-3">ENTIDAD</legend>
                        <hr>
                        <div class="row">
                            <div class="col-xl-4" id="nuepermeditc">

                            </div>
                            <input id="idoficenteditc" hidden/>
                            <div class="col-xl-8">
                                <!--<label for="descenteditc">ENTIDAD
                                    <req>*</req>
                                </label>-->
                                <input id="descenteditc" type="text" class="form-control typeahead"
                                       placeholder="Ingrese la entidad"
                                       onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off"
                                />
                                <div class="hide" id="validardescenteditc" ></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-12 col-sm-12 col-xs-12 text-center">
                        <hr>
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-lg fa-fw m-r-10 fa-times"></i>Cancelar</a>
                        <button id="enviarchoferedit" class="btn btn-success " title="click para agregar chofer
                    " onclick="enviarChoferEdit()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Editar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------FIN MODAL EDITAR CHOFER---------------------------------------->


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
            $.getScript('../js/intranet/combustible/agregarchofer.js'),
            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
        )
    });


</script>
