<?php

include "../include/global.php";

$Sessao=new Sessao;

if($Sessao->verificaSessao())
{
    $idCliente=$Sessao->verificaSessao();
    $Cliente_DAO=new Cliente_DAO;
    $Cliente=$Cliente_DAO->consultar($idCliente);
    $Movimentacao=new Movimentacao($Cliente);
    
    $retorno=$Movimentacao->pagamento($_POST['valor'], $_POST['dataVencimento'], $_POST['codigoBoleto']);
    
    if($retorno)
    {
        $retornoJSON['status']="sucesso";
        $retornoJSON['msg']='Operação realizada com sucesso';
    }
    else
    {
        $retornoJSON['status']="erro";
        $retornoJSON['msg']=$Movimentacao->getErro();
    }
    
    echo json_encode($retornoJSON);
}
?>