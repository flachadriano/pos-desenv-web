<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="../../js/jquery-2.1.4.min.js"></script>
    <title>Cadastro Categoria</title>
</head>
<body>
    <form id="formCategoria">
        <input type="text" name="nome" placeholder="Nome" />
        <input type="button" value="Cadastrar Categoria" onClick="novaCategoria()"/>
    </form>
    <script>
        function novaCategoria(){
            var formData = $('#formCategoria').serializeArray()
            .reduce(function (a, x) {
                a[x.name] = x.value;
                return a;
            }, {});

            $.post('../../wrapper.php', JSON.stringify({
                class: 'Categoria',
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
