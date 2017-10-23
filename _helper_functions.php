<?php


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

spl_autoload_register(function ($class_name) {
    $conf = [
        'actions',
        'models'
    ];

    foreach($conf as $directoryToSearch){
        if (is_file(ROOT.'/'.$directoryToSearch . '/' . $class_name . '.php')) {
            require_once ROOT.'/'.$directoryToSearch . '/' . $class_name . '.php';
        }
    }
});