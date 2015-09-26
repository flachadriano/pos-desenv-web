<?php

header('Content-type: text/html; charset: UTF-8');

echo "<form action='/app/products/create.php' method='POST'>";

echo "Nome: <input type='text' name='name'><br/>";
echo "Descrição: <input type='text' name='description'><br/>";
echo "<input type='submit' value='Criar produto'>";

echo "</form>";

?>