// Função para buscar e adicionar produtos
function fetchAndAddProducts() {
    fetch("https://fakestoreapi.com/products")
        .then(response => response.json())
        .then(data => {
            const productList = $("#product-list-1");

            data.forEach((product) => {
                const productContainer = $("<div>").addClass("product");

                const productTitle = $("<h2>").text(product.title);

                const productImage = $("<img>").attr("src", product.image);
                productImage.on("click", () => redirectToProductDetails(product.id));

                const productPrice = $("<p>").text("Preço: R$ " + product.price);

                productContainer.append(productTitle, productImage, productPrice);
                productList.append(productContainer);
            });

            // Inicializa o carrossel após adicionar todos os produtos
            initCarousel();
        });
}

// Inicializa o carrossel usando a biblioteca Slick
function initCarousel() {
    $("#product-list-1").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        arrows: false,
        dots: false,
        responsive: [{
                breakpoint: 1236,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 618,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
}

// Função para redirecionar para os detalhes do produto
function redirectToProductDetails(productId) {
    console.log("Redirecionar para os detalhes do produto: " + productId);
}

// Função para avançar ou retroceder no carrossel
function changeSlide(direction) {
    $("#product-list-1").slick(direction === 1 ? "slickNext" : "slickPrev");
}

// Chama a função para buscar e adicionar produtos
fetchAndAddProducts();