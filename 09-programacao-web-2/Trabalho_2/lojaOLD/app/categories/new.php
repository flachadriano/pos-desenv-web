<?php

header('Content-type: text/html; charset: UTF-8');

echo "<form action='/app/categories/create.php' method='POST'>";

echo "Nome: <input type='text' name='name'><br/>";
echo "<input type='submit' value='Criar categoria'>";

echo "</form>";

?>