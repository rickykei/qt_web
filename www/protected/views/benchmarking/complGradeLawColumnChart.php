<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Law & Regulation');
		data.addColumn('number', 'Number of critical findings');
		data.addRows(<?=sizeof($chartData) ?>);

		<? 
			$i = 0;
			foreach ($chartData as $data) {
				$law = $data->law;
				$cnt = $data->cnt;
				?>
				data.setValue(<?=$i ?>, 0, "<?=str_replace('"', '\\"',$law) ?>");
				data.setValue(<?=$i ?>, 1, <?=$cnt ?>);
		<? $i++;} ?>

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, {width: 650, height: 600, title: 'Critical findings in relation to Law & Regulations',
		                  hAxis: {title: 'Law & Regulation'},
		                  vAxis: {title: 'No. of critical finding'}
		                 });
	}
</script>

<div id="chart_div"></div>