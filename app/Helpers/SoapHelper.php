<?php 


namespace App\Helpers;
use SoapClient;

class SoapHelper
{
    public static function post($funcion, $argumentos){
        $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
        $cliente = new SoapClient($wsdl, array('soap_version' => SOAP_1_1, 'trace' => true));
        $resultado = $cliente->__call($funcion, $argumentos);
        $array = json_decode(json_encode($resultado), true);
        return $array;
    }

    public static function auth(){
        $fecha = date('c');
        $trasnKey = "024h1IlD";
        $hash = sha1($fecha.$trasnKey, false);
        $Authentication = [
            "login" => "6dd490faf9cb87a9862245da41170ff2",
            "tranKey" => $hash,
            "seed" => $fecha
        ];
        return $Authentication;
    }
}