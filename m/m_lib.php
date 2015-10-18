<?php

function __autoload($class_name)
{
    $dir = strtolower($class_name[0]);
    include_once($dir . "/" . strtolower($class_name) . ".php");
}

function ru2en($data)
{
    $data = mb_strtolower($data, 'UTF-8');

    $search = array("а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я", " ", "!", ",", ".", ":", ";", "?", " \" ", " ' ", "\\");
    $replace = array("a", "b", "v", "g", "d", "e", "e", "j", "z", "i", "i", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "c", "4", "sh", "sh", "", "y", "", "e", "y", "ya", "-");

    return str_replace($search, $replace, $data);
}