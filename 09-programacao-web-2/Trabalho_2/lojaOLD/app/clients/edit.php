<?php
header ( 'Content-type: text/html; charset: UTF-8' );

$q = new Query ();
$r = $q . get ( "clients", $_GET ["id"] );

echo "<form action='/app/clients/update.php' method='POST'>";

echo "Id: <input type='hidden' name='id' value=" . $_GET ["id"] . ">";
echo "Nome: <input type='text' name='name' value=" . $r ["name"] . "><br/>";
echo "Sobrenome: <input type='text' name='last_name' value=" . $r ["last_name"] . "><br/>";
echo "E-mail: <input type='text' name='email' value=" . $r ["email"] . "><br/>";
echo "Endereço: <input type='text' name='address' value=" . $r ["address"] . "><br/>";
echo "CEP: <input type='text' name='cep' value=" . $r ["cep"] . "><br/>";
echo "Cidade: <input type='text' name='city' value=" . $r ["city"] . "><br/>";
echo "Estado: <input type='text' name='state' value=" . $r ["state"] . "><br/>";
echo "Senha: <input type='text' name='password' value=" . $r ["password"] . "><br/>";
echo "<input type='submit' value='Alterar cliente'>";

echo "</form>";

?>