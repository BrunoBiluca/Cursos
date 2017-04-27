<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cabecalho
 *
 * @author Bruno
 */
class cabecalho {
    private $tipoUsuario;
    
    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function mostrarCabecalho(){
        $index = "/SistemaHospital/view/index.php";
        echo "<a href=$index>Home</a><br>";
        if($this->tipoUsuario == -1){
            $pagina = "/SistemaHospital/view/login.php";
            $titulo = "Login";
        }else if($this->tipoUsuario == 0){
            $pagina = "/SistemaHospital/view/paginasUsuarios/page-administrador.php";
            $titulo = "Administrador";
        }else if($this->tipoUsuario == 1){
            $pagina = "/SistemaHospital/view/paginasUsuarios/page-cliente.php";
            $titulo = "Cliente";
        }else if($this->tipoUsuario == 2){
            $pagina = "/SistemaHospital/view/paginasUsuarios/page-medico.php";
            $titulo = "Medico";
        }else if($this->tipoUsuario == 3){
            $pagina = "/SistemaHospital/view/paginasUsuarios/page-enfermeiro.php";
            $titulo = "Enfermeiro";
        }else if($this->tipoUsuario == 4){
            $pagina = "/SistemaHospital/view/paginasUsuarios/page-gerente.php";
            $titulo = "Gerente";
        }

        echo "<a href=$pagina>$titulo</a><br>";
        $cadastro = "/SistemaHospital/view/cadastro/cadastro.php";
        echo "<a href=$cadastro>Casdastro</a><br>";
    }
}
