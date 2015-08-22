<?php 
//Carregando a biblioteca mPDF
include('../mpdf/mpdf.php');
include('../include/global.php');

//Inicia o buffer, qualquer HTML que for sair agora sera capturado para o buffer
ob_start();

$Cliente_DAO=new Cliente_DAO;
$lista=$Cliente_DAO->listar();
$html="";
$html.='<table style="background-color: #dfdfdf;">';
$html.='<tr>';
$html.='<th>Nome</th>';
$html.='<th>Saldo</th>';
$html.='</tr>';
foreach ($lista as $Cliente)
{
    $html.='<tr>';
    $html.='<td>'.$Cliente->getNome().'</td>';
    $html.='<td>'.$Cliente->getSaldo().'</td>';
    $html.='</tr>';
}
$html.='</table>';

//Limpa o buffer jogando todo o HTML em uma variavel.
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
//Colocando o rodape
$mpdf->SetFooter('{DATE j/m/Y H:i}|Página {PAGENO} de {nb}|www.furb.br');
$mpdf->Output();
exit;
?>