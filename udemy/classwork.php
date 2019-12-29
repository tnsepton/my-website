<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AJAX</title>
	<script type="text/javascript" src="../jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	
	<p id="paragraph"></p>
	
	<script type="text/javascript">
	
		jQuery.ajax("/info.txt")
			.done(function(data) {
				jQuery("#paragraph").html(data);
			})
			.fail(function() {
				alert("Sorry! We failed!");
		});
	
	</script>
	
</body>
</html>