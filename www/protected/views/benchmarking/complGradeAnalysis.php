<div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/benchmarking_logo.png'); ?></div>
	
	<div id="rightcol">
		<ul>
			<li class="row">
				<div class="rowpic">
					<a href="<?=Yii::app()->request->baseUrl.'/benchmarking/complGradeLaw' ?>"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/bar_chart_logo.png', "Create Check List", array("width"=>"80")); ?></a>
				</div>
				<div class="rowtext">
					To determine the number of violated legal regulations of the selected auditee group. These graphs demonstrate the number of critical findings found related to each specific law &amp; regulations. The buyer can amend the parameters such as Area, Audit date, Industry &amp; Type of enterprise. This tool will identify the majority of the risk and the exact quantities found.
				</div>
			</li>


			<li class="row">
				<a class="rowpic" href="<?=Yii::app()->request->baseUrl.'/benchmarking/complGradeCat' ?>" ><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/bar_chart_logo.png', "Search Check List", array("width"=>"80")); ?></a>
				<div class="rowtext">
					Evaluate the average score of the chosen management system criteria under a specific period. The buyer can amend the parameters such as Area, Audit date, Industry &amp; Type of enterprise. This tool allows the buyer to understand the performance of varies group in different criteria. 
				</div>
			</li>
		</ul>

	</div>
	
</div>
	