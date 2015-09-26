<?php
include "../framework/framework.php";

$q = new Queries ();

echo "<a href='/app/home.php'>Home</a><br/>";
echo "<a href='/app/categories/new.php'>Nova categoria</a>";

echo "<table>";

echo "<tr>";
echo "<th>Nome</th>";
echo "</tr>";

foreach ( $q->listEntities ( "categories" ) as $record ) {
	echo "<tr>";
	echo "<td>" . $record ["name"] . "</td>";
	echo "<td><a href='/app/categories/edit.php?id=" . $record ["id"] . "'>Editar</a></td>";
	echo "<td><a href='/app/categories/destroy.php?id=" . $record ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}

echo "</table>";

?>