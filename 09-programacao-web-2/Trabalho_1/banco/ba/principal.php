<?php

include "../include/global.php";

$SessaoFuncionario=new SessaoFuncionario;

if($SessaoFuncionario->verificaSessao())
{
    $idFuncionario=$SessaoFuncionario->verificaSessao();
    $Funcionario_DAO=new Funcionarios_DAO;
    $Funcionario=$Funcionario_DAO->consultar($idFuncionario);
}

$Cliente_DAO=new Cliente_DAO;
$lista=$Cliente_DAO->listar();

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
        Olá, <?php echo $Funcionario->getNome(); ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Agencia</th>
                <th>Conta</th>
                <th>Saldo</th>
                <th>Limite Cheque Especial</th>
            </tr>
            <?php foreach($lista as $Cliente) {?>
            <tr>
                <td><?php echo $Cliente->getId();?></td>
                <td><?php echo $Cliente->getNome();?></td>
                <td><?php echo $Cliente->getAgencia();?></td>
                <td><?php echo $Cliente->getConta();?></td>
                <td><?php echo $Cliente->getSaldo();?></td>
                <td><?php echo $Cliente->getSaldo_especial();?></td>
            </tr>
            <?php } ?>
        </table>
        
        <a href="lista_cliente_pdf.php">Gerar PDF</a>
    </body>
</html>
