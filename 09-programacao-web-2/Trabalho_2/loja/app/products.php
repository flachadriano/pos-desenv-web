<?php
include "../framework/framework.php";

$q = new Queries ();

echo "<a href='products/new.php'>Novo produto</a>";

echo "<table>";

echo "<tr>";
echo "<th>Nome</th>";
echo "<th>Preço</th>";
echo "</tr>";

foreach ( $q->listEntities ( "products" ) as $record ) {
	echo "<tr>";
	echo "<td>" . $record ["name"] . "</td>";
	echo "<td>" . $record ["price"] . "</td>";
	echo "<td><a href='products/edit.php?id=" . $record ["id"] . "'>Editar</a></td>";
	echo "<td><a href='products/destroy.php?id=" . $record ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}

echo "</table>";

?>