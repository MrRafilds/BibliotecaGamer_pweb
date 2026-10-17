<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Biblioteca de Jogos</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>
    <h1>Biblioteca de Jogos</h1>

    <form action="menu.php" method="POST">
        <fieldset>
            <legend>Insira suas credenciais</legend>
            <?php if (isset($_SESSION['msg'])) { ?>
                <p style="color: #ff5c5c; font-weight: bold; text-align: center;">
                    <?php echo $_SESSION['msg']; ?>
                </p>
                <?php unset($_SESSION['msg']); ?>
            <?php } ?>
            
            <label>Usuário:</label>
            <input type="text" name="usuario" required />
            
            <label>Senha:</label>
            <input type="password" name="senha" required />
            
            <input type="submit" value="Fazer Login" />
        </fieldset>
    </form>
    
    <?php include 'rodape.php'; ?>
    
</body>
</html>