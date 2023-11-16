<?php
class PayController{

    public function __construct()
    {
        // URL da API do PagSeguro
        $url = "https://sandbox.api.pagseguro.com/orders";

        // Cabeçalho da solicitação com sua chave de autenticação
        $headers = [
            'Content-Type: application/json',
            'Authorization: 86D9A16E1C1E441B87DB0BCD0AE3574F', // Substitua pela sua chave de API real
        ];

        // Os dados da ordem que você quer enviar
        $data = [
            "id" => "ORDE_2A5FF165-58DE-4EBB-9D69-3B07F74261BB",
            "reference_id" => "ex-00002",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "type" => "MOBILE",
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999"
                    ]
                ]
            ],
            "items" => [
                [
                    "reference_id" => "referencia do item",
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 500
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" => 500,
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        'soft_descriptor' => 'WEBDESIGN',
                        "type" => "CREDIT_CARD",
                        "installments" => 1,
                        "capture" => true,
                        "card" => [
                            "id" => "CARD_A617B836-D813-4241-A659-D1D2A1EA8F0B", // Substitua pelo ID do cartão
                            "brand" => "visa",
                            "first_digits" => "411111",
                            "last_digits" => "1111",
                            "exp_month" => "12",
                            "exp_year" => "2030",
                            "holder" => [
                                "name" => "dsada"
                            ],
                            "store" => true
                        ],
                    ]
                ]
            ]
        ];

        // Converter os dados da ordem para formato JSON
        $jsonData = json_encode($data);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);

        $retorno = curl_exec($curl);
        curl_close($curl);

        // Verificar a resposta da API
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_code == 201) {
            echo "Ordem criada com sucesso!\n";
            $response = json_decode($retorno, true);
            print_r($response);
        } else {
            echo "Erro ao criar a ordem:\n";
            echo "HTTP Code: " . $http_code . "\n";
            echo $retorno;
        }
    }
}

$obj = new PayController();
