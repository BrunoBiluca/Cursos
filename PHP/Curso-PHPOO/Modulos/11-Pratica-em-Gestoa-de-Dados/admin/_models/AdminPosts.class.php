<?php

/**
 * AdminPosts.class [MODEL]
 * Classe responsável por gerenciar as operações relacionadas aos posts do sistema
 * 
 */
class AdminPosts {

    private $data;      //Dados do post
    private $post;      //Id do post
    private $error;
    private $result;

    const ENTITY = "ws_posts";

    /**
     * Função responsável por verficar e cadastrar o post
     * @param array Data - dados do post
     */
    public function ExecutaCreate(array $data) {
        $this->data = $data;

        if (in_array('', $this->data)) {
            $this->result = false;
            $this->error = ["<b>Erro ao cadastrar:</b> Por favor preencha todos os campos do formulário.", WS_ALERT];
        } else {
            $this->setData();
            $this->setName();

            if ($this->data['post_cover']) {
                $upload = new Upload();
                $upload->Image($this->data['post_cover'], $this->data['post_name']);
            }

            if (isset($upload) && $upload->getResult()) {
                $this->data['post_cover'] = $upload->getResult();
            } else {
                $this->data['post_cover'] = null;
            }
            $this->Create();
        }
    }

    public function ExecutaUpdate($postId, array $data) {
        $this->post = (int) $postId;
        $this->data = $data;

        if (in_array('', $this->data)) {
            $this->result = false;
            $this->error = ["<b>Erro ao atualizar:</b> Por favor preencha todos os campos do formulário!", WS_ALERT];
        } else {
            $this->SetData();
            $this->SetName();

            if ($this->data['post_cover'] != "null") {
                $read = new Read();
                $read->ExeRead(self::ENTITY, "WHERE post_id = :post", "post={$this->post}");
                $capa = '../uploads/' . $read->getResult()[0]['post_cover'];

                if (file_exists($capa) && !is_dir($capa)) {
                    unlink($capa);
                }

                $upload = new Upload();
                $upload->Image($this->data['post_cover'], $this->data['post_name']);
            }

            if (isset($upload) && $upload->getResult()) {
                $this->data['post_cover'] = $upload->getResult();
            } else {
                unset($this->data['post_cover']);
            }
            $this->Update();
        }
    }

    public function ExecutaDelete($postId) {
        $this->post = (int) $postId;

        $readPost = new Read();
        $readPost->ExeRead(self::ENTITY, "WHERE post_id = :postId", "postId={$this->post}");
        if (!$readPost->getResult()) {
            $this->error = ["O post que você tentou deletar não existe no sistema, favor utilizar os botões!", WS_ERROR];
            $this->result = false;
        } else {
            $postData = $readPost->getResult()[0];

            if (file_exists("../uploads/" . $postData['post_cover']) && !is_dir("../uploads/" . $postData['post_cover'])) {
                unlink("../uploads/" . $postData['post_cover']);
            }

            $readGallery = new Read();
            $readGallery->ExeRead("ws_posts_gallery", "WHERE post_id = :postId", "postId={$this->post}");
            if ($readGallery->getResult()) {
                foreach ($readGallery->getResult() as $gallery) {
                    if (file_exists("../uploads/" . $gallery['gallery_image']) && !is_dir("../uploads/" . $gallery['gallery_image'])) {
                        unlink("../uploads/" . $gallery['gallery_image']);
                    }
                }
            }

            $deletePost = new Delete();
            $deletePost->ExeDelete("ws_posts_gallery", "WHERE post_id = :postId", "postId={$this->post}");
            $deletePost->ExeDelete("ws_posts", "WHERE post_id = :postId", "postId={$this->post}");

            $this->error = ["O post <b>{$postData['post_title']}</b> foi deletado com sucesso!", WS_ACCEPT];
            $this->result = true;
        }
    }

    /**
     * Função responsável por verificar e cadastrar a galeria de imagens pertencentes ao post
     * @param array $files - imagens a serem enviadas
     * @param type $postId - id do post
     */
    public function SendGallery(array $files, $postId) {
        $this->post = (int) $postId;
        $this->data = $files;

        $read = new Read();
        $read->ExeRead(self::ENTITY, "WHERE post_id = :id", "id={$this->post}");

        if (!$read->getResult()) {
            $this->error = ["Não foi possível atualizar a categoria!", WS_ALERT];
            $this->result = false;
        } else {

            $imageName = $read->getResult()[0]['post_name'];

            $countFiles = count($files['tmp_name']);
            $keys = array_keys($this->data);
            $images = array();

            for ($g = 0; $g < $countFiles; $g++) {
                foreach ($keys as $key) {
                    $images[$g][$key] = $this->data[$key][$g];
                }
            }

            $i = 0;     //Índice das imagens
            $u = 0;     //Quantidade de imagens que foram salvas no banco
            $uploadImages = new Upload();

            foreach ($images as $image) {
                $i++;
                $imageName = "{$imageName}-gb-{$this->post}-" . (substr(md5(time() + $i), 0, 5));
                $uploadImages->Image($image, $imageName);

                if ($uploadImages->getResult()) {
                    $insertImage = ['post_id' => $this->post, 'gallery_image' => $uploadImages->getResult(),
                        'gallery_date' => date('Y-m-d H:i:s')];

                    $create = new Create();
                    $create->ExeCreate("ws_posts_gallery", $insertImage);
                    $u++;
                }
            }

            if ($u > 1) {
                $this->error = ["Galeria atualizada: Foram enviadas {$u} imagens para a galeria", WS_ACCEPT];
                $this->result = true;
            }
        }
    }

