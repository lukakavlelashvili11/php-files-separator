<?php

header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/vendor/autoload.php';

use app\controllers\zipController;

$files = new zipController($_FILES,$_POST);
// echo json_encode($_FILES['files']);