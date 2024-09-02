///////////////// intranet
var cod_indi;
var ejecutoras = [];
var codEjecutoras = [];
var nombreindicador, numerador, denominador, meta_indi;
var meta;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var fecha = null;

var handleAreaChart = function (numeroindi) {


    porcentajeregionales(numeroindi);
    "use strict";
    var nume = [];
    var denomi = [];
    var meta = [];
    var fech = [];
    var nomb = null;
    "use strict";
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    $('#apex-area-chart').html('');
    var url = "/reporteindicadormeses/" + numeroindi;
    cod_indi = numeroindi;
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
                    $('#titulo').html(nombreindicador);
                    $('#numerador').html(numerador);
                    $('#denominador').html(denominador);
                    $('#metajunio').html($('#apex-area-chart').val());
                    llenarareachart(denomi, nume, meta, meses);
                    desbloquear();
                } else {
                    bloquear();
                }
            }, beforeSend: function () {
                bloquear();
            }

        });


};

function llenarareachart(denomi, nume, meta, meses) {

    var titulografico = 'GRAFICO LINEAL REGION AMAZONAS:\n' +
        '' + nombreindicador.toUpperCase() + ', POBLACION VS MESES, ' +
        'ENERO A JUNIO 2019';
    $('#tituloGrafico1').text(titulografico);
    var options = {
        chart: {
            height: 395,
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
            position: 'top',
            offsetY: 0,
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
    var titulografico = 'GRAFICO RADAR REGION AMAZONAS:\n' +
        '' + nombreindicador.toUpperCase() + ', PORCENTAJE DE AVANCE';
    $('#tituloGrafico3').text(titulografico);

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
                    error();
                }
            }

        });


};

function llenarRadar(nume, denomi, meta, ejecu, mes) {
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    var nombMes = meses[mes - 1];
    var options = {
        chart: {
            height: 500,
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
                size: 140,
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
            tickAmount: 7,
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
            position: 'top',
            offsetY: -10,
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
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    var titulografico = 'GRAFICO CIRCULAR REGION AMAZONAS:\n' +
        '' + nombreindicador.toUpperCase() + ', APORTE DE EJECUTORA, ' +
        'ENERO A JUNIO 2019';
    $('#tituloGrafico2').text(titulografico);

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
                        ejecutoras.push(datos[i]['descripcionEjecutora']);
                        ejecu2.push(datos[i]['descripcionEjecutora'])
                    }
                    handlePieChart(ejecu2, nume, nombMes);
                } else {
                    error();
                }
            }

        });


}


var handlePieChart = function (ejecutoras, logros, nombmes) {


    $('#apex-pie-chart').html('');
    var options = {
        chart: {
            height: 300,
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
            position: 'top',
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

    "use strict";
    var nume = [], denomi = [], meta = [], mes = [], porcentaje = [], datos = [];
    var url = "/reporteindicadorejecutoratodosmeses/" + ejecutora + "/" + cod_indi;
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
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
                        meses[i]=meses[i]+' '+datos[i]['PORC']+'%';
                    }
                    llenarLineejecutora(nume, denomi, meta, meses);
                } else {

                }
            }

        });


}

function llenarLineejecutora(nume, denomi, meta, meses) {
    var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];

    $('#line_ejecutora').html('');
    var titulografico = 'GRAFICO EJECUTORA REGION AMAZONAS:\n' +
        '' + nombreindicador.toUpperCase() + ', POBLACION VS MESES DE AVANCE POR EJECUTORA ' +
        'ENERO A JUNIO 2019';
    $('#tituloGrafico4').text(titulografico);

    var options = {
        chart: {

            height: 350,
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
            position: 'top',
            offsetY: -0,
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
                        porc = (porcentaje / meta) * 100;

                        if (porc >= 100)
                            porcentajeid.style.color = 'green';
                        else {
                            if (porc >= 79 && porc < 100) {
                                porcentajeid.style.color = 'yellow';


                            }
                            else
                                porcentajeid.style.color = 'red';

                        }

                        $('#porcentajealcan').text(porcentaje + '%');
                        $('#meta').text(meta + '%');
                    } else {
                        this.error(data['error']);
                    }

                }
            }
        );

    }
;

var datos = function () {

    "use strict";
    return {
        init: function () {
            handleAreaChart(1);
            comentarios(1);
        }
    };
};


$(document).ready(function () {
    datos().init();
});


var comentarios = function (codigo) {
        //  limpiarComentarios();
        var data1 = null;
        var url = "/comentario/" + codigo + "/" + fecha + "";
        var editor;
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
                        for (var i = 0; i < data1.length; i++) {
                            CKEDITOR.instances["comentario" + data1[(i)]['codigoGrafico']].setData(data1[(i)]['comentario']);
                        }
                    } else {
                        this.error(data['error']);
                    }

                }
            }
        );

    }
;

function bloquear() {

    $.blockUI({
        message: ' <div><i class="fas fa-cog fa-spin"></i> Procesando, espere porfavor<i class="fas fa-cog fa-spin"></i> </div>',
        css: {
            align: 'center',
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    });


}

function limpiarComentarios() {

    for (instance in CKEDITOR.instances) {
        //delete CKEDITOR.instances[instance];
        CKEDITOR.remove(instance);
        CKEDITOR.instances[instance].updateElement();
        CKEDITOR.instances[instance].setData('');
    }


}

var guardar = function (idgrafico) {

    var objEditor = CKEDITOR.instances["comentario" + idgrafico];
    var comentario = objEditor.getData();
    Swal.fire({
        title: 'Este comentario se modificara?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                /* the route pointing to the post function */
                url: '/cambiarcomentario',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {
                    _token: CSRF_TOKEN,
                    comentario: comentario,
                    idgrafico: idgrafico,
                    idindi: cod_indi,
                    fecha: fecha
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {

                    if (data['error'] === 0) {
                        exito();
                        desbloquear();

                        comentarios(cod_indi);
                    } else {
                        bloquear();
                        error();
                        redirect('/reportesis');
                    }


                }, beforeSend: function () {
                    bloquear();
                }
            });

        }
    })


};

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
    $('#modal-dialog').modal('show');
    $('#modal-dialog').focus();

}


function guardarRepuesta() {

    var objEditor = CKEDITOR.instances["respuesta"];
    var respuestas = objEditor.getData();
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
                    respuesta: respuestas,
                    cod_indi: cod_indi,
                    fecha: fecha
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {

                    if (data['error'] === 0) {
                        $('#modal-dialog').modal('hide');
                        respuesta();
                        desbloquear();

                    } else {
                        bloquear();
                    }


                }, beforeSend: function () {
                    bloquear();
                }
            });

        }
    });
}

function desbloquear() {
    $.unblockUI();
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
