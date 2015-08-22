<?php
include "../include/global.php";
$clientes = (new Ba)->listarClientes();

function novo() {
    echo 'chamou';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <input type="button" name="novo" id="novo" value="Novo" />
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Saldo</th>
                    <th>Tentativas de login</th>
                    <th>Foto</th>
                    <th>Acao</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($clientes)) { ?>
                    <?php foreach ($clientes as $cliente) { ?>
                        <tr>
                            <td><?php echo $cliente["nome"] ?></td>                        
                            <td><?php echo $cliente["saldo"] ?></td>                        
                            <td><?php echo $cliente["tentativasLogin"] ?></td>                        
                            <td>Foto
                                <!--Decidir o que fazer com a foto-->
                            </td>  
                            <td>
                                <div>
                                    <input type="button" name="editar_<?php echo $cliente["id"] ?>" value="Editar" onclick="editar(this)" />
                                    <input type="button" name="logs_<?php echo $cliente["id"] ?>" value="Logs" />
                                    <input type="button" name="excluir_<?php echo $cliente["id"] ?>" value="Excluir" />
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>            
        </table>        
        <script>
            $(document).ready(function () {
                $('#novo').click(function () {
                    if ($('table tbody ').find('input[type="text"]').length === 0) {
                        var linha = $('<tr>');
                        linha.append($('<td>').append($('<input type="text" name="nome" />')));
                        linha.append($('<td>').append($('<input type="number" pattern="[0-9]+([\\.|,][0-9]+)?" step="0.01" name="saldo"/>')));
                        linha.append($('<td>').append($('<input type="text" name="tentativasLogin" disabled />')));
                        linha.append($('<td>').append($('<input type="text" name="Foto" text/>')));
                        linha.append($('<div>')
                                .append($('<input type="button" name="editar_0" value="Editar" />'))
                                .append($('<input type="button" name="logs_0" value="Logs" disabled/>'))
                                .append($('<input type="button" name="excluir_0" value="Excluir" />')));
                        $('table tbody').append(linha);
                    }
                });
            });
            function editar(sender) {
                var cols = $(sender).closest('tr').find('td');

                var tempVal = $(cols[0]).text();
                $(cols[0]).empty();
                $(cols[0]).append($('<input type="text" name="nome" value="' + tempVal + '">'));

                tempVal = $(cols[1]).text();
                $(cols[1]).empty();
                $(cols[1]).append($('<input type="number" name="valor" pattern="[0-9]+([\\.|,][0-9]+)?" step="0.01" value="' + tempVal + '">'));

                tempVal = $(cols[2]).text();
                $(cols[2]).empty();
                $(cols[2]).append($('<input type="number" name="tentativasLogin" disabled value="' + tempVal + '">'));

                tempVal = $(cols[4]).find('input[type="button"]');
                $(tempVal).each(function (i) {
                    $(tempVal).prop('hidden', true);
                });

                $(cols[4]).append($('<input type="button" name="salvar" value="Salvar" onclick="salvar(this, ' + $(sender).attr('name').replace('editar_', '') + ')">'));
            }
            ;

            function salvar(sender, id) {
                var inputs = $(sender).closest('tr').find('input[type!="button"]');
                var cliente = new Object();
                cliente.class = 'Ba';
                cliente.method = 'atualizarCliente';

                var tempVal = $(inputs[0]).val();
                var td = $(inputs[0]).parent();
                cliente.nome = tempVal;
                $(inputs[0]).remove();
                $(td).text(tempVal);

                tempVal = $(inputs[1]).val();
                td = $(inputs[1]).parent();
                cliente.saldo = tempVal;
                $(inputs[1]).remove();
                $(td).text(tempVal);

                tempVal = $(inputs[2]).val();
                td = $(inputs[2]).parent();
                //cliente.nome = tempVal; tentativasLogin não precisa ir para o servidor
                $(inputs[2]).remove();
                $(td).text(tempVal);

                tempVal = $(inputs[4]).find('input[type="button"]');
                $(tempVal).each(function (i) {
                    $(tempVal).prop('hidden', true);
                });

                tempVal = $(sender).parent();
                $(sender).remove();
                tempVal = $(tempVal).find('input[type="button"]');
                $(tempVal).each(function (i) {
                    $(tempVal).prop('hidden', false);
                });

                $.post("../wrapper.php", data: JSON.stringify(cliente))
                        .done(function (data) {
                            alert(JSON.stringify(data));
                            alert("Cliente atualizado com sucesso.");
                        })
                        .fail(function (data) {
                            alert(JSON.stringify(data));
                            alert("Erro ao atualizar cliente");
                        });
            }

        </script>
    </body>
</html>