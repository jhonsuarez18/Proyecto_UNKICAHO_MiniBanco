var DashboardSIS = function () {
    "use strict";
    return {
        //main function
        init: function () {
            reporteIndicadores();
            handleAreaChart(1);
        }
    };
}();


var mensajeGriter = function (fecha) {
    setTimeout(function () {
        $.gritter.add({
            title: 'Bienvenido al reporteador de convenios',
            text: 'Este reporteador da a conocer informacion sobre el convenio con corte al ' + fecha,
            image: '../assets/img/diresa/Logo.png',
            sticky: true,
            time: 20,
            class_name: 'my-sticky-class'
        });
    }, 100);
};

var reporteIndicadores = function () {
    "use strict";
    var url = "/indicadores_sis";
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var datarow1 = data['indicadoresAct'][0];
                    var datarow2 = data['indicadoresAct'][1];
                    var datarow3 = data['indicadoresAct'][2];
                    var datarow4 = data['indicadoresAct'][3];
                    var datarow5 = data['indicadoresAct'][4];
                    var datarow6 = data['indicadoresAct'][5];
                    var dataprow1 = null;
                    var dataprow2 = null;
                    var dataprow3 = null;
                    var dataprow4 = null;
                    var dataprow5 = null;
                    var dataprow6 = null;
                    if (data['indicadoresPas'] != null) {
                        dataprow1 = data['indicadoresPas'][0];
                        dataprow2 = data['indicadoresPas'][1];
                        dataprow3 = data['indicadoresPas'][2];
                        dataprow4 = data['indicadoresPas'][3];
                        dataprow5 = data['indicadoresPas'][4];
                        dataprow6 = data['indicadoresPas'][5];
                    }
                    $('#codIndi1').val(datarow1['codigoIndicador']);
                    $('#tit1').text(datarow1['tituloIndicador']);
                    $('#tot1').text(datarow1['porc'] + '%');
                    var square = document.getElementById("barra1");
                    if (dataprow1 == null) {
                        $('#totant1').text('Porcentaje anterior 0%');
                        square.style.width = '0%';
                    }
                    else {
                        square.style.width = datarow1['porc'] + '%';
                        $('#totant1').text('Porcentaje anterior ' + dataprow1['porc'] + '%');
                        cambiarColorCuadro(1, datarow1['porc'], datarow1['meta']);
                    }

                    $('#codIndi2').val(datarow2['codigoIndicador']);
                    $('#tit2').text(datarow2['tituloIndicador']);
                    $('#tot2').text(datarow2['porc'] + '%');
                    var square = document.getElementById("barra2");
                    if (dataprow1 == null) {
                        square.style.width = '0%';
                        $('#totant2').text('Porcentaje anterior 0%');
                    }
                    else {
                        square.style.width = datarow2['porc'] + '%';
                        $('#totant2').text('Porcentaje anterior ' + dataprow2['porc'] + '%');
                        cambiarColorCuadro(2, datarow2['porc'], datarow2['meta']);
                    }

                    $('#codIndi3').val(datarow3['codigoIndicador']);
                    $('#tit3').text(datarow3['tituloIndicador']);
                    $('#tot3').text(datarow3['porc'] + '%');
                    var square = document.getElementById("barra3");
                    if (dataprow1 == null) {
                        square.style.width = '0%';
                        $('#totant3').text('Porcentaje anterior 0%');
                    }
                    else {
                        square.style.width = datarow3['porc'] + '%';
                        $('#totant3').text('Porcentaje anterior ' + dataprow3['porc'] + '%');
                        cambiarColorCuadro(3, datarow3['porc'], datarow3['meta']);
                    }

                    $('#codIndi4').val(datarow4['codigoIndicador']);
                    $('#tit4').text(datarow4['tituloIndicador']);
                    $('#tot4').text(datarow4['porc'] + '%');
                    var square = document.getElementById("barra4");
                    if (dataprow1 == null) {
                        square.style.width = '0%';
                        $('#totant4').text('Porcentaje anterior 0%');
                    }
                    else {
                        square.style.width = datarow3['porc'] + '%';
                        $('#totant4').text('Porcentaje anterior ' + dataprow4['porc'] + '%');
                        cambiarColorCuadro(4, datarow4['porc'], datarow4['meta']);
                    }

                    $('#codIndi5').val(datarow5['codigoIndicador']);
                    $('#tit5').text(datarow5['tituloIndicador']);
                    $('#tot5').text(datarow5['porc'] + '%');
                    var square = document.getElementById("barra5");
                    if (dataprow1 == null) {
                        square.style.width = '0%';
                        $('#totant5').text('Porcentaje anterior 0%');
                    }
                    else {
                        square.style.width = datarow5['porc'] + '%';
                        $('#totant5').text('Porcentaje anterior ' + dataprow5['porc'] + '%');
                        cambiarColorCuadro(5, datarow5['porc'], datarow5['meta']);
                    }

                    $('#codIndi6').val(datarow6['codigoIndicador']);
                    $('#tit6').text(datarow6['tituloIndicador']);
                    $('#tot6').text(datarow6['porc'] + '%');
                    var square = document.getElementById("barra6");
                    if (dataprow1 == null) {
                        square.style.width = '0%';
                        $('#totant6').text('Porcentaje anterior 0%');
                    }
                    else {
                        square.style.width = datarow6['porc'] + '%';
                        $('#totant6').text('Porcentaje anterior ' + dataprow6['porc'] + '%');
                        mensajeGriter(datarow1['fecCorteDatoIndicador']);
                        cambiarColorCuadro(6, datarow6['porc'], datarow6['meta']);
                        cargarRespuetas(1, datarow1['fecCorteDatoIndicador']);
                    }
                }
                else {
                    error(data['error']);
                }
            }
        }
    );
};

