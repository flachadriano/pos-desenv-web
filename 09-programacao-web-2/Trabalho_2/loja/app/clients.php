<?php
include "../framework/framework.php";

$q = new Queries ();

echo "<a href='clients/new.php'>Novo cliente</a>";

echo "<table>";

echo "<tr>";
echo "<th>Nome</th>";
echo "<th>E-mail</th>";
echo "</tr>";

echo $q->listEntities ( "clients" );

echo "</table>";

?>