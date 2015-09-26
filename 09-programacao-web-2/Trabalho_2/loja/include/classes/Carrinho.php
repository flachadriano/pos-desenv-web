<?php
"Queries.php";
class Carrinho{
    function Insert($carrinho)
    {
        (new Queries)->Insert('carrinho', $carrinho);
    }
    function Update($carrinho)
    {
        (new Queries)->Update('carrinho', $carrinho);
    }
    function Delete($carrinho)
    {
        (new Queries)->Delete('carrinho', $carrinho);
    }
    function ListAll($carrinho)
    {
        (new Queries)->ListAll('carrinho', $carrinho);
    }
    function Get($carrinho)
    {
        (new Queries)->Get('carrinho', $carrinho);
    }
}
?>
