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

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "inserção bem sucedida";
    } else {
        echo "erro ao inserir os dados";
    }
}
?>