function cambiarColorCuadro(codigo, porc, meta) {
    porc = (porc / meta);
    if (porc >= 1)
        $('#cuadro' + codigo).addClass("bg-gradient-green");
    else {
        if (porc >= 0.79 && porc < 1)
            $('#cuadro' + codigo).addClass("bg-gradient-yellow");
        else
            $('#cuadro' + codigo).addClass("bg-gradient-red");

    }
}


function error(error) {
    window.swal({
        title: 'Ha ocurrido un error!',
        text: 'El error es: ' + error,
        icon: 'error',
        buttons: {
            cancel: {
                text: 'ACEPTAR',
                value: error,
                visible: true,
                className: 'btn btn-default',
                closeModal: true,
            },
        }
    });

}


var cargarRespuetas = function (indicador, fechacorte) {
    "use strict";

};


///// pagina informativa

var cod_indi;
var ejecutoras = [];
var codEjecutoras = []

var meses = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
var nombreindicador, numerador, denominador, meta_indi;
var meta;
var fecha = null;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var handleAreaChart = function (numeroindi) {

    porcentajeregionales(numeroindi);
    "use strict";
    var nume = [];
    var denomi = [];
    var meta = [];
    var fech = [];
    "use strict";
    $('#apex-area-chart').html('');
    var url = "/reporteindicadormeses/" + numeroindi;
    cod_indi = numeroindi;
    var meses = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {

                    var datos = data['infoIndicador'];
                    for (var i = 0; i < datos.length; i++) {
                        nume.push(datos[i]['num']);
                        denomi.push(datos[i]['denom']);
                        meta.push(datos[i]['meta']);
                        fech.push(datos[i]['dato']);
                        nombreindicador = datos[i]['descripIndicador'];
                        numerador = datos[i]['numerador'];
                        denominador = datos[i]['denominador'];
                        meta_indi = datos[i]['meta_indi'];
                        meses[i] = meses[i] + ' ' + datos[i]['porc'] + '%';
                        document.getElementById("imagenindicador").src = "" + datos[i]['image'] + "";
                    }
                    llenarComboMes(fech, numeroindi);

                    var cant = new Date(fech[fech.length - 1]);
                    handleRadarChart((cant.getMonth() + 1), numeroindi);
                    piechart((cant.getMonth() + 1), numeroindi);
                    linechar('0725');
                    fecha = fech[fech.length - 1];
                    comentarios(numeroindi);
                    respuesta();
                    $('#titulo').html(nombreindicador.toUpperCase());
                    $('#numerador').html(numerador);
                    $('#denominador').html(denominador);
                    $('#metajunio').html($('#apex-area-chart').val());
                    llenarareachart(denomi, nume, meta, meses);

                } else {

                }
            }

        });


};

