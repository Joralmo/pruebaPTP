<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use App\Person;
use App\PseTransactionResponse;

use Illuminate\Http\Request;

use SoapHelper;

class TransactionController extends Controller
{
    public function formulario(){
        if(Cache::has("Banks")){
            $array = Cache::get('Banks');
        }else{
            $array = SoapHelper::post("getBankList", ['body' => ['auth' => SoapHelper::auth()]])["getBankListResult"]["item"];
            $minutos = now()->addMinutes(now()->diffInMinutes(now()::tomorrow()));
            Cache::put("Banks", $array, $minutos);
        }
        return view('1', ["array" => $array]);
    }

    public function segVista(Request $request){
        if($request->input('bank')!=0){
            $PSETransactionRequest = [
                "bankCode" => $request->input('bank'),
                "bankInterface" => $request->input('interfaz'),
                "returnURL" => "http://localhost:8000/3",
                "reference" => mt_rand(1,1234567891011121314),
                "description" => "Nuevo pago de prueba",
                "language" => "ES",
                "currency" => "COP",
                "totalAmount" => 123456,
                "taxAmount" => 0,
                "devolutionBase" => 0,
                "tipAmount" => 0,
                "payer" => Person::find(mt_rand(1,10)),
                "buyer" => Person::find(mt_rand(1,10)),
                "shipping" => Person::find(mt_rand(1,10)),
                "ipAddress" => $request->ip(),
                "userAgent" => $request->server('HTTP_USER_AGENT')
            ];
    
            $res = SoapHelper::post("createTransaction", ['body' => ['auth' => SoapHelper::auth(), 'transaction' => $PSETransactionRequest]]);
            
            if(isset($res) && $res["createTransactionResult"]["returnCode"] == "SUCCESS"){
                PseTransactionResponse::create($res["createTransactionResult"]);
                return redirect($res["createTransactionResult"]["bankURL"]);
            }else{
                return view('2', ["error" => $res["createTransactionResult"]["responseReasonText"]]);
            }
        }else{
            return view('1', ["error" => "Debe seleccionar un banco"]);
        }
    }

    public function reingreso(Request $request){
        $respuestaTransaccion = PseTransactionResponse::all()->last();
        $res = SoapHelper::post("getTransactionInformation", ['body' => ['auth' => SoapHelper::auth(), 'transactionID' => $respuestaTransaccion->transactionID]]);
        return view('3', ["respuesta" => $res["getTransactionInformationResult"]]);
    }
}
