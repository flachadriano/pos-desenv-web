<?php
"Queries.php";
class Cliente{
    function Insert($cliente)
    {
        $clientes = json_decode((new Queries)->ListAllComFiltro('cliente', " email = '$cliente->email' "));
        if (count($clientes) > 0)
        {
            trigger_error("O cliente $cliente->nome não pode ser cadastrado pois o e-mail $cliente->email já existe na base de dados.");
            return;
        }
        (new Queries)->Insert('cliente', $cliente);
    }
    function Update($cliente)
    {
        (new Queries)->Update('cliente', $cliente);
    }
    function Delete($cliente)
    {
        (new Queries)->Delete('cliente', $cliente);
    }
    function ListAll($cliente)
    {
        (new Queries)->ListAll('cliente', $cliente);
    }
    function Get($cliente)
    {
        (new Queries)->Get('cliente', $cliente);
    }
}
?>
