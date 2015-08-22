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

if($_POST['acao']=="inserir")
{
    $Cliente=new Cliente(null, $_POST['agencia'], $_POST['conta'], $_POST['senha'], $_POST['senha_letras'], $_POST['saldo'], $_POST['nome'], $_POST['tentativas'], $_POST['saldo_especial'], 0);
    $retorno=$Cliente_DAO->inserir($Cliente);
    if($retorno)
    {
        $Cliente->setId($Cliente_DAO->ultimoID());
        $FotoCliente=new FotoCliente($Cliente);
        $FotoCliente->upload();
        
        $msg="Cliente cadastrado com sucesso";
    }
    else
    {
        $msg="Erro ao inserir";
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
        <?php echo $msg; ?>
        <form action="cliente.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="acao" value="inserir" />
            <input type="text" name="nome" placeholder="Nome: " />
            <input type="text" name="agencia" placeholder="Agência: " />
            <input type="text" name="conta" placeholder="Conta: " />
            <input type="password" name="senha" placeholder="Senha: " />
            <input type="password" name="senha_letras" placeholder="Senha de letras: " />
            <input type="text" name="saldo" placeholder="Saldo: " />
            <input type="text" name="saldo_especial" placeholder="Limite cheque especial: " />
            <input type="text" name="tentativas" placeholder="Tentativas de acesso internet banking " />
            <input type="file" name="foto" placeholder="Arquivo de foto" />
            <input type="submit" value="Enviar" />
        </form>
    </body>
</html>
