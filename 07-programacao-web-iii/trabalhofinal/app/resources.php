<?php
$result = "";
$dir = "resources/";

if ($handle = opendir ( $dir )) {
	while ( false !== ($filename = readdir ( $handle )) ) {
		if ($filename == "." && $filename = "..") {
			continue;
		}
		
		echo $filename;
		echo file_get_contents ( $dir . $filename );
	}
	closedir ( $handle );
}

echo $result;