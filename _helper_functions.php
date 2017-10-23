<?php

function isBetween($num, $min, $max) {
    if( floatval($num) < floatval($min) || floatval($num) > floatval($max))
        return false;
    else
        return true;
}

function requireToVar($action, $file, $variables = []){
    ob_start();
    extract($variables);
    require($file);
    return ob_get_clean();
}

function exception_handler($exception) {
    echo "Site Error: <br/>
    <h1>".$exception->getMessage()."</h1>\n";
}

set_exception_handler('exception_handler');