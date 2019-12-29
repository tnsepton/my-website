<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Email Send Test</title>
</head>

<body>
	
	<?php $time = time(); echo($time); 
	if($time > 1556516840) {
		$msg = "Hey fix me!";
		mail("thomas.septon@gmail.com","Fix Me",$msg);
	} ?>
	<p>This is simply a test to send an email from the server.</p>
	
</body>
</html>