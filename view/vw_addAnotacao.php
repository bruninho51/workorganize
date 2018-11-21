<?php use lib\Call;?>
<?php use helper\helper;?>
<?php Call::js('Anotacao')?>


<div class="pcontainer">
    <h1 class="tituloPrincipal">Anotacao</h1>

    <div class="prow">
        <div class="rolagem">
            <table class="trabalho-list">
                <thead>
                    <tr>
                        <th colspan="3">Trabalho</th>
                        <th colspan="2">Prazo</th>
                        <th colspan="1">Marcar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($trabalhos as $trabalho):?>
                    <tr>
                        <td colspan="3"><?= $trabalho['titulo']?></td>
                        <td colspan="2">
                            <?= helper::dateBrazilian($trabalho['dataInicio'])?> 
                            até 
                            <?= helper::dateBrazilian($trabalho['dataFim'])?></td>
                        <td>
                            <input class="radio-trabalho" type="radio" 
                                   name="selTrabalho"  
                                   value="<?= $trabalho['id']?>" 
                                   onclick="Anotacao.selTrabalho(<?= $trabalho['id']?>)">
                        </td>
                    </tr>

                    <?php endforeach?>
                </tbody>
            </table>    
        </div>
        <div class="anotacao-form">
            <?= $frmAnotacao?>
        </div>
    </div>
    
</div>
