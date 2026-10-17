<?php
include_once './conexao.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: menu.php");
    exit;
}

$id_jogo = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM jogos WHERE id = $id_jogo AND usuario_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: menu.php");
    exit;
}

$jogo = mysqli_fetch_assoc($result);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Atualizar Progresso</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>
    <h2>Atualizar: <?php echo $jogo['titulo']; ?></h2>

    <form action="salvar_edicao.php" method="POST">
        <input type="hidden" name="id_jogo" value="<?php echo $jogo['id']; ?>">

        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo $jogo['titulo']; ?>" required>

        <label>Plataforma:</label>
        <input type="text" name="plataforma" value="<?php echo $jogo['plataforma']; ?>" required>

        <label>Conquistas Desbloqueadas:</label>
        <input type="number" name="conquistas_desbloqueadas" value="<?php echo $jogo['conquistas_desbloqueadas']; ?>" min="0" required>

        <label>Total de Conquistas do Jogo:</label>
        <input type="number" name="conquistas_total" value="<?php echo $jogo['conquistas_total']; ?>" min="0" required>

        <input type="submit" value="Salvar Alteração">
    </form>
    <br>
    <a href="menu.php">Cancelar e Voltar</a>
    
    <?php include 'rodape.php'; ?>
</body>
</html>