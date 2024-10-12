<?php

use App\Exports\EjecutoraExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/excel', function () {
    return Excel::download(new EjecutoraExport(), 'products.xlsx');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//pagina de inicio*/
/*Route::get('/', function () {
    return view('estamostrabajando');
});
*/

Route::get('/', function () {
    // return view('index');
    return view('layouts.app');
});

Route::get('/reparando', function () {
    return view('estamostrabajando');
});
Route::get('/inicio', function () {
    return view('intranet.inicio');
});
Route::get('/convenio_sis', function () {
    return view('paginainformativa.convenios.segurointegralsalud.convenio_sis');
});
Route::get('/vacunacovid', function () {
    return view('paginainformativa.convenios.segurointegralsalud.vacunacovid');
});
Route::get('/ubicacion', function () {
    return view('paginainformativa.convenios.segurointegralsalud.ubicacion');
});
Route::get('/institucional', function () {
    return view('paginainformativa.convenios.segurointegralsalud.institucional');
});
Route::get('/reporte', function () {
    return view('paginainformativa.convenios.segurointegralsalud.reporteador');
});

Route::get('/getOpc', 'SOpcionController@getOpc');

//rutas para obtener indicadores sisFisal inicio
Route::get('/indicadores_sis', 'IndicadoresSisController@notas');
Route::get('/indicadoresInfor/{id}', 'IndicadoresSisController@verInfoIndicadores');
Route::get('/indicadordona/{id}', 'IndicadoresSisController@obtenerDona');
Route::get('/indicadordonaRegional/{id}', 'IndicadoresSisController@obtenerDonaRegional');
Route::get('/indicadordonaEjecutora/{idindicador}/{codejecutora}', 'IndicadoresSisController@obtenerGraficoRegional');

Route::get('/excelEjecutora/{codEje}/{tipExportar}', 'ExcelController@indicadoresExcel');
Route::get('/reporteindicadormeses/{codindi}', 'IndicadoresSisController@obtenerReporteMesesIndicador');
Route::get('/reporteindicadorejecumetalogro/{mes}/{cod}', 'IndicadoresSisController@obtenerReporteeEjecuMetaLogro');
Route::get('/reporteindicadorejecutoratodosmeses/{ejecutora}/{codigo}', 'IndicadoresSisController@obtenerIndicadorEjecutora');

//rutas para obtener indicadores sisFisal final

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

///////rutas intranet
/// rutas para modificar o cambiar comentarios indicadores sis
Route::get('/reportesis', function () {
    return view('intranet.Convenios.segurointegralsalud.reporteador');
});
route::post('/cambiarcomentario', 'IndicadoresSisController@modificarComentario');

Route::get('/obtenerespuesta/{indi}/{fech}', 'IndicadoresSisController@obtenerRespuesta');
route::post('/ingresarrespuesta', 'IndicadoresSisController@ingresarRepuesta');

///////////////// usuario//////////////////
Route::get('/usuario', 'UsuarioController@index');
Route::get('/pruebaPermisos', 'UsuarioController@cargarPanel');
Route::get('/obtenerpermisos/{id}', 'UsuarioController@obtenerPermisos');
Route::get('/cambiarpermiso/{array}', 'UsuarioController@cambiarPermiso');
///////////////// error //////////////////
Route::get('/error', 'SErrorController@index');
Route::get('/errores', 'SErrorController@getErrores');
Route::get('/deleteError/{id}', 'SErrorController@destroy');

Route::get('/comentario/{cod}/{fecha}', 'IndicadoresSisController@obtenerComentarios');

Route::get('/usuarios', 'UsuarioController@reportarUsuario');
Route::get('/getUserDni/{id}', 'UsuarioController@getUsuarioDni');
Route::get('/registrarusuarios', 'UsuarioController@registrar');
Route::get('/rolesUsuario', 'UsuarioController@obtenerRoles');
Route::get('/insertarusuario', 'UsuarioController@insertarUsuario');
Route::post('/updateuser', 'UsuarioController@update');
Route::get('/usuarioeditar/{id}', 'UsuarioController@mostrarEditarUsuario');
Route::get('/getEditUs/{id}', 'UsuarioController@getEditUser');
Route::post('/editarusuario', 'UsuarioController@editarUsuario');
Route::get('/eliminar/{id}', 'UsuarioController@eliminar');
Route::get('/validardni/{dni}', 'UsuarioController@validarUsuarioDni');


Route::post('/subir', 'UsuarioController@subirArchivo')->name('subir');

//////////////////excel ///////////////////////////////
//////////////Padron Gestantes ////////////////

Route::get('/vergestantes', 'GestanteController@verPadron');
Route::get('/agregargestante', 'GestanteController@verPadron');
///////////Ubicacion ////////////////
/// //provincia///
Route::get('/ubiprov/{iddep}', 'UbicacionController@obtenerProvincia');
//distrito///
Route::get('/ubidis/{idprov}', 'UbicacionController@obtenerDistrito');
//establecimiento//
Route::get('/ubiess/{iddis}', 'UbicacionController@obtenerEstablecimiento');
//centro poblado ///
Route::get('/cepo', 'UbicacionController@obtenerCentroPoblado');
Route::get('/getEstablecimientoFull', 'UbicacionController@getEstablecimientoFull');
//departamento
Route::get('/departamento', 'UbicacionController@obtenerDepartamentos');
Route::get('/ejecutoras', 'UbicacionController@obtenerEjecutoras');
Route::get('/prueba/{name}', 'UbicacionController@obtenerCentroPobladoNombre');
Route::get('/obtenerubicacion/{iddis}', 'UbicacionController@obtenerUbicacion');
///validacion
Route::get('/valdni/{dni}', 'PersonaController@validarDni');

Route::group(['prefix' => 'gestante'], function () {
    ////agergar gestantes
    Route::get('agregar', 'GestanteController@verAgregarGestante');
    Route::post('registrargestante', 'GestanteController@registrarGestante');
    Route::post('editargestante', 'GestanteController@editarGestante');
    ///
    Route::get('reportar', 'GestanteController@verPadron');
    Route::get('registraratencion/{array}', 'GestanteController@registrarAtencion');
    Route::get('modificarbvg/{array}', 'GestanteController@modificarVBG');
    Route::get('modificargs/{array}', 'GestanteController@modificarGS');
    Route::get('/control/{idgestante}', 'GestanteController@mostrarActividadesGestante');
    Route::get('cambiarestado/{idgestante}', 'GestanteController@cambiarEstadoPuerpera');
    Route::get('registrarparto/{array}', 'GestanteController@registrarParto');
    Route::get('cambiardatospuerperio/{array}', 'GestanteController@cambiarDatosPuerperio');
    Route::post('cambiardatosobservacion', 'GestanteController@cambiarObservaciones');

});

Route::get('/editarGestante/{idgestante}', 'GestanteController@verEditar');
// datat tables //
Route::get('/obtenergestante/{hist}/{dni}', 'GestanteController@obtenerGestantes');

Route::get('/obtenercontrolgestante/{idactividad}/{idgestante}', 'GestanteController@obtenerControlgestante');

Route::get('/obtenercontrolgestantedni/{dni}', 'GestanteController@obtenerGestanteDni');

//covid 19 //

