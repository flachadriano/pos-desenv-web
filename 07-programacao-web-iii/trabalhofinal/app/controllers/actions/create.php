<?php
function createRecord() {
	$errors = array ();
	$model = loadModel ();
	$record = array ();
	
	foreach ( $model as $field ) {
		if ($field->null == "false" && getVal ( $field->name ) == "") {
			$errors [$field->label] = "Deve ser preenchido";
		} else {
			$record [$field->name] = getVal ( $field->name );
		}
	}
	
	if (count ( $errors ) == 0) {
		echo json_encode ( array (
				"success" => true,
				"url" => "list.html",
				"id" => create ( $record ) 
		) );
	} else {
		echo json_encode ( array (
				"success" => false,
				"errors" => $errors 
		) );
	}
}