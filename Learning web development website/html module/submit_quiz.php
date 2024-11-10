<?php
// Connect to the database (adjust for your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define correct answers
$correct_answers = [
    'question1' => '6',  // HTML has 6 heading tags (h1-h6)
    'question2' => 'p'   // <p> tag is used for paragraphs
];

// Get the submitted answers
$user_answers = [
    'question1' => $_POST['question1'],
    'question2' => $_POST['question2']
];

// Check answers and determine if they're correct
$results = [];
foreach ($user_answers as $question => $answer) {
    if ($answer === $correct_answers[$question]) {
        $results[$question] = 'Correct';
    } else {
        $results[$question] = 'Incorrect';
    }
}

// Save the results to the database (optional)
$sql = "INSERT INTO quiz_results (question1, result1, question2, result2) VALUES ('" . $user_answers['question1'] . "', '" . $results['question1'] . "', '" . $user_answers['question2'] . "', '" . $results['question2'] . "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!-- Display results -->
<h2>Your Quiz Results</h2>
<p>Question 1: <?php echo $results['question1']; ?></p>
<p>Question 2: <?php echo $results['question2']; ?></p>
<br>
<a href="results.php">View All Results</a>  <!-- link to view all results -->