Route::group(array('prefix' => 'covid', 'middleware' => 'auth'), function () {
    Route::get('/ReporteEpp', function () {
        return view('intranet.Covid.ReporteEpp');
    });
    Route::get('/verseguimientoCovid', 'covid19controller@seguimientoCovid');
    Route::get('/cambiarestado/{idpaciente}/{estado}', 'covid19controller@cambiarEstado');
    Route::get('/reportecovid/{idpaciente}', 'covid19controller@verruta');
    Route::get('/obtenerruta/{idpaciente}', 'covid19controller@obetnerMovimientos');
    Route::get('/reportepacientes', 'covid19controller@reportarPacienyeCovid');
    Route::get('/reporte', 'covid19controller@index');
    Route::get('/veragregarpacientecovid/{cvidContactoVisita}/{idpaciente}', 'covid19controller@mostrarRegistrarCovid');
    Route::get('/registrarpacientecovid', 'covid19controller@registrarPacienteCovid');
    Route::get('/mantenimientoTablasCovid', 'EppController@index');
    /// editar paciente
    Route::get('/vereditarpaciente/{idpaciente}', 'covid19controller@verEditarPacienteCovid');
    Route::get('/editarpacientecovid', 'covid19controller@editarPacienteCovid');
    Route::get('/agregarmorbilidad', 'covid19controller@agregarMorbilidad');
    Route::get('/eliminarmorbilidad', 'covid19controller@eliminarMorbilidad');
    /////
    Route::get('/registrarcontactopaciente', 'covid19controller@registrarContactoPaciente');
    Route::get('/registrarlugares', 'covid19controller@registrarLugaresPaciente');
    Route::get('/obtenerpacientecoviddni/{dni}', 'covid19controller@obtenerPacienteCovidDni');
    Route::get('/obtenerpacientecoviddidpaciente/{idpaciente}', 'covid19controller@obtenerPacienteCoviddIdPaciente');
    Route::get('/contactosidnetificados/{idpaciente}', 'covid19controller@contactosIdnetificados');
    Route::get('/morbili', 'covid19controller@autoCompletarMorbilidad');
    Route::get('/morbililista/{idpac}', 'covid19controller@obtenerMorbilidad');
    /// atenciones
    Route::get('/reportaratencionesdiariascovid/{fecha}', 'covid19controller@reportarAtencionesDiariasCovid');
    Route::get('/obtenersintomas', 'covid19controller@obtenerSintomas');
    Route::get('/obtenerEpps/{idpac}', 'covid19controller@obtenerEpps');
    Route::get('/getEppsUni/{idpac}', 'covid19controller@getEppsUni');
    Route::get('/getEpps', 'covid19controller@getEpps');
    Route::post('/registraatencion', 'covid19controller@registraAtencion');
    Route::get('/verhistorialclinico/{idpaciente}', 'covid19controller@verHistorialClinico');
    Route::get('/veratencionespaciente/{idpaciente}', 'covid19controller@verAtencionesPaciente');
    /// Reportes
    Route::get('/getreportentreeppgeneral', 'covid19controller@getreportentregaeppgeneral');
    Route::get('/getreportefechaentre/{fech}', 'covid19controller@getreportfechaentre');
    ///
    Route::get('/entregarepp/{idpaciente}', 'covid19controller@entregarEpp');
    Route::get('/crearentregaApp', 'covid19controller@crearEntregaApp');

    Route::get('/obtenerentregaepp/{idpaciente}', 'covid19controller@obtenerEntregaEpp');
    //MANTENIMIENTO DE TABLAS
        //EPP
        Route::get('/getEppss', 'EppController@getEppss');
        Route::get('/getMarcsAct', 'EppController@getMarcasAct');
        Route::post('/storeEpp', 'EppController@store');
        Route::post('/editEpp', 'EppController@update');
        Route::get('/deleteEpp/{id}', 'EppController@destroy');
        Route::get('/getEppEdit/{id}', 'EppController@getEppEdit');
        //SINTOMA
        Route::get('/getSintomas', 'SintomaController@getSintomas');
        Route::get('/getMarcsAct', 'SintomaController@getMarcasAct');
        Route::post('/storeSinto', 'SintomaController@store');
        Route::post('/editSinto', 'SintomaController@update');
        Route::get('/deleteSinto/{id}', 'SintomaController@destroy');
        Route::get('/getSintoEdit/{id}', 'SintomaController@getSintomaEdit');
        //ENTREGA EPP
        Route::get('/getEntregaEpps', 'EntregaEppController@getEntregaEpps');
        Route::post('/editEntreEpp', 'EntregaEppController@update');
        Route::get('/deleteEntreEpp/{id}', 'EntregaEppController@destroy');
        Route::get('/getEntreEppEdit/{id}', 'EntregaEppController@getEntreEppEdit');

});

Route::group(['prefix' => 'ubicacion'], function () {
    Route::get('/obteneroficinas', 'UbicacionController@obtenerOficinas');
});


Route::group(['prefix' => 'ubicacion'], function () {
    Route::get('/obteneroficinas', 'UbicacionController@obtenerOficinas');
});

Route::group(['prefix' => 'excel'], function () {
    Route::get('/obtenerAsistencia/{fecha}', 'ExcelController@imprimirAsistenciasDiarias');
    Route::get('/obtenerresumenpresupuestal', 'ExcelController@obtenerResumenPresupuestalExport');
    Route::get('/obtenerreportepresupuestaltransferencia', 'ExcelController@obtenerReportePresupuestalTransferenciaExport');
    Route::get('/obtenerReportepresupuestalprograma', 'ExcelController@obtenerReportePresupuestalProgramaExport');
    Route::get('/obtenerreportepresupuestalprogramatransferencia', 'ExcelController@obtenerReportePresupuestalProgramaTransferenciaExport');
    Route::get('/obtenerResumenporProgramaespecificaexport', 'ExcelController@obtenerResumenPorProgramaEspecificaExport');
    Route::get('/obtenerResumenPorEspecGas', 'ExcelController@obtenerResumenPorEspecGas');
    Route::get('/obtenerresumenpresupuestalceplan', 'ExcelController@obtenerResumenPresupuestalCeplanExport');
    Route::get('/obtenerresumenpresupuestaltrama', 'ExcelController@obtenerResumenPresupuestalTramaExport');
    Route::get('/obtenerresumenpresupuestalpedido', 'ExcelController@obtenerResumenPresupuestalPedidoExport');
    Route::get('/obtenerresumenvales', 'ExcelController@obtenerResumenValesExport');



});

