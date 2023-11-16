<?php

include('../database/conexao.php');
require('../controller/cadastro.php');

session_start();
if (isset($_POST['usuario_email']) && isset($_POST['senha1'])) {


    if (empty($_POST['usuario_email'])) {
        $mensagemEmail = "Preencha seu e-mail";
    } elseif (empty($_POST['senha1'])) {
        $mensagemSenha = "Preencha sua senha";
    } else {

        $email = $_POST['usuario_email'];
        $senha = $_POST['senha1'];

        // Prepare a consulta SQL usando placeholders
        $query = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";

        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->execute();


            // Verifique se a consulta retornou alguma linha
            if ($stmt->rowCount() == 1) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
            } else {
                // Adicione a variável de sessão para indicar a falha no login
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['login_falhou'] = true;

                $mensagemLogin = "Falha ao logar! E-mail ou senha incorretos";
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
    <link rel="stylesheet" href="/css/styleModal.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/56db5224e6.js" crossorigin="anonymous"></script>
    <script src="../script/script.js"></script>
    <link rel="icon" href="img/Tech Ninja Store.png">
    <title>Tech | Ninja</title>
</head>

<body>

    <header class="custom-header">
        <img src="/img/Tech Ninja Store.png" class="header-logo">
        <form class="search-form" action="">
            <input type="text" name="search" placeholder="Pesquisar...">
        </form>
        <div class="user-cart">
            <i class="fa-solid fa-user"></i>
            <div class="user">
                <?php
                if (isset($_SESSION['id'])) {
                    // Se o usuário estiver logado, exiba a mensagem de boas-vindas e a opção de sair
                    echo "Bem vindo ao Painel,<b> " . $_SESSION['nome'] . "</b>.";
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
        <div class="banner">
            <div class="carousel">
                <img src='/img/Black Week Banner Mercado Shops Azul Cinza e branco.png' alt="Banner 1">
                <img src='/img/Banner Site Black Friday moderno preto e rosa.jpg' alt="Imagem 2">
                <img src='/img/Banner frete grátis simples rosa.png' alt="Imagem 3">
                <img src='/img/Banner frete grátis simples rosa (1).png' alt="Imagem 4">
            </div>
            <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
            <a class="next" onclick="changeSlide(1)">&#10095;</a>
        </div>
        <div class="title-product">
            <h1>Catalogo de produtos</h1>
        </div>


        <div id="product-list">
            <!-- Os produtos serão exibidos aqui -->
        </div>

        <!-- Modal de Login -->
        <div class="modal">

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
            <style>
                .modal-content {
                    background-color: #fefefe;
                    margin: 15% auto;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%;
                }

                .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                }

                .close:hover,
                .close:focus {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                }

                /* Estilos do modal */
                #id01 {
                    display: none;
                    position: fixed;
                    z-index: 1;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgb(0, 0, 0);
                    background-color: rgba(0, 0, 0, 0.4);
                    padding-top: 60px;
                }

                .w3-modal-content {
                    background-color: #fefefe;
                    margin: 5% auto;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 30%;
                }

                /* Estilos do botão de fechar */
                .w3-button {
                    font-size: 20px;
                    cursor: pointer;
                }

                .w3-display-topright {
                    position: absolute;
                    right: 10px;
                    top: 10px;
                }

                /* Estilos do formulário */
                form {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                h1 {
                    text-align: center;
                }

                label {
                    margin-bottom: 8px;
                }

                input {
                    padding: 10px;
                    margin-bottom: 16px;
                    width: 100%;
                    box-sizing: border-box;
                }

                #id01 button {
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                }

                #id01 button:hover {
                    background-color: #45a049;
                }
            </style>


            <div id="id01" class="w3-modal" <?php if (isset($_GET['exibirModal']) && $_GET['exibirModal'] === 'true') echo 'style="display:block"'; ?>>
                <div class="w3-modal-content w3-animate-zoom">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <form action="" method="post">
                        <h1>Fazer Login</h1>
                        <div>
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="usuario_email" />
                            <p style="color: red;"><?= $mensagemEmail ?></p>
                        </div>
                        <div>
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha1"></input>
                            <p style="color: red;"><?= $mensagemSenha ?></p>
                        </div>
                        <a href="esqueci_senha.php">Esqueci minha senha</a>
                        <div class="button">
                            <button type="submit">Entrar</button>
                            <p style="color: red;"><?= $mensagemLogin ?></p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal de Cadastro -->
            <div id="id02" class="w3-modal custom-modal">
                <div class="w3-modal-content w3-animate-zoom">
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

    <script>
         document.addEventListener('DOMContentLoaded', function () {
            // Se o modal estiver configurado para ser exibido, mostre-o
            <?php
            if (isset($_GET['exibirModal']) && $_GET['exibirModal'] === 'true') {
                echo 'document.getElementById("id01").style.display = "block";';
            }
            ?>
        });
        const carousel = document.querySelector('.carousel');
        let currentIndex = 0;

        function nextSlide() {
            currentIndex = (currentIndex + 1) % 4; // Altere para o número total de imagens no seu carrossel
            updateCarousel();
        }

        function changeSlide(n) {
            currentIndex += n;
            updateCarousel();
        }

        function updateCarousel() {
            const totalItems = document.querySelectorAll('.carousel img').length;
            if (currentIndex < 0) {
                currentIndex = totalItems - 1;
            } else if (currentIndex >= totalItems) {
                currentIndex = 0;
            }

            const translateValue = -currentIndex * 100 + '%';
            carousel.style.transform = 'translateX(' + translateValue + ')';
        }

        setInterval(nextSlide, 3000); // Altera o slide a cada 3 segundos (3000 milissegundos)

        const finalizarPedidoButton = document.getElementById('finalizaPedido');
        const carrinhoItens = document.getElementById('contador-carrinho');

        finalizarPedidoButton.addEventListener('click', function(event) {
            // Verificar se o carrinho não está vazio
            if (carrinhoItens.innerText == 0) {
                alert('Seu carrinho está vazio. Adicione itens antes de finalizar a compra.');
                event.preventDefault(); // Impede o envio do formulário se o carrinho estiver vazio
            } else {
                // Redirecionar o usuário para a página de checkout.php
                window.location.href = 'formCard.php';
            }
        });
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