<?php

namespace Bruno\Bundle\Entity;

/**
 * Usuario
 */
class Usuario{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $nickName;

    /**
     * @var string
     */
    private $password;


    /**
     * Get id
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set nome
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get nome
     * @return string
     */
    public function getNome(){
        return $this->nome;
    }

    /**
     * Set nickName
     * @param string $nickName
     * @return Usuario
     */
    public function setNickName($nickName){
        $this->nickName = $nickName;
        return $this;
    }

    /**
     * Get nickName
     * @return string
     */
    public function getNickName(){
        return $this->nickName;
    }

    /**
     * Set password
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }
}

