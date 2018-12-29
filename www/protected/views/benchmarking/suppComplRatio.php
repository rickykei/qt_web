<div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/benchmarking_logo.png'); ?></div>
	
	<div id="rightcol">
		<ul>
			<li class="row">
				<div class="rowpic">
					<a href="<?=Yii::app()->request->baseUrl.'/benchmarking/nonComplPerYear' ?>"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/line_chart_logo.png', "Create Check List", array("width"=>"80")); ?></a>
				</div>
				<div class="rowtext">
				This tool consolidates the non-conformance found; the data is presented according to the issued law &amp; regulations at a specific year period. Buyer can amend the parameters such as Area, Audit date, Industry &amp; Type of enterprise. This tool allows the buyer to identify the trend of the performance of a selected group of auditee.
				</div>
			</li>


			<li class="row">
				<a class="rowpic" href="<?=Yii::app()->request->baseUrl.'/benchmarking/nonComplReg' ?>" ><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/pie_chart_logo.png', "Search Check List", array("width"=>"80")); ?></a>
				<div class="rowtext">
					This tool determines the non-compliance ratio % for each legal regulation, and therefore identifies the area of the majority of their risk. Buyer can amend the parameters such as Area, Audit date, Industry &amp; Type of enterprise.
				</div>
			</li>
			
			<li class="row">
				<a class="rowpic" href="<?=Yii::app()->request->baseUrl.'/benchmarking/complRatio' ?>" ><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/pie_chart_logo.png', "Search Check List", array("width"=>"80")); ?></a>
				<div class="rowtext">
					This tool evaluates the compliance ratio % of the selected groups for each management criteria. Buyer can amend the parameters such as Area, Audit date, Industry &amp; Type of enterprise. This gives the buyer an overview performance of it&rsquo;s auditee.
				</div>
			</li>

		</ul>

	</div>
	
</div>
	