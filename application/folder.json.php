<?php
// // 
// Return JSON Object
// for debuggin uncomment
error_reporting(-1);
// LIBRARIES
require('library/waveform.php');
require('library/getid3/getid3.php');

//
$filetypes = array ('wav','WAV');
$filesArr = array(); // 

$root = "../root/";

//$dir = "mandymozart/fulltracks/featjiinep/";
$dir = urldecode($_POST['ajax']);

// getID3 Initializing Class
$getID3 = new getID3;

if( file_exists($root . $dir) ) {
	$files = scandir($root . $dir);
	natcasesort($files);
	if( count($files) > 2 ) { // The 2 accounts for . and ..
		// All files
		foreach( $files as $file ) {
			$ext = preg_replace('/^.*\./', '', $file);
			if( file_exists($root . $dir . $file) && $file != '.' && $file != '..' && !is_dir($root . $dir . $file) ) {
				$ext = preg_replace('/^.*\./', '', $file);
				// display only WAV Files
				if(in_array($ext,$filetypes)){
					// Create Waveform if non existing
					if ( !file_exists ( $root . $dir . substr($file,0,-4) . ".png" )){
						$audiosource = $root . $dir . $file;
						$targetfile = substr($audiosource,0,-4).".png";
						//drawWaveform($audiosource, $targetfile);
					}
					$waveinfo = $getID3->analyze($root . $dir . $file);
					getid3_lib::CopyTagsToComments($waveinfo);
					// Add Element to Array 
					$filesArr[] = array(
						'hasher' => $dir,
						'filename' => $file,
						'filepath' => 'root/'.$dir.$file,
						'waveform' => 'root/'.$dir.substr($file,0,-4) . '.png',
						'bitmode' => $waveinfo['audio']['bits_per_sample'],
						'playtime' => $waveinfo['playtime_string']); 
				}
			}		
		}
	}
	echo json_encode($filesArr);
}
?>
