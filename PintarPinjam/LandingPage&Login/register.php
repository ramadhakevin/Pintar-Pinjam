<?php
// Load environment variables
require_once('./config.php');

// Create connection
$conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Form validation
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $role = 'user'; // Assuming the role is 'user' for new registrations
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: login.html?registered=true");
        exit;
    } else {
        echo "Error: " . $stmt->error;
        header("Location: login.html?registerValidate=false");
    }

    $stmt->close();
}

$conn->close();
?>