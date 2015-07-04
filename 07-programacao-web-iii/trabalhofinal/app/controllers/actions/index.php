<?php
function gridMetaData() {
	echo json_encode ( loadGridMetadata () );
}
function indexRecords() {
	echo json_encode ( index () );
}