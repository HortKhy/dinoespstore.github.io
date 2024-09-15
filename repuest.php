<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script
        src="https://github.com/davidhuotkeo/bakong-khqr/releases/download/bakong-khqr-1.0.6/khqr-1.0.6.min.js"></script>
</head>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const { BakongKHQR, khqrData, MerchantInfo } = window.BakongKHQR;

            const merchantInfo = {
                bakongAccountID: "sotheasok@aclb",
                merchantName: "KHTOPUP",
                merchantCity: "Phnom Penh",
                merchantId: "007168",
                acquiringBank: "Bakong Bank",
            };

            // Get amount and user from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const amount = parseFloat(urlParams.get('amount')) || 0.1; // default value if not provided
            const user = urlParams.get('userid') || 'defaultUser'; // default value if not provided
            const zoneid = urlParams.get('zoneid') || 'defaultUser';

            const optionalData = {
                currency: khqrData.currency.usd,
                amount: amount,
                mobileNumber: "85515412754",
                billNumber: generateBillNumber(),
                storeLabel: "khtopup",
                terminalLabel: "012345",
            };

            function generateBillNumber() {
                return "khqr" + new Date().toISOString().replace(/[-:.TZ]/g, "");
            }

            const merchantInfoInstance = new MerchantInfo(
                merchantInfo.bakongAccountID,
                merchantInfo.merchantName,
                merchantInfo.merchantCity,
                merchantInfo.merchantId,
                merchantInfo.acquiringBank,
                optionalData
            );

            const khqr = new BakongKHQR();
            const response = khqr.generateMerchant(merchantInfoInstance);

            // Redirect to the specified URL with md5, amount, and user
            const redirectUrl = `/qr/save.php?md5=${response.data.md5}&amount=${amount}&qr=${response.data.qr}&userid=${user}&zoneid=${zoneid}&transaction=${optionalData.billNumber}`;
            window.location.href = redirectUrl;
        });
    </script>
</body>

</html>