function llenarareachart(denomi, nume, meta, meses) {

    var options = {
        chart: {
            height: 250,
            type: 'line',
            shadow: {
                enabled: true,
                color: COLOR_DARK,
                top: 18,
                left: 7,
                blur: 10,
                opacity: 1
            },
            toolbar: {
                show: false
            }
        },
        colors: [COLOR_GREEN_DARKER, COLOR_BLUE_DARKER, COLOR_RED_DARKER],
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'Denominador',
            data: denomi
        }, {
            name: 'Numerador',
            data: nume
        }, {
            name: 'Meta',
            data: meta
        }],
        grid: {
            row: {
                colors: [COLOR_SILVER_TRANSPARENT_1, 'transparent'],
                opacity: 0.5
            },
        },
        markers: {
            size: 4
        },
        xaxis: {
            categories: meses,
            axisBorder: {
                show: true,
                color: COLOR_SILVER_TRANSPARENT_5,
                height: 1,
                width: '100%',
                offsetX: 0,
                offsetY: -1
            },
            axisTicks: {
                show: true,
                borderType: 'solid',
                color: COLOR_SILVER,
                height: 6,
                offsetX: 0,
                offsetY: 0
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            offsetY: -12,
            horizontalAlign: 'center',
            floating: true,
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-area-chart'),
        options
    );

    chart.render();

}

function llenarComboMes(fech, cod) {
    var select1 = $('#selectmes1').html('');
    var select2 = $('#selectmes2').html('');
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    var html = '<option value="" selected="">SELECCIONAR MES</option>';
    for (var i = 0; i < fech.length; i++) {
        var fec = new Date(fech[i]);
        var htmla = '<option value="' + (fec.getMonth() + 1) + '">' + meses[fec.getMonth()] + '</option>';
        html = html + htmla;
    }
    select1.append(html);
    select2.append(html);
}

function llenarComboEjecutora() {

    var select = $('#selectejecutora').html('');
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    var html = '';
    for (var i = 0; i < ejecutoras.length; i++) {
        var htmla;
        if (i === 0)
            htmla = '<option value="' + codEjecutoras[i] + '" selected>' + ejecutoras[i] + '</option>';
        else
            htmla = '<option value="' + codEjecutoras[i] + '">' + ejecutoras[i] + '</option>';
        html = html + htmla;
    }
    select.append(html);
}

$('#selectmes1').on('change', function () {
    var value = $(this).val();

    piechart(parseInt(value), cod_indi);
});

$('#selectmes2').on('change', function () {
    var value = $(this).val();

    handleRadarChart(parseInt(value), cod_indi);
});


$('#selectejecutora').on('change', function () {
    var select = $(this);
    linechar(select.val())
});

