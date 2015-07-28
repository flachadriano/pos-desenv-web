google.load("visualization", "1", {
	packages : [ "corechart" ]
});
google.setOnLoadCallback(drawChart);

function drawChart() {
	var data = google.visualization.arrayToDataTable([]);

	var options = {
		title : 'Transações',
		hAxis : {
			title : 'Year',
			titleTextStyle : {
				color : '#333'
			}
		},
		vAxis : {
			minValue : 0
		}
	};

	var chart = new google.visualization.AreaChart(document
			.getElementById('chartdiv'));
	chart.draw(data, options);
}