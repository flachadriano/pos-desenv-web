<?php

if(isset($_POST['usuario']) && isset($_POST['senha']))
{
    if($_POST['usuario']=="posweb" && $_POST['senha']=="furb")
    {
        session_start();
        $_SESSION['usuario']="furb";
        header("Location: ib/index.php");
    }
    else
    {
        $msg="Usuário e/ou senha incorretos";
    }
}
else
{
    $msg=null;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $msg; ?>
        <form action="login.php" method="post">
            <input type="text" name="usuario" placeholder="Usuário:" />
            <input type="password" name="senha" placeholder="Senha:" />
            <input type="submit" value="Entrar" />
        </form>
    </body>
</html>
