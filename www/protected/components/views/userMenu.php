<?
if (!Yii::app()->user->isGuest) {
	$role = Yii::app()->user->role;
}
else {
	$role = NULL;
}  
?>

<div id="navigation">
	<div id="menu">
		<ul id="MenuBar1">
			<li><?php echo CHtml::link('<img src="/images/home-icon.png"/>',array('../')); ?></li>
			<?  if (Yii::app()->user->isGuest) { ?>
				 <li><?php echo CHtml::link('Login',array('site/login?keepThis=true&TB_iframe=true&height=250&width=540&modal=true'), array('class'=>'thickbox')); ?></li>
			<? }?>
			
			<? 
    		if ($role != NULL) {?>
    			<? if ($role == 'BUYER') { ?>
    				<li><?php echo CHtml::link('Buyer',array('../buyer')); ?></li>
    			<? } ?>
    			<? if ($role == 'ADMIN') { ?>
    				<li><?php echo CHtml::link('Qualitech Admin',array('../admin')); ?></li>
    			<? } ?>
    			<? if ($role == 'AUDITOR') { ?>
    				<li><?php echo CHtml::link('Auditor',array('../auditor')); ?></li>
    			<? } ?>
			<? } ?>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<!-- Action -->
<div id="leftsidebar">
	<ul id="sidebar">
		<? if ($this->mainMenu == 'buyer' && $role == 'BUYER') {?>
			<li><?php echo CHtml::link('Audit Check List',array('../checkList')); ?></li>
			<li><?php echo CHtml::link('Scheduling(request)',array('../schedule')); ?></li>
			<li><?php echo CHtml::link('Report(pdf)',array('../report/report')); ?></li>
			<li><?php echo CHtml::link('Benchmarking',array('../benchmarking')); ?></li>
		<? }?>
		<? if ($this->mainMenu == 'admin' && $role == 'ADMIN') {?>
			<li><?php echo CHtml::link('Scheduleing(admin)',array('../admin/schedule')); ?></li>
			<li><?php echo CHtml::link('Report(readOnly)',array('../admin/report')); ?></li>
			<li><?php echo CHtml::link('Audit Check List Maintainence(admin)',array('../admin/checkList')); ?></li>
			<li><?php echo CHtml::link('Buyer Maintenance',array('../admin/buyer')); ?></li>
			<li><?php echo CHtml::link('User Role Maintenance',array('../admin/userAcc')); ?></li>
		<? }?>
		<? if ($this->mainMenu == 'auditor' && $role == 'AUDITOR') {?>
			<li><?php echo CHtml::link('Request Maintencance',array('../auditor/request')); ?></li>
		<? }?>
	</ul>
</div>

<!-- Right Sider -->
<? if ($role == '' ) {?>
<div id="rightsidebar">
	<ul id="sidebar">
		<li><a href="?tag=ourclient"><span class="style66">Our</span> <span class="style88">Client</span></a></li>
		<li><a href="?tag=aboutus"><span class="style88">About</span> <span class="style66">Us</span></a></li>
		<li><a href="?tag=contactus"><span class="style66">Contact</span> <span class="style88">us</span></a></li>
	</ul>
</div>
<? } ?>
<div class="clear"></div>

<!-- SubAction -->
<? if ($this->mainMenu == 'buyer') {?>
<div id="actionsidebar">
	<ul id="sidebar">
		<? if ($role == 'BUYER') {?>
			<? if ($this->mainMenu == 'buyer') {
				if ($this->subMenu == 'checklist') {?>
					<? if ($role == 'BUYER') { ?>
					<li><?php echo CHtml::link('Create',array('../checkList/checkListCreate')); ?></li>
					<? }?>
					<li><?php echo CHtml::link('Search',array('../checkList/checkListSearchPage')); ?></li>
			<? } else if ($this->subMenu == 'schedule') {?>
				<li><?php echo CHtml::link('Supplier Maintenance',array('../schedule/supplier')); ?></li>
				<li><?php echo CHtml::link('Audit Calendar',array('../schedule/calendar')); ?></li>
			<? } else if ($this->subMenu == 'benchmarking') { ?>
				<li><?php echo CHtml::link('Supplier Performance Evaluation',array('../benchmarking/suppPerf')); ?></li>
				<li><?php echo CHtml::link('Compliance Grading Analysis',array('../benchmarking/complGradeAnalysis')); ?></li>
				<li><?php echo CHtml::link('Supplier Compliance Ratio',array('../benchmarking/suppComplRatio')); ?></li>
			<? }} ?>
		<? } ?>
	</ul>
</div>
<? } ?>