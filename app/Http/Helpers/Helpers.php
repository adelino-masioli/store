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