var handleRadarChart = function (mes, cod) {
    "use strict";
    codEjecutoras = [];
    ejecutoras = [];
    var nume = [], denomi = [], meta = [], ejecu = [], ejecu2 = [], datos = [];
    $('#apex-radar-chart').html('');

    var url = "/reporteindicadorejecumetalogro/" + mes + "/" + cod;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    datos = data['infoIndicador'];

                    for (var i = 0; i < datos.length; i++) {

                        nume.push(datos[i]['LOGRO']);
                        denomi.push(datos[i]['POBLACION']);
                        meta.push(datos[i]['META']);
                        ejecu.push(datos[i]['descripcionEjecutora'] + ' ' + datos[i]['PORCENTAJE'] + '%');
                        ejecu2.push(datos[i]['descripcionEjecutora']);
                        ejecutoras.push(datos[i]['descripcionEjecutora']);
                        codEjecutoras.push(datos[i]['codigoEjeDatoIndicador'])
                    }
                    llenarComboEjecutora();
                    llenarRadar(nume, denomi, meta, ejecu, mes)
                } else {

                }
            }

        });


};

function llenarRadar(nume, denomi, meta, ejecu, mes) {
    var nombMes = meses[mes - 1];
    var options = {
        chart: {
            height: 275,
            type: 'radar',
        },
        series: [{
            name: 'Numerador',
            data: nume,
        }, {
            name: 'Denominador',
            data: denomi,
        },
            {
                name: 'Meta',
                data: meta,
            },
        ],
        labels: ejecu,
        plotOptions: {
            radar: {
                size: 80,
                polygons: {
                    strokeColor: COLOR_SILVER_TRANSPARENT_3,
                    fill: {
                        colors: [COLOR_SILVER_TRANSPARENT_2, COLOR_WHITE]
                    }
                }
            }
        },
        title: {
            text: 'INDICADOR ACUMULADO DEL MES DE ENERO A ' + nombMes + ' 2019',
            align: 'center',
        },
        colors: [COLOR_BLUE_DARKER, COLOR_GREEN_DARKER, COLOR_RED_DARKER],
        markers: {
            size: 4,
            colors: [COLOR_WHITE],
            strokeColor: COLOR_SILVER_TRANSPARENT_3,
            strokeWidth: 2,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val
                }
            }
        },
        yaxis: {
            tickAmount: 6,
            labels: {
                formatter: function (val, i) {
                    if (i % 2 === 0) {
                        return val
                    } else {
                        return ''
                    }
                }
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            offsetY: -2,
            horizontalAlign: 'center',
            floating: true,
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-radar-chart'),
        options
    );
    chart.render();
}


function piechart(mes, cod) {


    "use strict";
    var nume = [], denomi = [], meta = [], ejecu = [], ejecu2 = [], datos = [];
    var url = "/reporteindicadorejecumetalogro/" + mes + "/" + cod;
    var nombMes = meses[mes - 1];
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    datos = data['infoIndicador'];
                    for (var i = 0; i < datos.length; i++) {

                        nume.push(datos[i]['LOGRO']);
                        denomi.push(datos[i]['POBLACION']);
                        meta.push(datos[i]['META']);
                        ejecu2.push(datos[i]['descripcionEjecutora'])
                    }
                    handlePieChart(ejecu2, nume, nombMes);
                } else {

                }
            }

        });
}


var handlePieChart = function (ejecutoras, logros, nombmes) {


    $('#apex-pie-chart').html('');
    var options = {
        chart: {
            height: 250,
            type: 'pie',
        },
        dataLabels: {
            dropShadow: {
                enabled: false,
                top: 1,
                left: 1,
                blur: 1,
                opacity: 0.45
            }
        },
        colors: [COLOR_RED, COLOR_GREEN, COLOR_BLUE, COLOR_ORANGE, COLOR_PURPLE, COLOR_YELLOW],
        labels: ejecutoras,
        series: logros,
        title: {
            text: 'INDICADOR ACUMULADO DEL MES DE ENERO A ' + nombmes + ' 2019',
            align: 'center',
        },
        legend: {
            show: true,
            position: 'bottom',
            offsetY: -3,
            horizontalAlign: 'center',
            floating: true,
        }


    };

    var chart = new ApexCharts(
        document.querySelector('#apex-pie-chart'),
        options
    );

    chart.render();
};