    /**
     * Função responsável por eliminar todas as fotos da galeria de imagens de um post quando ele é excluído
     * @param int <b>ID: </b> id do post a ser excluído
     */
    public function DeleteGallery($delId) {
        $this->post = (int) $delId;

        $read = new Read();
        $read->ExeRead("ws_posts_gallery", "WHERE gallery_id = :id", "id={$this->post}");
        if ($read->getResult()) {
            $imagem = "../uploads/" . $read->getResult()[0]['gallery_image'];
            if (file_exists($imagem) && !is_dir($imagem)) {
                unlink($imagem);
            }

            $delete = new Delete();
            $delete->ExeDelete("ws_posts_gallery", "WHERE gallery_id = :id", "id={$this->post}");
            if ($delete->getResult()) {
                $this->error = ["A imagem foi deletada com sucesso do sistema!", WS_ACCEPT];
                $this->result = true;
            }
        }
    }

    public function SetPostStatus($postId, $status) {
        $this->post = (int) $postId;
        $this->data['post_status'] = (string) $status;

        $updatePost = new Update();
        $updatePost->ExeUpdate(self::ENTITY, $this->data, "WHERE post_id = :postId", "postId={$this->post}");
    }

    /**
     * Retorna o erro
     * @return array - 0 mensagem do erro - 1 código do erro
     */
    function getError() {
        return $this->error;
    }

    /**
     * Retorna o resultado da operação envolvendo o post
     * @return true  - não ocorreu erro
     * @return false - erro ocorrido
     */
    function getResult() {
        return $this->result;
    }

    /**
     * Função responsável por organizar e validar as informações nos dados do post
     */
    private function SetData() {
        //O conver e content são retirar dos array para passar limpar o array
        //Porém estes campos não devem ser limpados, já que são importantes as tags HTML presentes neles
        $cover = $this->data['post_cover'];
        $content = $this->data['post_content'];
        unset($this->data['post_cover'], $this->data['post_content']);

        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        $this->data['post_name'] = Check::Name($this->data['post_title']);
        $this->data['post_date'] = Check::Data($this->data['post_date']);
        $this->data['post_type'] = 'post';

        $this->data['post_cover'] = $cover;
        $this->data['post_content'] = $content;

        $this->data['post_cat_parent'] = $this->GetCatParent();
    }

    /**
     * Função responsável por retornar o valor do índice da categoria parent ao post do banco de dados
     * @return id do parent do post
     * @return null
     */
    private function GetCatParent() {
        $readCat = new Read();
        $readCat->ExeRead("ws_categories", "WHERE category_id = :catId", "catId={$this->data['post_category']}");

        if ($readCat->getResult()) {
            return $readCat->getResult()[0]['category_parent'];
        } else {
            return null;
        }
    }

    /**
     * Função responsável por validar o name do posts. Caso o title do post já tenha sido cadastrado é adicionado
     * ao final do name um contador. Dessa forma evitamos nomes repetidos
     */
    private function SetName() {
        $where = ( isset($this->post) ? "post_id != {$this->post} AND " : '');

        $readCats = new Read();
        $readCats->ExeRead(self::ENTITY, "WHERE {$where} post_title = :t", "t={$this->data['post_title']}");
        if ($readCats->getResult()) {
            $this->data['post_name'] = $this->data['post_name'] . '-' . $readCats->getRowCount();
        }
    }

    /**
     * Função responsável por cadastrar o post no banco de dados
     */
    private function Create() {
        $create = new Create();
        $create->ExeCreate(self::ENTITY, $this->data);

        if ($create->getResult()) {
            $this->error = ["O post {$this->data['post_title']} foi cadastrado no sistema com sucesso!", WS_ACCEPT];
            $this->result = $create->getResult();
        }
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::ENTITY, $this->data, "WHERE post_id = :post", "post={$this->post}");
        if ($update->getResult()) {
            $this->error = ["O post <b>{$this->data['post_title']}</b> foi atualizado no sistema com sucesso!", WS_ACCEPT];
            $this->result = true;
        }
    }

}
