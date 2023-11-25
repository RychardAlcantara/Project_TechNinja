<?php
class KeyController{

    public static function getPublicKey()
    {
        $curl = curl_init('https://sandbox.api.pagseguro.com/public-keys/');
        $data['type'] = "card";
        curl_setopt($curl,CURLOPT_HTTPHEADER,Array(
            'Content-Type: application/json',
            'Authorization: 86D9A16E1C1E441B87DB0BCD0AE3574F'
        ));
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $retorno = curl_exec($curl);
        curl_close($curl);
        return json_decode($retorno)->public_key;
    }
}
?>