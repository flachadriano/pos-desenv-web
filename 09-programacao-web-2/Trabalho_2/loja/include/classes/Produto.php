<?php
"Queries.php";
class Produto
{
    function Insert($produto)
    {
        $foto = $produto->foto;
        if (isset($foto) && $foto != NULL)
        {
            list($type, $data) = explode(';', $produto->foto);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $produto->foto = 1;
            $produto->id = (new Queries)->Insert('produto', $produto);

            file_put_contents('img/fotos/' . $produto->id . '.jpg', $data);
        }else {
            $produto->foto = 0;
            (new Queries)->Insert('produto', $produto);
        }


    }
    function Update($produto)
    {
        (new Queries)->Update('produto', $produto);
    }
    function Delete($produto)
    {
        (new Queries)->Delete('produto', $produto);
    }
    function ListAll($produto)
    {
        (new Queries)->ListAll('produto', $produto);
    }
    function Get($produto)
    {
        (new Queries)->Get('produto', $produto);
    }
}
?>
