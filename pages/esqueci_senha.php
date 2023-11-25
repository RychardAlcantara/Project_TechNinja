<?php
// esqueci_senha.php

$db = new PDO('mysql:host=localhost;dbname=techNinjaStore', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$mensagem = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['usuario_email'])) {
        $mensagem = "Preencha seu e-mail";
    } else {
        $email = $_POST['usuario_email'];

        // Verifique se o e-mail existe no banco de dados
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                // Se o e-mail for encontrado, exiba o formulário para redefinir a senha
                $exibirFormulario = true;
            } else {
                $mensagem = "E-mail não encontrado";
            }
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/styleSenha.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/56db5224e6.js" crossorigin="anonymous"></script>
    <script src="/script/script.js"></script>
    <link rel="icon" href="img/Tech Ninja Store.png">
</head>
<body>

    <header class="custom-header">
        <img src="/img/TECHNINJA.png" class="header-logo">
    </header>

    <div>
        <?php if (empty($email) || !$exibirFormulario) : ?>
            <!-- Formulário para inserir o e-mail -->
            <form action="" method="post">
                <h1>Digite o seu e-mail</h1>
                <div>
                    <label for="email" id="email-label">E-mail:</label>
                    <input type="email" id="email" name="usuario_email" required>
                    <p style="color: red;"><?= $mensagem ?></p>
                </div>
                <div class="button">
                    <button type="button" onclick="exibirFormulario()">Enviar</button>
                </div>
            </form>
        <?php endif; ?>

        <?php if (isset($exibirFormulario) && $exibirFormulario) : ?>
            <!-- Formulário para redefinir a senha -->
            <form action="processar_redefinicao_senha.php" method="post">
                <h1>Digite uma nova senha</h1>
                <input type="hidden" name="email" value="<?= $email ?>">
                <div>
                    <label for="nova_senha">Nova Senha:</label>
                    <input type="password" id="nova_senha" name="nova_senha" required>
                </div>
                <div class="button">
                    <button type="submit">Redefinir Senha</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <!-- O restante do corpo permanece o mesmo -->

    <script>
        function exibirFormulario() {
            document.getElementById("email-label").style.position = "absolute";
            document.getElementById("email-label").style.bottom = "0";
            document.forms[0].submit();
        }
    </script>

    <footer>
        <div>
            <p>&copy; 2023 Tech Ninja. Todos os direitos reservados.</p>
        </div>
        <div>
            <a href="#">Política de Privacidade</a> |
            <a href="#">Termos de Serviço</a>
        </div>
    </footer>
</body>
</html>