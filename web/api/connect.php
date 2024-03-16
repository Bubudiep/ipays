<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
try {   
    $mysqli = new mysqli("localhost","root","","panship");
} catch (\Exception $e) {
    echo "Error: " .$e;
    http_response_code(404);
    exit();
}
?>