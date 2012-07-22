<?php
//
// jQuery File Tree PHP Connector
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 24 March 2008
//
// History:
//
// Modifications by Shalom Salon (14 July 2012):
// - Allowed Filetype array
// 1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
// 1.00 - released (24 March 2008)
//
// Output a list of files for jQuery File Tree
//
// LIBRARIES
require('library/waveform.php');
//
$filetypes = array ('wav','WAV');
$root = '';

$_POST['dir'] = urldecode($_POST['dir']);

if( file_exists($root . $_POST['dir']) ) {
	$files = scandir($root . $_POST['dir']);
	natcasesort($files);
	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
			if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
				echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
			}
		}
		// All files
		foreach( $files as $file ) {
			if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file) ) {
				$ext = preg_replace('/^.*\./', '', $file);
				// display only WAV Files
				if(in_array($ext,$filetypes)){
					echo "<li class=\"\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file);
					// Display Waveform PNG if available
					if ( file_exists ( $_POST['dir'] . substr($file,0,-4) . ".png" )){
						echo "<br /><img src=\"" . htmlentities( substr($_POST['dir'],3) .  substr($file,0,-4) ) . ".png\" class=\"waveform\" />";
					}
					// Trys to create Waveform if possible
					else {	
						$audiosource = $_POST['dir'] . $file;
						$targetfile = substr($audiosource,0,-4).".png";
						drawWaveform($audiosource, $targetfile);
						echo "<br /><img src=\"" . htmlentities( substr($_POST['dir'],3) .  substr($file,0,-4) ) . ".png\" class=\"waveform\" />";
					}
					echo "</a></li>";
				}
			}
		}
		echo "</ul>";	
	}
}

?>
