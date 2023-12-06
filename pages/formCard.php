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
                    echo "Faça <a href='#' onclick='document.getElementById(\"id01\").style.display=\"block\"'>LOGIN</a> ou<br/> 
                    crie seu <a href='#' onclick='document.getElementById(\"id02\").style.display=\"block\"'>CADASTRO</a>";
                }
                ?>
            </div>

        </div>
    </header>


    <form action="/controller/checkout.php" method="post" name="formCard" id="formCard">
        <div class="itens-comprado">

        </div>
        <h2>Finalizar Compra</h2>
        <div id="checkout">

            <input type="text" style="display: none;" name="publicKey" id="publicKey" value="<?php echo $objKey::getPublicKey(); ?>">
            <input type="text" style="display: none;" name="encriptedCard" id="encriptedCard">

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

            <div>
                <label>CEP</label>
                <input type="text" name="cep" />
            </div>

            <div class="frm-group">
                <label>Rua</label>
                <input type="text" name="rua" />
            </div>

            <div class="frm-group">
                <label>Número</label>
                <input type="number" name="numero" />
            </div>

            <div class="frm-group">
                <label>Complemento</label>
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

            <div>
                <h2>Dados do cartão</h2>
            </div>
            <div>
                <input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="16" placeholder="Número do Cartão">
                <input type="text" class="form-control" name="cardHolder" id="cardHolder" placeholder="Nome no Cartão">
                <input type="text" class="form-control" name="cardMonth" id="cardMonth" maxlength="2" placeholder="Mês de Validade do Cartão">
                <input type="text" class="form-control" name="cardYear" id="cardYear" maxlength="4" placeholder="Ano do Cartão">
                <input type="text" class="form-control" name="cardCvv" id="cardCvv" maxlength="4" placeholder="CVV do Cartão">
            </div>

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
            margin-bottom: 10px;
        }


        .form-control {
            width: 100%;
            margin-bottom: 10px;
        }

        .frm-group label {
            display: block;
            /* Garante que os labels fiquem em uma nova linha */
        }

        .frm-group input {
            width: 100%;
            display: inline-block;
            box-sizing: border-box;
        }


        /* Estilos adicionais para alinhar o formulário no centro */
        #formCard {
            margin: 30px auto;
            width: 60%;
            background-color: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
        document.addEventListener('DOMContentLoaded', function() {
            // Recupera os itens do carrinho do sessionStorage
            const carrinhoItens = JSON.parse(sessionStorage.getItem('carrinhoItens'));

            // Verifica se há itens no carrinho
            if (carrinhoItens && carrinhoItens.length > 0) {
                // Obtém a referência à div onde os itens do carrinho serão exibidos
                const carrinhoItensContainer = document.querySelector('.itens-comprado');

                // Cria um elemento h1 para o título
                const titulo = document.createElement("h2");
                titulo.textContent = "Itens comprados";
                carrinhoItensContainer.appendChild(titulo);

                let totalGeral = 0; // Inicializa a variável para armazenar o total geral

                // Itera sobre os itens do carrinho e cria elementos para exibição
                carrinhoItens.forEach(item => {
                    const li = document.createElement("li");
                    li.innerHTML = `
                        <img src="${item.imagem}" alt="${item.nome}" style="width: 50px; height: 50px; margin-right: 10px;">
                        Produto: ${item.nome} - Quantidade: ${item.quantidade} - Preço: R$ ${item.precoTotal.toFixed(2)}
                    `;

                    carrinhoItensContainer.appendChild(li);

                    nomesProdutosString = `${item.nome}, `;
                    console.log(nomesProdutosString);
                    // Adiciona o preço total ao total geral
                    totalGeral += item.precoTotal;
                });

                // Adiciona um elemento para exibir o total geral
                const totalGeralElement = document.createElement("p");
                totalGeralElement.textContent = `Preço Total: R$ ${totalGeral.toFixed(2)}`;
                carrinhoItensContainer.appendChild(totalGeralElement);

                // Adiciona o campo totalGeral ao formulário
                const form = document.getElementById('formCard'); // Substitua 'seuFormulario' pelo ID do seu formulário
                const totalGeralInput = document.createElement("input");
                totalGeralInput.type = "hidden"; // Campo oculto
                totalGeralInput.name = "totalGeral";
                totalGeralInput.value = totalGeral.toFixed(2); // Valor do total como string formatada
                form.appendChild(totalGeralInput);


                // Ponto de depuração: Verifique se os itens estão sendo exibidos corretamente
                console.log(carrinhoItensContainer.innerHTML);
                console.log(totalGeralInput);

            } else {
                console.log('Nenhum item no carrinho.');
            }

            // Remove a vírgula extra no final, se houver
            nomesProdutosString = nomesProdutosString.slice(0, -2);

            // Adiciona o campo nomeProdutos ao formulário
            const form = document.getElementById('formCard');
            const nomesProdutosInput = document.createElement("input");
            nomesProdutosInput.type = "hidden"; // Campo oculto
            nomesProdutosInput.name = "nomeProdutos";
            nomesProdutosInput.value = nomesProdutosString;
            form.appendChild(nomesProdutosInput);

        });
    </script>

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
</body>

</html>