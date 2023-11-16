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

    if ($stmt->execute()) {
        // A inserção foi bem-sucedida, então execute um script JavaScript para exibir o modal
        echo "<script>
            var modal = document.getElementById('modal');
            modal.style.display = 'block';

            function fecharModal() {
                modal.style.display = 'none';
            }
            </script>";
    } else {
        echo "Erro ao inserir os dados no banco de dados.";
    }
}
?>