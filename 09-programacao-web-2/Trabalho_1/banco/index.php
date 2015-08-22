<?php
    include "include/global.php";
    
$Login=new LoginCliente(1,1,'abc','abc');
echo $Login->login();
echo $Login->getMotivo();
    
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
