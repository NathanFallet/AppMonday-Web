<?php
require_once '../config/core.php';
require_once '../objects/TipsManager.php';

$manager = new TipsManager($db);

if (isset($_GET['id']) && $method == 'GET') {

  $id = (int) $_GET['id'];

  if($id > 0) {

    $tip = $manager->get($id);

    if ($tip != null) {

      echo json_encode($tip->toArray());

    } else {

      http_response_code(404);

      echo json_encode(array('success' => false));

    }

  } else {

    http_response_code(400);

    echo json_encode(array('success' => false));

  }

} else {

  $start = isset($_GET['start']) ? (int) $_GET['start'] : 0;
  $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 25;

  $tips = $manager->getList($start, $limit);

  $toArray = function($value) { return $value->toArray(); };

  echo json_encode(array_map($toArray, $tips));

}
