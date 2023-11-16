<?php
include('../controller/KeyController.php');
$objKey = new KeyController();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/56db5224e6.js" crossorigin="anonymous"></script>
    <script src="/script/script.js"></script>
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

    <form>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="telefone">Telefone Celular:</label>
        <input type="tel" id="telefone" name="telefone" required><br>
        <div class="frm-group">
            <label>CEP</label>
            <input type="text" name="cep" />
        </div>

        <div class="frm-group">
            <label>Rua</label>
            <input type="text" name="rua" />
        </div>

        <div class="frm-group">
            <label>Bairro</label>
            <input type="text" name="bairro" />
        </div>

        <div class="frm-group">
            <label>Cidade</label>
            <input type="text" name="cidade" />
        </div>

        <div class="frm-group">
            <label>Estado</label>
            <input type="text" name="estado" />
        </div>
    </form>


    <script src="https://assets.pagseguro.com.br/checkout-sdk-js/rc/dist/browser/pagseguro.min.js"></script>
    <script src="/script/paymettod.js"> </script>
    <script>
        (function() {

            const cep = document.querySelector("input[name=cep]");

            cep.addEventListener('blur', e => {
                const value = cep.value.replace(/[^0-9]+/, '');
                const url = `https://viacep.com.br/ws/${value}/json/`;

                fetch(url)
                    .then(response => response.json())
                    .then(json => {

                        if (json.logradouro) {
                            document.querySelector('input[name=rua]').value = json.logradouro;
                            document.querySelector('input[name=bairro]').value = json.bairro;
                            document.querySelector('input[name=cidade]').value = json.localidade;
                            document.querySelector('input[name=estado]').value = json.uf;
                        }

                    });


            });







        })();
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