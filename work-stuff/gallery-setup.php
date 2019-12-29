<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gallery Setup</title>
	<script type="text/javascript" src="../jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	
	<div id="gallery-instructions">
		<p class="center">IMPORTANT INSTRUCTIONS!</p>
		<p class="center">Not that important, just makes your life easier.</p>
		<p class="center">Place all images for the gallery in the same folder. Select all of them, right click any of them, and click rename. Type whatever name you want them all to share (e.g. gallery). Then hit enter. You should see that all the selected images got renamed gallery (1).jpg, gallery (2).jpg and so forth. That is good, because now you can just upload them all to Wordpress and Wordpress will automatically change that name to gallery-1.jpg, gallery-2.jpg and so on. This is how my code will output.</p>
		<p class="center">
			<button id="hide-instructions" onClick="$('#gallery-instructions').css('display','none');">OKIE DOKIE!</button>
		</p>
	</div>
	
	<div class="input-fields">
		<label for="file-name">Input the file name of the images excluding number and filetype. (e.g. 'gallery (1).jpg' would simply be 'gallery')</label>
		<input type="text" id="file-name">

		<label for="file-type">Input the file type. (e.g. jpg or png)</label>
		<input type="text" id="file-type">

		<label for="num-columns">Input the number of columns you would like displayed. (entering 2 would output col-md-6)</label>
		<input type="text" id="num-columns">

		<label for="num-images">Input the total number of images.</label>
		<input type="text" id="num-images">
		
		<button id="gallery-submit-button" onClick="createGallery()">OOOHHHH LOOK AT ME!! CLICK ME!!! To create your gallery of course...</button>
	</div>
	
	<div class="output">
		<textarea id="gallery-output"></textarea>
		<p class="center">
			<button id="gallery-copy-button" onclick="copyText()">OH HEY!! If you want to copy the text above... CLICK ME!!</button>
		</p>
	</div>
	
	<script type="text/javascript">
		
		function createGallery() {
			var newGallery = "<div class='row'>\n";
			var fileName = $("#file-name").val();
			var fileType = $("#file-type").val();
			fileType = fileType.replace(".","");
			var yearMonth = getDateString();
			var filePath = "/wp-content/uploads/" + yearMonth + "/" + fileName;
			var numColumns = 12 / $("#num-columns").val();
			var numImages = $("#num-images").val();
			var num = 1;
			
			if(numImages != "") {
				while(num <= numImages) {
					newGallery += 
						"\t<div class='col-md-" + numColumns + "'>\n" +
						"\t\t<img class='aligncenter' src='" + filePath + "-" + num + "." + fileType + "'>\n" +
						"\t</div>\n";
					num++;
				}
			}
			
			newGallery += "</div>";
			
			$("#gallery-output").val(newGallery);
			
		}
		
		function copyText() {
			$("#gallery-output").select();
			document.execCommand("copy");
		}
		
		function getDateString() {
			var yearMonth = "";
			var date = new Date();
			var month = date.getMonth();
			var year = date.getYear() + 1900;
			year = year.toString();
			switch(month) {
				case 0:
					month = "01";
					break;
				case 1:
					month = "02";
					break;
				case 2:
					month = "03";
					break;
				case 3:
					month = "04";
					break;
				case 4:
					month = "05";
					break;
				case 5:
					month = "06";
					break;
				case 6:
					month = "07";
					break;
				case 7:
					month = "08";
					break;
				case 8:
					month = "09";
					break;
				case 9:
					month = "10";
					break;
				case 10:
					month = "11";
					break;
				case 11:
					month = "12";
					break;
			}
			yearMonth = year + "/" + month;
			
			return yearMonth;
		}
		
	</script>
	
</body>
</html>















































