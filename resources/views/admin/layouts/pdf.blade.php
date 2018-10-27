<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$data->name}}</title>

    <style>
        *{
            margin: 0px;
            font-size: 12pt;
        }
        body {
            font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
            font-weight: 400;
            color: #000000;
        }
        .col-xs-12 {
            width: 100%;
        }
        .invoice-header {
            height: 230px;
            font-size: 8px;
            border: 1px solid #ddd!important;
            margin-bottom: 20px;
            border-radius: 10px;
            padding: 10px;
        }
        .invoice {
            position: relative;
            background: #fff;
            padding: 10px;
            margin: 10px;
        }
        .page-header {
            margin: 10px 0 20px 0;
            font-size: 22px;
            border-bottom: 1px solid #ddd!important;
            padding-bottom: 10px;
            text-align: center;
            height: 50px;
            display: flex;
            align-items: center;
        }
        .page-header>span{
            float: left;
        }
        .page-header>small {
            margin-top: 5px;
            float: right!important;
            font-size: 12px;
            font-weight: 400;
        }
        .page-header>.text-header{
            margin: auto;
            display: inline-block;
            font-weight: 400;
            font-size: 20px;
            letter-spacing: 3px;
        }
        .col-sm-4 {
            width: 30%;
            float: left;
            border-right: 1px solid #ddd!important;
            padding: 1.5%;
        }
        address, .invoice-col, strong {
            margin-bottom: 0px;
            font-style: normal;
            line-height: 1.42857143;
            font-size: 12px;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            margin: 0px;
            font-size: 12px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border: 1px solid #ddd;
            border-top: 0px;
            border-right:0px;
        }
        .border{
            border: 1px solid #ddd;
            border-top: 0px;
            border-right:0px;
            font-weight: bold;
        }
        .border-top{
            border-top: 1px solid #ddd!important;
        }
        .border-right{
            border-right: 1px solid #ddd!important;
        }

        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .bg-gray{
            background: #e9e9e9;
        }
        .no-border-right{
            border-right: 0px!important;
        }
    </style>

</head>
<body>

@yield('content')

</body>
</html>