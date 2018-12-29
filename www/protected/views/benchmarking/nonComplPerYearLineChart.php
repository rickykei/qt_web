<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
      // Create the data table.
		var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');

        <? foreach($laws as $law) {?>
        	data.addColumn('number', "<?=str_replace('"', '\\"', $law) ?>");
        <? }?>
        
        data.addRows(<?=sizeOf($data)?>);

        <?
        $i = 0;
        $startYear = $data;
        foreach($data as $year=>$val) {?>
        	data.setValue(<?=$i ?>, 0, '<?=$year ?>');

        	<? for ($j = 0; $j < sizeOf($laws); $j++) {
        		if (isset($val[$j])) { ?>
        		data.setValue(<?=$i ?>, <?=$j+1 ?>, <?=$val[$j] ?>);
        		<? } else {?>
        			data.setValue(<?=$i ?>, <?=$j+1 ?>, 0);
        	<? }
			} ?>
        	
        <? $i++; }?>

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 900, height: 220, 
	title: 'The Monitoring of Non-Conformance',
	vAxis: {title:'Number of non-conformance'},
        	hAxis: {title:'Year'},
        	chartArea: {width:"50%"}
	});
    }
</script>

<div id="chart_div"></div>
