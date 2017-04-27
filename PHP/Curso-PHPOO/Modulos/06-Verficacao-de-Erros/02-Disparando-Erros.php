<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $uso = "12345678912";
            $cpf = '';
            $cpf = "07313787685";
            
            if(!$cpf):
                trigger_error("Informe seu cpf", E_USER_NOTICE);
            elseif ($cpf == '500') :
                trigger_error("Modelo de cpf não é mais utilizado", E_USER_DEPRECATED);
            elseif ($cpf == $uso) :
                trigger_error("Este cpf já está em uso", E_USER_WARNING);
            elseif (!preg_match("/^[0-9]*$/i", $cpf) && !strlen($cpf) == 11) :
                trigger_error("CPF inválido", E_USER_ERROR);
            endif;
            
            echo "XD";
            
            echo "<hr>";
            
            function Erro($erro, $mensagem, $arquivo, $linha){
                $corErro = ($erro == E_USER_ERROR ? 'red' : ($erro == E_USER_WARNING ? 'darkorange' : 'blue'));
                
                echo "<p style='color:{$corErro}'>Erro na linha # {$linha} : {$mensagem}<br>";
                echo "<small>{$arquivo}</small></p>";
                
            }
            
            set_error_handler('Erro');

            $cpf = '';
            $cpf = 'abs';
            
            if(!$cpf):
                trigger_error("Informe seu cpf", E_USER_NOTICE);
            elseif ($cpf == '500') :
                trigger_error("Modelo de cpf não é mais utilizado", E_USER_DEPRECATED);
            elseif ($cpf == $uso) :
                trigger_error("Este cpf já está em uso", E_USER_WARNING);
            elseif (!preg_match('/^[0-9]*$/i', $cpf) && strlen($cpf) != 11) :
                trigger_error("CPF inválido", E_USER_ERROR);
            endif;
            
            echo "XD";

            
        ?>
    </body>
</html>
