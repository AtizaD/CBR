<?php
// Database connection details (replace with your actual credentials)
$servername = "127.0.0.1";
$username = "CBRDB";
$password = "1234";
$dbname = "cbr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape special characters in the form inputs to prevent SQL injection
    $question = $conn->real_escape_string($_POST['question']);
    $answer = $conn->real_escape_string($_POST['answer']);
    
    // Check if an image file is selected
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if the file type is allowed
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            // Upload the file to the server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Insert the image path into the database
                $sql = "INSERT INTO questions (question, image, answer) VALUES ('$question', '$targetFilePath', '$answer')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                    // Reset the form fields
                    echo '<script>
                            document.getElementById("question").value = "";
                            document.getElementById("image").value = "";
                            document.getElementById("answer").value = "";
                          </script>';
                    // Redirect to home page
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        // If no image is selected, use a default image path
        $defaultImagePath = "no_image.jpg";
        $sql = "INSERT INTO questions (question, image, answer) VALUES ('$question', '$defaultImagePath', '$answer')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // Reset the form fields
            echo '<script>
                    document.getElementById("question").value = "";
                    document.getElementById("answer").value = "";
                  </script>';
            // Redirect to home page
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
