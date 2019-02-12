<?php
require_once '../config/core.php';
require_once '../objects/CompetitionsManager.php';

$manager = new CompetitionsManager($db);

if (isset($_GET['id']) && $method == 'GET') {

  $id = (int) $_GET['id'];

  if($id > 0) {

    $competition = $manager->get($id);

    if ($competition != null) {

      echo json_encode($competition->toArray());

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

  $competitions = $manager->getList($start, $limit);

  $toArray = function($value) { return $value->toArray(); };

  echo json_encode(array_map($toArray, $competitions));

}
