<?php 
if (isset($_POST['submit']))
{
    include_once('conexao.php'); // Certifique-se de que o arquivo 'conexao.php' está configurado corretamente.

    // Obtenha os valores do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL corrigida
    $stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    
    // Substitua os valores corretos nas ligações
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);

    $response = array();

    if ($stmt->execute()) {
        // A inserção foi bem-sucedida
        echo '<div id="modal" style="display: block;">
                <span id="fechar-modal" onclick="fecharModalSucesso()">&times;</span>
                <div class="w3-modal-content w3-animate-zoom">
                    <i class="fas fa-check-circle" style="font-size:70px;color:green; margin-top:50px;"></i>
                    <h1>Usuario inserido com sucesso</h1>
                    <p>Agora você pode efetuar o login em nossa plataforma </p>
                </div>
            </div>';
    } else {
        // Erro ao inserir os dados no banco de dados
        echo "Erro ao inserir os dados no banco de dados.";
    }
}
?>