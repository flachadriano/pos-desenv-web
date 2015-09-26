<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <title>Loja virtual</title>
</head>
<body>
    <nav>
        <ul id='categorias' />
    </nav>
    <script>
        $(document).ready(function() {
            $.ajax({
                url:'../wrapper.php',
                data: JSON.stringify({
                    class: 'Categoria',
                    method: 'ListAll',
                    params: ''
                }),
                type:'POST',
                dataType: 'JSON',
                success: function( listaCategorias ) {
                    $.each(listaCategorias, function(i, categoria) {
                       var eleCat = $('<li>', {text:categoria.nome}).attr('value', categoria.id).appendTo('#categorias');

                       $.ajax({
                           url:'../wrapper.php',
                           data: JSON.stringify({
                               class: 'Categoria',
                               method: 'GetProdutosPorCategoria',
                               params: {id:  categoria.id}
                           }),
                           type:'POST',
                           dataType: 'JSON',
                           success: function( listaProdutos ) {
                               if(listaProdutos.length > 0){
                                   var listaProd = $('<ul>').appendTo(eleCat);
                                   $.each(listaProdutos, function(i, produto) {
                                      var prod = $('<li>').attr('value', produto.id).appendTo(listaProd);
                                        $('<span>').attr('id', 'nome').text(produto.nome).appendTo(prod);
                                        $('<br>').appendTo(prod);
                                        $('<img>').attr('id', 'foto')
                                            .attr('src', 'http://localhost/loja/img/fotos/' + produto.id + '.jpg')
                                            .attr('style', 'height:100px;')
                                            .appendTo(prod);
                                        $('<br>').appendTo(prod);
                                        $('<span>').attr('id', 'valor').text(produto.preco).appendTo(prod);
                                        $('<br>').appendTo(prod);
                                        $('<span>').attr('id', 'descricao').text(produto.descricao).appendTo(prod);
                                        $('<br>').appendTo(prod);
                                        $('<input>').attr('type', 'button')
                                            .attr('type', 'button')
                                            .attr('onclick', 'adicionarNoCarrinho("' + produto.id + '")')
                                            .attr('value', 'Adicionar no carrinho')
                                            .appendTo(prod);
                                   });
                               }
                           }
                       });
                    });
                }
            });
        });
        function adicionarNoCarrinho(idProduto)
        {
            alert('Adicionado produto ' + idProduto + ' no carrinho.');
        }
    </script>
</body>
</html>