Route::group(array('prefix' => 'presupuesto', 'middleware' => 'auth'), function () {


    Route::get('/gestion', function () {
        return view('intranet.ejecucionpresupuestal.gestion');
    })->name('asdsad');
    Route::get('/ejecucion', function () {
        return view('intranet.ejecucionpresupuestal.ejecucion');
    });
    Route::get('/agregarmeta', function () {
        return view('intranet.ejecucionpresupuestal.agregarmeta');
    });
    Route::get('/datosgenerales', function () {
        return view('intranet.ejecucionpresupuestal.datosgenerales');
    });
    Route::get('/transferencia', function () {
        return view('intranet.ejecucionpresupuestal.transferencia');
    });
    Route::get('/reporte', function () {
        return view('intranet.ejecucionpresupuestal.reporte');
    });

    ////
    Route::get('/obtenerespecificasgasto', 'MetaController@obtenerEspecificasGasto');
    Route::get('/obtenerprogramaspresupuestales', 'MetaController@obtenerProgramasPresupuestales');
    Route::get('/obtenerfinalidad', 'MetaController@obtenerFinalidad');
    Route::get('/storemeta', 'MetaController@store');
    Route::get('/editmeta', 'MetaController@edit');
    Route::get('/obtenerfuentefinaciamiento', 'TransferenciaController@obtenerFuenteFinaciamiento');
    //trnasferencias
    route::get('/validartransf', 'TransferenciaController@validarTransferencias');

    Route::get('/edittransferencia', 'TransferenciaController@edit');
    Route::get('/deltransferencia/{id}', 'TransferenciaController@destroy');
    Route::get('/obtenertransferencias', 'TransferenciaController@obtenerTransferencias');
    Route::get('/obtenertransferenciasid/{id}', 'TransferenciaController@obtenerTransferenciasId');
    Route::get('/obtenertransferenciasedit/{id}', 'TransferenciaController@show');
    Route::get('/obtenertransferenciasreporte', 'TransferenciaController@obtenerTransferenciasReporte');
    ///***********************
    /// Metas
    route::get('/eliminarmeta/{idm}', 'MetaController@eliminarMeta');
    route::get('/validarmeta/{idm}', 'MetaController@validarMeta');
    Route::get('/obtenermetas', 'TransferenciaController@obtenerMetas');
    Route::get('/getmetastransf/{id}', 'TransferenciaController@getMetasTransf');
    Route::get('/obtenermetastr/{idtrans}', 'TransferenciaController@obtenerMetasTr');
    Route::get('/obtenerespecificasmeta/{id}', 'TransferenciaController@obtenerEspecificasMeta');
    Route::get('/obtenermetaid/{id}', 'MetaController@obtenerMetaId');
    Route::get('/obtenermetaespecifica', 'MetaController@obtenerMetaEspecifica');
    Route::get('/obtenermetadespecificaeditar/{id}', 'MetaController@obtenerMetadEspecificaEditar');
    Route::get('/storeEspecificaGasto/{idm}/{ides}', 'MetaController@storeEspecificaGasto');
    Route::get('/deleteespecificagasto/{idespg}', 'MetaController@deleteEspecificaGasto');
    //***
    Route::get('/storeprespuesto', 'PresupuestoCotroller@store');
    Route::get('/editprespuesto', 'PresupuestoCotroller@edit');
    Route::get('/eliminarpresup/{id}', 'PresupuestoCotroller@destroy');
    Route::get('/eliminarnotmod/{id}', 'ModificacionPresupuestalController@destroy');//Agregado 02-11-2020
    Route::get('/getTechP/{id}', 'PresupuestoCotroller@getTechoPres');//Agregado 18-04-2021


    Route::get('/obtenertipo', 'EjecucionController@obtenerTipo');
    //ejecucion
    Route::get('/storeejecucion', 'EjecucionController@store');
    Route::get('/editejecucion', 'EjecucionController@edit');
    Route::get('/reporteejecucion', 'EjecucionController@reporteEjecucion');
    route::get('/validarpedido/{idp}/{tip}', 'EjecucionController@validarPedido');
    route::get('/eliminarpedido/{idp}', 'EjecucionController@eliminarPedido');
    route::get('/obtenereditarpedido/{idp}', 'EjecucionController@obtenerEditarPedido');
    route::get('/obtenerPedidosTrCodp/{idesp}/{tr}/{est}', 'EjecucionController@obtenerPedidosTrCodp');
    Route::get('/getConcepto', 'TransferenciaController@getConcepto');
    Route::get('/getDetPedido/{idp}', 'EPDetallePedidoController@getItemsPedidos');

    //********************************
    Route::get('/obtenerpedidos', 'EjecucionController@obtenerPedidos');
    Route::get('/getPedidoDetalle/{idp}', 'EjecucionController@getPedidoDetalle');



    Route::get('/cambiarestadopedido/{idped}/{est}', 'EjecucionController@cambiarEstadoPedido');
    Route::get('/obtenernotamodificatoria', 'ModificacionPresupuestalController@obtenerNotaModificatoria');
    Route::get('/storemodificacionprespuestal', 'ModificacionPresupuestalController@store');
    Route::get('/editmodificacionprespuestal', 'ModificacionPresupuestalController@edit');
    Route::get('/obfi', 'EjecucionController@obtenerFinalidad');
    Route::get('/obfides', 'EjecucionController@obtenerFinalidadDesc');
    Route::get('/obtenerpresupuesto', 'EjecucionController@obtenerPresupuesto');
    Route::get('/obtenerIncorporacionEdit/{id}', 'EjecucionController@obtenerIncorporacionEdit');
    Route::get('/obtenerModificacionEdit/{id}', 'EjecucionController@obtenerModificacionEdit');
    Route::get('/obtenermodificacion', 'ModificacionPresupuestalController@obtenerModificacion');
    Route::get('/obtenermodificacionpre', 'ModificacionPresupuestalController@obtenerModificacionPre');
    //Route::get('/obtenerModificacionPresupuestalEdit/{id}', 'ModificacionPresupuestalController@obtenerModificacionPresupuestalEdit');
    Route::get('/obtenerTransferenciasModifica2/{id}', 'EjecucionController@obtenerTransferenciasModifica2');

    Route::get('/gettransedit/{id}', 'EjecucionController@getTransferenciaId');


    Route::get('/obtenersaldo/{idtr}/{ideg}', 'EjecucionController@obtenerSaldo');
    Route::get('/obtenerreportetransferencia', 'EjecucionController@obtenerReporteTransferencia');
    Route::get('/obtenerreportefinalidad', 'EjecucionController@obtenerReporteFinalidad');
    Route::get('/reporteEjeEspecifica', 'EjecucionController@reporteEjeEspecifica');
    Route::get('/obtenerreporteprograma', 'EjecucionController@obtenerReportePrograma');
    Route::get('/obtenerreporteProgramatransferencia', 'EjecucionController@obtenerReporteProgramaTransferencia');
    Route::get('/obtenerreporteTrama', 'EjecucionController@obtenerReporteTrama');
    Route::get('/obtenerreportePedido', 'EjecucionController@obtenerReportePedido');

    Route::post('/transferenciastore', 'TransferenciaController@store');
    Route::get('/transferenciastore', 'TransferenciaController@create');
    Route::get('/gettec/{tr}', 'TransferenciaController@gettec');
    Route::get('/gettecedit/{tr}', 'TransferenciaController@gettecedit');
    Route::get('/tecedit', 'TransferenciaController@tecedit');
    Route::get('/deletetec', 'TransferenciaController@deletetec');
    Route::get('/getTecho', 'PresupuestoCotroller@getTecho');
    Route::get('/getReporteCeplan', 'EjecucionController@getReporteCeplan');
    Route::get('/validarnNota/{not}', 'ModificacionPresupuestalController@ValidarnNot');//Agregado 16-12-2020

    //Datos generales
    //TIPO DE PEDIDO
    Route::get('/gettipoPed', 'eptipoController@getTipo');//Agregado 18-11-2020
    Route::post('/storetipo', 'eptipoController@store');//Agregado 18-11-2020
    Route::get('/deletetip/{id}', 'eptipoController@destroy');//Agregado 19-11-2020
    Route::get('/getTipEdit/{id}', 'eptipoController@getTipEdit');//Agregado 19-11-2020
    Route::post('/editTipoPed', 'eptipoController@edit');//Agregado 25-11-2020
    Route::get('/validarTipPedido/{tip}', 'eptipoController@ValidarTipoPedido');//Agregado 25-11-2020
    // FUENTE DE FINANCIAMIENTO
    Route::get('/getFuenF', 'FuenteFinanciamientoController@getFuenF');//Agregado 13-12-2020
    Route::post('/storefuente', 'FuenteFinanciamientoController@store');//Agregado 13-12-2020
    Route::get('/validarFuenF/{id}', 'FuenteFinanciamientoController@ValidarFuenF');//Agregado 13-12-2020
    Route::get('/deletefuen/{id}', 'FuenteFinanciamientoController@destroy');//Agregado 13-12-2020
    Route::get('/getFuenEdit/{id}', 'FuenteFinanciamientoController@getFuenEdit');//Agregado 13-12-2020
    Route::post('/editFuenF', 'FuenteFinanciamientoController@edit');//Agregado 13-12-2020
    // CONCEPTO
    Route::get('/getConcep', 'ConceptoController@getConcept');//Agregado 13-12-2020
    Route::post('/storeConcep', 'ConceptoController@store');//Agregado 13-12-2020
    Route::get('/validarConcep/{id}', 'ConceptoController@ValidarConcept');//Agregado 13-12-2020
    Route::get('/deleteConcep/{id}', 'ConceptoController@destroy');//Agregado 13-12-2020
    Route::get('/getConcepEdit/{id}', 'ConceptoController@getConceptEdit');//Agregado 13-12-2020
    Route::post('/editConcep', 'ConceptoController@edit');//Agregado 13-12-2020
    // PROGRAMA PRESUPUESTAL
    Route::get('/getProgPres', 'ProgramaPresupuestalController@getProgPres');//Agregado 23-11-2020
    Route::post('/storeprogpres', 'ProgramaPresupuestalController@store');//Agregado 23-11-2020
    Route::get('/deleteProgPres/{id}', 'ProgramaPresupuestalController@destroy');//Agregado 23-11-2020
    Route::get('/getProgPresEdit/{id}', 'ProgramaPresupuestalController@getProgPresEdit');//Agregado 24-11-2020
    Route::post('/editProgramaPres', 'ProgramaPresupuestalController@edit');//Agregado 25-11-2020
    Route::get('/validarProgPres/{codp}/{descp}', 'ProgramaPresupuestalController@ValidarProgramaPres');//Agregado 25-11-2020
    // ESPECIFICA DE GASTO
    Route::get('/getEspeG', 'EspecificaGastoController@getEspeG');//Agregado 23-11-2020
    Route::post('/storeEspeG', 'EspecificaGastoController@store');//Agregado 23-11-2020
    Route::get('/deleteEspeG/{id}', 'EspecificaGastoController@destroy');//Agregado 23-11-2020
    Route::get('/getEspeGEdit/{id}', 'EspecificaGastoController@getEspeGEdit');//Agregado 24-11-2020
    Route::post('/editEspeG', 'EspecificaGastoController@edit');//Agregado 25-11-2020
    Route::get('/validarEspeG/{code}/{desce}', 'EspecificaGastoController@ValidarEspeG');//Agregado 25-11-2020
    // FINALIDAD
    Route::get('/getFin', 'EpFinalidadController@getFin');//Agregado 05-01-2021
    Route::post('/storeFin', 'EpFinalidadController@store');//Agregado 05-01-2021
    Route::get('/deleteFin/{id}', 'EpFinalidadController@destroy');//Agregado 05-01-2021
    Route::get('/getFinEdit/{id}', 'EpFinalidadController@getFinEdit');//Agregado 05-01-2021
    Route::post('/editFin', 'EpFinalidadController@edit');//Agregado 05-01-2021
    Route::get('/validarFin/{codf}', 'EpFinalidadController@ValidarFin');//Agregado 05-01-2021
    //CENTRO DE COSTO
    Route::get('/getCentroCosto', 'EPCentroCostoController@getCentroCosto');//Agregado 05-01-2021
});


