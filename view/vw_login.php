<?php lib\factory\FactoryJS::js('md5')?>
<?php lib\factory\FactoryJS::js('Login')?>
<div>
    <div id="lContainer">
        <form action="?mod=Login&act=logar" method="POST" name="fmLogin">
            <div class="lrow" id="lMarca">
                <h1 id="h1Marca">
                    WorkOrganize
                    <!--<img src="view/assets/img/workorganize.png" alt="marca" id="lMarcaImg">-->
                </h1>
                <h2 id="lmarcaTitulo"></h2>
            </div>

            <div class="lrow">
                <input id="lUsuario" type="text" placeholder="Usuário.." name="usuario">
            </div>
            <div class="lrow">
                <input id="lSenha" type="password" placeholder="Senha.." name="senha">
            </div>
            <div class="lrow">
                <input type="checkbox" id="lLembreme" value="remember" name="lembreme">
                <label for="lLembreme" id="lembreme">Lembre-me</label>
            </div>
            <div class="lrow">
                <input id="lLogar" type="submit" value="LOGIN" onclick="logar.call(this)">
            </div>

            <div class="lrow links">
                <a id="lRegistrar" href="#">Registre-se Agora</a>
                <a id="lEsqueceuSenha" href="#">Esqueceu a senha?</a>
            </div>
            <?php if( isset($_POST) && isset($_POST['usuario']) ): ?>
                <div class="lrow erro" style="font-size: small;color: red;font-weight:bold;">Usuário ou senha inválidos!</div>
            <?php endif;?>
        </form>
    </div>
</div>