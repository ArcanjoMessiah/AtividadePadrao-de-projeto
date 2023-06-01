<?php

require_once 'conexao/conexao.php';


class LoginDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function login($usuario, $senha) {
        try {
            $sql = "SELECT U.idusuario,U.usuario FROM usuario U
                    WHERE (usuario='$usuario' ||  email='$usuario' ) AND senha='$senha'";
            $stmt = $this->pdo->prepare($sql);            
            $stmt->execute();
            $login = $stmt->fetch(PDO::FETCH_ASSOC);
            return $login;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}



?>
