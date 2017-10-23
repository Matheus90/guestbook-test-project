<?php

defined('ROOT') or define('ROOT', dirname(__FILE__));

$config = [
    'db' => [
        'db_name'   => 'morgens',
        'host'      => 'localhost',
        'username'  => 'morgens',
        'password'  => 'morgenspass'
    ],

    'defaultLayout' => ROOT."/views/layouts/layout.php",

    'urls' => [
        'default' => 'guestbook',
        'paths' => [
            'guestbook' => [
                'action' => 'Guestbook',
            ],
            'post-review' => [
                'action' => 'PostReview'
            ]
        ]
    ],


    // directory names in which to search for the classes
    'auto_load' => function( $conf ){
        spl_autoload_register(function ($class_name) use ($conf) {
            foreach($conf as $directoryToSearch){
                if (is_file(ROOT.'/'.$directoryToSearch . '/' . $class_name . '.php')) {
                    require_once ROOT.'/'.$directoryToSearch . '/' . $class_name . '.php';
                }
            }
        });
    },

    'class_paths' => [
        'components',
        'actions',
        'models'
    ],
];