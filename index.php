<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <title>TrackCloud &trade; by Shalom Salon</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Pre-Alpha track collaboration tool">
        <meta name="author" content="Shalom Salon Labs">
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link href="assets/css/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="assets/css/trackcloud.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="assets/css/trackcloud.icons.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="assets/css/trackcloud.player.css" rel="stylesheet" type="text/css" media="screen" />

    </head>
	
	<body>
	
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span6">
                    <div class="well sidebar-nav">
                        <h6>Tracks</h6>
                        <div id="folderView"></div>
                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span6">
                    <div id="headerView">
                        <h1>TrackCloud &trade;</h1>
                        <p>A place to share mixes and request remixes. Select track from Menu and load file info's here. </p>
                    </div>
                    <div id="playerView"></div>
                    <hr />
                    <p><span class="label label-warning">24bit WAV Remarks</span> The native HTML5-Player does not yet support
                    24bit WAV playback. You will have to download them first. Waveforms will be displayed over-saturated.</p>
                </div><!--/span-->
            </div><!--/row-->
            <hr>
            <footer>
                <p>
                    Copyright &copy; <span class="icon-labs"></span> Shalom Salon Labs 2012 / <a data-toggle="modal" href="#modalAbout">About</a>
                </p>
                <hr/>
                <div>
                    <span class="label label-info"> Developer Tools</span> -
                    <a data-toggle="modal" href="#modalTree">Filebrowser</a> /
                    <a data-toggle="modal" href="#modalUpload">Upload</a> /
                    <a data-toggle="modal" href="#modalDebugger">Debugging Console</a>
                </div>
            </footer>

        </div><!--/.fluid-container-->

        <!-- Modals -->

            <!-- FileTree -->
        <div class="modal hide" id="modalTree">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Filebrowser</h3>
            </div>
            <div class="modal-body">
                <p>Browser through all available files and folders! <span class="label label-warning"> For debugging only! </span></p>
                <div id="treeView" class="demo"></div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
        </div>

            <!-- Upload -->
        <div class="modal hide" id="modalUpload">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Upload <span class="label label-important"> Disabled! </span></h3>
            </div>
            <div class="modal-body">
                <p>Select up to 8 files for upload. <span class="label label-warning"> WAV format only </span> </p>
                <div id="uploadView"></div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Start Upload</a>
            </div>
        </div>

            <!-- About -->
        <div class="modal hide" id="modalAbout">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>About TrackCloud &trade; <span class="label label-notice"> pre-alpha! </span></h3>
            </div>
            <div class="modal-body">
                <h4>What's the intend of the Labs?</h4>
                <p>
                    This application is a development of Shalom Salon Labs, as part of the Shalom Salon Network.
                    It is based on the needs of the terms of business of a net-label, that supports both,
                    production and publication of audio (and other media). Shalom Salon Labs is not giving any rights to
                    duplicate or use any of the development efforts. Our intend is purely to capitalize on inventions of
                    the lab, to keep our publication interest a float with the necessary support to our artists. These
                    considerations come from the unavailability of a free music culture that will actually reinvest in
                    it's contribution. Please, we are not asking for donations, but the acknowledgement of projects like
                    this.<br />
                    <br />
                    Get involved into our software projects, become a member of the editorial staff or submit your content
                    in existing remix projects, compilations, events, or
                    even individual releases through one of our representatives.<br /><br />
                    We beliefe there is even a formula behind the existence of god!
                </p>
                <h4>Current Demand</h4>
                <p>If you anticipate with our development, we highly motive you to join our team at this early stage.</p>
                <ul>
                    <li>Backend-Developer (Codeigniter, PHP, Java, Github)</li>
                    <li>Frontend-Developer (jQuery, HTML5, Github)</li>
                    <li>Interface Designer</li>
                    <li>Administrator (Blogspot, Wordpress)</li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
        </div>

        <!-- About -->
        <div class="modal hide" id="modalDebugger">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Debugging Console</h3>
            </div>
            <div class="modal-body">
                <span class="label label-inverse"> Debugger </span>
                <br>
                <pre class="prettyprint linenums" id="debugger"></pre>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
        </div>

        <!-- Templates/Handlebars/Mustache -->
        <script id="listTemplate" type="text/x-handlebars-template">
            <table class="table" id="tracksList">
            </table>
        </script>

        <script id="itemTemplate" type="text/x-handlebars-template">
            <tr>
                <td>
                    <div class="track">
                        <a rel="{{filepath}}" class="track-link"><img src="{{waveform}}" class="trk-waveform" /></a>
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
            <hr/>
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
            Share it! <a href="{{file.path}}" class="btn btn-primary">​Copy Link​</a>​
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

