<?php
// Main config file
require_once dirname(__FILE__).'/../../../config/config.php';

// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, client");

// Generate utils methods

// In main config file:
// getDBHost(), getDBUsername(), getDBPassword()

// Read data from request
$headers = apache_request_headers();
$method = $_SERVER["REQUEST_METHOD"];
if($method == 'OPTIONS'){
  exit;
}else if($method == 'POST' || $method == 'PUT'){
  $data = json_decode(file_get_contents('php://input'), true);
}

// Availability check
$check = array(
  'AppMonday_iOS' => array(
    'project' => false,
    'competition' => true,
    'tip' => true
  ),
  'AppMonday_Android' => array(
    'project' => true,
    'competition' => true,
    'tip' => true
  )
);

$folder = '';
$paths = explode('/', $_SERVER['REQUEST_URI']);
for($i = 0; $i < $paths && empty($folder); $i++) {
  $folder = $paths[$i];
}
if(isset($headers['client']) && isset($check[$headers['client']]) && isset($check[$headers['client']][$folder])) {
  $available = $check[$headers['client']][$folder];
  if(!$available) {
    echo json_encode(array());
    exit;
  }
}

// Connect to database
try {
  $db = new PDO('mysql:host='.getDBHost().';dbname=appmonday', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
} catch(Exception $e) {
	exit ('Erreur while connecting to database: '.$e->getMessage());
}
