<?php
require_once '../config/core.php';
require_once '../objects/ProjectsManager.php';

$manager = new ProjectsManager($db);

if (isset($_GET['id']) && $method == 'GET') {

  $id = (int) $_GET['id'];

  if($id > 0) {

    $project = $manager->get($id);

    if ($project != null) {

      echo json_encode($project->toArray());

    } else {

      http_response_code(404);

      echo json_encode(array('success' => false));

    }

  } else {

    http_response_code(400);

    echo json_encode(array('success' => false));

  }

} else if (isset($data) && $method == 'POST') {

  $post = new Project(array(
    'name' => $data['name'], 'user' => $data['user'], 'link' => $data['link'],
    'description' => $data['description'], 'logo' => $data['logo']
  ));

  if ($manager->create($post)) {

    http_response_code(201);

    echo json_encode(array('success' => true));

  } else {

    http_response_code(400);

    echo json_encode(array('success' => false));

  }

} else {

  $start = isset($_GET['start']) ? (int) $_GET['start'] : 0;
  $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 25;

  $projects = $manager->getList($start, $limit);

  $toArray = function($value) { return $value->toArray(); };

  echo json_encode(array_map($toArray, $projects));

}
