<?php

//only number
function only_number($c)
{
    return preg_replace("/[^0-9]/", "",$c);
}
//helper convert date
function  date_br($date)
{
    if (!$date instanceof \DateTime) {
        $date = new \DateTime($date);
    }
    return $date->format('d-m-Y H:i');
}
//date_universal
function  date_universal($date)
{
    if($date != NULL):
        $array=explode("/",$date);
        $rev=array_reverse($array);
        $date=implode("-",$rev);
        return $date;
    else:
        return null;
    endif;
}
//helper format date time
function  format_date($data = NULL)
{
    if($data):
        $d = new DateTime($data);
        return $d->format('d/m/Y \à\s H:i:s');
    else:
        return date('Y-m-d H:i:s');
    endif;
}
//helper format inverse date time
function  format_inversedate($data = NULL)
{
    if($data != NULL):
        $array=explode("/",$data);
        $rev=array_reverse($array);
        $date=implode("-",$rev);
        return $date . ' '. date('H:i:s');
    else:
        return date('Y-m-d H:i:s');
    endif;
}
//format_inversedateonly
function  format_inversedateonly($data = NULL)
{
    if($data != NULL):
        $array=explode("/",$data);
        $rev=array_reverse($array);
        $date=implode("-",$rev);
        return $date;
    else:
        return date('Y-m-d');
    endif;
}
//date_only_br
function date_only_br($date)
{
    if (!$date instanceof \DateTime) {
        $date = new \DateTime($date);
    }
    return $date->format('d/m/Y');
}
//date_mouth_day
function date_mouth_day($date)
{
    if (!$date instanceof \DateTime) {
        $date = new \DateTime($date);
    }
    return $date->format('d-m');
}
//helper format  time
function  format_time($time = NULL)
{
    if($time):
        $d = new DateTime($time);
        return $d->format('H:i');
    else:
        return date('Y-m-d H:i:s');
    endif;
}
//helper convert money_br
function  money_br($date)
{
    return number_format($date, 2, ',', '.');
}
//helper convert money_reverse
function  moneyReverse($date)
{
    $price = str_replace('.', '', $date);
    return  str_replace(',', '.', $price);
}
//return status type
function statusRegisterType($type)
{
    switch ($type) {
        case 1:
            return  "Ativo";
            break;
        case 2:
            return  "Inativo";
            break;
        case 3:
            return  "Excluído";
            break;
    }
}
//return user type
function userType($type)
{
    switch ($type) {
        case 1:
            return  "Super Administrador";
            break;
        case 2:
            return  "Administrador";
            break;
        case 3:
            return  "Gerente";
            break;
        case 4:
            return  "Usuários";
            break;
        case 5:
            return  "Financeiro";
            break;
        case 6:
            return  "Produção";
            break;
        case 7:
            return  "Expedição";
            break;
        case 8:
            return  "Cliente";
            break;
    }
}

function convertFileSize($size){
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}


function defineUploadPath($path=null, $thumb=null)
{
    if($thumb!=null){
        return '/downloads/'.$path.'/'.setBaseUrlMidias().'/thumb/';
    }else{
        return '/downloads/'.$path.'/'.setBaseUrlMidias().'/';
    }
}
function defineDownloadPath($path=null)
{
    return public_path().'/downloads/'.$path.'/'.setBaseUrlMidias();
}

function destroyFile($path=null, $file=null, $thumb=null)
{
    $fullpath = public_path().'/downloads/'.$path.'/'.setBaseUrlMidias();
    if($thumb=='thumb'){
        if(File::exists($fullpath.'/thumb/'.$file)){
            File::delete($fullpath.'/thumb/'.$file);
        }
        if(File::exists($fullpath.'/'.$file)){
            File::delete($fullpath.'/'.$file);
        }
    }else{
        if(File::exists($fullpath.'/'.$file)){
            File::delete($fullpath.'/'.$file);
        }
    }
}

