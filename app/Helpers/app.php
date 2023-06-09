<?php


if(!function_exists('image')) {
    function image($src) {
        return sprintf('<img alt="image" src="%s" class="rounded-circle" width="35" data-toggle="tooltip">', $src);
    }
}

if(!function_exists('anchor')) {
    function anchor($href='#', $label='#', $class='') {
        return sprintf('<a href="%s" class="%s">%s</a>', $href, $class, $label);
    }
}

if(!function_exists('currency')) {
    function currency($value=null, $toDatabase=false, $default="0") {
        if (empty($value)) {
            return $default;
        }

        if($toDatabase) {
            return str_replace(",", ".", str_replace('.', '', $value));
        }
        
        return number_format($value, 2, ",", ".");
    }
}

if(!function_exists('formatData')) {
    function formatData($value, $format='d/m/Y', $suffix='') {

        if(empty($value)) {
            return null;
        }

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        return date($format, strtotime($value)) . $suffix;
    }
}