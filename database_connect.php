<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "module13";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Couldn't connect to database!" . mysqli_connect_error());
}

$id = "";
$name = "";
$email = NULL;
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = NULL;

    // Read the "email" request variable
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    // Validate the address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo $email . ' is NOT a valid email address.';
        die();
    }

    // Check the domain
    $atPos = mb_strpos($email, '@');
    $domain = mb_substr($email, $atPos + 1);
    if (!checkdnsrr($domain . '.', 'MX')) {
        echo 'Domain "' . $domain . '" is not valid';
        die();
    }

    // The address is valid
    echo $email . ' is a valid email address.';
    header('location: index.php');
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['userName'];
    $message = $_POST['message'];
    $date = $_POST['date'];

    $sql = "INSERT INTO comment (userName, email, message, date) 
    VALUES ('$name', '$email', '$message', NOW())";
    mysqli_query($conn, $sql);
    header('location: index.php');
}

$results = mysqli_query($conn, "SELECT * FROM comment");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM comment WHERE id=$id");
    header('location: index.php');
}
