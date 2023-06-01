<?php
session_start();
require_once '../dao/loginDAO.php';

$usuario = $_POST["usuario"];
$senha = ($_POST["senha"]);

$loginDAO = new LoginDAO();
$usuario = $loginDAO->login($usuario, $senha);

if (!empty($usuario)) {
    $_SESSION["idusuario"] = $usuario["idusuario"];
    $_SESSION["usuario"] = $usuario["usuario"];
    
    
    echo "<script>";
    echo "window.location.href = 'principal.php';";
    echo "</script> ";
} else {
    $msg = "Usuário e/ou senha invalido";
    echo "<script>";
    echo "window.location.href = '../index.php?msg={$msg}';";
    echo "</script> ";
    
}
?>
