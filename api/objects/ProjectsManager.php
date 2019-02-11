<?php
require_once '../objects/Project.php';

/**
 * ProjectsManager - Manages project objects
 */
class ProjectsManager {

  // Manager attributes
  private $_db;

  // Constructor
  function __construct($db) {
    $this->setDb($db);
  }

  // Setters
  public function setDb(PDO $db) {
    $this->_db = $db;
  }

  // Get a project from ID
  public function get($id) {
    $id = (int) $id;

    // Select projects datas from database
    $posts = $this->getProjects('AND id = :id', 0, 1, array('id' => $id));
    if(count($posts) == 1){
      return $posts[0];
    }

    // Return null if nothing found
    return null;
  }

  // Get a list of projects
  public function getList($start, $limit) {
    // Select projects datas from database
    $projects = $this->getProjects('', $start, $limit, array());

    return $projects;
  }

  // Create a new post
  public function create(Project $project) {
    // Create the project in database
    if (!empty($project->getName()) && !empty($project->getUser()) && !empty($project->getDescription()) && !empty($project->getLink())) {
      $sql = $this->_db->prepare("SELECT * FROM projects WHERE name = ? OR link = ?");
  		$sql->execute(array($project->getName(), $project->getLink()));
  		$dn = $sql->fetch();
  		if(!$dn){
  			$sql2 = $this->_db->prepare("INSERT INTO projects (name, submit, user, link, logo, description) VALUES(?, NOW(), ?, ?, ?, ?)");
  			if($sql2->execute(array($project->getName(), $project->getUser(), $project->getLink(), $project->getLogo(), $project->getDescription()))){
  				return true;
  			}
  		}
    }
    return false;
  }

  // Utils
  public function getProjects($where, $start, $limit, $args) {
    // Main SQL query
    $request = "SELECT * FROM projects WHERE publish IS NOT NULL AND publish <= NOW() $where ORDER BY publish DESC LIMIT $start, $limit";

    // Execute SQL query
    $sql = $this->_db->prepare($request);
    $sql->execute($args);

    // Proccess data
    $projects = array();
    while($data = $sql->fetch()){
      $projects[] = new Project(array('id' => $data['id'], 'name' => $data['name'], 'user' => $data['user'],
        'link' => $data['link'], 'description' => $data['description'], 'logo' => $data['logo'],
        'submit' => $data['submit'], 'publish' => $data['publish']));
    }
    return $projects;
  }

}