function linechar(ejecutora) {
    var meses = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
    "use strict";
    var nume = [], denomi = [], meta = [], mes = [], porcentaje = [], datos = [];

    var url = "/reporteindicadorejecutoratodosmeses/" + ejecutora + "/" + cod_indi;

    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    datos = data['infoIndicador'];

                    for (var i = 0; i < datos.length; i++) {
                        nume.push(datos[i]['NUM']);
                        denomi.push(datos[i]['DENOM']);
                        meta.push(datos[i]['META']);
                        mes.push(datos[i]['MES']);
                        porcentaje.push(datos[i]['PORC']);
                        meses[i] = meses[i] + ' ' + datos[i]['PORC'] + '%';
                    }
                    llenarLineejecutora(nume, denomi, meta, meses);
                } else {

                }
            }

        });


}

function llenarLineejecutora(nume, denomi, meta, meses) {
    $('#line_ejecutora').html('');


    var options = {
        chart: {

            height: 250,
            type: 'line',
            shadow: {
                enabled: true,
                color: COLOR_DARK,
                top: 18,
                left: 7,
                blur: 10,
                opacity: 1
            },
            toolbar: {
                show: false
            }
        },
        colors: [COLOR_GREEN_DARKER, COLOR_BLUE_DARKER, COLOR_RED_DARKER],
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'Denominador',
            data: denomi
        }, {
            name: 'Numerador',
            data: nume
        },
            {
                name: 'Meta',
                data: meta
            }],
        grid: {
            row: {
                colors: [COLOR_SILVER_TRANSPARENT_1, 'transparent'],
                opacity: 0.5
            },
        },


        markers: {
            size: 4
        },
        xaxis: {
            categories: meses,
            axisBorder: {
                show: true,
                color: COLOR_SILVER_TRANSPARENT_5,
                height: 1,
                width: '100%',
                offsetX: 0,
                offsetY: -1
            },
            axisTicks: {
                show: true,
                borderType: 'solid',
                color: COLOR_SILVER,
                height: 6,
                offsetX: 0,
                offsetY: 0
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            offsetY: -12,
            horizontalAlign: 'center',
            floating: true,
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#line_ejecutora'),
        options
    );

    chart.render();

}

var porcentajeregionales = function (nro) {

        var porcentaje = 0, meta = 0, porc;
        var porcentajeid = document.getElementById("porcentajealcan");
        var url = "/indicadordonaRegional/" + nro;
        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        data1 = data['infoIndicador'];
                        porcentaje = data1[0]['PORC'];
                        meta = data1[0]['meta'];
                        porc = (porcentaje / meta);

                        if (porc >= 1) {
                            porcentajeid.style.color = 'green';
                        }
                        else {
                            if (porc >= 0.79 && porc < 1)
                                porcentajeid.style.color = 'yellow';
                            else
                                porcentajeid.style.color = 'red';

                        }
                        $('#porcentajealcan').text(porcentaje + '%');
                        $('#meta').text(meta + '%');
                    }
                    else {
                        this.error(data['error']);
                    }

                }
            }
        );

    }
;

var comentarios = function (codigo) {
        var data1 = [];
        var url = "/comentario/" + codigo + "/" + fecha + "";

        $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    if (data['error'] === 0) {
                        data1 = data['comentarios'];
                        for (var i = 0; i < 4; i++) {
                            $('#comentario' + (i + 1)).html(
                                ""
                            );
                        }
                        for (var i = 0; i < data1.length; i++) {
                            $('#comentario' + (i + 1)).html(
                                '<h4 class=panel-title">COMENTARIO Y ANALISIS DEL GRAFICO</h4><div class="mb-0">' +
                                '' + data1[(i)]['comentario'] + '' +
                                '</div>'
                            );
                        }
                    } else {
                        this.error(data['error']);
                    }

                }
            }
        );

    }
;


