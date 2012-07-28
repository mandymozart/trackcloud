// Custom example logic
$(function() {
    var uploader = new plupload.Uploader({
        runtimes : 'html5,html4',
        browse_button : 'pickfiles',
        container : 'uploadView',
        max_file_size : '10mb',
        url : 'application/helper.upload.json.php',
        filters : [
            {title : "Wav files", extensions : "wav"},
            {title : "Zip files", extensions : "zip"},
            {title : "Image files", extensions: "jpg,gif,png"}
        ],
        resize : {width : 320, height : 240, quality : 90}
    });

    uploader.bind('Init', function(up, params) {
        $('#debugger').append(" > upload: runtime: " + params.runtime);
        $('#walkThroughBody').html('<span class="icon-plus"></span> Select some files from your harddrive first.'); // add Walk-Through text
    });

    $('#uploadfiles').click(function(e) {
        $('#debugger').append(' > upload: start');
        $('#uploadfiles').addClass('disabled');
        e.preventDefault();
        uploader.start();
    });

    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
        $('#uploadfiles').removeClass('disabled');
        $('#walkThroughBody').html('Now, you can add more file or start uploading your queue.'); // add Walk-Through text
        $.each(files, function(i, file) {
            $('#debugger').append(' > upload: queued (' + file.name + ')');
            $('#uploadList').append(
                '<div id="' + file.id + '">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
        });

        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('UploadProgress', function(up, file) {
        $('#walkThroughBody').html('Wait while uploading (' + file.name + ') ... '); // add Walk-Through text
        $('#' + file.id + " b").html(file.percent + "%");
    });

    uploader.bind('Error', function(up, err) {
        $('#walkThroughBody').html('Check for errors.'); // add Walk-Through text
        $('#uploadList').append("<div>Error: " + err.code +
            ", Message: " + err.message +
            (err.file ? ", File: " + err.file.name : "") +
            "</div>"
        );

        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file) {
        $('#' + file.id + " b").html("100%");
    });
});
