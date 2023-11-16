<?php
class KeyController{

    public static function getPublicKey()
    {
        $data['type'] = "card";
        $curl = curl_init('https://sandbox.api.pagseguro.com/public-keys/');
        curl_setopt($curl,CURLOPT_HTTPHEADER,Array(
            'Content-Type: application/json',
            'Authorization: PUB42777EA9A95B462B93829462D0E63196'
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