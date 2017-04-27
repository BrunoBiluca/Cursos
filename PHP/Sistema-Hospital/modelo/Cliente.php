<?php
    class Cliente{
        private $cpf;
        private $nome;
        private $idade;
        private $sexo;
        private $rua;
        private $bairro;
        private $cidade;
        private $estado;
        private $numero;
        private $complemento;
        private $cep;
        private $telefoneR;
        private $celular;
        private $telefoneC;
        private $login;
        
        public function getCpf() {
            return $this->cpf;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getIdade() {
            return $this->idade;
        }

        public function getSexo() {
            return $this->sexo;
        }

        public function getRua() {
            return $this->rua;
        }

        public function getBairro() {
            return $this->bairro;
        }

        public function getCidade() {
            return $this->cidade;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getComplemento() {
            return $this->complemento;
        }

        public function getCep() {
            return $this->cep;
        }

        public function getTelefoneR() {
            return $this->telefoneR;
        }

        public function getCelular() {
            return $this->celular;
        }

        public function getTelefoneC() {
            return $this->telefoneC;
        }

        public function getLogin() {
            return $this->login;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setIdade($idade) {
            $this->idade = $idade;
        }

        public function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        public function setRua($rua) {
            $this->rua = $rua;
        }

        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }

        public function setCidade($cidade) {
            $this->cidade = $cidade;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function setComplemento($complemento) {
            $this->complemento = $complemento;
        }

        public function setCep($cep) {
            $this->cep = $cep;
        }

        public function setTelefoneR($telefoneR) {
            $this->telefoneR = $telefoneR;
        }

        public function setCelular($celular) {
            $this->celular = $celular;
        }

        public function setTelefoneC($telefoneC) {
            $this->telefoneC = $telefoneC;
        }

        public function setLogin($login) {
            $this->login = $login;
        }


    }
?>