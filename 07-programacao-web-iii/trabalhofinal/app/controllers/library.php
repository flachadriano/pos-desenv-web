<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

require "helpers.php";
require "database.php";

require "actions/index.php";
require "actions/create.php";

switch (getVal ( "type" )) {
	case "index" :
		if (getVal ( "metadata" )) {
			gridMetaData ();
		} else {
			indexRecords ();
		}
		break;
	case "create" :
		createRecord ();
		break;
}