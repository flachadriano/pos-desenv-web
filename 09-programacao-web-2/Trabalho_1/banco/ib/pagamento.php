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
        <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="retorno"></div>
        <form action="" id="form_pagamento" method="post">
            <input type="text" name="codigo_boleto" placeholder="Número do boleto" />
            <input type="text" name="data_vencimento" placeholder="Data de vencimento" />
            <input type="text" name="valor" placeholder="Valor" />
            <input type="submit" value="Enviar" />
        </form>
        <script>
    $('#form_pagamento').submit(function(){
        event.preventDefault();  
        var codigo_boleto=$('input[name="codigo_boleto"]').val();
        var data_vencimento=$('input[name="data_vencimento"]').val();
        var valor=$('input[name="valor"]').val();
        $.ajax({
            url: "ajax_pagamento.php",
            global: false,
            type: "POST",
            data:{
                codigoBoleto: codigo_boleto,
                dataVencimento: data_vencimento,
                valor: valor
            },
            dataType: "json",
            success: function(data)
            {
                alert(data.msg);
            }
        }).responseText;
    });
        </script>
    </body>
</html>
