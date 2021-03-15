<?php
/* includes/classes/User.class.php
 * The user class.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

class User {
   // Properties (matching the database)
   private $db_table = "Users";
   public $id;
   public $name_first;
   public $name_last;
   public $password;
   public $created;

   // DB Connection
   private $conn;

   // Constructor
   public function __construct($db) {
      $this->conn = $db;
   }

   // Create
   public function createUser() {
      // Set up the query
      $query = "INSERT INTO
                  " . $this->db_table . "
               SET
                  name_first = :name_first,
                  name_last = :name_last,
                  email = :email,
                  password = :password";



      // Sanitize input
      $this->name_first = htmlspecialchars(strip_tags($this->name_first));
      $this->name_last = htmlspecialchars(strip_tags($this->name_last));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->password = htmlspecialchars(strip_tags($this->password));

      // Hash password
      $this->password = password_hash($this->password,PASSWORD_DEFAULT);

      // Prepare statment
      $stmt = $this->conn->prepare($query);

      // Bind data to params
      $stmt->bindParam(":name_first", $this->name_first);
      $stmt->bindParam(":name_last", $this->name_last);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":password", $this->password);

      // Try to execute the statement
      if($stmt->execute()) {
         return true;
      }
      
      // If anything fails, return false
      return false;
   }

   // LOG IN
   public function logIn() {
      // Set up the SQL query
      $query = "SELECT
                  id,
                  name_first,
                  name_last,
                  password
               FROM " . $this->db_table . "
               WHERE
                  email = :email
               LIMIT 1";

      // Sanitize input
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->password = htmlspecialchars(strip_tags($this->password));

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data to param
      $stmt->bindParam(":email", $this->email);

      // Try to execute the statement
      if($stmt->execute()) {
         // Fetch the result as an array
         $user = $stmt->fetch(PDO::FETCH_ASSOC);

         // If the given password matches the stored password
         if(password_verify($this->password, $user["password"])) {
            $_SESSION["id"] = $user["id"];
            $_SESSION["name"] = $user["name_first"] . " " . $user["name_last"];
            return true;
         }
      }

      // If anything fails, return false
      return false;
   }
}