<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>This is for testing stuff.</title>
<link href="style.css" rel="stylesheet">

	
	
</head>

<body>
	<?php
	$postData = $uploadedFile = $statusMsg = '';
	$msgClass = 'errordiv';
	if(isset($_POST['submit'])){
		// Get the submitted form data
		$postData = $_POST;
		$email = $_POST['email'];
		$name = $_POST['name'];

		// Check whether submitted data is not empty
		if(!empty($email) && !empty($name)){

			// Validate email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$statusMsg = 'Please enter your valid email.';
			}else{
				$uploadStatus = 1;

				// Upload attachment file
				if(!empty($_FILES["attachment"]["name"])){

					// File path config
					$targetDir = "../uploads/"; //$targetDir=/uploads/
					$fileName = basename($_FILES["attachment"]["name"]); //$fileName=map-icon.png
					$targetFilePath = $targetDir . $fileName; //$targetFilePath = /uploads/map-icon.png
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

					// Allow certain file formats
					$allowTypes = array('pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg');
					if(in_array($fileType, $allowTypes)){
						// Upload file to the server
						if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){
							$uploadedFile = $targetFilePath;
						}else{
							$uploadStatus = 0;
							$statusMsg = "Sorry, there was an error uploading your file" . $targetFilePath;
						}
					}else{
						$uploadStatus = 0;
						$statusMsg = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.';
					}
				}

				if($uploadStatus == 1){

					// Recipient
					$toEmail = 'thomas.septon@gmail.com';

					// Sender
					$from = 'noreply@generaltrom.com';
					$fromName = 'GeneralTrom';

					// Subject
					$emailSubject = 'Contact Request Submitted by '.$name;

					// Message 
					$htmlContent = '<h2>Contact Request Submitted</h2>
						<p><b>Name:</b> '.$name.'</p>
						<p><b>Email:</b> '.$email.'</p>';

					// Header for sender info
					$headers = "From: $fromName"." <".$from.">";

					if(!empty($uploadedFile) && file_exists($uploadedFile)){

						// Boundary 
						$semi_rand = md5(time()); 
						$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

						// Headers for attachment 
						$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

						// Multipart boundary 
						$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
						"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

						// Preparing attachment
						if(is_file($uploadedFile)){
							$message .= "--{$mime_boundary}\n";
							$fp =    @fopen($uploadedFile,"rb");
							$data =  @fread($fp,filesize($uploadedFile));
							@fclose($fp);
							$data = chunk_split(base64_encode($data));
							$message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" . 
							"Content-Description: ".basename($uploadedFile)."\n" .
							"Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" . 
							"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
						}

						$message .= "--{$mime_boundary}--";
						$returnpath = "-f" . $email;

						// Send email
						$mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);

						// Delete attachment file from the server
						@unlink($uploadedFile);
						}else{
							 // Set content-type header for sending HTML email
							$headers .= "\r\n". "MIME-Version: 1.0";
							$headers .= "\r\n". "Content-type:text/html;charset=UTF-8";

							// Send email
							$mail = mail($toEmail, $emailSubject, $htmlContent, $headers); 
						}

					// If mail sent
					if($mail){
						$statusMsg = 'Your contact request has been submitted successfully !';
						$msgClass = 'succdiv';

						$postData = '';
					}else{
						$statusMsg = 'Your contact request submission failed, please try again.\n' . $message;
					}
				}
			}
		}else{
			$statusMsg = 'Please fill all the fields.';
		}
	}
	?>
	<!-- Display submission status -->
	<?php if(!empty($statusMsg)){ ?>
		<p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
	<?php } ?>

	<!-- Display contact form -->
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" name="name" class="form-control" value="<?php echo !empty($postData['name'])?$postData['name']:''; ?>" placeholder="Name" required="">
		</div>
		<div class="form-group">
			<input type="email" name="email" class="form-control" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" placeholder="Email address" required="">
		</div>
		<div class="form-group">
			<input type="file" name="attachment" class="form-control">
		</div>
		<div class="submit">
			<input type="submit" name="submit" class="btn" value="SUBMIT">
		</div>
	</form>
	
	
	
</body>
</html>
