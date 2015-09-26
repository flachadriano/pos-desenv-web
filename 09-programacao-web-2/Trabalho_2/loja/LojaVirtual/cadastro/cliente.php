<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="../../js/jquery-2.1.4.min.js"></script>
    <title>Cadastro Produto</title>
</head>
<body>
    <form id="formCliente">
        <input type="text" name="nome" placeholder="Nome" />
        <input type="text" name="sobrenome" placeholder="Sobrenome" />
        <input type="text" name="email" placeholder="Email" />
        <input type="text" name="endereco" placeholder="Endereco" />
        <input type="text" name="cep" placeholder="Cep" />
        <input type="text" name="estado" placeholder="Estado" />
        <input type="password" name="senha" placeholder="Senha" />
        <input type="button" value="Cadastrar Cliente" onClick="novoCliente()"/>
    </form>
    <script>
        function novoCliente(){
            var formData = $('#formCliente').serializeArray()
            .reduce(function (a, x) {
                a[x.name] = x.value;
                return a;
            }, {});

            $.post('../../wrapper.php', JSON.stringify({
                class: 'Cliente',
                method: 'Insert',
                params: formData
            }))
            .done( function(data) {
                console.log(data);
            });
        }
    </script>
</body>
</html>
