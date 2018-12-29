<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/thickbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style2.css" />
	
<!-- 	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
 -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
<!-- 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
 -->
 	<script type="text/javascript">
		path = '<?=Yii::app()->request->baseUrl; ?>';
	</script>
	
	<? Yii::app()->clientScript->registerCoreScript('jquery');?>
	<? //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js', CClientScript::POS_END); ?>
	<? Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/thickbox.js', CClientScript::POS_HEAD ); ?>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="container">

	<div id="header">
		<div class="logo"> 
			<a href="<?=Yii::app()->request->baseUrl?>"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/logo.jpg'); ?></a> 
		</div>
		
		<div class="righttop">
				<? if (!Yii::app()->user->isGuest) {?>
				User: <?=Yii::app()->user->id ?>
				<a href="<?=Yii::app()->request->baseUrl?>/site/logout">Logout</a>
				<? }?>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<? $this->widget('UserMenu', array('mainMenu'=>$this->mainMenu, 'subMenu'=>$this->subMenu)); ?>
	
	<div class="clear"></div>

	<?php echo $content; ?>
	
	<div class="clear"></div>
	
	<? include_once("footer.php");?>
</div>

</body>
</html>