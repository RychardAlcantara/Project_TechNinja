<?php

$curl = curl_init();

    $url_ambiente = '1';
    $order_id = 'ORDE_6B16917C-FB01-4968-A1A8-1107D0EDD564';

    if($url_ambiente == '1'){
        $url_transacao = 'https://sandbox.api.pagseguro.com/orders/'.$order_id;
    } else {
        $url_transacao = 'https://api.pagseguro.com/orders/'.$order_id;
    }

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url_transacao,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: 86D9A16E1C1E441B87DB0BCD0AE3574F'
    ),    
    ));
    $response = curl_exec($curl);
    $resultado = json_decode($response);
    var_dump($retorno);

curl_close($curl);    