Route::group(array('prefix' => 'almacen', 'middleware' => 'auth'), function () {
    Route::get('/ingresomaterial', function () {
        return view('intranet.almacen.material');
    });
    Route::get('/entregamaterial', function () {
        return view('intranet.almacen.entrega');
    });
    Route::get('/reportematerial', function () {
        return view('intranet.almacen.reportematerial');
    });
    Route::get('/asignarusuario', function () {
        return view('intranet.almacen.asignarusuario');
    });
    Route::get('/datosgenerales', function () {
        return view('intranet.almacen.datosgenerales');
    });
    /// add stock
    Route::get('/getTipMat', 'MaterialController@getTipMat');
    Route::get('/getMedDis', 'MaterialController@getMedDis');
    Route::get('/getLocal', 'MaterialController@getLocal');
    Route::get('/createStock', 'MaterialController@createStock');
    Route::get('/getStockLoc', 'MaterialController@getStockLoc');
    Route::get('/delStockLoc/{sId}', 'MaterialController@delStockLoc');
    Route::get('/getStockEdit/{sId}', 'MaterialController@getStockEdit');
    Route::get('/editStock', 'MaterialController@editStock');
    Route::get('/getStockTrAl', 'MaterialController@getStockTrAl');
    Route::get('/getEntrega', 'AlEntregaController@getEntrega');
    Route::get('/getEntregaId/{ide}', 'AlEntregaController@show');
    Route::get('/getLocEje/{ideje}', 'MaterialController@getLocEje');
    Route::get('/createMoivimiento', 'MaterialController@createMoivimiento');
    Route::get('/getMovimiento', 'MaterialController@getMovimiento');
    Route::get('/getItmsMovimiento/{idr}', 'MaterialController@getItmsMovimiento');
    Route::get('/getItmsEntrega/{idr}', 'AlEntregaController@getItmsEntrega');
    Route::get('/delEntrega/{id}', 'MaterialController@delEntrega');
    Route::get('/createRecibir/{idReSt}', 'MaterialController@createRecibir');
    Route::get('/createStock', 'MaterialController@createStock');
    Route::get('/recibiritmstock', 'MaterialController@recibiritmstock');
    Route::get('/getRepTot', 'MaterialController@getRepTot');
    Route::post('/createEntrega', 'AlEntregaController@store');
    Route::post('/editEntrega', 'AlEntregaController@edit');
    Route::get('/getGraficoMesvsMedicEje/{me}/{idmed}', 'MaterialController@getGraficoMesvsMedicEje');
    Route::get('/getMovimientonotif', 'MaterialController@getMovimientoNotif');

    //Asignar Usuario
    Route::get('/getlocal/{ideje}', 'EncargadoController@getlocal');//Agregado 10-12-2020
    Route::get('/getUser', 'UsuarioController@getUsuariotermino');//Agregado 30-11-2020
    Route::get('/getencarg', 'EncargadoController@getencargados');//Agregado 30-11-2020
    Route::post('/storeencarg', 'EncargadoController@store');//Agregado 01-12-2020
    Route::get('/getEncargadoEdit/{id}', 'EncargadoController@getEncargadoEdit');//Agregado 01-12-2020
    Route::post('/editencarg', 'EncargadoController@edit');//Agregado 01-12-2020
    Route::get('/deleteencarg', 'EncargadoController@delete');//Agregado 01-12-2020
    Route::get('/getPermisos/{id}', 'EncargadoController@getPermisos');
    Route::get('/validarusuario/{idu}', 'EncargadoController@ValidarUsuarioL');//Agregado 08-12-2020

    //DATOS GENERALES
    //Tipo de Material
    Route::get('/getTipoMate', 'TipoMaterialController@getTipoMate');//Agregado 16-12-2020
    Route::post('/storeTipoM', 'TipoMaterialController@store');//Agregado 17-12-2020
    Route::get('/deleteTipM/{id}', 'TipoMaterialController@destroy');//Agregado 17-12-2020
    Route::get('/getTipMEdit/{id}', 'TipoMaterialController@getTipMEdit');//Agregado 17-12-2020
    Route::post('/editTipoMate', 'TipoMaterialController@edit');//Agregado 17-12-2020
    Route::get('/validarTipMaterial/{tip}', 'TipoMaterialController@ValidarTipoMaterial');//Agregado 16-12-2020
    //Material
    Route::get('/getTipM', 'TipoMaterialController@getTipM');//Agregado 17-12-2020
    Route::get('/getMate', 'MaterialController@getMaterial');//Agregado 17-12-2020
    Route::get('/getMateEdit/{id}', 'MaterialController@getMateEdit');//Agregado 17-12-2020
    Route::post('/storeMate', 'MaterialController@store');//Agregado 17-12-2020
    Route::get('/deleteMate/{id}', 'MaterialController@destroy');//Agregado 17-12-2020
    Route::post('/editMate', 'MaterialController@edit');//Agregado 18-12-2020
    //Local
    Route::get('/getLoc', 'AlLocalController@getLoc');//Agregado 18-01-2021
    Route::get('/getLocEdit/{id}', 'AlLocalController@getLocEdit');//Agregado 18-01-2021
    Route::post('/storeLoc', 'AlLocalController@store');//Agregado Agregado 18-01-2021
    Route::get('/deleteLoc/{id}', 'AlLocalController@destroy');//Agregado 18-01-2021
    Route::post('/editLoc', 'AlLocalController@edit');//Agregado 18-01-2021
    Route::post('/editmatstock', 'ALEntregaStockController@edit');//Agregado 18-01-2021


});

