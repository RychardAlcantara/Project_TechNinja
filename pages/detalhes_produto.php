<?php
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style-detalhe.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/56db5224e6.js" crossorigin="anonymous"></script>
    <script src="/script/detalhes.js"></script>
    <script src="/script/script.js"></script>
    <link rel="icon" href="img/Tech Ninja Store.png">
    <title>Detalhes do Produto</title>
    <style>
        /* Adicione estilos conforme necessário */
    </style>
</head>
<body>
    <header class="custom-header">
        <a href="index.php">
            <img src="/img/TECHNINJA.png" class="header-logo" alt="Tech Ninja Store Logo">
        </a>
        <form class="search-form" action="">
            <input type="text" name="search" placeholder="Pesquisar...">
        </form>
        <div class="user-cart">
            <i class="fa-solid fa-user"></i>
            <div class="user">
                <?php
                if (isset($_SESSION['id'])) {
                    // Se o usuário estiver logado, exiba a mensagem de boas-vindas e a opção de sair
                    echo "Bem vindo ao Painel, " . $_SESSION['nome'] . ".";
                    echo "<p><a href='logout.php'>Sair</a></p>";
                } else {
                    // Se o usuário não estiver logado, exiba a opção de login e cadastro
                    echo "Faça <a href='#' onclick='document.getElementById(\"id01\").style.display=\"block\"'>LOGIN</a> ou<br/> 
                    crie seu <a href='#' onclick='document.getElementById(\"id02\").style.display=\"block\"'>CADASTRO</a>";
                }
                ?>
            </div>
            
            <div class="cart" id="cart-icon">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="cart-counter" id="contador-carrinho">0</div>
            </div>
        </div>
    </header>
    <main>
        <a href="index.php" >Voltar</a>
        <div id="carrinho" class="w3-modal">
                <div class="w3-modal-content w3-animate-zoom">
                    <span onclick="document.getElementById('carrinho').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <form action="" method="post">
                        <h2>Carrinho de Compras</h2>
                        <ul id="carrinho-itens">
                        </ul>
                        <div class="button">
                            <button id="finalizaPedido" type="button">Finalizar pedido</button>
                        </div>
                    </form>
                </div>
            </div>

        <div id="container">
            <div id="product-details">
                <!-- As informações do produto serão exibidas aqui -->
            </div>
            <div id="details-product">
                <!-- As informações do produto serão exibidas aqui -->
            </div>
        </div>

        <!-- Modal de Login -->
        <div class="modal">
            <div id="id01" class="w3-modal">
                <div class="w3-modal-content w3-animate-top">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <form action="index.php" method="post">
                        <h1>Fazer Login</h1>
                        <div>
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="usuario_email" />
                        </div>
                        <div>
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha1"></input>
                        </div>
                        <div class="button">
                            <button type="submit">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal de Cadastro -->
            <div id="id02" class="w3-modal custom-modal">
                <div class="w3-modal-content w3-animate-top">
                    <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <form action="" method="post">
                        <h1>Criar usuário</h1>
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" />
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" />
                        </div>
                        <div class="button">
                            <button type="submit" name="submit">Cadastrar</button>
                        </div>
                    </form>
                    <!-- Modal de sucesso -->
                    <div id="modal" class="custom-success-modal" style="display: none;">
                        <div id="modal-content">
                            <span id="fechar-modal" onclick="fecharModal()">&times;</span>
                            <p>Usuário inserido com sucesso!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
