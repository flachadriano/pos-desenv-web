<?php
include "../include/global.php";

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $msg = (new Ba)->loginFuncionario($_POST['usuario'], $_POST['senha']);
} else {
    $msg = null;
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
