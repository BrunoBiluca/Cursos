<html>
    <head>
        <meta charset="UTF-8">
        <script language="JavaScript" type="text/javascript" src="mascaraValidacao.js"></script> 
        <title>Sistema do Hospital de TownsVille</title>
    </head>
    <body>
        <form action="../../controle/insercao/inserirConsultorio.php" method="post">
        <table width="500px" align="center">
        <tr>  
        <td width="100px">
            <b>Patrimônio:</b>
        </td>
        <td>
            <input type="text" name="patrimonio">
        </td>
        </tr>
        <tr>  
        <td width="100px">
            <b>Manutenção:</b>
        </td>
        <td>
            <input type="text" name="manutencao">
        </td>
        </tr>
        <tr>
        <td width="100px">
            <b>Local:</b>
        </td>
        <td>
            <input type="text" name="local">
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