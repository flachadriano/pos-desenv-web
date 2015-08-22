<?php include "../include/global.php";

if($_POST['acao']=="enviar")
{
    $LoginCliente=new LoginCliente($_POST['agencia'],$_POST['conta'],$_POST['senha'],$_POST['senha_letra']);
    if($LoginCliente->login())
    {
        header("Location: principal.php");
    }
    else
    {
        $motivo=$LoginCliente->getMotivo();
        if($motivo=="TENTATIVAS")
        {
            $msg="Você ultrapassou o limite de tentativas de acesso";
        }
        else if($motivo=="DADOS")
        {
            $msg="Agência ou conta incorretos";
        }
        else if($motivo=="SENHA_NUMERICA")
        {
            $msg="Sua senha numérica está incorreta";
        }
        else if($motivo=="SENHA_LETRA")
        {
            $msg="Sua senha de letras está incorreta";
        }
    }
    
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
        <h1>Bem vindo ao Banco PW11</h1>
        <?php echo $msg; ?>
        <form action="index.php" method="post">
            <input type="hidden" name="acao" value="enviar" />
            <input type="text" name="agencia" placeholder="Agência" /><br />
            <input type="text" name="conta" placeholder="Conta" /><br />
            <input type="password" name="senha" placeholder="Senha numérica" /><br />
            <input type="password" name="senha_letra" placeholder="Senha de letras" /><br />
            
            <input type="submit" value="Entrar" />
        </form>
    </body>
</html>
