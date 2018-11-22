<?php

// use SoapClient;

use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
    $fecha = date('c');
    $trasnKey = "024h1IlD";
    $hash = sha1($fecha.$trasnKey, false);
    // $cliente = new SoapClient();
    $Authentication = [
        "login" => "6dd490faf9cb87a9862245da41170ff2",
        "tranKey" => $hash,
        "seed" => $fecha
    ];
    $cliente = new SoapClient($wsdl, array('soap_version' => SOAP_1_1, 'trace' => true));
    
    // Cache::forget("Banks");
    if(Cache::has("Banks")){
        $array = Cache::get('Banks');
        echo "Agarro del cache";
    }else{
        $result = $cliente->getBankList(array("auth"=>$Authentication));
        $array = json_decode(json_encode($result), true)["getBankListResult"]["item"];
        $minutos = now()->addMinutes(now()->diffInMinutes(now()::tomorrow()));
        Cache::put("Banks", $array, $minutos);
        echo "Cacheo";
    }
    echo "<br>";
    var_dump($array);
    return view('welcome');
});
