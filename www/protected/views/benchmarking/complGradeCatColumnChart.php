<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Compliance Criteria');
		data.addColumn('number', 'Number');
		data.addRows(<?=sizeof($chartData) ?>);

		<? 
			$i = 0;
			foreach ($chartData as $data) {
				$catName = $data['cat_name'];
				$score = number_format(round($data['score'] * 1.0 / $data['noOfReq'], 1), 1);
			?>
				data.setValue(<?=$i ?>, 0, "<?=str_replace('"', '\\"', $catName) ?>");
				data.setValue(<?=$i ?>, 1, <?=$score ?>);
		<? $i++;} ?>

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, {width: 650, height: 500, title: 'Compliance grading for entire supplier chain',
		                  hAxis: {title: 'Compliance Criteria'},
		                  vAxis: {title: 'Average Score'}
		                 });
	}
</script>

<div id="chart_div"></div>