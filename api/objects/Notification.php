<?php
/**
 * Notification - Contains notification data
 */
class Notification {

  // Object attributes
  private $_id;
  private $_body;
  private $_args;
  private $_badge;
  private $_sound;
  private $_thread_id;
  private $_category;
  private $_content_available;

  // Main constructor
  function __construct(array $data) {
    $this->hydrate($data);
  }

  // Getters
  public function getId() { return $this->_id; }
  public function getBody() { return $this->_body; }
  public function getArgs() { return $this->_args; }
  public function getBadge() { return $this->_badge; }
  public function getSound() { return $this->_sound; }
  public function getThreadId() { return $this->_thread_id; }
  public function getCategory() { return $this->_category; }
  public function isContentAvailable() { return $this->_content_available; }

  // Setters
  public function setId($id) {
    $id = (int) $id;
    if ($id > 0) {
      $this->_id = $id;
    }
  }

  public function setBody($body) {
    if (is_string($body)) {
      $this->_body = $body;
    }
  }

  public function setArgs($args) {
    if (is_array($args)) {
      $this->_args = $args;
    }
  }

  public function setBadge($badge) {
    $badge = (int) $badge;
    if ($badge >= 0) {
      $this->_badge = $badge;
    }
  }

  public function setSound($sound) {
    if (is_string($sound)) {
      $this->_sound = $sound;
    }
  }

  public function setThreadId($thread_id) {
    if (is_string($thread_id)) {
      $this->_thread_id = $thread_id;
    }
  }

  public function setCategory($category) {
    if (is_string($category)) {
      $this->_category = $category;
    }
  }

  public function setContentAvailable($content_available) {
    if (is_bool($content_available)) {
      $this->_content_available = $content_available;
    }
  }

  public function toPayloadiOS() {
    $array = array();
    if($this->getId() != null) {
      $array['id'] = $this->getId();
    }
    if($this->getBody() != null) {
      $array['aps']['alert']['loc-key'] = $this->getBody();
    }
    if($this->getArgs() != null) {
      $array['aps']['alert']['loc-args'] = $this->getArgs();
    }
    if($this->getSound() != null) {
      $array['aps']['sound'] = $this->getSound();
    }
    if($this->getBadge() != null) {
      $array['aps']['badge'] = $this->getBadge();
    }
    if($this->getCategory() != null) {
      $array['aps']['category'] = $this->getCategory();
    }
    if($this->getThreadId() != null) {
      $array['aps']['thread-id'] = $this->getThreadId();
    }
    if($this->isContentAvailable() != null && $this->isContentAvailable()) {
      $array['aps']['content-available'] = 1;
    }
    return $array;
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

}
