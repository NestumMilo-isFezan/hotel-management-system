<?php
// Use environment variables or fallback to default values
$host = getenv('DB_HOST') ?: 'maria_db';
$user = getenv('DB_USERNAME') ?: 'mangsacoding';
$pass = getenv('DB_PASSWORD') ?: 'developer';
$db = getenv('DB_DATABASE') ?: 'hotelmanagement';

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch All Data....
function fetchAll($sql) {
  global $conn;
  try {
      $result = mysqli_query($conn, $sql);

      if ($result) {
          $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
          return $rows;
      } else {
          throw new Exception(mysqli_error($conn)); // Throw an exception for error handling
      }
  } catch (Exception $e) {
      // Handle the exception appropriately, e.g., log the error
      return false; // Or return an appropriate value
  }
}

// Fetch One Data
function fetchOne($sql){
  $rows = [];
  global $conn;
  $result = mysqli_query($conn, $sql);
  if($result){
    // Prepare Data
    $rows = mysqli_fetch_assoc($result);

  }
  else{
    $rows = null;
  }

  // Return or Pass Data
  return $rows;
}

?>
