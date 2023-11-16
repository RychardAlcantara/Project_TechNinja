<?php
include('../controller/KeyController.php');
$objKey = new KeyController();

session_start(); // Certifique-se de iniciar a sessão em todos os arquivos que usam $_SESSION

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    // Se o usuário não estiver logado, redirecione para o index.php com um parâmetro indicando que o modal deve ser exibido
    header("Location: index.php?exibirModal=true");
    exit;
}
if (isset($_SESSION['error']) && $_SESSION['error']) {
    // Incluir código para exibir o modal de parabéns
    $modalScript = '<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById(\'seuModalDeErro\');
    modal.style.display = \'block\';

    // Adicione um evento para fechar o modal clicando no \'X\'
    var closeModal = modal.querySelector(\'.close\');
    closeModal.addEventListener(\'click\', function () {
        modal.style.display = \'none\';
    });

    // Remover o parâmetro \'error\' da URL sem recarregar a página
    history.replaceState({}, document.title, window.location.pathname);
});
</script>';
    echo $modalScript;
}

?>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

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
</style>
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
        <a href="index.php">
            <img src="/img/Tech Ninja Store.png" class="header-logo" alt="Tech Ninja Store Logo">
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

    <div>
        <h1>Itens comprado</h1>

    </div>
    <div id="carrinho" class="w3-modal">
        <div class="w3-modal-content w3-animate-zoom">
            <span onclick="document.getElementById('carrinho').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <form action="" method="post">
                <h2>Carrinho de Compras</h2>
                <ul id="carrinho-itens">
                </ul>
            </form>
        </div>
    </div>
    <form action="/controller/checkout.php" method="post" name="formCard" id="formCard">
        <h2>Finalizar Compra</h2>
        <div id="checkout">

            <input style="display: none;" type="text" name="publicKey" id="publicKey" value="<?php echo $objKey::getPublicKey(); ?>">
            <input style="display: none;" type="text" name="encriptedCard" id="encriptedCard">

            <div class="frm-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="frm-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="small-frm-group">
                <label for="telefone">DD</label>
                <input type="number" name="DD" placeholder="DD" maxlength="2" />
            </div>
            <div class="frm-group">
                <label for="telefone">Telefone Celular:</label>
                <input type="tel" id="telefone" name="telefone" maxlength="9" required>
            </div>

            <div class="frm-group">
                <label>CEP</label>
                <input type="text" name="cep" />
            </div>

            <div class="frm-group">
                <label>Rua</label>
                <input type="text" name="rua" />
            </div>

            <div class="frm-group">
                <label>numero</label>
                <input type="number" name="numero" />
            </div>

            <div class="frm-group">
                <label>complemento</label>
                <input type="text" name="complement" />
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
            <input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="16" placeholder="Número do Cartão">
            <input type="text" class="form-control" name="cardHolder" id="cardHolder" placeholder="Nome no Cartão">
            <input type="text" class="form-control" name="cardMonth" id="cardMonth" maxlength="2" placeholder="Mês de Validade do Cartão">
            <input type="text" class="form-control" name="cardYear" id="cardYear" maxlength="4" placeholder="Ano do Cartão">
            <input type="text" class="form-control" name="cardCvv" id="cardCvv" maxlength="4" placeholder="CVV do Cartão">
            <input type="submit" class="btn btn-primary" value="Pagar">


        </div>
    </form>
    <style>
        #checkout {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .frm-group {
            width: 48%;
            /* Ajuste a largura conforme necessário */
            margin-bottom: 10px;
        }

        .frm-group label {
            display: block;
            /* Garante que os labels fiquem em uma nova linha */
        }

        .frm-group input {
            width: 100%;
            /* Ajuste a largura conforme necessário */
            display: inline-block;
            box-sizing: border-box;
        }

        /* Estilos adicionais para alinhar o formulário no centro */
        #formCard {
            margin: 0 auto;
            width: 60%;
            /* Ajuste a largura conforme necessário */
        }

        /* Limpar a flutuação para evitar quebras inesperadas */


        .frm-group:after,
        .small-frm-group:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>

    <script src="https://assets.pagseguro.com.br/checkout-sdk-js/rc/dist/browser/pagseguro.min.js"></script>
    <script src="/script/paymettod.js"> </script>
    <script>
        function fecharModal() {
            var modal = document.getElementById('seuModalDeErro');
            modal.style.display = 'none';
        }

        // Exiba o modal quando necessário
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById('seuModalDeErro');
            modal.style.display = 'block';
        });


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