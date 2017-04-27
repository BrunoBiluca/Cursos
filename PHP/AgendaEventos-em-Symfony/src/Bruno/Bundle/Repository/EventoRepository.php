<?php

namespace Bruno\Bundle\Repository;

use \Doctrine\ORM\EntityRepository;
use Bruno\Bundle\Entity;

/**
 * EventoRepository
 * Classe resonsável por ser o modelo para Evento no banco de dados
 */
class EventoRepository extends EntityRepository {

    private $data;
    private $eventoID;
    private $result;
    private $error;

    /*     * ***********************************************
     *              Métodos Públicos
     * ************************************************ */

    public function findAllOrderedByName() {
        return $this->getEntityManager()
                        ->createQuery(
                                'SELECT p FROM BrunoBundle:Evento p ORDER BY p.titulo ASC'
                        )->getResult();
    }

    public function eventosMes($mes) {
        $query = $this->createQueryBuilder('e')
                ->where("MONTH(e.data) = :m")
                ->setParameter('m', $mes)
                ->getQuery();
        return $query->getResult();
    }

    /**
     * Função responsável por criar um novo evento no sistema
     * @param Evento $data
     */
    public function ExecutaCreate($data) {
        $this->data = $data;

        if ($this->data->getTitulo() == '' || $this->data->getDescricao() == '') {
            $this->result = false;
            $this->error = ['<b>Erro ao cadastrar:</b> Por favor preencha todos os campos do formulário!', E_USER_WARNING];
        } else {
            $this->SetData();
            $this->SetName();
            $this->Create();
        }
    }

    public function ExecutaUpdate($eventoID, $data) {
        $this->data = $data;
        $this->eventoID = $eventoID;

        if ($this->data->getTitulo() == '' || $this->data->getDescricao() == '') {
            $this->result = false;
            $this->error = ['<b>Erro ao cadastrar:</b> Por favor preencha todos os campos do formulário!', E_USER_WARNING];
        } else {
            $this->SetData();
            $this->SetName();
            $this->Update();
        }
    }

    /**
     * Retorna o resultado da operação
     * @return type
     */
    function getResult() {
        return $this->result;
    }

    /**
     * Retorna as mensagens da operação
     * @return type
     */
    function getError() {
        return $this->error;
    }

    /*     * ***********************************************
     *              Métodos Privados
     * ************************************************ */

    /**
     * Valida os dados do evento
     */
    private function SetData() {
        $this->data->setName($this->CheckName($this->data->getTitulo()));
    }

    /**
     * Valida o nome do evento, será utilizado para o link do evento
     * @param string $name
     * @return string
     */
    private function CheckName($name) {
        $Format = array();
        $Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $Data = strtr(utf8_decode($name), utf8_decode($Format['a']), $Format['b']);
        $Data = strip_tags(trim($Data));
        $Data = str_replace(' ', '-', $Data);
        $Data = str_replace(array('-----', '----', '---', '--'), '-', $Data);

        return strtolower(utf8_encode($Data));
    }

    /**
     * Evita que existam names de eventos iguais
     */
    private function SetName() {
        $where = (!empty($this->eventoID) ? "e.id != {$this->eventoID} AND " : '');

        $query = $this->createQueryBuilder('e')
                ->where("{$where} e.titulo = :n")
                ->setParameter('n', $this->data->getTitulo())
                ->getQuery();

        $resEvento = $query->getResult();
        if ($resEvento) {
            $this->data->setName($this->data->getName() . "-" . count($resEvento));
        }
    }

    /**
     * Executa a operação de criar o novo evento no banco de dados
     */
    private function Create() {
        $this->data->Upload();
        $this->getEntityManager()->persist($this->data);
        $this->getEntityManager()->flush();

        $this->error = ["<b>Sucesso:</b> Evento foi criado!", E_USER_WARNING];
        $this->result = $this->data->getId();
    }

    private function Update() {
        $this->data->Upload();
        $this->getEntityManager()->flush();

        $this->error = ["<b>Sucesso:</b> Evento foi atualizado!", E_USER_WARNING];
        $this->result = $this->data->getId();
    }

}