function timeline(fecha, respuesta, usuario) {

    var fech = new Date(fecha);
    var hora = fech.getHours() + ':' + fech.getMinutes() + ':' + fech.getSeconds();
    var fechaano = fech.getFullYear() + '-' + fech.getMonth() + '-' + fech.getDay();
    var html = '      <li>' +
        '                <div class="timeline-time">' +
        '                    <span class="date">' + fechaano + '</span>' +
        '                    <span class="time">' + hora + '</span>' +
        '                </div>' +
        '                <div class="timeline-icon">' +
        '                    <a href="javascript:">&nbsp;</a>' +
        '                </div>' +
        '                <div class="timeline-body">' +
        '                    <div class="timeline-header">' +
        '                        <span class="userimage"><img src="../assets/img/user/user-1.jpg" alt=""/></span>' +
        '                        <span class="username"><a href="javascript:">' + usuario + '</a> <small></small></span>' +
        '                    </div>' +
        '                    <div class="timeline-content">' +
        '                        <p>' +
        '                         ' + respuesta + '' +
        '                        </p>' +
        '                    </div>' +
        '                </div>' +
        '            </li>';

    return html;
}

function respuesta() {
    var url = "/obtenerespuesta/" + cod_indi + "/" + fecha + "";
    var respuesta = $('#respuestas');
    respuesta.html('');
    var html = '';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var datos = data['respuestas'];
                    for (var i = 0; i < datos.length; i++) {
                        var fech = new Date(datos[i]['fechacreacion']);
                        var hora = fech.getHours() + ':' + fech.getMinutes() + ':' + fech.getSeconds();
                        var fechaano = fech.getFullYear() + '-' + (fech.getMonth() + 1) + '-' + fech.getDay();
                        html = html + '      <li>' +
                            '                <div class="timeline-time">' +
                            '                    <span class="date">' + fechaano + '</span>' +
                            '                    <span class="time">' + hora + '</span>' +
                            '                </div>' +
                            '                <div class="timeline-icon">' +
                            '                    <a href="javascript:">&nbsp;</a>' +
                            '                </div>' +
                            '                <div class="timeline-body">' +
                            '                    <div class="timeline-header  text-left">' +
                            '                        <span class="userimage"><img src="../assets/img/user/user-1.jpg" alt=""/></span>' +
                            '                        <span class="username"><a href="javascript:">' + datos[i]['name'] + '</a> <small></small></span>' +
                            '                    </div>' +
                            '                    <div class="timeline-content  text-left">' +
                            '                        <p>' +
                            '                         ' + datos[i]['respuesta'] + '' +
                            '                        </p>' +
                            '                    </div>' +
                            '                </div>' +
                            '            </li>';

                    }
                    respuesta.html(html);
                } else {
                    this.error(data['error']);
                }
            }
        }
    );


}

function abrilModal() {
    var modal = $('#modal-dialog');
    modal.modal('show');
    modal.focus();

}

function cerraModal() {

    $("#modal-dialog").modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();

}

function guardarRepuesta() {

    var objEditor = CKEDITOR.instances["respuesta"];
    var respuest = objEditor.getData();
    Swal.fire({
        title: 'Desea responder?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, aceptar!',
        cancelButtonText: 'no, cancelar!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                /* the route pointing to the post function */
                url: '/ingresarrespuesta',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {
                    _token: CSRF_TOKEN,
                    respuesta: respuest,
                    cod_indi: cod_indi,
                    fecha: fecha
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {

                    if (data['error'] === 0) {
                        $('#modal-dialog').modal('hide');
                        respuesta();
                    } else {

                    }
                }, beforeSend: function () {

                }
            });
        }
    })
}


function exito() {
    Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Operacion exitosa',
        showConfirmButton: false,
        timer: 1500
    })
}

function error() {
    Swal.fire({
        position: 'top-end',
        type: 'error',
        title: 'ha ocurrido un error!',
        showConfirmButton: false,
        timer: 1500
    })
}


function redirect(ruta) {
    $.ajax(
        {
            type: "GET",
            url: ruta,
            dataType: "html",
            success: function (data) {
                $("#response").html(data);

            }
        }
    );

}



