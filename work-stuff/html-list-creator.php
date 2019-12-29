<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HTML List Creator</title>
	<script type="text/javascript" src="../jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	
	<button id="copy-button" onclick="copyText()">I'M ALSO A BUTTON!! CLICK ME TO COPY THE TEXT!!!</button>
	
	<textarea id="list-input" placeholder="Paste your list here"></textarea>
	
	<button id="submit-button" onclick="makeList()">I'M A BUTTON!!!! CLICK ME TO MAKE YOUR LIST!!!</button>
	
	<script type="text/javascript">
		
		function makeList() {
			var newList = "<ul>\n";
			var listGiven = $("#list-input").val();
			var newListArray = listGiven.split("\n");
			newListArray = newListArray.filter(v=>v!=='');
			newListArray.forEach(function(line) {
				var firstChar = line.charAt(0);
				var match = firstChar.match(/^[A-Za-z]/);
				while(match == null) {
					line = line.slice(1);
					firstChar = line.charAt(0);
					match = firstChar.match(/^[A-Za-z]/);
				}
				newList += "\t<li>"+line+"</li>\n";
			});
			newList += "</ul>";
			$("#list-input").val(newList);
			$("#copy-button").css("display","block");
		}
		
		function copyText() {
			$("#list-input").select();
			document.execCommand("copy");
		}
		
	</script>
	
</body>
</html>