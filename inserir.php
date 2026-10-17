<?php
include_once './conexao.php';
session_start();

if (isset($_POST['titulo']) && isset($_SESSION['user_id'])) {
    $titulo = $_POST['titulo'];
    $plataforma = $_POST['plataforma'];
    $desbloqueadas = $_POST['conquistas_desbloqueadas'];
    $total = $_POST['conquistas_total'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO jogos (titulo, plataforma, conquistas_desbloqueadas, conquistas_total, usuario_id) VALUES ('$titulo', '$plataforma', $desbloqueadas, $total, $user_id)";
    $conn->query($sql);
}

header("Location: menu.php");
exit;
?>