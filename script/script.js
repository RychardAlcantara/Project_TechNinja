document.addEventListener('DOMContentLoaded', function () {
    // O código JavaScript será executado após o carregamento completo do DOM
    

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("https://fakestoreapi.com/products", requestOptions)
        .then(response => response.json())
        .then(data => {
            // A resposta da API foi processada e agora está disponível como um array de objetos JavaScript (data)

            const productList = document.getElementById("product-list");

            // Itere pelos produtos e crie elementos HTML para cada um
            data.forEach((product) => {
                const productContainer = document.createElement("div");
                productContainer.className = "product";

                const productTitle = document.createElement("h2");
                productTitle.textContent = product.title;

                const productImage = document.createElement("img");
                productImage.src = product.image;
                productImage.addEventListener("click", () => redirectToProductDetails(product.id));

                //const productDescription = document.createElement("p");
                //productDescription.textContent = product.description;

                const productPrice = document.createElement("p");
                productPrice.textContent = "Preço: R$ " + product.price;

                const buyButton = document.createElement("button");
                buyButton.textContent = "Comprar";
                buyButton.className = "comprar";
                buyButton.addEventListener("click", () => {
                    adicionarAoCarrinho(product.title, product.price);
                });


                productContainer.appendChild(productImage);
                productContainer.appendChild(productTitle);
                // productContainer.appendChild(productDescription);
                productContainer.appendChild(productPrice);
                productContainer.appendChild(buyButton);

                productList.appendChild(productContainer);
            });

            function redirectToProductDetails(productId) {
                // Redirecione para a página de detalhes do produto, passando o identificador único (neste caso, o índice)
                window.location.href = `detalhes_produto.php?id=${productId}`;
            }
        })
        .catch(error => console.log('error', error));




    window.adicionarAoCarrinho = function (nomeProduto, precoProduto) {
        const produtoExistente = carrinhoItens.find(item => item.nome === nomeProduto);

        if (produtoExistente) {
            produtoExistente.quantidade++;
            produtoExistente.precoTotal = produtoExistente.quantidade * precoProduto;
        } else {
            carrinhoItens.push({ nome: nomeProduto, preco: precoProduto, quantidade: 1, precoTotal: precoProduto });
        }
        atualizarCarrinho();
        // Atualizar a variável $itemsInCart no PHP
        const itemsInCart = carrinhoItens.length;
        document.getElementById('contador-carrinho').innerText = itemsInCart;

    };

    window.removerDoCarrinho = function (index) {
        carrinhoItens.splice(index, 1);
        atualizarCarrinho();
    };

    const carrinhoItens = [];
    const carrinho = document.getElementById('carrinho');
    const botaoFecharCarrinho = document.getElementById('fechar-carrinho');
    const contadorCarrinho = document.getElementById('contador-carrinho');

    document.getElementById('cart-icon').addEventListener('click', () => {
        carrinho.style.display = (carrinho.style.display === 'block') ? 'none' : 'block';
    });

    botaoFecharCarrinho.addEventListener('click', () => {
        carrinho.style.display = 'none';
    });

    function atualizarContador() {
        let totalItens = 0;

        for (const item of carrinhoItens) {
            totalItens += item.quantidade;
        }

        contadorCarrinho.textContent = totalItens;
    }


    function atualizarCarrinho() {
        const carrinhoLista = document.getElementById('carrinho-itens');

        if (carrinhoLista) {
            carrinhoLista.innerHTML = '';

            let total = 0;
            let totalItens = 0;

            carrinhoItens.forEach((item, index) => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `${item.nome} - Quantidade: ${item.quantidade}, Preço Unitário: R$ ${item.preco}, 
                Preço Total: R$ ${item.precoTotal} <button onclick="removerDoCarrinho(${index})">Remover</button>`;
                carrinhoLista.appendChild(listItem);
                total += item.precoTotal;
                totalItens += item.quantidade;
            });

            const totalElement = document.createElement('li');
            totalElement.innerHTML = `<strong>Total:</strong> R$ ${total} (${totalItens} itens)`;
            carrinhoLista.appendChild(totalElement);

            atualizarContador();

        }
    }
    const finalizarPedidoButton = document.getElementById('finalizaPedido');

    finalizarPedidoButton.addEventListener('click', function (event) {
        // Verificar se o carrinho não está vazio
        if (carrinhoItens.length == 0) {
            console.log('Seu carrinho está vazio. Adicione itens antes de finalizar a compra.');
            event.preventDefault(); // Impede o envio do formulário se o carrinho estiver vazio
        } else {
            const parametrosURL = encodeURIComponent(JSON.stringify(carrinhoItens));
            window.location.href = `formCard.php?carrinho=${parametrosURL}`;
        }
    });

});
