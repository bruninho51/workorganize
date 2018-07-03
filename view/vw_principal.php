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
                text: 'Ordenadas'
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
            color: '#3A2F0B',
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