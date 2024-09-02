var DashboardSIS = function () {
    "use strict";
    return {
        //main function
        init: function () {
            reporteIndicadores();
          //  handleVisitorsDonutChart(1);

        }
    };
}();


var fecha = null;
var mensajeGriter = function (fecha) {
    setTimeout(function () {
        $.gritter.add({
            title: 'Bienvenido a reporteador de convenios',
            text: 'Este reporteador da a conocer informacion sobre el convenio con corte al ' + fecha,
            image: '../assets/img/diresa/Logo.png',
            sticky: true,
            time: '100',
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
                    } else {
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
                    } else {
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
                    } else {
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
                    } else {
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
                    } else {
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
                    } else {
                        square.style.width = datarow6['porc'] + '%';
                        $('#totant6').text('Porcentaje anterior ' + dataprow6['porc'] + '%');
                        fecha=datarow1['fecCorteDatoIndicador'];
                        mensajeGriter(datarow1['fecCorteDatoIndicador']);
                        cambiarColorCuadro(6, datarow6['porc'], datarow6['meta']);
                    }
                } else {
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
                value: null,
                visible: true,
                className: 'btn btn-default',
                closeModal: true,
            },
        }
    });

}
