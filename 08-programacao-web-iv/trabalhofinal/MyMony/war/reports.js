google.load("visualization", "1", {
	packages : [ "corechart" ]
});
google.setOnLoadCallback(drawChart);
google.setOnLoadCallback(drawPieChart);

function drawChart() {
	var data = google.visualization.arrayToDataTable(JSON.parse(document
			.getElementById('data').value));

	var options = {
		title : 'Transações',
		hAxis : {
			title : 'Data',
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

function drawPieChart() {

	var data = google.visualization.arrayToDataTable(JSON.parse(document
			.getElementById('dataByCategory').value));

	var options = {
		title : 'Totais por categoria'
	};

	var chart = new google.visualization.PieChart(document
			.getElementById('piechartdiv'));

	chart.draw(data, options);
}