<?php

if($_POST['acao']=="enviar")
{
    echo $_POST['nome']."<br />";
    echo $_POST['telefone']."<br />";
    echo $_POST['email']."<br />";
    echo $_POST['assunto']."<br />";
    echo $_POST['mensagem'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="index.php" method="post">
            <input type="hidden" name="acao" value="enviar" />
            <input type="text" name="nome" placeholder="Preencha o nome" /> 
            <input type="tel" name="telefone" placeholder="Preencha seu telefone" />
            <input type="email" name="email" placeholder="Preencha seu e-mail" />
            <input type="text" name="assunto" placeholder="Preencha seu assunto" />
            <textarea name="mensagem" placeholder="Preencha sua mensagem"></textarea>
            <input type="submit" value="Enviar" />
        </form>
    </body>
</html>
