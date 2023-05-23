<?php

require_once('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();

if( $_POST['name'] != '' AND $_POST['email'] != '' AND $_POST['message'] != '' ) { 
		
	$recipientemail = "jmallo@done.studio"; // Your Email Address
	$recipientname = "Joaquín Mallo"; // Your Name
	
	$name = stripslashes($_POST['name']);
	$email = trim($_POST['email']);
	$message = stripslashes($_POST['message']);
	$subject = stripslashes($_POST['subject']);
	$check = $_POST['form-check'];
			
	$custom = $_POST['fields'];
	$custom = explode(',', $custom);
	
	$message_addition = '';
	foreach ($custom as $c) {
		if ($c !== 'name' && $c !== 'email' && $c !== 'message' && $c !== 'subject') {
			$message_addition .= '<b>'.$c.'</b>: '.$_POST[$c].'<br />';
		}
	}
	
	if ($message_addition !== '') {
		$message = $message.'<br /><br />'.$message_addition;
	}
	
	if ($check == '') {
	
		$mail->SetFrom( $email , $name );
		$mail->AddReplyTo( $email , $name );
		$mail->AddAddress( $recipientemail , $recipientname );
		$mail->Subject = $subject;
		
		$mail->MsgHTML( $message );
		$sendEmail = $mail->Send();
		
		if( $sendEmail == true ) {
			echo '	<div class="alert-confirm">
						<p>Tu mensaje ha sido enviado</p>
					</div>';
		} else {
			echo '	<div class="alert-error">
						<p>Tu mensaje no ha podido ser enviado debido a un error inesperado</p>
						<p>Reason: ' . $mail->ErrorInfo . '</p>
					</div>';
		}
	
	}
			
}
?>