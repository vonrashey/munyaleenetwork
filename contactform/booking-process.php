<?php

$errorMSG = "";

// FNAME
if (empty($_POST["fname"])) {
    $errorMSG = "First Name is required ";
} else {
    $fname = $_POST["fname"];
}
// LNAME
if (empty($_POST["lname"])) {
    $errorMSG = "Last Name is required ";
} else {
    $lname = $_POST["lname"];
}

// DATE
if (empty($_POST["date"])) {
    $errorMSG = "Date is required ";
} else {
    $date = $_POST["date"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// SERVICE
if (empty($_POST["service_requested"])) {
    $errorMSG = "Service is required ";
} else {
    $service_requested = $_POST["service_requested"];
}

// TRAVELLERS
if (empty($_POST["number_travellers"])) {
    $errorMSG = "Number of travellers is required ";
} else {
    $number_travellers = $_POST["number_travellers"];
}

// COUNTRY
if (empty($_POST["country"])) {
    $errorMSG = "Country is required ";
} else {
    $country = $_POST["country"];
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


$EmailTo = "vonrashey@gmail.com";
$Subject = "Booking Request from Munyalee Network Website";

// prepare email body text
$Body = "";
$Body .= "First Name: ";
$Body .= $fname;
$Body .= "\n";
$Body .= "Last Name: ";
$Body .= $lname;
$Body .= "\n";
$Body .= "Date: ";
$Body .= $date;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Service Requested: ";
$Body .= $service_requested;
$Body .= "\n";
$Body .= "Number Of Travellers: ";
$Body .= $number_travellers;
$Body .= "\n";
$Body .= "Country: ";
$Body .= $country;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>