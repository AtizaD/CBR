<?php
// Database connection details (replace with your actual credentials)
$servername = "127.0.0.1";
$username = "CBRDB";
$password = "1234";
$dbname = "cbr";

$questionId = $_GET['id'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  // If there's an error, log it and return an error message
  $error_message = "Connection failed: " . $conn->connect_error;
  error_log($error_message);
  die("Connection failed: " . $conn->connect_error);
} else {
  // If connection is successful, log a success message
  error_log("Connected to database successfully");
}

// Prepare SQL query to fetch questions
$sql = "SELECT id, question, image, answer FROM questions";

$result = $conn->query($sql);

// Check if any results found
if ($result === false) {
  // If there's an error in the query execution, log it and return an error message
  $error_message = "Error executing query: " . $conn->error;
  error_log($error_message);
  die("Error executing query: " . $conn->error);
}

$questions = array();

// Loop through each row and add it to the questions array
while ($row = $result->fetch_assoc()) {
  $questions[] = $row;
}

// Check if any questions found
if (empty($questions)) {
  echo "No questions found in the database.";
} else {
  // Encode the questions array as JSON for sending to the client (JavaScript)
  echo json_encode($questions);
}

$conn->close();
?>
