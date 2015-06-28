<?php
$dir = "resources/";
$first_file = true;

echo "resources:[";

if ($handle = opendir ( $dir )) {
	while ( false !== ($filename = readdir ( $handle )) ) {
		if ($filename !== "." && $filename !== "..") {
			if ($first_file) {
				$first_file = false;
			} else {
				echo ",";
			}
			
			echo file_get_contents ( $dir . $filename );
		}
	}
	closedir ( $handle );
}

echo "]";