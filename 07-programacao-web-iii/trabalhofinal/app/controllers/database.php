<?php
function validateTable() {
	if (! isset ( $_SESSION [getVal ( "model" )] )) {
		$_SESSION [getVal ( "model" )] = [ ];
	}
}
function index() {
	validateTable ();
	return $_SESSION [getVal ( "model" )];
}
function create($record) {
	validateTable ();
	$record ["id"] = count ( $_SESSION [getVal ( "model" )] ) + 1;
	array_push ( $_SESSION [getVal ( "model" )], $record );
	return $record ["id"];
}
