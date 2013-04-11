<?php

if (isset($_POST['subject']) && !empty($_POST['subject'])) {
	result = array(
		"status" => "error",
		"msg" => "robot"
	);
	echo json_encode(result);
	exit 0;
}

if(isset($_POST['email']) && empty($_POST['email'])) {
	result = array(
		"status" => "error",
		"msg" => "email"
	);
	echo json_encode(result);
	exit 0;
}
	
 {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "chris@chrisobriendesign.com";
    $email_subject = "Website Contact Form";
	/*

    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $phone = $_POST['phone']; 
    $message = $_POST['message'];
*/
		$name = "Rodrigo"; 
    $email = "fake@mail.com"; 
    $phone = "222-222-2222"; 
    $message = "Damit, Rodrigo is always Right!!!!!";
	
    $email_message = "This email was generated from the contact from at your website:\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
     
     
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
if(mail($email_to, $email_subject, $email_message, $headers)){ 
	result = array(
		"status" => "success",
		"url" => "email"
	);
	echo json_encode(result);
	exit 0;
} else {
	echo "Error";
}
?>
