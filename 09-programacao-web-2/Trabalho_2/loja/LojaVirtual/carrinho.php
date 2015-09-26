<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/jquery.maskedinput.min.js"></script>
    <title>Carrinho</title>
</head>
<body>
    <form id="consultaCEP">
        <input type="text" name="cep" id="cep"  placeholder="CEP" maxlength="9"/>
        <input type="button" onclick="consultaCEP()" value="Consultar CEP"/>
    </form>
    <script>
        $(document).ready(function() {
            $('#cep').mask('99999-999')
        });
        function consultaCEP()
        {
            //frete e prazo
            $.get('http://correios-server.herokuapp.com/frete/prazo?'
                + 'nCdServico=41106' // pac
                + '&sCepOrigem=22041030'
                + '&sCepDestino=' + $('#cep').val().replace(/[^0-9]/g, '')
                + '&nVlPeso=1' //em kg
                + '&nCdFormato=1'//caixa
                + '&nVlComprimento=20'
                + '&nVlAltura=20'//em cm
                + '&nVlLargura=20'//em cm
                + '&nVlDiametro=20'//em cm
                + '&nVlValorDeclarado=50')
                .done(function(data) {
                {
                    alert(data);
                }});
        }

    </script>
</body>
</html>
