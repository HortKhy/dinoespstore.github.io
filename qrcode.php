<?php
// Retrieve the transaction parameter from the URL
$transaction = $_GET['transaction'];

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
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $amount = $row['amount'];
        $qr = $row['qr'];
        $md5 = $row['md5'];
        $userid = $row['userid'];
        $zoneid = $row['zoneid'];

        // Display the values
       // echo "Transaction: $transaction<br>";
       // echo "Amount: $amount<br>";
       // echo "QR Code: $qr<br>";
        //echo "MD5: $md5<br>";
       // echo "User ID: $userid<br>";
        //echo "Zone ID: $zoneid<br>";
    }
} else {
    echo "No data found for transaction: $transaction";
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>qrcode - KHQR</title>
  <meta property="og:title" content="qrcode - KHQR" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }

    .qrcode-loadingpic {
      animation: rotate 0.5s linear infinite;
    }

    @keyframes rotate {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);

    }
  </style>
  <link rel="shortcut icon" href="public/unnamed.png" type="icon/png" sizes="32x32" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dangrek:wght@400&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet" href="https://unpkg.com/@teleporthq/teleport-custom-scripts/dist/style.css" />
</head>

<body>
  <link rel="stylesheet" href="./style.css" />
  <div>
    <link href="./qrcode.css" rel="stylesheet" />

    <div class="qrcode-container">
      <div class="qrcode-body body">
        <img src="https://www.mmotools.me/bakong-khqr/image/loading.svg" alt="image" class="qrcode-loadingpic" />
        <span class="qrcode-minutes" id="countdown">
          <span>3:00</span>
          <br />
        </span>
        <span id="name" class="qrcode-name">ROVYTOP</span>
        <span id="currency" class="qrcode-currency">$</span>
        <span id="amount" class="qrcode-amount"><?php echo $amount; ?></span>
        <div class="qrcode-head">
          <div class="qrcode-header">
            <div class="qrcode-container1">
              <div class="qrcode-container2"></div>
              <div class="qrcode-container3">
                <div class="qrcode-container4 qrhrader"></div>
                <img alt="image" src="public/khqr%20logo-200h.png" class="qrcode-image logo" />
              </div>
            </div>
          </div>
        </div>
        <div class="qrcode-line line">
          <div class="qrcode-qrcode qrcode">
            <img id="qr-code" alt="image" src="https://api.qrserver.com/v1/create-qr-code/?size=190x190&data=<?php echo $qr; ?>"
              class="qrcode-qr" />
            <img id="logo" alt="image" src="https://checkout.payway.com.kh/images/usd-khqr-logo.svg"
              class="qrcode-logo" />
          </div>
        </div>
        <img alt="image"
          src="public/payment_icons-cd5e952dde3b886dea1fd1b983d43ce372f1692dec253808ec654096d2feb701-200h.png"
          class="qrcode-banklogo" />
      </div>
    </div>
  </div>
  
  <script>
  // Set the initial time in seconds
let timeInSeconds = 180; // 3 minutes

// Function to update the countdown
function updateCountdown() {
  const minutes = Math.floor(timeInSeconds / 60);
  const seconds = timeInSeconds % 60;

  // Format the time as "mm:ss"
  const formattedTime = `${minutes.toString().padStart(2, '')}:${seconds.toString().padStart(2, '0')}`;

  // Update the displayed time
  document.getElementById('countdown').innerHTML = `<span>${formattedTime}</span><br />`;

  // Check if time is up
  if (timeInSeconds === 0) {
    // Get the current URL
    var currentUrl = window.location.href;

    // Construct the new URL by appending the current URL as a parameter
    var newUrl = "/qr/expire.php?url=" + encodeURIComponent(currentUrl);

    // Redirect to the new URL
    window.location.href = newUrl;
  } else {
    // Decrement the time
    timeInSeconds--;
  }
}

// Call the updateCountdown function every second
setInterval(updateCountdown, 1000);

// API
const apiUrl = 'https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5';
const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE3MTAwNDk1OTEsImlhdCI6MTcwMjAxNDM5MSwiZGF0YSI6eyJpZCI6IjUzNDFkMDJhZWZlYjQ1NyJ9fQ.fkbmEBUieYe-6b2HY3RKa2SH6D8ZXOcrIf51RhijFVw'; // Replace with your actual token

// Function to check the API and redirect if successful
async function checkAPIAndRedirect() {
  const data = JSON.stringify({ md5: '<?php echo $md5; ?>' });

  const response = await fetch(apiUrl, {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json',
    },
    body: data,
  });

  const jsonResponse = await response.json();

  if (jsonResponse.responseCode === 0) {
    // Redirect to the successful PHP page
    window.location.href = '/qr/tg.php?transaction=<?php echo $transaction; ?>';
  }
}

// Call the function every second
setInterval(checkAPIAndRedirect, 1000);

  </script>
</body>

</html>