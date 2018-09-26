<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/25/2018
 * Time: 20:20
 */

namespace App\Services;


class Messages
{
    public  static function msgProduct()
    {
        $messages = [
            'sku.required'              => 'Favor informar o SKU',
            'name.required'             => 'Favor informar o NOME DO PRODUTO',
            'name.string'               => 'Favor informar o NOME DO PRODUTO como texto',
            'name.min'                  => 'Favor informar o NOME DO PRODUTO com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o NOME DO PRODUTO com máximo 100 caracteres',
            'name.unique'               => 'Este NOME DO PRODUTO já existe',
            'description.required'      => 'Favor informar a DESCRIÇÃO',
            'meta_title.required'       => 'Favor informar o META TÍTULO',
            'meta_description.required' => 'Favor informar o META DESCRIÇÃO',
            'meta_keyword.required'     => 'Favor informar a PALAVRA CHAVE',
            'price.required'            => 'Favor informar o VALOR',
            'qty.required'              => 'Favor informar a QUANTIDADE',
        ];

        return $messages;
    }

    public  static function msgCategory()
    {
        $messages = [
            'name.required'             => 'Favor informar o NOME DA CATEGORIA',
            'name.string'               => 'Favor informar o NOME DA CATEGORIA como texto',
            'name.min'                  => 'Favor informar o NOME DA CATEGORIA com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o NOME DA CATEGORIA com máximo 100 caracteres',
            'name.unique'               => 'Este NOME DA CATEGORIA já existe',
            'description.required'      => 'Favor informar a DESCRIÇÃO',
        ];

        return $messages;
    }

}