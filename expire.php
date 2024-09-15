<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: transparent; /* Set to transparent or remove this line */
}


        #content {
            text-align: center;
            color: #e74c3c; /* Red text color */
        }

        #tryAgainButton {
            font-size: 16px;
            padding: 10px;
            background-color: #e74c3c; /* Red background color for the button */
            color: #fff; /* White text color for the button */
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="content">
    <p><img alt="" src="https://printme.online/wp-content/uploads/2020/04/payment_fail_icon-300x300.png" style="height:150px; width:150px"></p>
    <p><strong>Qr code expired</strong></p>
    <p><strong>Please try again</strong></p>
    <button id="tryAgainButton">Try Again</button>
</div>

<script>
    // Get URL parameter function
    function getParameterByName(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Add click event listener to the "Try Again" button
    document.getElementById('tryAgainButton').addEventListener('click', function() {
        // Get the 'url' parameter value from the URL
        const urlParam = getParameterByName('url');

        // Check if the 'url' parameter is present
        if (urlParam) {
            // Redirect to the specified URL
            window.location.href = urlParam;
        } else {
            // If 'url' parameter is not present, you can specify a default URL or handle accordingly
            alert('URL parameter not found.');
        }
    });
</script>

</body>
</html>
