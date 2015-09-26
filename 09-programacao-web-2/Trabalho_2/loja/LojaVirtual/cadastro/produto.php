<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="../../js/jquery-2.1.4.min.js"></script>
    <title>Cadastro Produto</title>
</head>
<body>
    <form id="formProduto">
        <input type="text" name="nome" placeholder="Nome" />
        <input type="text" name="descricao" placeholder="Descricao" />
        <input type="number" type="number" pattern="[0-9]+([\\.|,][0-9]+)?" step="0.01"  name="preco" placeholder="Preço" />
        <input type="file" name="foto" id="foto" placeholder="Foto" />
        <input type="number" name="estoque" placeholder="Estoque" />
        <select name="categoria"  id="categorias" />
        <input type="button" value="Cadastrar Produto" onClick="novoProduto()"/>
    </form>
    <script>
        $(document).ready(function()
        {
            $.ajax({
                url:'../../wrapper.php',
                data: JSON.stringify({
                    class: 'Categoria',
                    method: 'ListAll',
                    params: ''
                }),
                type:'POST',
                dataType: 'JSON',
                success: function( json ) {
                    $.each(json, function(i, value) {
                       $('<option></option>', {text:value.nome}).attr('value', value.id).appendTo('#categorias');
                    });
                }
            });
        });

        function novoProduto()
        {
            var formData = $('#formProduto').serializeArray()
            .reduce(function (a, x) {
                a[x.name] = x.value;
                return a;
            }, {});

            var temFoto = true;
            var file = $('#foto').prop('files')[0];
            if (!(file === undefined)){
                var reader = new FileReader();
                reader.readAsDataURL(file);
                var canRequest = false;
                reader.onload = function(e){
                    if(e && e.target && e.target.result){
                        formData.foto = e.target.result;
                        submitProduto(formData);
                    }
                };
            }else {
                temFoto = false;
            }
        }

        function submitProduto(formData)
        {
            $.post('../../wrapper.php', JSON.stringify({
                class: 'Produto',
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
