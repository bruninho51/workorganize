<?php lib\factory\FactoryJS::js('highcharts/highcharts.src')?>
<div class="dcontainer">
    <h1 class="tituloPrincipal">Dashboard</h1>

    <div class="drow">
        <div class="dgrafico" id="dgrafico1"></div>    
    </div>
    <div class="drow">
        <div class="dgrafico" id="dgrafico2"></div>
        <div class="dgrafico" id="dgrafico3"></div>    
    </div>
    
</div>

<script>
    Highcharts.chart('dgrafico1', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'Gráfico do Bruno'
        },
        subtitle: {
            text: 'Gráfico do Bruno'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            //EFEITO HOVER QUANDO PASSA O MOUSE EM CIMA DE CADA CATEGORIA
            crosshair: true
        },
        yAxis: {
            //VALOR MÍNIMO PARA O EIXO DAS ORDENADAS(Y)
            min: 0,
            title: {
                text: 'Ordenadas'
            }
        },
        tooltip: {
            //CONFIGURAÇÕES DO CABEÇARIO, CORPO E RODAPÉ DO TOOLTIP
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            //PERMITE 1 TOOLTIP PARA TODAS AS SÉRIES DE UMA CATEGORIA
            shared: true,
            //USO DE HTML NO TOOLTIP
            useHTML: true
        },
        //CONFIGURAÇÕES PARA CADA TIPO DE SÉRIE
        plotOptions: {
            column: {
                pointPadding: 0.08,
                borderWidth: 1
            }
        },
        //VALORES DO GRÁFICO
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });

    
</script>