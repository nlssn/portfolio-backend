<?php
/* includes/classes/Database.class.php
 * A class that handles connecting to a MySQL database with PDO.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

class Database {
   // Database credentials
   private $host = "localhost";
   private $db_name = "dt173g";
   private $username = "dt173g";
   private $password = "dt173g";

   // The connection
   public $conn;

   public function connect() {
      // Close any previous connection
      $this->conn = null;

      // Try to connect. Catch and echo any errors that occur.
      try {
         $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conn->exec('set names utf8');
      } catch(PDOException $exception) {
         echo json_encode( array("message" => "Kunde inte ansluta till databasen: " . $exception->getMessage()) );
      }

      return $this->conn;
   }

   public function close() {
      $this->conn = null;
   }
}