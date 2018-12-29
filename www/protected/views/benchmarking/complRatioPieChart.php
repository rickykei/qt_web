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
      var data;

      <?
      $i = 0;
      foreach ($chartData as $data) {
      	//$catName = $data->cat_name;
      	//$complCnt = $data->compl_cnt;
      	//$nonComplCnt = $data->non_compl_cnt;
      	$catName = $data['cat_name'];
      	$noOfReq = $data['noOfReq'];
      	$fail = $data['fail'];
      	
      ?>
	      data = new google.visualization.DataTable();
	      data.addColumn('string', 'Topping');
	      data.addColumn('number', 'Slices');
	
	      data.addRows(2);

	      data.setValue(0, 0, "Pass");
	      data.setValue(0, 1, <?=$noOfReq - $fail?>);
	      data.setValue(1, 0, "Fail");
	      data.setValue(1, 1, <?=$fail?>);

	      // Set chart options
	      var options = {'title':"<?=str_replace('"', '\\"', $catName)?>",
	                     'width':300,
	                     'height':300,
	                     'is3D': true};

	      // Instantiate and draw our chart, passing in some options.
	      var chart = new google.visualization.PieChart(document.getElementById('chart_div_<?=$i ?>'));
	      chart.draw(data, options);
      <? 
      	$i++;
		} ?>
    }
</script>

<? for ($i = 0; $i < sizeOf($chartData); $i+=2) {?>
<div>
<span id="chart_div_<?=$i ?>"></span>
<span id="chart_div_<?=$i+1 ?>"></span>
</div>
<? }?>

