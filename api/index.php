<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once '../../config/config.php';

$data = json_decode(file_get_contents('php://input'), true);
$bdd = new PDO('mysql:host='.getDBHost().';dbname=appmonday', getDBUsername(), getDBPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

if($data['method'] == 'Web:submitApp()'){
	$name = trim($data['name']);
	$user = trim($data['user']);
	$link = trim($data['link']);
	$logo = trim($data['logo']);
	$description = trim($data['description']);
	if(!empty($name) && !empty($user) && !empty($link) && !empty($description)){
		$sql = $bdd->prepare("SELECT * FROM projects WHERE name = ? OR link = ?");
		$sql->execute(array($name, $link));
		$dn = $sql->fetch();
		if(!$dn){
			$sql2 = $bdd->prepare("INSERT INTO projects (name, submit, user, link, logo, description) VALUES(?, NOW(), ?, ?, ?, ?)");
			if($sql2->execute(array($name, $user, $link, $logo, $description))){
				echo json_encode(array('success' => 'success'));
			}else{
				echo json_encode(array('error' => 'error_unknown'));
			}
		}else{
			echo json_encode(array('error' => 'error_name_or_link_already_taken'));
		}
	}else{
    echo json_encode(array('error' => 'error_all_fields_required'));
  }
}else if($data['method'] == 'Web:getApps()'){
	$start = ($data['start'] != 0 ? $data['start'] : 0);
	$limit = ($data['limit'] != 0 ? $data['limit'] : 10);
	$sql = $bdd->query("SELECT * FROM projects WHERE publish IS NOT NULL AND publish <= NOW() ORDER BY publish DESC LIMIT $start, $limit");
	$response = $sql->fetchAll();
	$response['success'] = true;
	echo json_encode($response);
}
