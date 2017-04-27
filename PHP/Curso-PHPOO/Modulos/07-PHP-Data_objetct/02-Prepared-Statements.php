<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Prepared Statements</title>
    </head>
    <body>
        <?php
            //Prepared Statements é uma forma de deixar as operações com o banco de dados mais seguras
            //É utilizado uma etapa de preparação antes da query ser executada, a fim de não passar nenhum valor diretamente para o banco
        
            require './_app/Config.include.php';
            
            $pdo = new Conn();
            
            $name = "IE";
            $views = 2;
            
            try {
                
                $queryCreate = "INSERT INTO ws_siteviews_agent (agent_name, agent_views) VALUES (? , ?)";
                $create = $pdo->GetConn()->prepare($queryCreate);
                
                //Passando os valores diretamente
//                $create->bindValue(1, "Firefox", PDO::PARAM_STR);
//                $create->bindValue(2, 250, PDO::PARAM_INT);

                //Passando os valores por parâmetros, mais seguro porém mais restritivo
                $create->bindParam(1, $name, PDO::PARAM_STR, 15);
                $create->bindParam(2, $views, PDO::PARAM_INT, 5);
                
                //$create->execute();
                
                if($create->rowCount()){
                    echo "{$pdo->GetConn()->lastInsertId()} - Cadastro criado com sucesso!";
                }
                
                $querySelect = "SELECT * FROM ws_siteviews_agent WHERE agent_views >= :visitas";
                $select = $pdo->GetConn()->prepare($querySelect);
                
                $select->bindValue(":visitas", 1);
                
                $select->execute();
                
                if($select->rowCount() >= 1){
                    echo "A pesquisa retornou {$select->rowCount()} resutado(s)!<hr>";
                    $result = $select->fetchAll(PDO::FETCH_ASSOC);
                    var_dump($result);
                }else{
                    echo "Nenhum resultado foi encontrado! <hr>";
                }
                
            } catch (PDOException $e) {
                PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
                die;
            }
        ?>
    </body>
</html>
