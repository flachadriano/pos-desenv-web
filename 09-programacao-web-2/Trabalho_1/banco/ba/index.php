<?php

include "../include/global.php";

if($_POST['acao']=="enviar")
{
    $LoginFuncionario=new LoginFuncionario($_POST['usuario'],$_POST['senha']);
    $retorno=$LoginFuncionario->login();
    if($retorno==true)
    {
        header("Location: principal.php");
    }
    else
    {
        $msg="Erro no login";
    }
}
else
{
    $msg=null;
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $msg; ?>
        <form action="index.php" method="post">
            <input type="hidden" name="acao" value="enviar" />
            <input type="text" name="usuario" placeholder="Usuário" />
            <input type="text" name="senha" placeholder="Senha" />
            <input type="submit" value="Enviar" />
        </form>
    </body>
</html>
