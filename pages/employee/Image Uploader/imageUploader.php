<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous"></script>
  	<link type="text/css" href="imageUploader.css" rel="stylesheet">
</head>
<body>
	<div class="uploader" onclick="$('#filePhoto').click()">
    click here or drag here your images for preview and set userprofile_picture data
    <img id="uplaodImage" src=""/>
    <input type="file" name="userprofile_picture"  id="filePhoto" />
</div>
</body>
	<script src="imageUploader.js"></script>
</html>