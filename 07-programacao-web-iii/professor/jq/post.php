<?php
$nome = $_POST['Nome'];
$sobreNome = $_POST['Sobrenome'];

header('Content-type: text/html; charset: utf-8');
echo "Bem vindo '$nome $sobreNome!'";