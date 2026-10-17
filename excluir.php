<?php
include_once './conexao.php';
session_start();

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $id_jogo = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM jogos WHERE id = $id_jogo AND usuario_id = $user_id";
    $conn->query($sql);
}

header("Location: menu.php");
exit;
?>