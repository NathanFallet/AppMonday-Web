<?php
/**
 * Project - contains project data
 */
class Project {

  // Object attributes
  private $_id;
  private $_name;
  private $_user;
  private $_link;
  private $_description;
  private $_logo;
  private $_submit;
  private $_publish;

  // Main constructor
  function __construct($data) {
    $this->hydrate($data);
  }

  // Getters
  public function getId() { return $this->_id; }
  public function getName() { return $this->_name; }
  public function getUser() { return $this->_user; }
  public function getLink() { return $this->_link; }
  public function getDescription() { return $this->_description; }
  public function getLogo() { return $this->_logo; }
  public function getSubmit() { return $this->_submit; }
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

  public function setLink($link) {
    if (is_string($link)) {
      $this->_link = $link;
    }
  }

  public function setDescription($description) {
    if (is_string($description)) {
      $this->_description = $description;
    }
  }

  public function setLogo($logo) {
    if (is_string($logo)) {
      $this->_logo = $logo;
    } else {
      $this->_logo = '';
    }
  }

  public function setSubmit($submit) {
    if ($this->validateDate($submit)) {
      $this->_submit = $submit;
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
    return array('id' => $this->getId(), 'name' => $this->getName(), 'user' => $this->getUser(), 'link' => $this->getLink(),
      'description' => $this->getDescription(), 'logo' => $this->getLogo(), 'submit' => $this->getSubmit(), 'publish' => $this->getPublish());
  }

  // Utils
  function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

}
