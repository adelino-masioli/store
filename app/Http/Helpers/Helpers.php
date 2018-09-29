<?php

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
            return  "Administrador";
            break;
        case 2:
            return  "Moderador";
            break;
        case 3:
            return  "Usuário";
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
        return '/downloads/'.$path.'/'.config('app.template').'/thumb/';
    }else{
        return '/downloads/'.$path.'/'.config('app.template').'/';
    }
}
function defineDownloadPath($path=null)
{
    return public_path().'/downloads/'.$path.'/'.config('app.template');
}

function destroyFile($path=null, $file=null, $thumb=null)
{
    $fullpath = public_path().'/downloads/'.$path.'/'.config('app.template');
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
//switch colr
function switchCorlor($color){
    switch ($color) {
        case 7:
            return  'bg-gray disabled color-palette';
            break;
        case 8:
            return  'alert-info';
            break;
        case 10:
            return  'alert-success';
            break;
        case 13:
            return  'alert-danger';
            break;
        default:
            return '';
    }
}