<html>
    <head>
        <meta charset="UTF-8">
        <script language="JavaScript" type="text/javascript" src="../mascaraValidacao.js"></script> 
        <title>Sistema do Hospital de TownsVille</title>
    </head>
    <body>
        <form action="../../controle/insercao/inserir.php" method="post">
        <table width="500px" align="center">
        <tr>    <!Login>
        <td width="100px">
            <b>Login:</b>
        </td>
        <td>
            <input type="text" name="login">
        </td>
        </tr>
        <tr>    <!Senha>
        <td width="100px">
            <b>Senha:</b>
        </td>
        <td>
            <input type="password" name="senha">
        </td>
        </tr>
        <tr>    <!CEP>
        <td width="100px">
            <b>CPF:</b>
        </td>
        <td>
            <input type="text" name="cpf" onkeypress="mascara(this, '###.###.###-##')" maxlength="14">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Nome:</b>
        </td>
        <td>
            <input type="text" name="nome">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Idade:</b>
        </td>
        <td>
            <input type="text" name="idade">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Sexo:</b>
        </td>
        <td>
            <input type="text" name="sexo">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Rua:</b>
        </td>
        <td>
            <input type="text" name="rua">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Número:</b>
        </td>
        <td>
            <input type="text" name="numero">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Bairro:</b>
        </td>
        <td>
            <input type="text" name="bairro">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Complemento:</b>
        </td>
        <td>
            <input type="text" name="complemento">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Cidade:</b>
        </td>
        <td>
            <input type="text" name="cidade">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Estado:</b>
        </td>
        <td>
            <input type="text" name="estado">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>CEP:</b>
        </td>
        <td>
            <input type="text" name="cep" onkeypress="mascara(this, '#####-###')" maxlength="9">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Telefone Residencial:</b>
        </td>
        <td>
            <input type="text" name="telefoneR" onkeypress="mascara(this, '## ####-####')" maxlength="12">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Celular:</b>
        </td>
        <td>
            <input type="text" name="celular" onkeypress="mascara(this, '## ####-####')" maxlength="12">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Telefone Comercial:</b>
        </td>
        <td>
            <input type="text" name="telefoneC" onkeypress="mascara(this, '## ####-####')" maxlength="12"> <br>
        </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
            </td>
        </tr>
        </table>
        </form>
    </body>
</html>