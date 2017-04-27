<?php

namespace Bruno\Bundle\Repository;

use Bruno\Bundle\Entity\Usuario;
use \Doctrine\ORM\EntityRepository;

/**
 * UsuarioRepository
 * Classe responsável por fazer as operações que necessitem de banco de dados.
 */
class UsuarioRepository extends EntityRepository {

    private $nick;
    private $password;
    private $result;
    private $error;

    /* ************************************************
     *              Métodos Públicos
     * ************************************************ */

    /**
     * Função responsável por executar o login do usuário
     * @param Usuario $usuario
     */
    public function ExecutaLogin($usuario) {
        $this->nick = (string) strip_tags(trim($usuario->getNickName()));
        $this->password = (string) strip_tags(trim($usuario->getPassword()));
        $this->setLogin();
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    /*     * ************************************************
     *              Métodos Privados
     * ************************************************ */

    /**
     * Função responsável por validar os dados do login e armazenar os erros.
     * Se não houverem erros o login deve ser executado
     */
    private function setLogin() {
        if (!$this->nick || !$this->password):
            $this->error = ['Informe seu E-mail e senha para efetuar o login!', E_USER_WARNING];
            $this->result = false;
        elseif (!$this->getUser()):
            $this->error = ['Os dados informados não são compatíveis!', E_USER_WARNING];
            $this->result = false;
        else:
            $this->Executa();
        endif;
    }

    /**
     * Função responsável por verificar os dados no banco de dados
     */
    private function getUser() {

        $query = $this->createQueryBuilder('u')
                ->where('u.nickName = :n AND u.password = :p')
                ->setParameter('n', $this->nick)
                ->setParameter('p', $this->password)
                ->getQuery();

        $resUser = $query->getResult();

        if ($resUser) {
            $this->result = $resUser[0];
            return true;
        } else {
            return false;
        }
    }
    
    private function Executa() {
        //verifica se a sessão ainda não foi iniciada
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->result;
        
        $this->error = ["Olá {$this->result->getNome()}, seja bem vindo(a). Aguarde redirecionamento!", E_USER_WARNING];
        $this->result = true;
    }

}
