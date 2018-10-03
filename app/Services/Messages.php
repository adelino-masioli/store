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


    public  static function msgSubCategory()
    {
        $messages = [
            'name.required'             => 'Favor informar o NOME DA SUBCATEGORIA',
            'name.string'               => 'Favor informar o NOME DA SUBCATEGORIA como texto',
            'name.min'                  => 'Favor informar o NOME DA SUBCATEGORIA com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o NOME DA SUBCATEGORIA com máximo 100 caracteres',
            'name.unique'               => 'Este NOME DA SUBCATEGORIA já existe',
            'description.required'      => 'Favor informar a DESCRIÇÃO',
            'category_id.required'      => 'Favor selecionar a CATEGORIA',
        ];

        return $messages;
    }

    public  static function msgContact()
    {
        $messages = [
            'message.required'             => 'Favor informar a MENSAGEM',
        ];

        return $messages;
    }


    public  static function msgUser()
    {
        $messages = [
            'name.required'      => 'Favor informar o NOME DO USUÁRIO',
            'name.string'        => 'Favor informar o NOME DO USUÁRIO como texto',
            'name.min'           => 'Favor informar o NOME DO USUÁRIO com mínimo 5 caracteres',
            'name.max'           => 'Favor informar o NOME DO USUÁRIO com máximo 50 caracteres',
            'email.required'     => 'Favor informar o EMAIL DO USUÁRIO',
            'email.string'       => 'Favor informar o EMAIL DO USUÁRIO como texto',
            'email.min'          => 'Favor informar o EMAIL DO USUÁRIO com mínimo 5 caracteres',
            'email.max'          => 'Favor informar o EMAIL DO USUÁRIO com máximo 50 caracteres',
            'email.unique'       => 'Este EMAIL DO USUÁRIO já está em uso',
            'password.required'  => 'Favor informar a SENHA',
            'password.min'       => 'Favor informar a SENHA com mínimo 6 caracteres',
            'password.confirmed' => 'Favor confirmar a SENHA',
        ];

        return $messages;
    }


    public  static function msgConfig()
    {
        $messages = [
            'name.required'     => 'Favor informar o NOME DA EMPRESA',
            'name.string'       => 'Favor informar o NOME DA EMPRESA como texto',
            'name.min'          => 'Favor informar o NOME DA EMPRESA com mínimo 5 caracteres',
            'name.max'          => 'Favor informar o NOME DA EMPRESA com máximo 50 caracteres',
            'name.unique'       => 'Este NOME DA EMPRESA já está em uso',
            'contact.required'  => 'Favor informar o CONTATO DA EMPRESA',
            'email.required'    => 'Favor informar o EMAIL DA EMPRESA',
            'email.string'      => 'Favor informar o EMAIL DA EMPRESA como texto',
            'email.min'         => 'Favor informar o EMAIL DA EMPRESA com mínimo 5 caracteres',
            'email.max'         => 'Favor informar o EMAIL DA EMPRESA com máximo 50 caracteres',
            'email.unique'      => 'Este EMAIL DA EMPRESA já está em uso',
            'phone.required'    => 'Favor informar o TELEFONE',
            'summary.max'       => 'Favor informar o RESUMO SOBRE A EMRPESA com máximo 250 caracteres',
            'about.required'    => 'Favor informar o SOBRE A EMRPESA',
            'zipcode.required'  => 'Favor informar o CEP',
            'address.required'  => 'Favor informar o ENDEREÇO',
            'district.required' => 'Favor informar o BAIRRO',
            'number.required'   => 'Favor informar o NÚMERO',
            'state.required'    => 'Favor informar o ESTADO',
            'city.required'     => 'Favor informar a CIDADE',
        ];

        return $messages;
    }


    public  static function msgDocument()
    {
        $messages = [
            'name.required'             => 'Favor informar o NOME DO ARQUIVO',
            'name.string'               => 'Favor informar o NOME DO ARQUIVO como texto',
            'name.min'                  => 'Favor informar o NOME DO ARQUIVO com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o NOME DO ARQUIVO com máximo 100 caracteres',
            'type_id.required'          => 'Favor informar o TIPO DO ARQUIVO',
            'description.required'      => 'Favor informar a DESCRIÇÃO',
            'file.required'             => 'Favor selecionar o ARQUIVO',
            'file.required'             => 'Favor selecionar o ARQUIVO com as extensões: jpeg,jpg,png,pdf,docx,doc',
        ];

        return $messages;
    }


    public  static function msgBanner()
    {
        $messages = [
            'name.required'             => 'Favor informar o TÍTULO DO BANNER',
            'name.string'               => 'Favor informar o TÍTULO DO BANNER como texto',
            'name.min'                  => 'Favor informar o TÍTULO DO BANNER com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o TÍTULO DO BANNER com máximo 50 caracteres',
            'description.required'      => 'Favor informar a DESCRIÇÃO',
            'file.required'             => 'Favor selecionar o ARQUIVO',
            'mimes.required'            => 'Favor selecionar o ARQUIVO com as extensões: jpeg,jpg,png',
        ];

        return $messages;
    }

    public  static function msgOrder()
    {
        $messages = [
            'name.required'             => 'Favor informar o NOME DO CLIENTE',
            'name.string'               => 'Favor informar o NOME DO CLIENTE como texto',
            'name.min'                  => 'Favor informar o NOME DO CLIENTE com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o NOME DO CLIENTE com máximo 100 caracteres'
        ];

        return $messages;
    }

    public  static function msgPage()
    {
        $messages = [
            'title.required'  => 'Favor informar o TÍTULO DA PÁGINA',
            'title.string'    => 'Favor informar o TÍTULO DA PÁGINA como texto',
            'title.min'       => 'Favor informar o TÍTULO DA PÁGINA com mínimo 5 caracteres',
            'title.max'       => 'Favor informar o TÍTULO DA PÁGINA com máximo 20 caracteres',
            'banner.mimes'    => 'Favor selecionar o ARQUIVO com as extensões: jpeg,jpg,png',
            'summary.max'     => 'Favor informar o RESUMO DO CONTEÚDO PÁGINA com máximo 300 caracteres'
        ];

        return $messages;
    }


    public  static function msgMidia()
    {
        $messages = [
            'name.required'             => 'Favor informar o TÍTULO DA MÍDIA',
            'name.string'               => 'Favor informar o TÍTULO DA MÍDIA como texto',
            'name.min'                  => 'Favor informar o TÍTULO DA MÍDIA com mínimo 5 caracteres',
            'name.max'                  => 'Favor informar o TÍTULO DA MÍDIA com máximo 50 caracteres',
            'description.required'      => 'Favor informar a DESCRIÇÃO',
            'file.required'             => 'Favor selecionar o ARQUIVO',
            'mimes.required'            => 'Favor selecionar o ARQUIVO com as extensões: jpeg,jpg,png',
        ];

        return $messages;
    }

    public  static function msgSupport()
    {
        $messages = [
            'title.required'        => 'Favor informar o ASSUNTO DO SUPORTE',
            'title.string'          => 'Favor informar o ASSUNTO DO SUPORTE como texto',
            'title.min'             => 'Favor informar o ASSUNTO DO SUPORTE com mínimo 5 caracteres',
            'title.max'             => 'Favor informar o ASSUNTO DO SUPORTE com máximo 100 caracteres',
            'description.required'  => 'Favor informar a DESCRIÇÃO',
            'file.required'         => 'Favor selecionar o ARQUIVO com as extensões: jpeg,jpg,png,pdf,docx,doc',
        ];

        return $messages;
    }

    public  static function msgSupportAnswer()
    {
        $messages = [
            'description.required'  => 'Favor informar a DESCRIÇÃO',
            'file.required'         => 'Favor selecionar o ARQUIVO com as extensões: jpeg,jpg,png,pdf,docx,doc',
        ];

        return $messages;
    }


}