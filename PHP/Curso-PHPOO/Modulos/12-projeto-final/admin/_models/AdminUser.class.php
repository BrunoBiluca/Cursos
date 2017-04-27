<?php

/**
 * AdminUser [TIPO]
 * Descricao
 * 
 */
class AdminUser {

    private $userID;
    private $data;
    private $error;
    private $result;

    const ENTITY = "ws_users";

    /*     * ***********************************************
     *              Funções Públicas
     * ************************************************ */

    public function ExecutaCreate($data) {
        $this->data = (array) $data;
        
        if (in_array('', $this->data)) {
            $this->error = ["Existem campos vazios. Por favor preencha todos os campos do formulário!", WS_ALERT];
            $this->result = false;
        } elseif (!Check::Email($this->data['user_email'])) {
            $this->error = ["Email inválido!", WS_ERROR];
            $this->result = false;
        } elseif (!$this->VerificaEmailExiste($this->data['user_email'])) {
            $this->error = ["Email já está cadastrado, por favor tente outro email!", WS_ERROR];
            $this->result = false;
        } else {
            $this->SetData();

            $this->Create();
        }
    }

    public function ExecutaUpdate($userID, $data) {
        $this->data = (array) $data;
        $this->userID = (int) $userID;

        if (in_array('', $this->data)) {
            $this->error = ["Existem campos vazios. Por favor preencha todos os campos do formulário!", WS_ALERT];
            $this->result = false;
        } elseif (!Check::Email($this->data['user_email'])) {
            $this->error = ["Email inválido!", WS_ERROR];
            $this->result = false;
        } elseif (!$this->VerificaEmailExiste($this->data['user_email'])) {
            $this->error = ["Email já está cadastrado, por favor tente outro email!", WS_ERROR];
            $this->result = false;
        } else {
            $this->SetData();

            $this->Update();
        }
    }

    public function ExecutaDelete($delID) {
        $this->userID = (int) $delID;
        
        $read = new Read();
        $read->ExeRead(self::ENTITY, "WHERE user_id = :id", "id={$this->userID}");
        if(!$read->getResult()){
            $this->result = false;
            $this->error = ['Você tentou deletar um usuário que não existe no sistema!', WS_ERROR];
        }
        else if($read->getRowCount() == 1){
            $this->result = false;
            $this->error = ['Não é possível deletar todos os usuários do sistema! Pelo menos deve existir um administrador!', WS_ERROR];            
        }
        else{
            $delete = new Delete();
            $delete->ExeDelete(self::ENTITY, "WHERE user_id = :id", "id={$this->userID}");
            
            $this->result = true;
            $this->error = ['O usuário foi deletado com sucesso!', WS_ERROR];
        }
    }
    
    function getError() {
        return $this->error;
    }

    function getResult() {
        return $this->result;
    }

    /*     * ***********************************************
     *              Funções Privadas
     * ************************************************ */

    private function SetData() {
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        $this->data['user_password'] = md5($this->data['user_password']);
        $this->data['user_lastupdate'] = date("Y-m-d H:i:s");
    }

    private function VerificaEmailExiste($email) {
        $read = new Read();
        $read->ExeRead(self::ENTITY, "WHERE user_email = :e AND user_id != :id", "e={$email}&id={$this->userID}");
        if ($read->getResult()) {
            return false;
        }
        return true;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->data, "WHERE user_id = :id", "id={$this->userID}");

        $this->result = true;
        $this->error = ["Usuário atualizado com sucesso!", WS_ACCEPT];
    }

    private function Create() {
        $create = new Create();
        $create->ExeCreate(self::ENTITY, $this->data);
        
        $this->result = $create->getResult();
        $this->error = ['O novo usuário foi cadastrado com sucesso!', WS_ACCEPT];
    }
    
}
