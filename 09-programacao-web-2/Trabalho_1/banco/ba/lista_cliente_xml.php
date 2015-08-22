<?php 
include('../include/global.php');

$xml= new SimpleXMLElement('<?xml version="1.0" ?><clientes />');
$Cliente_DAO=new Cliente_DAO;
$lista=$Cliente_DAO->listar();
foreach ($lista as $Cliente)
{
    $xml->addChild('cliente', $Cliente->getNome());
}
//exibindo o novo XML
echo $xml->asXML();
//grava no arquivo usuarios.xml
file_put_contents('usuarios.xml',$xml->asXML());
?>