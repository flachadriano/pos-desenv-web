<?php
"Queries.php";
class Categoria{
    function Insert($categoria)
    {
        echo (new Queries)->Insert('categoria', $categoria);
    }
    function Update($categoria)
    {
        echo (new Queries)->Update('categoria', $categoria);
    }
    function Delete($categoria)
    {
        echo (new Queries)->Delete('categoria', $categoria);
    }
    function ListAll()
    {
        echo (new Queries)->ListAll('categoria');
    }
    function Get($categoria)
    {
        echo (new Queries)->Get('categoria', $categoria);
    }
    function GetProdutosPorCategoria($categoria)
    {
        echo (new Queries)->ListAllComFiltro('produto', " categoria = $categoria->id ");
    }
}
?>