Route::group(array('prefix' => 'referencia', 'middleware' => 'auth'), function () {
    Route::get('/verreferenciasess', function () {
        return view('intranet.rendicion.verreferenciaess');
    });

    Route::get('/verrendicion', function () {
        return view('intranet.rendicion.verrendicion');
    });
    Route::get('/datosgeneralesref', function () {
        return view('intranet.rendicion.datosgeneralesref');
    });
    Route::get('/asignarpermisos', function () {
        return view('intranet.rendicion.asignarpermisosref');
    });
    Route::get('/agregarpersonal', function () {
        return view('intranet.rendicion.agregarpersonalref');
    });
    Route::get('/agregarpaciente', function () {
        return view('intranet.rendicion.agregarpacienteref');
    });

    Route::get('/agregarpaciente', function () {
        return view('intranet.rendicion.agregarpacienteref');
    });


    //VIATICOS

    Route::get('/viatico/{id}', 'ViViaticoController@index');
    Route::get('/fecrefref', 'ReReferenciaController@updateFecRet');
    Route::get('/getTiGas','ViTipoGastoController@getGasto');
    Route::get('/getGas/{id}','ViGastoController@getGasto');
    Route::get('/tipComp/{id}','ViTipoDocGastController@getComp');


    Route::GET('/storeComp', 'ViComprobanteController@store');//Agregado 20-02-2021
    Route::GET('/updateComp', 'ViComprobanteController@update');//Agregado 20-02-2021
    Route::get('/getCompVId/{id}', 'ViComprobanteController@getCompVId');//Agregado 20-02-2021
    Route::get('/deleteComp/{id}', 'ViComprobanteController@destroy');//Agregado 20-02-2021
    Route::get('/show/{id}', 'ViComprobanteController@show');//Agregado 20-02-2021

    //DATOS GENERALES
        //Documento
        Route::post('/storeDoc', 'ReDocumentoController@store');//Agregado 20-12-2020
        Route::get('/obtenerDoc', 'ReDocumentoController@obtenerDoc');//Agregado 20-12-2020
        Route::get('/obtenerDocEdit/{id}', 'ReDocumentoController@obtenerDocEdit');//Agregado 23-12-2020
        Route::post('/editDoc', 'ReDocumentoController@edit');//Agregado 23-12-2020
        Route::get('/eliminarDoc/{id}', 'ReDocumentoController@destroy');//Agregado 23-12-2020
        //Tipo de Seguro
        Route::post('/storeTipS', 'ReTipSeguroController@store');//Agregado 28-12-2020
        Route::get('/obtenerTipS', 'ReTipSeguroController@obtenerTipS');//Agregado 28-12-2020
        Route::get('/obtenerTipSEdit/{id}', 'ReTipSeguroController@obtenerTipSEdit');//Agregado 28-12-2020
        Route::post('/editTipS', 'ReTipSeguroController@edit');//Agregado 28-12-2020
        Route::get('/eliminarTipS/{id}', 'ReTipSeguroController@destroy');//Agregado 28-12-2020
        Route::get('/validarTipSeguro/{destip}', 'ReTipSeguroController@validartips');//Agregado 28-12-2020
        //Estado paciente
        Route::get('/getEstPac', 'ReEstPacienteController@getEstPac');
        //Paciente
        Route::get('/getPacienteDni/{dni}', 'RePacienteController@getPacienteDni'); //Agregado 29-12-2020
        //Afiliado
        Route::get('/getAfiliadoDni/{dni}', 'ReAfiliadoController@getAfiliadoDni'); //Agregado 29-04-2021
        //cie10
        Route::get('/getcie10', 'ReCie10Controller@getCie10');
        //personal
        Route::get('/getpersonal', 'RePersonalController@getPersonal');
        //Documento
        Route::post('/storeDoc', 'ReDocumentoController@store');//Agregado 20-12-2020
        Route::get('/getDoc', 'ReDocumentoController@getDoc');//Agregado 20-12-2020
        Route::get('/getDocEdit/{id}', 'ReDocumentoController@getDocEdit');//Agregado 23-12-2020
        Route::post('/editDoc', 'ReDocumentoController@edit');//Agregado 23-12-2020
        Route::get('/deleteDoc/{id}', 'ReDocumentoController@destroy');//Agregado 23-12-2020
        //Tipo de Seguro
        Route::post('/storeTipS', 'ReTipSeguroController@store');//Agregado 28-12-2020
        Route::get('/getTipS', 'ReTipSeguroController@getTipS');//Agregado 28-12-2020
        Route::get('/getTipSEdit/{id}', 'ReTipSeguroController@getTipSEdit');//Agregado 28-12-2020
        Route::post('/editTipS', 'ReTipSeguroController@edit');//Agregado 28-12-2020
        Route::get('/deleteTipS/{id}', 'ReTipSeguroController@destroy');//Agregado 28-12-2020
        Route::get('/validarTipSeguro/{destip}', 'ReTipSeguroController@validartips');//Agregado 28-12-2020
        Route::get('/getTipSAct', 'ReTipSeguroController@getTipSAct');//Agregado 19-02-2021
        //Plazo
        Route::post('/storePlazo', 'RePlazoController@store');//Agregado 29-12-2020
        Route::get('/getPlazos', 'RePlazoController@getPlazos');//Agregado 29-12-2020
        Route::get('/getPlazoEdit/{id}', 'RePlazoController@getPlazoEdit');//Agregado 29-12-2020
        Route::post('/editPlazo', 'RePlazoController@edit');//Agregado 29-12-2020
        Route::get('/deletePlazo/{id}', 'RePlazoController@destroy');//Agregado 29-12-2020
        Route::get('/validarPlazo/{cant}', 'RePlazoController@validarPlazo');//Agregado 29-12-2020
        //Estado Paciente
        Route::post('/storeEstp', 'ReEstPacienteController@store');//Agregado 30-12-2020
        Route::get('/getEstp', 'ReEstPacienteController@getEstP');//Agregado 30-12-2020
        Route::get('/getEstpEdit/{id}', 'ReEstPacienteController@getEstPEdit');//Agregado 30-12-2020
        Route::post('/editEstp', 'ReEstPacienteController@edit');//Agregado 30-12-2020
        Route::get('/deleteEstp/{id}', 'ReEstPacienteController@destroy');//Agregado 30-12-2020
        Route::get('/validarEstp/{cant}', 'ReEstPacienteController@validarEstP');//Agregado 30-12-2020
        //Tipo Personal
        Route::post('/storeTipP', 'ReTipPersonalController@store');//Agregado 05-01-2021
        Route::get('/getTipP', 'ReTipPersonalController@getTipP');//Agregado 05-01-2021
        Route::get('/getTipPEdit/{id}', 'ReTipPersonalController@getTipPEdit');//Agregado 05-01-2021
        Route::post('/editTipP', 'ReTipPersonalController@edit');//Agregado 05-01-2021
        Route::get('/deleteTipP/{id}', 'ReTipPersonalController@destroy');//Agregado 05-01-2021
        Route::get('/validarTipP/{des}', 'ReTipPersonalController@validarTipP');//Agregado 05-01-2021
        Route::get('/getTipoP', 'ReTipPersonalController@getTipoPer');//Agregado 16-02-2021
        //Oficina
        Route::post('/storeOfic', 'ReOficinaController@store');//Agregado 06-01-2021
        Route::get('/getOfic', 'ReOficinaController@getOfic');//Agregado 06-01-2021
        Route::get('/getOficEdit/{id}', 'ReOficinaController@getOficEdit');//06-01-2021
        Route::post('/editOfic', 'ReOficinaController@edit');//06-01-2021
        Route::get('/deleteOfic/{id}', 'ReOficinaController@destroy');//06-01-2021
        Route::get('/validarOfic/{des}', 'ReOficinaController@validarOfic');//06-01-2021
        Route::get('/getPlazosOfic', 'RePlazoController@getPlazosOfic');//06-01-2021
        //Entidad
        Route::post('/storeEnti', 'ReEntidadController@store');//Agregado 31-02-2021
        Route::get('/getEnti', 'ReEntidadController@getEnti');//Agregado 31-02-2021
        Route::get('/getEntiEdit/{id}', 'ReEntidadController@getEntiEdit');//Agregado 31-02-2021
        Route::post('/editEnti', 'ReEntidadController@edit');//Agregado 31-02-2021
        Route::get('/deleteEnti/{id}', 'ReEntidadController@destroy');//Agregado 31-02-2021
        Route::get('/validarEnti/{des}', 'ReEntidadController@validarEnti');//Agregado 31-02-2021
        //Tipo Documento
        Route::post('/storeTipDoc', 'ViTipoDocController@store');//Agregado 07-06-2021
        Route::get('/getTipDoc', 'ViTipoDocController@getTipDoc');//Agregado 07-06-2021
        Route::get('/getTipDocEdit/{id}', 'ViTipoDocController@edit');//Agregado 07-06-2021
        Route::post('/editTipDoc', 'ViTipoDocController@update');//Agregado 07-06-2021
        Route::get('/deleteTipDoc/{id}', 'ViTipoDocController@destroy');//Agregado 07-06-2021
        Route::get('/validarTipDoc/{des}', 'ViTipoDocController@validarTipDoc');//Agregado 07-06-2021
        //Tipo Gasto
        Route::post('/storeTipGas', 'ViTipoGastoController@store');//Agregado 08-06-2021
        Route::get('/getTipGas', 'ViTipoGastoController@getTipGas');//Agregado 08-06-2021
        Route::get('/getTipGasEdit/{id}', 'ViTipoGastoController@edit');//Agregado 08-06-2021
        Route::post('/editTipGas', 'ViTipoGastoController@update');//Agregado 08-06-2021
        Route::get('/deleteTipGas/{id}', 'ViTipoGastoController@destroy');//Agregado 08-06-2021
        Route::get('/validarTipGas/{des}', 'ViTipoGastoController@validarTipGas');//Agregado 08-06-2021
        Route::get('/getTipGasAct', 'ViTipoGastoController@getTipGasAct');//Agregado 09-06-2021
        //Gasto
        Route::post('/storeGast', 'ViGastoController@store');//Agregado 15-06-2021
        Route::get('/getGast', 'ViGastoController@getGastos');//Agregado 15-06-2021
        Route::get('/getGastEdit/{id}', 'ViGastoController@edit');//Agregado 15-06-2021
        Route::post('/editGast', 'ViGastoController@update');//Agregado 15-06-2021
        Route::get('/deleteGast/{id}', 'ViGastoController@destroy');//Agregado 15-06-2021
        Route::get('/validarGast/{des}', 'ViGastoController@validarGasto');//Agregado 15-06-2021
        //Cie10
        Route::post('/storeCie', 'ReCie10Controller@store');//Agregado 15-06-2021
        Route::get('/getCie', 'ReCie10Controller@getCies10');//Agregado 15-06-2021
        Route::get('/getCieEdit/{id}', 'ReCie10Controller@edit');//Agregado 15-06-2021
        Route::post('/editCie', 'ReCie10Controller@update');//Agregado 15-06-2021
        Route::get('/deleteCie/{id}', 'ReCie10Controller@destroy');//Agregado 15-06-2021
        Route::get('/validarCie/{des}', 'ReCie10Controller@validarCie');//Agregado 15-06-2021
        //Tipo Documento Gasto
        Route::post('/storeTipDG', 'ViTipoDocGastController@store');//Agregado 16-06-2021
        Route::get('/getTipDG', 'ViTipoDocGastController@getTipDG');//Agregado 16-06-2021
        Route::get('/getTipDGEdit/{id}', 'ViTipoDocGastController@edit');//Agregado 16-06-2021
        Route::post('/editTipDG', 'ViTipoDocGastController@update');//Agregado 16-06-2021
        Route::get('/deleteTipDG/{id}', 'ViTipoDocGastController@destroy');//Agregado 16-06-2021
        Route::get('/validarTipDG/{des}', 'ViTipoDocGastController@validarTipDG');//Agregado 16-06-2021
    //ASIGNAR PERMISOS
    Route::get('/getOficAct', 'ReOficinaController@getOficAct');//Agregado 12-01-2021
    Route::get('/getOficEnt/{id}', 'ReOficinaEntidadController@getOficEnt');//Agregado 13-01-2021
    Route::get('/storeUsuOfi', 'ReUsuOfiController@store');//Agregado 13-01-2021
    Route::get('/getUsuOfi', 'ReUsuOfiController@getUsuOfic');//Agregado 13-01-2021
    Route::get('/getUsuOfEdit/{id}', 'ReUsuOfiController@getUsuOficEdit');//Agregado 14-01-2021
    Route::get('/editUsuOfi', 'ReUsuOfiController@edit');//19-01-2021
    Route::get('/deleteUsuOfi/{id}/{idus}/{idsm}', 'ReUsuOfiController@destroy');//25-01-2021
    Route::get('/getidPer/{idu}/{idsm}', 'ReUsuOfiController@getidpermiso');//07-02-2021
    Route::get('/getidperef/{idu}', 'ReUsuOfiController@getidpermref');//07-02-2021
    Route::get('/veragregaruser/{idplant}', 'ReUsuOfiController@mostrarRegistrarUsuario');//agregardo 09-02-2021
    Route::get('/valuser/{idu}', 'ReUsuOfiController@ValUsuarioOfic');//agregardo 03-06-2021
    //Referencia
    Route::post('/storeRef', 'ReReferenciaController@store');
    Route::POST('/editRef', 'ReReferenciaController@edit');
    Route::get('/getTrabEss', 'ReUsuOfiController@getTrabEss');
    Route::get('/getReferenciasEstablecimiento', 'ReReferenciaController@getReferenciasEstablecimiento');
    //Route::POST('/storePersonalRecib', 'RePersonalController@storePersonalRecib');
    Route::get('/getestfile/{id}', 'ReDocFileController@getEstFile');
    Route::get('/updateCheckListref/{id}/{rid}', 'ReRevisionController@updateCheckListRef');
    Route::get('/updateCheckListrefer/{id}', 'ReRevisionController@updateCheckListRefer');
    Route::get('/getDetRef/{id}', 'ReReferenciaController@getDetRef');
    Route::get('/getDetPerRef/{id}', 'ReReferenciaController@getDetPerRef');
    Route::get('/getDetCie10/{idr}', 'ReCie10Controller@getDetCie10');
    Route::get('/deleteRef/{id}', 'ReReferenciaController@destroy');//Agregado 09-02-2021
    // guardar estado referencias
    Route::get('/storeEstReferenc',    'ReReferenciaController@storeEstReferenc');
    Route::get('/getEstReferenc','ReReferenciaController@getEstReferenc');
    Route::get('/clearEstReferenc',  'ReReferenciaController@clearEstReferenc');

    Route::post('/cart-removeitem',  'CartController@removeitem')->name('cart.removeitem');
    //Rendicionaes
    Route::get('/gettrabenti', 'ReUsuOfiController@getTrabEnti');
    Route::get('/referenciasentidad', 'ReReferenciaController@referenciasEntidad');
    Route::get('/referenciasudr', 'ReReferenciaController@referenciasUdr');

    Route::get('/recibirdoc/{rid}', 'ReReferenciaController@recibirDoc');
    Route::post('/enviarRevision/{rid}', 'ReReferenciaController@recibirDoc');
    Route::post('/revisionStore', 'ReRevisionController@store');
    Route::get('/getobservacion/{rid}', 'ReObservacionController@getObservacion');
    Route::get('/recdocobs/{uid}', 'ReDocSubsanacionController@recibirDocumentoSubsanacionRed');
    Route::get('/recdocobsess/{uid}', 'ReDocSubsanacionController@recibirDocumentoSubsanacionEess');
    Route::get('/subsanarobs/{idrev}', 'ReDocSubsanacionController@subsanarObs');
    //Ubicacion
    Route::get('/getUbicacion/{idr}', 'ReUbicacionController@obtenerUbicaciones');//Agregado 11-02-2021

    //Diagnostico
    Route::get('/addeditcie10/{idr}/{idc}', 'ReDiagnosticoController@addeditcie10');
    Route::get('/delDiag/{id}', 'ReDiagnosticoController@destroy');

    //Personal
    Route::post('/storePers', 'RePersonalController@store');//Agregado 16-02-2021
    Route::get('/getPers', 'RePersonalController@getPersonals');//Agregado 15-02-2021
    Route::get('/getPersEdit/{id}', 'RePersonalController@getPersonalEdit');//Agregado 15-02-2021
    Route::post('/editPers', 'RePersonalController@edit');//Agregado 16-02-2021
    Route::get('/deletePers/{id}', 'RePersonalController@destroy');//Agregado 15-02-2021
    Route::get('/valPers/{idp}', 'RePersonalController@validarPersonal');//Agregado 16-02-2021
    Route::get('/getPersonas', 'PersonaController@getPersonatermino');//Agregado 16-02-2021
    Route::get('/getChof', 'RePersonalController@getChoferes');//Agregado 03-03-2021
    Route::get('/getChofDni/{dni}', 'RePersonalController@getChoferDni');//Agregado 16-03-2021
    Route::get('/chofer', 'RePersonalController@index');

    Route::get('/addeditper/{idp}/{idr}', 'RePersonalController@addeditper');
    Route::get('/destroyPersonalRef/{idp}/{idr}', 'RePersonalController@destroyPersonalRef');

    //Paciente
    Route::get('/getPacDni/{dni}', 'RePacienteController@getPacienteRefDni');//Agregado 16-02-2021
    Route::post('/storePac', 'RePacienteController@store');//Agregado 20-02-2021
    Route::get('/getPac', 'RePacienteController@getPacientes');//Agregado 21-02-2021
    Route::get('/deletePac/{id}', 'RePacienteController@destroy');//Agregado 21-02-2021
    Route::get('/editPac', 'RePacienteController@edit');//Agregado 23-02-2021

    //Notificacion
    Route::post('/notificacionStore', 'UNotificacionController@store');//Agregado 24-02-2021
    Route::get('/getNotifi/{id}', 'UNotificacionController@getNotif');//Agregado 24-02-2021
    Route::get('/deleteNotifi/{id}', 'UNotificacionController@destroy');//Agregado 24-02-2021

    //Pdf
    Route::get('/pdfviatico/{id}', 'ReReferenciaController@pdfViatico');// 05-05-2021
    Route::get('/pdfformtIII/{idr}', 'ReReferenciaController@pdfFormatoIII');// 05-05-2021
    Route::get('/pdfformtII/{id}', 'ReReferenciaController@pdfFormatoII');// 05-05-2021
    Route::get('/pdfformtOfic/{id}', 'ReReferenciaController@pdfFormatoOfic');// 05-05-2021
    Route::get('/pdfformtI/{id}', 'ReReferenciaController@pdfFormatoI');// 21-05-2021
    Route::get('/pdfformtInform/{id}', 'ReReferenciaController@pdfFormatoInforme');// 08-06-2021
    Route::get('/pdfformtReemb/{id}', 'ReReferenciaController@pdfFormatoReembolso');// 09-06-2021

    Route::get('/pdfformtReemb/{id}', 'ReReferenciaController@pdfFormatoReembolso');// 09-06-2021
    Route::get('/getnumDocs/{idref}', 'ReReferenciaController@getnumDocs');// 09-06-2021

});
Route::group(array('prefix' => 'mantenimiento', 'middleware' => 'auth'), function () {
    Route::get('/agregarmarca', function () {
        return view('intranet.mantenimiento.agregarmarca');
    });
    Route::get('/agregartipoproducto', function () {
        return view('intranet.mantenimiento.agregartipproducto');
    });
    Route::get('/agregarapoderado', function () {
        $vi=0;
        return view('intranet.mantenimiento.agregarapoderado')->with(array('vi' => $vi));
    });
    Route::get('/agregarproveedor', function () {
        $vi=0;
        return view('intranet.mantenimiento.agregarproveedor')->with(array('vi' => $vi));
    });
    Route::get('/agregarproducto', function () {
        $vi=0;
        return view('intranet.mantenimiento.agregarproducto')->with(array('vi' => $vi));
    });
    Route::get('/agregaralumno', function () {
        $vi=0;
        return view('intranet.mantenimiento.agregaralumno')->with(array('vi' => $vi));
    });


    //MARCA
    Route::get('/getmarca', 'MarcaController@getMarca');//Agregado 14-09-2023
    Route::post('/storemarca', 'MarcaController@store');//Agregado 14-09-2023
    Route::get('/editmarca', 'MarcaController@update');//Agregado 14-09-2023
    Route::get('/obtenermarca', 'MarcaController@obtenerMarca');//Agregado 14-09-2023
    Route::get('/obtenermarcaeditar/{id}', 'MarcaController@obtenerMarcaEditar');//Agregado 14-09-2023
    Route::get('/deletemarca/{id}', 'MarcaController@destroy');//Agregado 14-09-2023

    //TIPO PRODUCTO
    Route::get('/gettipproducto', 'TipProductoController@getTipProducto');//Agregado 14-09-2023
    Route::post('/storetipproducto', 'TipProductoController@store');//Agregado 14-09-2023
    Route::post('/edittipproducto', 'TipProductoController@update');//Agregado 14-09-2023
    Route::get('/obtenertipproducto', 'TipProductoController@obtenerTipProducto');//Agregado 14-09-2023
    Route::get('/obtenertipproductoeditar/{id}', 'TipProductoController@obtenerTipProductoEditar');//Agregado 14-09-2023
    Route::get('/deletetipproducto/{id}', 'TipProductoController@destroy');//Agregado 14-09-2023

    //PRODUCTO
    Route::get('/getproducto', 'ProductoController@getProducto');//Agregado 14-09-2023
    Route::get('/storeproducto', 'ProductoController@store');//Agregado 14-09-2023
    Route::get('/editproducto', 'ProductoController@update');//Agregado 14-09-2023
    Route::get('/obtenerproducto', 'ProductoController@obtenerProducto');//Agregado 14-09-2023
    Route::get('/obtenerproductoeditar/{id}', 'ProductoController@edit');//Agregado 14-09-2023
    //Route::get('/obtenerproductoeditar/{id}', 'ProductoController@obtenerProductoEditar');//Agregado 14-09-2023
    Route::get('/deleteproducto/{id}', 'ProductoController@destroy');
    Route::get('/producto', 'ProductoController@index');

    //PROVEEDOR
    Route::get('/getproveedor', 'ProveedorController@getProveedor');//Agregado 14-09-2023
    Route::get('/storeproveedor', 'ProveedorController@store');//Agregado 14-09-2023
    Route::get('/editproveedor', 'ProveedorController@update');//Agregado 14-09-2023
    Route::get('/obtenerproveedor', 'ProveedorController@obtenerProveedor');//Agregado 14-09-2023
    Route::get('/obtenerproveedoreditar/{id}', 'ProveedorController@obtenerProveedorEditar');//Agregado 14-09-2023
    Route::get('/deleteproveedor/{id}', 'ProveedorController@destroy');
    Route::get('/getProveeRuc/{ruc}', 'ProveedorController@getProveedorRuc');
    Route::get('/proveedor', 'ProveedorController@index');

    //CLIENTE
    Route::get('/getcliente', 'ProveedorController@getProveedor');//Agregado 14-09-2023
    Route::get('/getClienDni/{dni}', 'ClienteController@getCLienteDni');//Agregado 16-02-2021
    Route::get('/storecliente', 'ClienteController@store');//Agregado 14-09-2023
    Route::get('/updatecliente', 'ClienteController@update');//Agregado 14-09-2023
    Route::get('/obtenercliente', 'ClienteController@getClientes');//Agregado 14-09-2023
    Route::get('/obtenerproveedoreditar/{id}', 'ProveedorController@obtenerProveedorEditar');//Agregado 14-09-2023
    Route::get('/deleteclien/{id}', 'ClienteController@destroy');//Agregado 14-09-2023
    Route::get('/client', 'ClienteController@obtenerCliente');
    Route::get('/cliente', 'ClienteController@index');

    //ALUMNO
    Route::get('/getcliente', 'ProveedorController@getProveedor');
    Route::get('/getAlumnDni/{dni}', 'AlumnoController@getAlumnoDni');
    Route::get('/storealumno', 'AlumnoController@store');
    Route::get('/updatecliente', 'ClienteController@update');
    Route::get('/obteneralumno', 'AlumnoController@getAlumnos');
    Route::get('/obtenerproveedoreditar/{id}', 'ProveedorController@obtenerProveedorEditar');
    Route::get('/deleteclien/{id}', 'ClienteController@destroy');
    Route::get('/alumn', 'AlumnoController@obtenerAlumno');
    Route::get('/alumno/{id}', 'AlumnoController@index');

    //APODERADO
    Route::get('/getcliente', 'ProveedorController@getProveedor');//Agregado 14-09-2023
    Route::get('/getApoderDni/{dni}', 'ApoderadoController@getApoderadoDni');
    Route::get('/storecliente', 'ClienteController@store');//Agregado 14-09-2023
    Route::get('/updatecliente', 'ClienteController@update');//Agregado 14-09-2023
    Route::get('/obtenerApoderado', 'ApoderadoController@getApoderados');
    Route::get('/obtenerproveedoreditar/{id}', 'ProveedorController@obtenerProveedorEditar');//Agregado 14-09-2023
    Route::get('/deleteclien/{id}', 'ClienteController@destroy');//Agregado 14-09-2023
    Route::get('/client', 'ClienteController@obtenerCliente');
    Route::get('/apoderado', 'ApoderadoController@index');
    //PRESENTACION
    Route::get('/getpresentacion', 'PresentacionController@getPresentacion');//Agregado 14-09-2023

    //UNIDAD DE MEDIDA
    Route::get('/getunidm', 'UnidadMedidaController@getUnidM');//Agregado 14-09-2023

    //GRADO DE INSTRUCCION
    Route::get('/getgradinst', 'GradoInstruccionController@getGradInst');

    //GRADO DE ACADEMICO
    Route::get('/getgradacad', 'GradoAcademicoController@getGradAcad');

    //PARENTESCO
    Route::get('/getparent', 'ParentescoController@getParent');

    //GRADO DE ACADEMICO_SECCION
    Route::get('/getseccion/{idg}', 'GradoSeccionController@obtenerSeccion');

    //ESTADO CIVIL
    Route::get('/getestadcivi', 'EstadoCivilController@getEstCivi');

    //BENEFICIARIO
    Route::get('/getbenef/{dni}/{nomb}', 'ReAfiliadoController@getbenefi');//Agregado 11-04-2024

    //TIPO DOC
    Route::get('/gettipodoc', 'TipoDocController@getTipoDoc');

    //API CLIENTE
    Route::get('/getapiclient/{tipd}/{dni}', 'ClienteController@getApiDni');

});
Route::group(array('prefix' => 'transacciones', 'middleware' => 'auth'), function () {
    Route::get('/compra', function () {
        $vi=0;
        return view('intranet.transacciones.compra')->with(array('vi' => $vi));
    });
    Route::get('/recepcion', function () {
        $vi=0;
        return view('intranet.transacciones.recepcion')->with(array('vi' => $vi));
    });
    Route::get('/agregarproveedor', function () {
        return view('intranet.mantenimiento.agregarproveedor');
    });
    Route::get('/agregarproducto', function () {
        return view('intranet.mantenimiento.agregarproducto');
    });


    //COMPRA
    Route::get('/getmarca', 'MarcaController@getMarca');//Agregado 14-09-2023
    Route::get('/storecompra', 'CompraController@store');//Agregado 14-09-2023
    Route::get('/editmarca', 'MarcaController@update');//Agregado 14-09-2023
    Route::get('/obtenercompra', 'CompraController@obtenerCompra');//Agregado 14-09-2023
    Route::get('/obtenermarcaeditar/{id}', 'MarcaController@obtenerMarcaEditar');//Agregado 14-09-2023
    Route::get('/deletecompra/{est}/{id}', 'CompraController@destroy');//Agregado 14-09-2023
    Route::get('/compras', 'CompraController@index');

    //VENTA
    Route::get('/storeventa', 'VentaController@store');//Agregado 14-09-2023
    Route::get('/obtenerventa', 'VentaController@obtenerVenta');//Agregado 14-09-2023
    Route::get('/deleteventa/{est}/{id}', 'VentaController@destroy');//Agregado 14-09-2023
    Route::get('/ventas', 'VentaController@index');

    //RECEPCION
    Route::get('/storerecepcion', 'RecepcionController@store');
    Route::get('/obtenerrecepcion', 'RecepcionController@obtenerRecepcion');
    Route::get('/deleterecepcion/{est}/{id}', 'RecepcionController@destroy');
    Route::get('/recepc', 'RecepcionController@index');

});
//rutas para nodulo combustible
Route::group(array('prefix' => 'combustible', 'middleware' => 'auth'), function () {
    Route::get('/vervehiculos', function () {
        return view('intranet.combustible.vehiculo');
    });
    Route::get('/verstock', function () {
        return view('intranet.combustible.stock');
    });

    Route::get('/vermeta', function () {
        return view('intranet.combustible.meta');
    });
    Route::get('/veroc', function () {
        return view('intranet.combustible.ordencompra');
    });
    Route::get('/verchofer', function () {
        $vi=0;
        return view('intranet.combustible.chofer')->with(array('vi' => $vi));
    });
    Route::get('/vervaleconsumo', function () {
        $vi=0;
        return view('intranet.combustible.valeconsumo')->with(array('vi' => $vi));
    });
    Route::get('/mantenimientotablas', function () {
        return view('intranet.combustible.mantenimientotablascomb');
    });
    Route::get('/reportecombus', function () {
        return view('intranet.combustible.reportecombus');
    });
    //MARCA
    Route::get('/getmarca', 'VMarcaController@getmarca');
    Route::get('/getmarcas', 'VMarcaController@getMarcas');
    Route::get('/getMarcsAct', 'VMarcaController@getMarcasAct');
    Route::post('/storeMarc', 'VMarcaController@store');
    Route::post('/editMarc', 'VMarcaController@edit');
    Route::get('/deleteMarc/{id}', 'VMarcaController@destroy');
    Route::get('/getMarcEdit/{id}', 'VMarcaController@getMarcEdit');
    //SubMarca
    Route::get('/getsubmarca/{id}', 'VMarcaController@subMarca');

    Route::get('/getSubMarcs', 'VSubMarcaController@getSubMarcs');
    Route::post('/storeSubM', 'VSubMarcaController@store');
    Route::post('/editSubM', 'VSubMarcaController@edit');
    Route::get('/deleteSubM/{id}', 'VSubMarcaController@destroy');
    Route::get('/getSubMEdit/{id}', 'VSubMarcaController@getSubMarcEdit');
    Route::get('/getSubMarcsAct', 'VSubMarcaController@getSubMarcsAct');
//Modelos
    Route::get('/getmodelos/{id}', 'VSubMarcaController@getModelos');

    Route::get('/getModels', 'VModeloController@index');//datatables 07-03-2021
    Route::post('/storeModel', 'VModeloController@store');
    Route::post('/editModel', 'VModeloController@update');
    Route::get('/deleteModel/{id}', 'VModeloController@destroy');
    Route::get('/getModelEdit/{id}', 'VModeloController@edit');
    Route::get('/getModelsAct', 'VModeloController@getModelsAct');//modelos activos 08-03-2021

    //vehivulos

    Route::get('/getvalplac/{nump}', 'VVehiculoController@valPlaca');
    Route::post('/storevehi', 'VVehiculoController@store');
    Route::post('/editvehi', 'VVehiculoController@update');
    Route::get('/deletevehi/{id}', 'VVehiculoController@destroy');

    Route::get('/getvehiculos', 'VVehiculoController@show');
    Route::get('/getvehiculodit/{id}', 'VVehiculoController@edit');
    Route::get('/getVehPla/{plc}', 'VVehiculoController@getVehiPlac');//Agregado 16-03-2021

    //modelotipovehiculo
    Route::get('/gettipve/{id}', 'VModeloTipoVehiculoController@getTipVehiculoId');

    Route::get('/getModelTipVs', 'VModeloTipoVehiculoController@index');
    Route::post('/storeModelTipV', 'VModeloTipoVehiculoController@store');
    Route::post('/editModelTipV', 'VModeloTipoVehiculoController@update');
    Route::get('/deleteModelTipV/{id}', 'VModeloTipoVehiculoController@destroy');
    Route::get('/getModelTipVEdit/{id}', 'VModeloTipoVehiculoController@edit');

    //tipovehiculo
    Route::get('/getTipVehics', 'VTipoVehiculoController@getTipVehics');//datatable
    Route::post('/storeTipV', 'VTipoVehiculoController@store');
    Route::post('/editTipV', 'VTipoVehiculoController@edit');
    Route::get('/deleteTipV/{id}', 'VTipoVehiculoController@destroy');
    Route::get('/getTipVEdit/{id}', 'VTipoVehiculoController@getTipVehicEdit');
    Route::get('/gettipve/{id}', 'VModeloTipoVehiculoController@getTipVehiculoId');
    Route::get('/getTipVsAct', 'VTipoVehiculoController@getTipVehicAct');//tipos de vehiculos activos 08-03-2021
    //tipocombustible
    Route::get('/getticomb', 'VTipoCombustibleController@getTipComb');
    Route::get('/getTipCombs', 'VTipoCombustibleController@getTipCombs');
    Route::post('/storeTipC', 'VTipoCombustibleController@store');
    Route::post('/editTipC', 'VTipoCombustibleController@edit');
    Route::get('/deleteTipC/{id}', 'VTipoCombustibleController@destroy');
    Route::get('/getTipCEdit/{id}', 'VTipoCombustibleController@geTipCombEdit');
    Route::get('/getticomb', 'VTipoCombustibleController@getTipComb');
    Route::get('/getTipCsAct', 'VTipoCombustibleController@getTipCombsAct');//Tipo de combustible activos

    Route::get('/getvalplac/{nump}', 'VVehiculoController@valPlaca');
    Route::post('/storevehi', 'VVehiculoController@store');
    Route::post('/editvehi', 'VVehiculoController@update');
    Route::get('/deletevehi/{id}', 'VVehiculoController@destroy');

    Route::get('/getvehiculos', 'VVehiculoController@show');
    Route::get('/getvehiculodit/{id}', 'VVehiculoController@edit');
    //orden de compra
    Route::get('/getordcs', 'VOrdenCompraController@index');//datatable 09-03-2021
    Route::post('/storeoc', 'VOrdenCompraController@store');
    Route::get('/getOrdCEdit/{id}', 'VOrdenCompraController@edit');
    Route::post('/editOrdC', 'VOrdenCompraController@update');
    Route::get('/deleteOrdC/{id}', 'VOrdenCompraController@destroy');
    Route::get('/getOrdCAct', 'VOrdenCompraController@getordencompra');//Orden de compras activas 11-03-2021
    Route::get('/getvalNumOc/{numoc}', 'VOrdenCompraController@valNumoc');

    //orden de compra combustible
    Route::get('/getOrdComb/{id}', 'VCOcTCombustController@edit');// obtener el detalle de la orden de compra
    Route::get('/getOrdC/{id}', 'VCOcTCombustController@getCotComb');//obtener un solo detalle de la orden de compra
    Route::get('/getItemsVal/{id}', 'VCOcTCombustController@getItemVal');// obtener el detalle de la orden de compra del combustible

    //Combustible
    Route::get('/getMetEGC', 'VCombustibleController@getMetasEGComb');// obtener las metas pertenecientes a combustible
    Route::get('/getCombs', 'VCombustibleController@index');// Datatable
    Route::post('/storeComb', 'VCombustibleController@store');// 12-03-2021
    Route::get('/getCombEdit/{idc}', 'VCombustibleController@edit');// 12-03-2021
    Route::post('/editComb', 'VCombustibleController@update');// 12-03-2021
    Route::get('/getOrdCCombus', 'VOrdenCompraController@getOrdCompComb');//Orden de compras dentro  de combustible 15-03-2021
    Route::get('/deleteComb/{idc}', 'VCombustibleController@destroy');//12-03-2021
    Route::get('/getValesOC/{idc}', 'VCombustibleController@getValesOC');//15-04-2021

    //consumo
    Route::get('/getConsms', 'VConsumoController@getConsumos');//17-03-2021
    Route::get('/getMEGVal/{id}', 'VConsumoController@getMetaEGV');//15-03-2021
    Route::get('/getSaldCom/{id}', 'VConsumoController@getSaldoComb');//15-03-2021 obtener stock combustible
    Route::get('/storeVale', 'VConsumoController@store');//17-03-2021
    Route::get('/deleteValeC/{idc}', 'VConsumoController@destroy');//17-03-2021
    Route::get('/getValConsEdit/{id}', 'VConsumoController@getValConsEdit');//21-03-2021
    Route::post('/editConsu', 'VConsumoController@update');//21-03-2021
    Route::get('/vale', 'VConsumoController@index');

    Route::get('/pdf', 'VConsumoController@createPDF');// 12-03-2021

    //Grifo
    Route::get('/getGrifAct', 'VGrifoController@getGrifoAct');//Agregado 16-03-2021
    Route::get('/pdfvaleconsumo/{id}', 'VConsumoController@pdfVale');// 12-03-2021

    //grifo
    Route::post('/storeGrifo', 'VGrifoController@store');// 12-03-2021
    Route::get('/getGrifos', 'VGrifoController@getGrifos');//datatable 09-03-2021
    Route::get('/getGrifosEdit/{gid}', 'VGrifoController@edit');
    Route::post('/editGrifo', 'VGrifoController@update');// 12-03-2021
    Route::get('/deletegrif/{id}', 'VGrifoController@destroy');
    //Reportes
    Route::get('/reportegenval', 'VConsumoController@reportegeneralval');

});


