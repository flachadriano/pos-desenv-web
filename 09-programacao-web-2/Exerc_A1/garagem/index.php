<?php

try
{
    $Conexao = new PDO("mysql:host=localhost;port=3306;dbname=garagem", "root", "root");
    $resultado = $Conexao->query("select * from carros")->fetchAll();
    //print_r($resultado);
    
    foreach ($resultado as $carro)
    {
        echo $carro['nome']."<br />";
    }
}
catch (PDOException $i)
{
    print $i->getMessage();
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
        // put your code here
        ?>
    </body>
</html>
