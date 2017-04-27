<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $email = "contato@gmail.com";
            if(Check::Email($email)){
                echo "Email Válido!<hr>";
            }else{
                echo "Email Inválido!<hr>";
            }
            
            $url = "Você está fazendo tudo certo! Só que não!";
            echo Check::Nome($url). "<hr>";
            
            $data = "13/09/1992";
            echo Check::Data($data) . "<hr>";
            
            $str = "Este curso está sendo muito legal e informativo! Da hora a vida!";
            echo Check::Words($str, 6, "<small>Continue lendo...</small>") . "<hr>";
            
            echo Check::CatByName('artigos') . "<hr>";
            
            echo "Temos " . Check::UserOnline() . " usuários online no momento " . "<hr>";
            
            echo Check::Image('google.jpg', "Google", 300, 200);
            
        ?>
    </body>
</html>
