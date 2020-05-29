<?php


        
    //Recepient Email Address
    $to_email       = "vonrashey@gmail.com";

    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }

    //Sanitize input data using PHP filter_var().
    $full_name       = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
    $email           = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject         = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
	$msg             = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
   
     
    //Textbox Validation 
    if(strlen($first_name)<4){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty!'));
        die($output);
    }
    
 

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Full Name:</strong> </td><td>" . strip_tags($_POST['full_name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email Address :</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
	 $message .= "<tr><td><strong>Message :</strong> </td><td>" . strip_tags($_POST['msg']) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";
       
    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From:Fromname <info@fromemail.com>" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body .= "--" . $separator . $eol;
    $body .= "Content-type:text/html; charset=utf-8\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . $eol;


        
        $eol = "\r\n";
        
        $headers = "From: Fromname <info@fromemail.com>" . $eol;
        $headers .= "Reply-To: ". strip_tags($email_address) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body .= $message . $eol;

    


    $send_mail = mail($to_email, $subject, $body, $headers);
 
    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$first_name .' Thank you for your order, will get back to you shortly'));
        die($output);
    }

?>