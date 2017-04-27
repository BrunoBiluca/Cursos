<?php

/**
 * AdminEmpresa.class [TIPO]
 * Classe responsável pelas operações envolvendo Empresas no site
 */
class AdminEmpresa {

    private $data;
    private $empID;
    private $result;
    private $error;

    const ENTITY = "app_empresas";

    /*     * ************************************************
     *              Funções Públicas
     * ************************************************ */

    /**
     * Função responsável por cadastrar uma nova empresa no sitema
     * @param array <b>Dados:</b> Dados necessários para o cadastro
     */
    public function ExecutaCreate($data) {
        $this->data = $data;

        if (in_array('', $this->data)) {
            $this->error = ["Existem campos vazios. Por favor preencha todos os campos do formulário!", WS_ALERT];
            $this->result = false;
        } else {
            $this->SetData();
            $this->SetName();

            if ($this->data['empresa_capa']) {
                $upload = new Upload("../uploads/empresas/");
                $upload->Image($this->data['empresa_capa'], $this->data['empresa_name']);
            }

            if (isset($upload) && !empty($upload)) {
                $this->data['empresa_capa'] = $upload->getResult();
            } else {
                $this->data['empresa_capa'] = null;
            }

            $this->Create();
        }
    }

    public function ExecutaUpdate($empID, $post) {
        $this->empID = $empID;
        $this->data = $post;

        if (in_array('', $this->data)) {
            $this->error = ["Existem campos vazios. Por favor preencha todos os campos do formulário!", WS_ALERT];
            $this->result = false;
        } else {
            $this->SetData();
            $this->SetName();

            if ($this->data['empresa_capa']) {
                $upload = new Upload("../uploads/empresas/");
                $upload->Image($this->data['empresa_capa'], $this->data['empresa_name']);
            }

            if (isset($upload) && !empty($upload)) {
                $this->data['empresa_capa'] = $upload->getResult();
            } else {
                $this->data['empresa_capa'] = null;
            }

            $this->Update();
        }
    }
    
    public function ExecutaDelete($empId) {
        $this->empID = (int) $empId;
        
        $readEmpresa = new Read();
        $readEmpresa->ExeRead(self::ENTITY, "WHERE empresa_id = :id", "id={$this->empID}");
        
        if(!$readEmpresa->getResult()){
            $this->error = ["<b>Opsssss:</b> você tentou excluír uma empresa que não está cadastrada!", WS_ALERT];
            $this->result = true;
        }else{
            $empresaRes = $readEmpresa->getResult()[0];
            
            if(file_exists("../uploads/empresas" . $empresaRes['empresa_capa']) && !is_dir("../uploads/empresas" . $empresaRes['empresa_capa'])){
                unlink("../uploads/empresas" . $empresaRes['empresa_capa']);
            }
            
            $deletar = new Delete();
            $deletar->ExeDelete(self::ENTITY, "WHERE empresa_id = :id", "id={$this->empID}");
            $this->error = ["A empresa <b>{$empresaRes['empresa_title']}</b> foi deletada com sucesso!", WS_ACCEPT];
            $this->result = true;
        }
    }

    public function SetEmpresaStatus($empID, $status) {
        $this->empID = (int) $empID;
        $this->data['empresa_status'] = $status;
        
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->data, "WHERE empresa_id = :id", "id={$this->empID}");
    }
    
    /**
     * Retorna o resultado da operação
     * @return <b>False:</b> em caso de erro na operação
     * @return <b>True:</b> em caso de sucesso
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * Informa o erro ocorrido na operação
     * @return array[2] Pos[0] - mensagem de erro Pos[1] - código do erro
     */
    public function getError() {
        return $this->error;
    }

    /*     * ************************************************
     *              Funções Privadas
     * ************************************************ */

    /**
     * Função verifica e adequa os dados obtidos no fomulário para o banco de dados
     */
    private function SetData() {
        $capa = $this->data['empresa_capa'];
        $sobre = $this->data['empresa_sobre'];
        unset($this->data['empresa_capa'], $this->data['empresa_sobre']);

        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        $this->data['empresa_name'] = Check::Name($this->data['empresa_title']);

        $this->data['empresa_capa'] = $capa;
        $this->data['empresa_sobre'] = $sobre;
    }

    /**
     * Função valida o nome da empresa de forma a evitar que duas empresas tenham o mesmo name
     */
    private function SetName() {
        $where = (!empty($this->empID) ? "empresa_id != {$this->empID} AND " : '');

        $read = new Read();
        $read->ExeRead(self::ENTITY, "WHERE {$where} empresa_title = :name", "name={$this->data['empresa_title']}");
        if ($read->getResult()) {
            $this->data['empresa_name'] = $this->data['empresa_name'] . "-" . $read->getRowCount();
        }
    }

    /**
     * Função efetua o cadastro da empresa no banco de dados
     */
    private function Create() {
        $create = new Create();
        $create->ExeCreate(self::ENTITY, $this->data);
        if ($create->getResult()) {
            $this->result = $create->getResult();
            $this->error = ['<b>Sucesso:</b> Empresa foi cadastrada no sistema com sucesso!' . WS_ACCEPT];
        }
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->data, "WHERE empresa_id = :id", "id={$this->empID}");
        if ($update->getResult()) {
            $this->error = ["A empresa <b>{$this->data['empresa_title']}</b> foi atualizada com sucesso no sistema!", WS_ACCEPT];
            $this->result = true;
        }
    }

}
