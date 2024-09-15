<?php
// Retrieve the transaction parameter from the URL
$transaction = $_GET['transaction'];

// Your Telegram Bot API token and chat ID
$telegramBotToken = '6885064915:AAFelplb3aqbKDCZY56-TWYDaqpXfLVobDQ';
$telegramChatId = '1290697237';

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

// Prepare and execute the SQL query to select data based on the transaction
$sql = "SELECT amount, qr, md5, userid, zoneid FROM saveuser WHERE transaction = '$transaction'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data from the database
    $row = $result->fetch_assoc();

    // Message content
    $amount = $row['amount'];
    $qr = $row['qr'];
    $md5 = $row['md5'];
    $userid = $row['userid'];
    $zoneid = $row['zoneid'];

    $message = "💸New order transaction: $transaction\n\n-Amount: $amount $\n-userid: $userid\n-zoneid: $zoneid\n-MD5: $md5";

    // Telegram Bot API endpoint
    $telegramApiEndpoint = "https://api.telegram.org/bot$telegramBotToken/sendMessage";

    // Data to be sent
    $data = [
        'chat_id' => $telegramChatId,
        'text' => $message,
    ];

    // Use cURL to make the request
    $ch = curl_init($telegramApiEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        die('Error occurred while sending message to Telegram: ' . curl_error($ch));
    }

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check for Telegram API errors
    if (!$responseData || !$responseData['ok']) {
        die('Telegram API error: ' . $response);
    }

    // Check if the message is sent successfully
    if ($responseData['ok']) {
        // Redirect to the successful PHP page
        header("Location: /qr/successful.php");
        exit();
    } else {
        // Output the response for debugging (optional)
        echo $response;
    }
} else {
    echo "No data found for transaction: $transaction";
}

// Close the database connection
$conn->close();
?>
