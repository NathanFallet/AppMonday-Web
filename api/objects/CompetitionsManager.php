<?php
require_once '../objects/Competition.php';

/**
 * CompetitionsManager - Manages competition objects
 */
class CompetitionsManager {

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

  // Get a competition from ID
  public function get($id) {
    $id = (int) $id;

    // Select competitions datas from database
    $competitions = $this->getCompetitions('AND id = :id', 0, 1, array('id' => $id));
    if(count($competitions) == 1){
      return $competitions[0];
    }

    // Return null if nothing found
    return null;
  }

  // Get a list of competitions
  public function getList($start, $limit) {
    // Select competitions datas from database
    $competitions = $this->getCompetitions('', $start, $limit, array());

    return $competitions;
  }

  // Utils
  public function getCompetitions($where, $start, $limit, $args) {
    // Main SQL query
    $request = "SELECT *, start > NOW() as coming, start <= NOW() AND end >= NOW() as playing FROM competitions
      WHERE start IS NOT NULL $where ORDER BY start DESC LIMIT $start, $limit";

    // Execute SQL query
    $sql = $this->_db->prepare($request);
    $sql->execute($args);

    // Proccess data
    $competitions = array();
    while($data = $sql->fetch()){
      $competitions[] = new Competition(array(
        'id' => $data['id'], 'name' => $data['name'], 'description' => $data['description'],
        'criterias' => $data['criterias'], 'start' => $data['start'], 'end' => $data['end'],
        'coming' => $data['coming'] == 1, 'playing' => $data['playing'] == 1
      ));
    }
    return $competitions;
  }

}
