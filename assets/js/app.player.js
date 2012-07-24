/* Trackloud.App.Player */


$('#folderView').ready( function() {
    // displayPlayer on Click
    $('.track > a').click( function(){
        alert ('huhu');
        var file = $(this).attr('rel').match( /.*\// );
        var template = Handlebars.compile($("#playerTemplate").html());
        Handlebars.registerPartial("header", $("#headerPartial").html());
        Handlebars.registerPartial("audio", $("#audioPartial").html());
        Handlebars.registerPartial("waveform", $("#waveformPartial").html());
        Handlebars.registerPartial("download", $("#downloadPartial").html());
        var file_arr = file.split('/');
        var a = new Array('trackcloud/..'); // dirty fix for root offset
        var file_arr = a.concat(file_arr.slice(1));
        var path = file_arr.join('/');
        var output = path.substr(0, path.lastIndexOf('.')) || path;
        var waveform = output + ".png";
        var data = {
            file: {
                "path": path,
                "name": file_arr.pop(),
                "waveform": waveform },
            audio: true
        };

        $('#playerView').html(template(data));
        /* Player */
        var settings = {
            progressbarWidth: '100%',
            progressbarHeight: '50px',
            progressbarColor: '#000',
            progressbarBGColor: '#eeeeee',
            defaultVolume: 0.8
        };
        $('.player').player(settings);
    });
});
