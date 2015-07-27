$(document).ready(
		function() {
			$($('input[name$="categories"]').first()).inputosaurus({
				width 				: '350px',
				autoCompleteSource 	: ['alabama', 'illinois', 'kansas', 'kentucky', 'new york'],
				activateFinalResult : true
			});
		}
);