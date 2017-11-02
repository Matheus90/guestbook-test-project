<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'App.php';

App::settings();

App::callAction();