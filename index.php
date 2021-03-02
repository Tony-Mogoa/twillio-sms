<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;
$messageID = "";
// Find your Account Sid and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = "ACda0b7d4a21547992edea6907d34d4c41";
$token = "c9dc0eb0e78acb22c29ed512ef6549d2";

if(isset($_POST['send'])){
    if($_POST['phone-no'] != "" && $_POST['message'] != ""){
        $twilio = new Client($sid, $token);
    
        $message = $twilio->messages
                        ->create("+254" . $_POST['phone-no'], // to
                                ["body" => $_POST['message'], "from" => "+13523296661"]
                        );
    
        $messageID = $message->sid;
    }
}
?>
<html>

<head>
    <title>Twilio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</head>

<body class="w-100 h-100">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <div class="border rounded p-5">
            <h3 class="mb-5">Send Messages with Twilio</h3>
            <form method="post">
                <label for="phone" class="form-label">Enter phone number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+254</span>
                    <input type="tel" class="form-control" id="phone" placeholder="700000000" aria-label="Username"
                        aria-describedby="basic-addon1" name="phone-no" value="708502805" required />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Enter message here</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Type message here..." name="message" required></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success" name="send">Send</button>
                    <span class="text-center" <?echo $messageID=="" ? "hidden" : "" ?>>
                        Message ID
                    </span>
                    <span class="text-center" <?echo $messageID=="" ? "hidden" : "" ?>>
                        <?echo $messageID?>
                    </span>
                </div>

            </form>
        </div>
    </div>

</body>

</html>