<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.include.php';

        $conn = new Conn();

        try {

            $qSelect = "SELECT * FROM ws_siteviews_agent WHERE agent_name = :name";
            $select = $conn->GetConn()->prepare($qSelect);

            $select->bindValue(":name", "Chrome");
            $select->execute();

            $chrome = $select->fetch(PDO::FETCH_ASSOC);

            $select->bindValue(":name", "Firefox");
            $select->execute();

            $firefox = $select->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }

        if ($chrome) {
            echo "{$chrome['agent_name']} tem {$chrome['agent_views']} visita(s)! <hr>";
        }

        if ($firefox) {
            echo "{$firefox['agent_name']} tem {$firefox['agent_views']} visita(s)! <hr>";
        }
        ?>
    </body>
</html>
