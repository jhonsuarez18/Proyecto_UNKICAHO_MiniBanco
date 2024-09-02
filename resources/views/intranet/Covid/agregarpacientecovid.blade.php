<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme"/>
<script src="../js/typeahead/bootstrap3-typeahead.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
<!-- ================== END BASE CSS STYLE ================== -->
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!--<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>-->
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
            @if($idpaciente==0)
                <h1 class="panel-title">AGREGAR TRABAJADOR </h1>
            @else
                <h1 class="panel-title">AGREGAR CONTACTO TRABAJADOR </h1>
            @endif

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
            <legend class="m-b-15">DATOS PERSONA <a href="#" class="btn btn-success btn-icon btn-circle btn-sm"
                                                    title="Recagar pantalla" id="recargarpant">
                    <i class="fa fa-redo"></i>
                </a> (
                <req>*</req>
                <small>Dato obligatorio</small>)
            </legend>
            <input id="idpersona" hidden>
            <input id="idpaciente" value="{{$idpaciente}}" hidden>
            <input id="idcontactovisita" value="{{$idcontactovisita}}" hidden>
            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <div class="col-xl-3 ">
                    <label for="tipdoc">TIPO DOCUMENTO
                        <req>*</req>
                    </label>
                    <select class="form-control" id="tipdoc">
                        <option selected value="0">SELECCIONE</option>
                        <option value="1">DNI</option>
                        <option value="2">CARNET EXTRANJERIA</option>
                        <option value="3">OTROS</option>
                    </select>
                    <div id="validtipodoc"></div>
                </div>

                <div class="col-xl-3 ">
                    <label for="dni">N&#35; DOC
                        <req>*</req>
                    </label>
                    <input id="dni" type="number" class="form-control  " autocomplete="off"
                           onchange="validarDniExpress()" disabled/>
                    <div class="hide " id="validDni"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="appaterno">APPATERNO
                        <req>*</req>
                    </label>
                    <input id="appaterno" type="text" class="form-control" autocomplete="off"
                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                    <div class="hide " id="valappaterno"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="apmaterno">APMATERNO
                        <req>*</req>
                    </label>
                    <input id="apmaterno" type="text" class="form-control" autocomplete="off"
                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                    <div class="hide " id="valapmaterno"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="pnombre">PNOMBRE
                        <req>*</req>
                    </label>
                    <input id="pnombre" type="text" class="form-control " autocomplete="off"
                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                    <div class="hide " id="valpnombre"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="snombre">SNOMBRE</label>
                    <input id="snombre" type="text" class="form-control" autocomplete="off"
                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                    <div class="hide " id="valsnombre"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecnac">FECNAC
                        <req>*</req>
                    </label>
                    <input type="text" class="form-control" id="fecnac" autocomplete="off">
                    <div class="hide " id="valfecnac"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="telefo">TELEFONO
                        <req>*</req>
                    </label>
                    <input id="telefo" type="number" class="form-control" onchange="validarCelular()"
                           autocomplete="off"/>
                    <div class="" id="telefovalid"></div>
                </div>
                <hr>

            </div>
            <br>
            <legend class="m-b-15">UBICACION</legend>

            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS UBICACION DNI</legend>
                <div class="col-xl-3 ">
                    <label for="depar">DEPARTAMENTO
                        <req>*</req>
                    </label>
                    <select class="form-control" id="depar">
                        <option selected>AMAZONAS</option>
                    </select>
                    <div class="hide " id="valdepar"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="prov">PROVINCIA
                        <req>*</req>
                    </label>
                    <select class="form-control" id="prov" disabled>
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div class="hide " id="valprov"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="dis">DISTRITO
                        <req>*</req>
                    </label>
                    <select class="form-control" id="dis" disabled>
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div class="hide " id="valdis"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="dir">DIRECCION
                        <req>*</req>
                    </label>
                    <input id="dir" type="text" class="form-control "
                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                    <div id="dirval"></div>
                </div>

                <div class="col-xl-3 ">
                    <label for="cenpo">CENTRO POBLADO</label>
                    <input type="text" class="form-control m-b-5 typeahead" id="cenpo"
                           name="cenpo" autocomplete="off">
                    <div id="cenpoval"></div>
                </div>
                <script>
                    $('#cenpo').typeahead({
                        name: 'data',
                        displayKey: 'name',
                        source: function (query, process) {
                            $.ajax({
                                url: "/cepo",
                                type: 'GET',
                                data: 'query=' + query,
                                dataType: 'JSON',
                                async: 'false',
                                success: function (data) {
                                    bondObjs = {};
                                    bondNames = [];
                                    $.each(data, function (i, item) {
                                        bondNames.push({id: item.idCentroPoblado, name: item.Descripcion});
                                        bondObjs[item.id] = item.idCentroPoblado;
                                        bondObjs[item.name] = item.Descripcion;
                                    });
                                    process(bondNames);
                                }
                            });
                        }
                    });
                </script>
                <div class="col-xl-6">
                    <label for="ref">REFERENCIA DE UBICACION</label>
                    <input id="ref" type="text" class="form-control"
                           onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                </div>

            </div>
            <br>
            <legend class="m-b-15">DATOS ADICIONALES</legend>

            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <div id="publi" class="col-xl-12 col-sm-12 col-xs-12 row" hidden>
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">LUGAR DE DETECCION</legend>
                    <div class="col-xl-3 ">
                        <label for="provcon">PROVINCIA
                            <req>*</req>
                        </label>
                        <select class="form-control" id="provcon">
                            <option selected value="0">SELECCIONE</option>
                        </select>
                        <div class="hide " id="valprovcon"></div>
                        <input type="text" id="idprovcon" value="" hidden/>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="discon">DISTRITO
                            <req>*</req>
                        </label>
                        <select class="form-control" id="discon">
                            <option selected value="0">SELECCIONE</option>
                        </select>
                        <div class="hide " id="valdiscon"></div>
                        <input type="text" id="iddiscon" value="" hidden/>
                    </div>
                </div>
                <div id="trabajo" class="col-xl-12 col-sm-12 col-xs-12 row">
                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">LUGAR DE TRABAJO</legend>

                    <div class="col-xl-3 ">
                        <label for="provcon">PROVINCIA
                            <req>*</req>
                        </label>
                        <select class="form-control" id="provcon" DISABLED>
                            <option selected value="1" >CHACHAPOYAS</option>
                        </select>
                        <div class="hide " id="valprovcon"></div>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="discon">DISTRITO
                            <req>*</req>
                        </label>
                        <select class="form-control" id="discon" disabled>
                            <option selected value="1">CHACHAPOYAS</option>
                        </select>
                        <div class="hide " id="valdiscon"></div>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="lugtra">LUGAR DE TRABAJO
                            <req>*</req>
                        </label>
                        <select class="form-control" id="lugtra" disabled>
                            <option selected value="1">DIRESA</option>
                        </select>
                        <div class="hide " id="vallugtra"></div>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="ofici">OFICINA
                            <req>*</req>
                        </label>
                        <select class="form-control" id="ofici" >
                            <option selected value="0">SELECCIONE</option>
                        </select>
                        <div class="hide " id="valofici"></div>
                    </div>
                    <div class="col-xl-3 " hidden>
                        <label for="dircon">DIRECCION</label>
                        <input id="dircon" type="text" class="form-control "
                               onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                        <div id="dirvalcon"></div>
                    </div>

                    <div class="col-xl-3 " hidden>
                        <label for="cenpocont">CENTRO POBLADO</label>
                        <input type="text" class="form-control m-b-5 typeahead" id="cenpocont" name="cenpocont"
                               autocomplete="off" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <div id="valcenpocont"></div>
                    </div>
                    <script>
                        $('#cenpocont').typeahead({
                            name: 'data',
                            displayKey: 'name',
                            source: function (query, process) {
                                $.ajax({
                                    url: "/cepo",
                                    type: 'GET',
                                    data: 'query=' + query,
                                    dataType: 'JSON',
                                    async: 'false',
                                    success: function (data) {
                                        bondObjs = {};
                                        bondNames = [];
                                        $.each(data, function (i, item) {
                                            bondNames.push({id: item.idCentroPoblado, name: item.Descripcion});
                                            bondObjs[item.id] = item.idCentroPoblado;
                                            bondObjs[item.name] = item.Descripcion;
                                        });
                                        process(bondNames);
                                    }
                                });
                            }
                        });
                    </script>
                </div>


                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">DATOS ADICIONALES</legend>
                <div class="col-xl-3 ">
                    <label for="fecdiag">FEC DIAGNOSTICO</label>
                    <input type="text" class="form-control" id="fecdiag" autocomplete="off">
                    <div class="hide " id="valfecdiag"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecsinini">FEC SINTOMAS INICIALES</label>
                    <input type="text" class="form-control" id="fecsinini" autocomplete="off"
                           onkeyup="javascript:this.value=this.value.toUpperCase();">
                    <div class="hide " id="valfecsinini"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="estprueb">ESTADO PRUEBA
                        <req>*</req>
                    </label>
                    <select class="form-control" id="estprueb">
                        <option value="0" selected>NEGATIVO</option>
                        <option value="1">SOSPECHOSO</option>
                        <option value="2">POSITIVO PRUEBA RAPIDA</option>
                        <option value="3">POSITIVO PRUEBA MOLECULAR</option>

                    </select>
                    <div class="hide " id="valestprueb"></div>
                </div>

                <div class="col-xl-3 ">
                    <label for="morbilidad">MORBILIDAD</label>
                    <div class="input-group">
                        <input type="text" id="morbilidad" name="contacto" class="form-control" value=""
                               onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <script>
                            $('#morbilidad').typeahead({
                                name: 'data',
                                displayKey: 'name',
                                source: function (query, process) {
                                    $.ajax({
                                        url: "/covid/morbili",
                                        type: 'GET',
                                        data: 'query=' + query,
                                        dataType: 'JSON',
                                        async: 'false',
                                        success: function (data) {
                                            bondObjs = {};
                                            bondNames = [];
                                            $.each(data, function (i, item) {
                                                bondNames.push({id: item.idMorbilidad, name: item.descripcion});
                                                bondObjs[item.id] = item.idMorbilidad;
                                                bondObjs[item.name] = item.descripcion;
                                            });
                                            process(bondNames);
                                        }
                                    });
                                }
                            });
                        </script>
                        <span class="input-group-append">
											<a href="#" onclick="" class="input-group-text" style="text-decoration:none"
                                               title="Agregar morbilidad" id="addmorbilidad"><i
                                                    class="fa fa-plus"></i></a>
                            </span>
                    </div>
                    <label for="morbilidad">LISTA DE MORBILIDAD</label>
                    <div class="input-group">
                        <ol id="lista">
                        </ol>

                    </div>
                </div>
            </div>
            <br>
            <div class="col-xl-12 text-center">
                <hr>
                <button class="btn btn-danger" title="click para salir
                    " href="/covid/reporte" data-toggle="ajax"><i class="fas fa-lg fa-fw m-r-10  fa-arrow-left"></i>Salir
                </button>
                <button id="enviar" class="btn btn-success " title="click para agregar usuario
                    " onclick="enviar()"><i class="fas fa-lg fa-fw m-r-10 fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.js')}}"></script>
<script>
    $.when(
        $.getScript('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'),
    ).done(function () {
        $.getScript('../js/intranet/util.js'),
            $.getScript('../js/intranet/covid/agregarsospechoso.js'),

            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
    });
</script>
