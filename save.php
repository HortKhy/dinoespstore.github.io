<?php
// Retrieve parameters from the URL
$md5 = $_GET['md5'];
$amount = $_GET['amount'];
$qr = $_GET['qr'];
$userId = $_GET['userid'];
$zoneId = $_GET['zoneid'];

// Generate a random 8-character string for the transaction
$transaction = substr(md5(mt_rand()), 0, 8);

// Connect to your MySQL database
$servername = "localhost";
$username = "sxtxusothea_mou";
$password = "sxtxusothea_mo";
$database = "sxtxusothea_mo";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to insert data into the database with status = pending
$sql = "INSERT INTO saveuser (md5, amount, qr, userId, zoneId, transaction, status) 
        VALUES ('$md5', '$amount', '$qr', '$userId', '$zoneId', '$transaction', 'pending')";

if ($conn->query($sql) === TRUE) {

    // Redirect to http://www.khsmm.site/ml/qr/qrcode.php with the transaction parameter
    header("Location: /qr/qrcode.php?transaction=$transaction");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>