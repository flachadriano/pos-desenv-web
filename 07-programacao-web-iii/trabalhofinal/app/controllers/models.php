<?php
header('Contente-type: application/json, charset:utf-8');

$dir = "../models/";
$first_file = true;

echo "[";

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