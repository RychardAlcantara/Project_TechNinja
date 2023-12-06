document.addEventListener("DOMContentLoaded", () => {
    // Obtém o ID do produto da URL
    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id");

    // Verifica se o ID do produto está presente
    if (productId !== null) {
        // Faz uma requisição para a API para obter os detalhes do produto específico
        fetch(`https://fakestoreapi.com/products/${productId}`)
            .then(response => response.json())
            .then(product => {
                // Exibe as informações do produto na página
                const productDetails = document.getElementById("product-details");
                const productImage = document.createElement("img");
                productImage.src = product.image;

               
                productDetails.appendChild(productImage);
            })
            .catch(error => console.log('Error fetching product details:', error));
    } else {
        console.log('Product ID not provided in the URL');
    }

    fetch(`https://fakestoreapi.com/products/${productId}`)
    .then(response => response.json())
    .then(product => {
        // Obtém a referência para o elemento com id "details-product"
        const productDetailsContainer = document.getElementById("details-product");

        // Cria elementos HTML para as informações do produto
        const productTitle = document.createElement("h2");
        productTitle.textContent = product.title;
 

        const productDescription = document.createElement("p");
        productDescription.textContent = product.description;

        const productPrice = document.createElement("p");
        productPrice.textContent = "Preço: R$ " + product.price;

        const buyButton = document.createElement("button");
            buyButton.textContent = "Adicionar ao carrinho";
            buyButton.className = "comprar";
            buyButton.addEventListener("click", () => {
                adicionarAoCarrinho(product.title, product.price);
            });

        // Adiciona os elementos ao contêiner "details-product"
        productDetailsContainer.appendChild(productTitle);
        productDetailsContainer.appendChild(productDescription);
        productDetailsContainer.appendChild(productPrice);
        productDetailsContainer.appendChild(buyButton);
    })
    .catch(error => console.log('error', error));

});


