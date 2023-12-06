<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="/css/style-datalhe.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/56db5224e6.js" crossorigin="anonymous"></script>
    <script src="/script/detalhes.js"></script>
    <script src="/script/script.js"></script>
    <link rel="icon" href="img/Tech Ninja Store.png">
    <title>Detalhes do Produto</title>
    <style>
        #carousel-container {
            position: relative;
        }

        #product-list-1 {
            display: flex;
        }

        .product {
            flex: 0 0 auto;
            margin-right: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <header class="custom-header">
        <a href="index.php">
            <img src="/img/TECHNINJA.png" class="header-logo" alt="Tech Ninja Store Logo">
        </a>
        <div class="user-cart">
            <div class="user">
                <?php
                if (isset($_SESSION['id'])) {
                    // Se o usuário estiver logado, exiba a mensagem de boas-vindas e a opção de sair
                    echo "<i class='fas fa-user-alt'></i><br><b> " . $_SESSION['nome'] . "</b>.";
                    echo "<p><a href='logout.php'>Sair</a></p>";
                } else {
                    // Se o usuário não estiver logado, exiba a opção de login e cadastro
                    echo "<button class='teste' onclick='document.getElementById(\"id01\").style.display=\"block\"'> LOGIN</button> 
                    <button onclick='document.getElementById(\"id02\").style.display=\"block\"'> CADASTRO</button>";
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
        <a href="index.php" style="margin: 20px;">Voltar</a>

        <h1 style="text-align: center;">Detalhes do produto</h1>

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
        <div>
            <h1>Produtos semelhantes</h1>
        </div>

        <div id="carousel-container">
            <div id="product-list-1" class="slick-carousel">
                <!-- Os produtos serão adicionados aqui dinamicamente -->

            </div>

            <!-- Botões de navegação -->

            <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
            <a class="next" onclick="changeSlide(1)">&#10095;</a>
        </div>

    </main>

    <footer>
        <div>
            <div>
                <i class='fab fa-instagram' style='font-size:48px;'></i>
                <i class='fab fa-facebook' style='font-size:48px;'></i>
                <i class='fab fa-twitter' style='font-size:48px;'></i>
            </div>

            <div>
                <a href="#">Política de Privacidade</a> |
                <a href="#">Termos de Serviço</a>
            </div>
            <div>
                <p> &copy; 2023 Tech Ninja. Todos os direitos reservados. </p>
            </div>


        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Adicione o script do Slick Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="/script/carrossel.js"></script>

</body>

</html>