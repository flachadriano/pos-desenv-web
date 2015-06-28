<?php
$nome = $_POST['nome'];
$sobreNome = $_POST['sobreNome'];

header('Contente-type: text/html, charset:utf-8');
echo $nome . ' ' . $sobreNome;

//echo "$nome $sobreNome";

//echo 'Furb - Pós web';