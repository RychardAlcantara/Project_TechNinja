

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/56db5224e6.js" crossorigin="anonymous"></script>
    <script src="/script/script.js"></script>
    <link rel="icon" href="img/Tech Ninja Store.png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

       

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button {
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        footer {
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

    </style>
</head>
<body>

    <header class="custom-header">
        <img src="/img/Tech Ninja Store.png" class="header-logo">
    </header>

    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email']) || empty($_POST['nova_senha'])) {
        echo '<div style="text-align: center;">';
        echo '<i class="fas fa-times-circle" style="font-size:70px;color:red;"></i>';
        echo '<h1>E-mail ou nova senha ausentes</h1>';
        echo '<p>Volte para a tela de início e preencha todos os campos.</p>';
        echo '<div class="button">';
        echo '<a href="index.php"><button style="margin-top: 30px;">Voltar ao Início</button></a>';
        echo '</div></div>';
    } else {
        $db = new PDO('mysql:host=localhost;dbname=techNinjaStore', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $novaSenha = $_POST['nova_senha'];

        // Atualize a senha no banco de dados
        $updateQuery = "UPDATE usuarios SET senha = :senha WHERE email = :email";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(':senha', $novaSenha, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $updateStmt->execute();

            echo '<div style="text-align: center;">';
            echo '<i class="fas fa-check-circle" style="font-size:70px;color:green;"></i>';
            echo '<h1>Senha redefinida com sucesso</h1>';
            echo '<p>Volte para a tela de início e faça o login em nossa plataforma.</p>';
            echo '<div class="button">';
            echo '<a href="index.php"><button style="margin-top: 30px;">Voltar ao Início</button></a>';
            echo '</div></div>';
        } catch (PDOException $e) {
            die("Erro na atualização: " . $e->getMessage());
        }
    }
}
?>



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