<?php lib\factory\FactoryJS::js('highcharts/highcharts.src')?>
<div class="dcontainer">
    <h1 class="tituloPrincipal">Dashboard</h1>

    <div class="drow">
        <div class="dgrafico" id="dgrafico1">Não há nada aqui!</div>    
    </div>
    <div class="drow">
        <div class="dgrafico" id="dgrafico2">Não há nada aqui!</div>
        <div class="dgrafico" id="dgrafico3">Não há nada aqui!</div>    
    </div>
    
</div>

<script id="codeGrafico1">
    Highcharts.chart('dgrafico1', {
        credits: {
            text: 'WorkOrganize',  
            href: '#',
            style: 'font-size: 12px;',
        },
        chart: {
            type: 'column',
        },
        title: {
            text: 'Trabalho por Usuário'
        },
        subtitle: {
            text: 'Quantidade de trabalho por usuário'
        },
        xAxis: {
            categories: [
                <?php //INSERINDO AS CATEGORIAS ATRAVÉS DO PHP 
                foreach($dadosGraficoTrabalhoUsuario as $row): ?>
                        <?php echo "'{$row['usuario']}',"; ?>
                <?php endforeach;?>
                
            ],
            //EFEITO HOVER QUANDO PASSA O MOUSE EM CIMA DE CADA CATEGORIA
            crosshair: false
        },
        yAxis: {
            //VALOR MÍNIMO PARA O EIXO DAS ORDENADAS(Y)
            min: 0,
            title: {
                text: 'Qtde Trabalho'
            }
        },
        tooltip: {
            //CONFIGURAÇÕES DO CABEÇARIO, CORPO E RODAPÉ DO TOOLTIP
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            //PERMITE 1 TOOLTIP PARA TODAS AS SÉRIES DE UMA CATEGORIA
            shared: true,
            //USO DE HTML NO TOOLTIP
            useHTML: true
        },
        //CONFIGURAÇÕES PARA CADA TIPO DE SÉRIE
        plotOptions: {
            column: {
                pointPadding: 0,
                borderWidth: 1
            }
        },
        //VALORES DO GRÁFICO
        series: [{
            color: '#5C5C61',
            name: 'Quantidade de Trabalho',
            data: [
                <?php //INSERINDO A QUANTIDADE DE TRABALHO ATRAVÉS DO PHP 
                foreach($dadosGraficoTrabalhoUsuario as $row): ?>
                        <?php echo "{$row['qtdeTrabalho']},"; ?>
                <?php endforeach;?>
            ]

        }]
    });

    
</script>
<script id="codeGrafico2">


    // Build the chart
    Highcharts.chart('dgrafico2', {
        credits: {
            href: "#",
            text: "WorkOrganize",
            style: 'font-size: 12px;',
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            //SOMBRA NA ÁREA DO GRÁFICO
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Trabalho Realizado x Trabalho Não Realizado'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'black'
                }
            }
        },
        series: [{
            name: 'Porcentagem',
            data: [
                { name: 'Realizadas', y: <?php echo $dadosGraficoTrabalhoRealizadoNaoRealizado[1]['qtde'];?> },
                { name: 'Não Realizadas', y: <?php echo $dadosGraficoTrabalhoRealizadoNaoRealizado[0]['qtde'];?> }
            ]
        }]
    });
</script>

<script id="codeGrafico3">

    Highcharts.chart('dgrafico3', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Average Temperature'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
</script>