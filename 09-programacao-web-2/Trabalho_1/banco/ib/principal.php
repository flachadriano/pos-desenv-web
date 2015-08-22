<?php

include "../include/global.php";

$Sessao=new Sessao;

if($Sessao->verificaSessao())
{
    $idCliente=$Sessao->verificaSessao();
    $Cliente_DAO=new Cliente_DAO;
    $Cliente=$Cliente_DAO->consultar($idCliente);
    $Movimentacao=new Movimentacao($Cliente);
    $saldo=$Movimentacao->getSaldo();
    $saldoEspecial=$Movimentacao->getSaldoEspecial();
}
else
{
    header("Location: index.php");
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
        <?php
        echo "Bem vindo, ".$Cliente->getNome()."!";
        echo "<br />";
        echo "Seu saldo é de: ".$saldo;
        echo "Seu limite de cheque especial é: ".$saldoEspecial;
        ?>
    </body>
</html>
