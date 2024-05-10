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
// Get the count of questions
$sql = "SELECT COUNT(*) AS question_count FROM questions";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$question_count = $row['question_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dutch CBR Theory Test 2024</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Include custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>Dutch CBR Theory</h1>
                    <p>Powered by Deep River Development (<span class="question-count" style="color: yellow;"><?php echo $question_count; ?> questions</span>)</p>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <!-- Search bar -->
                    <input class="form-control me-2 search-bar" type="search" placeholder="Search questions" aria-label="Search" id="searchInput" oninput="searchQuestions()">
                    <!-- Upload question button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Question</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="container my-5">
        <!-- Container for questions -->
        <div class="row row-cols-1 row-cols-md-3" id="questionsContainer"></div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p class="mb-0">&copy; 2024 Dutch CBR Theory Test. All rights reserved.</p>
        </div>
    </footer>

    <!-- Upload Question Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for uploading questions -->
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="question" class="form-label">Question:</label>
                            <input type="text" class="form-control" id="question" name="question">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer:</label>
                            <textarea class="form-control" id="answer" name="answer"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript dependencies -->
    <!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom JavaScript -->
<script src="script.js"></script>    
</body>
</html>
