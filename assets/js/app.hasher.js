/* Retrieve Hash Tags from URL */

// Writes String post Hashtag to POST['ajax']
hasher = document.location.hash;
hasher = hasher.replace(/^.*#/, '');

$('#debugger').append('> hashtag' + hasher);

$(document).ready( function() {
	$.ajax({ 
		type: 'POST', 
		url: 'application/folder.json.php', 
		data: {ajax:hasher}, 
		dataType: 'json',
		success: function(data) {
			// call for error message from json
			$('#debugger').append(' > received json');
			var template = Handlebars.compile($("#listTemplate").html());			
			$('#folderView').html(template()); 

			$('#debugger').append(' > attached list');
			// interate through returns
			var template = Handlebars.compile($("#itemTemplate").html());
			var i = 0;
		       	var track = new Object();
			$.each (data, function(key,val){
				$.each (val, function (k,v) {
					track[k] = v;
				});
				i++;
				$('#tracksList').append(template(track));				
				$('#debugger').append(' > attached track ' + i);
			});
			$('#debugger').append(' > converted ' + i + ' json tracks');

            // enable Links
            $('.track > a').click( function(){
                var template = Handlebars.compile($("#playerTemplate").html());
                Handlebars.registerPartial("header", $("#headerPartial").html());
                Handlebars.registerPartial("audio", $("#audioPartial").html());
                Handlebars.registerPartial("waveform", $("#waveformPartial").html());
                Handlebars.registerPartial("download", $("#downloadPartial").html());
                var file = $(this).attr('rel');
                $('#debugger').append(' > showplayer ' + file);
                var file_arr = file.split('/');
                //var a = new Array('trackcloud/..'); // dirty fix for root offset
                //var file_arr = a.concat(file_arr.slice(1));
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


		}	
	}); 
});
