<?php
	
	####### BEGIN Test if "subject" is empty, and if so, return error #######
	if (isset($_POST['subject']) AND !empty($_POST['subject'])) {
		echo json_encode( array(
			'status' 		=> 'error',
			'error_type'	=> 'robot'
		)); 
		return 0;
	}
	####### END Test if "subject" is empty, and if so, return error #######




	####### BEGIN Validate empty fields #######
	$empty_fields = array();
	foreach ($_POST as $key => $value) {
		if ( $key != 'subject') {
			if (empty($value)) {
				array_push($empty_fields, $key);
			}
		}
	}

	if (count($empty_fields)) {
		echo json_encode( array(
			'status' 		=> 'error',
			'error_type'	=> 'empty_field',
			'fields'		=> $empty_fields
		)); 
		return 0;
	}
	####### END Validate empty fields #######


	####### BEGIN Email #######

	// Clean up function
	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
    }

	// $email_to = "chris@chrisobriendesign.com";
	$email_to = "rpassos@20miletech.com";
    $email_subject = "Website Contact Form";

	$name = $_POST['name']; 
	$email = $_POST['email']; 
	$phone = $_POST['phone']; 
	$message = $_POST['message'];

	// Begining of the message
	$email_message = "This email was generated from the contact from at your website:\n\n";

	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email)."\n";
	$email_message .= "Phone: ".clean_string($phone)."\n";
	$email_message .= "Message: ".clean_string($message)."\n";
     
	// create email headers
	$headers = 'From: '.$email."\r\n".
			   'Reply-To: '.$email."\r\n" .
			   'X-Mailer: PHP/' . phpversion();

    // Try sending the email
	if( mail( $email_to, $email_subject, $email_message, $headers ) ) { 
		// Email sent successfully
		echo json_encode(array(
			'status'		=> 'success'
		));
	} else {
		echo json_encode(array(
			'status'		=> 'error',
			'error_type'	=> 'send_email_error'
		));
	}

	return 0;
?>
