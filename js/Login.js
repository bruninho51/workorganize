function logar(){
   var inputlSenha = document.getElementById('lSenha');
   inputlSenha.value = (md5(inputlSenha.value)).toLowerCase();
   document.fmLogin.submit();
}