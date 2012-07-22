/* Retrieve Hash Tags from URL */

// Writes String post Hashtag to POST['ajax']
hasher = document.location.hash;
hasher = hasher.replace(/^.*#/, '');

alert (hasher);

// $('#treeView').hide();

$(document).ready( function() {
	$.ajax({ 
		type: 'POST', 
		url: 'application/folder.json.php', 
		data: {ajax:hasher}, 
		dataType: 'json',
		success: function(data) {
			// call for error message from json
			$('#debugger').append('> received json');			
			var template = Handlebars.compile($("#listTemplate").html());			
			$('#folderView').html(template()); 

			$('#debugger').append('> attached list');
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
				$('#debugger').append('> attached track ' + i);
			});
			$('#debugger').html('converted ' + i + ' json tracks');
 
		}	
	}); 
});
