<?php
require_once '../objects/Notification.php';

/**
 * NotificationsManager - Manages notifications
 */
class NotificationsManager {

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

  // Register an iOS device token
  public function registeriOS($device_token) {
    $sql = $this->_db->prepare("INSERT INTO notification_tokens (ios_device_token) VALUES(?)");
    $sql->execute(array($device_token));
  }

  // Send to an iOS device
  public function sendToiOS(Notification $notification, $device_token) {
    $ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', '/etc/ssl/certs/appmonday-apns-dev.pem');
		// Open a connection to the APNS server
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (!$fp) {
			return false;
    }
		// Create the payload body
		$body = $notification->toPayloadiOS();
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		// Close the connection to the server
		fclose($fp);
		if (!$result) {
			return false;
		} else {
			return true;
    }
  }

  // Broadcast a notification
  public function broadcastNotification(Notification $notification) {
    // Select all access tokens linked with this user
    $sql = $this->_db->query("SELECT * FROM notification_tokens");
    // Iterate to send them a notification
    while($dn = $sql->fetch()) {
      // If an iOS device token is associated with this access token, send it an iOS push notification
      if(!empty($dn['ios_device_token'])){
        $this->sendToiOS($notification, $dn['ios_device_token']);
      }
    }
  }

}
