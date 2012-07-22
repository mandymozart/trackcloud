<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>TrackCloud &trade; by Shalom Salon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="assets/css/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="assets/css/trackcloud.css" rel="stylesheet" type="text/css" media="screen" />
		
	<script type="text/javascript">
		
	</script>

	</head>
	
	<body>
	
<div class="container-fluid">
      <div class="row-fluid">
        <div class="span6">
          <div class="well sidebar-nav">
            <h6>Available Mix&amp;Remix-Packages</h6>
		<div id="folderView"></div>
		<div id="debugger"></div>
        	<div id="treeView" class="demo"></div>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span6">
          <div id="headerView">
            <h1>TrackCloud &trade;</h1>
	    <p>A place to share mixes and request remixes. Select track from Menu and load file infos here. </p>
	  </div>
	  <div id="playerView">
	  
	  </div>
	  <hr />
	  <span class="label label-warning">24bit WAV Remarks</span> The native HTML5-Player does not yet support 24bit WAV playback. You will have to download them first. Waveforms will be displayed oversaturated. 
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Shalom Salon Labs 2012 / <a href="upload/">Upload</a> / <a href="http://www.shalomsalon.de">Back to the project page</a></p>
      </footer>

    </div><!--/.fluid-container-->

<!-- Templates/Handlebars/Mustache -->
<script id="listTemplate" type="text/x-handlebars-template">
	<table class="table" id="tracksList">
	</table>
</script>

<script id="itemTemplate" type="text/x-handlebars-template">
	<tr>
		<td>
			<div class="track">
				<a href="#{{hasher}}" rel="{{filepath}}" class="track-link"><img src="{{waveform}}" class="trk-waveform" /></a>
				<div class="waveform-label">{{filename}} ({{bitmode}}Bit - {{playtime}})</div>
			</div>	
		</td>
	</tr>
</script>

<script id="playerTemplate" type="text/x-handlebars-template">
	{{> header}}
	{{#audio}}
		{{> waveform}}
		{{> audio}}
	{{/audio}}
	{{> download}}
</script>

<script id="headerPartial" type="text/x-handlebars-template">
	<h4><span class="icon-music"></span> {{file.name}}</h4>
</script>

<script id="audioPartial" type="text/x-handlebars-template">
	<audio src="{{file.path}}" class="player">
	Your browser does not support the audio tag.
	SWF Player Object can be added as fallback.
	</audio>
</script>

<script id="waveformPartial" type="text/x-handlebars-template">
	<img src="{{file.waveform}}" class="waveform" />
</script>

<script id="downloadPartial" type="text/x-handlebars-template">
	<p><a class="btn btn-primary" href="{{file.path}}" target="_blank">Download</a></p>
</script>

	<script src="assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="assets/js/jqueryFileTree.js" type="text/javascript"></script>
	<script src="assets/js/jquery.simpleplayer.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/handlebars-1.0.0.js" type="text/javascript"></script>
	<script src="assets/js/mustache.js" type="text/javascript"></script>
	<script src="assets/js/app.js" type="text/javascript"></script>
	<script src="assets/js/app.hasher.js" type="text/javascript"></script>
	<script src="assets/js/app.filetree.js" type="text/javascript"></script>
	<script src="assets/js/app.player.js" type="text/javascript"></script>
</body>
	
</html>

