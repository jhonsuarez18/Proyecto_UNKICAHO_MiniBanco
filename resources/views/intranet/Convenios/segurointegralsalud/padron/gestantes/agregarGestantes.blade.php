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
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<br>
<br>
<div id="response">

    <!-- final cabecera -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">

            <h1 class="panel-title">AGREGAR GESTANTE </h1>
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
            <legend class="m-b-15">DATOS PERSONA <a href="#" class="btn btn-success btn-icon btn-circle btn-sm" title="Recagar pantalla" id="recargarpant">
                    <i class="fa fa-redo"></i>
                </a></legend>
            <input id="idpersona" hidden>
            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <div class="col-xl-3 ">
                    <label for="tipdoc">TIPO DOCUMENTO</label>
                    <select class="form-control" id="tipdoc">
                        <option selected value="0">SELECCIONE</option>
                        <option value="1">DNI</option>
                        <option value="2">CARNET EXTRANJERIA</option>
                        <option value="3">OTROS</option>
                    </select>
                    <div id="validtipodoc"></div>
                </div>

                <div class="col-xl-3 ">
                    <label for="dni">N° DOC</label>
                    <input id="dni" type="number" class="form-control  " autocomplete="off"
                           onchange="validarDniExpress()" disabled/>
                    <div class="hide " id="validDni"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="appaterno">APPATERNO</label>
                    <input id="appaterno" type="text" class="form-control" autocomplete="off"/>
                    <div class="hide " id="valappaterno"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="apmaterno">APMATERNO</label>
                    <input id="apmaterno" type="text" class="form-control" autocomplete="off"/>
                    <div class="hide " id="valapmaterno"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="pnombre">PNOMBRE</label>
                    <input id="pnombre" type="text" class="form-control " autocomplete="off"/>
                    <div class="hide " id="valpnombre"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="snombre">SNOMBRE</label>
                    <input id="snombre" type="text" class="form-control" autocomplete="off"/>
                    <div class="hide " id="valsnombre"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecnac">FECNAC</label>
                    <input type="text" class="form-control" id="fecnac" autocomplete="off">
                    <div class="hide " id="valfecnac"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="telefo">TELEFONO</label>
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
                    <label for="depar">DEPARTAMENTO</label>
                    <select class="form-control" id="depar" >
                        <option selected>AMAZONAS</option>
                    </select>
                    <div class="hide " id="valdepar"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="prov">PROVINCIA</label>
                    <select class="form-control" id="prov" disabled>
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div class="hide " id="valprov"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="dis">DISTRITO</label>
                    <select class="form-control" id="dis" disabled>
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div class="hide " id="valdis"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="dir">DIRECCION</label>
                    <input id="dir" type="text" class="form-control "/>
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
                    <input id="ref" type="text" class="form-control"/>
                </div>
                <div class="col-xl-3 ">
                    <label for="etnia">ETNIA</label>
                    <select id="etnia" class="form-control">
                        <option selected value="0">SELECCIONE</option>
                        <option >MESTIZO</option>
                        <option >AWAJUM</option>
                        <option >WAMPIS</option>
                        <option >OTRO</option>
                    </select>
                    <div id="etniaval"></div>
                </div>
            </div>
            <br>
            <div class="col-xl-12 col-sm-12 col-xs-12 row">
                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ESTABLECIMIENTO DONDE SE
                    ATIENDE
                </legend>
                <div class="col-xl-3 ">
                    <label for="depar">DEPARTAMENTO</label>
                    <select class="form-control" id="depar" disabled>
                        <option selected>AMAZONAS</option>
                    </select>
                </div>
                <div class="col-xl-3 ">
                    <label for="provacte">PROVINCIA</label>
                    <select id="provacte" class="form-control">
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div id="valprovacte"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="disacte">DISTRITO</label>
                    <select id="disacte" class="form-control" disabled>
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div id="valdisacte"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="estate">ESTABLECIMIENTO</label>
                    <select id="estate" class="form-control" disabled>
                        <option selected value="0">SELECCIONE</option>
                    </select>
                    <div id="valestate"></div>
                </div>
            </div>
            <br>
            <legend class="m-b-15">DATOS ADICIONALES</legend>

            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <div class="col-xl-3 ">
                    <label for="nrohistoria">N° HISTORIA</label>
                    <input id="nrohistoria" type="text" class="form-control "/>
                    <div class="hide " id="valnrohistoria"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="tipseg">TIPO SEGURO</label>
                    <select id="tipseg" class="form-control">
                        <option selected value="0">SELECCIONE</option>
                        <option>SIS</option>
                        <option>ESSASLUD</option>
                        <option>SANIDAD</option>
                        <option>PRIVADO</option>
                        <option>NO TIENE</option>
                    </select>
                    <div id="valtipseg"></div>
                </div>

                <div class="col-xl-4 ">
                    <label for="nivinstr">NIVEL DE INSTRUCCION</label>
                    <select id="nivinstr" class="form-control">
                        <option selected value="0">SELECCIONE</option>
                        <option>ANALFABETO</option>
                        <option>PRIMARIA COMPLETA</option>
                        <option>PRIMARIA INCOMPLETA</option>
                        <option>SECUNDARIA COMPLETA</option>
                        <option>SECUNDARIA INCOMPLETA</option>
                        <option>SUPERIOR NO UNIVERSITARIA COMPLETA</option>
                        <option>SUPERIOR NO UNIVERSITARIA INCOMPLETA</option>
                        <option>SUPERIOR UNIVERSITARIA COMPLETA</option>
                        <option>SUPERIOR UNIVERSITARIA INCOMPLETA</option>
                    </select>
                    <div id="valnivinstr"></div>
                </div>

                <div class="col-xl-3 ">
                    <label for="idiom">IDIOMA</label>
                    <select id="idiom" class="form-control">
                        <option selected value="0">SELECCIONE</option>
                        <option>ESPAÑOL</option>
                        <option>AWAJUM</option>
                        <option>WAMPIS</option>
                        <option>OTROS</option>
                    </select>
                    <div id="validiom"></div>
                </div>

                <div class="col-xl-3 ">
                    <label for="estaciv">ESTADO CIVIL</label>
                    <select id="estaciv" class="form-control">
                        <option selected value="0">SELECCIONE</option>
                        <option>SOLTERA</option>
                        <option>CONVIVIENTE</option>
                        <option>CASADA</option>
                        <option>DICORCIADA</option>
                        <option>VIUDA</option>
                    </select>
                    <div id="valestaciv"></div>
                </div>
            </div>
            <br>
            <legend class="m-b-15">FORMULA OBSTETRICA</legend>

            <div class="col-xl-12 col-sm-12 col-xs-12 row ">

                <div class="col-xl-3 ">
                    <label for="gest">GESTA </label>
                    <input id="gest" type="text" class="form-control "/>
                    <div id="valgest"></div>

                </div>
                <div class="col-xl-3 ">
                    <label for="pari">PARIDAD</label>
                    <input id="pari" type="text" class="form-control "/>
                    <div id="valpari"></div>

                </div>

            </div>
            <legend class="m-b-15">DATOS EMBARAZO</legend>

            <div class="col-xl-12 col-sm-12 col-xs-12 row ">
                <div class="col-xl-3 ">
                    <label for="fecregla">FECHA ULTIMA REGLA</label>
                    <input type="text" class="form-control " id="fecregla" onchange="fechaultimaRegla()"
                           autocomplete="off">
                    <div id="valfecregla"></div>
                </div>
                <div class="col-xl-3 ">
                    <label for="fecpart">FECHA PROBABLE PARTO </label>
                    <input id="fecpart" type="text" class="form-control " disabled/>
                </div>

            </div>
            <div class="col-xl-12 text-center">
                <hr>
                <button class="btn btn-danger" title="click para salir
                    " href="/gestante/reportar" data-toggle="ajax"><i class="fas fa-lg fa-fw m-r-10  fa-arrow-left"></i>Salir
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
            $.getScript('../js/intranet/gestantes/agregarGestante.js'),

            $.Deferred(function (deferred) {
                $(deferred.resolve);
            })
    });
</script>
