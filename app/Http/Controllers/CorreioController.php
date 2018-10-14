<?php
namespace App\Http\Controllers;


use App\Services\ConfigurationSite;
use App\Services\Correios;
use Illuminate\Http\Request;

class CorreioController extends Controller
{
    public static function calculate(Request $request)
    {
        $zipcode = $request->zipcode.$request->zipcode2;

        if(session()->has('zipcode') && session()->get('zipcode') != $zipcode){
            $msg = ['status' => 10];
            $request->session()->flush('transport');
            return response()->json($msg);
            exit();
        }
        $config_site = ConfigurationSite::getConfiguration();

        $cep = Correios::buscaCEP($zipcode);

        $resultado = Correios::calculaFrete(
            '40010',
            $config_site->zipcode,
            $zipcode,
            $request->weight,
            $request->height,
            $request->width,
            $request->length,
            0);

        if ($resultado == false) {
            $msg = ['status' => false];
            $request->session()->flush('transport');
            return response()->json($msg);
        } else {
            if($request->packing) {
                $total = money_br(moneyReverse((string)$resultado['valor']) + $request->packing);
            }else{
                $total = (string)$resultado['valor'];
            }
            $transport = [
                'codigo' => (string)$resultado['codigo'],
                'valor' => (string)$total,
                'prazo' => (string)$resultado['prazo'],
                'cep' => (string)$cep->cep,
                'logradouro' => (string)$cep->logradouro,
                'bairro' => (string)$cep->bairro,
                'localidade' => (string)$cep->localidade,
                'uf' => (string)$cep->uf
            ];

            $request->session()->put('transport', $transport);
            return $transport;
        }
    }
}