<?php
require_once '../objects/Tip.php';

/**
 * TipsManager - Manages tip objects
 */
class TipsManager {

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

  // Get a tip from ID
  public function get($id) {
    $id = (int) $id;

    // Select competitions datas from database
    $tips = $this->getTips('AND id = :id', 0, 1, array('id' => $id));
    if(count($tips) == 1){
      return $tips[0];
    }

    // Return null if nothing found
    return null;
  }

  // Get a list of tips
  public function getList($start, $limit) {
    // Select tips datas from database
    $tips = $this->getTips('', $start, $limit, array());

    return $tips;
  }

  // Utils
  public function getTips($where, $start, $limit, $args) {
    // Main SQL query
    $request = "SELECT * FROM tips WHERE publish IS NOT NULL AND publish <= NOW() $where ORDER BY publish DESC LIMIT $start, $limit";

    // Execute SQL query
    $sql = $this->_db->prepare($request);
    $sql->execute($args);

    // Proccess data
    $tips = array();
    while($data = $sql->fetch()){
      $tips[] = new Tip(array('id' => $data['id'], 'name' => $data['name'], 'user' => $data['user'], 'description' => $data['description'], 'publish' => $data['publish']));
    }
    return $tips;
  }

}