//return bgcolor
function bgColor($i)
{
    switch ($i) {
        case 1:
            return  "bg-aqua";
            break;
        case 2:
            return  "bg-yellow";
            break;
        case 3:
            return  "bg-green";
            break;
        case 4:
            return  "bg-red";
            break;
        case 5:
            return  "bg-fuchsia";
            break;
        case 6:
            return  "bg-gray";
            break;
        case 7:
            return  'bg-gray disabled color-palette';
            break;
        case 8:
            return  'alert-info';
            break;
        case 9:
            return  "bg-blue";
            break;
        case 10:
            return  'bg-finish';
            break;
        case 11:
            return  'bg-black';
            break;
        case 12:
            return  'bg-green';
            break;
        case 13:
            return  "bg-red";
            break;
        default:
            return '';
    }
}

//return iconOrder
function iconOrder($i)
{
    switch ($i) {
        case 1:
            return  "fa fa-star-o";
            break;
        case 2:
            return  "fa fa-star-half-o";
            break;
        case 3:
            return  "fa fa-folder-open";
            break;
        case 4:
            return  "fa fa-times-circle";
            break;
        case 5:
            return  "fa fa-cloud-download";
            break;
        case 6:
            return  "fa fa-download";
            break;
        case 7:
            return  'fa fa-tasks';
            break;
        case 8:
            return  'fa fa-dollar';
            break;
        case 9:
            return  "fa fa-cogs";
            break;
        case 10:
            return  'fa fa-check-square-o';
            break;
        case 11:
            return  'fa fa-truck';
            break;
        case 12:
            return  'fa fa-flag-checkered';
            break;
        case 13:
            return  "fa fa-ban";
            break;
        default:
            return '';
    }
}

// origin
function quoteOrigin($i)
{
    switch ($i) {
        case 1:
            return  "Sistema";
            break;
        case 2:
            return  "Site";
            break;
    }
}
//get user admin id
function adminId(){
    return 1;
}
//status order
function statusOrder($status){
    switch ($status) {
        case 'active':
            return  1;
            break;
        case 'inactive':
            return  2;
            break;
        case 'open':
            return  3;
            break;
        case 'closed':
            return  4;
            break;
        case 'not-download':
            return  5;
            break;
        case 'download':
            return  6;
            break;
        case 'proccess':
            return  7;
            break;
        case "financial":
            return  8;
            break;
        case "production":
            return  9;
            break;
        case "finished":
            return  10;
            break;
        case "expedition":
            return  11;
            break;
        case "delivered":
            return  12;
            break;
        case "canceled":
            return  13;
            break;
    }
}

function canceledRegister(){
    return 13;
}
//switch page
function switchPage($page){
    switch ($page) {
        case 'product':
            return  'Produto';
            break;
        case 'contact':
            return  'Contato';
            break;
        case 'about':
            return  'Sobre';
            break;
        case 'content':
            return  'Conteúdo';
            break;
        default:
            return 'Login';
    }
}

function setBaseUrlMidias()
{
    $config_site = \App\Services\ConfigurationSite::getConfiguration();
    if($config_site->nickname){
        return $config_site->nickname;
    }else{
        return 'manazer-files';
    }
}

//path midias
function pathMidia($type)
{
    return url('/').'/downloads/'.$type.'/'.setBaseUrlMidias();
}

/*roles*/
function permission_level_one()
{
    return [1];
}
function permission_level_two()
{
    return [1, 2];
}
function permission_level_three()
{
    return [1, 2, 3];
}
function permission_level_four()
{
    return [1, 2, 3, 4];
}
function permission_level_five()
{
    return [1, 2, 3, 4, 5];
}
function permission_level_six()
{
    return [1, 2, 3, 4, 5, 6];
}
function permission_level_seven()
{
    return [1, 2, 3, 4, 5, 6, 7];
}
function permission_level_eight()
{
    return [1, 2, 3, 4, 5, 6, 7, 8];
}
function permission_level_finance()
{
    return [1, 2, 3, 5];
}

function userTypeId($type){
    switch ($type) {
        case 'superadmin':
            return  1;
            break;
        case 'admin':
            return  2;
            break;
        case 'manager':
            return  3;
            break;
        case 'user':
            return  4;
            break;
        case 'financial':
            return  5;
            break;
        case 'production':
            return  6;
            break;
        case 'expedition':
            return  7;
            break;
        case "customer":
            return  8;
            break;
    }
}