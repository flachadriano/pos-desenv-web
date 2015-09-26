<?php
header ( 'Content-type: text/html; charset: UTF-8' );

$q = new Query ();
$r = $q . get ( "products", $_GET ["id"] );

echo "<form action='/app/products/update.php' method='POST'>";

echo "Id: <input type='hidden' name='id' value=" . $_GET ["id"] . ">";
echo "Nome: <input type='text' name='name' value=" . $r ["name"] . "><br/>";
echo "Descrição: <input type='text' name='description' value=" . $r ["description"] . "><br/>";
echo "<input type='submit' value='Alterar produto'>";

echo "</form>";

?>