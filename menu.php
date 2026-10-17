<?php
include_once './conexao.php';
session_start();

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $consulta = mysqli_query($conn, "SELECT cod, nome, login, senha FROM usuario WHERE login = '$usuario' AND senha = '$senha'");
    $dados = mysqli_fetch_assoc($consulta);

    if ($dados != null) {
        $_SESSION['user_id'] = $dados['cod'];
        $_SESSION['nome'] = $dados['nome'];
    } else {
        $_SESSION['msg'] = "Usuário ou senha incorretos!!!";
        header("Location: index.php");
        exit;
    }
} else if (!isset($_SESSION['nome'])) {
    $_SESSION['msg'] = "Acesso negado. Faça o login primeiro!";
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Meus Jogos</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>
    
    <div class="perfil-container">
        <img src="rafilds.jpg" alt="Foto de Perfil" class="avatar">
        <h2>Bem-vindo, Player <?php echo $_SESSION['nome']; ?>!</h2>
    </div>
    
    <a href="logout.php">Desconectar</a>
    <hr style="border: 1px solid #171a21; width: 100%; ">

    <h3>Adicionar Novo Jogo</h3>
    <form action="inserir.php" method="POST">
        <label>Título do Jogo:</label>
        <input type="text" name="titulo" required>
        
        <label>Plataforma (ex: PC, PS5, Xbox):</label>
        <input type="text" name="plataforma" required>

        <label>Conquistas Desbloqueadas:</label>
        <input type="number" name="conquistas_desbloqueadas" value="0" min="0" required>

        <label>Total de Conquistas do Jogo:</label>
        <input type="number" name="conquistas_total" value="0" min="0" required>

        <input type="submit" value="Salvar na Biblioteca">
    </form>

    <h3>Minha Biblioteca</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Plataforma</th>
                <th>Conquistas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM jogos WHERE usuario_id = $user_id ORDER BY id DESC";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
                    <tr>
                        <td><?php echo $linha['id']; ?></td>
                        <td><?php echo $linha['titulo']; ?></td>
                        <td><?php echo $linha['plataforma']; ?></td>
                        <td><?php echo $linha['conquistas_desbloqueadas']; ?> / <?php echo $linha['conquistas_total']; ?></td>
                        <td>
                            <!-- Botão de Editar (Update) -->
                            <a href="editar.php?id=<?php echo $linha['id']; ?>">Editar</a>
                            
                            <!-- Botão de Deletar (Delete) com alerta de confirmação -->
                            <a href="excluir.php?id=<?php echo $linha['id']; ?>" class="btn-deletar" onclick="return confirm('Tem certeza que deseja excluir este jogo da sua biblioteca?');">Excluir</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum jogo na biblioteca ainda.</td></tr>";
            }
            ?>
        </tbody>
        
    </table>
    
    <?php include 'rodape.php'; ?>    
</body>
</html>