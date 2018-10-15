<?php
namespace App\Http\Controllers;


use App\Models\Product;
use App\Services\ConfigurationSite;
use App\Services\Correios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

class CorreioController extends Controller
{
    public static function calculate(Request $request)
    {
        $zipcode = $request->zipcode.$request->zipcode2;

        if(session()->has('zipcode') && session()->get('zipcode') != $zipcode){
            $msg = ['status' => 10];
            $request->session()->forget('transport');
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
            $request->session()->forget('transport');
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

    //calculate checkout
    public static function calculateCheckout(Request $request)
    {
        $config_site = ConfigurationSite::getConfiguration();
        $zipcode = only_number(Auth::user()->complement->zipcode);
        $zipcode_post =  only_number($request->zipcode.$request->zipcode2);

        if($zipcode != $zipcode_post){
            $msg = ['status' => 12];
            $request->session()->forget('transport');
            return response()->json($msg);
            exit();
        }

        foreach(Cart::content() as $row):
            $product = Product::findOrFail($row->id);

            //get address
            $cep = Correios::buscaCEP($zipcode);

            $resultado = Correios::calculaFrete(
                '40010',
                $config_site->zipcode,
                $zipcode,
                $product->weight,
                $product->height,
                $product->width,
                $product->length,
                0);

            if($request->packing) {
                $total = money_br(moneyReverse((string)$resultado['valor']) + $request->packing);
            }else{
                $total = (string)$resultado['valor'];
            }

            Cart::update($row->rowId, [
                'options' => [
                    'transp_days' => (string)$resultado['prazo'],
                    'transp_price' => (string)$total,
                    'transp_city' => (string)$cep->localidade,
                    'transp_state' => (string)$cep->uf
                ]
            ]);
        endforeach;

        $msg = ['status' => 1];
        $request->session()->forget('transport');
        return response()->json($msg);
        exit();
    }


    public static function calculateRemove(Request $request){
        foreach(Cart::content() as $row):
            Cart::update($row->rowId, [
                'options' => [
                    'transp_days' => null,
                    'transp_price' => null,
                    'transp_city' => null,
                    'transp_state' => null
                ]
            ]);
        endforeach;

        $msg = ['status' => 1];
        $request->session()->forget('transport');
        return response()->json($msg);
    }
}