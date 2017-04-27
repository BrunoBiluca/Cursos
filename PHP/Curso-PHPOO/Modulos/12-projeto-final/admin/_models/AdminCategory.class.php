<?php

/**
 * AdminCategory.class [TIPO]
 * Classe responsável por validar o cadastro de uma categoria
 * 
 */
class AdminCategory {

    private $data;          //Dados da categoria
    private $catId;         //id da categoria
    private $error;
    private $result;

    const Entity = 'ws_categories';

    /**
     * Função responsável por validar e cadastrar uma nova categoria
     * @param array Dados da categoria
     */
    public function ExecutaCreate(array $data) {
        $this->data = $data;

        if (in_array('', $this->data)) {
            $this->result = false;
            $this->error = ['<b>Erro ao cadastrar:</b> Por favor preencha todos os campos do formulário!', WS_ALERT];
        } else {
            $this->SetData();
            $this->SetName();
            $this->Create();
        }
    }

    /**
     * Função responsável por validar e atualizar uma categoria no banco de dados
     * @param array Dados da categoria
     */
    public function ExecutaUpdate($catId, array $data) {
        $this->data = $data;
        $this->catId = $catId;

        if (in_array('', $this->data)) {
            $this->result = false;
            $this->error = ['<b>Erro ao atualizar:</b> Por favor preencha todos os campos do formulário!', WS_ALERT];
        } else {
            $this->SetData();
            $this->SetName();
            $this->Update();
        }
    }

    public function ExecutaDelete($deleteId) {
        $this->catId = (int) $deleteId;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE category_id = :delId", "delId={$this->catId}");

        if (!$read->getResult()) {
            $this->result = false;
            $this->error = ['Você tentou deletar uma categoria que não existe no sistema!', WS_INFOR];
        } else {
            extract($read->getResult()[0]);
            if (!$category_parent && !$this->CheckCategories()) {
                $this->result = false;
                $this->error = ["A seção <b>{$category_title}</b> possui categorias. Para deletá-la atualize ou remova todas as categorias!", WS_ALERT];
            } elseif ($category_parent && !$this->CheckPosts()) {
                $this->result = false;
                $this->error = ["A categoria <b>{$category_title}</b> possui artigos. Para deletá-la atualize ou remova todos os artigos!", WS_ALERT];
            } else {
                $deletarCat = new Delete();
                $deletarCat->ExeDelete(self::Entity, "WHERE category_id = :delId", "delId={$this->catId}");

                if ($deletarCat->getResult()) {
                    $tipo = ($category_parent ? 'seção' : 'categoria');
                    $this->result = true;
                    $this->error = ["A {$tipo} <b>{$category_title}</b> foi deletada com sucesso!", WS_ACCEPT];
                }
            }
        }
    }

    /**
     * Retorna o resultado do processo de cadastro da categoria
     * @return Boolean -  caso não foi cadastrado
     * @return Int - Id da categoria cadastrada
     */
    public function GetResult() {
        return $this->result;
    }

    /**
     * Retorna o tipo de erro e a mensagem
     * @return array Pos 0 - mensagem, Pos 1 - tipo do erro
     */
    public function GetError() {
        return $this->error;
    }

    //private methods

    /**
     * Função responsável por validar os dados enviados
     */
    private function SetData() {
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);
        $this->data['category_name'] = Check::Name($this->data['category_title']);
        $this->data['category_date'] = Check::Data($this->data['category_date']);
        $this->data['category_parent'] = ($this->data['category_parent'] == 'null' ? null : $this->data['category_parent']);
    }

    /**
     * Função responsável por validar o name da categoria. Se o nome já existe, este é alterado para diferenciá-lo.
     */
    private function SetName() {
        $where = (!empty($this->catId) ? "category_id != {$this->catId} AND " : '');

        $readName = new Read();
        $readName->ExeRead(self::Entity, "WHERE {$where} category_name = :n", "n={$this->data['category_name']}");
        if ($readName->getResult()) {
            $this->data['category_name'] = $this->data['category_name'] . "-" . $readName->getRowCount();
        }
    }

    /**
     * Verifica se a seção que deve ser deletada contém sub categorias. Uma seção não pode ser deletada se ela possui categorias.
     * @return false - existem sub-categorias
     * @return true - não existem sub-categorias
     */
    private function CheckCategories() {
        $readCats = new Read();
        $readCats->ExeRead(self::Entity, "WHERE category_parent = :parent", "parent={$this->catId}");
        if ($readCats->getResult()) {
            return false;   //Existem sub-categorias
        } else {
            return true;    //Não existem sub-categorias
        }
    }

    /**
     * Verifica se a categoria contém artigos. Se a categoria contém artigos ela não pode ser deletada.
     * @return false - existem artigos
     * @return true - não existem artigos
     */
    private function CheckPosts() {
        $readCats = new Read();
        $readCats->ExeRead("ws_posts", "WHERE post_category = :parent", "parent={$this->catId}");
        if ($readCats->getResult()) {
            return false;   //Existem posts
        } else {
            return true;    //Não existem posts
        }
    }

    /**
     * Função responsável por criar a categoria no banco de dados.
     */
    private function Create() {
        $createCategory = new Create();
        $createCategory->ExeCreate(self::Entity, $this->data);
        if ($createCategory->getResult()) {
            $this->error = ["<b>Sucesso:</b> Categoria criada!", WS_ACCEPT];
            $this->result = $createCategory->getResult();
        }
    }

    /**
     * Função responsável por atualizar a categoria no banco de dados.
     */
    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->data, "WHERE category_id = :catId", "catId={$this->catId}");
        if ($update->getResult()) {
            $tipo = (empty($this->data['category_parent']) ? 'seção' : 'categoria')/
            $this->error = ["<b>Sucesso:</b> A {$tipo} foi atualizada!", WS_ACCEPT];
            $this->result = true;
        }
    }

}
