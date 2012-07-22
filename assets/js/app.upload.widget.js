// Convert divs to queue widgets when the DOM is ready

$(function() {

	// Setup html5 version
	$("#html5_uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : 'upload.php',
		max_file_size : '10mb',
		chunk_size : '1mb',
		unique_names : true,
		dragdrop : true,
	
		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 90},
	
		// Specify what files to browse for
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		]
	});



	// Setup html4 version
	$("#html4_uploader").pluploadQueue({
		// General settings
		runtimes : 'html4',
		url : 'upload.php'
	});

});