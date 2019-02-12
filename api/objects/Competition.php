<?php
/**
 * Competition - contains competition data
 */
class Competition {

  // Object attributes
  private $_id;
  private $_name;
  private $_description;
  private $_criterias;
  private $_start;
  private $_end;
  private $_coming;
  private $_playing;

  // Main constructor
  function __construct($data) {
    $this->hydrate($data);
  }

  // Getters
  public function getId() { return $this->_id; }
  public function getName() { return $this->_name; }
  public function getDescription() { return $this->_description; }
  public function getCriterias() { return $this->_criterias; }
  public function getStart() { return $this->_start; }
  public function getEnd() { return $this->_end; }
  public function isComing() { return $this->_coming; }
  public function isPlaying() { return $this->_playing; }

  // Setters
  public function setId($id) {
    $id = (int) $id;
    if ($id > 0) {
      $this->_id = $id;
    }
  }

  public function setName($name) {
    if (is_string($name)) {
      $this->_name = $name;
    }
  }

  public function setDescription($description) {
    if (is_string($description)) {
      $this->_description = $description;
    }
  }

  public function setCriterias($criterias) {
    if (is_string($criterias)) {
      $this->_criterias = $criterias;
    }
  }

  public function setStart($start) {
    if ($this->validateDate($start)) {
      $this->_start = $start;
    }
  }

  public function setEnd($end) {
    if ($this->validateDate($end)) {
      $this->_end = $end;
    }
  }

  public function setComing($coming) {
    if (is_bool($coming)) {
      $this->_coming = $coming;
    }
  }

  public function setPlaying($playing) {
    if (is_bool($playing)) {
      $this->_playing = $playing;
    }
  }

  // Hydrate
  public function hydrate(array $data) {
    foreach ($data as $key => $value) {
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }

  // Convert to an array (for JSON)
  public function toArray() {
    $array = array(
      'id' => $this->getId(), 'name' => $this->getName(), 'description' => $this->getDescription(),
      'start' => $this->getStart(), 'end' => $this->getEnd(), 'coming' => $this->isComing(),
      'playing' => $this->isPlaying()
    );
    if($this->getCriterias() != null && !$this->isComing()) {
      $array['criterias'] = $this->getCriterias();
    }
    return $array;
  }

  // Utils
  function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

}
