<?php

header('Content-type: text/html; charset: UTF-8');

echo "<form action='/app/clients/create.php' method='POST'>";

echo "Nome: <input type='text' name='name'><br/>";
echo "Sobrenome: <input type='text' name='last-name'><br/>";
echo "E-mail: <input type='text' name='email'><br/>";
echo "Endereço: <input type='text' name='address'><br/>";
echo "CEP: <input type='text' name='cep'><br/>";
echo "Cidade: <input type='text' name='city'><br/>";
echo "Estado: <input type='text' name='state'><br/>";
echo "Senha: <input type='text' name='password'><br/>";
echo "<input type='submit' value='Criar cliente'>";

echo "</form>";

?>