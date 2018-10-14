<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 10/13/2018
 * Time: 21:44
 */

namespace App\Services;


class Correios
{
    public static  function calculaFrete(
        $cod_servico, /* codigo do servico desejado */
        $cep_origem,  /* cep de origem, apenas numeros */
        $cep_destino, /* cep de destino, apenas numeros */
        $peso,        /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
        $altura,      /* altura do produto em cm incluindo a embalagem */
        $largura,     /* altura do produto em cm incluindo a embalagem */
        $comprimento, /* comprimento do produto incluindo embalagem em cm */
        $valor_declarado='0' /* indicar 0 caso nao queira o valor declarado */
    ){

        $cod_servico = strtoupper( $cod_servico );
        if( $cod_servico == 'SEDEX10' ) $cod_servico = 40215 ;
        if( $cod_servico == 'SEDEXACOBRAR' ) $cod_servico = 40045 ;
        if( $cod_servico == 'SEDEX' ) $cod_servico = 40010 ;
        if( $cod_servico == 'PAC' ) $cod_servico = 41106 ;

        # ###########################################
        # Código dos Principais Serviços dos Correios
        # 41106 PAC sem contrato
        # 40010 SEDEX sem contrato
        # 40045 SEDEX a Cobrar, sem contrato
        # 40215 SEDEX 10, sem contrato
        # ###########################################

        $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";

        $xml = simplexml_load_file($correios);

        $_arr_ = array();
        if($xml->cServico->Erro == '0'):
            $_arr_['codigo'] = $xml -> cServico -> Codigo;
            $_arr_['valor'] = $xml -> cServico -> Valor[0];
            $_arr_['prazo'] = $xml -> cServico -> PrazoEntrega .' dias uteis';
            // return $xml->cServico->Valor;
            return $_arr_ ;
        else:
            return false;
        endif;
    }

    public static  function recalculaFrete($product, $zipcode_destination)
    {

        $config_site = ConfigurationSite::getConfiguration();

        $cep = self::buscaCEP($zipcode_destination);

        $resultado = self::calculaFrete(
            '40010',
            $config_site->zipcode,
            $zipcode_destination,
            $product->weight,
            $product->height,
            $product->width,
            $product->length,
            0);

        if($product->packing) {
            $total = money_br(moneyReverse((string)$resultado['valor']) + $product->packing);
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

        session()->put('transport', $transport);
        return $transport;
    }


    public static function buscaCEP($cep)
    {
        //validate
        $formated_cep = preg_replace("/[^0-9]/", "", $cep);
        if (!preg_match('/^[0-9]{8}?$/', $formated_cep)) {
            return null;
        }else{
            return self::executaBuscaCEP($cep);
        }
    }

    public static function executaBuscaCEP($cep)
    {
        $url = 'http://viacep.com.br/ws/'.$cep.'/json/ ';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);

        $return = json_decode($data);
        return $return;
    }
}