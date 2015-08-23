<?php
include "../framework/framework.php";

$q = new Queries ();

echo "<a href='clients/new.php'>Novo cliente</a>";

echo "<table>";

echo "<tr>";
echo "<th>Nome</th>";
echo "<th>E-mail</th>";
echo "</tr>";

foreach ( $q->listEntities ( "clients" ) as $record ) {
	echo "<tr>";
	echo "<td>" . $record ["name"] . "</td>";
	echo "<td>" . $record ["email"] . "</td>";
	echo "<td><a href='clients/edit.php?id=" . $record ["id"] . "'>Editar</a></td>";
	echo "<td><a href='clients/destroy.php?id=" . $record ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}

echo "</table>";

?>