<html>
<head>
	<meta charset="UTF-8">
	<title>Image Upload</title>
	<script type="text/javascript" src="/sys/plugins/tinymce/plugins/imageupload/upload.js"></script>
	<script type="text/javascript">
	window.parent.window.ImageUpload.uploadSuccess({
            code : '<?php echo $fileName; ?>'
	});
	</script>
	<style type="text/css">
		img {
			max-height: 240px;
			max-width: 320px;
		}
	</style>
</head>
<body>
	<img src="<?php echo $fileName ?>">
</body>
</html>