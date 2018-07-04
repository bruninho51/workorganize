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

        title: {
            text: 'Trabalho Concluído Nos Últimos 70 Dias'
        },

        yAxis: {
            title: {
                text: 'Number of Employees'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2010
            }
        },

        series: [{
            name: 'Installation',
            data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
        }, {
            name: 'Manufacturing',
            data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
        }, {
            name: 'Sales & Distribution',
            data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
        }, {
            name: 'Project Development',
            data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
        }, {
            name: 'Other',
            data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>