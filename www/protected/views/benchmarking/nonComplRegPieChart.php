<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
	function drawChart() {
      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');

      data.addRows(<?=sizeOf($chartData) ?>);

      <?
      $i = 0; 
      foreach ($chartData as $data) {
		$law = $data->law;
      	$cnt = $data->cnt;
      	?>
	      data.setValue(<?=$i?>, 0, "<?=str_replace('"', '\\"', $law)?>");
	      data.setValue(<?=$i?>, 1, <?=$cnt?>);
      <? 
      	$i++;
		} ?>
      
      

      // Set chart options
      var options = {'title':'Ratio % of Non-Compliance Regulation',
                     'width':650,
                     'height':300,
                     'is3D': true};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>

<div id="chart_div"></div>
