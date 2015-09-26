<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <script src='../js/jquery-2.1.4.min.js'></script>
    <title>Loja virtual</title>
</head>
<body>
    <form id='formProduto'>
    	<label for='Nome'>Nome:</label>
    	<input type='text' name='nome' size='35' />

    	<label for='Email'>E-mail:</label>
    	<input type='text' name='email' size='35' />

    	<label for='Mensagem'>Mensagem:</label>
    	<textarea name='mensagem' rows='8' cols='40'></textarea>

    	<input type='button' onclick='enviar()' value='Enviar' />
    </form>
    <script>
        function enviar(){
            var formData = $('#formProduto').serializeArray()
            .reduce(function (a, x) {
                a[x.name] = x.value;
                return a;
            }, {});
            $.post('../wrapper.php', JSON.stringify({
                class: 'Email',
                method: 'Enviar',
                params: formData
            }))
            .done( function(data) {
                console.log(data);
            });
        }
    </script>
</body>
</html>
