var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
$("#tipm").change(function () {
        $('#apex-mixed-chart1').empty();
        var addidmed = $('#addidmed').val();
        if (addidmed !== '') {
            var ing = [], egre = [], eje = [], rot = [];
            var medicamento = $('#adddescm').val();
            var nombMes = meses[this.value - 1];
            var nombmed = medicamento + ' MES DE ' + nombMes;
            $.ajax(
                {
                    type: "GET",
                    url: '/almacen/getGraficoMesvsMedicEje/' + this.value + '/' + addidmed,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        var arr = data['result'];
                        for (var i = 0; i < arr.length; i++) {
                            ing.push(arr[i]['stacu']);
                            rot.push(arr[i]['cantro']);
                            egre.push(arr[i]['canten']);
                            eje.push(arr[i]['codigoEjecutora'])
                        }

                        handleMixedChart1(ing, egre, rot, eje, nombmed);
                    }

                });

        }
        else {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                type: 'error',
                title: 'ocurrio un error!',
                text: 'Seleccion almenos un material',
                showConfirmButton: false,
                timer: 3000
            });
            $('#addidmed').focus();
        }


    }
);

var table = function () {
    $('#tabla_reporte_tot').DataTable({
            ajax: '/almacen/getRepTot',
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ordering: false,
            select: true,
            destroy: true,
            responsive: true,
            bAutoWidth: true,
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
            columnDefs: [
                {"targets": 0, "width": "70%", "className": "text-left"},
                {"targets": 1, "width": "4%", "className": "text-center"},
                {"targets": 2, "width": "4%", "className": "text-center"},
                {"targets": 3, "width": "4%", "className": "text-center"},
                {"targets": 4, "width": "4%", "className": "text-center"},
                {"targets": 5, "width": "4%", "className": "text-center"},
                {"targets": 6, "width": "4%", "className": "text-center"},
                {"targets": 7, "width": "4%", "className": "text-center"},
            ],

            columns: [
                {data: 'mMedNom', name: 'mMedNom'},
                {data: 'cha', name: 'cha'},
                {data: 'con', name: 'con'},
                {data: 'bag', name: 'bag'},
                {data: 'uct', name: 'uct'},
                {data: 'hob', name: 'hob'},
                {data: 'hoc', name: 'hoc'},
                {data: 'tot', name: 'tot'},

            ]
        }
    );
};


var consultReport01 = function () {
    $('#apex-mixed-chart1').empty();
    var date = new Date();
    console.log();
    var medicamento = 'AZITROMICINA EN FRASCO DE 100 MIL';

    var nombMes = meses[date.getMonth()];
    var nombmed = medicamento + ' MES DE ' + nombMes;
    var ing = [], egre = [], eje = [], rot = [];

    $.ajax(
        {
            type: "GET",
            url: '/almacen/getGraficoMesvsMedicEje/'+(date.getMonth()+1)+'/261',
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                var arr = data['result'];
                for (var i = 0; i < arr.length; i++) {
                    ing.push(arr[i]['stacu']);
                    rot.push(arr[i]['cantro']);
                    egre.push(arr[i]['canten']);
                    eje.push(arr[i]['codigoEjecutora'])
                }
                handleMixedChart1(ing, egre, rot, eje, nombmed);
            }

        });

}

var handleMixedChart1 = function (ing, egre, rot, eje, nombmed) {

    var options = {
        chart: {
            height: 350,
            type: 'line',
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            name: 'INGRESOS',
            type: 'column',
            data: ing
        }, {
            name: 'EGRESOS',
            type: 'column',
            data: egre
        }, {
            name: 'ROTADO',
            type: 'column',
            data: rot
        }],
        stroke: {
            width: [0, 0, 3]
        },
        colors: [COLOR_BLUE_DARKER, COLOR_YELLOW, COLOR_GREEN],
        title: {
            text: nombmed,
            align: 'left',
            offsetX: 110
        },
        xaxis: {
            categories: eje,
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
        yaxis: [{
            axisTicks: {
                show: true,
            },
            axisBorder: {
                show: true,
                color: COLOR_BLUE_DARKER
            },
            labels: {
                style: {
                    color: COLOR_BLUE_DARKER
                }
            },
            title: {
                text: "Cantidad",
                style: {
                    color: COLOR_BLUE_DARKER
                }
            },
            tooltip: {
                enabled: true
            }
        }],
        tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
        },
        legend: {
            horizontalAlign: 'left',
            offsetX: 40
        }
    };
    var chart = new ApexCharts(
        document.querySelector('#apex-mixed-chart1'),
        options
    );
    chart.render();
};

var handleMixedChart2 = function () {


    var options = {
        chart: {
            height: 350,
            type: 'line',
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            name: 'Income',
            type: 'column',
            data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
        }, {
            name: 'Cashflow',
            type: 'column',
            data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
        }, {
            name: 'Revenue',
            type: 'line',
            data: [20, 29, 37, 36, 44, 45, 50, 58]
        }],
        stroke: {
            width: [0, 0, 3]
        },
        colors: [COLOR_BLUE_DARKER, COLOR_TEAL, COLOR_ORANGE],
        title: {
            text: 'XYZ - Stock Analysis (2012 - 2019)',
            align: 'left',
            offsetX: 110
        },
        xaxis: {
            categories: [2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019],
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
        yaxis: [{
            axisTicks: {
                show: true,
            },
            axisBorder: {
                show: true,
                color: COLOR_BLUE_DARKER
            },
            labels: {
                style: {
                    color: COLOR_BLUE_DARKER
                }
            },
            title: {
                text: "Income (thousand crores)",
                style: {
                    color: COLOR_BLUE_DARKER
                }
            },
            tooltip: {
                enabled: true
            }
        }, {
            seriesName: 'Income',
            opposite: true,
            axisTicks: {
                show: true,
            },
            axisBorder: {
                show: true,
                color: COLOR_TEAL
            },
            labels: {
                style: {
                    color: COLOR_TEAL
                }
            },
            title: {
                text: "Operating Cashflow (thousand crores)",
                style: {
                    color: COLOR_TEAL
                }
            },
        }, {
            seriesName: 'Revenue',
            opposite: true,
            axisTicks: {
                show: true,
            },
            axisBorder: {
                show: true,
                color: COLOR_ORANGE
            },
            labels: {
                style: {
                    color: COLOR_ORANGE
                },
            },
            title: {
                text: "Revenue (thousand crores)",
                style: {
                    color: COLOR_ORANGE
                }
            }
        }],
        tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
        },
        legend: {
            horizontalAlign: 'left',
            offsetX: 40
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-mixed-chart2'),
        options
    );

    chart.render();
};
var ChartApex = function () {
    "use strict";
    return {
        init: function () {
            consultReport01();
            handleMixedChart2();
            table();
        }
    };
}();

$(document).ready(function () {
    ChartApex.init();
});
$('#adddescm').typeahead({
    name: 'data',
    displayKey: 'name',
    source: function (query, process) {
        $.ajax({
            url: "/almacen/getMedDis",
            type: 'GET',
            data: 'query=' + query,
            dataType: 'JSON',
            async: 'false',
            success: function (data) {
                bondObjs = {};
                bondNames = [];
                $.each(data, function (i, item) {
                    bondNames.push({id: item.mId, name: item.mMedNom, tipmed: item.tmDesc});
                });
                process(bondNames);
            }

        });
    }
    , updater: function (item) {
        $('#addidmed').val(item.id);
        $('#tipmed').val(item.tipmed);

        return item;
    }
});
