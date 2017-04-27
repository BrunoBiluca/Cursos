<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reset.css" />
    </head>
    <body>
        <?php
        require './_app/Config.include.php';

        trigger_error("Este é um NOTICE!", E_USER_NOTICE);
        trigger_error("Este é um ALERTA!", E_USER_WARNING);
        //trigger_error("Este é um ERRO!", E_USER_ERROR);
        PHPErro(WS_ERROR, "Este é um ERRO personalizado", __FILE__, __LINE__);

        WSErro("Este é um ACCEPT!", WS_ACCEPT);

        try {
            throw new Exception("Esta é uma EXCESSÃO!", E_USER_WARNING);
        } catch (Exception $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            WSErro($e->getMessage(), $e->getCode());
        }
        ?>
    </body>
</html>
