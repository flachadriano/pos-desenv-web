<?php
function getVal($attr) {
	if (isset ( $_GET [$attr] )) {
		return trim ( strip_tags ( $_GET [$attr] ) );
	} else if (isset ( $_POST [$attr] )) {
		return trim ( strip_tags ( $_POST [$attr] ) );
	} else {
		return null;
	}
}
function loadModel() {
	return loadJson ( "../schema/models/" . getVal ( "model" ) . ".json" );
}
function loadGridMetadata() {
	return loadJson ( "../schema/grid/" . getVal ( "model" ) . ".json" );
}
function loadJson($path) {
	return json_decode ( file_get_contents ( $path ) );
}