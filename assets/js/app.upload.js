// Custom example logic
function $(id) {
	return document.getElementById(id);	
}


var uploader = new plupload.Uploader({
	runtimes : 'html5,html4',
	browse_button : 'pickfiles',
	container: 'container',
	max_file_size : '10mb',
	url : 'upload.php',
	resize : {width : 320, height : 240, quality : 90},
	flash_swf_url : 'assets/js/plupload.flash.swf',
	silverlight_xap_url : 'assets/js/plupload.silverlight.xap',
	filters : [
		{title : "Image files", extensions : "jpg,gif,png"},
		{title : "Zip files", extensions : "zip"}
	]
});

uploader.bind('Init', function(up, params) {
	$('filelist').innerHTML = "<div>Current runtime: " + params.runtime + "</div>";
});

uploader.bind('FilesAdded', function(up, files) {
	for (var i in files) {
		$('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
	}
});

uploader.bind('UploadProgress', function(up, file) {
	$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});

$('#uploadfiles').onclick = function() {
	uploader.start();
	return false;
};

uploader.init();