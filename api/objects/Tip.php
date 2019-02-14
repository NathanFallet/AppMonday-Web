<?php
/**
 * Tip - contains tip data
 */
class Tip {

  // Object attributes
  private $_id;
  private $_name;
  private $_user;
  private $_description;
  private $_publish;

  // Main constructor
  function __construct($data) {
    $this->hydrate($data);
  }

  // Getters
  public function getId() { return $this->_id; }
  public function getName() { return $this->_name; }
  public function getUser() { return $this->_user; }
  public function getDescription() { return $this->_description; }
  public function getPublish() { return $this->_publish; }

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

  public function setUser($user) {
    if (is_string($user)) {
      $this->_user = $user;
    }
  }

  public function setDescription($description) {
    if (is_string($description)) {
      $this->_description = $description;
    }
  }

  public function setPublish($publish) {
    if ($this->validateDate($publish)) {
      $this->_publish = $publish;
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
    return array('id' => $this->getId(), 'name' => $this->getName(), 'user' => $this->getUser(), 'description' => $this->getDescription(), 'publish' => $this->getPublish());
  }

  // Utils
  function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

}
