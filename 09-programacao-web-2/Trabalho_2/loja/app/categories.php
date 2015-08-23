<?php
include "../framework/framework.php";

$q = new Queries ();

echo "<a href='products/new.php'>Nova categoria</a>";

echo "<table>";

echo "<tr>";
echo "<th>Nome</th>";
echo "</tr>";

foreach ( $q->listEntities ( "categories" ) as $record ) {
	echo "<tr>";
	echo "<td>" . $record ["name"] . "</td>";
	echo "<td><a href='categories/edit.php?id=" . $record ["id"] . "'>Editar</a></td>";
	echo "<td><a href='categories/destroy.php?id=" . $record ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}

echo "</table>";

?>