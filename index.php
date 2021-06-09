<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title> Site Login </title>
  <meta name="descrição" content="Sistema de login com html,php, css">
  <meta name="palavras-chave" content="criptografia, dados, login">
  <meta name="author" content="Germano Pinheiro">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet " href="style.css">
</head>

<body>
  <?php
        $bol=null;
        function check($eLog,$eSenha)
        {
          $cripL='/^[a-zA-Z]+$/i';
          $cripS='/^[a-zA-Z0-9]+$/i';
          if(preg_match($cripL,$eLog) and preg_match($cripS,$eSenha)){
            return true;
          }
        }
        if(!isset($_POST['enviar']))
        {
        } 
        else{
        $_SESSION['nome'] = $_POST['nome'];
        $_SESSION['senha']= $_POST['senha'];
        $nome= $_SESSION['nome'];
        $senha= $_SESSION['senha'];
      if (!check($nome,$senha))
      {
        die("<p> INCORRETO</p>");
      }
        
        $ponteiro=fopen("arq.txt","r"); 
        if($ponteiro==false){
          die("<h1>INCORRETO</h1>");
        }
        $senha=sha1($senha);
        $arquivo = file('arq.txt');
        foreach($arquivo as $linha ){
          $linha = trim($linha);
          $vetor = explode('|',$linha);

          for($i=0;$i<count($vetor);$i++)
          {
            if("$nome$senha"=="$vetor[$i]")
            {
              echo "<p id='loginin'></p>";
              $bol=true;
              break;
            }
              echo "<p id='logoff'></p>";
          }
        }
        fclose($ponteiro);
      }
  ?>

  <div>

    <h1>Sistema de Login</h1>

    <form action=" <?php $_SERVER['PHP_SELF'];?>" method="post">
      <input pattern="^[a-zA-Z]+$" required="required" type="text" id="nome" name="nome"
        placeholder="Digite seu nome" />
      <input pattern="^[a-zA-Z0-9]+$" required="required" type="password" id="senha" name="senha"
        placeholder="Digite sua senha" />
      <input type="submit" value="Enviar" name="enviar" id="enviar" />
    </form>

  </div>

  <script>
  var login = document.getElementById("loginin")
  var erro = document.getElementById("logoff")

  setTimeout(function() {
    if (login != null) {
      console.log("loginin")
      login.style.color = "rgb(0,0,255)"
      login.innerText = "Login Correto"
    }
    if (login == null) {
      console.log("logoff")
      erro.style.color = "rgb(255,0,0)"
      erro.innerText = "Senha e/ou Email incorretos"
    }
  }, 3000)
  </script>
</body>
</html>