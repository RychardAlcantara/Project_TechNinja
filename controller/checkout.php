<?php
class PayController{

    public function __construct()
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $telefone = $_POST['telefone'];
        $numero = $_POST['numero'];
        $complento = $_POST['complement'];
        $DD = $_POST['DD'];

        $valorEmReais = 170.40;

        // Converter para centavos
        $valorEmCentavos = $valorEmReais * 100;

        $data['reference_id'] = "ex-00002";
        $data["customer"] = [
            "name"=> $nome,
            "email"=> $email,
            "tax_id"=> "12345678909",
            "phones"=> [
                [
                    "country"=> "55",
                    "area"=> $DD,
                    "number"=> $telefone,
                    "type"=> "MOBILE"
                ]
            ]
        ];
        $data["items"]=[
            [
                "reference_id"=> "referencia do item",
                "name"=> "nome do item",
                "quantity"=> 1,
                "unit_amount"=> $valorEmCentavos
            ]
        ];
        $data["shipping"]= [
            "address"=> [
                "street"=> $rua,
                "number"=> $numero,
                "complement"=> $complento,
                "locality"=> $bairro,
                "city"=> $cidade,
                "region_code"=> $estado,
                "postal_code"=> $cep,
                "country" => "BRA"
            ]
        ];
        $data["notification_urls"] = [
            "https://meusite.com/notificacoes"
        ];
       

        $data["charges"] = [
            [
                "reference_id"=> "referencia da cobranca",
                "description"=> "descricao da cobranca",
                "amount"=> [
                    "value"=> $valorEmCentavos,
                    "currency"=> "BRL"
                ],
                "payment_method"=> [
                    'soft_descriptor'=>'WEBDESIGN',
                    "type"=> "CREDIT_CARD",
                    "installments"=> 1,
                    "capture"=> true,
                    "card"=> [
                        "encrypted"=>$_POST['encriptedCard'],
                        "security_code"=> "123",
                        "holder"=> [
                            "name"=> "Jose da Silva"
                        ],
                        "store"=> true
                    ]
                ]
            ]
        ];

        $jsonData = json_encode($data);

        $curl = curl_init('https://sandbox.api.pagseguro.com/orders');
        curl_setopt($curl,CURLOPT_HTTPHEADER,Array(
            'Content-Type: application/json',
            'Authorization: 86D9A16E1C1E441B87DB0BCD0AE3574F'
        ));
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        
        $retorno = curl_exec($curl);
        curl_close($curl);

       $response = json_decode($retorno, true);

        // Check if the payment status is PAID
        if(isset($response['charges'][0]['status']) && $response['charges'][0]['status'] == 'PAID') {
            // Redirect to success modal or perform other actions
            header('Location: ../pages/modalSucess.php');
            exit();
        } else {
            // Handle other cases or display an error message
            header('Location: ../pages/modalError.php');
            exit();
        }
    }
}

$obj = new PayController();
?>






