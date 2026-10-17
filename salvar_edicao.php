<?php
include_once './conexao.php';
session_start();

if (isset($_POST['id_jogo']) && isset($_SESSION['user_id'])) {
    $id_jogo = $_POST['id_jogo'];
    $titulo = $_POST['titulo'];
    $plataforma = $_POST['plataforma'];
    $desbloqueadas = $_POST['conquistas_desbloqueadas'];
    $total = $_POST['conquistas_total'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE jogos SET titulo = '$titulo', plataforma = '$plataforma', conquistas_desbloqueadas = $desbloqueadas, conquistas_total = $total WHERE id = $id_jogo AND usuario_id = $user_id";
    $conn->query($sql);
}

header("Location: menu.php");
exit;
?>