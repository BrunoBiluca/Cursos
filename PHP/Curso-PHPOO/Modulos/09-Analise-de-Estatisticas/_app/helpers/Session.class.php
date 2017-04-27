<?php

/**
 * Session.class [TIPO]
 * Descricao
 * 
 */
class Session {

    private $date;
    private $cache;                             //Tempo da sessão do usuário
    private $traffic;
    private $browser;

    public function __construct($cache = null) {
        session_start();
        $this->CheckSession($cache);
    }

    private function CheckSession($cache = null) {
        $this->date = date("Y-m-d");
        $this->cache = ((int) $cache ? $cache : 20);

        if (empty($_SESSION['user_online'])) {
            $this->SetTraffic();
            $this->SetSession();
            $this->CheckBrowser();
            $this->SetUsuario();
            $this->UpdateBrowser();
        } else {
            $this->UpdateTraffic();
            $this->UpdateSession();
            $this->CheckBrowser();
            $this->UpdateUsuario();
        }
        var_dump($this);
        $this->date = null;
    }

    private function SetSession() {
        $_SESSION['user_online'] = [
            "online_session" => session_id(),
            "online_startview" => date("Y-m-d H:i:s"),
            "online_endview" => date("Y-m-d H:i:s", strtotime("+{$this->cache}minutes")),
            "online_ip" => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            "online_url" => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "online_agent" => filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT)
        ];
    }

    private function UpdateSession() {
        $_SESSION['user_online']['online_endview'] = date("Y-m-d H:i:s", strtotime("+{$this->cache}minutes"));
        $_SESSION['user_online']['online_url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

    private function SetTraffic() {
        $this->GetTraffic();

        if (!$this->traffic) {
            $arraySiteViews = ['siteviews_date' => $this->date, 'siteviews_users' => 1, 'siteviews_views' => 1, 'siteviews_pages' => 1];
            $create = new Create;
            $create->ExecuteCreate('ws_siteviews', $arraySiteViews);
        } else {
            if (!$this->GetCookie()) {
                $arraySiteViews = ['siteviews_users' => $this->traffic['siteviews_users'] + 1, 'siteviews_views' => $this->traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->traffic['siteviews_pages'] + 1];
            } else {
                $arraySiteViews = ['siteviews_views' => $this->traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->traffic['siteviews_pages'] + 1];
            }

            $updateSiteViews = new Update();
            $updateSiteViews->ExecuteUpdate('ws_siteviews', $arraySiteViews, "WHERE siteviews_date = :date", "date={$this->date}");
        }
    }

    private function UpdateTraffic() {
        $this->GetTraffic();
        $arraySiteViews = ['siteviews_pages' => $this->traffic['siteviews_pages'] + 1];
        $updatePageViews = new Update();
        $updatePageViews->ExecuteUpdate('ws_siteviews', $arraySiteViews, "WHERE siteviews_date = :date", "date={$this->date}");
        $this->traffic = null;
    }

    private function GetTraffic() {
        $read = new Read();
        $read->ExecuteRead('ws_siteviews', "WHERE siteviews_date = :date", "date={$this->date}");
        if ($read->GetRowCount()) {
            $this->traffic = $read->GetResult()[0];
        }
    }

    private function GetCookie() {
        $cookie = filter_input(INPUT_COOKIE, 'user_online', FILTER_DEFAULT);
        setcookie("user_online", base64_decode("bilucanexus"), time() + 86400);
        if (!$cookie) {
            return false;
        } else {
            return true;
        }
    }

    private function CheckBrowser() {
        $this->browser = $_SESSION['user_online']['online_agent'];

        if (strpos($this->browser, "Chrome")) {
            $this->browser = 'Chrome';
        } elseif (strpos($this->browser, "Firefox")) {
            $this->browser = 'Firefox';
        } elseif (strpos($this->browser, "MSIE") || strpos($this->browser, "Trident/")) {
            $this->browser = 'IE';
        } else {
            $this->browser = 'Outros';
        }
    }
    
    private function UpdateBrowser() {
        $read = new Read();
        $read->ExecuteRead('ws_siteviews_agent', "WHERE agent_name = :name", "name={$this->browser}");
        
        if(!$read->GetResult()){
            $arrayAgents = ['agent_name' => $this->browser, 'agent_views' => 1];
            $createSiteAgents = new Create();
            $createSiteAgents->ExecuteCreate('ws_siteviews_agent', $arrayAgents);
        }else{
            $arrayAgents = ['agent_views' => $read->GetResult()[0]['agent_views'] + 1];
            $updateSiteAgents = new Update();
            $updateSiteAgents->ExecuteUpdate('ws_siteviews_agent', $arrayAgents, 'WHERE agent_name = :name', "name={$this->browser}");
        }
    }
    
    private function SetUsuario() {
        $sesOnline = $_SESSION['user_online'];
        $sesOnline['agent_name'] = $this->browser;
        
        $createUsuario = new Create;
        $createUsuario->ExecuteCreate('ws_siteviews_online', $sesOnline);
    }
    
    private function UpdateUsuario() {
        
        $arrayUpdateUsuario = [
            'online_endview' => $_SESSION['user_online']['online_endview'],
            'online_url' => $_SESSION['user_online']['online_url']
        ];
        
        $updateUsusario = new Update;
        $updateUsusario->ExecuteUpdate('ws_siteviews_online', $arrayUpdateUsuario, 'WHERE online_session = :session', "session={$_SESSION['user_online']['online_session']}");
        
        if(!$updateUsusario->GetRowCount()){
            $readUsuario = new Read();
            $readUsuario->ExecuteRead('ws_siteviews_online', 'WHERE online_session = :session', "session={$_SESSION['user_online']['online_session']}");
            if(!$readUsuario->GetRowCount()){
                $this->SetUsuario();
            }
        }
        
    }

}
