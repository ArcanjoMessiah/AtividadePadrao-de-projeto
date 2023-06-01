<?php

class usuarioDTO {

    private $idusuario;
    private $usuario;
    private $senha;
    private $nome;
    private $email;
    


    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }




    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }


    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }



}
