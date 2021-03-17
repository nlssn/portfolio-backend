<?php
/* includes/classes/Project.class.php
 * The project class.
 * joni1307@student.miun.se | HT20 | DT173G, Projekt
 */

class Project {
   // Properties (matching the database)
   private $db_table = "project";
   public $id;
   public $title;
   public $url;
   public $description;
   public $created;

   // DB Connection
   private $conn;

   // Constructor
   public function __construct($db) {
      $this->conn = $db;
   }

   // Create
   public function createProject() {
      // Set up the query
      $query = "INSERT INTO
                  " . $this->db_table . "
               SET
                  title = :title,
                  url = :url,
                  description = :description";

      // Sanitize input
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->url = htmlspecialchars(strip_tags($this->url));
      $this->description = htmlspecialchars(strip_tags($this->description));

      // Prepare statment
      $stmt = $this->conn->prepare($query);

      // Bind data to params
      $stmt->bindParam(":title", $this->title);
      $stmt->bindParam(":url", $this->url);
      $stmt->bindParam(":description", $this->description);

      // Try to execute the statement
      if($stmt->execute()) {
         return true;
      }
      
      // If anything fails, return false
      return false;
   }

   // Read
   public function getProjects() {
      // Set up the SQL query
      $query = "SELECT * FROM " . $this->db_table;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // The array that will be returned
      $result = array();

      // Try to execute the statement
      if($stmt->execute()) {
         // Count the results
         $count = $stmt->rowCount();

         // The array that will hold the actual data
         $result["data"] = array();

         // Save the amount of results
         $result["itemCount"] = $count;

         // If there's more than zero results
         if($count > 0) {
            
            // While there's still results
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               // Extract the data from $row as variables
               extract($row);

               // Create the item
               $item = array(
                  "id" => $id,
                  "title" => $title,
                  "url" => $url,
                  "description" => $description
               );

               // Push item to array
               array_push($result["data"], $item);
           }
         }
      }

      // Return the array
      return $result;
   }

   // Read Single
   public function getSingleProject($id) {
      // Set up the SQL query
      $query = "SELECT * FROM 
                  " . $this->db_table . "
               WHERE
                  id = :id
               LIMIT 1";

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data to param
      $stmt->bindParam(":id", $id);

      // Try to execute the statement
      if($stmt->execute()) {
         // Count the results
         $count = $stmt->rowCount();
      
         // If there's more than zero results
         if($count > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
         }
      }

      // If anything fails, return an empty array
      return array();
   }

   // Update
   public function updateProject($id) {
      // Set up the SQL query
      $query = "UPDATE
                  " . $this->db_table . "
               SET
                  title = :title,
                  url = :url,
                  description = :description
               WHERE
                  id = :id";

      // Sanitize text input
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->url = htmlspecialchars(strip_tags($this->url));
      $this->description = htmlspecialchars(strip_tags($this->description));

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data to params
      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":title", $this->title);
      $stmt->bindParam(":url", $this->url);
      $stmt->bindParam(":description", $this->description);

      // Try to execute the statement
      if($stmt->execute()) {
         return true;
      }
      
      // If anything fails, return false
      return false;
   }

   // Delete
   public function deleteProject($id) {
      // Set up the SQL query
      $query = "DELETE FROM
                  " . $this->db_table . "
               WHERE
                  id = :id";

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data to param
      $stmt->bindParam(':id', $id);

      // Try to execute the statement
      if($stmt->execute()) {
         return true;
      }
            
      // If anything fails, return false
      return false;
   }
}