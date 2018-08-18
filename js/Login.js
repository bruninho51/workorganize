function logar(){

   var inputlSenha = document.fmLogin.senha;
   inputlSenha.value = (md5(inputlSenha.value)).toLowerCase();
   document.fmLogin.submit();
}