function logar(){
   var inputlSenha = $('#lSenha');
   inputlSenha.value = (md5(inputlSenha.value)).toLowerCase();
   document.fmLogin.submit();
}