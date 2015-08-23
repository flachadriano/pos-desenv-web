<?php
header ( 'Content-type: text/html; charset: UTF-8' );

$q = new Query ();
$r = $q . get ( "categories", $_GET ["id"] );

echo "<form action='/app/categories/update.php' method='POST'>";

echo "Id: <input type='hidden' name='id' value=" . $_GET ["id"] . ">";
echo "Nome: <input type='text' name='name' value=" . $r ["name"] . "><br/>";
echo "<input type='submit' value='Alterar categoria'>";

echo "</form>";

?>