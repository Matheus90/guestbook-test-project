<?php

require_once '_helper_functions.php';

class App {

    protected static $_self;

    private static $_config;

    public static function settings($conf_part = null){
        if( !self::$_config ){
            require_once 'config.php';

            if( isset($config) ){
                self::$_config = $config;
                $auto_load = self::$_config['auto_load'];
                $auto_load( App::settings('class_paths') );
            }
        }

        if( is_null($conf_part) )
            return self::$_config;
        else if( isset(self::$_config[$conf_part]) )
            return self::$_config[$conf_part];
        else {
            throw new Exception("Requested config (\"$conf_part\") not found.");
        }
    }

    private static $_db;

    public static function db(){

        if( !self::$_db ){
            $db_params = self::settings()['db'];

            try {
                // Create connection
                self::$_db = new PDO("mysql:host=".$db_params['host'].";dbname=".$db_params['db_name'], $db_params['username'], $db_params['password']);
                // set the PDO error mode to exception
                self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }

        return self::$_db;
    }


    public static function callAction(){
        extract(self::loadAction());

        $action = new $actionName();
        $action->call($params);
        exit();
    }

    public static function loadAction(){
        $actions = self::settings('urls');

        $error = null;
        if( !isset($_GET['mAct']) ){
            $actionName = $actions['paths'][$actions['default']]['action'];
        } else if( !in_array($_GET['mAct'], array_keys($actions['paths'])) ){
            self::render('errors/404', ['page' => $_GET['page']], false);
        } else {
            $actionName = $actions['paths'][$_GET['mAct']]['action'];
        }

        if( !is_null($error) )
            exit($error);

        unset($_GET['mAct']);
        $params = $_GET;

        return compact('actionName', 'params');
    }

    public static function render($viewName, $parameters = [], $layout = null){
        $tempAction = new MBaseAction();
        $tempAction->render($viewName, $parameters, $layout);
    }

    public static function redirect($urlPath, $parameters = [], $perm = false){
        $url = $urlPath;
        $params = '';
        foreach($parameters as $key => $value){
            $params .= ($params != '' ? '&' : '').urlencode($key).'='.urlencode($value);
        }
        if( $params != '' )
            $url .= '?'.$params;

        header('Location: ' . $url, true, $perm ? 301 : 302);

        exit();
    }
}