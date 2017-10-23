<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'App.php';

App::settings();

App::callAction();

/*
$page = $pages[$_GET['page']];

$navTopLinks = isset($page['navTopLinks']) ? $page['navTopLinks'] : [];

$content = requireToVar('views/'.$page['path']);

$layout = requireToVar('views/layouts/layout.php', compact('content', 'navTopLinks'));

echo $layout;*/