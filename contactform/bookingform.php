<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$name = $fname." ".$lname;
$date = $_POST['date'];
$email = $_POST['email'];
$service_requested = $_POST['service_requested'];
$number_travellers = $_POST['number_travellers'];
$country = $_POST['country'];
$message = $_POST['message'];
$toEmail = "info@munyaleenetwork,musney2012@gmail.com";
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$showMessage = '';
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {	
	$subject = "New Booking from Munyalee Network Website";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();	
	$message = 'Hello,<br/>'
	. 'Name:' . $name . '<br/>'	
	. 'Message:' . $message. '<br/><br/>';		
	mail($toEmail, $subject, $message, $headers);
	$showMessage = "Your message has been received, We will contact you soon.";	
		header("Refresh:10; url=http://www.munyaleenetwork.co.zw/");
	
} else {
	$showMessage =  "Something went wrong. Please try again";
	header("Refresh:10; url=http://www.munyaleenetwork.co.zw/");
}
$jsonData = array(
	"message"	=> $showMessage
);
echo json_encode($jsonData); 
?>