<?php

header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($_FILES);