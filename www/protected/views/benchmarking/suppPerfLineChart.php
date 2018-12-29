<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		
		// Create the data table.
		var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');

        <? foreach($cats as $cat) {?>
        	data.addColumn('number', '<?=$cat?>');
        <? }?>
        
        data.addRows(<?=sizeOf($data)?>);

        <?
        $i = 0;
        $startYear = $data;
        foreach($data as $year=>$val) {?>
        	data.setValue(<?=$i ?>, 0, '<?=$year ?>');

        	<? for ($j = 0; $j < sizeOf($cats); $j++) {
        		if (isset($val[$j])) { ?>
        		data.setValue(<?=$i ?>, <?=$j+1 ?>, <?=number_format(round($val[$j]['score']*1.0/$val[$j]['noOfReq'], 1), 1) ?>);
        		<? } else {?>
        			data.setValue(<?=$i ?>, <?=$j+1 ?>, 0);
        	<? }
			} ?>
        	
        <? $i++; }?>

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 1000, height: 220, 
            title: 'Supplier Performance Evaluation',
            vAxis: {title:'Score/Grading'},
        	hAxis: {title:'Year'},
        	chartArea: {width:"50%"}
        });
    }
</script>

<div id="chart_div"></div>
