		<div id="content">

			<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist.png'); ?></div>

			<div id="rightcol">


				<ul>
					<li class="row">
						<div class="rowpic">
							<a href="schedule/supplier"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_main.png', 'Supplier Maintenance', array('width'=>'80')); ?></a>
						</div>
						<div class="rowtext">
							An auditee list needs to be created before an audit can be scheduled. Click here to create an auditee list.

						</div>
					</li>


					<li class="row">
						<a class="rowpic" href="schedule/calendar"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/calendar.png', 'Audit Canlendar', array('width'=>'80')); ?></a>
						<a class="rowtext">
							To schedule an audit, user needs to define the time period and the auditee. Admin and auditee will confirm to the audit arrangement, automatic e-mail notice will alert all parties when there is an update.
						</a>
					</li>
				</ul>

			</div>

		</div>
